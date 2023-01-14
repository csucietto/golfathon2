<?php

// Connect to database
$con = mysqli_connect("localhost", "root", "", "golfathon");

// mysqli_connect("servername","username","password","database_name")

//Get golfers
$sqlSelectGolfers = "Select * from golfers2";

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
                <li><a href="Golfathon.php" class="navbutton">Home</a></li>
                <li><a href="Registration.php" class="navbutton">Registration</a></li>
                <li><a href="Golfers.php" class="navbutton">Golfers</a></li>
                <li><a href="Donations.php" class="navbutton">Donations</a></li>
                <li><a href="Statistics.php" class="navbutton">Statistics</a></li>
                <li><a href="AdministrationLogin.html" class="navbutton">Administration Login</a></li>
            </ul>
        </nav>
        <div id="GolfersContent">
            <table>
                <tr>
                    <th>Golfer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zip</th>
                    <th>Gender</th>
                    <th>Handicap</th>
                    <th>Controls</th>
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
                            echo $golfer["Email"];
                            // To show the golfer's info to the user
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $golfer["Phone"];
                            // To show the golfer's info to the user
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $golfer["Address"];
                            // To show the golfer's info to the user
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $golfer["City"];
                            // To show the golfer's info to the user
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $golfer["State"];
                            // To show the golfer's info to the user
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $golfer["Zip"];
                            // To show the golfer's info to the user
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $golfer["Gender"];
                            // To show the golfer's info to the user
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $golfer["Handicap"];
                            // To show the golfer's info to the user
                            ?>
                        </td>
                        <td>
                            <a href="<?php echo "EditGolfer.php/?id=" . $golfer["GolferID"];
                                        // The value we usually set is the primary key
                                        ?>">
                                Edit
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