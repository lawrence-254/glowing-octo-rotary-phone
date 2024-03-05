<?php
include 'accessToken.php';

date_default_timezone_set('Africa/Nairobi');
// date_default_timezone_set('UTC');
$processRequestUrl="https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";
$CallBackUrl="https://eolify3kusnx9p8.m.pipedream.net";
$passKey="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$BusinessShortCode="174379";
$TimeStamp=date('YmdHis');
$Password=base64_encode($BusinessShortCode.$passKey.$TimeStamp);
$phone="254798160161";
$money="";
$PartyA=$phone;
$PartyB='254708374149';
$AccountReference="Msafiri";
$TransactionDesc="payment success";
$Amount=$money;
$stkPushHeader=['Content-Type:application/json', 'Authorization:Bearer '.$access_token];
$curl=curl_init();
curl_setopt($curl, CURLOPT_URL, $processRequestUrl);
curl_setopt($curl, CURLOPT_HTTPHEADER,$stkPushHeader);
$curl_post_data=array(
    'BusinessShortCode'=>$BusinessShortCode,
    'Password'=>$Password,
    'TimeStamp'=>$TimeStamp,
    'TransactionType'=>'CustomerPayBillOnline',
    'Amount'=>$Amount,
    'PartyA'=>$PartyA,
    'PartyB'=>$BusinessShortCode,
    'PhoneNumber'=>$PartyA,
    'CallBackUrl'=>$CallBackUrl,
    'AccountReference'=>$AccountReference,
    'TransactionDesc'=>$TransactionDesc
);
$data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
$curl_response = curl_exec($curl);

echo $curl_response;