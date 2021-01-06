<html>
    <title>Alexandria Datenschutz</title>
    <body>
        <?php
            if($_GET["datenschutz"]==1){
                setcookie("cookies","1",time()+(86400*30),"/");
                echo("location: ../".$_COOKIE["origin"]);
                header("location: ../".$_COOKIE["origin"]);
            }else{echo("ERRORCODE: 00000002");}
        ?>
    </body>
</html>