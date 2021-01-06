<html>
    <title>Friendlist</title>
    <head>
        <link type="text/css" rel="stylesheet" href="../stylesheet.css">
        <h1>Friendlist</h1>
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
                        <option value="../add">Update Timetable</option>
                        <option value="../friends">Friendlist</option>
                        <option value="../home">Homepage</option>
                        <option value="../logout">logout</option>
                    </select>
                </p>');
        ?>

    </head>
</html>