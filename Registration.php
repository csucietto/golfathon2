<?php

// Connect to database
$con = mysqli_connect("localhost", "root", "", "golfathon");

// mysqli_connect("servername","username","password","database_name")

//Get latest event from events table
$sqlSelectEvents = "Select EventID from events2 WHERE EventYear = (SELECT max(EventYear) FROM events2)";
$currentEvents = mysqli_query($con, $sqlSelectEvents);
$row = mysqli_fetch_array($currentEvents, MYSQLI_ASSOC);

// The following code checks if the submit button is clicked
// and inserts the data in the database accordingly
if (isset($_POST['submit'])) {
    // Store the sql data in the variables
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $state = mysqli_real_escape_string($con, $_POST['state']);
    $zip = mysqli_real_escape_string($con, $_POST['zip']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $handicap = mysqli_real_escape_string($con, $_POST['handicap']);
    $currentEvent = $row[0];

    /**
     * @todo: Check if email address is already in table and do not duplicate golfers 
     */
    // Creating an insert query using SQL syntax and
    // storing it in a variable.
    $sqlInsertGolfer =
        "INSERT INTO golfers2(FirstName, LastName, Email, Phone, `Address`, City, `State`, Zip, Gender, Handicap)
			VALUES ('$firstname', '$lastname', '$email', '$phone', '$address', '$city', '$state', '$zip', '$gender', '$handicap')";

    // The following code attempts to execute the SQL query
    // if the query executes with no errors
    // a javascript alert message is displayed
    // which says the data is inserted successfully
    if (mysqli_query($con, $sqlInsertGolfer)) {
        $golferid = mysqli_insert_id($conn);
        echo '<script>alert("You have successfully registered for Golfathon!")</script>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // Creating an insert query using SQL syntax and
    // storing it in a variable.
    $sqlInsertGolferEvent =
        "INSERT INTO golferevent(GolferID, EventID)
			VALUES ('$golferid', '$currentEvent')";

    // The following code attempts to execute the SQL query
    // if the query executes with no errors
    // a javascript alert message is displayed
    // which says the data is inserted successfully
    if (mysqli_query($con, $sqlInsertGolferEvent)) {
        echo '<script>alert("You have successfully registered for the current event!")</script>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
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
                <li><a href="Golfer.html" class="navbutton">Golfers</a></li>
                <li><a href="Donations.php" class="navbutton">Donations</a></li>
                <li><a href="Statistics.html" class="navbutton">Statistics</a></li>
                <li><a href="AdministrationLogin.html" class="navbutton">Administration Login</a></li>
            </ul>
        </nav>
        <div id="RegistrationContent">

            <form name="registrationForm" id="form" method="POST">
                <b>Golfer Registration</b>
                <p>
                    <label>First Name: </label> <br>
                    <input type="text" name="firstname" />
                </p>
                <p>
                    <label>Last Name: </label> <br>
                    <input type="text" name="lastname" />
                </p>
                <p>
                    <label>Email: </label> <br>
                    <input type="text" name="email" />
                </p>
                <p>
                    <label>Phone Number: </label> <br>
                    <input type="text" name="phone" />
                </p>
                <p>
                    <label>Address: </label> <br>
                    <input type="text" name="address" />
                </p>
                <p>
                    <label>City: </label> <br>
                    <input type="text" name="city" />
                </p>
                <p>
                    <label>State: </label> <br>
                    <input type="text" name="state" />
                </p>
                <p>
                    <label>Zipcode: </label> <br>
                    <input type="text" name="zip" />
                </p>
                <p>
                    <label>Gender: </label> <br>
                    <select name="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </p>
                <p>
                    <label>Handicap: </label> <br>
                    <input type="text" name="handicap" />
                </p>
                <p>
                    <input class="button" type="submit" id="submitbtn" value="Register" />
                    <input class="button" type="reset" id="clearbtn" value="Clear" />
                </p>
            </form>
        </div>
    </body>

    </html>
</body>

</html>