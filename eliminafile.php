<?php 
require_once('db.php');

$conn = mysqli_connect($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']);
$username = $_GET["q"];
$codarticolo = $_GET["d"];
$query= "SELECT nomefile from articolo where username = '".$username."'and cod_articolo = '".$codarticolo."'";
$res=mysqli_query($conn, $query);
$nomf= mysqli_fetch_assoc($res);

$percorso = "C:/xampp/htdocs/HW1v2/upload/";
$percorsotot= $percorso.$nomf["nomefile"];
echo $percorsotot;


unlink($percorsotot);
mysqli_close($conn);


?>