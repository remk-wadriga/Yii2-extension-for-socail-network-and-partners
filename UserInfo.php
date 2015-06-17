<?php

namespace app\extensions\provider;

use yii\base\Object;
use app\extensions\provider\interfaces\UserInfoInterface;

class UserInfo extends Object implements UserInfoInterface
{
    protected $id;
    protected $username;
    protected $password;
    protected $email;
    protected $firstName;
    protected $lastName;
    protected $currency;
    protected $provider;
    protected $appKey = 'qNAx1RDb';
    protected $appSecret = 'K3YYSjCgDJNoWKdGVOyO1mrROp3MMZqqRNXNXTmh';

    public function setId($value)
    {
        $this->id = $value;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUsername($value)
    {
        $this->username = $value;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setPassword($value)
    {
        $this->password = $value;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setEmail($value)
    {
        $this->email = $value;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setFirstName($value)
    {
        $this->firstName = $value;
        return $this;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setLastName($value)
    {
        $this->lastName = $value;
        return $this;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setCurrency($value)
    {
        $this->currency = $value;
        return $this;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setProvider($value)
    {
        $this->provider = $value;
        return $this;
    }

    public function getProvider()
    {
        return $this->provider;
    }

    public function setAppKey($value)
    {
        $this->appKey = $value;
        return $this;
    }

    public function getAppKey()
    {
        return $this->appKey;
    }

    public function setAppSecret($value)
    {
        $this->appSecret = $value;
        return $this;
    }

    public function getAppSecret()
    {
        return $this->appSecret;
    }
}