<?php

namespace app\extensions\provider;

use Yii;
use nodge\eauth\Widget as EauthWidget;

class Widget extends EauthWidget
{
    public static function createScripts()
    {
        $translations = [
            '1104' => Yii::t('provider', 'Response failed'),
            '1105' => Yii::t('provider', 'Response empty'),
            '1106' => Yii::t('provider', 'Response error'),
            '1107' => Yii::t('provider', 'Invalid response'),
            '1004' => Yii::t('provider', 'Provider not found'),
            '1005' => Yii::t('provider', 'Invalid provider class'),
            '1204' => Yii::t('provider', 'Login failed'),
            '210' => Yii::t('provider', 'Authentication failed'),
            '211' => Yii::t('provider', 'Application not found'),
            '231' => Yii::t('provider', 'Can not create toked'),
        ];

        $jsErrorsText = 'Providers.errors = {';

        foreach ($translations as $code => $text) {
            $jsErrorsText .= $code . ': "'.$text.'",';
        }

        $jsErrorsText = substr($jsErrorsText, 0, strlen($jsErrorsText) - 1) . '};';

        return $jsErrorsText . ' Providers.init()';
    }
}