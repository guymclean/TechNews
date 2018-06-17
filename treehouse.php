<?php

function getTreehouse() {
	$articles = array();
	$url = "http://blog.teamtreehouse.com/feed";

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
			    	"source" => "Treehouse",
			    	"date" => $date
			    );
			    array_push($articles, $article);
			}
		}
	}
	return $articles;
}

?>