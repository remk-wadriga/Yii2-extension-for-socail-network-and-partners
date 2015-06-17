<?php

namespace app\extensions\provider\interfaces;


interface ProviderInterface
{
    /**
     * @param array $params
     * @return string
     */
    public function getFormView($params = []);

    /**
     * @return \app\extensions\provider\abstracts\FormAbstracts
     */
    public function getForm();

    /**
     * @param array $params
     * @return \app\extensions\provider\HttpClient
     */
    public function getClient($params = []);

    public function retrieveResponse($url = null, $params = [], $headers = []);

    /**
     * @return array
     */
    public function getRequestParams();

    /**
     * @return array
     */
    public function getRequestHeaders();

    /**
     * @return \app\extensions\provider\interfaces\UserInfoInterface
     */
    public function authenticate();

    /**
     * @param array $userInfo
     * @return mixed
     */
    public function login($userInfo);

    /**
     * @return \app\extensions\provider\interfaces\UserInfoInterface
     */
    public function getUserInfo();
}