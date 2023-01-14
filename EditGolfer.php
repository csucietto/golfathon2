<?php

// Connect to database
$con = mysqli_connect("localhost", "root", "", "golfathon");
// mysqli_connect("servername","username","password","database_name")

$golferid = htmlspecialchars($_GET["id"]);

//Get golfers
$sqlSelectGolfers = "Select * from golfers2 WHERE GolferID like '$golferid'";

$all_golfers = mysqli_query($con, $sqlSelectGolfers);

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
    $gender = $_POST['gender'];
    $handicap = $_POST['handicap'];

    // Creating an insert query using SQL syntax and
    // storing it in a variable.
    $sqlUpdateGolfer =
        "UPDATE golfers2 SET FirstName = '$firstname', LastName = '$lastname', Email = '$email', Phone = '$phone', `Address` = '$address', City = '$city', `State` = '$state', Zip = '$zip', Gender = '$gender', Handicap = '$handicap'  WHERE GolferID like '$golferid'";

    // The following code attempts to execute the SQL query
    // if the query executes with no errors
    // a javascript alert message is displayed
    // which says the data is inserted successfully
    if (mysqli_query($con, $sqlUpdateGolfer)) {
        echo "<h1>Your information has been updated!</h1>";
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
                <li><a href="../Registration.php" class="navbutton">Registration</a></li>
                <li><a href="../Golfers.php" class="navbutton">Golfers</a></li>
                <li><a href="../Donations.php" class="navbutton">Donations</a></li>
                <li><a href="../Statistics.php" class="navbutton">Statistics</a></li>
                <li><a href="../AdministrationLogin.html" class="navbutton">Administration Login</a></li>
            </ul>
        </nav>
        <div id="EditGolferContent">

            <form name="editGolferForm" id="form" action="" method="POST">
                <?php
                // use a while loop to fetch data
                // from the $all_categories variable
                // and individually display as an option
                while ($golfer = mysqli_fetch_array(
                    $all_golfers,
                    MYSQLI_ASSOC
                )) :;
                ?>
                    <b>Update Golfer Information</b>
                    <p>
                        <label>First Name: </label> <br>
                        <input type="text" name="firstname" value="<?php echo $golfer["FirstName"]; ?>" />
                    </p>
                    <p>
                        <label>Last Name: </label> <br>
                        <input type="text" name="lastname" value="<?php echo $golfer["LastName"]; ?>" />
                    </p>
                    <p>
                        <label>Email: </label> <br>
                        <input type="text" name="email" value="<?php echo $golfer["Email"]; ?>" />
                    </p>
                    <p>
                        <label>Phone Number: </label> <br>
                        <input type="text" name="phone" value="<?php echo $golfer["Phone"]; ?>" />
                    </p>
                    <p>
                        <label>Address: </label> <br>
                        <input type="text" name="address" value="<?php echo $golfer["Address"]; ?>" />
                    </p>
                    <p>
                        <label>City: </label> <br>
                        <input type="text" name="city" value="<?php echo $golfer["City"]; ?>" />
                    </p>
                    <p>
                        <label>State: </label> <br>
                        <select name="state">
                            <option value="AL" <?php if($golfer['State']=="AL") echo "selected=\"selected\""; ?>>Alabama</option>
                            <option value="AK" <?php if($golfer['State']=="AK") echo "selected=\"selected\""; ?>>Alaska</option>
                            <option value="AZ" <?php if($golfer['State']=="AZ") echo "selected=\"selected\""; ?>>Arizona</option>
                            <option value="AR" <?php if($golfer['State']=="AR") echo "selected=\"selected\""; ?>>Arkansas</option>
                            <option value="CA" <?php if($golfer['State']=="CA") echo "selected=\"selected\""; ?>>California</option>
                            <option value="CO" <?php if($golfer['State']=="CO") echo "selected=\"selected\""; ?>>Colorado</option>
                            <option value="CT" <?php if($golfer['State']=="CT") echo "selected=\"selected\""; ?>>Connecticut</option>
                            <option value="DE" <?php if($golfer['State']=="DE") echo "selected=\"selected\""; ?>>Delaware</option>
                            <option value="DC" <?php if($golfer['State']=="DC") echo "selected=\"selected\""; ?>>District Of Columbia</option>
                            <option value="FL" <?php if($golfer['State']=="FL") echo "selected=\"selected\""; ?>>Florida</option>
                            <option value="GA" <?php if($golfer['State']=="GA") echo "selected=\"selected\""; ?>>Georgia</option>
                            <option value="HI" <?php if($golfer['State']=="HI") echo "selected=\"selected\""; ?>>Hawaii</option>
                            <option value="ID" <?php if($golfer['State']=="ID") echo "selected=\"selected\""; ?>>Idaho</option>
                            <option value="IL" <?php if($golfer['State']=="IL") echo "selected=\"selected\""; ?>>Illinois</option>
                            <option value="IN" <?php if($golfer['State']=="IN") echo "selected=\"selected\""; ?>>Indiana</option>
                            <option value="IA" <?php if($golfer['State']=="IA") echo "selected=\"selected\""; ?>>Iowa</option>
                            <option value="KS" <?php if($golfer['State']=="KS") echo "selected=\"selected\""; ?>>Kansas</option>
                            <option value="KY" <?php if($golfer['State']=="KY") echo "selected=\"selected\""; ?>>Kentucky</option>
                            <option value="LA" <?php if($golfer['State']=="LA") echo "selected=\"selected\""; ?>>Louisiana</option>
                            <option value="ME" <?php if($golfer['State']=="ME") echo "selected=\"selected\""; ?>>Maine</option>
                            <option value="MD" <?php if($golfer['State']=="MD") echo "selected=\"selected\""; ?>>Maryland</option>
                            <option value="MA" <?php if($golfer['State']=="MA") echo "selected=\"selected\""; ?>>Massachusetts</option>
                            <option value="MI" <?php if($golfer['State']=="MI") echo "selected=\"selected\""; ?>>Michigan</option>
                            <option value="MN" <?php if($golfer['State']=="MN") echo "selected=\"selected\""; ?>>Minnesota</option>
                            <option value="MS" <?php if($golfer['State']=="MS") echo "selected=\"selected\""; ?>>Mississippi</option>
                            <option value="MO" <?php if($golfer['State']=="MO") echo "selected=\"selected\""; ?>>Missouri</option>
                            <option value="MT" <?php if($golfer['State']=="MT") echo "selected=\"selected\""; ?>>Montana</option>
                            <option value="NE" <?php if($golfer['State']=="NE") echo "selected=\"selected\""; ?>>Nebraska</option>
                            <option value="NV" <?php if($golfer['State']=="NV") echo "selected=\"selected\""; ?>>Nevada</option>
                            <option value="NH" <?php if($golfer['State']=="NH") echo "selected=\"selected\""; ?>>New Hampshire</option>
                            <option value="NJ" <?php if($golfer['State']=="NJ") echo "selected=\"selected\""; ?>>New Jersey</option>
                            <option value="NM" <?php if($golfer['State']=="NM") echo "selected=\"selected\""; ?>>New Mexico</option>
                            <option value="NY" <?php if($golfer['State']=="NY") echo "selected=\"selected\""; ?>>New York</option>
                            <option value="NC" <?php if($golfer['State']=="NC") echo "selected=\"selected\""; ?>>North Carolina</option>
                            <option value="ND" <?php if($golfer['State']=="ND") echo "selected=\"selected\""; ?>>North Dakota</option>
                            <option value="OH" <?php if($golfer['State']=="OH") echo "selected=\"selected\""; ?>>Ohio</option>
                            <option value="OK" <?php if($golfer['State']=="OK") echo "selected=\"selected\""; ?>>Oklahoma</option>
                            <option value="OR" <?php if($golfer['State']=="OR") echo "selected=\"selected\""; ?>>Oregon</option>
                            <option value="PA" <?php if($golfer['State']=="PA") echo "selected=\"selected\""; ?>>Pennsylvania</option>
                            <option value="RI" <?php if($golfer['State']=="RI") echo "selected=\"selected\""; ?>>Rhode Island</option>
                            <option value="SC" <?php if($golfer['State']=="SC") echo "selected=\"selected\""; ?>>South Carolina</option>
                            <option value="SD" <?php if($golfer['State']=="SD") echo "selected=\"selected\""; ?>>South Dakota</option>
                            <option value="TN" <?php if($golfer['State']=="TN") echo "selected=\"selected\""; ?>>Tennessee</option>
                            <option value="TX" <?php if($golfer['State']=="TX") echo "selected=\"selected\""; ?>>Texas</option>
                            <option value="UT" <?php if($golfer['State']=="UT") echo "selected=\"selected\""; ?>>Utah</option>
                            <option value="VT" <?php if($golfer['State']=="VT") echo "selected=\"selected\""; ?>>Vermont</option>
                            <option value="VA" <?php if($golfer['State']=="VA") echo "selected=\"selected\""; ?>>Virginia</option>
                            <option value="WA" <?php if($golfer['State']=="WA") echo "selected=\"selected\""; ?>>Washington</option>
                            <option value="WV" <?php if($golfer['State']=="WV") echo "selected=\"selected\""; ?>>West Virginia</option>
                            <option value="WI" <?php if($golfer['State']=="WI") echo "selected=\"selected\""; ?>>Wisconsin</option>
                            <option value="WY" <?php if($golfer['State']=="WY") echo "selected=\"selected\""; ?>>Wyoming</option>
                        </select>
                    </p>
                    <p>
                        <label>Zipcode: </label> <br>
                        <input type="text" name="zip" value="<?php echo $golfer["Zip"]; ?>" />
                    </p>
                    <p>
                        <label>Gender: </label> <br>
                        <select name="gender">
                            <option value="Male" <?php if($golfer['Gender']=="Male") echo "selected=\"selected\""; ?>>Male</option>
                            <option value="Female" <?php if($golfer['Gender']=="Female") echo "selected=\"selected\""; ?>>Female</option>
                        </select>
                    </p>
                    <p>
                        <label>Handicap: </label> <br>
                        <input type="text" name="handicap" value="<?php echo $golfer["Handicap"]; ?>" />
                    </p>
                    <p>
                        <input class="button" type="submit" id="submitbtn" name="submit" value="Update" />
                        <input class="button" type="reset" id="clearbtn" value="Clear" />
                    </p>
                <?php
                endwhile;
                // While loop must be terminated
                ?>
            </form>
        </div>
    </body>

    </html>
</body>

</html>