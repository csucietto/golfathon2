<?php

// Connect to database
$con = mysqli_connect("localhost", "root", "", "golfathon");

// mysqli_connect("servername","username","password","database_name")

//Get latest event from events table
$sqlSelectEvents = "Select EventID from events2 WHERE EventYear = (SELECT max(EventYear) FROM events2)";
$currentEvents = mysqli_query($con, $sqlSelectEvents);
$row = mysqli_fetch_array($currentEvents, MYSQLI_ASSOC);
$row = array_reverse($row);
$currentEvent = array_pop($row);

//Get latest event from events table
$sqlSelectEventPledgeAmount = "Select SUM(Amount) from donations WHERE EventID = '$currentEvent'";
$all_eventPledges = mysqli_query($con, $sqlSelectEventPledgeAmount);
$pledgesRow = mysqli_fetch_array($all_eventPledges, MYSQLI_ASSOC);
$pledgesRow = array_reverse($pledgesRow);
$eventPledgeTotal = array_pop($pledgesRow);

//Get latest event from events table
$sqlSelectEventPledgeCount = "Select Count(*) from donations WHERE EventID = '$currentEvent'";
$all_eventPledgeCount = mysqli_query($con, $sqlSelectEventPledgeCount);
$pledgeCountRow = mysqli_fetch_array($all_eventPledgeCount, MYSQLI_ASSOC);
$pledgeCountRow = array_reverse($pledgeCountRow);
$eventPledgeCount = array_pop($pledgeCountRow);

$eventPledgeAverage = $eventPledgeTotal / $eventPledgeCount;

//Get golferevent pairings from the selected year
$sqlSelectGolfers = "Select * from golfers2 WHERE GolferID in (Select GolferID from golferevent WHERE EventID = '$currentEvent')";
$all_golfers = mysqli_query($con, $sqlSelectGolfers);

$sqlSelectGolfers2 = "Select golfers.golfers2.FirstName, golfers2.LastName, golfers2.Handicap, "

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>


    <!DOCTYPE html>
    <html>

    <head>
        <!--
		Name: Caleb Sucietto
		Class: IT-117-400 Web-App
		Abstract: Golfathon
		-->
        <title>Assignment6</title>
        <meta charset=utf-8>
        <link rel="stylesheet" href="golfathon.css">
        <script src="http://cdnjs.cloudfare.com/ajax/libs/html5shiv/3.6/html5shiv/min.js"></script>
        <script>
            function sortTable(n) {
                var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
                table = document.getElementById("golferStats");
                switching = true;
                // Set the sorting direction to ascending:
                dir = "asc";
                /* Make a loop that will continue until
                no switching has been done: */
                while (switching) {
                    // Start by saying: no switching is done:
                    switching = false;
                    rows = table.rows;
                    /* Loop through all table rows (except the
                    first, which contains table headers): */
                    for (i = 1; i < (rows.length - 1); i++) {
                        // Start by saying there should be no switching:
                        shouldSwitch = false;
                        /* Get the two elements you want to compare,
                        one from current row and one from the next: */
                        x = rows[i].getElementsByTagName("TD")[n];
                        y = rows[i + 1].getElementsByTagName("TD")[n];
                        /* Check if the two rows should switch place,
                        based on the direction, asc or desc: */
                        if (dir == "asc") {
                            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                                // If so, mark as a switch and break the loop:
                                shouldSwitch = true;
                                break;
                            }
                        } else if (dir == "desc") {
                            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                                // If so, mark as a switch and break the loop:
                                shouldSwitch = true;
                                break;
                            }
                        }
                    }
                    if (shouldSwitch) {
                        /* If a switch has been marked, make the switch
                        and mark that a switch has been done: */
                        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                        switching = true;
                        // Each time a switch is done, increase this count by 1:
                        switchcount++;
                    } else {
                        /* If no switching has been done AND the direction is "asc",
                        set the direction to "desc" and run the while loop again. */
                        if (switchcount == 0 && dir == "asc") {
                            dir = "desc";
                            switching = true;
                        }
                    }
                }
            }
            sortTable(3);
        </script>
    </head>

    <body>
        <b>Golfathon</b>
        <br>
        <br>
        <nav class="Navigation">
            <ul>
                <li><a href="Registration.php" class="navbutton">Registration</a></li>
                <li><a href="Golfers.php" class="navbutton">Golfers</a></li>
                <li><a href="Donations.php" class="navbutton">Donations</a></li>
                <li><a href="Statistics.php" class="navbutton">Statistics</a></li>
                <li><a href="AdministrationLogin.html" class="navbutton">Administration Login</a></li>
            </ul>
        </nav>
        <div id="StatisticsContent">
            <h1>Current Event Stats</h1>
            <h2>Total Raised:
                <?php
                // To show the value to the user
                echo '$' . $eventPledgeTotal;
                ?></h2><br>
            <h2>Number of Donations:
                <?php
                // To show the value to the user
                echo $eventPledgeCount;
                ?>
            </h2><br>
            <h2>Average Donation:
                <?php
                // To show the value to the user
                echo '$' . $eventPledgeAverage;
                ?>
            </h2><br>
            <h2>Leaderboard:</h2><br>

            <table id="golferStats">
                <tr>
                    <th>Rank</th>
                    <th>Golfer Name</th>
                    <th>Handicap</th>
                    <th>Total Pledged</th>
                    <th>Donors</th>
                </tr>
                <?php
                // use a while loop to fetch data
                // from the $all_categories variable
                // and individually display as an option
                while ($golfer = mysqli_fetch_array(
                    $all_golfers,
                    MYSQLI_ASSOC
                )) :;
                ?>
                    <tr>
                        <td>
                            1
                        </td>
                        <td>
                            <?php
                            echo $golfer["FirstName"] . " " . $golfer["LastName"];
                            // To show the golfer's name to the user
                            ?>
                        </td>
                        <td>
                            <?php
                            //Get latest event from events table
                            $sqlSelectPledgeAmount = "Select SUM(Amount) from donations WHERE EventID = '$currentEvent' AND GolferID = '$golfer[GolferID]'";
                            $all_pledges = mysqli_query($con, $sqlSelectPledgeAmount);
                            $row = mysqli_fetch_array($all_pledges, MYSQLI_ASSOC);
                            $row = array_reverse($row);
                            $pledgeTotal = array_pop($row);

                            // To show the value to the user
                            echo '$' . $pledgeTotal;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $golfer["Handicap"];
                            // To show the golfer's handicap to the user
                            ?>
                        </td>
                        <td>
                            <a href="<?php echo "GolferDonations.php/?golferId=" . $golfer["GolferID"] . "&eventId=" . $currentEvent;
                                        // The value we usually set is the primary key
                                        ?>">
                                Show Donors
                            </a>
                        </td>
                    </tr>

                <?php
                endwhile;
                // While loop must be terminated
                ?>
            </table>
        </div>
    </body>

    </html>
</body>

</html>