<?php

namespace app\extensions\provider;

use Yii;
use yii\base\Object;
use app\extensions\provider\interfaces\ProviderInterface;
use app\extensions\provider\models\ProviderModel;

class Provider extends Object
{
    const PROVIDER_LOCAL = 'local';
    const PROVIDER_BOOKLAND = 'bookland';

    public $component = 'eauth';
    public $widgetClass = 'app\extensions\provider\Widget';

    /**
     * @var ProviderInterface
     */
    private $_identity;

    /**
     * @var \nodge\eauth\EAuth
     */
    public $auth;

    public function init()
    {
        $this->auth = Yii::$app->get($this->component);
    }

    /**
     * @return \app\extensions\provider\Widget
     * @throws \yii\base\InvalidConfigException
     */
    public function getWidget()
    {
        return Yii::createObject($this->widgetClass);
    }

    /**
     * @param null|string $partnerName
     * @param null|string $secret
     * @return ProviderInterface
     * @throws exceptions\ProviderDbException
     * @throws exceptions\ProviderException
     */
    public function getIdentity($partnerName = null, $secret = null)
    {
        if ($this->_identity !== null) {
            return $this->_identity;
        }

        if ($partnerName === null) {
            $partnerName = self::PROVIDER_LOCAL;
        }

        if ($secret !== null) {
            return $this->_identity = ProviderModel::findByKeyAndSecret($partnerName, $secret)->createIdentity();
        } else {
            return $this->_identity = ProviderModel::findByAlias($partnerName)->createIdentity();
        }
    }
}