<?php
require_once('db.php');

session_start();

if(isset($_SESSION["username"]))
{
    // Vai alla home
    header("Location: dashboard.php");
}

if(isset($_POST["username"])&& isset($_POST["password"]) && isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["email"])){
    $conn = mysqli_connect($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']);
    $nome = mysqli_real_escape_string($conn, $_POST["name"]);
    $cognome = mysqli_real_escape_string($conn, $_POST["surname"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $passw = $_POST["password"];
    $passwhash= password_hash($passw,PASSWORD_BCRYPT);
    $password = mysqli_real_escape_string($conn,$passwhash);

    if($conn){
    mysqli_query($conn, "INSERT INTO utente VALUES(\"$username\",\"$password\",\"$nome\",\"$cognome\",\"$email\",0);");
    mysqli_close($conn);
        // Imposta la variabile di sessione
        $_SESSION["username"] = $_POST["username"];
        header("Location: dashboard.php");
        exit;
    }else{
        header("Location: prova.php");
    }
}

?>

<!DOCTYPE html>
<head>
<link rel="stylesheet" href="signup.css">
<script src= "signup.js" defer></script>
<link href="http://fonts.cdnfonts.com/css/coolvetica-2" rel="stylesheet">
<meta charset="UTF-8">
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
<header>
        <div id="overlay">
        <nav>
            <div id="logo">
                <img src="111.png"/>
           oncept
            </div>
            <div id="links">
                <a href="dashboard.php">Home</a>
                <a href="signup.php">Creator</a>
                <a id="insta" href="https://www.instagram.com/concept.ava/"><img src="insta.png"/></a>
              </div>

    
              <div id="menu">
            <div id="arancio"></div>
            <div id="bordeaux"></div>
            <div id="verde"></div>
            <div id="blue"></div>
          </div>
        </nav>

        <div id= "navscrollbar">
            <a href="dashboard.php">Home</a>
            <a href="login.php">Creator</a>
            <a id="insta" href="https://www.instagram.com/concept.ava/"><img src="insta.png"/></a>
      </div>
      
        <div id="title">
            <img src="111.png"/>
        <h1>Vogliamo esprimere un concetto</h1>
</header>
<div id= "contreg">
<div class= "contenitore">
<p class= "validazione"></p>
<h1 id="registrazione">REGISTRAZIONE</h1>
    <main>
    
        <form enctype="multipart/form-data"  name='sign' method='post'>
            <p>
                <label>Nome utente: <input type='text' name='username' value='<?php if(isset($_POST["username"])){echo $_POST['username'];}else{echo"";}?>'></label>
                <span id= "ResponsoUtente"><span>
            </p>
            <p>
                <label>Password: <input type='password' name='password' value='<?php if(isset($_POST["password"])){echo $_POST['password'];}else{echo"";}?>'></label>
                <span id= "message"><span>
            </p>
            <p>
                <label>Nome:  <input type='text' name='name' value='<?php if(isset($_POST["name"])){echo $_POST['name'];}else{echo"";}?>'></label>
            </p>
            <p>
                <label>Cognome: <input type='text' name='surname' value='<?php if(isset($_POST["surname"])){echo $_POST['surname'];}else{echo"";}?>'></label>
            </p>
            <p>
                <label>E-mail: <input type='text' name='email' value='<?php if(isset($_POST["email"])){echo $_POST['email'];}else{echo"";}?>'></label>
                <span id = "correctmail"></span>
            </p>
            <p>
                <label>&nbsp;<input type='submit' id="submit"></label>
            </p>
            <p>
                <label>Sei già registrato?<a href="login.php">LOGIN</a></label>
            </p>
        </form>
    </main>
</div>
</div>

<footer>
        <span>Seguici su Instagram!
        <a id="insta" href="https://www.instagram.com/concept.ava/"><img src="insta.png"/></a></span>
       <span> Davide Di Bella O46001877</span>
    </footer>
</body>
</html>