<?php

include 'tech-review.php';
include 'coding-dojo.php';
include 'sitepoint.php';
include 'treehouse.php';


function getNewArticles() {
	$articles = array();
	$articles = array_merge($articles, getTechReview());
	$articles = array_merge($articles, getCodingDojo());
	$articles = array_merge($articles, getSitePoint());
	$articles = array_merge($articles, getTreehouse());

	return $articles;
}


function connectToDB() {
	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "technews";

	$conn = new mysqli($host, $user, $password, $database);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	return $conn;
}


function addToDB($articles) {
	$conn = connectToDB();	

	foreach($articles as $article) {
		$title = $article['title'];
		$link = $article['link'];
		$source = $article['source'];
		$date = $article['date'];

		$sql = "INSERT INTO articles (
			title,
			link,
			source,
			pubDate
		) VALUES (
			'$title',
			'$link',
			'$source',
			'$date'
		)";

		$result = $conn->query($sql);
	}
	$conn->close();
}


function removeOldArticles() {
	$conn = connectToDB();

	$sql = "DELETE FROM articles
	WHERE id NOT IN (
	  SELECT id
	  FROM (
	    SELECT id
	    FROM articles
	    ORDER BY pubDate DESC
	    LIMIT 100
	  ) foo
	)";

	$result = $conn->query($sql);
	if ($result) {
		echo "successfully removed old articles";
	}
	else {
		echo "failed to remove old articles: ", $conn->error();
	}

	$conn->close();
}


$newArticles = getNewArticles();
addToDB($newArticles);
removeOldArticles();

?>
