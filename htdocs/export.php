<?php
	session_start();

	$url = $_GET['url'];
	$format = $_GET['format'];

	require('php/db.php');
	require('php/db_ops.php');
	require('php/conf.php');

	$notes = getUserNotes($_SESSION['name'], $url);
	$title = mysql_fetch_array($notes);
	$title = $title['wiki_page_title'];
	$notes = getUserNotes($_SESSION['name'], $url);



	if($format == "xml")
	{	
		header('Content-type: text/xml');
		header('Content-disposition: attachment; filename="'.$title.'.xml"');

		echo "<notes>\n";
		while ($row = mysql_fetch_array($notes)) 
		{
			echo "\t<note>\n\t\t<title>".$row['title']."</title>\n\t\t<data>".$row['data']."</data>\n\t</note>\n";
		}
		echo "</notes>\n";
	}
	else if($format == "txt")
	{	
		header('Content-type: text/plain');
		header('Content-disposition: attachment; filename="'.$title.'.txt"');


		while ($row = mysql_fetch_array($notes)) 
		{
			echo $row['title']."\n".$row['data']."\n\n";
		}
	}

?>
