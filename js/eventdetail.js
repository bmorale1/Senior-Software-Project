var eventid;
$('document').ready(function() {
    
    var queryString = decodeURIComponent(window.location.search);
    console.log(queryString.substring(1));
    queryString = queryString.substring(1);
    $.ajax({
        type: 'GET',
        url: '/services/events.php',
        data: queryString,
        async: true,
        dataType: 'json'
        

    }).done(function(data){
        var value = data.events["0"]
        eventid = value.id;
        console.log(data);
        $(".left.split").append(
            "<p>What?</p></br><h2 id='what'> "+value.title+"</h2><br><p>Where?</p><br><h2 id='where'>"+value.venue.name+",<br>"+value.venue.city+","+
            value.venue.country+"</h2><br><p>When?</p><br>"
        );

        var date = new Date(value.datetime_local);
                
        if(value.time_tbd){
            $(".left.split").append(
                "<h2 id='when'>Time: TBA<br>Estimated date:  "+date.getDate()+"/"+(date.getMonth()+1)+"/"+
                date.getFullYear()+"</h2>"
                ); 
        }else{
            $(".left.split").append(
                "<h2 id='when'>Time: "+ formatAMPM(date)
                +"<br>Date:  "+date.getDate()+"/"+(date.getMonth()+1)+"/"+
                date.getFullYear()+"</h2>"
                );
        }

        console.log(value.performers["0"].image)

        $(".right.split").append(
            "<div id='eventImg'> <img src='" + value.performers["0"].image + "'></div>"
        );

        initMap(value.venue.location.lat, value.venue.location.lon);

        

    });
});


function initMap(latitude, longitude) {
    // Map options
    console.log(latitude);
    var options = {
        zoom: 15,
        center: { lat: latitude, lng: longitude }
    }

    // New map
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: { lat: parseFloat(latitude), lng: parseFloat(longitude) }
    });
    var infowindow = new google.maps.InfoWindow();
    var geocoder = new google.maps.Geocoder;
    var service = new google.maps.places.PlacesService(map);
    var marker = new google.maps.Marker({
        position: { lat: parseFloat(latitude), lng: parseFloat(longitude) },
        map: map
    });

    /* latitude = marker.getPosition().lat();
    longitude = marker.getPosition().lng(); */
    var latlng = { lat: parseFloat(latitude), lng: parseFloat(longitude) };
    
    geocoder.geocode({ 'location': latlng }, function (results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            if (results[1]) {
                //console.log(results[1].place_id);
                service.getDetails({
                    placeId: results[1].place_id
                }, function (place, status) {
                    if (status === google.maps.places.PlacesServiceStatus.OK) {
                        google.maps.event.addListener(marker, 'click', function () {
                            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' +
                                'Place ID: ' + place.place_id + '<br>' +
                                place.formatted_address + '</div>');
                            infowindow.open(map, this);
                        });
                    }
                });
            } else {
                window.alert('No results found');
            }
        } else {
            //window.alert('Geocoder failed due to: ' + status);
        }
    });

    

}

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

function formatAMPM(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
}


function saveEvent(){
    var data = getCookie('SessionToken')
    $.ajax({
        type: 'GET',
        url: '/services/bookmark.php?token=' + data + '&event_id=' + eventid,
        beforeSend: function() {
            // Do stuff
        },
        success: function(response) {

            response = $.parseJSON(response);

            if (response.status == "success") {

                console.log(response);

            } else {
                console.log(response);
            }
        }
    });
}