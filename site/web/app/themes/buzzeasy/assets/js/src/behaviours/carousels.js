import $ from 'jquery';
import 'slick-carousel';

$('.js-carousel').slick({
    mobileFirst: true,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    dots: true,

    responsive: [
        {
            breakpoint: 768,
            settings: {
                draggable: false
            }
        },
    ]
});

$('.logo-carousel').slick({
    mobileFirst: true,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    dots: true,

    responsive: [
        {
            breakpoint: 600,
            settings: {
                slidesToScroll: 3,
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToScroll: 4,
                slidesToShow: 4,
            }
        },
        {
            breakpoint: 1382,
            settings: {
                draggable: false,
                slidesToScroll: 3,
                slidesToShow: 5,
            }
        },
    ]
});
