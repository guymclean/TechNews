<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "technews";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT title, link, source, pubDate
	FROM articles";

$result = $conn->query($sql);

$obj = array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	array_push($obj, $row);
    }
    $json = json_encode($obj);
    
} else {
    $json = "{'message': 'fail'}";
}

$conn->close();

echo $json;

?>
