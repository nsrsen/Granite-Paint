<?php
require 'vendor/autoload.php';
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

define("AUTHORIZENET_LOG_FILE","phplog");

$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
  $merchantAuthentication->setName($AUTHORIZE_NET_API_LOGIN_ID);
  $merchantAuthentication->setTransactionKey($AUTHORIZE_NET_TRANSACTION_KEY);
  $refId = 'ref' . time();

  $creditCard = new AnetAPI\CreditCardType();
  $creditCard->setCardNumber("4111111111111111" );
  $creditCard->setExpirationDate( "2038-12");
  $paymentOne = new AnetAPI\PaymentType();
  $paymentOne->setCreditCard($creditCard);

  $transactionRequestType = new AnetAPI\TransactionRequestType();
  $transactionRequestType->setTransactionType("authCaptureTransaction");
  $transactionRequestType->setAmount(151.51);
  $transactionRequestType->setPayment($paymentOne);
  $request = new AnetAPI\CreateTransactionRequest();
  $request->setMerchantAuthentication($merchantAuthentication);
  $request->setRefId( $refId);
  $request->setTransactionRequest($transactionRequestType);
  $controller = new AnetController\CreateTransactionController($request);
  $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

  if ($response != null)
{
  $tresponse = $response->getTransactionResponse();
  if (($tresponse != null) && ($tresponse->getResponseCode()=="1"))
  {
    echo "Charge Credit Card AUTH CODE : " . $tresponse->getAuthCode() . "\n";
    echo "Charge Credit Card TRANS ID  : " . $tresponse->getTransId() . "\n";
  }
  else
  {
    echo "Charge Credit Card ERROR :  Invalid response\n";
  }
}
else
{
  echo  "Charge Credit Card Null response returned";
}
?>
