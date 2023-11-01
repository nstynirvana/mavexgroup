$(document).ready(function () {
    $("#footer .phone.with_dropdown").hover(function (e) {

        var target = $(this)[0];
        var target2 = $(this).find('.dropdown');
        var targetPosition = target.getBoundingClientRect().bottom,
            windowPosition = document.documentElement.clientHeight;
            
        if ( (targetPosition + target2.height()) < windowPosition ) { 
            $("#footer .phone.with_dropdown").addClass("phone-dropdown-tobottom ");
        }
        else {
            $("#footer .phone.with_dropdown").removeClass("phone-dropdown-tobottom ");
        }
    });
}); 