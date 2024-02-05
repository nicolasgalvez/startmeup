jQuery( document ).ready(function( $ ) {

    // nasty hack to remove empty ul tags in menu for accessibility
    $('#nav-upper ul').not(':has(li)').remove();

    // scroll top
    $("#scroll_top").click(function(){
        $(window).scrollTop(0);
    });

    // Accessibility spacebar
    $('.menu-pop-up').on('keypress', function (event) {

        if (event.code === 'Space') {
            event.preventDefault();

            $('.dropdown-content').each(function() {
                $(this).css('visibility','hidden');
            })

            let background = $(this).siblings('.dropdown-content:first');
            if (background.css('visibility') == 'hidden') {
                background.css('visibility','visible');
            }
        }

        // Close dropdowns on escape
        if (event.code === 'Escape') {
            event.preventDefault();
            $('.dropdown-content').each(function() {
                $(this).css('visibility','hidden');
            })
        }

    });

    // Close all dropdowns on escape
    $(document).on(
        'keydown', function(event) {
            $("a, input, button").focusin(function(){
                $(this).css({'background-color':'#f9de4b', 'display':'inline-block'});
            });

            $("a, input, button").focusout(function(){
                $(this).css({'background-color':'', 'display':''});
            });


            if (event.key == "Escape") {
                $('.dropdown-content').each(function() {
                    $(this).css('visibility','hidden');
                })
            }
        });


    // Tabs
    $('.tab').click(function(e){
        e.preventDefault();
        var container = $(this).closest("div[id]").attr('id');

        var tab_id = $(this).data("id");
        $('#'+container+' .tab').each(function(index, element) {
            $(element).css('background', '#ffffff');
        });
        $(this).css('background', '#DBD5C7');
        $('#'+container+' .tab-content').each(function(index, element) {
            $(element).hide();
        });
        $('#'+container+' .tab-'+tab_id).fadeIn();

    });

    // Video tabs
    $('.video-tab').click (function (e) {
        e.preventDefault();
        var focus_tab = $(this);

        // get some variables
        var slug = $(this).data("id");
        var taxonomy = $('.taxonomy').data();


        $.ajax ({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                action: 'get_videos_ajax',
                slug : slug,
                taxonomy : taxonomy
            },
            success: function (response) {
                // render the html
                $('.video-content-wrapper').html(response.data).fadeIn;

                // reset the tabs
                $('.video-tab').each(function(index, element) {
                    $(element).css('background', '#ffffff');
                });
                focus_tab.css('background', '#DBD5C7');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                // this error case means that the ajax call, itself, failed, e.g., a syntax error
                // in your_function()
                alert ('Request failed: ' + thrownError.message) ;
            },
        }) ;
    });

});
