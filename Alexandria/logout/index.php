<html>
    <body>
        <?php
            setcookie("user","",time()-3600,"/");
            header("location:../home");
        ?>
    </body>
</html>