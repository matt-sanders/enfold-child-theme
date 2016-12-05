jQuery(function($){

    //watch for changes on the search
    var searchClass = 'search-active';
    $('.input_wrap #s')
        .blur(function(){
            $('body').removeClass(searchClass);
        })
        .focus(function(){
            $('body').addClass(searchClass);
        });


    setTimeout(function(){
        //add the sub menu to the advanced menu
        var mobileAdvanced = $('#mobile-advanced');
        var searchMenuElem = $('<li class="menu-item" id="mobile-advanced-search"></li>')
                .prependTo(mobileAdvanced);
        $('.phone-info')
            .clone()
            .appendTo(searchMenuElem);
        
        var newMenuElem = $('<li class="menu-item" id="mobile-advanced-sub-menu"></li>')
                .appendTo(mobileAdvanced);
        $('#harcourts-header-search-wrapper')
            .clone()
            .appendTo(newMenuElem);
    }, 0);

    $('#advanced_menu_toggle').click(function(){
        setTimeout(function(){
            if ( $('body').hasClass('show_mobile_menu') ){
                $('body').removeClass('show_mobile_menu');
                $('#wrap_all').removeClass('show_mobile_menu');
            }
        },100);
    });

    $('body').on('click', '#mobile-advanced li.menu-item-has-children > a', function(e){
        var elem = $(this);
        var parent = elem.closest('li.menu-item-has-children');

        if ( parent.hasClass('active') ) {
            parent.removeClass('active');
            return true;
        }

        e.preventDefault();
        $('body').addClass('show_mobile_menu');
        parent.addClass('active');
    });
    
});
