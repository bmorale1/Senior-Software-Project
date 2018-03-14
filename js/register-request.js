$('document').ready(function() {
    /* validation */
    $("#register-form").validate({
        rules: {
            password: {
                required: true,
            },
            user_email: {
                required: true,
                email: true
            },
            user_name: {
                required: true,
            },
        },

        messages: {
            password: {
                required: "please enter your password"
            },
            user_email: "please enter your email address",
            user_name: "please enter your name",
        },
        submitHandler: submitForm
    });
    /* validation */

    /* login submit */
    function submitForm() {
        var data = $("#register-form").serialize();

        $.ajax({

            type: 'POST',
            url: 'services/register-handler.php',
            data: data,
            beforeSend: function() {
                $("#response").fadeOut();
                $("#btn-register").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
            },
            success: function(response) {

                response = $.parseJSON(response);

                if (response.status == 'success') {

                    $("#response").fadeIn(1000, function() {
                        $("#response").html('Registration Successful!');
                        $("#btn-register").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Register');
                    });
                } else {
                    if (response.reason = 'email') {
                        $("#response").fadeIn(1000, function() {
                            $("#response").html('Registration Failed! Email is already in use.');
                            $("#btn-register").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Register');
                        });
                    } else {
                        $("#response").fadeIn(1000, function() {
                            $("#response").html('Registration Failed! Unknown Error Occurred');
                            $("#btn-register").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Register');
                        });
                    }
                }
            }
        });
        return false;
    }
    /* login submit */
});