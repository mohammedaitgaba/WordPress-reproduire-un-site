jQuery(function($){
    if( !$.trim( $('.wp-travel-trip-detail').html() ).length ) {
        $('.wp-travel-trip-detail').addClass( 'empty' );
    };

    // featured trip slider
    $('.featured-trip-slider').owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        dots: true,
        //autoHeight: true,
        autoplay: false,
        // autoplayTimeout:5000,
        // autoplayHoverPause:false,
        navText: [wenTravelOptions.iconNavPrev,wenTravelOptions.iconNavNext],
        responsive:{
            0:{
                items:1
            },
            668:{
                items:2
            },
            1000:{
                items:3
            }
        }
    })

    // popular trip slider
    $('.featured-trip-slider-grid').owlCarousel({
        loop:true,
        nav:true,
        dots: true,
        autoplay: false,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        navText: [wenTravelOptions.iconNavPrev,wenTravelOptions.iconNavNext],
        responsive:{
            0:{
                items:1
            },
            768:{
                items: 2
            }   
        }
    })
});
