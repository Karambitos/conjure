if ($('#simple-bar')) {
    /*
    * Lazy-load
    */
    const images = document.querySelectorAll('.lazy');
    const options = {
        rootMargin: '50px',
    }
    function handleImg(myImg, observer) {
        myImg.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target
                loadImage(img);
                observer.unobserve(img);
            };
        });
    };
    function loadImage(image) {
        image.src = image.getAttribute('data');
    };
    const observer = new IntersectionObserver(handleImg, options);
    images.forEach(img => {
        observer.observe(img);
    });

    /*
    * backToTop / seeMore buttons
    */
    const backToTop = document.querySelector('.back-to-top-cont');
    const scrollTrigger = document.querySelector('.scroll-trigger')
    const shadowBottomBox = document.querySelector('.sticky-container');
    const seeMoreBTN = document.querySelector('.sticky-container-link');
    const seeMoreBTNBottom = document.querySelector('.bottom-link-section')

    $('.sticky-container-link').click(function () {
        let scrollDown = innerHeight + (innerHeight * 0.30);
        $('.simplebar-content-wrapper').animate({
            scrollTop: scrollDown
        }, 200);
        return false;
    });
    $('.back-to-top-cont').click(function () {
        $('.simplebar-content-wrapper').animate({
            scrollTop: 0
        }, 200);
        return false;
    });
    $(document).on('scroll', function () {
        console.log(pageYOffset);
        if (pageYOffset >= 550) {
            backToTop.style.opacity = '1';
            seeMoreBTN.style.opacity = '0';
            scrollTrigger.style.opacity = '0';
        } else {
            backToTop.style.opacity = '0';
            seeMoreBTN.style.opacity = '1';
            scrollTrigger.style.opacity = '1';
        }
    });

    /*
    *  Toggle bottom shadow
    */
    const observBottomSeeMore = new IntersectionObserver((entryes, observe) => {
        entryes.forEach(entry => {
            if (entry.isIntersecting) {
                shadowBottomBox.classList.remove('active');
                console.log(entry.intersectionRatio);
            } else {
                shadowBottomBox.classList.add('active');
            }
        });
    });
    observBottomSeeMore.observe(seeMoreBTNBottom);
}

////////////////////


const myElement = document.getElementById('simple-bar');
if (myElement) {
    new SimpleBar(myElement, { autoHide: false });
}
const simpleBarWrapper = document.querySelector('.simplebar-content-wrapper');
// lazy load & scroll fade in fade out
if (document.body.classList.contains('page-template-case-studies-cards')) {
    const allVerticalCards = document.querySelectorAll('.card-vertical-lazy');
    allVerticalCards[0].classList.add('card-first');
    allVerticalCards[allVerticalCards.length - 1].classList.add('card-last');
    const carsLazyLoad = document.querySelectorAll('.card-vertical-lazy');
    const overlay = document.querySelector('.sticky-container');
    const seeMoreBtn = document.querySelector('.sticky-container-link');
    const firstCardElement = document.querySelector('.card-first');
    const lazyContainer = document.querySelector('.lazy-load-all');
    const containerGap = document.querySelector('.lazy-flexible');
    const backTotop = document.querySelector('.back-to-top-cont');
    const backTotopHeight = Number((getComputedStyle(backTotop).height).replace('px', ''));

    const lozyObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry, index) => {
            const card = entry.target;
            const img = entry.target.querySelector('img');
            if (entry.isIntersecting) {
                img.src = img.dataset.src;
                card.classList.add('card-vertical-loaded');
            } else {
                return;
            }
            lozyObserver.unobserve(card);

        });
    }, {
        threshold: 0.3
    });

    carsLazyLoad.forEach(card => {
        lozyObserver.observe(card);
    });

    // function
    const scrollToSecondRow = () => {
        const getContainerPadding = getComputedStyle(lazyContainer).paddingTop;
        const containerPadding = Number(getContainerPadding.replace('px', ''));
        // take gap size from css style
        const gap = getComputedStyle(containerGap).gridGap.slice(0, 2);

        // take gap to number
        const gridGapNumb = Number(gap);
        const scrollHeight = (firstCardElement.clientHeight * 2) + (containerPadding + gridGapNumb + backTotopHeight);

        // scroll point
        //simpleBarWrapper.scroll(0, scrollHeight, 'smooth');
        simpleBarWrapper.scroll({
            top: scrollHeight,
            left: 0,
            behavior: 'smooth'
        });
        backTotop.classList.add('back-to-top-cont-active');

    }

    // event listeners
    seeMoreBtn.addEventListener('click', scrollToSecondRow);

    backTotop.addEventListener('click', () => {
        backTotop.classList.remove('back-to-top-cont-active');
        simpleBarWrapper.scroll({
            top: 0,
            left: 0,
            behavior: 'smooth'
        });
    });

    window.addEventListener('DOMContentLoaded', () => {
        simpleBarWrapper.scroll({
            top: 0,
            left: 0,
            behavior: 'smooth'
        });
    });

    // scroll

    simpleBarWrapper.addEventListener('scroll', (event) => {
        const firstTrigger = document.querySelector('.card-first').getBoundingClientRect().height;

        if (firstTrigger) {
            if (simpleBarWrapper.scrollTop > firstTrigger) {
                overlay.classList.add('sticky-container-remove');
            } else {
                overlay.classList.remove('sticky-container-remove');

            }

            if (simpleBarWrapper.scrollTop < firstTrigger) {
                backTotop.classList.remove('back-to-top-cont-active');
            } else {
                backTotop.classList.add('back-to-top-cont-active');
            }
        }

    });

    const lastElementObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {

            if (entry.target.classList.contains('card-last')) {

                if (entry.isIntersecting) {
                    overlay.classList.add('hide-at-bottom');
                } else {
                    overlay.classList.remove('hide-at-bottom');
                }
            }

        });
    }, {
        threshold: 0.5
    });

    carsLazyLoad.forEach(card => {
        lastElementObserver.observe(card);
    });

}
