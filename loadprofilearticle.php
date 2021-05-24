<?php
require_once('db.php');
session_start();

$user= $_SESSION["username"];
$conn = mysqli_connect($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']);
$query = "SELECT * from articolo where username= '".$user."'";
$contenuti = array();
$res= mysqli_query($conn,$query);
while($row =mysqli_fetch_assoc($res)){
    $contenuti[]=$row;
     
}

mysqli_free_result($res);
mysqli_close($conn);

echo json_encode($contenuti);
?>