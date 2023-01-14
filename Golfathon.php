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
$sqlSelectMostDonations = "SELECT GolferID, COUNT(DonationID) DonationCount FROM donations
WHERE EventID = '$currentEvent' GROUP BY GolferID ORDER BY DonationCount DESC LIMIT 1;";
$all_donationsRank = mysqli_query($con, $sqlSelectMostDonations);
$pledgeCountRow = mysqli_fetch_array($all_donationsRank, MYSQLI_ASSOC);
$pledgeCountRow = array_reverse($pledgeCountRow);
$golferPledgeLeader = array_pop($pledgeCountRow);

//Get golferevent pairings from the selected year
$sqlSelectPledgeLeader = "SELECT FirstName, LastName FROM golfers2 WHERE GolferID LIKE '$golferPledgeLeader'";
$all_leaders = mysqli_query($con, $sqlSelectPledgeLeader);
$pledgeLeaderRow = mysqli_fetch_array($all_leaders, MYSQLI_ASSOC);
$pledgeLeaderRow = array_reverse($pledgeLeaderRow);
$pledgeLeaderFirst = array_pop($pledgeLeaderRow);
$pledgeLeaderLast = array_pop($pledgeLeaderRow);

//Get golferevent pairings from the selected year
$sqlSelectGolfers = "SELECT COUNT(GolferID) FROM golfers2 WHERE GolferID IN (SELECT GolferID FROM golferevent WHERE EventID = '$currentEvent')";
$all_golfers = mysqli_query($con, $sqlSelectGolfers);
$countRow = mysqli_fetch_array($all_golfers, MYSQLI_ASSOC);
$countRow = array_reverse($countRow);
$golfersCount = array_pop($countRow);
?>


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
            <li><a href="Golfathon.php" class="navbutton">Home</a></li>
            <li><a href="Registration.php" class="navbutton">Registration</a></li>
            <li><a href="Golfers.php" class="navbutton">Golfers</a></li>
            <li><a href="Donations.php" class="navbutton">Donations</a></li>
            <li><a href="Statistics.php" class="navbutton">Statistics</a></li>
            <li><a href="AdministrationLogin.html" class="navbutton">Administration Login</a></li>
        </ul>
    </nav>
    <div class="content">
        <h1>Current Event Stats</h1>
        <h2>Total Raised:
            <?php
            // To show the value to the user
            echo '$' . $eventPledgeTotal;
            ?></h2><br>
        <h2>Donations Leader:
            <?php
            // To show the value to the user
            echo $pledgeLeaderFirst . " " . $pledgeLeaderLast;
            ?>
        </h2><br>
        <h2>Average Donation:
            <?php
            // To show the value to the user
            echo $golfersCount;
            ?>
        </h2><br>
		<p>Golfathon is a tournament that attracts some of the best local talent around to raise money for charity. To register a golfer navigate to the Registration page, to view participents navigate to the Golfers page.
		Donations can be made via the Donation page. To see who is winning in the event, navigate to the Statistics page. Administrators to add events and manage golfers navigate to Administration login.</p>
</body>

</html>