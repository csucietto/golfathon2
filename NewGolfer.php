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

               if(mysqli_query($con, $sql)) {	        
        
        echo "";	        
        
    } else {	        
        
        throw new Exception( "Error: " . $insertGolfer . "<br>" . mysqli_error($con) );	        
        
   }  

		
			
			$intGolferID = mysqli_insert_id($con);

    

			            $sql = "Select EventID from Events2 WHERE EventYear = (SELECT max(EventYear) FROM Events2)";  
            $result = mysqli_query($con, $sql);  
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $count = mysqli_num_rows($result);  
              
			if($count==1){

				include 'Admin.html';

            }  
            else{  
                echo "<h1> Login failed. Invalid username or password.</h1>";  
            }  
    ?>  