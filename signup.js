input = document.forms["sign"];
input.addEventListener("submit", validazioneform);
input.username.addEventListener("blur", controlloUser);
input.email.addEventListener("blur", validazione_email);
input.password.addEventListener("blur", verificaPassword);
const percorso = "http://localhost/hw1/";

let validFormJson = false;
let validFormEmail = false;
let validFormPass = false;
let formisValid = false;



function validazione(event) {
    const box = document.querySelector(".contenitore p");
    box.innerHTML ='';

    if (input.name.value.length == 0 || input.surname.value.length == 0 || input.email.value.length == 0 || input.username.value.length == 0 || input.password.value.length == 0) {
        
        event.preventDefault();
        box.textContent = "Compilare tutti i campi";
        return;
          
    } 
    
    

}





function controlloUser() {
    const q = input.username.value;
    if(q===""){
        const box = document.getElementById("ResponsoUtente");
        box.innerHTML ='';
        box.textContent = "Inserisci username!";
        validFormJson=false;
    }else{
    fetch(percorso + "check_user.php" + "?q="+ q).then(statusUser).then(checkJson);
    }
}

function checkJson(json){
    console.log(json);
    const box = document.getElementById("ResponsoUtente");
    if(json){
        box.innerHTML ='';
    box.textContent = "Username disponibile!"; 
    validFormJson= true;
    }else{
        box.innerHTML ='';
    box.textContent = "Username non disponibile";
    validFormJson = false;
    }
}

function statusUser(response){
    return response.json();
}


function validazione_email(event) {
    let reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    
    
    if (!reg.test(event.currentTarget.value)){ 
        console.log("if");
        document.getElementById("correctmail").innerHTML = "Inserire email correttamente";
        validFormEmail = false;
    }else{
        console.log("else")
        document.getElementById("correctmail").innerHTML = "Email corretta";
        validFormEmail = true;
    }
}



function verificaPassword() {  
    const pw = input.password.value;   
    if(pw === "") {  
       document.getElementById("message").innerHTML = "Inserisci una password";  
       validFormPass = false;
    } else if(pw.length < 8) {  
       document.getElementById("message").innerHTML = "La password deve avere minimo 8 caratteri";  
       validFormPass = false; 
    }  else if(pw.length > 15) {  
       document.getElementById("message").innerHTML = "La password può avere massimo 15 caratteri";  
       validFormPass = false; 
    } else{
        document.getElementById("message").innerHTML = "La password inserita è valida";
        validFormPass = true;
    }  
  }  


  function validazioneform(event){
      formisValid = true;
      if(validFormPass && formisValid && validFormEmail && validFormJson){
          validazione();
      }else{
          let mess = document.querySelector('#contreg .validazione');
          mess.innerHTML="";
          mess.textContent="Inserire i dati correttamente!";
          event.preventDefault();
          
      }
  }

  let mostra = document.getElementById('menu');
mostra.addEventListener('click',mostraMenu);

function mostraMenu(){
    document.getElementById('navscrollbar').style.display = 'flex';
    document.body.classList.add('no-scroll');
    
    mostra.removeEventListener('click',mostraMenu);
    mostra.addEventListener('click',closeMenu);
}

function closeMenu(){
    console.log('ciccio');
    document.getElementById('navscrollbar').style.display = 'none';
    document.body.classList.remove('no-scroll');
    mostra.removeEventListener('click',closeMenu);
    mostra.addEventListener('click',mostraMenu);
}