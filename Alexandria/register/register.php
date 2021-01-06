<html>
    <title>Alexandria Register</title>
    <body>
        <?php
            $user = 'root';
            $pass = '';
            $check = false;
            $db = new PDO('mysql:host=localhost;dbname=alexandria', $user, $pass );
            $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $con = mysqli_connect("","root");
            mysqli_select_db($con,"alexandria");
            $res = mysqli_query($con,"select Username from user");
            $num = mysqli_num_rows($res)+1;
            while($dsatz = mysqli_fetch_assoc($res)){
                if($dsatz["Username"]==$_GET["username"]){
                    setcookie("attempts","1",time()+1);
                    header("location: index.php");
                    $check = true;
                }
            }
            if($_GET["password"]!=$_GET["passwordr"]){
                setcookie("nomatch","1",time()+1);
                header("location: index.php");
            }
            if(!$check){
                $username=$_GET["username"];
                $password=$_GET["password"];
                $time=date("Y-m-d");
                $sql = "INSERT INTO user (UID, Username, Password, DateSetup) VALUES ('".$num."','".$username."','".$password."','".$time."')";
                $db->exec($sql);
                $sql = "INSERT INTO friendlist(LID, UID) VALUES ('".$num."','".$num."')";
                $db->exec($sql);
                header("location: ../login");
            }
        ?>
    </body>
</html>