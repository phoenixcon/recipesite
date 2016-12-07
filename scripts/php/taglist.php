<ul>

    <?php

    //CONNECTION TO DATABASE
    $urlhost = $_SERVER['SERVER_NAME'];
    $local = 'localhost';

    if (substr($urlhost, 0, strlen($urlhost)) === $local) {
        include 'connection-local.php';
    } else {
        include '../../../../connection/recipe-connection.php';
    }

    $taglist_query = 'SELECT tagtext FROM recipe_tags ORDER BY tagtext';
    $taglist_result = mysqli_query($db, $taglist_query);
    while ($row = mysqli_fetch_assoc($taglist_result)) {
        echo '<li class="tags" value="'.$row['tagtext'].'">'.$row['tagtext'].'</li>';
    }

    mysqli_close($db);

    ?>
</ul>