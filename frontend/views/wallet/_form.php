<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Wallet */
/* @var $form yii\widgets\ActiveForm */
?>

<!-- <div class="wallet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userId')->textInput() ?>

    <?= $form->field($model, 'currencyId')->textInput() ?>

    <?= $form->field($model, 'walletName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'balance')->textInput() ?>

    <?= $form->field($model, 'createdBy')->textInput() ?>

    <?= $form->field($model, 'createdAt')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div> -->
<div class="wallet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userId')->hiddenInput(['value'=>yii::$app->user->id])->label(false) ?>

    <?= $form->field($model, 'currencyId')->hiddenInput(['value'=>76])->label(false) ?>

    <?= $form->field($model, 'walletName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'createdBy')->hiddenInput(['value'=>yii::$app->user->id])->label(false) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
