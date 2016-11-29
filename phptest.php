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
        
        //DECLARE NEEDED ARRAYS
        $recipe_list = array();
        $recipe = array();
        $ingredient = array();
        $instruction = array();
        $tag = array();
        
        //SELECT RECIPE NAMES
        $recipe_name_select = "SELECT * FROM recipe_name"; 
        $name_result = mysqli_query($db, $recipe_name_select);
        while ($row = mysqli_fetch_assoc($name_result)) {
            echo '"recipename":"'.$row['recipename'].'",';
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
                    echo '"recipecredit":"'.$credit_text_row['credittext'].'",';
                    $recipes[$recipe_name] = $credit_text_row['credittext'];
                }
            }
            echo '"ingredients":{';

            //SELECT MAIN RECIPE-KEYS
            $recipe_key_select = "SELECT recipekey FROM recipe_name WHERE recipename='".$recipe_name."'";
            $key_result = mysqli_query($db, $recipe_key_select);
            while ($key_row = mysqli_fetch_assoc($key_result)) {
                $recipekey=$key_row['recipekey'];

                //SELECT RECIPE INGREDIENTS
                $recipe_ingredient_select = "SELECT ingredientname FROM recipe_ingredients WHERE recipekey='".$recipekey."'";
                $ingredient_result = mysqli_query($db, $recipe_ingredient_select);
                while ($ingredient_row = mysqli_fetch_assoc($ingredient_result)) {
                    echo '"ingredientname":"'.$ingredient_row['ingredientname'].'",';
                }
                
                echo '},"instructions":{';

                //SELECT RECIPE INSTRUCTIONS
                $recipe_instruction_select = "SELECT instructionstep,textdescription FROM recipe_instructions WHERE recipekey='".$recipekey."'";
                $instruction_result = mysqli_query($db, $recipe_instruction_select);
                while ($instruction_row = mysqli_fetch_assoc($instruction_result)) {
                    echo '"instructionstep":"'.$instruction_row['instructionstep'].'","textdescription":"'.$instruction_row['textdescription'].'",';
                }
                
                echo '},"tags":{';
                //SELECT RECIPE-TAG KEYS
                $recipe_tagkey_select = "SELECT tagkey FROM recipe_name_tag WHERE recipekey='".$recipekey."'";
                $tagkey_result = mysqli_query($db, $recipe_tagkey_select);
                while ($tagkey_row = mysqli_fetch_assoc($tagkey_result)) {
                    $tagkey = $tagkey_row['tagkey'];

                    //SELECT RECIPE-TAG TEXT
                    $recipe_tag_select = "SELECT tagtext FROM recipe_tags WHERE tagkey='".$tagkey."'";
                    $tag_result = mysqli_query($db, $recipe_tag_select);
                    while ($tag_row = mysqli_fetch_assoc($tag_result)) {
                        echo '"tagtext":"'.$tag_row['tagtext'].'",';
                    }
                }
                echo '}},{';
            }
        }
        echo ']';
        echo '<br><br><br><br><br><br>';
        $json_dump = '{
  "recipe-list": {
    "recipe": [
      {
        "title": "Corn Dogs",
        "credit": "food.com",
        "ingredient": [
          { "ingredient-name": "8 Hot Dogs" },
          { "ingredient-name": "1 1/4 cups Flour" },
          { "ingredient-name": "1 teaspoon Salt" },
          { "ingredient-name": "3\\/4 cup Cornmeal" },
          { "ingredient-name": "4 tablespoons Sugar" },
          { "ingredient-name": "1 teaspoon Baking Powder" },
          { "ingredient-name": "2 eggs" },
          { "ingredient-name": "3\\/4 cup Milk" },
          { "ingredient-name": "Wooden Skewers" }
        ],
        "instruction": [
          {
            "instruction-step": "1",
            "text-description": "Mix all the dry ingredients, then add eggs and milk."
          },
          {
            "instruction-step": "2",
            "text-description": "Mix till lump free."
          },
          {
            "instruction-step": "3",
            "text-description": "Skewer the dogs and dip into the batter to coat."
          },
          {
            "instruction-step": "4",
            "text-description": "Deep fry in 350 degree oil. Remove when golden brown, about 5 minutes."
          }
        ],
        "tag": { "tag-text": "Entree" }
      },
      {
        "title": "Drunken Chicken Marsala",
        "credit": "pinchofyum.com",
        "ingredient": [
          { "ingredient-name": "16 ounces Fresh Crimini Mushrooms, sliced" },
          { "ingredient-name": "3 tablespoons Butter, divided" },
          { "ingredient-name": "2 cloves Garlic, minced" },
          { "ingredient-name": "1 cup dry Marsala Wine" },
          { "ingredient-name": "1 teaspoon Cornstarch dissolved in 1 tablespoon Cold Water" },
          { "ingredient-name": "2 tablespoons Heavy Cream" },
          { "ingredient-name": "1\\/2 teaspoon Salt, more to taste" },
          { "ingredient-name": "1 1\\/2 to 2 pounds Boneless Skinless Chicken Breasts" },
          { "ingredient-name": "1 tablespoon Olive Oil" },
          { "ingredient-name": "1\\/3 cup Flour" },
          { "ingredient-name": "1 teaspoon All-Purpose Seasoning plus a pinch of Salt and Pepper" },
          { "ingredient-name": "1 to 2 cups Cherry Tomatoes" },
          { "ingredient-name": "Fresh Parsley" }
        ],
        "instruction": [
          {
            "instruction-step": "1",
            "text-description": "Heat 1 tablespoon butter in a medium or large saucepan over medium heat. Add the mushrooms and saut\\u00e9 for 8-10 minutes, until golden brown."
          },
          {
            "instruction-step": "2",
            "text-description": "Add the garlic and wine - let the mixture simmer gently to reduce the wine, stirring occasionally. After 15-20 minutes, add the cornstarch, cream, and salt to the Marsala mixture - it should start to thicken slightly."
          },
          {
            "instruction-step": "3",
            "text-description": "Pound the chicken breasts until they are about 1 inch thick to help with even cooking. Cut them into smaller, single-serving pieces if necessary."
          },
          {
            "instruction-step": "4",
            "text-description": "Combine the flour, seasoning, and salt and pepper in a shallow bowl. Toss the chicken in the flour mixture until coated. Shake off excess."
          },
          {
            "instruction-step": "5",
            "text-description": "Heat the remaining 2 tablespoons butter and oil in a large skillet over medium high heat. Pan-fry the coated chicken for a few minutes on each side, until golden brown and cooked through."
          },
          {
            "instruction-step": "6",
            "text-description": "Add sauce and mushrooms to the skillet with the chicken. Top with tomatoes and simmer until the tomatoes have softened. Serve with fresh parsley."
          }
        ],
        "tag": [
          { "tag-text": "Entree" },
          { "tag-text": "Chicken" }
        ]
      }
    ]
  }
}';
        $data = json_decode($json_dump, TRUE);
        var_dump($data);
        mysqli_close($db);
        ?>
    </body>
</html>