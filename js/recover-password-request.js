$('document').ready(function() {
    /* validation */
    $("#recover-form").validate({
        rules: {

            user_email: {
                required: true,
                email: true
            },
        },
        messages: {

            user_email: "please enter your email address",
        },
        submitHandler: submitForm
    });
    /* validation */

    /* login submit */
    function submitForm() {
        var data = $("#recover-form").serialize();

        console.log(data);

        $.ajax({

            type: 'POST',
            url: 'services/recover-password-handler.php',
            data: data,
            beforeSend: function() {
                $("#response").fadeOut();
                $("#btn-recover").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
            },
            success: function(response) {

                response = $.parseJSON(response);

                if (response.status == 'success') {
                    $("#response").fadeIn(1000, function() {

                        var response_message = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>We've sent a password reset email to your account. Click the link in the email to reset your password.</div>";


                        $("#response").html(response_message);
                        $("#btn-recover").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
                    });
                } else {
                    if (response.reason == 'email') {
                        $("#response").fadeIn(1000, function() {

                            var response_message = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button><strong>That email is not registered to any user, sorry! :(</strong>.</div>"

                            $("#response").html(response_message);
                            $("#btn-recover").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
                        });
                    } else {
                        $("#response").fadeIn(1000, function() {
                            var response_message = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button><strong>An unexpected error has occurred</strong>.</div>"

                            $("#response").html(response_message);
                            $("#btn-recover").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
                        });
                    }



                }
            }
        });
        return false;
    }
    /* login submit */
});