<?php
require_once('db.php');
// Avvia la sessione
session_start();
// Verifica l'accesso
if(isset($_SESSION["username"]))
{
    // Vai alla home
    header("Location: dashboard.php");
    exit;
}

if(isset($_POST["username"]) && isset($_POST["password"]))
{
    // Connetti al database
    //$conn = mysqli_connect("localhost", "root", "", "concept_wprova");
    $conn = mysqli_connect($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $passw = $_POST["password"];
    
    $query = "SELECT password from utente where username ='".$username."'";
    $res = mysqli_query($conn, $query);
    

    // Verifica la correttezza delle credenziali
    if(mysqli_num_rows($res)>0){
        $pwd= mysqli_fetch_assoc($res);
            if(password_verify($passw,$pwd["password"])){
                //imposto variabile di sessione
                mysqli_free_result($res);
        mysqli_close($conn);
        $_SESSION["username"] = $_POST["username"];
        // Vai alla pagina home_db.php
        header("Location: dashboard.php");
        exit;
            }else
            {
                // Flag di errore
                $errore = true;
            }
     
    }else
    {
        // Flag di errore
        $errore = true;
    }
}
?>


<!DOCTYPE html>
<head>
<link rel="stylesheet" href="login.css">
<link href="http://fonts.cdnfonts.com/css/coolvetica-2" rel="stylesheet">
<script type="text/javascript" src="login.js" defer></script>
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
                <a href="login.php">Creator</a>
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
            <a href="home.php">Home</a>
            <a href="login.php">Creator</a>
            <a id="insta" href="https://www.instagram.com/concept.ava/"><img src="insta.png"/></a>
      </div>
        <div id="title">
            <img src="111.png"/>
        <h1>Vogliamo esprimere un concetto</h1>
</header>
<div id= "contreg">
<div class= "contenitore">
<?php
        // Verifica la presenza di errori
        if(isset($errore))
        {
            echo "<p class='errore'>";
            echo "Credenziali non valide.";
            
            echo "</p>";
        }
    ?>
<h1 id="registrazione">ACCEDI</h1>
    <main>
    
        <form enctype="multipart/form-data"  name='sign' method='post'>
            <p>
                <label>Nome utente: <input type='text' name='username' value='<?php if(isset($_POST["username"])){echo $_POST['username'];}else{echo"";}?>'></label>
            </p>
            <p>
                <label>Password: <input type='password' name='password' value='<?php if(isset($_POST["password"])){echo $_POST['password'];}else{echo"";}?>'></label>
            </p>
            <p>
                <label>&nbsp;<input type='submit' id="submit"></label>
            </p>
            <p>
                <label>Non sei già registrato?<a href="signup.php">SIGNUP</a></label>
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