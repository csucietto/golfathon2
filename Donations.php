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
$currentEvent = array_pop(array_reverse($row));;


// The following code checks if the submit button is clicked
// and inserts the data in the database accordingly
if (isset($_POST['submit'])) {
    // Store the sql data in the variables
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $golfer = $_POST['golfer'];
    $amount = $_POST['amount'];
    $method = $_POST['method'];
    $status = "unpaid";
    if($method == "credit card"){
        $status = "paid";
    }

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
    else {
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
        <div id="DonationContent">

            <form name="donationForm" id="form" action="" method="POST">

                <b>Donations</b>

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
                    <select name="state">
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="DC">District Of Columbia</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
                    </select>
                </p>

                <p>
                    <label>Zipcode: </label> <br>
                    <input type="text" name="zip" />
                </p>

                <p>
                    <label>Beneficiary Golfer: </label> <br>
                    <select name="golfer">
                        <?php
                        // use a while loop to fetch data
                        // from the $all_categories variable
                        // and individually display as an option
                        while ($golfer = mysqli_fetch_array(
                            $all_golfers,
                            MYSQLI_ASSOC
                        )) :;
                        ?>
                            <option value="<?php echo $golfer["GolferID"];
                                            // The value we usually set is the primary key
                                            ?>">
                                <?php
                                echo $golfer["FirstName"];
                                echo $golfer["LastName"];
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
                    <label>Donation Amount: </label> <br>
                    <input type="text" name="amount" />
                </p>
                <p>
                    <label>Payment Method: </label> <br>
                    <select name="method">
                        <option value="cash">Cash</option>
                        <option value="check">Check</option>
                        <option vaule="credit card">Credit Card</option>
                    </select>
                </p>
                <p>
                    <input class="button" type="submit" id="submitbtn" name="submit" value="Donate" />
                    <input class="button" type="reset" id="clearbtn" value="Clear" />
                </p>

            </form>
        </div>
    </body>

    </html>
</body>

</html>