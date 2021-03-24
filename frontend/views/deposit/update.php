<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Deposit */

$this->title = 'Update Deposit: ' . $model->transId;
$this->params['breadcrumbs'][] = ['label' => 'Deposits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->transId, 'url' => ['view', 'id' => $model->transId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="deposit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
