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
        <h1>PHP Connection Success</h1>
        <?php
        $name_query = "SELECT * FROM recipe_name";
        $credit_query = "SELECT * FROM recipe_credit";
        $ingredient_query = "SELECT * FROM recipe_ingredients";
        $instruction_query = "SELECT * FROM recipe_instructions";
        $tag_query = "SELECT * FROM recipe_tags";

        $recipe_names = array();
        $recipe_credits = array();
        $recipe_ingredients = array();
        $recipe_instructions = array();
        $recipe_tags = array();

        $result = mysqli_query($db, $name_query);
        while ($row = mysqli_fetch_assoc($result)) {
            $recipe_names[] = $row;
        }

        $result = mysqli_query($db, $credit_query);
        while ($row = mysqli_fetch_assoc($result)) {
            $recipe_credits[] = $row;
        }

        $result = mysqli_query($db, $ingredient_query);
        while ($row = mysqli_fetch_assoc($result)) {
            $recipe_ingredients[] = $row;
        }

        $result = mysqli_query($db, $instruction_query);
        while ($row = mysqli_fetch_assoc($result)) {
            $recipe_instructions[] = $row;
        }

        $result = mysqli_query($db, $tag_query);
        while ($row = mysqli_fetch_assoc($result)) {
            $recipe_tags[] = $row;
        }

        //echo "[{";
        //foreach ($recipe_names as $key => $row) {
        //    echo '"'.'Recipe Name'.'":"'.$row['Recipe Name'].'"';
        //}
        //$recipe_name = array();

        $recipe_name_select = "SELECT * FROM recipe_name";
        $name_result = mysqli_query($db, $recipe_name_select);
        while ($row = mysqli_fetch_assoc($name_result)) {
            echo $row['recipename'].'<br>';
            $recipe_name=$row['recipename'];

            $recipe_credit_select = "SELECT creditkey FROM recipe_name WHERE recipename='".$recipe_name."'";
            $credit_result = mysqli_query($db, $recipe_credit_select);
            while ($credit_row = mysqli_fetch_assoc($credit_result)) {
                $creditkey=$credit_row['creditkey'];

                $credit_text_select = "SELECT credittext FROM recipe_credit WHERE creditkey='".$creditkey."'";
                $credit_text_result = mysqli_query($db, $credit_text_select);
                while ($credit_text_row = mysqli_fetch_assoc($credit_text_result)) {
                    echo 'Recipe Credit: '.$credit_text_row['credittext'].'<br>';
                }
            }

            $recipe_key_select = "SELECT recipekey FROM recipe_name WHERE recipename='".$recipe_name."'";
            $key_result = mysqli_query($db, $recipe_key_select);
            while ($key_row = mysqli_fetch_assoc($key_result)) {
                $recipekey=$key_row['recipekey'];

                $recipe_ingredient_select = "SELECT ingredientname FROM recipe_ingredients WHERE recipekey='".$recipekey."'";
                $ingredient_result = mysqli_query($db, $recipe_ingredient_select);
                while ($ingredient_row = mysqli_fetch_assoc($ingredient_result)) {
                    echo $ingredient_row['ingredientname'].'<br>';
                }

                $recipe_instruction_select = "SELECT instructionstep,textdescription FROM recipe_instructions WHERE recipekey='".$recipekey."'";
                $instruction_result = mysqli_query($db, $recipe_instruction_select);
                while ($instruction_row = mysqli_fetch_assoc($instruction_result)) {
                    echo $instruction_row['instructionstep'].'. '.$instruction_row['textdescription'].'<br>';
                }

                $recipe_tagkey_select = "SELECT tagkey FROM recipe_name_tag WHERE recipekey='".$recipekey."'";
                $tagkey_result = mysqli_query($db, $recipe_tagkey_select);
                while ($tagkey_row = mysqli_fetch_assoc($tagkey_result)) {
                    $tagkey = $tagkey_row['tagkey'];

                    $recipe_tag_select = "SELECT tagtext FROM recipe_tags WHERE tagkey='".$tagkey."'";
                    $tag_result = mysqli_query($db, $recipe_tag_select);
                    while ($tag_row = mysqli_fetch_assoc($tag_result)) {
                        echo $tag_row['tagtext'].'<br>';
                    }
                }
            }
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