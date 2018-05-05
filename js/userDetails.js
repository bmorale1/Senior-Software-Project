$('document').ready(function() {
    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    var data = getCookie('SessionToken');


    console.log(data);
    $.ajax({
        type: 'GET',
        url: '/services/profile.php?token=' + data,
        beforeSend: function() {
            // Do stuff
        },
        success: function(response) {

            //response = $.parseJSON(response);

            if (response.status == "success") {

                console.log(response);
                $("#email").append(
                    response.profile.Email
                );
                $("#name").append(
                    response.profile.FirstName + " " + response.profile.LastName
                );
                $("#location").append(
                    response.profile.City + ", " + response.profile.State + " " + response.profile.PostalCode
                );

                displayEvents(response.events);

            } else {
                console.log("Response is:" + response);
                $('#main').empty();
                $('#main').append(
                    "Unexpected error try again!"
                );
            }


        }
    });
});

function displayEvents(data) {
    if (data != "") {

        $.ajax({
            type: 'GET',
            url: '/services/events.php',
            data: "id=" + data,
            async: true,
            dataType: 'json'

        }).done(function(response) {
            console.log(response);

            // initMap();
            var marker;
            var infowindow = new google.maps.InfoWindow();

            initMap();

            $(response.events).each(function(index, value) {

                console.log(value.id);

                $('#eventsMenu').append(
                    "<a href='javascript:void(0);' onclick='eventdetail(" + value.id + ")'>" + value.short_title + "</a>"
                );



                var myLatLng = { lat: value.venue.location.lat, lng: value.venue.location.lon };

                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(value.venue.location.lat, value.venue.location.lon),
                    map: map,
                });

                google.maps.event.addListener(marker, 'click', (function(marker) {
                    return function() {
                        infowindow.setContent(value.title);
                        infowindow.open(map, marker);
                    }
                })(marker));


                map.panTo(marker.getPosition());

            });



        });



    }
}

var map;

function initMap() {
    var options = {
        zoom: 15,
        center: { lat: -25.363, lng: 131.044 }
    }

    // New map
    map = new google.maps.Map(document.getElementById('map'), options);
}

function eventdetail(eventid) {
    var queryString = "?id=" + eventid;
    window.location.href = "../eventPage.html" + queryString;
}