<?php

$errors         = array(); //array for errors
$data           = array(); //array for data - JSON

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //form values
    $form_name      = $_POST['name'];
    $form_credit      = $_POST['credit'];
    $form_ingredient  = $_POST['ingredient'];
    $form_instruction  = $_POST['instruction'];
    $form_tag  = $_POST['tag'];

    if (empty($form_name))
        $errors['name']='Name is required.';

    if (empty($form_credit))
        $errors['credit']='Recipe Credit is required.';

    if (empty($form_ingredient))
        $errors['ingredient']='At least one Ingredient is required.';
    
    if (empty($form_instruction))
        $errors['instruction']='At least one Instruction step is required.';
    
    if (empty($form_tag))
        $errors['tag']='At least one Tag is required.';


    include('connection-local.php'); //mySQL Connection
    
    $credit_check_query = "SELECT creditkey FROM recipe_credit WHERE credittext = '".$form_credit."'";
    $update_credit_table = "INSERT INTO recipe_credit(creditkey, credittext) VALUES(null, '$form_credit')";
    
    $credit_check_result = mysqli_query($db, $credit_check_query);
    
    if (mysqli_num_rows ($credit_check_result)>0) {
        $credit_check_row = mysqli_fetch_assoc($credit_check_result);
        $credit_check_key = $credit_check_row['creditkey'];
    } else {
        mysqli_query($db, $update_credit_table);
        $credit_check_result = mysqli_query($db, $credit_check_query);
        $credit_check_row = mysqli_fetch_assoc($credit_check_result);
        $credit_check_key = $credit_check_row['creditkey'];
    }
    
    $update_name_table = "INSERT INTO recipe_name(recipekey, recipename, creditkey) VALUES(null, '$form_name', '".$credit_check_key."')";
    $recipe_key_query = "SELECT recipekey FROM recipe_name WHERE recipename ='".$form_name."'";
    $recipe_key_result = mysqli_query($db, $recipe_key_query);
    $recipe_key_row = mysqli_fetch_assoc($recipe_key_result);
    $recipe_key = $recipe_key_row['recipekey'];
    
    $ingredients = array();
    foreach( $form_ingredient as $ingredientrow ){
        $ingredients[] = '(null, '.$recipe_key.', "'.$ingredientrow.'")';
    }
    $update_ingredient_table = "INSERT INTO recipe_ingredients(ingredientkey, recipekey, ingredientname) VALUES".implode(',', $ingredients)."";
    echo $update_ingredient_table;
    
    
    $instructions = array();
    foreach( $form_instruction as $instructionrow ){
        $instructions[] = '(null, '.$recipe_key.', "'.$instructionrow.'", null)';
    }
    $update_instruction_table = "INSERT INTO recipe_instructions(instructionkey, recipekey, textdescription, instructionstep) VALUES".implode(',', $instructions)."";
    echo $update_instruction_table;
    
    
    $tags = array();
    foreach( $form_tag as $tagrow ){
        $tags[] = '(null, "'.$tagrow.'")';
    }
    $update_tag_table = "INSERT INTO recipe_tags(tagkey, tagtext) VALUES".implode(',', $tags)."";
    echo $update_tag_table;
    
    
    mysqli_query($db, $update_name_table);
    mysqli_query($db, $update_ingredient_table);
    mysqli_query($db, $update_instruction_table);
    mysqli_query($db, $update_tag_table);
    

    $update_instruction_table = '';
    $update_tag_table = '';
    $update_name_tag_table = '';

    mysqli_close ($db);

    if (!empty($errors)) {
        $data['success'] = false;
        $data['errors']  = $errors;
    } else {
        $data['success'] = true;
        $data['message'] = 'Success!';
    }

} else {

    $errors['submit'] = 'Form not submitted.';
    $data['success']  = false;
    $data['errors']   = $errors;

};

//if ($data['success'] == 'true') {

    //include('connection-local.php'); //mySQL Connection

    //if ($form_name == 'Kris') {
        
        
    //    $score_query = mysqli_query($dbc, "SELECT COUNT(*) FROM kris_workouts WHERE date LIKE '".$form_month."%'");
    //    $score_array = mysqli_fetch_array($score_query);
    //    $score = $score_array[0]+1;
        

    //    mysqli_query($dbc, "INSERT INTO kris_workouts(score, name, date, activity) VALUES('$score', '$form_name', '$form_date', '$form_activity')");

    //}

    //mysqli_close ($dbc);
//}

//echo json_encode($data);
//var_dump($form_name);
//var_dump($form_credit);
//var_dump($form_ingredient);
//var_dump($form_instruction);
//var_dump($form_tag);
//var_dump($credit_check_query);

?>