const modalBtn = document.querySelector('[data-toggle=modalChat]');
let modal = document.querySelector('#modalChat');

modalBtn.addEventListener('click', () => {
    // on affiche la modal
    modal.classList.add('show');
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