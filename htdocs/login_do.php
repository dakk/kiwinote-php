<?php 
	session_start();

	// Se l'utente e' loggato lo mando alla home
	if(isset($_SESSION['name']))
	{		
		echo "0";
	}
	else
	{		
		require('php/db.php');
		require('php/db_ops.php');

		$name = $_POST['name']; //mysql_real_escape_string($_POST['name']);
		$pass = md5($_POST['pass']);

		$userrow = getUser($name);

		if($userrow == NULL)
		{
			echo "1";
		}
		else
		{
			if($userrow['pass_hash'] == $pass)
			{				
				$_SESSION['name'] = $name;
				$_SESSION['pass'] = $pass;

				echo "0";
			}
			else
			{
				echo "2";
			}
		}
	}
?>
