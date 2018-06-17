
    // search dropdown

    $('.search')
        .dropdown()
    ;

    // close message

    $('.message .close')
        .on('click', function() {
            $(this)
                .closest('.message')
                .transition('fade')
            ;
        })
    ;

    // auto hide message

    window.setTimeout(function() {
        $(".success-message").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 3000);

    // auto position toggle

    var $body = $('body');
    $body.on('resize', function () {
        if ($body.outerWidth <= 991) {
            $('.nav_menu').find('.nav.toggle').css('padding-left', 0);
        }
    });

    // image upload preview

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#avatar-preview').attr('src', e.target.result);
                $('#avatar-preview').hide();
                $('#avatar-preview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#avatar-upload").change(function() {
        readURL(this);
    });