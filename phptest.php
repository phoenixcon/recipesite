<?php
$username = 'root';
$password = 'root';
$host = 'localhost';

$db = mysqli_connect($host,$username,$password,'recipes')
    or die('Unable to Connect');
?>


<html>
    <head>
        <title>Legg Family Recipes</title>
        <meta charset="utf-8"  />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="scripts/scripts.js"></script>
        <link rel="stylesheet" type="text/css" href="css/index.css">
    </head>
    <body>
        <?php

        //SELECT RECIPE NAMES
        $recipe_name_select = "SELECT * FROM recipe_name"; 
        $name_result = mysqli_query($db, $recipe_name_select);
        while ($row = mysqli_fetch_assoc($name_result)) {
            echo $row['recipename'].'<br>';
            $recipe_name=$row['recipename'];

            //SELECT RECIPE-CREDIT KEYS
            $recipe_credit_select = "SELECT creditkey FROM recipe_name WHERE recipename='".$recipe_name."'";
            $credit_result = mysqli_query($db, $recipe_credit_select);
            while ($credit_row = mysqli_fetch_assoc($credit_result)) {
                $creditkey=$credit_row['creditkey'];

                //SELECT RECIPE-CREDIT TEXT
                $credit_text_select = "SELECT credittext FROM recipe_credit WHERE creditkey='".$creditkey."'";
                $credit_text_result = mysqli_query($db, $credit_text_select);
                while ($credit_text_row = mysqli_fetch_assoc($credit_text_result)) {
                    echo 'Recipe Credit: '.$credit_text_row['credittext'].'<br>';
                }
            }

            //SELECT MAIN RECIPE-KEYS
            $recipe_key_select = "SELECT recipekey FROM recipe_name WHERE recipename='".$recipe_name."'";
            $key_result = mysqli_query($db, $recipe_key_select);
            while ($key_row = mysqli_fetch_assoc($key_result)) {
                $recipekey=$key_row['recipekey'];

                //SELECT RECIPE INGREDIENTS
                $recipe_ingredient_select = "SELECT ingredientname FROM recipe_ingredients WHERE recipekey='".$recipekey."'";
                $ingredient_result = mysqli_query($db, $recipe_ingredient_select);
                while ($ingredient_row = mysqli_fetch_assoc($ingredient_result)) {
                    echo $ingredient_row['ingredientname'].'<br>';
                }

                //SELECT RECIPE INSTRUCTIONS
                $recipe_instruction_select = "SELECT instructionstep,textdescription FROM recipe_instructions WHERE recipekey='".$recipekey."'";
                $instruction_result = mysqli_query($db, $recipe_instruction_select);
                while ($instruction_row = mysqli_fetch_assoc($instruction_result)) {
                    echo $instruction_row['instructionstep'].'. '.$instruction_row['textdescription'].'<br>';
                }
                
                echo 'Tags: ';
                //SELECT RECIPE-TAG KEYS
                $recipe_tagkey_select = "SELECT tagkey FROM recipe_name_tag WHERE recipekey='".$recipekey."'";
                $tagkey_result = mysqli_query($db, $recipe_tagkey_select);
                while ($tagkey_row = mysqli_fetch_assoc($tagkey_result)) {
                    $tagkey = $tagkey_row['tagkey'];

                    //SELECT RECIPE-TAG TEXT
                    $recipe_tag_select = "SELECT tagtext FROM recipe_tags WHERE tagkey='".$tagkey."'";
                    $tag_result = mysqli_query($db, $recipe_tag_select);
                    while ($tag_row = mysqli_fetch_assoc($tag_result)) {
                        echo $tag_row['tagtext'].' ';
                    }
                }
            }
            echo '<br><br>';
        }



        //echo json_encode($recipe_names).'<br /><br />';
        //echo json_encode($recipe_credits).'<br /><br />';
        //echo json_encode($recipe_ingredients).'<br /><br />';
        //echo json_encode($recipe_instructions).'<br /><br />';
        //echo json_encode($recipe_tags);
        mysqli_close($db);
        ?>
    </body>
</html>