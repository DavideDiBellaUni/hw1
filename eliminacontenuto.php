<?php 
require_once('db.php');
$conn = mysqli_connect($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']);
$username = $_GET["q"];
$codarticolo = $_GET["d"];

$query0= "SELECT nomefile from articolo where username = '".$username."'and cod_articolo = '".$codarticolo."'";
$res=mysqli_query($conn, $query0);
$nomf= mysqli_fetch_assoc($res);

$percorso = "C:/xampp/htdocs/hw1/upload/";
$percorsotot= $percorso.$nomf["nomefile"];

unlink($percorsotot);

$query1= "DELETE from preferiti where cod_articolo= '".$codarticolo."'";
$res1=mysqli_query($conn,$query1);

$query2= "DELETE from articolo where username = '".$username."'and cod_articolo = '".$codarticolo."'";
$res2=mysqli_query($conn, $query2);



mysqli_close($conn);



