<?php

namespace app\extensions\provider\abstracts;

use Yii;
use yii\base\Object;
use app\extensions\provider\exceptions\ProviderResponseException;
use app\extensions\provider\UserInfo;
use app\extensions\provider\interfaces\ProviderInterface;
use app\extensions\provider\Uri;
use yii\helpers\Json;

abstract class ProviderAbstract extends Object implements ProviderInterface
{
    public $id;
    public $apiUrl;
    public $viewPath = '@app/extensions/provider/views';
    public $view;
    public $formClass;
    public $clientClass = 'app\extensions\provider\HttpClient';
    public $key;
    public $secret;
    public $type;
    public $isJsonResponse = true;

    /**
     * @var \app\extensions\provider\abstracts\FormAbstracts
     */
    protected $_form;

    /**
     * @var \app\extensions\provider\HttpClient
     */
    protected $_client;

    /**
     * @var \app\extensions\provider\UserInfo
     */
    protected $_userInfo;

    /**
     * @var \app\extensions\provider\PartnerLoginInfo
     */
    protected $_partnerLoginInfo;

    public function getViewFile()
    {
        return $this->viewPath . '/' . $this->view . '.php';
    }

    public function getFormView($params = [])
    {
        $params['model'] = $this->getForm();
        return Yii::$app->view->renderFile($this->getViewFile(), $params);
    }

    /**
     * @return \app\extensions\provider\abstracts\FormAbstracts
     */
    public function getForm()
    {
        if ($this->_form !== null) {
            return $this->_form;
        }

        $this->_form = new $this->formClass();
        $this->_form->providerName = $this->id;

        return $this->_form;
    }

    /**
     * @param array $params
     * @return \app\extensions\provider\HttpClient
     * @throws \yii\base\InvalidConfigException
     */
    public function getClient($params = [])
    {
        if ($this->_client !== null) {
            return $this->_client;
        }

        return $this->_client = Yii::createObject($this->clientClass, $params);
    }

    public function retrieveResponse($url = null, $params = [], $headers = [])
    {
        $params = array_merge($this->getRequestParams(), $params);
        $headers = array_merge($this->getRequestHeaders(), $headers);

        if (isset($params['method'])) {
            $this->getClient()->setMethod($params['method']);
            unset($params['method']);
        }

        try {
            $response = $this->getClient()->retrieveResponse($this->createUri($url), $params, $headers);

            if (empty($response)) {
                throw new ProviderResponseException('Empty response', ProviderResponseException::RESPONSE_EMPTY);
            }

            return $this->parseResponse($response);
        } catch(\Exception $e) {
            throw new ProviderResponseException($e->getMessage(), ProviderResponseException::RESPONSE_FAIL);
        }
    }

    public function getRequestParams()
    {
        $formAttributes = $this->getForm()->getAttributes();
        $params = [];
        $params['login'] = $formAttributes['username'];
        $params['password'] = $formAttributes['password'];

        return $params;
    }

    public function getRequestHeaders()
    {
        return [];
    }

    public function authenticate()
    {
       return $this->retrieveResponse();
    }

    /**
     * @return \app\extensions\provider\UserInfo
     */
    public function getUserInfo()
    {
        if ($this->_userInfo !== null) {
            return $this->_userInfo;
        }

        $this->_userInfo = new UserInfo();

        return $this->_userInfo->setProvider($this->id);
    }

    /**
     * @param null $url
     * @return Uri
     */
    protected function createUri($url = null)
    {
        if ($url === null) {
            $url = $this->apiUrl;
        }

        return new Uri($url);
    }

    protected function parseResponse($response)
    {
        if ($this->isJsonResponse === true) {
            return Json::decode((string)$response);
        } else {
            return $response;
        }
    }
}