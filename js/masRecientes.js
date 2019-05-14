$(document).ready(function(){
    var swiper1 = new Swiper('.swiper-container1', {
        nextButton: '.right1',
        prevButton: '.left1',
        paginationClickable: true,
        slidesPerView: 'auto',
        autoplay: 2500,
        paginationClickable: true,
        spaceBetween: 0,
        autoplayDisableOnInteraction: false,
        slidesPerView: 4,
        breakpoints: {
            1080: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
            725: {
                slidesPerView: 2,
                spaceBetween: 40,
            },
            460: {
                slidesPerView: 1,
                spaceBetween: 40,
            },
        }
        });
    
    $ (".swiper-container1").hover (function () { 
        swiper1.stopAutoplay (); 
    }, function () { 
        swiper1.startAutoplay (); 
    });
            $(".adelante1").click(function(){
                document.getElementById("swiper-button-next1").click();
            });
            $(".atras1").click(function(){
                document.getElementById("swiper-button-prev1").click();
            });

    });