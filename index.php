<!DOCTYPE html>
<html>
    <head>
        <title>Legg Family Recipes</title>
        <meta charset="utf-8"  />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta NAME="robots" CONTENT="noindex,nofollow">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/index.css">
    </head>
    <body>
        <header>
            <h1>Family Recipes</h1>
            <input id="search" name="search" placeholder="Search" type="text" data-list=".grid" class="ignore">
            <br>
            <button id="viewall" value="ViewAll">View All Recipes</button>
        </header>
        <div class="group grid">
                <?php include 'scripts/php/main-recipes.php'; ?>
        </div>
        <footer><h6>&copy; Midnight Design Group, 2016</h6></footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js"></script>
        <script src="scripts/masonry.pkgd.min.js"></script>
        <script src="scripts/jquery.hideseek.min.js"></script>
        <script type="text/javascript" src="scripts/scripts.js"></script>
    </body>
</html>