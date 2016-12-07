$(document).ready(function() {

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
    
    //console.log(getQueryVariable("recipe"));
    
    /*===== END URL QUERY PARAMETERS =====*/
    
    /*===== GENERATE CONTENT FROM QUERY PARAMETERS =====*/
    
    if (getQueryVariable('name')) {
        var recipename = getQueryVariable('name').replace(/%20/g, ' ');
        var data = 'recipename=' + recipename;
        console.log(recipename);
        console.log(data);
        
        $.ajax({
            type     : 'POST',
            url      : '../scripts/php/recipe.php',
            data     : data,
            dataType : 'html',
            encode   : false
        })

            .done (function(data) {
            $('.recipe-contain').html(data);
        });
        
    } else {
        $('.recipe').html("<h1>There's nothing here. Try again.</h1>");
    }
    
    /*===== END GENERATE CONTENT FROM QUERY PARAMETERS =====*/

});



