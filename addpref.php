<?php
require_once('db.php');

session_start();

if(isset($_SESSION["username"]))
{
    // Vai alla home
    header("Location: dashboard.php");
}

$cod = $_GET["cod"];
$username = $_GET["user"];

$conn = mysqli_connect($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']);
$query= "INSERT into preferiti values(\"$cod\",\"$username\")";
$res=mysqli_query($conn, $query);
mysqli_close($conn);

?>