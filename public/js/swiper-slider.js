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
    sliderLoop = (sliderLoop == 1) ? true : false;

    var sliderCenter = document.querySelector('.swiper').getAttribute('data-center');
    sliderCenter = (sliderCenter == 1) ? true : false;
    
    var sliderSpaceBet = document.querySelector('.swiper').getAttribute('data-spacebetween');

    var sliderEffect = document.querySelector('.swiper').getAttribute('data-effect');
    sliderEffect = (sliderEffect == 1) ? 'coverflow' : (sliderEffect == 2) ? 'fade' : (sliderEffect == 3) ? 'flip' : 'slide';

    var slider3D = document.querySelector('.swiper').getAttribute('data-3d');
    

    var swiper = new Swiper(".swiper", {
        slidesPerView: (sliderBreakpoint == 1 || sliderEffect == 2 || sliderEffect == 3) ? 1 : sliderPerview, // Breakpoint dependable
        spaceBetween: (slider3D == 1) ? "-100" : sliderSpaceBet, // 3D dependable
        speed: parseInt(sliderSpeed),
        loop: (slider3D == 1) ? true : sliderLoop, // 3D dependable
        centeredSlides: (slider3D == 1) ? true : sliderCenter, // 3D dependable
        autoplay: (sliderAutoplay == 1) ? {
            delay: sliderAutoplayDelay,
            // pauseOnMouseEnter: true,
            disableOnInteraction: false, // Enable autoplay even on slider interaction (dragging)
        } : false, //ShortenMode by Javascript
        // cssMode: true,
        allowTouchMove:	true,
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
        breakpoints: (sliderBreakpoint == 1) ? {
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
        effect: sliderEffect,
        fadeEffect: (sliderEffect == 2) ? {          
            crossFade: true     // resolve the overlapping of the slides
        } : false,
        flipEffect: (sliderEffect == 3) ? {
            limitRotation: true,
            slideShadows: true,
        } : false,
	    grabCursor: true,
	    coverflowEffect: (slider3D == 1) ? {
		    rotate: 0,
		    depth: 500,
		    modifier: 1,
		    slideShadows: false,
            stretch: 0
	    } : {
            rotate: 30,
            depth: 100,
            modifier: 1,
            scale: 1,
            slideShadows: true,
            stretch: 0
        },
        // keyboard: {
        //     enabled: true,
        //     onlyInViewport: false,
        // },
        // mousewheel: {
        //     invert: true,
        //     forceToAxis: true,
        // },
    });

});