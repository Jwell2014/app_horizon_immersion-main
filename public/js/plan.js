let btns = document.querySelectorAll('.button');
let spans = document.querySelectorAll('.d1');

let hidden = true;

btns.forEach( btn => {
    btn.addEventListener('click', () => {
        spans.forEach(span => {
            span.classList.add('hidden')
        });
        btn.querySelector('span').classList.toggle('hidden');
    });
});