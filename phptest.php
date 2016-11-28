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
        
            echo json_encode($recipe_names).'<br /><br />';
            echo json_encode($recipe_credits).'<br /><br />';
            echo json_encode($recipe_ingredients).'<br /><br />';
            echo json_encode($recipe_instructions).'<br /><br />';
            echo json_encode($recipe_tags);
            mysqli_close($db);
        ?>
    </body>
</html>