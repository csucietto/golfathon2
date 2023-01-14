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
$all_eventPledgeCount = mysqli_query($con, $sqlSelectEventPaidAmount);
$pledgeCountRow = mysqli_fetch_array($all_eventPledgeCount, MYSQLI_ASSOC);
$pledgeCountRow = array_reverse($pledgeCountRow);
$eventPledgeCount = array_pop($pledgeCountRow);

$eventPledgeAverage = $eventPledgeTotal / $eventPledgeCount;

//Get golferevent pairings from the selected year
$sqlSelectGolfers = "Select * from golfers2 WHERE GolferID in (Select GolferID from golferevent WHERE EventID = '$currentEvent')";
$all_golfers = mysqli_query($con, $sqlSelectGolfers);

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
                echo `$` . $eventPledgeTotal;
                ?></h2><br>
            <h2>Number of Donations: 
            <?php
                // To show the value to the user
                echo `$` . $eventPledgeCount;
                ?>
            </h2><br>
            <h2>Average Donation: 
            <?php
                // To show the value to the user
                echo `$` . $eventPledgeAverage;
                ?>
            </h2><br>
            <h2>Leaderboard:</h2><br>

            <table>
                <tr>
                    <th>Golfer Name</th>
                    <th>Total Pledged</th>
                    <th>Total Collected</th>
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
                            <a href="<?php echo "ManageGolferDonations.php/?id=" . $golfer["GolferID"] . "&year=" . $selectedYear;
                                        // The value we usually set is the primary key
                                        ?>">
                                <?php
                                echo $golfer["FirstName"] . " " . $golfer["LastName"];
                                // To show the golfer's name to the user
                                ?>
                            </a>
                        </td>
                        <td>
                            <?php
                            //Get latest event from events table
                            $sqlSelectPledgeAmount = "Select SUM(Amount) from donations WHERE EventID = '$selectedYear' AND GolferID = '$golfer[GolferID]'";
                            $all_pledges = mysqli_query($con, $sqlSelectPledgeAmount);
                            $row = mysqli_fetch_array($all_pledges, MYSQLI_ASSOC);
                            $row = array_reverse($row);
                            $pledgeTotal = array_pop($row);

                            // To show the value to the user
                            echo `$` . $pledgeTotal;
                            ?>
                        </td>
                        <td>
                            <?php
                            //Get latest event from events table
                            $sqlSelectDonationsAmount = "Select SUM(Amount) from donations WHERE EventID = '$selectedYear' AND GolferID = '$golfer[GolferID]' AND Status = 'paid'";
                            $all_donations = mysqli_query($con, $sqlSelectDonationsAmount);
                            $row = mysqli_fetch_array($all_donations, MYSQLI_ASSOC);
                            $row = array_reverse($row);
                            $donationsTotal = array_pop($row);

                            // To show the value to the user
                            echo `$` . $donationsTotal;
                            ?>
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