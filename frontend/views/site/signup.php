<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use himiklab\yii2\recaptcha\ReCaptcha;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */
/* @var $countries array */

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'signup-form']); ?>
                <?= $form->field($model, 'start_time')->hiddenInput(['value' => time()])->label(false) ?>

                <h3>Common info</h3>
                <?= $form->field($model, 'nickname') ?>
                <?= $form->field($model, 'country')->dropDownList(ArrayHelper::map($countries, 'alpha2_code', 'short_name')) ?>
                <?= $form->field($model, 'city') ?>

                <h3>Personal info</h3>
                <?= $form->field($model, 'surname') ?>
                <?= $form->field($model, 'surname_latin') ?>
                <?= $form->field($model, 'name') ?>
                <?= $form->field($model, 'name_latin') ?>
                <?= $form->field($model, 'secname') ?>
                <?= $form->field($model, 'birthdate')->widget(DatePicker::classname(), [
                    'model' => $model,
                    'attribute' => 'value',
                    //'language' => 'ru',
                    'dateFormat' => 'yyyy-MM-dd',
                    'clientOptions'   => [
                        'changeMonth'   => true,
                        'changeYear'    => true,
                        'minDate'       => '-70y',
                        'maxDate'       => '-18y',
                        'yearRange'     => date("Y", strtotime($model->birthdate_min_date)).':'.date("Y", strtotime($model->birthdate_max_date)),
                    ],
                ]) ?>
                <?= $form->field($model, 'document_type')->dropDownList([1 => 'Passport', 2 => 'Driver\'s licence', 3 => 'Other']) ?>
                <?= $form->field($model, 'document_name', ['options' => ['style' => 'display:none;']]) ?>
                <?= $form->field($model, 'document_serial') ?>
                <?= $form->field($model, 'document_number') ?>
                <?= $form->field($model, 'document_issuedby') ?>
                <?= $form->field($model, 'document_receivedate')->widget(DatePicker::classname(), [
                    'model' => $model,
                    'attribute' => 'value',
                    //'language' => 'ru',
                    'dateFormat' => 'yyyy-MM-dd',
                    'clientOptions'   => [
                        'changeMonth'   => true,
                        'changeYear'    => true,
                        'minDate'       => '-20y',
                        'maxDate'       => '0y',
                        'yearRange'     => date("Y", strtotime($model->document_receivedate_min_date)).':'.date("Y", strtotime($model->document_receivedate_max_date)),
                    ],
                ]) ?>
                <?= $form->field($model, 'address') ?>
                <?= $form->field($model, 'postal_code') ?>

                <h3>Contact info</h3>
                <?= $form->field($model, 'mobile') ?>
                <?= $form->field($model, 'email') ?>

                <h3>Security info</h3>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'password2')->passwordInput() ?>
                <?= $form->field($model, 'telephone_pass') ?>

                <h3>Agreements</h3>
                <?= $form->field($model, 'check1')->checkbox() ?>
                <?= $form->field($model, 'check2')->checkbox() ?>
                <?= $form->field($model, 'check3')->checkbox() ?>
                <?= $form->field($model, 'check4')->checkbox() ?>
                <?= $form->field($model, 'check5')->checkbox() ?>

                <?= $form->field($model, 'verifyCode')->widget(
                    ReCaptcha::className(),
                    ['siteKey' => '6Ld15woTAAAAABzpf-8Zaq41jfUCzviA8H1OgyjX']
                )
                /*    ->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ])*/

                ?>
                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
