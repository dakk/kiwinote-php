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


		$owner = $_SESSION['name']; //mysql_real_escape_string($_POST['mail']);
		$id = $_POST['id'];

		$result = deleteNote($owner, $id);
							
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
