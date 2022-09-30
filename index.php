<?php

define('BASE_URL', 'https://payments.paypack.rw/api');

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => BASE_URL . '/transactions/cashin?Idempotency-Key=OldbBsHAwAdcYalKLXuiMcqRrdEcDGRv',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => '{"amount":100,"number":"078xxxx"}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer ' . getToken(),
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;


function getToken()
{
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => BASE_URL . '/auth/agents/authorize',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => '{"client_id": "xxx-xxx-xxx","client_secret": "xxxxxxxxx"}',
    CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
  ));

  $response = curl_exec($curl);

  curl_close($curl);

  return json_decode($response)->access;
}
