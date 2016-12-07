<div class="grid-sizer ignore"></div>
<div class="gutter-sizer ignore"></div>
<?php

$tag_name = $_POST['buttonname'];

include '../../../../connection/recipe-connection.php'; //mySQL Connection
//include ('connection-local.php');

$tag_key_query = "SELECT tagkey FROM recipe_tags WHERE tagtext='".$tag_name."'";

$tag_check_result = mysqli_query($db, $tag_key_query);

while ($row = mysqli_fetch_assoc($tag_check_result)) {

    $tag_key = $row['tagkey'];

    $tag_to_recipe_query = "SELECT recipekey FROM recipe_name_tag WHERE tagkey='".$tag_key."'";

    $tag_to_recipe_result = mysqli_query($db, $tag_to_recipe_query);

    while ($row = mysqli_fetch_assoc($tag_to_recipe_result)) {

        $recipe_key = $row['recipekey'];

        $recipe_name_query = "SELECT * FROM recipe_name WHERE recipekey='".$recipe_key."'";

        $recipe_name_result = mysqli_query($db, $recipe_name_query);

        while ($row = mysqli_fetch_assoc($recipe_name_result)) {

            echo '<div class="recipe grid-item"><a href="recipe?name='.$row['recipename'].'" target="_blank" title="Open '.$row['recipename'].' in new tab"><i class="material-icons">open_in_new</i></a><h2 class="recipetitle">'.$row['recipename'].'</h2>';
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

    }

}
?>
