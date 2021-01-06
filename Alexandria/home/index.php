<html>
    <title>
        Alexandria Eventplanner
    </title>
    <head>
    <link type="text/css" rel="stylesheet" href="../stylesheet.css">
        <h1>Alexandria Eventplanner</h1>
        <?php
            if(!isset($_COOKIE["user"])){
                echo('<p class="header"><a href="../login">login</a></p>');
            }else{
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
            }
            if(!isset($_COOKIE["cookies"])){
                setcookie("origin","home",time()+10000,"/");
                header("location: ../datenschutz");
            }
        ?>
    </head>
    <body>
        <p class="headline">Use our planner as effectively as possible.</p>
        <p class="textbody">
            <a href="../add">Upload</a> your timetable to our servers so that your groupleaders can <a href="../plan">plan</a> any upcoming events 
            in a timeframe he knows everyone is free. You can then react to the planned events with "can attend" and "cannot attend". Only your 
            groupleader will see your reaction and can move or reorganize the eventy accordingly, or just leave it where it is and hope you can make
            make it next time. 
        </p>
        <p class="headline">What is your callendar.</p>
        <p class="textbody">
            Your <a href="../calendar">calendar</a> will show you all appointments you added to your timetable so far as well as all the events that
            have been added to any <a href="../group">group</a> that you are a part of. Within the calendar you will be able to select events and 
            interact with polls and other extensions the groupleader can add.
        </p>
        
    </body>
</html>