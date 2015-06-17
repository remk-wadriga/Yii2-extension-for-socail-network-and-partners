<?php

namespace app\extensions\provider\interfaces;


interface UserInfoInterface
{
    /**
     * @param $value
     * @return UserInfoInterface
     */
    public function setId($value);

    /**
     * @return string
     */
    public function getId();

    /**
     * @param $value
     * @return UserInfoInterface
     */
    public function setUsername($value);

    /**
     * @return string
     */
    public function getUsername();

    /**
     * @param $value
     * @return UserInfoInterface
     */
    public function setPassword($value);

    /**
     * @return string
     */
    public function getPassword();

    /**
     * @param $value
     * @return UserInfoInterface
     */
    public function setEmail($value);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param $value
     * @return UserInfoInterface
     */
    public function setFirstName($value);

    /**
     * @return string
     */
    public function getFirstName();

    /**
     * @param $value
     * @return UserInfoInterface
     */
    public function setLastName($value);

    /**
     * @return string
     */
    public function getLastName();

    /**
     * @param $value
     * @return UserInfoInterface
     */
    public function setCurrency($value);

    /**
     * @return string
     */
    public function getCurrency();

    /**
     * @param $value
     * @return UserInfoInterface
     */
    public function setProvider($value);

    /**
     * @return string
     */
    public function getProvider();

    /**
     * @param $value
     * @return UserInfoInterface
     */
    public function setAppKey($value);

    /**
     * @return string
     */
    public function getAppKey();

    /**
     * @param $value
     * @return UserInfoInterface
     */
    public function setAppSecret($value);

    /**
     * @return string
     */
    public function getAppSecret();
}