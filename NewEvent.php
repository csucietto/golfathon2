    <?php      
        include('connection.php');  
        $eventyear = $_POST['EventYear'];  
          
            
          
            $sql = "insert into events2 (EventID, EventYear) values('$eventyear', '$eventyear')";  

              
			if ($con->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
    ?>  