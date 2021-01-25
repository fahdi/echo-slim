<?php
$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => 'http://localhost:8090/echo',
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => [
    'name' => 'Fahad Bhai',
    'description' => 'Kiya kar rahe ho2!',
    'sparta' => 'This is sparta'
  ]
]);

$response = curl_exec($curl);


curl_close($curl);

echo $response;
