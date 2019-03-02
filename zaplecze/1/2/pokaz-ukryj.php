<?php

	if(!isset($_POST["id"])||!isset($_POST["widoczny"]))
	{
		header('Location: przegladaj.php');
		exit();
	}

	/* SQL */
	ini_set("display_errors", 1);
	require_once 'dbconnect.php';
	$polaczenie = mysqli_connect($host, $user, $password);
	mysqli_query($polaczenie, "SET CHARSET utf8");
	mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
	mysqli_select_db($polaczenie, $database);
		
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		echo "\n Error: ".$polaczenie->connect_errno." Opis: ".$polaczenie->connect_error;
	}
	
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		$zalogowany=true;
	}
	else $zalogowany=false;
	
	$idWpisu = $_POST["id"];
	$widoczny = $_POST["widoczny"];
	
	if($widoczny)
	{
		$id = mysqli_query($polaczenie, "UPDATE wpisy SET widoczny=0 WHERE id='$idWpisu'");
	}
	else
	{
		$id = mysqli_query($polaczenie, "UPDATE wpisy SET widoczny=1 WHERE id='$idWpisu'");
	}

	mysqli_close($polaczenie);
	header('Location: index.php');

?>