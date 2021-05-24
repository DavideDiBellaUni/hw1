
let c;
const percorso = "http://localhost/hw1/"
const qb = document.querySelector('#quote h3');
let section = document.querySelector('#quote');
qb.addEventListener('click',quoteDay);
let div = document.createElement('div');
    div.classList.add('motivational');
    div.classList.add('hidden');
    section.appendChild(div);

function quoteDay(event){
        let m = document.querySelector('.motivational');
        m.classList.remove('hidden');
        if(m !== null){
            m.innerHTML = '';
        }
    fetch('https://api.quotable.io/random').then(onResponse).then(onJson);
}
function onJson(json){

	c= encodeURIComponent(json.content);
    let hf= document.createElement('h1');
    hf.textContent = decodeURI(json.author);
    div.appendChild(hf);
    fetch(percorso+'apitradotto.php?c='+c).then(onResponse).then(onJsonTradotto);
   

}

function onResponse(response){
    return response.json();
}



function onJsonTradotto(json){
	console.log(json);
    let hf= document.createElement('h2');
    encodeURIComponent(json.responseData.translatedText);
    hf.textContent = decodeURI(json.responseData.translatedText);
    div.appendChild(hf);

}


const bottone = document.querySelector("#cerca");
bottone.addEventListener('click', search);

//funzione ricerca
function search(event) {
    event.preventDefault();

    //mi prendo il nome della traccia
    let track = encodeURIComponent(document.getElementById("track").value);
    console.log("Cerco: " + track);
    fetch(percorso + "spotifAPIresult.php?tr="+track).then(onResponse).then(onJsonSpotify);

}


function onResponse(response) {
    console.log("l'API ha tornato un responso positivo");
    return response.json();
}

const ContenitoreTrack = document.getElementById("MusicContainer");
function onJsonSpotify(json) {
    console.log(json);

    //azzero la lista 
    ContenitoreTrack.innerHTML = "";
    const risultati = json.tracks.items;
    if (risultati == null) {
        console.log(risultati);
    }
    let numeroRis = json.tracks.total;
    console.log("ho trovato " + numeroRis + " risultati");

    if (numeroRis > 10) {
        numeroRis = 12;
    }
    for (let i = 0; i < numeroRis; i++) {


       let frame = document.createElement('iframe');
       console.log(risultati[i].id);
       frame.setAttribute('src',"https://open.spotify.com/embed/track/"+ risultati[i].id);
       frame.setAttribute('width',"300");
       frame.setAttribute('height',"380");
       frame.setAttribute('frameborder',"0");
       frame.setAttribute('allowtransparency',"true");
       frame.setAttribute('allow',"encrypted-media");
       ContenitoreTrack.appendChild(frame);
     


    }
}