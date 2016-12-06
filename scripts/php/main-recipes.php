<div class="grid-sizer ignore"></div>
<div class="gutter-sizer ignore"></div>

<?php

//CONNECTION TO DATABASE
//include '../../connection/recipe-connection.php';
include '../../../../connection/recipe-connection.php';
//include 'connection-local.php';

//SELECT RECIPE NAMES
$recipe_name_select = "SELECT * FROM recipe_name"; 
$name_result = mysqli_query($db, $recipe_name_select);
while ($row = mysqli_fetch_assoc($name_result)) {
    echo '<div class="recipe grid-item"><h2 class="recipetitle">'.$row['recipename'].'</h2>';
    $recipe_name=$row['recipename'];

    echo '<div class="credit"><label>Recipe Credit:</label>';
    //SELECT RECIPE-CREDIT KEYS
    $recipe_credit_select = "SELECT creditkey FROM recipe_name WHERE recipename='".$recipe_name."'";
    $credit_result = mysqli_query($db, $recipe_credit_select);
    while ($credit_row = mysqli_fetch_assoc($credit_result)) {
        $creditkey=$credit_row['creditkey'];

        //SELECT RECIPE-CREDIT TEXT
        $credit_text_select = "SELECT credittext FROM recipe_credit WHERE creditkey='".$creditkey."'";
        $credit_text_result = mysqli_query($db, $credit_text_select);
        while ($credit_text_row = mysqli_fetch_assoc($credit_text_result)) {
            echo '<span>'.$credit_text_row['credittext'].'</span>';
            $recipes[$recipe_name] = $credit_text_row['credittext'];
        }
    }
    echo '</div>';

    //SELECT MAIN RECIPE-KEYS
    $recipe_key_select = "SELECT recipekey FROM recipe_name WHERE recipename='".$recipe_name."'";
    $key_result = mysqli_query($db, $recipe_key_select);
    while ($key_row = mysqli_fetch_assoc($key_result)) {
        $recipekey=$key_row['recipekey'];

        echo '<ul>';
        //SELECT RECIPE INGREDIENTS
        $recipe_ingredient_select = "SELECT ingredientname FROM recipe_ingredients WHERE recipekey='".$recipekey."'";
        $ingredient_result = mysqli_query($db, $recipe_ingredient_select);
        while ($ingredient_row = mysqli_fetch_assoc($ingredient_result)) {
            echo '<li>'.$ingredient_row['ingredientname'].'</li>';
        }
        echo '</ul><ol>';

        //SELECT RECIPE INSTRUCTIONS
        $recipe_instruction_select = "SELECT textdescription FROM recipe_instructions WHERE recipekey='".$recipekey."'";
        $instruction_result = mysqli_query($db, $recipe_instruction_select);
        while ($instruction_row = mysqli_fetch_assoc($instruction_result)) {
            echo '<li>'.$instruction_row['textdescription'].'</li>';
        }
        echo '</ol>';
        echo '<label>Tags:</label>';
        //SELECT RECIPE-TAG KEYS
        $recipe_tagkey_select = "SELECT tagkey FROM recipe_name_tag WHERE recipekey='".$recipekey."'";
        $tagkey_result = mysqli_query($db, $recipe_tagkey_select);
        while ($tagkey_row = mysqli_fetch_assoc($tagkey_result)) {
            $tagkey = $tagkey_row['tagkey'];

            //SELECT RECIPE-TAG TEXT
            $recipe_tag_select = "SELECT tagtext FROM recipe_tags WHERE tagkey='".$tagkey."'";
            $tag_result = mysqli_query($db, $recipe_tag_select);
            while ($tag_row = mysqli_fetch_assoc($tag_result)) {
                echo '<span class="tags" value="'.$tag_row['tagtext'].'">'.$tag_row['tagtext'].'</span>';
            }
        }
        echo '</div>';

    }
}

mysqli_close($db);

?>