document.addEventListener("DOMContentLoaded", function () {
  var swiperGallery = new Swiper(".swiper-gallery", {
    slidesPerView: 1,
    spaceBetween: 5,
    //speed: 1500,
    navigation: {
      enabled: true,
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      // when window width is >= 0px
      0: {
        slidesPerView: 2,
      },
      // when window width is >= 768px
      768: {
        slidesPerView: 3,
      },
      // when window width is >= 922px
      922: {
        slidesPerView: 4,
      },
      // when window width is >= 922px
      1600: {
        slidesPerView: 5,
      },
    },
    allowTouchMove: true,
    keyboard: {
      enabled: true,
      onlyInViewport: false,
    },
    mousewheel: false,
  });
});
