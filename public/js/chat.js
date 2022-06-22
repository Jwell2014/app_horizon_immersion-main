const modalBtn = document.querySelector('[data-toggle=modalChat]');
let modal = document.querySelector('#modalChat');

let openModal = false;

modalBtn.addEventListener('click', () => {
    openModal = !openModal
    // on affiche la modal
    openModal ?  modal.classList.add('show') : modal.classList.remove('show');

});

document.querySelector('.modalChat-close').addEventListener('click', () =>{
    // on efface la modal
    modal.classList.remove('show')
});

modal.addEventListener('click', () => {
    // au click sur le fond gris on efface la modal
    modal.classList.remove('show');
});

modal.children[0].addEventListener('click', function (e){
    // on evite que le click sur le fond gris debord sur notre modal
    e.stopPropagation();
});