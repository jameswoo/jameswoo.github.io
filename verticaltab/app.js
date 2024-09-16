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