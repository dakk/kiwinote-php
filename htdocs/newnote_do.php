<?php 
	session_start();

	if(!isset($_SESSION['name']))
	{		
		echo "3";
	}
	else
	{		
		require('php/db.php');
		require('php/db_ops.php');

		$title = $_POST['title']; //mysql_real_escape_string($_POST['name']);
		$data = $_POST['data'];
		$page = $_POST['url']; //mysql_real_escape_string($_POST['mail']);
		$type = $_POST['type']; //mysql_real_escape_string($_POST['mail']);
		$ptitle = getPageTitle($page); //$_POST['page_title'];
		//echo $page;

		if(isset($_POST['edit']))
			$edit = $_POST['edit'];
		else
			$edit = '0';


		$result = NULL;

		if($edit != '0')
		{
			$result = editNote($_SESSION['name'], $edit, $title, $data);
		}
		else
		{
			$result = createNote($_SESSION['name'], $page, $ptitle, $type, $data, $title);
		}

		if($result)
		{				
			echo "0";
		}
		else
		{
			echo "1";
		} 
	}
?>
