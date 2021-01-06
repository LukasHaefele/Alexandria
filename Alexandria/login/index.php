<html>
    <title>Alexandria Login Page</title>
    <head>
        <link type="text/css" rel="stylesheet" href="../stylesheet.css">
        <h1>Login</h1>
    </head>
    <body>
        <?php
            if(isset($_COOKIE["user"])){
                header("../profile");
            }
            if(isset($_COOKIE["first"])){
                echo("<p class='textbody'>Please log in first</p>");
            }
            if(!isset($_COOKIE["cookies"])){
                setcookie("origin","login",time()+10000,"/");
                header("location: ../datenschutz");
             }
        ?>
        <form action="login.php">
            <p class="input">Username: <input class="addin" type="text" name="username"></p>
            <p class="input">Password: <input class="addin" type="password" name="password"></p>
            <p class="button"><input type="submit" class="addin" value="Login"></p>
        </form>
        <?php
            if(isset($_COOKIE["attempts"])){
                echo("Wrong password or username.");
            }
        ?>
        <br>
        <p class="textbody">
            Don't have an account yet? <a href="../register">register</a>
        </p>
    </body>
</html>