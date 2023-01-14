<?php

// Connect to database
$con = mysqli_connect("localhost", "root", "", "golfathon");
// mysqli_connect("servername","username","password","database_name")

$donationid = htmlspecialchars($_GET["id"]);

// The following code checks if the submit button is clicked
// and inserts the data in the database accordingly
if (isset($_POST['submit'])) {
    // Store the sql data in the variables
    $status = $_POST['status'];

    // Creating an insert query using SQL syntax and
    // storing it in a variable.
    $sqlUpdateStatus =
        "UPDATE donations SET `Status` = '$status' WHERE DonationID like '$donationid'";

    // The following code attempts to execute the SQL query
    // if the query executes with no errors
    // a javascript alert message is displayed
    // which says the data is inserted successfully
    if (mysqli_query($con, $sqlUpdateStatus)) {
        echo "<h1>The payment status has been updated!</h1>";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
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
                <li><a href="Golfers.php" class="navbutton">Golfers</a></li>
                <li><a href="Donations.php" class="navbutton">Donations</a></li>
                <li><a href="Statistics.php" class="navbutton">Statistics</a></li>
                <li><a href="AdministrationLogin.html" class="navbutton">Administration Login</a></li>
            </ul>
        </nav>
        <div id="ManageDonationContent">
            <form name="manageDonationForm" id="form" action="" method="POST">
                <label>Payment Method: </label> <br>
                <p>
                    <select name="status">
                        <option value="paid">Paid</option>
                        <option value="unpaid">Unpaid</option>
                    </select>
                </p>
                <p>
                    <input class="button" type="submit" id="submitbtn" name="submit" value="Submit" />
                </p>
            </form>
        </div>
    </body>

    </html>
</body>

</html>