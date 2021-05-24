<?php
require_once('db.php');

session_start();


$cod = $_GET["cod"];
$username = $_GET["user"];

$conn = mysqli_connect($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']);
$query= "SELECT * from artpref where cod_articolo = '".$cod."' and userpref = '".$username."'";
$res=mysqli_query($conn, $query);
if(mysqli_num_rows($res)>0){
    $check = true;
}else{
    $check = false;
}

echo json_encode($check);
mysqli_free_result($res);

mysqli_close($conn);

?>