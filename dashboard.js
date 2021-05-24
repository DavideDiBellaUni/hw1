const contenitore=document.querySelector('#dash .contenitore');
const contpref= document.querySelector('#preferiti .contenitore');
const puser= document.querySelector('#user');
let tuser= puser.textContent;
let t;

const percorso = "http://localhost/hw1/";
contenuti();
function contenuti(){
    fetch(percorso + "loadcontent.php").then(onResponse).then(onJson);
    
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
        contenitore.appendChild(sezione);
        
        
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
   
}

function removeArticle(event){
    let p= event.currentTarget;
    let pn = p.parentNode;
    let pa = pn.parentNode;
    const nsezione = pn.dataset.index;
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


function Favourites(event){
    let p= event.currentTarget;
    let pn = p.parentNode;
    let nsezione = pn.dataset.index;
    
    const pnn= pn.parentNode;
    let id= pnn.id;
    
    if( p.dataset.switch === 'off'){
        p.dataset.switch = "on" ;

        fetch(percorso + "addpref.php?cod="+ nsezione + "&user="+tuser).then(onResponse2).then(onAddFav);
    p.src= 'positive tic.png';
    
} else{
        p.dataset.switch = 'off';
        fetch(percorso + "deletepref.php?cod="+ nsezione + "&user="+tuser).then(onResponse2).then(onRemove);
        p.src='add_favourite.png';
    }
    
}


function onResponse2(response){
    return response.text();
}

function onAddFav(text){
    console.log('ciao');
};

function onRemove(text){
    console.log('ciao');
};

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