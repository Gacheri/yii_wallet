<?php

use yii\bootstrap4\Modal;
use frontend\models\Wallet;
/* @var $this yii\web\View */
$this->title = 'WALLET';
$balance = wallet::find()->where(['userId'=>Yii::$app->user->id])->One();
?>
<div class="row">
    <div class="col-md-4"> 
      <div class="card" style="width: 18rem;">
      <div class="card-body mx-auto">
        <h2 class="card-title text-center">Wallet Balance</h2>
        <h1 class="card-subtitle mb-2 text-muted text-center">Ksh. <?= $balance->balance?> </h1>
        <h6 class="card-subtitle mb-2 text-muted ">Available</h6></br>
        <button type="button" class="btn btn-primary deposit" baseUrl="<?=Yii::$app->request->baseUrl?>"> Deposit </button>
        <button type="button" class="btn btn-outline-success float-right">Withdraw</button>
      </div>
    </div>
    </div>
<div class="col-md-8"> 
<h3 class="text-center">Recent Activity</h3>
<ul class="list-group list-group-flush">
  <li class="list-group-item">
  <i class="fa fa-money fa-3x" aria-hidden="true"></i> Deposit <span class="float-right">+500 KES</span></li>
  <li class="list-group-item"><i class="fa fa-exchange fa-3x" aria-hidden="true"></i> Withdrawal <span class="float-right">-1500 KES</span></li>
</ul>
</div>
</div>
<?php
  Modal::begin([
    'id'=>'deposit',
    'size'=>'modal-lg'
    ]);

echo "<div id='depositContent'></div>";
Modal::end();
?>
