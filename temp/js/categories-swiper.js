var swiperCatAlt = new Swiper('.swiper-container-category-alt', {
    slidesPerView: 6,
    spaceBetween: 10,
    loop: false, // Отключаем бесконечный цикл
    navigation: {
      nextEl: '.swiper-button-next-alt',
      prevEl: '.swiper-button-prev-alt',
    },
    breakpoints: {
      1200: {
        slidesPerView: 6,
      },
      992: {
        slidesPerView: 4,
      },
      768: {
        slidesPerView: 3,
      },
      576: {
        slidesPerView: 2,
      },
      320: {
        slidesPerView: 1,
      }
    },
  });