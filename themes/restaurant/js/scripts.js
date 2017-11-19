;
(function ($) {
    $(document).ready(function () {

        $('#datetimepicker2').datetimepicker({
            format: 'LT',
            defaultDate: new Date()
        });

        $('#datetimepicker3').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: new Date(),
        });
         $('.timepicker').datetimepicker({
            format: 'LT',
             defaultDate: new Date()
        });
         $('.daypicker').datetimepicker({
            format: 'YYYY-MM-DD',
             defaultDate: new Date(),
        });


        $('.add-button').append('<button class="fe-menu-button"><span></span></button>');
        var mobSlid = $('.mob-slider');
        if (mobSlid.length > 0) {
            mobSlid.slick({
                responsive: [
                    {
                        breakpoint: 970,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,

                        }
                    }
                ]
            });
        }

        var introSlider = $('.intro-slider');
        if (introSlider.length > 0) {
            introSlider.slick();
        }
        var event = $('.fe-events-slider');
        if (event.length > 0) {
            event.slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,

                        }
                    },
                    {
                        breakpoint: 970,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,

                        }
                    }
                ]
            });
        }
        var body = $('body');
        body.on('click', '.fe-menu-button', function () {
            $(this).toggleClass('fe-menu-button--open');
            $(this).parent().toggleClass('fe-open');
        });

        body.on('click', (function (e) {
            var menu = '.menu-item-has-children';
            var button = '.fe-menu-button';
            if (!$(e.target).is(menu) && $(menu).has(e.target).length === 0 && !$(e.target).is(button)) {
                $('.fe-menu-button--open').removeClass('fe-menu-button--open');
                $('.fe-open').removeClass('fe-open');

            }
        }));


        var map = null;
        var latlng = null;

        $('.acf-map').each(function () {

            // create map
            map = new_map($(this));

        });

        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        directionsDisplay.setMap(map);

        $('.map-form').on('submit', function () {
            calculateAndDisplayRoute(directionsService, directionsDisplay, $('#location').val());
            return false;
        });
        var loc = document.getElementById('location');
        if (loc) {
            initAutocomplete();
        }
    });

    function calculateAndDisplayRoute(directionsService, directionsDisplay, origin) {
        directionsService.route({
            origin: origin,
            destination: latlng,
            travelMode: google.maps.TravelMode.DRIVING
        }, function (response, status) {
            if (status === google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
            } else {
                console.log('Directions request failed due to ' + status);
            }
        });
    }


    function initAutocomplete() {
        new google.maps.places.Autocomplete((document.getElementById('location')));
    }


    function new_map($el) {

        // var
        var $markers = $el.find('.marker');


        // vars
        var args = {
            // zoom: 1,
            center: new google.maps.LatLng(0, 0),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false,
            styles: [
                {
                    "featureType": "administrative",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": "-100"
                        }
                    ]
                },
                {
                    "featureType": "administrative.province",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": 65
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": "50"
                        },
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": "-100"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "all",
                    "stylers": [
                        {
                            "lightness": "30"
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "all",
                    "stylers": [
                        {
                            "lightness": "40"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "hue": "#eeedee"
                        },
                        {
                            "lightness": -25
                        },
                        {
                            "saturation": -97
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "labels",
                    "stylers": [
                        {
                            "lightness": -25
                        },
                        {
                            "saturation": -100
                        }
                    ]
                }
            ]
        };


        // create map
        var map = new google.maps.Map($el[0], args);


        // add a markers reference
        map.markers = [];


        // add markers
        $markers.each(function () {

            add_marker($(this), map);

        });


        // center map
        center_map(map);


        // return
        return map;

    }

    function add_marker($marker, map) {

        // var
        latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));

        // create marker
        var marker = new google.maps.Marker({
            position: latlng,
            map: map
        });

        // add to array
        map.markers.push(marker);

        // if marker contains HTML, add it to an infoWindow
        if ($marker.html()) {
            // create info window
            var infowindow = new google.maps.InfoWindow({
                content: $marker.html()
            });

            // show info window when marker is clicked
            google.maps.event.addListener(marker, 'click', function () {

                infowindow.open(map, marker);

            });
        }

    }

    function center_map(map) {

        // vars
        var bounds = new google.maps.LatLngBounds();

        // loop through all markers and create bounds
        $.each(map.markers, function (i, marker) {

            var latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());

            bounds.extend(latlng);

        });

        // only 1 marker?
        if (map.markers.length == 1) {
            // set center of map
            map.setCenter(bounds.getCenter());
            map.setZoom(16);
        } else {
            // fit to bounds
            map.fitBounds(bounds);
        }

    }

})(jQuery);

function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function validatePhone(phone) {
    var re = /^[-+0-9()\s]+$/;
    return re.test(phone);
}
function validationForm() {
    var inputFirstname = $('#booking_firstname');
    var firstname = inputFirstname.val();
    var haveErrors = false;

    if (firstname.length > 0) {
        inputFirstname.next('.with-errors').html('');

    } else {
        inputFirstname.next('.with-errors').html('Firstname is required.');
        haveErrors = true;
    }

    var inputLastname = $('#booking_lastname');
    var lastname = inputLastname.val();

    if (lastname.length > 0) {
        inputLastname.next('.with-errors').html('');

    } else {
        inputLastname.next('.with-errors').html('Lastname is required.');
        haveErrors = true;
    }
    var inputEmail = $('#booking_email_address');
    var email = inputEmail.val();
    if (email.length > 0) {
        if (validateEmail(email)) {
            inputEmail.next('.with-errors').html('');
        } else {
            inputEmail.next('.with-errors').html("Valid email is required.");
            haveErrors = true;
        }
    } else {
        inputEmail.next('.with-errors').html("Email is required.");
        haveErrors = true;
    }

    var inputPhone = $('#booking_phone');
    var phone = inputPhone.val();
    if (phone.length > 0) {
        if (validatePhone(phone)) {
            inputPhone.next('.with-errors').html('');

        } else {
            inputPhone.next('.with-errors').html('Valid phone is required.');
            haveErrors = true;

        }
    } else {
        inputPhone.next('.with-errors').html("Phone is required.");
        haveErrors = true;
    }

    var inputMessage = $('#reservation_request');
    var message = inputMessage.val();
    if (message.length > 0) {
        inputMessage.next('.with-errors').html('');
    } else {
        inputMessage.next('.with-errors').html('Message is required.');
        haveErrors = true;
    }

    return haveErrors;
}