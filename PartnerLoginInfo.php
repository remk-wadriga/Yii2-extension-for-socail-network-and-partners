<?php

namespace app\extensions\provider;

use yii\base\Object;
use app\extensions\provider\interfaces\PartnerLoginInfoInterface;

class PartnerLoginInfo extends Object implements PartnerLoginInfoInterface
{
    protected $key;
    protected $secret;
    protected $name;

    /**
     * @param string $value
     * @return PartnerLoginInfoInterface
     */
    public function setKey($value)
    {
        $this->key = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $value
     * @return PartnerLoginInfoInterface
     */
    public function setSecret($value)
    {
        $this->secret = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param string $value
     * @return PartnerLoginInfoInterface
     */
    public function setName($value)
    {
        $this->name = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}