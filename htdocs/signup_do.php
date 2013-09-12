<?php 
	session_start();

	// Se l'utente e' loggato lo mando alla home
	if(isset($_SESSION['name']))
	{		
		echo "3";
	}
	else
	{		
		require('php/db.php');
		require('php/db_ops.php');

		$name = $_POST['name']; //mysql_real_escape_string($_POST['name']);
		$pass = md5($_POST['pass']);
		$mail = $_POST['mail']; //mysql_real_escape_string($_POST['mail']);

		if(getUserByMail($mail) != NULL)
		{
			echo "2";
		}
		else if (getUser($name) != NULL)
		{
			echo "1";
		}
		else
		{
			$conn = mysql_connect($db_host, $db_user, $db_pass);
			$database = mysql_select_db($db_name, $conn);
						
			$query = "insert into user (id, name, pass_hash, email, reg_date) VALUES (NULL ,  '$name',  '$pass',  '$mail', NOW());";
			$result = mysql_query($query);
							
			if($result)
			{				
				$_SESSION['name'] = $name;
				$_SESSION['pass'] = $pass;

				echo "0";
			}
			else
			{
				echo "1";
			} 
		}
	}
?>
