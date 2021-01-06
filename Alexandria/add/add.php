<html>
    <title>Alexandria Upload Timetable</title>
    <head>
        <link type="text/css" rel="stylesheet" href="../stylesheet.css">
        <h1>Upload Timetable</h1>
        <?php
            if(!isset($_COOKIE["user"])){
                setcookie("first","1",time()+1,"/");
                header("location: ../login");
            }
            if(!isset($_COOKIE["cookies"])){
                setcookie("origin","add",time()+10000,"/");
               header("location: ../datenschutz");
            }
            echo('<p class="header"><select name="profile" onchange="location = this.value">
                        <option value="../profile">'.$_COOKIE["username"].'</option>
                        <option value="../profile">Profile</option>
                        <option value="../calendar">Calendar</option>
                        <option value="../plan">New Event</option>
                        <option value="../join">Join Group</option>
                        <option value="../home">Homepage</option>
                        <option value="../add">Update Timetable</option>
                        <option value="../logout">logout</option>
                    </select>
                </p>');
        ?>

    </head>
    <body>
        <?php
            $user = 'root';
            $pass = '';
            $check = false;
            $db = new PDO('mysql:host=localhost;dbname=alexandria', $user, $pass );
            $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $con = mysqli_connect("","root");
            mysqli_select_db($con,"alexandria");
            $startdate = $_GET["startdate"];
            $enddate = $_GET["enddate"];
            if($startdate > $enddate){
                setcookie("attempts","1",time()+1);
                header("location: index.php");
            }else{
                $reference = $_GET["reference"];
                $repeats = $_GET["repeats"];
                $id = mysqli_num_rows(mysqli_query($con, "select * from timetable"));
                echo($reference."<br>".$startdate."<br>".$enddate."<br>".$repeats."<br>".$id);
                $sql = "INSERT INTO timetable (TID, UID, Reference, Startdate, Enddate, Repeats) VALUES ('".$id."','".$_COOKIE["user"]."','".$reference."','".$startdate."','".$enddate."','".$repeats."')";
                $db->exec($sql);
                setcookie("setevent","1",time()+1);
                header("location: index.php");
            }
        ?>
    </body>
</html>