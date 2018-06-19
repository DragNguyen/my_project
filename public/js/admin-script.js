
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

    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#product-avatar-preview').attr('src', e.target.result);
                $('#product-avatar-preview').hide();
                $('#product-avatar-preview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#product-avatar-upload").change(function() {
        readURL2(this);
    });

    function readURL3(input) {
        if (!input.files) {
            return;
        }
        var fileLength = input.files.length;
        var ul = document.getElementById('product-image');
        while (ul.children.length > 0) {
             ul.removeChild(ul.childNodes[0]);
        }
        for (var i = 0; i < fileLength; i++) {
            let li = document.createElement('li');
            li.innerHTML = input.files[i].name;
            ul.appendChild(li);
        }
    }
    $("#product-image-upload").change(function() {
        readURL3(this);
    });

    // tab

    $('.menu .item')
        .tab()
    ;

    $('#context1 .menu .item')
        .tab({
            context: $('#context1')
        })
    ;