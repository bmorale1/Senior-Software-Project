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

            response = $.parseJSON(response);

            if (response.status == "success") {

                console.log(response);

            } else {
                console.log(response);
            }
        }
    });

});