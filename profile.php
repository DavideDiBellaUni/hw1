<?php
require_once('db.php');
session_start();
if(!isset($_SESSION["username"])){
    header("Location: home.php");
    exit;
} 
?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="dashboard.css"/>
    <link href="http://fonts.cdnfonts.com/css/coolvetica-2" rel="stylesheet">
    <meta charset="UTF-8">
    <script type="text/javascript" src="profile.js" defer></script>  
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concept</title>
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
                <a href= "dashboard.php">Home</a>
                <a href="profile.php">Profilo</a>
                <a href= "logout.php">Logout </a>
              </div>
    
              <div id="menu">
            <div id="arancio"></div>
            <div id="bordeaux"></div>
            <div id="verde"></div>
            <div id="blue"></div>
          </div>
        </nav>

        <div id= "navscrollbar">
        <a href= "dashboard.php">Home</a>
        <a href="profile.php">Profilo</a>
         <a href= "logout.php">Logout </a>
      </div>
        <div id="title">
            <img src="111.png"/>
        <h1>Vogliamo esprimere un concetto</h1>
        
        </div>
    </header>

    <section>
      

      <h1>Profilo di <?php echo($_SESSION["username"])?> </h1>

      <div id=profile></div>

      <div id= "nart">
            <a href="nart.php">Esprimi il tuo concetto</a>
        </div>
        <div id="dash">
        <h1>Articoli prodotti:</h1>
        <div id="articoli"></div>
        <div id=preferiti>
        <h1>I tuoi preferiti:</h1>
      <div class="contenitore"></div>
      </div>
      </div>

      
      <p id= "user" class="hidden"><?php echo $_SESSION["username"]?></p>
  </section>  
  </body>
  </html>