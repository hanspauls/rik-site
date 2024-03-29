$(function() {
    'use strict';
    // Main contact form
    $('#contact').validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            message: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Your name must consist of at least 2 characters"
            },
            email: {
                required: "Please enter your email address"
            },
            message: {
                required: "Please enter your message",
                minlength: "Your message must consist of at least 2 characters"
            }
        },
        submitHandler: function(form) {
            $(form).ajaxSubmit({
                type: "POST",
                data: $(form).serialize(),
                url: "inc/contact.php",
                success: function() {
                    $('#contact :input').attr('disabled', 'disabled');
                    $('#contact').fadeTo("slow", 0.15, function() {
                        $(this).find(':input').attr('disabled', 'disabled');
                        $(this).find('label').css('cursor', 'default');
                        $('#success').fadeIn();
                    });
                },
                error: function() {
                    $('#contact').fadeTo("slow", 0.15, function() {
                        $('#error').fadeIn();
                    });
                }
            });
        }
    });

    // Signup form
    $('#signup').validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 4
            }
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Your name must consist of at least 2 characters"
            },
            email: {
                required: "Please enter your email address"
            },
            password: {
                required: "Please enter your password.",
                minlength: "Password must consist of at least 4 characters"
            }
        }
    });

    // Subscription form
    $('#subscribe:not(.no-validate)').validate({
        rules: {
            subscribe_email: {
                required: true,
                url: true
            }
        },
        errorPlacement: function(error, element) {
            error.appendTo(element.parents(".form-row"));
        },
        messages: {
            subscribe_email: {
                required: "Please enter your email address"
            }
        },
        submitHandler: function(form) {
            var dataToPass = $('#subscribe_email').val();
            $('#product-item').val(dataToPass);
            $('#add-modal').modal();
            // $(form).ajaxSubmit({
            //     type:"POST",
            //     data: $(form).serialize(),
            //     url:"inc/subscribe.php",
            //     success: function() {
            //         $('#subscribe :input').attr('disabled', 'disabled');
            //         $('#subscribe').fadeTo( "slow", 0.15, function() {
            //             $(this).find(':input').attr('disabled', 'disabled');
            //             $(this).find('label').css('cursor','default');
            //             $('#success').fadeIn();
            //         });
            //     },
            //     error: function() {
            //         $('#subscribe').fadeTo( "slow", 0.15, function() {
            //             $('#error').fadeIn();
            //         });
            //     }
            // });
            return false;
        }
    });

});
