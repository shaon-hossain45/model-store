document.addEventListener('DOMContentLoaded', function() {

    var sliderSpeed = document.querySelector('.swiper').getAttribute('data-speed');
    var sliderNav = document.querySelector('.swiper').getAttribute('data-navigation');
    var sliderPag = document.querySelector('.swiper').getAttribute('data-pagination');
    var sliderAutoplay = document.querySelector('.swiper').getAttribute('data-autoplay');
    
    var swiper = new Swiper(".swiper", {
        slidesPerView: 1,
        spaceBetween: 15,
        speed: parseInt(sliderSpeed),
        loop: true,
        // centeredSlides: true,
        autoplay: sliderAutoplay == 1 ? {
            delay: 1500,
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
        breakpoints: {
            // when window width is >= 768px
            768: {
            slidesPerView: 2,
            spaceBetween: 15,
            },
            // when window width is >= 922px
            922: {
            slidesPerView: 3,
            spaceBetween: 15,
            },
            // when window width is >= 922px
            1600: {
                slidesPerView: 4,
                spaceBetween: 15,
            },
        },
        // effect: 'coverflow',
        // coverflowEffect: {
        //     rotate: 30,
        //     slideShadows: false,
        // },
        keyboard: {
            enabled: true,
            onlyInViewport: false,
        },
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