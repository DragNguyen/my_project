
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
        $(".success.message").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 3000);
