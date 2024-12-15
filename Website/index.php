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
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                <input type="submit" value="Login">
            </form>
            <?
            else:
                echo "Hello, World!";
            endif;
            ?>
        </main>
    </body>
</html>