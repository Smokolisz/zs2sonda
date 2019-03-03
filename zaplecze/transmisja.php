<?php

	session_start();
	
	/* SQL */
	ini_set("display_errors", 1);
	require_once 'dbconnect.php';
	$conn = mysqli_connect($host, $user, $password);
	mysqli_query($conn, "SET CHARSET utf8");
	mysqli_query($conn, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
	mysqli_select_db($conn, $database);
		
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		echo "\n Error: ".$conn->connect_errno." Opis: ".$conn->connect_error;
	}
	
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		$zalogowany=true;
	}
	else $zalogowany=false;
	
	if(isset($_POST["url"]))
	{
		$url = $_POST["url"];
		if(mysqli_query($conn, "UPDATE transmisja SET url='$url'")) {
			echo 'Sukces!';
		} else {
			echo 'ERROR!';
			header('refresh: 2;');
			exit;
		}
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title>Zarządzaj stroną - powiadomienia</title>
	
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="description" content="Opis w Google" />
	<meta name="keywords" content="słowa, kluczowe, wypisane, po, porzecinku" />
	<meta name="robots" content="noindex,nofollow" />

	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

</head>
<body>

	<main>
	
		<section id="left">		<!-- MENU -->
	
			<nav>
			
				<ul>
					<li class="pozycja-menu"><a href="index.php">PRZEGLĄDAJ</a></li>
					<li class="pozycja-menu"><a href="nowy-artykul.php">NOWY ARTYKUŁ</a></li>
					<li class="pozycja-menu"><a href="nowa-kategoria.php">NOWA KATEGORIA</a></li>
					<li class="pozycja-menu"><a href="transmisja.php">TRANSMISJA</a></li>
				</ul>
				<div class="clear-both"></div> 
				
			</nav>
			
		</section>
		
		<section id="right">	<!-- NARZĘDZIE --> <!-- TRANSMISJA -->
		
			<header id="title">
				<h1>Podaj link do transmisji:</h1>
			</header>
			<div id="editor">
			<form method="POST">
				<input type="url" name="url" placeholder="URL" required><br>
				<input type="submit"><br><br>

				<?php
					$query = mysqli_query($conn, "SELECT * FROM transmisja");

					$row = mysqli_fetch_assoc($query);

					echo '<p>Obecny link to: <a href="'.$row["url"].'" target="_blank">'.$row["url"].'</a></p>';
				?>
			</form>
				
			</div>
		</section>
	
	</main>
	
	<?php
	mysqli_close($conn);
	?>
	
</body>
</html>