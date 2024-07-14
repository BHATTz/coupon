jQuery(".minileftbar .categoryapp-btn").on('click',function() {
    jQuery(".right_menu .category-app").toggleClass("open stretchRight").siblings().removeClass('open stretchRight');
    if (jQuery(".right_menu .category-app").hasClass('open')) {
        jQuery('.overlay').fadeIn();
    } else {
        jQuery('.overlay').fadeOut();
    }
});
jQuery(".minileftbar .storeapp-btn").on('click',function() {
    jQuery(".right_menu .store-app").toggleClass("open stretchRight").siblings().removeClass('open stretchRight');
    if (jQuery(".right_menu .store-app").hasClass('open')) {
        jQuery('.overlay').fadeIn();
    } else {
        jQuery('.overlay').fadeOut();
    }
});

jQuery(".minileftbar .brandapp-btn").on('click',function() {
    jQuery(".right_menu .brand-app").toggleClass("open stretchRight").siblings().removeClass('open stretchRight');
    if (jQuery(".right_menu .brand-app").hasClass('open')) {
        jQuery('.overlay').fadeIn();
    } else {
        jQuery('.overlay').fadeOut();
    }
});
