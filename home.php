<?php
require_once('db.php');
session_start();
if(isset($_SESSION["username"])){
    header("Location: dashboard.php");
    exit;
} 
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="home.css"/>
    <link href="http://fonts.cdnfonts.com/css/coolvetica-2" rel="stylesheet">
    <meta charset="UTF-8">
    <script type="text/javascript" src="home.js" defer ></script>
    <script type="text/javascript" src="contents.js" ></script>
    <script type="text/javascript" src="api.js" defer></script>
    
    
   
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

        </div>
    </header>
    <section>
      

        <h1>Benvenuti su Concept!</h1>
        <h2>Concept è una pagina Instagram di stampo giornalistico. <br>
            Ogni giorno vengono pubblicati post con vari argomenti, raggruppati in 4 sezioni
        
    </h2>
   
    
        <div class="contenitore"></div>

        <div class= "ArtContainer">
        <div id= "quote">
            <h2>La mission di Concept verte anche sull'ispirazione giornaliera</h2>
            <h3>Lasciati inspirare.</h3>
        </div>
        </div>

        <div class="SpotifAPI">
        <div id= "quoteSpotifAPI">
            <h2>Dove le parole non arrivano...la musica parla</h2>
        </div>
        <form>
            <img src= "splogo.png">
            <p>Inserisci un artista o una traccia</p>
            <input type='text' id='track'>
            <input type='submit' id='cerca' value='Cerca'>
          </form>
    
          <div id="MusicContainer"></div>
        </div>
    </section>

    <footer>
        <span>Seguici su Instagram!
        <a id="insta" href="https://www.instagram.com/concept.ava/"><img src="insta.png"/></a></span>
       <span> Davide Di Bella O46001877</span>
    </footer>

</body>
</html>