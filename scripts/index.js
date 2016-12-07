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
        if ($(window).width()>800) {
            $grid.masonry('destroy');
            $grid.masonry( masonryOptions );
        }
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

});

/* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
    function openNav() {
        //document.getElementById("sidemenu").style.width = "250px";
        $( '#sidemenu' ).css( 'width', '250px' );
        $( '.menu' ).css( 'opacity', '0' );
    }

    /* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
    function closeNav() {
        //document.getElementById("sidemenu").style.width = "0";
        $( '#sidemenu' ).css( 'width', '0px' );
        $( '.menu' ).css( 'opacity', '1' );
    }

