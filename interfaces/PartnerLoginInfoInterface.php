<?php

namespace app\extensions\provider\interfaces;


interface PartnerLoginInfoInterface
{
    /**
     * @param string $value
     * @return PartnerLoginInfoInterface
     */
    public function setKey($value);

    /**
     * @return string
     */
    public function getKey();

    /**
     * @param string $value
     * @return PartnerLoginInfoInterface
     */
    public function setSecret($value);

    /**
     * @return string
     */
    public function getSecret();

    /**
     * @param string $value
     * @return PartnerLoginInfoInterface
     */
    public function setName($value);

    /**
     * @return string
     */
    public function getName();
}