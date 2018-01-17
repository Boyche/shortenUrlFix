<?php

	
	if(isset($_GET['shortUrl'])){
	
		$url = $_GET['shortUrl'];
		
		require_once('functions.php'); 
		$conn = connectToDatabase(); 
		
		//preparing query that will find real url hidding behind short url if it exists
		$query = "SELECT * 
						FROM `requests` 
						WHERE SHORTURL = ?";
		
		$stmt = $conn->prepare($query);
		
		
		if(!$stmt->bind_param('s', $url)){ 
			//if there is any error it will be displayed with 404 respond
			header("404 Not Found", true, 404);
			die( 'Error in query: '.$conn->error);
		}
		
		
		if(!$stmt->execute()){  
			//if there is any error it will be displayed with 404 respond
			header("404 Not Found", true, 404);
			die( 'Error in query: '.$conn->error);
		}
			
		$result = $stmt->get_result();
		if ($row = $result->fetch_assoc()) { 
			// with htmlentities we prevent any kind of cross site scripting attack.
			header("Location: ".htmlentities($row['FULLURL']),TRUE,301);
		}else{
			//if there is no shorten link, we return 404 not found
			header("404 Not Found", TRUE, 404);
		}
	}else{
		header("404 Not Found", TRUE, 404);
	}

?> 

