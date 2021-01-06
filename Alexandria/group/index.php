<html>
    <title>Alexandria Group Overview</title>
    <head>
        <h1>Group Overview</h1>
        <link type="text/css" rel="stylesheet" href="../stylesheet.css">
        <?php
            if(!isset($_COOKIE["user"])){
                setcookie("first","1",time()+1,"/");
                header("location: ../login");
            }
            if(!isset($_COOKIE["cookies"])){
                setcookie("origin","group",time()+10000,"/");
                header("location: ../datenschutz");
            }
             echo('<p class="header"><select name="profile" onchange="location = this.value">
                        <option value="../profile">'.$_COOKIE["username"].'</option>
                        <option value="../profile">Profile</option>
                        <option value="../calendar">Calendar</option>
                        <option value="../plan">New Event</option>
                        <option value="../join">Join Group</option>
                        <option value="../add">Update Timetable</option>
                        <option value="../friends">Friendlist</option>
                        <option value="../home">Homepage</option>
                        <option value="../logout">logout</option>
                    </select>
                </p>');
        ?>

    </head>
    <body>
        <?php
            $id = $_GET["id"];
            $ids[0] = -1;
            $user = 'root';
            $pass = '';
            $check = false;
            $db = new PDO('mysql:host=localhost;dbname=alexandria', $user, $pass );
            $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $con = mysqli_connect("","root");
            mysqli_select_db($con,"alexandria");
            $res = mysqli_query($con, "select * from event where GID=".$id);
            if(mysqli_num_rows($res) == 0){
                echo("
                    <div class='event'>
                        <p class='eventtitle'>
                            No Events so far
                        </p>
                        <p class='eventbody'>
                            <a href='../add'>Add new Events</a>
                        </p>
                    </div>"
                );
            }else{
                for($j = 0; $j < 5 && $j < mysqli_num_rows($res); $j++){    
                    $res = mysqli_query($con, "select EID, Startdate from event where GId=".$id);
                    $dater = new DateTime("9999-12-31");
                    $idr = "";
                    while($dsatz=mysqli_fetch_assoc($res)){
                        $startdate = new DateTime($dsatz["Startdate"]);
                        if($startdate < $dater && !in_array($dsatz["EID"], $ids)){
                            $dater = $startdate;
                            $idr = $dsatz["EID"];
                        }
                    }
                    $print = mysqli_fetch_assoc(mysqli_query($con, "select Startdate, Enddate, Reference from event where EID = ".$idr));
                    echo("
                        <div class='event'>
                            <p class='eventtitle'>".$print["Reference"]."</p>
                            <p class='tag'>Group</p>
                            <p class='eventbody'>Starts at: <br>".$print["Startdate"]."<br>Ends at: <br>".$print["Enddate"]."</p>
                        </div>
                    ");
                    if($ids[0] == -1){
                        $ids[0] = intval($idr);
                    }else{
                        $ids[count($ids)] = intval($idr);
                    }
                }
            }
        ?>
    </body>
</html>