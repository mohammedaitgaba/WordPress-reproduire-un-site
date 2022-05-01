(function ($) {
	"use strict";

	

	$(window).load(function() {
      var menu      =  $('#portfoliox-menu');
        menu.slicknav({
        	'allowParentLinks': true,
        	'nestedParentLinks': false,
			'closeOnClick': true,
			'closedSymbol': '&#9658;', // Character after collapsed parents.
			'openedSymbol': '&#9660;', // Character after expanded parents.
        });
	
	$(document).on("click", "#menu-close", function(e) {
		e.preventDefault();
		$(".slicknav_nav").addClass('slicknav_hidden mhide');
	  });
	
		$(".slicknav_menu .slicknav_nav").append('<a id="menu-close" class="slicknav_arrow portfoliox-carrow" href="#menuclose"><i class="fas fa-times"></a></i>');

});
	
    //document ready function
    jQuery(document).ready(function($){
		
		$('body').on("click", function() {
			$(".slicknav_nav").removeClass('mhide');
		  });

		 $("#portfoliox-menu").portfolioxAccessibleDropDown();

        }); // end document ready
		
    	

    	    $.fn.portfolioxAccessibleDropDown = function () {
			    var el = $(this);

			    /* Make dropdown menus keyboard accessible */

			    $("a", el).focus(function() {
			        $(this).parents("li").addClass("hover");
			    }).blur(function() {
			        $(this).parents("li").removeClass("hover");
			    });
			}

}(jQuery));	