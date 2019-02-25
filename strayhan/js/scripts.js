jQuery(document).ready(function($) {
	
    // DISABLE DEFAULT ACTION FOR LINKS WITH HREF="#"	
    $('a[href="#"]').click(function(e) { e.preventDefault(); });

    $('.wrapper').css('padding-bottom', $('footer').outerHeight());

    // WRAPS ALL SELECT TAGS IN A DIV FOR STYLING
    $('select:not([multiple]').wrap('<div class="select-container"></div>');
    $('select[multiple="multiple"]').wrap('<div class="select-container select-container-multiple"></div>');

    // INITIALIZE WOW.JS
    // http://mynameismatthieu.com/WOW/docs.html -> How to Use WOW.js
    // https://daneden.github.io/animate.css/ -> Available Animations
    new WOW().init();

    

});

    // TOGGLE MOBILE MENU ON CLICK
    $(document).on('click', '#mobile-nav-btn', function(event) {
	if($('.mobile-menu').hasClass('active')) {
	    $('.mobile-menu').removeClass('active'); 
	    $('#mobile-nav-btn').removeClass('active'); 
	} else {
	    $('.mobile-menu').addClass('active');
	    $('#mobile-nav-btn').addClass('active');  
	}
    });