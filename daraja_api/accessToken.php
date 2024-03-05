<?php
// Api Keys
$consumerKey="DStesc5iXxNE1BzyrDXy5ihm5gwuuQvk";
$consumerSecret="I83iAhiydWpXdmDu";
// access token url
$accessTokenUrl="https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
$headers=['Content-Type:application/json; charset=utf8'];
$curl=curl_init($accessTokenUrl);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_HEADER, FALSE);
curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
$result=curl_exec($curl);
$status=curl_getinfo($curl, CURLINFO_HTTP_CODE);
// echo $result;
$result=json_decode($result);
$access_token = $result->access_token;
curl_close($curl);