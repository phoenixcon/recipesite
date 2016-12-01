$(document).ready(function() {
    var max_fields          = 20; //maximum input boxes allowed
    var ingredientwrapper   = $("#ingredient_field"); //Ingredient wrapper
    var instructionwrapper  = $("#instruction_field"); //Instruction wrapper
    var tagwrapper          = $("#tag_field"); //Tag wrapper
    var add_ingredient      = $("#add_ingredient"); //Add button ID
    var add_instruction     = $("#add_instruction"); //Add button ID
    var add_tag             = $("#add_tag"); //Add button ID
   
    var ingredient  = 1; //initial text box count
    var instruction = 1; //initial text box count
    var tag         = 1; //initial text box count
    
    $(add_ingredient).click(function(e){ //on add input button click
        e.preventDefault();
        if(ingredient < max_fields){ //max input box allowed
            ingredient++; //text box increment
            $(ingredientwrapper).append('<div><input type="text" name="ingredient[]" required/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(add_instruction).click(function(e){ //on add input button click
        e.preventDefault();
        if(instruction < max_fields){ //max input box allowed
            instruction++; //text box increment
            $(instructionwrapper).append('<div><input type="text" name="instruction[]" required/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(add_tag).click(function(e){ //on add input button click
        e.preventDefault();
        if(tag < max_fields){ //max input box allowed
            tag++; //text box increment
            $(tagwrapper).append('<div><input type="text" name="tag[]" required/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
   
    $(ingredientwrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); ingredient--;
    })
    
    $(instructionwrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); instruction--;
    })
    
    $(tagwrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); tag--;
    })
});