/*
 * Spiner in nav
 */
const spinner = document.querySelector('.spinner');
const spinnerButton = document.querySelectorAll('.spinner-line');
const spinerMenu = document.querySelector('.js-menu');

const spinnerClassToggle = () => {
    spinerMenu.classList.toggle('open');
    spinnerButton.forEach((elem) => {
        elem.classList.toggle('active');
    });
};

spinner.addEventListener('click', (event) => {
    event.preventDefault();
    spinnerClassToggle();
});

import IScroll from 'iscroll';

/*
 * Init site i-Scroll
 */
$(document).ready(function () {
    const iscrollPage = document.getElementById('iscroll');
    if (iscrollPage) {
        var myScroll = new IScroll('#iscroll', {
            scrollbars: 'custom',
            interactiveScrollbars: true,
            resizeScrollbars: false,
            disableMouse: true,
            disablePointer: true,
            mouseWheel: true,
            momentum: false,
            fadeScrollbars: true,
            deceleration: 0.001,
            snap: 'section', // <-- that's the key
            bounceEasing: {
                style: 'cubic-bezier(0.25,0.1,0.25,1)',
            }
        });
        let scrollStats = false;
        const oversizeSection = document.querySelector('.oversize');

        $('.anchor-link').click(() => {
            if (event.target.dataset.value) {
                event.preventDefault();
                const target = event.target.dataset.value;
                myScroll.goToPage(0, (target - 1), 1000);
                spinnerClassToggle();
                window.setTimeout(function () {
                    myScroll.enable();
                    scrollStats = true;
                }, 1000);
            }
        });

        BrowserDetect.init();

        //!key click
        $(document).keyup(function (e) {
            if (e.key === 'ArrowUp') {
                myScroll.prev(600)
            } else if (e.key === 'ArrowDown') {
                myScroll.next(600)
            }
        });

        //!scroll start 
        myScroll.on('scrollStart', function (e) {
            // console.log('start');
            function oversizeRefScroll() {
                if ($('.oversize').scrollTop() === 0) {
                    oversizeSection.removeEventListener('scroll', oversizeRefScroll);
                    // myScroll.enable();
                    myScroll.prev()
                    scrollStats = false;
                    window.setTimeout(function () {
                        myScroll.enable();
                        scrollStats = true;
                        console.log('oversizeRefScroll');
                    }, 1100);
                };
            };

            if (!oversizeSection) {
                // console.log('dose not have oversize section');
                myScroll.disable();
                scrollStats = false;
                window.setTimeout(function () {
                    myScroll.enable();
                    scrollStats = true;
                }, 1100);

            } else {
                // console.log('has oversize section');
                if ((myScroll.currentPage.pageY + 1) !== myScroll.options.snap.length) { // we are NOT on oversize page
                    myScroll.disable();
                    scrollStats = false;
                    window.setTimeout(function () {
                        myScroll.enable();
                        scrollStats = true;
                    }, 1100);

                } else {
                    myScroll.disable();
                    oversizeSection.addEventListener('scroll', oversizeRefScroll);
                };
            };

        });

        //!scroll end 
        myScroll.on('scrollEnd', function (e) {
            // console.log('end ', scrollStats);
            if (scrollStats) {
                myScroll.enable();
                scrollStats = true;
            }
            // remove nav on case studies last section
            const nav = document.querySelector('nav');
            const scrollbarIndicator = document.querySelector('.iScrollIndicator');
            if (this.wrapper.parentElement.closest('body').classList.contains('page-template-case-studies')) {
                if (window.innerWidth > 768) {
                    if (this.currentPage.pageY >= this.options.snap.length - 1) {
                        nav.style.display = 'none';
                        scrollbarIndicator.style.opacity = '0';
                    } else {
                        nav.style.display = 'block';
                        scrollbarIndicator.style.opacity = '1';
                    }
                }
                else {
                    nav.style.display = 'block';

                    if (this.currentPage.pageY >= this.options.snap.length - 1) {
                        scrollbarIndicator.style.opacity = '0';
                    }
                    else {
                        scrollbarIndicator.style.opacity = '1';
                    }
                }
            }

        });

        // //!scroll Cancel
        myScroll.on('scrollCancel', function (e) {
            myScroll.enable();
        });

        //!scroll touch mobile
        let touchScrollStart;
        $(document).on('touchstart', function (e) {
            touchScrollStart = e.originalEvent.touches[0].clientY;
        });
        $(document).on('touchend', function (e) {
            let touchScroll = e.originalEvent.changedTouches[0].clientY;
            if (touchScrollStart > touchScroll + 5) {
                myScroll.next()
            } else if (touchScrollStart < touchScroll - 5) {
                myScroll.prev()
                $('.oversize').scrollTop(0);
            }
        });
    }
});

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

/*
 * client-logo REF
 */
const clientLogo = document.querySelectorAll('.client-logo--item');
const clientLogoRef = function () {
    let width = document.body.clientWidth;
    let height = document.body.clientHeight;
    clientLogo.forEach((logo) => {
        // console.log(logo);
        logo.classList.remove('disabled')
    })

    if (width <= 414 && height <= 736) {
        // console.log('width <= 414 && height <= 736');
        for (let i = 0; i < clientLogo.length; i++) {
            if (i >= 8) {
                clientLogo[i].classList.add('disabled')
            }
        }
    }
    if (width <= 415 && height <= 844) {
        // console.log('width <= 415 && height <= 846');
        for (let i = 0; i < clientLogo.length; i++) {
            if (i >= 10) {
                clientLogo[i].classList.add('disabled')
            }
        }
    }

    if (width <= 768 && height <= 1024) {
        for (let i = 0; i < clientLogo.length; i++) {
            if (i >= 21) {
                clientLogo[i].style.display = 'none'
            }
        }
    }
}
clientLogoRef();
$(window).resize(function () {
    clientLogoRef();
});

/*
 * BrowserDetect FU
 */
const BrowserDetect = {
    init: function () {
        this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
        this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator.appVersion) || "an unknown version";
        this.OS = this.searchString(this.dataOS) || "an unknown OS";
        // alert(`broeser ${this.browser}, version ${this.version}, os ${this.OS}`);
        if (this.browser === ('Safari')) {
            $('body').addClass('safari');
        }
    },
    searchString: function (data) {
        for (let i = 0; i < data.length; i++) {
            let dataString = data[i].string;
            let dataProp = data[i].prop;
            this.versionSearchString = data[i].versionSearch || data[i].identity;
            if (dataString) {
                if (dataString.indexOf(data[i].subString) != -1) return data[i].identity;
            } else if (dataProp) return data[i].identity;
        }
    },
    searchVersion: function (dataString) {
        let index = dataString.indexOf(this.versionSearchString);
        if (index == -1) return;
        return parseFloat(dataString.substring(index + this.versionSearchString.length + 1));
    },
    dataBrowser: [{
        string: navigator.userAgent,
        subString: "Chrome",
        identity: "Chrome"
    }, {
        string: navigator.userAgent,
        subString: "OmniWeb",
        versionSearch: "OmniWeb/",
        identity: "OmniWeb"
    }, {
        string: navigator.vendor,
        subString: "Apple",
        identity: "Safari",
        versionSearch: "Version"
    }, {
        prop: window.opera,
        identity: "Opera",
        versionSearch: "Version"
    }, {
        string: navigator.vendor,
        subString: "iCab",
        identity: "iCab"
    }, {
        string: navigator.vendor,
        subString: "KDE",
        identity: "Konqueror"
    }, {
        string: navigator.userAgent,
        subString: "Firefox",
        identity: "Firefox"
    }, {
        string: navigator.vendor,
        subString: "Camino",
        identity: "Camino"
    }, { // for newer Netscapes (6+)
        string: navigator.userAgent,
        subString: "Netscape",
        identity: "Netscape"
    }, {
        string: navigator.userAgent,
        subString: "MSIE",
        identity: "Explorer",
        versionSearch: "MSIE"
    }, {
        string: navigator.userAgent,
        subString: "Gecko",
        identity: "Mozilla",
        versionSearch: "rv"
    }, { // for older Netscapes (4-)
        string: navigator.userAgent,
        subString: "Mozilla",
        identity: "Netscape",
        versionSearch: "Mozilla"
    }],
    dataOS: [{
        string: navigator.platform,
        subString: "Win",
        identity: "Windows"
    }, {
        string: navigator.platform,
        subString: "Mac",
        identity: "Mac"
    }, {
        string: navigator.userAgent,
        subString: "iPhone",
        identity: "iPhone/iPod"
    }, {
        string: navigator.platform,
        subString: "Linux",
        identity: "Linux"
    }]
};
