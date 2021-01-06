<html>
    <title>Alexandria Profile</title>
    <head>
        <link type="text/css" rel="stylesheet" href="../stylesheet.css">
        <?php
            if(!isset($_COOKIE["user"])){
                setcookie("first","1",time()+1,"/");
                header("location: ../login");
            }else{
                echo("<h1>Alexandria Profile of ".$_COOKIE["username"]."</h1>");
            }
            if(!isset($_COOKIE["cookies"])){
                setcookie("origin","profile",time()+10000,"/");
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
            $user = 'root';
            $pass = '';
            $check = false;
            $db = new PDO('mysql:host=localhost;dbname=alexandria', $user, $pass );
            $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $con = mysqli_connect("","root");
            mysqli_select_db($con,"alexandria");
            $res = mysqli_query($con,"select g.Reference, g.GID from gruppe g, usgr u where u.UID=".$_COOKIE["user"]." and u.GID=g.GID");
            if(mysqli_num_rows($res)==0){
                echo("you are in no groups yet.");
            }else{
                echo("You are part of the following groups: <br><table><tr><th>Groupname</th><th>Group ID</th></tr>");
                while($dsatz=mysqli_fetch_assoc($res)){
                    echo("<tr><td><a href='../group/?id=".$dsatz["GID"]."'>".$dsatz["Reference"]."</a></td><th>".$dsatz["GID"]."</th></tr>");
                }
                echo("</table>");
            }
            echo("<p class='textbody'>
                Find your <a href='../calendar'>calendar here</a> 
            </p>");
            $res = mysqli_query($con,"select user.Username from user, usfr, friendlist where user.UID=usfr.UID and usfr.LID=friendlist.LID and friendlist.LID=".$_COOKIE["user"]);
            if(mysqli_num_rows($res)==0){
                echo("You have no friends.");
            }else{
                echo("<p class='textbody'>Your friendlist:</p><table><tr><th>Username</th><tr>");
                while($dsatz=mysqli_fetch_assoc($res)){
                    echo("<tr><td>".$dsatz["Username"]."</td></tr>");

                }
                echo("</table>");
            }
        ?>
    </body>
</html>