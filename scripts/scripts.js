$(document).ready(function() {

    /*===== FORM SUBMISSION =====*/

    $('form').submit(function(event) {

        //$('.error_text').remove();
        //$('input, select').removeClass('error');
        //$('.success').remove();

        event.preventDefault();
        var form = $('#recipe-submit');
        var formData = form.serialize().replace(/%5B%5D/g, '[]').replace(/%20/g, ' ').replace('°', '&deg;').replace('é', '&eacute;');
        console.log(formData);

        $.ajax({
            type     : 'POST',
            url      : '../scripts/handle.php',
            data     : formData,
            dataType : 'json',
            encode   : true
        })

            .done (function(data) {
            console.log(data);

            if (! data.success) {

                if (data.errors.name) {
                    $('#name_field input').addClass('error');
                    $('#name_field').append('<div class="error_text">Name is required.</div>');

                }

                if (data.errors.recipeexists) {
                    $('form').append('<div class="error_message">'+data.message+'</div>');
                    setTimeout(function(){$('.error').fadeOut(1000);},3000);

                }

                if (data.errors.credit) {
                    $('#credit_field input').addClass('error');
                    $('#credit_field').append('<div class="error_text">Recipe Credit is required.</div>');

                }

                if (data.errors.ingredient) {
                    $('#ingredient_field input').addClass('error');
                    $('#ingredient_field').append('<div class="error_text">At least one Ingredient is required.</div>');

                }

                if (data.errors.instruction) {
                    $('#instruction_field input').addClass('error');
                    $('#instruction_field').append('<div class="error_text">At least one Instruction step is required</div>');

                }

                if (data.errors.tag) {
                    $('#tag_field input').addClass('error');
                    $('#tag_field').append('<div class="error_text">At least one Tag is required.</div>');

                }
            } else {

                $('.success').remove();
                $('form').append('<div class="success">'+data.message+'</div>');
                $('form')[0].reset();
                $('.error_text').remove();
                $('.error_message').remove();
                $('.extra').remove();
                $('input, select').removeClass('error');
                //$('input[type="hidden"]').removeAttr('value');
                setTimeout(function(){$('.success').fadeOut(1000);},3000);
            }

        });

    });

    /*===== END FORM SUBMISSION =====*/

    /*===== ADD FIELDS TO FORM =====*/

    var max_fields          = 20; //maximum input boxes allowed
    var ingredientwrapper   = $("#ingredient_field"); //Ingredient wrapper
    var instructionwrapper  = $("#instruction_field"); //Instruction wrapper
    var tagwrapper          = $("#tag_field"); //Tag wrapper
    var ingredientextra   = $("#ingredient_field .extra:last-child"); //Ingredient Last Added Field
    var instructionextra  = $("#instruction_field .extra:last-child"); //Instruction Last Added Field
    var tagextra          = $("#tag_field .extra:last-child"); //Tag Last Added Field
    var add_ingredient      = $("#add_ingredient"); //Add button ID
    var add_instruction     = $("#add_instruction"); //Add button ID
    var add_tag             = $("#add_tag"); //Add button ID

    var ingredient  = 1; //initial text box count
    var instruction = 1; //initial text box count
    var tag         = 1; //initial text box count

    $('#name_field input').focus();

    $(add_ingredient).click(function(e){ //on add input button click
        e.preventDefault();
        if(ingredient < max_fields){ //max input box allowed
            ingredient++; //text box increment
            $(ingredientwrapper).append('<div><input type="text" name="ingredient[]" class="extra" required/><a href="#" class="extra remove_field">Remove</a></div>');//add input box
            $('#ingredient_field input.extra:last').focus();
        }
    });

    $(add_instruction).click(function(e){ //on add input button click
        e.preventDefault();
        if(instruction < max_fields){ //max input box allowed
            instruction++; //text box increment
            $(instructionwrapper).append('<div><input type="text" name="instruction[]" class="extra" required/><a href="#" class="extra remove_field">Remove</a></div>'); //add input box
            $('#instruction_field input.extra:last').focus();
        }
    });

    $(add_tag).click(function(e){ //on add input button click
        e.preventDefault();
        if(tag < max_fields){ //max input box allowed
            tag++; //text box increment
            $(tagwrapper).append('<div><input type="text" name="tag[]" class="extra" required/><a href="#" class="extra remove_field">Remove</a></div>'); //add input box
            $('#tag_field input.extra:last').focus();
        }
    });

    $(ingredientwrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); ingredient--;
    });

    $(instructionwrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); instruction--;
    });

    $(tagwrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); tag--;
    });

    /*===== END ADD FIELDS TO FORM =====*/

    /*===== GRID LAYOUT JS - MASONRY PLUGIN =====*/

    var masonryOptions = {
        itemSelector: '.grid-item',
        columnWidth: '.grid-sizer',
        percentPosition: true,
        gutter: '.gutter-sizer'
    }

    var $grid = $('.grid').masonry( masonryOptions );

    if ($(window).width()>800) {
        $grid;
    }
    /*===== END GRID LAYOUT JS - MASONRY PLUGIN =====*/

    var masonryOptions = {
        itemSelector: '.grid-item',
        columnWidth: '.grid-sizer',
        percentPosition: true,
        gutter: '.gutter-sizer'
    }

    var $grid = $('.grid').masonry( masonryOptions );

    $('#search').hideseek({
        ignore: '.ignore',
        highlight: true,
        nodata: 'No recipes found'
    });
    $('#search').on("_after", function() {
        $grid.masonry( masonryOptions )
    });

});

