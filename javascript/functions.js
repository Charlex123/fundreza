$(document).ready(function(){
    
    "use strict";
    // DL Menu
    if ($('#dl-menu').length) {
        $('#dl-menu').dlmenu();
    };

    // Progrees bar for Team single page
    if ($('.progress .progress-bar').length) {
        $('.progress .progress-bar').css("width",
            function() {
                return $(this).attr("aria-valuenow") + "%";
            }
        )
    };

    if ($('.btn-select').length) {
        // 0 = hide, 1 = visible
        var menuState = 0;
        var btn_selector = $(".mini-menu-options");
        //if($(".mini-menu-options").is(":hidden")) {
        /* Add a Click event listener to btn-select */
        $(".btn-select").on("click", function() {
            if (menuState === 0) {
                btn_selector.slideDown("slow");
                menuState = 1;
            } else {
                btn_selector.slideUp("slow");
                menuState = 0;
            }
        });
        setTimeout(function(){
            $('#filters li:nth-child(1)').children("span").click();
        }, 100);
    };

    // Owl Carousel
    if ($('.owl-carousel').length) {
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoplay: true,
            autoplayTimeout: 5000,

            slideSpeed: 10000,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        })
    };

    if ($('.owl-carousel2').length) {
        $('.owl-carousel2').owlCarousel({
            loop: true,
            margin: 10,
            pagination: false,
            dots: false,
            nav: false,
            autoplay: true,
            autoplayTimeout: 5000,

            // slideSpeed: 10000,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 4
                },
                1000: {
                    items: 5
                }
            }
        })
    };
    $(".owl-prev").html('<i class="fa fa-long-arrow-left"></i>');
    $(".owl-next").html('<i class="fa fa-long-arrow-right"></i>');

    // Tabs Home Page
    if ($('.responsive-tabs').length) {
        $('.responsive-tabs').responsiveTabs({
            accordionOn: ['xs', 'sm']
        });
    };

    if ($('#click').length) {
        $('#click').click();
    };

    if ($('.owl-carousel').length) {
        $('.owl-carousel').owlCarousel();
    };

    if ($('ul.nav li.dropdown').length) {
        $('ul.nav li.dropdown').hover(function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
        }, function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
        });
    };

    //bootstrap slider home page
    if ($('#bootstrap-touch-slider').length) {
        $('#bootstrap-touch-slider').bsTouchSlider();
    };

});

//contact us Map
function initMap() {
    // Styles a map in night mode.
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: 53.3572,
            lng: -1.4736
        },
        zoom: 12,
        styles: [{
                elementType: 'geometry',
                stylers: [{
                    color: '#242f3e'
                }]
            },
            {
                elementType: 'labels.text.stroke',
                stylers: [{
                    color: '#242f3e'
                }]
            },
            {
                elementType: 'labels.text.fill',
                stylers: [{
                    color: '#746855'
                }]
            },
            {
                featureType: 'administrative.locality',
                elementType: 'labels.text.fill',
                stylers: [{
                    color: '#d59563'
                }]
            },
            {
                featureType: 'poi',
                elementType: 'labels.text.fill',
                stylers: [{
                    color: '#d59563'
                }]
            },
            {
                featureType: 'poi.park',
                elementType: 'geometry',
                stylers: [{
                    color: '#263c3f'
                }]
            },
            {
                featureType: 'poi.park',
                elementType: 'labels.text.fill',
                stylers: [{
                    color: '#6b9a76'
                }]
            },
            {
                featureType: 'road',
                elementType: 'geometry',
                stylers: [{
                    color: '#38414e'
                }]
            },
            {
                featureType: 'road',
                elementType: 'geometry.stroke',
                stylers: [{
                    color: '#212a37'
                }]
            },
            {
                featureType: 'road',
                elementType: 'labels.text.fill',
                stylers: [{
                    color: '#9ca5b3'
                }]
            },
            {
                featureType: 'road.highway',
                elementType: 'geometry',
                stylers: [{
                    color: '#746855'
                }]
            },
            {
                featureType: 'road.highway',
                elementType: 'geometry.stroke',
                stylers: [{
                    color: '#1f2835'
                }]
            },
            {
                featureType: 'road.highway',
                elementType: 'labels.text.fill',
                stylers: [{
                    color: '#f3d19c'
                }]
            },
            {
                featureType: 'transit',
                elementType: 'geometry',
                stylers: [{
                    color: '#2f3948'
                }]
            },
            {
                featureType: 'transit.station',
                elementType: 'labels.text.fill',
                stylers: [{
                    color: '#d59563'
                }]
            },
            {
                featureType: 'water',
                elementType: 'geometry',
                stylers: [{
                    color: '#17263c'
                }]
            },
            {
                featureType: 'water',
                elementType: 'labels.text.fill',
                stylers: [{
                    color: '#515c6d'
                }]
            },
            {
                featureType: 'water',
                elementType: 'labels.text.stroke',
                stylers: [{
                    color: '#17263c'
                }]
            }
        ]
    });
}