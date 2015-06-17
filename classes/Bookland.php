<?php

namespace app\extensions\provider\classes;

use Yii;
use app\extensions\provider\abstracts\ProviderAbstract;
use app\extensions\provider\exceptions\ProviderException;
use app\extensions\provider\exceptions\ProviderResponseException;

class Bookland extends ProviderAbstract
{
    public $view = 'booklandForm';
    public $formClass = 'app\extensions\provider\forms\BooklandForm';
    public $loginAction;
    public $answerUserStatusName;
    public $answerStatusUserExist;
    public $answerStatusUserBlocked;

    protected $username;
    protected $password;

    public function getRequestParams()
    {
        $params = parent::getRequestParams();
        $params['action'] = $this->loginAction;
        $params['signature'] = $this->generateSignature($params);

        $this->username = $params['login'];
        $this->password = $params['password'];

        return $params;
    }

    /**
     * @return \app\extensions\provider\UserInfo
     * @throws ProviderException
     * @throws ProviderResponseException
     */
    public function authenticate()
    {
        $response = $this->retrieveResponse();

        if (isset($response['error']) && boolval($response['error']) === true) {
            if (!isset($response['message']) || $response['message'] === '') {
                throw new ProviderResponseException('Undefined error', ProviderResponseException::INVALID_RESPONSE);
            }

            throw new ProviderResponseException($response['message'], ProviderResponseException::RESPONSE_ERROR);
        }

        if (!isset($response[$this->answerUserStatusName])) {
            throw new ProviderResponseException('User status is undefined', ProviderResponseException::INVALID_RESPONSE);
        }

        switch ($response[$this->answerUserStatusName]) {
            case $this->answerStatusUserExist:
                // Login user
                return $this->login($response);
                break;
            case $this->answerStatusUserBlocked:
                throw new ProviderException('User is blocked', ProviderException::LOGIN_FAILED);
                break;
            default:
                throw new ProviderException('User not exist', ProviderException::LOGIN_FAILED);
                break;
        }
    }

    /**
     * @param array $userInfo
     * @return \app\extensions\provider\UserInfo
     */
    public function login($userInfo)
    {
        $id = isset($userInfo["userId"]) ? $userInfo["userId"] : null;
        $firstName = isset($userInfo["firstName"]) ? $userInfo["firstName"] : null;
        $lastName = isset($userInfo["lastName"]) ? $userInfo["lastName"] : null;
        $currency = isset($userInfo["currency"]) ? $userInfo["currency"] : null;

        // Create user info
        return $this->getUserInfo()
            ->setId($id)
            ->setUsername($this->username)
            ->setEmail($this->username)
            ->setPassword($this->password)
            ->setFirstName($firstName)
            ->setLastName($lastName)
            ->setCurrency($currency);
    }

    protected function generateSignature($params, $secret = null)
    {
        if ($secret === null) {
            $secret = $this->secret;
        }

        ksort($params);

        $string = '';
        foreach ($params as $key => $value) {
            $string .= "{$key}={$value}";
        }
        $string .= $secret;

        return sha1($string);
    }
}