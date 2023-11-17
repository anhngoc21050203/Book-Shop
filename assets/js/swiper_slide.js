document.addEventListener("DOMContentLoaded", function () {
    // Chờ tài liệu được tải hoàn toàn

    // Khởi tạo Swiper cho '.new_swiper'
    let swiperNew = new Swiper('.new_swiper', {
        loop: true,
        spaceBetween: 16,
        slidesPerView: 'auto',
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        breakpoints: {
            1150: {
                slidesPerView: 3,
            }
        }
    });

    // Khởi tạo Swiper cho '.footer_swiper'
    let swiperFooter = new Swiper('.footer_swiper', {
        loop: true,
        spaceBetween: 16,
        grabCursor: true,
        slidesPerView: 'auto',
        disableOnInteraction: false,
    
    
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
    },
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },

    
    });
});