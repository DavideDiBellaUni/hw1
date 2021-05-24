<?php

$client_id= "e6f75db7e0f5474fa2dc65fb7c1b54d1";
$client_secret = "c33aeb4cf3c945cea830af9144b23e35";

$curl= curl_init();
curl_setopt($curl, CURLOPT_URL, "https://accounts.spotify.com/api/token");
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
$headers= array("Authorization: Basic ".base64_encode($client_id.":".$client_secret));
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result= curl_exec($curl);
curl_close($curl);
//echo $result;

$token = json_decode($result)->access_token;
//echo $token;

$track= $_GET["tr"];


$data = http_build_query(array("q" => $track, "type" => "track","market" => ("IT")));
$curl= curl_init();
curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/search?".$data);
$headers= array("Authorization: Bearer ".$token);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$res= curl_exec($curl);
echo $res;
curl_close($curl);

?>