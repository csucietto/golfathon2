<?php

// Connect to database
$con = mysqli_connect("localhost", "root", "", "golfathon");

// mysqli_connect("servername","username","password","database_name")

// Get all the categories from category table
$sqlSelectEvents = "SELECT * FROM events2";
$all_events = mysqli_query($con, $sqlSelectEvents);

// The following code checks if the submit button is clicked
// and inserts the data in the database accordingly
if (isset($_POST['submit'])) {
    $selectedYear = $_POST['year'];

    //Get latest event from events table
    $sqlSelectGolfers = "Select GolferID from golferevent WHERE EventID = '$selectedYear'";
    $all_golfers = mysqli_query($con, $sqlSelectGolfers);
}
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
                <li><a href="Golfer.html" class="navbutton">Golfers</a></li>
                <li><a href="Donations.php" class="navbutton">Donations</a></li>
                <li><a href="Statistics.html" class="navbutton">Statistics</a></li>
                <li><a href="AdministrationLogin.html" class="navbutton">Administration Login</a></li>
            </ul>
        </nav>
        <div id="ManageGolfersContent">
            <form name="selectYearForm" id="form" action="" method="POST">
                <p>
                    <label>Event Year: </label> <br>
                    <select name="year">
                        <?php
                        // use a while loop to fetch data
                        // from the $all_categories variable
                        // and individually display as an option
                        while ($year = mysqli_fetch_array(
                            $all_events,
                            MYSQLI_ASSOC
                        )) :;
                        ?>
                            <option value="<?php echo $year["EventID"];
                                            // The value we usually set is the primary key
                                            ?>">
                                <?php
                                echo $golfer["EventYear"];
                                // To show the category name to the user
                                ?>
                            </option>
                        <?php
                        endwhile;
                        // While loop must be terminated
                        ?>
                    </select>
                </p>
                <p>
                    <input class="button" type="submit" id="submitbtn" name="submit" value="Select" />
                </p>
            </form>
            <br />
            <h1>Event Pledge Total: </h1>
            <h1>Event Collected Total: </h1>
            <table>
                <tr>
                    <th>Golfer Name</th>
                    <th>Total Pledged</th>
                    <th>Total Collected</th>
                    <th>Update Payment Status</th>
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
                            <?php
                            echo $golfer["FirstName"] . " " . $golfer["LastName"];
                            // To show the golfer's name to the user
                            ?>
                        </td>
                        <td>
                            <?php
                            echo "Placeholder";
                            // To show the golfer's name to the user
                            ?>
                        </td>
                        <td>
                            <?php
                            echo "Placeholder";
                            // To show the golfer's name to the user
                            ?>
                        </td>
                        <td>
                            <a href="<?php echo "ManageGolferDonations.php/?" . $golfer["GolferID"];
                                        // The value we usually set is the primary key
                                        ?>">
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