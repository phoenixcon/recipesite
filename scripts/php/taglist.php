<a href="javascript:void(0)" class="closebtn">&times;</a>
<h3>Tags:</h3>

<ul>

    <?php

    //CONNECTION TO DATABASE
    include '../../../../connection/recipe-connection.php';
    //include 'connection-local.php';

    $taglist_query = 'SELECT tagtext FROM recipe_tags ORDER BY tagtext';
    $taglist_result = mysqli_query($db, $taglist_query);
    while ($row = mysqli_fetch_assoc($taglist_result)) {
        echo '<li class="tags" value="'.$row['tagtext'].'">'.$row['tagtext'].'</li>';
    }
    
    echo '<li id="viewall" value="ViewAll">View All Recipes</li>';

    ?>
</ul>