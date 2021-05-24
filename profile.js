//const contenitore=document.querySelector('#dash .contenitore');
const content=document.getElementById("articoli");

const contprof=document.getElementById("profilo");
const contpref= document.querySelector('#preferiti .contenitore');
const puser= document.querySelector('#user');
let tuser= puser.textContent;




const percorso = "http://localhost/hw1/";

contenuti();

function contenuti(){
    fetch(percorso + "loadprofilearticle.php").then(onResponse).then(onJsonArticle);
  


contenutipref();
function contenutipref(){
    fetch(percorso + "loadprofilepref.php").then(onResponse).then(onJson);
    
}

function onResponse(response){
    return response.json();
}
function onResponsepref(response){
    return response.json();
}

function onJson(json){
    console.log(json);
    
for( let i=0; i<json.length;i++){
    console.log(json[i]);

    let sezione=document.createElement('div');
    sezione.classList.add('sezione');
    sezione.setAttribute('id',json[i].sezione);
    let interno=document.createElement('div');
    interno.classList.add('interno');
    interno.setAttribute('data-index',json[i].cod_articolo);
    
    let creator = document.createElement('h2');
    creator.textContent = json[i].autore;
    let titolo=document.createElement('h3');
    titolo.textContent=json[i].titolo;
    sezione.appendChild(interno);
    interno.appendChild(creator);
    interno.appendChild(titolo);
    fetch(percorso+"dashpref.php?cod=" + json[i].cod_articolo +"&user="+ tuser).then(onResponsepref).then(onPref);
    
    function onPref(json){
        if(json){
            let preferiti= document.createElement('img');
        preferiti.classList.add('favourites');
        preferiti.src='x.png';
        preferiti.setAttribute('data-switch','on');
        
        preferiti.addEventListener("click",removeContent);
        interno.appendChild(preferiti);
        

        }else{
            let preferiti= document.createElement('img');
        preferiti.classList.add('favourites');
        preferiti.src='add_favourite.png';
        preferiti.setAttribute('data-switch','off');
        preferiti.addEventListener("click",Favourites);
        
        interno.appendChild(preferiti);
        }
    }
    
   
    let down = document.createElement('a');
    down.setAttribute('href',percorso + "upload/"+ json[i].nomefile);
   
    down.textContent= "Download";
    let datap= document.createElement('p');
    datap.textContent= json[i].data_pubblicazione;
    contpref.appendChild(sezione);
    
    
    interno.appendChild(down);
    interno.appendChild(datap);
    if(json[i].username === tuser){
        console.log("ciao");
       
        let rimuovi= document.createElement('button');
        rimuovi.textContent = "Rimuovi elemento";
        interno.appendChild(rimuovi);
        rimuovi.addEventListener('click',removeArticle);
        rimuovi.addEventListener('click',Favourites);
    }

   
}

let contentpre= document.querySelector("#preferiti .contenitore .sezione");
if(contentpre=== null){
let text= document.createElement('span');
text.classList.add('default');
text.textContent="Nessun articolo messo nei preferiti";
        contpref.appendChild(text);
     }
}

function Favourites(event){
    let p= event.currentTarget;
    let pn = p.parentNode;
    let nsezione = pn.dataset.index;
    
    const pnn= pn.parentNode;
    let id= pnn.id;
    
    if( p.dataset.switch === 'off'){
        p.dataset.switch = "on" ;
        fetch(percorso + "addpref.php?cod="+ nsezione + "&user="+tuser).then(onResponse2).then(onAddFav);
        let sezione=document.createElement('div');
        sezione.classList.add('sezione');
        sezione.setAttribute('id',id);
        let interno=document.createElement('div');
       interno.classList.add('interno');
       interno.setAttribute('data-index',nsezione);
        let creator = document.createElement('h2');
        let ct= pn.querySelector('h2');
        creator.textContent = ct.textContent;
       let titolo=document.createElement('h3');
        let tt= pn.querySelector('h3');
        titolo.textContent= tt.textContent;
        let preferiti= document.createElement('img');
        preferiti.classList.add('favourites');
        preferiti.src='x.png';
        interno.appendChild(preferiti);

       let content= document.createElement('a');
        let cnt= pn.querySelector('a');
        let down = cnt.href;
        content.setAttribute('href',down);
        content.textContent= "Download";
        let datap= document.createElement('p');
       let dt= pn.querySelector('p');
        datap.textContent= dt.textContent;
        contpref.appendChild(sezione);
        sezione.appendChild(interno);
        interno.appendChild(creator);
        interno.appendChild(titolo);
        interno.appendChild(preferiti);
        interno.appendChild(content);
        interno.appendChild(datap);
        p.src= 'positive tic.png';
        preferiti.addEventListener('click',removeContent);
        
    } 
}


function onAddFav(text){
    console.log('ciao');
    let mess= document.querySelector("#preferiti .contenitore .default");
    if(mess!==null){
        mess.remove();
    }
    
}



function onJsonArticle(json){
    console.log(json);
    
for( let i=0; i<json.length;i++){
    console.log(json[i]);

    let sezione=document.createElement('div');
    sezione.classList.add('sezione');
    sezione.setAttribute('id',json[i].sezione);
    let interno=document.createElement('div');
    interno.classList.add('interno');
    interno.setAttribute('data-index',json[i].cod_articolo);
    
    let creator = document.createElement('h2');
    creator.textContent = json[i].username;
    let titolo=document.createElement('h3');
    titolo.textContent=json[i].titolo;
    sezione.appendChild(interno);
    interno.appendChild(creator);
    interno.appendChild(titolo);
    fetch(percorso+"dashpref.php?cod=" + json[i].cod_articolo +"&user="+ tuser).then(onResponsepref).then(onPref);
    
    function onPref(json){
        if(json){
            let preferiti= document.createElement('img');
        preferiti.classList.add('favourites');
        preferiti.src='positive tic.png';
        preferiti.setAttribute('data-switch','on');
        preferiti.addEventListener("click",Favourites);
        interno.appendChild(preferiti);
        }else{
            let preferiti= document.createElement('img');
        preferiti.classList.add('favourites');
        preferiti.src='add_favourite.png';
        preferiti.setAttribute('data-switch','off');
        preferiti.addEventListener("click",Favourites);
        interno.appendChild(preferiti);
        }
    }
       
    let down = document.createElement('a');
    down.setAttribute('href',percorso + "upload/"+ json[i].nomefile);
   
    down.textContent= "Download";
    let datap= document.createElement('p');
    datap.textContent= json[i].data_pubblicazione;
    content.appendChild(sezione);
    
    
    interno.appendChild(down);
    interno.appendChild(datap);
    if(json[i].username === tuser){
        console.log("ciao");
       
        let rimuovi= document.createElement('button');
        rimuovi.textContent = "Rimuovi elemento";
        interno.appendChild(rimuovi);
        rimuovi.addEventListener('click',removeArticle);
        rimuovi.addEventListener('click',Favourites);
        }

    }
        let contentsez= document.querySelector("#articoli .sezione");
        if(contentsez=== null){
        let text= document.createElement('span');
        text.textContent="Nessun articolo presente nel database";
                content.appendChild(text)
             }
            }
        }
    


function removeArticle(event){
let p= event.currentTarget;
let pn = p.parentNode;
let pa = pn.parentNode;
const nsezione = pn.dataset.index;
let contenitore = document.querySelector('#preferiti .contenitore');
let interno = contenitore.querySelector('[data-index='+"'"+nsezione+"'" +"]");;
if(interno!==null){
interno.parentNode.remove();
}
fetch(percorso + "deletepref.php?cod="+ nsezione + "&user="+tuser).then(onResponse2).then(onRemove);
fetch(percorso + "eliminacontenuto.php?q=" + tuser + "&d=" + nsezione).then(onResponse1).then(onText);
let divlink = pn.querySelector('a');
let per= divlink.href;
console.log(per);
fetch(percorso + "eliminafile.php?q=" + tuser + "&d=" + nsezione).then(onResponse1).then(onText);
pa.remove();



}

function onResponse1(response){
return response.text();
}
function onText(text){
console.log(text);
}

function removeContent(event){
    const p= event.currentTarget;
    const pn = p.parentNode;
    let ind= pn.dataset.index;
    const sec = document.querySelector('#articoli');
   let sic = sec.querySelector('[data-index='+"'"+ind+"'" +"]");
   if(sic!==null){
   console.log(sic);
    
   
   let logo = sic.querySelector('.favourites');
   console.log(logo);
   logo.src = 'add_favourite.png';
    logo.dataset.switch = "off";
   }
    let contenitore = document.querySelector('#preferiti .contenitore');
    let interno = contenitore.querySelector('[data-index='+"'"+ind+"'" +"]");;
    interno.parentNode.remove();

    fetch(percorso + "deletepref.php?cod="+ ind + "&user="+tuser).then(onResponse2).then(onRemovePref);



    
}

function onResponse2(response){
    return response.text();
}
function onRemove(text){
    console.log(text);
    let contentsez= document.querySelector("#articoli .sezione");
        if(contentsez=== null){
        let text= document.createElement('span');
        text.textContent="Nessun articolo presente nel database";
                content.appendChild(text)
             }
         
             let contentsez1= document.querySelector("#preferiti .contenitore .sezione");
             if(contentsez1=== null){
                content2= document.querySelector("#preferiti .contenitore .default");
                if(content2===null){
                let text= document.createElement('span');
                text.textContent="Nessun articolo messo nei preferiti";
                text.classList.add('default');
                        contpref.appendChild(text)
                     }
                    }
}

function onRemovePref(text){
    console.log(text);
    let contentsez= document.querySelector("#preferiti .contenitore .sezione");
    if(contentsez=== null){
    let text= document.createElement('span');
    text.textContent="Nessun articolo messo nei preferiti";
    text.classList.add('default');
            contpref.appendChild(text)
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