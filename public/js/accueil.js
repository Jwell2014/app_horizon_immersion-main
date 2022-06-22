

//  NAV
const openNavCateg = document.querySelector('.iconeDoc');
const dossier = document.querySelector('.sub-nav');
const openDocuments = document.querySelectorAll('.openDocument');
const subDocsWrapper = document.querySelectorAll('.sub-doc');
const subDocs = document.querySelectorAll('.sub-doc a');
const subDocsApercu = document.querySelectorAll('.sub-sousDoc');

let openDossier= false

//  ICONE AU CLICK OUVRE LES DOSSIERS
openNavCateg.addEventListener('click', (e) => {
    console.log(e);
    openDossier = !openDossier;
    openDossier ? dossier.classList.add('openDossier') : dossier.classList.remove('openDossier');

    subDocsWrapper.forEach((subDocWrapper) =>{
        subDocWrapper.classList.remove('openSousDoc');
    })

    subDocsApercu.forEach((subDocApercu) =>{
        subDocApercu.classList.remove('openApercu');

    } )
});

//  DOSSIER AU CLICK OUVRE LES SOUS-DOSSIER
openDocuments.forEach((openDoc, i) =>{
    openDoc.addEventListener('click', (e) => {
        e.preventDefault();
        console.log('click ' + openDoc.dataset.index);
        console.log(e);

        subDocsWrapper.forEach((subDocWrapper) =>{
            subDocWrapper.classList.remove('openSousDoc');
        })

        subDocsApercu.forEach((subDocApercu) =>{
            subDocApercu.classList.remove('openApercu');

        } )

        subDocsWrapper.forEach((subDocWrapper) => {
            if(subDocWrapper.dataset.index === openDoc.dataset.index){
                subDocWrapper.classList.add('openSousDoc');
                console.log(subDocWrapper)
                subDocs.forEach((subDoc) => {
                    if(subDoc.dataset.index === openDoc.dataset.index){
                        subDoc.addEventListener('click', (e) => {
                            e.preventDefault();
                            subDocsApercu.forEach((subDocApercu) => {
                                if(subDoc.dataset.index === subDocApercu.dataset.index && subDoc.dataset.subindex === subDocApercu.dataset.subindex){
                                    subDocApercu.classList.add('openApercu');
                                }else{
                                    subDocApercu.classList.remove('openApercu');
                                }
                            });
                        });
                    }
                });
            } else{
                subDocWrapper.classList.remove('openSousDoc');


            }
        });
        

    });
})




// script pour le chrono - horloge


let hour = 11;
let minute = 59;
let second = 55;
let millisecond = 0;

let h = 11;
let m = 59;
let s = 55;

let cron;

document.form_main.start.onclick = () => start();
document.form_main.pause.onclick = () => pause();
document.form_main.reset.onclick = () => reset();

function start() {
    console.log("ok");
    pause();
    cron = setInterval(() => {
        timer();
    }, 10);
}

function pause() {
    console.log('ok');
    clearInterval(cron);
}

function reset() {
    hour = 11;
    minute = 59;
    second = 55;
    millisecond = 0;

    h = 11;
    m = 59;
    s = 55;

    document.getElementById('hour').innerText = '11';
    document.getElementById('minute').innerText = '59';
    document.getElementById('second').innerText = '55';

    document.getElementById('h').innerText = '11';
    document.getElementById('m').innerText = '59';
    document.getElementById('s').innerText = '55';


}

function timer() {


    if ((millisecond += 10) === 1000) {
        millisecond = 0;
        second++;
        s++;
    }
    if (second === 60 && s === 60) {
        second = 0;
        s = 0;

        m++;
        minute++;

    }
    if (minute === 60 && m === 60) {
        minute = 0;
        m = 0;

        h++;
        hour++;

    }




    document.getElementById('hour').innerText = returnData(hour);
    document.getElementById('minute').innerText = returnData(minute);
    document.getElementById('second').innerText = returnData(second);

    document.getElementById('h').innerText = returnData(h);
    document.getElementById('m').innerText = returnData(m);
    document.getElementById('s').innerText = returnData(s);


}

function returnData(input) {
    return input >= 10 ? input : `0${input}`
}


// Partie de la modal du menu démarrer

const openMenu = document.querySelector('.imgMenu');
const menu = document.querySelector('.tskbStartMenu');

let invisible = true;

openMenu.addEventListener('click', () => {
    console.log('ok')
    invisible = !invisible;

    invisible ? menu.classList.remove('invisible') : menu.classList.add('invisible');

})
