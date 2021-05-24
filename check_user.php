<?php 
require_once('db.php');
$conn = mysqli_connect($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']);
$username = $_GET["q"];
$query= "SELECT username from utente where username = '".$username."'";
$res=mysqli_query($conn, $query);

if(mysqli_num_rows($res)>0){
    $check = false;
}else{
    $check = true;
}

mysqli_free_result($res);
mysqli_close($conn);

echo json_encode($check);