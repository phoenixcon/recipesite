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


    //include('connection-local.php'); //mySQL Connection

    //if ($form_name == 'Kris') {
    //    $kris_date_check_result = mysqli_query($dbc, "SELECT * FROM kris_workouts WHERE date = '$form_date'");
    //    if (mysqli_num_rows ($kris_date_check_result)>0) {
    //        $errors['date_duplicate']='Entry for '.$form_date.' already exists.';
    //    }
    //}

    //mysqli_close ($dbc);

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
var_dump($form_name);
var_dump($form_credit);
var_dump($form_ingredient);
var_dump($form_instruction);
var_dump($form_tag);

?>