<?php
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
            <?php
                if ($_SERVER["REQUEST_METHOD"] != "POST"):
                ?>
                <div class="mainTitle">
                    <h1>Log into Gemorskos News Agency</h1>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" class="maincontent">
                    <div>
                        <label for="username">Username:</label>
                        <input type="text" name="username">
                    </div>
                    <div>
                        <label for="password">Password:</label>
                        <input type="password" name="password">
                    </div>
                    <input type="submit" value="Login">
                    <a href="./register.php">No account yet? Register here.</a>
                </form>
                <?php
                else:
            ?>
            <div class="mainTitle">
                <?php
                    $username = filter_input(INPUT_POST, "username", FILTER_DEFAULT);
                    $password = filter_input(INPUT_POST, "password", FILTER_DEFAULT);
    
                    if (!empty($username) && !empty($password))
                    {
                        if ($dbHandler)
                        {
                            $getUser = $dbHandler->prepare("SELECT * FROM users WHERE username = :username");
                            $getUser->bindParam(":username", $username);
                            $getUser->execute();
                            if ($getUser->rowCount() > 0)
                            {
                                $user = $getUser->fetch();
                                if (password_verify($password, $user["password"]))
                                {
                                    echo "<h1 id='welcomeText'>" . $user["username"] . ", welcome to Gemorskos News Agency.</h1>";
                                }
                                else
                                {
                                    echo "<h2 class='errorMessage'>Invalid username or password.</h2>";
                                    echo "<a href='index.php'>Go back</a>";
                                }
                            }
                            else
                            {
                                echo "<h2 class='errorMessage'>Invalid username or password.</h2>";
                                echo "<a href='index.php'>Go back</a>";
                            }
                        }
                    }
                    else
                    {
                        echo "<h2 class='errorMessage'>Oops, looks like you did not enter all the information.</h2>";
                        echo "<a href='index.php'>Go back</a>";
                    }
                    endif;
                ?>
            </div>
        </main>
    </body>
</html>