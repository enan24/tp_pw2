$(document).ready(function(){
    var swiper2 = new Swiper('.swiper-container2', {
        nextButton: '.right2',
        prevButton: '.left2',
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
    
    $ (".swiper-container2").hover (function () { 
        swiper2.stopAutoplay (); 
    }, function () { 
        swiper2.startAutoplay (); 
    });
            $(".adelante2").click(function(){
                document.getElementById("swiper-button-next2").click();
            });
            $(".atras2").click(function(){
                document.getElementById("swiper-button-prev2").click();
            });
        
        
    //Hover Productos////////
     $(".cajaDatos").css({
        transition: 'all 0.3s',
    });


    });

