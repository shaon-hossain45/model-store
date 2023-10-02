document.addEventListener('DOMContentLoaded', function() {

    var sliderPerview = document.querySelector('.swiper').getAttribute('data-perview');
    var sliderBreakpoint = document.querySelector('.swiper').getAttribute('data-breakpoint');

    var sliderBreakPhone = document.querySelector('.swiper').getAttribute('data-breakphone');
    var sliderBreakTablet = document.querySelector('.swiper').getAttribute('data-breaktablet');
    var sliderBreakDesktop = document.querySelector('.swiper').getAttribute('data-breakdesktop');
    var sliderBreakLargeScreen = document.querySelector('.swiper').getAttribute('data-breaklargescreen');


    var sliderSpeed = document.querySelector('.swiper').getAttribute('data-speed');
    var sliderNav = document.querySelector('.swiper').getAttribute('data-navigation');
    var sliderPag = document.querySelector('.swiper').getAttribute('data-pagination');
    var sliderAutoplay = document.querySelector('.swiper').getAttribute('data-autoplay');
    var sliderAutoplayDelay = document.querySelector('.swiper').getAttribute('data-autoplay-delay');
    var sliderLoop = document.querySelector('.swiper').getAttribute('data-loop');
    
    var swiper = new Swiper(".swiper", {
        slidesPerView: (sliderBreakpoint == 1) ? 1 : sliderPerview,
        spaceBetween: 15,
        speed: parseInt(sliderSpeed),
        loop: (sliderLoop == 1) ? true : false,
        // centeredSlides: true,
        autoplay: sliderAutoplay == 1 ? {
            delay: sliderAutoplayDelay,
            // pauseOnMouseEnter: true,
            disableOnInteraction: false, // Enable autoplay even on slider interaction (dragging)
        } : false, //ShortenMode by Javascript
        // cssMode: true,
        // allowTouchMove:	true,
        pagination: {
            enabled: (sliderPag == 1) ? true : false, //ShortenMode by Javascript
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true,
            dynamicBullets: true,
        },
        initialSlide: 2,
        navigation: {
            enabled: (sliderNav == 1) ? true : false, //ShortenMode by Javascript
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: sliderBreakpoint == 1 ? {
            // when window width is >= 0px
            0: {
                slidesPerView: sliderBreakPhone,
            },
            // when window width is >= 768px
            768: {
                slidesPerView: sliderBreakTablet,
            },
            // when window width is >= 922px
            922: {
                slidesPerView: sliderBreakDesktop,
            },
            // when window width is >= 922px
            1600: {
                slidesPerView: sliderBreakLargeScreen,
            },
        } : false, //ShortenMode by Javascript,
        effect: 'coverflow',
        coverflowEffect: {
            rotate: 30,
            slideShadows: true,
        },
        // keyboard: {
        //     enabled: true,
        //     onlyInViewport: false,
        // },
        // mousewheel: {
        //     invert: true,
        //     forceToAxis: true,
        // },
        // parallax: true,
        // scrollbar: {
        //     // el: '.swiper-scrollbar',
        //     // hide: true,
        //     draggable: true,
        // },
        // zoom: {
        //     maxRatio: 5,
        // },
    });

});