<html>
    <title>
        Alexandria Register
    </title>
    <head>
        <link type="text/css" rel="stylesheet" href="../stylesheet.css">
        <?php
            if(isset($_COOKIE["user"])){
                header("location: ../profile");
            }
            if(!isset($_COOKIE["cookies"])){
                setcookie("origin","register",time()+10000,"/");
                header("location: ../datenschutz");
             }
        ?>
        <h1>Alexandria Registration </h1>
        <p class="textbody">Already have an account? <a href="../login">login here</a></p>
    </head>
    <body>
        <form action="register.php">
            <p class="input">Create a username: <input class="regin" type="text" name="username" plaeholder="Username..."></p>
            <p class="input">Create a password: <input class="regin" type="password" name="password" placeholder="Password..."></p>
            <p class="input">Repeat password: <input class="regin" type="password" name="passwordr" placeholder="repeat pasword"></p>
            <p class="button"><input type="submit" class="regin" value="Register"></p>
        </form>
        <?php
            if(isset($_COOKIE["attempts"])){
                echo("<br><p class='textbody'>Username already taken</p>");
            }
            if(isset($_COOKIE["nomatch"])){
                echo("<p class='textbody'>The passwords you entered didn't match</p>");
            }
        ?>
    </body>
</html>