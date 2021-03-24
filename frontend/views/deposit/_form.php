<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Deposit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="deposit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'MerchantRequestId')->textInput() ?>

    <?= $form->field($model, 'walletId')->textInput() ?>

    <?= $form->field($model, 'transAmount')->textInput() ?>

    <?= $form->field($model, 'details')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'reciept')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transDate')->textInput() ?>

    <?= $form->field($model, 'createdBy')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
