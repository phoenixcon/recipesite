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
            $query = "SELECT name FROM recipe_name";
            mysqli_query($db, $query) or die('Error querying database.');
        
            $result = mysqli_query($db, $query);
        
        while ($row = mysqli_fetch_array($result)) {
            echo $row['name'].'<br />';
        }
        mysqli_close($db);
        ?>
    </body>
</html>