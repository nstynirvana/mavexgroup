/* Add here all your JS customizations */

if ($(window).width() < 775) {
    $(document).ready(function(){
        $('.footer__contacts').click(function(){
            $('.right-menu-icon_contact').toggleClass('active');
            $('.panel-collapse_contact').slideToggle();
        });
    });
}

// $(document).ready(function(){
//     $('.footer__contacts').click(function(){
//         $('.right-menu-icon_contact').toggleClass('active');
//         $('.panel-collapse_contact').slideToggle();
//     });
// });