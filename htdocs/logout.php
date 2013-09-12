<?php
	session_start();

	// Rimuovo le variabili di sessione
	unset($_SESSION['name']);
	unset($_SESSION['pass']);
	
	header('Location: index.php');
?>
