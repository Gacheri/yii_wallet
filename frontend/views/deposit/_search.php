<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\DepositSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="deposit-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'transId') ?>

    <?= $form->field($model, 'MerchantRequestId') ?>

    <?= $form->field($model, 'walletId') ?>

    <?= $form->field($model, 'transAmount') ?>

    <?= $form->field($model, 'details') ?>

    <?php // echo $form->field($model, 'reciept') ?>

    <?php // echo $form->field($model, 'transDate') ?>

    <?php // echo $form->field($model, 'createdBy') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
