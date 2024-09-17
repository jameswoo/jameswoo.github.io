const section = document.querySelector('.section');
const sectionContainer = document.querySelector('.section_container');
const sectionCol = document.querySelectorAll('.section_col');
const sectionCaption = document.querySelectorAll('.section_col_caption');

const isDesktop = window.matchMedia('(min-width: 768px)');
const init = () => {
    if (isDesktop.matches) addDesktopListeners();
}



const addDesktopListeners = () => {
    sectionCol[0].classList.add('active');
    sectionCol.forEach((col, index) => {
        col.addEventListener('mouseenter', () => {
            sectionCol.forEach((el) => el.classList.remove('active'));
            col.classList.add('active');
            if (index === col.length - 1) {
                col.classList.add('active');
            }
        });
    });
}

init();

const menu = document.querySelector('.menu');
const menuItems = document.querySelectorAll('.menu_list');
const menuItemsAnchor = document.querySelectorAll('.menu_list_item');
const openButton = document.querySelector('.menu_open');
const closeButton = document.querySelector('.menu_close');

const tl = gsap.timeline({
    paused: true,
    defaults: {
        duration: 0.92,
        ease: 'expo.inOut'
    }
});
const initMenu = () => {
    gsap.set(menu, { pointerEvents: 'none', autoAlpha: 0 });
    gsap.set(menuItems, { autoAlpha: 0 });
    gsap.set(menuItemsAnchor, { x: 0, stagger: 0.016 });
    tl.to(
        menu, {
        pointerEvents: 'auto', stagger: 0.02, autoAlpha: 1
    }, 0
    ).to(menuItems,
        { autoAlpha: 1 }, 0.08
    ).to(menuItemsAnchor,
        { x: 0, stagger: 0.016 });

    tl.to('.app', {
        x: '-50rem',
    }, 0).to('.section_header div', {
        autoAlpha: 0,
    }, 0).to('body', {
        backgroundColor: '#111111',
        overflow: 'hidden',
        pointerEvents: 'none',
    }, 0.2)
}

const open = () => {
    tl.play();
    menu.style.pointerEvents = 'auto';
}
const close = () => {
    tl.reverse();
    menu.style.pointerEvents = 'none';
}

openButton.addEventListener('click', open);
closeButton.addEventListener('click', close);

initMenu()