/* Add here all your JS customizations */

if ($(window).width() < 775) {
    $(document).ready(function () {
        $('.footer__contacts').click(function () {
            $('.right-menu-icon_contact').toggleClass('active');
            $('.panel-collapse_contact').slideToggle();
        });
    });
}
/*
$(document).ready(function(){
    $('.sim-slider-list').slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: false,
        speed: 300,
        autoplay: true,
        arrows: true
    });
});*/
$(document).ready(function(){
    $('.slider').slick({
        infinite: true,
        slidesToShow: 1,
        // slidesToScroll: 1,
        dots: true,
        speed: 300,
        autoplay: false,
        arrows: true,
        prevArrow: $('.owl-prev'),
        nextArrow: $('.owl-next'),
        centerMode: true,
        variableWidth: true
    });
});
