<?php
require_once('db.php');
session_start();
if(!isset($_SESSION["username"])){
    header("Location: home.php");
    exit;
} 

if(isset($_POST["titolo"]) && isset($_POST["sezione"])){
    if(isset($_FILES['testo']) && is_uploaded_file($_FILES['testo']['tmp_name'])){


        $ext_ok = array('doc', 'docx',);
        $temp = explode('.', $_FILES['testo']['name']);
        $ext = end($temp);
        if (in_array($ext, $ext_ok)) {
            $responsoExt=true;
        }else{
            $responsoExt=false;
            $erroreEstensione=true;
        }
        
        if($responsoExt==true){
        if ($_FILES['testo']['size'] > 2097152) {
            $responsoSize=false;
          }else{
            $responsoSize=true;
        }
        }else{
            $responsoSize=true;
        }
        $target_file = 'upload/' . $_FILES['testo']['name'];
        if (file_exists($target_file)) {
         $responsosovr=false; 
        }else{
            $responsosovr=true;
        }
            $uploaddir = 'upload/';
        
        //Recupero il percorso temporaneo del file
        $userfile_tmp = $_FILES['testo']['tmp_name'];
        
        //recupero il nome originale del file caricato
        $userfile_name = $_FILES['testo']['name'];
        if($responsoSize==true && $responsoExt==true && $responsosovr==true){
            
            $responsoUpload=move_uploaded_file($userfile_tmp, $uploaddir . $userfile_name);
            }else{
            $responsoUpload=false;
        }
        }else{
            $responsoUpload=false;
        }
        
    $conn = mysqli_connect($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']);
    $titolo = mysqli_real_escape_string($conn, $_POST["titolo"]);
    $sezione = mysqli_real_escape_string($conn, $_POST["sezione"]);
    $username = $_SESSION["username"];
    $nomefile = mysqli_real_escape_string($conn,$_FILES['testo']['name']);
   
    $date = date("Y/m/d");

        
    if($responsoUpload==true && $responsoSize==true && $responsoExt==true){
        mysqli_query($conn, "INSERT INTO articolo(username,sezione,titolo,nomefile,data_pubblicazione) VALUES(\"$username\",\"$sezione\",\"$titolo\",\"$nomefile\",\"$date\");");
        mysqli_close($conn);
        header("Location: dashboard.php");
    }




}
?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="nart.css"/>
    <link href="http://fonts.cdnfonts.com/css/coolvetica-2" rel="stylesheet">
    <script type="text/javascript" src="nart.js" defer></script>
    <meta charset="UTF-8">
   
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

        </nav>


        <div id="title">
            <img src="111.png"/>
        <h1>Vogliamo esprimere un concetto</h1>

            
        </div>
        </div>
    </header>

    <section>
    <div id= "contreg">
<div class= "contenitore">
<h1 id="registrazione">CREA UN ARTICOLO</h1>
    <main>
   
    
        <form enctype="multipart/form-data"  name='sign' method='post'>
            <p>
                <label>Titolo:<input type='text' name='titolo'></label>
                <span id= "ResponsoUtente"><span>
            </p>
            <p>
                <label>Articolo:<input type='file' name='testo'></label>
            </p>
            <p>
               <label>Sezione: <input type=radio name='sezione' value="Attualita">Attualità</input>
                               <input type=radio name='sezione' value="Lifestyle">Lifestyle</input>
                               <input type=radio name='sezione' value="Arte">Arte e Cultura</input>
                               <input type=radio name='sezione' value="Musica">Musica</input>
                </label>
            <p>
                <label>&nbsp;<input type='submit' id="submit"></label>
                <?php
        // Verifica la presenza di errori
        if(isset($errore))
        {
            echo "<p class='errore'>";
            echo "Errore con le credenziali, non sono valide.";
            echo "</p>";
        } if(isset($erroreEstensione))
        {
            echo "<p class='errore'>";
            echo "Errore con l'estensione,sono valide solo .doc e .docx";
            echo "</p>";
        }
        if(isset($responsosovr))
        {
            echo "<div class='errore'>";
            echo "Esiste già un file con lo stesso nome,rinominare il file prima di caricarlo";
            echo "</div>";
        }
    ?>
            </p>
        </form>
    </main>
</div>
</div>

      
  </section>  
  <footer>
        <span>Seguici su Instagram!
        <a id="insta" href="https://www.instagram.com/concept.ava/"><img src="insta.png"/></a></span>
       <span> Davide Di Bella O46001877</span>
    </footer>
  </body>
  </html>