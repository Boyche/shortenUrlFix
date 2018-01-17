 <?php
	
	$data = json_decode(file_get_contents("php://input"), true);	
	$url = $data["url"]; 
	
	require_once("functions.php"); 
	$conn = connectToDatabase(); 
	
	
	//make short url calling hash function with adler32 algorithm, it gives 8 chars long hash string.	
	$shortUrl = hash('adler32', $url);
		
		
	//first we check if we have that input in database
	$query = "SELECT * 
					FROM requests 
					WHERE SHORTURL = ? AND FULLURL = ? ";
					
	$stmt = $conn->prepare($query);
	$stmt->bind_param('ss', $shortUrl, $url); 
	$stmt->execute();
	$result = $stmt->get_result();
	
	//if there is one, finish this by returning  existing short url from database
	if($row = $result->fetch_assoc()){
		$obj = new stdClass();
		$obj->original_link = $url;
		$obj->short_link = $shortUrl;
		
		header("200 OK", true, 200);
		die(json_encode($obj));
	}

	//if there is not the same entry, we have make sure that we avoid collision, although its low chanse.	
	//randomly add digit, lowercase  or uppercase letter to the end untill we get unique short url.
	while(true){
	
		$query = "SELECT * 
						FROM requests 
						WHERE SHORTURL = ? AND FULLURL <> ?";
						
		$stmt = $conn->prepare($query);
		$stmt->bind_param('ss', $shortUrl, $url); 
		$stmt->execute();
		$result = $stmt->get_result();
		
		
		if($result->num_rows == 0){
			break;
		}else{
			$chars ="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$index = rand(0, $chars.length());
			$shortUrl .= $chars[$index];
		}
	}
	
	
	
	//add a row into database. 
	$query="INSERT INTO `requests`
				(`FULLURL`, `SHORTURL`) 
				VALUES 
				(?, ?)";
	
	$stmt = $conn->prepare($query);
	$stmt->bind_param('ss', $url, $shortUrl);
	$stmt->execute();

	//creating object of standard Class and adding attributes to it
	$obj = new stdClass();
	$obj->original_link = $url;
	$obj->short_link = $shortUrl;
	
	header("200 OK", true, 200);
	die(json_encode($obj));

?>