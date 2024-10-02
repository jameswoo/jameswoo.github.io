//import * as transition from './transition.js';

const nav = document.querySelector('.nav');
barba.init({
    debug: true,
    transitions: [
        {
            name: 'page-transition',
            once() { },

            async leave() {
                await show();
            },
            enter() {
                hide();
            },
        }
    ],
    views: [
        {
            namespace: 'home',
            beforeEnter() {
                document.querySelector('video').play();
            },
        },
    ],
});

barba.hooks.once((data) => {
    updateNav(data.next.namespace);
    data.next.namespace === 'work' && (nav.style.filter = 'invert(1)');
})
barba.hooks.enter((data) => {
    updateNav(data.next.namespace);
    data.next.namespace === 'work' ? (nav.style.filter = 'invert(1)') : (nav.style.filter = 'invert(0)');
});
const updateNav = (data) => {
    const navPages = document.querySelectorAll('.nav_item_page');
    navPages.forEach((page) => {
        const getData = page.textContent.toLowerCase().includes(data);
        page.classList.remove('--active');
        getData && page.classList.add('--active');
    })
};

const animation = {
    element: document.querySelector('.pt'),
    duration: 0.8,
    ease: 'power4.inOut',
    stagger: 0.048,
};

const cloneBoxes = () => {
    for (i = 0; i < 80; i++) {
        const box = document.createElement('div');
        box.classList.add('pt_box');
        animation.element.append(box);

    }
};

cloneBoxes();

gsap.set('.pt_box', {
    scaleY: 0,
    TransformOrigin: '0% 0%',
});
const tlPage = gsap.timeline({
    defaults: {
        duration: animation.duration,
        ease: animation.ease,
        stagger: {
            grid: [1, 11],
            from: 'random',
            each: animation.stagger,
        },
    },
})
function show() {
    return new Promise((resolve) => {
        tlPage.to('.pt_box', {
            scaleY: 1,
            transformOrigin: '0% 100%',
            onComplete: resolve,
        })
    })
};
function hide() {
    return new Promise((resolve) => {
        tlPage.to('.pt_box', {
            scaleY: 0,
            transformOrigin: '0% 0%',
            onComplete: resolve,
        })
    })
};