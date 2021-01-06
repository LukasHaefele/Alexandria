<html>
    <title>Alexandria verify</title>
    <body>
        <?php
            $user = 'root';
            $pass = '';
            $check = false;
            $db = new PDO('mysql:host=localhost;dbname=alexandria', $user, $pass );
            $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $con = mysqli_connect("","root");
            mysqli_select_db($con,"alexandria");
            $res = mysqli_query($con,"select UID, username, password from user");
            while($dsatz = mysqli_fetch_assoc($res)){
                if($dsatz["username"] == $_GET["username"] && $dsatz["password"]==$_GET["password"]){
                    $check = true;
                    $username=$dsatz["username"];
                    $uid=$dsatz["UID"];
                }else{
                    setcookie("attempts","1",time()+1);
                    header("location: index.php");
                }
            }
            if($check){
                setcookie("user",$uid,time()+(86400*30),"/");
                setcookie("username",$username,time()+(86400*30),"/");
                header("location: ../home");
            }
        ?>
    </body>
</html>