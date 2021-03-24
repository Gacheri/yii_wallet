<?php
namespace frontend\controllers;
use common\xyz\MpesaApi;
use frontend\models\Mpesastkrequests;
class DepositController extends \yii\web\Controller
{
    public function beforeAction($action){
        if ($action->id == 'ipn' ){
            $this->enableCsrfValidation = false;
        }
        return parent ::beforeAction($action);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
    
    /**
     *
     * @return void|unknown
     */
   
    public function pay($postData){
        $mpesa_api = new MpesaApi();
       // var_dump($postData); exit();
        $TransactionType = 'CustomerPayBillOnline';
        $Amount = $postData['transAmount'];
        $PhoneNumber = $postData['phoneCode'].$postData['mpesaNumber'];
        $PartyA = $postData['phoneCode'].$postData['mpesaNumber'];
        $PartyB = 174379;
     // $UserId = $postData['userId'];
        $CallBackURL = 'https://9098b0893c0a.ngrok.io/wallet/xyz/confirm?token=KUstudents51234567qwerty';
        // $CallBackURL = 'https://9098b0893c0a.ngrok.io/wallet/xyz/savedata';
        $AccountReference =  $postData['details'];
        $TransactionDesc = $postData['details'];
        
        
        
        $configs = array(
            'AccessToken' => $this->generateToken(),
            'Environment' => 'sandbox',
            'Content-Type' => 'application/json',
            'Verbose' => 'true',
        );
        
        $api = 'stk_push';
        $LipaNaMpesaPasskey= 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        $timestamp ='20'.date("ymdhis");
        $BusinessShortCode = 174379;
        
        $parameters = array(
            'BusinessShortCode' => $BusinessShortCode,
            'Password' => base64_encode($BusinessShortCode.$LipaNaMpesaPasskey.$timestamp),
            'Timestamp' => $timestamp,
            'TransactionType' => $TransactionType,
            'Amount' => $Amount,
            'PartyA' => $PartyA,
            'PartyB' => $PartyB,
            'PhoneNumber' =>$PhoneNumber,
            'CallBackURL' => $CallBackURL,
            'AccountReference' => $AccountReference,
            'TransactionDesc' => $TransactionDesc,
        );
        
        $response = $mpesa_api->call($api, $configs, $parameters);
        // var_dump($response); exit();
        return $response;
    }

    /**
     *
     * @return void|unknown
     */
    public function actionDeposit()
    {
        $model = new \frontend\models\Deposit();
        
        if (\Yii::$app->request->post()) {
            $response = $this->pay(\Yii::$app->request->post()['Deposit']);
            $this->processRespose($response,\Yii::$app->request->post());
        }
        
        return $this->renderAjax('deposit', [
            'model' => $model,
        ]);
    }
    
    
    private function generateToken(){
        
        $mpesa_api = new MpesaApi();
        
        $configs = array(
            'Environment' => 'sandbox',
            'Content-Type' => 'application/json',
            'Verbose' => '',
        );
        
        $api = 'generate_token';
        
        $parameters = array(
            'ConsumerKey' => '8zSxsv8mAHHuviDhdXj7Mzd9KY7VnFGS',
            'ConsumerSecret' => 'TUPfzlmfRdL3FVxN',
        );
        
        $response = $mpesa_api->call($api, $configs, $parameters);
        return $response['Response']['access_token'];
        
    } 

    // saves the request to deposit money
    // parameters ni objects
    public function saveRequestData($response,$walletId){
        
        $model = new Mpesastkrequests();
        $model->amount = $response['Parameters']['Amount'];
        $model->phone = $response['Parameters']['PhoneNumber'];
        $model->reference = $response['Parameters']['AccountReference'];
        $model->description = $response['Parameters']['TransactionDesc'];
        $model->CheckoutRequestID = $response['Response']['CheckoutRequestID'];
        $model->MerchantRequestID = $response['Response']['MerchantRequestID'];
        $model->walletId = $walletId;
        $model->userId = \yii::$app->user->Id;
        
        $model->save();
        
        return $model;
        
    }
    
   
    public function processRespose($response,$postData) {
        $model = new \frontend\models\Deposit();
        if (array_key_exists('errorCode', $response['Response'])) {
            $model->load($postData);
            $model->save();
            $Msg = '<div class="alert alert-danger alert-dismissable" role="alert">
					<h3>THE FOLLOWING ERROR HAS ACCURED WHILE TRYING TO PROCESS YOUR REQUEST</h3>
					 <h5> ERROR CODE: '.$response['Response']['errorCode'].'</h5>
					 <h6>'.$response['Response']['errorMessage'].'</h6><h6>For more information Please Contact Support Via: 0727309037</h6>
					</div>';
            \Yii::$app->session->setFlash('error', $Msg);
            $this->redirect(['site/index']);
        }else{
            $model->load($postData);
            if (array_key_exists('MerchantRequestID', $response['Response'])) {
                $model->MerchantRequestId = $response['Response']['MerchantRequestID'];
                $this->saveRequestData($response,$postData['Deposit']['walletId']);
            }
            
            $model->save();
            $Msg = '<div class="alert alert-success alert-dismissable" role="alert">
						  	<h5> '.$response['Response']['CustomerMessage'].'</h5>
						  </div>';
            \Yii::$app->session->setFlash('success', $Msg);
            $this->redirect(['site/index']);
        }
    }

    
    
    
}