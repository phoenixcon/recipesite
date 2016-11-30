<html>
    <head>
        <title>Legg Family Recipes</title>
        <meta charset="utf-8"  />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="scripts/scripts.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/index.css">
    </head>
    <body>
        <header>
            <h1>Legg Family Recipe Site</h1>
        </header>
        <div class="group">
            <?php

            //CONNECTION TO DATABASE
            include 'scripts/connection-local.php';
            //DECLARE NEEDED ARRAYS
            //$recipelist = array('recipe-list' => array('recipe' => array(array('title' => '', 'credit' => '', 'ingredient' => array(array( 'ingredientname' => '' ),array( 'ingredientname' => '' ),array( 'ingredientname' => '' )), 'instruction' => array(array( 'instruction-step' => '', 'text-description' => '' ),array( 'instruction-step' => '', 'text-description' => '' ),array( 'instruction-step' => '', 'text-description' => '' )), 'tag' => array(array( 'tag-text' => '' ),array( 'tag-text' => '' ),array( 'tag-text' => '' )) ))));

            //SELECT RECIPE NAMES
            $recipe_name_select = "SELECT * FROM recipe_name"; 
            $name_result = mysqli_query($db, $recipe_name_select);
            while ($row = mysqli_fetch_assoc($name_result)) {
                echo '<section class="recipe"><h2 class="recipetitle">'.$row['recipename'].'</h2>';
                $recipe_name=$row['recipename'];

                echo '<section class="credit"><label>Recipe Credit:</label>';
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
                echo '</section>';

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
                    $recipe_instruction_select = "SELECT textdescription FROM recipe_instructions WHERE recipekey='".$recipekey."' ORDER BY instructionstep ASC";
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
                            echo '<span class="tags">'.$tag_row['tagtext'].'</span>';
                        }
                    }
                    echo '</section>';

                }
            }
            mysqli_close($db);
            ?>
        </div>
        <footer><h6>&copy; Midnight Design Group, 2016</h6></footer>
    </body>
</html>