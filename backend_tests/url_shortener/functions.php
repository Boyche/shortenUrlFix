<?php

	/**
	* Function that connects to database
	* 
	* @return 		connection - an object of mysqli class
	*/
	function connectToDatabase(){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$database = "urlshortener";

		
		$conn = new mysqli($servername, $username, $password, $database);

		
		if ($conn->connect_error) {
			//die("Connection failed: " . $conn->connect_error);
		} 
		else return  $conn;
	}
	
?>