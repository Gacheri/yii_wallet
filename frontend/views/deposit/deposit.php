<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Wallet;
use frontend\models\Country;

/* @var $this yii\web\View */
/* @var $model frontend\models\Deposit */
/* @var $form ActiveForm */
?>
<div class="deposits">

    <?php $form = ActiveForm::begin(['id'=>'deposit']); ?>
        <?= $form->field($model, 'createdBy')->hiddenInput(['value'=>yii::$app->user->id])->label(false) ?>
        <?= $form->field($model, 'walletId')->dropDownlist(ArrayHelper::map(Wallet::find()->where(['userId'=>yii::$app->user->id])->asArray()->all(), 'walletId', 'walletName')) ?> 
        <?= $form->field($model, 'phoneCode')->dropDownlist(ArrayHelper::map(Country::find()->all(), 'couPhoneCode', 'countryName')) ?>
        <?= $form->field($model, 'transAmount') ?>
        <?= $form->field($model, 'mpesaNumber') ?>
        <?= $form->field($model, 'details') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- deposits -->
