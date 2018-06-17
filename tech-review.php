<?php

function getTechReview() {
	$articles = array();
	$url = "https://www.technologyreview.com/topnews.rss";

	$xml = simplexml_load_file($url);
	if ($xml === false) {
	    echo "Failed loading XML: ";
	    foreach(libxml_get_errors() as $error) {
	        echo "<br>", $error->message;
	    }
	} else {
		foreach($xml->channel->children() as $item) { 
			if ($item->getName() == "item") {

			    $timestamp = strtotime($item->pubDate->__toString());
			    $date = date('Y-m-d H:i:s', $timestamp);

			    $article = array(
			    	"title" => $item->title->__toString(),
			    	"link" => $item->link->__toString(),
			    	"source" => "MIT Technology Review",
			    	"date" => $date
			    );
			    array_push($articles, $article);
			}
		}
	}
	return $articles;
}

?>