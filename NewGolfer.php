<?php

// Connect to database
$con = mysqli_connect("localhost", "root", "", "golfathon");

// mysqli_connect("servername","username","password","database_name")

// Get all the categories from category table
$sqlSelectGolfers = "SELECT * FROM golfers2";
$all_golfers = mysqli_query($con, $sqlSelectGolfers);

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
    $golfer = mysqli_real_escape_string($con, $_POST['golfer']);
    $amount = mysqli_real_escape_string($con, $_POST['amount']);
    $status = mysqli_real_escape_string($con, $_POST['method']);
    $currentEvent = $row[0];

    // Creating an insert query using SQL syntax and
    // storing it in a variable.
    $sql_insert =
        "INSERT INTO donations(GolferID, EventID, Amount, Method, `Status`, FirstName, LastName, Email, Phone, `Address`, City, `State`, Zip)
			VALUES ('$golfer', '$currentEvent', '$amount','$method', '$status', '$firstname', '$lastname', '$email', '$phone', '$address', '$city', '$state', '$zip' )";

    // The following code attempts to execute the SQL query
    // if the query executes with no errors
    // a javascript alert message is displayed
    // which says the data is inserted successfully
    if (mysqli_query($con, $sql_insert)) {
        echo '<script>alert("Product added successfully")</script>';
    }
}
?>    

    <?php
    include('connection.php');
    $golferID = $_POST['EventYear'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $gender = $_POST['gender'];
    $handicap = $_POST['handicap'];

    $sql = "insert into golfers2 ( FirstName, LastName,Email, Phone, Address, City, State, Zip, Gender, Handicap) values( '$firstname','$lastname','$email', '$phone','$address','$city', '$state','$zip', '$gender','$handicap')";

    if (mysqli_query($con, $sql)) {

        echo "";
    } else {

        throw new Exception("Error: " . $insertGolfer . "<br>" . mysqli_error($con));
    }

    $intGolferID = mysqli_insert_id($con);

    $sql = "Select EventID from Events2 WHERE EventYear = (SELECT max(EventYear) FROM Events2)";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {

        include 'Admin.html';
    } else {
        echo "<h1> Login failed. Invalid username or password.</h1>";
    }
    ?>  