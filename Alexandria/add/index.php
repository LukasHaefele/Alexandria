<html>
    <title>Alexandria Upload Timetable</title>
    <head>
        <link type="text/css" rel="stylesheet" href="../stylesheet.css">
        <h1>Update Timetable</h1>
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
    <body>
        <form action="add.php">
            <?php
                if(isset($_COOKIE["setevent"])){
                    echo("<p class= 'textbody'>New Event has been successfully set</p>");
                }
            ?>
            <p class="input">Eventtitle: <input class="addin" type="text" name="reference"></p>
            <p class="input">Begin:      <input class="addin"type="datetime-local" name="startdate"></p>
            <p class="input">End:        <input type="datetime-local" class="addin" name="enddate"></p>
            <p class="input">Repeats:    
                <select name="repeats" class="addin">
                    <option value=0>Does not repeat</option>
                    <option value=1>Repeats Daily</option>
                    <option value=2>Repeats Weekly</option>
                    <option value=3>Repeats Monthly</option>
                </select>
            </p>
            <p class="input"><input type="submit" class="addin" value="Add"></p>
            <?php
                if(isset($_COOKIE["attempts"])){
                    echo("<br><p class='textbody'>Please make sure the startdate earlier than the enddate.</p>");
                }
            ?>
        </form>
    </body>
</html>