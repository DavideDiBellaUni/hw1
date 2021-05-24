<?php

session_start();

if(isset($_SESSION["username"]))
{
    // Vai alla home
    header("Location: dashboard.php");
}

$c=$_GET['c'];
$curl= curl_init();
$frase = urlencode($c);

curl_setopt($curl, CURLOPT_URL, "https://api.mymemory.translated.net/get?q=".$frase."&langpair=en|it&de=dibbi27@outlook.it");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result= curl_exec($curl);
curl_close($curl);
echo $result;

?>
