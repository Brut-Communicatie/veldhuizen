const headerMenu = document.getElementById('header-menu');
const hamburger = document.getElementById('hamburger');
const closeMenu = document.getElementById('close-menu');
let showing = false;
hamburger.addEventListener('click', () => {
    if (!showing) {
        headerMenu.classList.add('header__show');
    } else {
        headerMenu.classList.remove('header__show');
    }
    showing = !showing;
});

closeMenu.addEventListener('click', () => {
    if (!showing) {
        headerMenu.classList.add('header__show');
    } else {
        headerMenu.classList.remove('header__show');
    }
    showing = !showing;
});