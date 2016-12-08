$(document).ready(function() {

    /*===== GRID LAYOUT JS - MASONRY PLUGIN =====*/

    var data = '';
    $.ajax({
        type     : 'POST',
        url      : 'scripts/php/main-recipes.php',
        data     : data,
        dataType : 'html',
        encode   : false
    })

        .done (function(data) {
        $('.grid').html(data);
        /*if ($(window).width()>800) {
            $grid.masonry('destroy');
            $grid.masonry( masonryOptions );
        }*/
        $grid.masonry('destroy');
        $grid.masonry( masonryOptions );
    });

    var masonryOptions = {
        itemSelector: '.grid-item',
        columnWidth: '.grid-sizer',
        percentPosition: true,
        gutter: '.gutter-sizer'
    }

    var $grid = $('.grid').masonry( masonryOptions );

    /*===== REFRESH MASONRY AFTER SEARCH =====*/

    $('#search').hideseek({
        ignore: '.ignore',
        highlight: true,
        nodata: 'No recipes found'
    });
    $('#search').on("_after", function() {
        $grid.masonry( masonryOptions )
    });

    /*===== END GRID LAYOUT JS - MASONRY PLUGIN =====*/
    
    
    /*===== TAGS FILTERING =====*/
    
    $(document).on('click', '.tags', function(event) {
        var buttonname = $(this).attr('value');
        var data = 'buttonname=' + buttonname;
        $.ajax({
            type     : 'POST',
            url      : 'scripts/php/tags.php',
            data     : data,
            dataType : 'html',
            encode   : false
        })

            .done (function(data) {
            $('.grid').html(data);
            $grid.masonry('destroy');
            $grid.masonry( masonryOptions );
        });

    });

    $(document).on('click', '#viewall', function(event) {
        var buttonname = $(this).attr('value');
        var data = 'buttonname=' + buttonname;
        $.ajax({
            type     : 'POST',
            url      : 'scripts/php/main-recipes.php',
            data     : data,
            dataType : 'html',
            encode   : false
        })

            .done (function(data) {
            $('.grid').html(data);
            $grid.masonry('destroy');
            $grid.masonry( masonryOptions );
        });

    });
    
    /*===== END TAGS FILTERING =====*/
    
    /*===== OPTIONS MENU =====*/

    $('#sidemenu div').load('scripts/php/taglist.php');

    function openNav() {
        $( '#sidemenu' ).css( 'width', '250px' );
        $( '#sidemenu' ).css( 'padding', '60px 20px 0' );
        $( '.menu' ).css( 'opacity', '0' );
        $( 'body' ).css( 'overflow-y', 'hidden' );
        $( '#openmenu' ).css( 'opacity', '0.75' ).css('width', '100%').css('height', '100%').css('z-index', '2');
    }

    function closeNav() {
        $( '#sidemenu' ).css( 'width', '0px' );
        $( '#sidemenu' ).css( 'padding', '60px 0 0' );
        $( '.menu' ).css( 'opacity', '1' );
        $( 'body' ).css( 'overflow-y', 'scroll' );
        $( '#openmenu' ).css('opacity', '0').css('width', '0').css('height', '0').css('z-index', '0');
    }

    $(document).on('click', '.menu span', openNav )
    $(document).on('click', '.closebtn', closeNav )
    $(document).on('click', '#openmenu', closeNav )
    
    /*===== END OPTIONS MENU =====*/
    
    /*===== URL QUERY PARAMETERS =====*/

    function getQueryVariable(variable)
    {
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i=0;i<vars.length;i++) {
            var pair = vars[i].split("=");
            if(pair[0] == variable){return pair[1];}
        }
        return(false);
    }
    
    console.log(getQueryVariable("recipe"));
    
    /*===== END URL QUERY PARAMETERS =====*/

});



