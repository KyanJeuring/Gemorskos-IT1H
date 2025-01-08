<?
    require_once("./config/dbconfig.php");
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gemorskos News Agency</title>
        <link rel="stylesheet" href="./CSS/main.css" type="text/css">
        <link rel="icon" href="./Assets/favicon/favicon.ico" type="image/x-icon">
    </head>
    <body>
        <main>
            <?
                if ($_SERVER["REQUEST_METHOD"] != "POST"):
                ?>
                <div class="mainTitle">
                    <h1>Log into Gemorskos News Agency</h1>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                    <div>
                        <label for="username">Username:</label>
                        <input type="text" name="username">
                    </div>
                    <input type="submit" value="Login">
                </form>
                <?
                else:
            ?>
            <div class="mainTitle">
                <h1>Welcome to Gemorskos News Agency</h1>
            </div>
            <?php
                endif;
            ?>
        </main>
    </body>
</html>