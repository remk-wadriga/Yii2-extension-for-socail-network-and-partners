<?php
/**
 *
 * @var \yii\web\View $this
 * @var \app\extensions\provider\abstracts\FormAbstracts $model
 */

use yii\helpers\Url;

?>

<form id="login_form_bookland" class="form-horizontal login-by-provider" action="<?= Url::to(['/api/auth/login', 'provider' => $model->providerName]) ?>" method="post">

    <input name="grant_type" value="password" type="hidden">

    <div class="form-group field-booklandform-username required">
        <label class="col-lg-1 control-label" for="booklandform-username"><?= Yii::t('provider', 'Login') ?></label>
        <div class="col-lg-3"><input id="booklandform-username" class="form-control" name="username" type="text"></div>
        <div class="col-lg-8"><p class="help-block help-block-error"></p></div>
    </div>

    <div class="form-group field-booklandform-password required">
        <label class="col-lg-1 control-label" for="booklandform-password"><?= Yii::t('provider', 'Password') ?></label>
        <div class="col-lg-3"><input id="booklandform-password" class="form-control" name="password" type="password"></div>
        <div class="col-lg-8"><p class="help-block help-block-error"></p></div>
    </div>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <button type="submit" class="btn btn-primary" name="login-button"><?= Yii::t('provider', 'Login by {providerName}', ['providerName' => $model->providerName]) ?></button>
        </div>
    </div>

</form>