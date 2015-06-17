<?php

namespace app\extensions\provider\models;

use app\extensions\provider\exceptions\ProviderException;
use Yii;
use yii\db\ActiveRecord;
use app\models\File;
use yii\helpers\Json;
use app\extensions\provider\exceptions\ProviderDbException;
use app\extensions\provider\interfaces\ProviderInterface;

/**
 * This is the model class for table "providers".
 *
 * @property string $id
 * @property string $name
 * @property string $alias
 * @property string $class
 * @property string $api_key
 * @property string $api_secret
 * @property string $type
 * @property integer $status
 * @property string $extra
 *
 * @property File[] $files
 *
 * @property string $apiKey
 * @property string $apiSecret
 */
class ProviderModel extends ActiveRecord
{
    const TYPE_LOCAL = 'local';
    const TYPE_PARTNER = 'partner';
    const TYPE_SOCIAL_NETWORK = 'social_network';

    const STATUS_DISABLED = 0;
    const STATUS_ACTIVE = 1;

    private $classesNamespace = 'app\extensions\provider\classes';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'providers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'class'], 'required'],
            [['type', 'extra'], 'string'],
            [['status'], 'integer'],
            [['name', 'alias'], 'string', 'max' => 63],
            [['class'], 'string', 'max' => 126],
            [['api_key'], 'string', 'max' => 8],
            [['api_secret'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'class' => 'Class',
            'api_key' => 'Api Key',
            'api_secret' => 'Api Secret',
            'type' => 'Type',
            'status' => 'Status',
            'extra' => 'Extra',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::className(), ['provider_id' => 'id']);
    }

    // Getters and setters

    public function setApiKey($value)
    {
        $this->api_key = $value;
    }

    public function getApiKey()
    {
        return $this->api_key;
    }

    public function setApiSecret($value)
    {
        $this->api_secret = $value;
    }

    public function getApiSecret()
    {
        return $this->api_secret;
    }

    // END Getters and setters


    // Public functions

    /**
     * @param string $alias
     * @return self
     * @throws ProviderDbException
     */
    public static function findByAlias($alias)
    {
        $model = self::find()->where(['status' => self::STATUS_ACTIVE, 'alias' => $alias])->one();
        if (empty($model)) {
            throw new ProviderDbException('Provider not found', ProviderDbException::NOT_FOUND);
        }

        return $model;
    }

    /**
     * @return ProviderInterface
     * @throws ProviderDbException
     * @throws \yii\base\InvalidConfigException
     */
    public function createIdentity()
    {
        $class = $this->class;
        if (strpos($class, '\\') === false) {
            $class = $this->classesNamespace . '\\' . $class;
        }

        if (!class_exists($class)) {
            throw new ProviderDbException('Provider class not found', ProviderDbException::INVALID_PROVIDER_CLASS);
        }

        $params = $this->getIdentityParams();

        $params['class'] = $class;
        $params['id'] = $this->alias;
        $params['type'] = $this->type;

        if (!isset($params['key'])) {
            $params['key'] = $this->getApiKey();
        }
        if (!isset($params['secret'])) {
            $params['secret'] = $this->getApiSecret();
        }

        return Yii::createObject($params);
    }

    /**
     * @return array
     */
    public function getIdentityParams()
    {
        return (array)Json::decode((string)$this->extra);
    }

    // END Public functions
}