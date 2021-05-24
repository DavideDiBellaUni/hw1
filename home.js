let contenitore=document.querySelector(' section .contenitore');
let sezioni=['sezione1','sezione2','sezione3','sezione4'];
const ricerca = document.getElementById('searchTab');
let immagini=[];
let titoli=[];
let classe=[];
let favourites= [];


for(let content of contents){
    immagini.push(content.immagine);
    titoli.push(content.titolo_sezione);
    classe.push(content.classe);
}

let i=0;
for (sezione of sezioni){
        sezione=document.createElement('div');
        sezione.classList.add('sezione');
        sezione.setAttribute('id',classe[i]);
        let interno=document.createElement('div');
        interno.classList.add('interno');
        interno.setAttribute('data-index',i+1);
        let immagine=document.createElement('img');
        let titolo=document.createElement('h3');
        immagine.src=immagini[i];
        contenitore.appendChild(sezione);
       
        sezione.appendChild(interno);
        interno.appendChild(immagine);
        
        titolo.textContent=titoli[i];
        interno.appendChild(titolo);
        let paragrafo=document.createElement('p');
        paragrafo.textContent='Mostra di più';
        paragrafo.classList.add('md');
        paragrafo.addEventListener("click",mostraDettagli);
        interno.appendChild(paragrafo);


        i=i+1;
}


function mostraDettagli(event){
    const p =event.currentTarget;
    const pn = p.parentNode;
    
    const nsezione=pn.dataset.index;
    if(p.textContent==='Mostra di più'){
       
        p.textContent='Mostra di meno';
        const descrizione=document.createElement('p');
        pn.appendChild(descrizione);
        descrizione.textContent=contents[nsezione-1].descrizione;

    }else{
       
        p.textContent='Mostra di più';
        pn.lastChild.remove();
    
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







