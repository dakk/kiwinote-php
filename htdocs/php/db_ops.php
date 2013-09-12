<?php
	function getUser($name)
	{
		require('db.php');
	
		$conn = mysql_connect($db_host, $db_user, $db_pass);
		$database = mysql_select_db($db_name, $conn);

		$query = "select * from user where name='$name'";
		$result = mysql_query($query);

		if($result)
		{
			$num_rows = mysql_num_rows($result);
			if($num_rows == 1)
				return mysql_fetch_array($result);
			else
				return null;
		}
		else
			return null;		
	}


	function getUserByMail($mail)
	{
		require('db.php');
	
		$conn = mysql_connect($db_host, $db_user, $db_pass);
		$database = mysql_select_db($db_name, $conn);

		$query = "select * from user where email='$mail'";
		$result = mysql_query($query);

		if($result)
		{
			$num_rows = mysql_num_rows($result);

			if($num_rows == 1)
				return mysql_fetch_array($result);
			else
				return null;
		}
		else
			return null;		
	}


	function getUserNotes($owner_name, $wiki_page)
	{
		require('db.php');
	
		$conn = mysql_connect($db_host, $db_user, $db_pass);
		$database = mysql_select_db($db_name, $conn);

		$query = "select * from note where owner_name='$owner_name' and wiki_page='$wiki_page'";
		$result = mysql_query($query);
		
		return $result;
	}

	function getUserNote($owner_name, $wiki_page, $id)
	{
		require('db.php');
	
		$conn = mysql_connect($db_host, $db_user, $db_pass);
		$database = mysql_select_db($db_name, $conn);

		$query = "select * from note where owner_name='$owner_name' and wiki_page='$wiki_page' and id='$id'";
		$result = mysql_query($query);
		$result = mysql_fetch_array($result);

		return $result;
	}

	function getUserPages($owner_name)
	{
		require('db.php');
	
		$conn = mysql_connect($db_host, $db_user, $db_pass);
		$database = mysql_select_db($db_name, $conn);

		$query = "select wiki_page, wiki_page_title, count(*) as n from note where owner_name='$owner_name' group by wiki_page, wiki_page_title";
		$result = mysql_query($query);

		return $result;
	}


	function getUserPagesNumber($owner_name)
	{
		require('db.php');
	
		$conn = mysql_connect($db_host, $db_user, $db_pass);
		$database = mysql_select_db($db_name, $conn);

		$query = "select count(*) as n from note where owner_name='$owner_name' group by owner_name";
		$result = mysql_query($query);

		if($result)
			return mysql_num_rows($result);
		else
			return 0;
	}

	function createNote($owner_name, $wiki_page, $wiki_page_title, $type, $data, $title)
	{
		require('db.php');

		$conn = mysql_connect($db_host, $db_user, $db_pass);
		$database = mysql_select_db($db_name, $conn);
						
		$query = "insert into note (id, owner_name, wiki_page, wiki_page_title, type, data, title, creation_date) VALUES (NULL, '$owner_name', '$wiki_page', '$wiki_page_title', '$type', '$data', '$title', NOW());";
		$result = mysql_query($query);
							
		if($result)
			return true;
		else
			return false;
	}


	function deleteNote($owner_name, $id)
	{
		require('db.php');
			
		$conn = mysql_connect($db_host, $db_user, $db_pass);
		$database = mysql_select_db($db_name, $conn);

		$query = "delete from note where owner_name='".$owner_name."' and id='".$id."'";
	
		$result = mysql_query($query);

		return $result;		
	}


	function editNote($owner_name, $id, $title, $data)
	{
		require('db.php');
			
		$conn = mysql_connect($db_host, $db_user, $db_pass);
		$database = mysql_select_db($db_name, $conn);

		$query = "update note set title='".$title."', data='".$data."' where id='".$id."' and owner_name='".$owner_name."'";
		//echo $query;
		$result = mysql_query($query);

		return $result;
	}


	function getPageTitle($url)
	{
		$opts = array(
		  'http'=>array(
			'method'=>"GET",
			'header'=>"Accept-language: en\r\n" .
				      "Cookie: foo=bar\r\n" .
					  "User-Agent: Firefox\r\n"
		  )
		);

		$context = stream_context_create($opts);


		$webpage = file_get_contents($url, false, $context);
		$title = explode("title>", $webpage);
		$title = str_replace("</", "", $title[1]);

		$title = str_replace(" - Wikipedia", "", $title);
		return $title;
	}



	function youtubeToEmb($url, $width, $height)
	{
		$id = explode("v=",$url);
		$id = $id[1];
		return "<iframe width='".$width."' height='".$height."' src='http://www.youtube.com/embed/".$id."' frameborder='0' allowfullscreen></iframe>";
	}

	function showNoteData($data, $type, $mobile)
	{
		switch($type)
		{
			case 1:
				echo $data;
				break;
			case 2:
				echo "<div align='center'><img src='".$data."' /></div>";
				break;
			case 3:
				echo "<div align='center'><a href='".$data."'>".$data."</a></div>";
				break;
			case 4:
				if($mobile)
					echo "<div align='center'>".youtubeToEmb($data,240,180)."</div>";
				else
					echo "<div align='center'>".youtubeToEmb($data,480,340)."</div>";
				break;

		};
	}
?>
