'use strict';

// /**
//  *  Load modules
//  */

// import echo from './modules/echo.js';
// import '../scss/app.scss';

// import main from './modules/main.js';


// $(document).ready(() => {

//     echo('App ready');
//     main();
// });



// window.addEventListener('scroll', function () {
//     console.log($('.flexible-elements').height());
//     console.log(pageYOffset);
//     if (pageYOffset > 135 && pageYOffset < 0) {
//         console.log('hello');
//     }
// });



/**
 *  Load modules
 */
import echo from './modules/echo.js';
// import './modules/slider.js';
// import './modules/anchor.js';
// import './modules/header-scroll.js';
// import './modules/form.js';
import './modules/main.js';

import '../scss/app.scss';

$(document).ready(() => {
    echo('App ready');
});

