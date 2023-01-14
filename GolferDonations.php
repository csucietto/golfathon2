<?php

// Connect to database
$con = mysqli_connect("localhost", "root", "", "golfathon");
// mysqli_connect("servername","username","password","database_name")


$golferid = htmlspecialchars($_GET["golferId"]);
$eventid = htmlspecialchars($_GET["eventId"]);

//Get latest event from events table
$sqlSelectDonations = "Select *  from donations WHERE GolferID = '$golferid' AND EventID = '$eventid'";
$all_donations = mysqli_query($con, $sqlSelectDonations);
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
        <link rel="stylesheet" href="../golfathon.css">
        <script src="http://cdnjs.cloudfare.com/ajax/libs/html5shiv/3.6/html5shiv/min.js"></script>
    </head>

    <body>
        <b>Golfathon</b>
        <br>
        <br>
        <nav class="Navigation">
            <ul>
                <li><a href="../Golfathon.php" class="navbutton">Home</a></li>
                <li><a href="../Registration.php" class="navbutton">Registration</a></li>
                <li><a href="../Golfers.php" class="navbutton">Golfers</a></li>
                <li><a href="../Donations.php" class="navbutton">Donations</a></li>
                <li><a href="../Statistics.php" class="navbutton">Statistics</a></li>
                <li><a href="../AdministrationLogin.html" class="navbutton">Administration Login</a></li>
            </ul>
        </nav>
        <div id="GolferDonationsContent">
            <table>
                <tr>
                    <th>Donor Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Donation</th>
                </tr>
                <?php
                // use a while loop to fetch data
                // from the $all_categories variable
                // and individually display as an option
                while ($donation = mysqli_fetch_array(
                    $all_donations,
                    MYSQLI_ASSOC
                )) :;
                ?>
                    <tr>
                        <td>
                            <?php
                            echo $donation["FirstName"] . " " . $donation["LastName"];
                            // To show the donor's info to the user
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $donation["Email"];
                            // To show the donor's info to the user
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $donation["Phone"];
                            // To show the donor's info to the user
                            ?>
                        </td>
                        <td>
                            <?php
                            echo '$' . $donation["Amount"];
                            // To show the donor's info to the user
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