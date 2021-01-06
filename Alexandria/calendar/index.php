<html>
    <title>Alexandria Calendar</title>
    <head>
        <h1>Calendar</h1>
        <link type="text/css" rel="stylesheet" href="../stylesheet.css">
        <?php
            if(!isset($_COOKIE["user"])){
                setcookie("first","1",time()+1,"/");
                header("location: ../login");
            }
            if(!isset($_COOKIE["cookies"])){
                setcookie("origin","calendar",time()+10000,"/");
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
            $dater = new DateTime("9999-12-31");
            $priv = true;
            $idr = "";
            $ids[0] = -1;
            $ide[0] = -1;
            $user = 'root';
            $pass = '';
            $check = false;
            $db = new PDO('mysql:host=localhost;dbname=alexandria', $user, $pass );
            $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $con = mysqli_connect("","root");
            mysqli_select_db($con,"alexandria");
            $personal = mysqli_query($con, "select * from timetable where UID=".$_COOKIE["user"]);
            $group = mysqli_query($con, "select * from usgr u, gruppe g where u.UID=".$_COOKIE["user"]." and u.GID=g.GID");
            if(mysqli_num_rows($personal)==0 && mysqli_num_rows($group)==0){
                echo("
                    <div class='event'>
                        <p class='eventtitle'>
                            No appointments so far
                        </p>
                        <p class='eventbody'>
                            <a href='../add'>Add new Events</a>
                        </p>
                    </div>"
                );
            }else{
                $res = mysqli_query($con, "select TID, Startdate from timetable where UID=".$_COOKIE["user"]);
                $res2 = mysqli_query($con, "select e.EID, e.Startdate from event e, usgr u where u.UID=".$_COOKIE["user"]." and u.GID= e.GID");
                for($i = 0; $i<5 && $i < (mysqli_num_rows($res) + mysqli_num_rows($res2)); $i++){
                    $res = mysqli_query($con, "select TID, Startdate from timetable where UID=".$_COOKIE["user"]);
                    $res2 = mysqli_query($con, "select e.EID, e.Startdate from event e, usgr u where u.UID=".$_COOKIE["user"]." and u.GID= e.GID");
                    $idr = 0;
                    $dater = new DateTime("9999-12-31");
                    while($dsatz=mysqli_fetch_assoc($res)){
                        $startdate = new DateTime($dsatz["Startdate"]);
                        if($startdate < $dater && !in_array($dsatz["TID"], $ids)){
                            $dater = $startdate;
                            $idr = $dsatz["TID"];
                            $priv = true;
                        }
                    }
                    while($dsatz=mysqli_fetch_assoc($res2)){
                        $startdate = new DateTime($dsatz["Startdate"]);
                        if($startdate < $dater && !in_array($dsatz["EID"], $ide)){
                            $dater = $startdate;
                            $idr = $dsatz["EID"];
                            $priv = false;
                        }
                    }
                    if($priv){
                        $print = mysqli_fetch_assoc(mysqli_query($con, "select Startdate, Enddate, Reference from timetable where TID = ".$idr));
                        if($ids[0] == -1){
                            $ids[0] = intval($idr);
                        }else{
                            $ids[count($ids)] = intval($idr);
                        }
                    }else{
                        $print = mysqli_fetch_assoc(mysqli_query($con, "select Startdate, Enddate, Reference from event where EID = ".$idr));
                        if($ide[0] == -1){
                            $ide[0] = intval($idr);
                        }else{
                            $ide[count($ids)] = intval($idr);
                        }
                    }
                    echo("
                            <div class='event'>
                                <p class='eventtitle'>".$print["Reference"]."</p>
                                <p class='tag'>".trial($priv)."</p>
                                <p class='eventbody'>Starts at: <br>".$print["Startdate"]."<br>Ends at: <br>".$print["Enddate"]."</p>
                            </div>
                        ");
                }

            }
            function trial($pr){
                if($pr){
                    return "Private";
                }else{
                    return "Group";
                }
            }
        ?>
    </body>
</html>