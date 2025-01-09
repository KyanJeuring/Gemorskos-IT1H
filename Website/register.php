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
            <div class="maincontent">
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    $username = filter_input(INPUT_POST, "username", FILTER_DEFAULT);
                    $password = filter_input(INPUT_POST, "password", FILTER_DEFAULT);
                    $repeat_password = filter_input(INPUT_POST, "repeat_password", FILTER_DEFAULT);

                    if (!empty($username) && !empty($password) && !empty($repeat_password))
                    {
                        if ($password == $repeat_password)
                        {
                            if($dbHandler)
                            {
            ?>
            <?php
                                $checkExistingUser = $dbHandler->prepare("SELECT * FROM users WHERE username = :username");
                                $checkExistingUser->bindParam(":username", $username);
                                $checkExistingUser->execute();
                                if ($checkExistingUser->rowCount() > 0)
                                {
                                    echo "<h2 class='errorMessage'>Username already exists. Please choose a different username.</h2>";
                                    echo "<a href='register.php'>Go back</a>";
                                }
                                else
                                {
                                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                                    $insertUser = $dbHandler->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
                                    $insertUser->bindParam(":username", $username);
                                    $insertUser->bindParam(":password", $hashedPassword);
                                    if ($insertUser->execute())
                                    {
                                        echo "<h1>Registered successfully.<h1>";
                                        echo "<a href='index.php'>Login here</a>";
                                    } else
                                    {
                                        echo "<p class='errorMessage'>Error: Could not register user.<p>";
                                        echo "<a href='register.php'>Go back</a>";
                                    }
                                }
                            }
                        }
                        else
                        {
                            echo "<h2 class='errorMessage'>Passwords do not match.</h2>";
                            echo "<a href='register.php'>Go back</a>";
                        }
                    }
                    else
                    {
                        echo "<h2 class='errorMessage'>Oops, looks like you did not enter all the information.</h2>";
                        echo "<a href='register.php'>Go back</a>";
                    }
                }
                else
                {
                ?>
                </div>
                <div class="mainTitle">
                    <h1>Register into Gemorskos News Agency</h1>
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
                    <div>
                        <label for="repeat_password">Repeat Password:</label>
                        <input type="password" name="repeat_password">
                    </div>
                    <input type="submit" value="Register">
                    <a href="./index.php">Already an user?</a>
                </form>
            <?php
                }
            ?>
        </main>
    </body>
</html>