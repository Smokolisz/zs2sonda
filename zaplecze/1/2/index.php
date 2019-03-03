<?php
	/*$dir = dirname(__FILE__);
	echo "<p>Full path to this dir: " . $dir . "</p>";
	echo "<p>Full path to a .htpasswd file in this dir: " . $dir . "/.htpasswd" . "</p>";*/
	session_start();
	
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
	
	if(isset($_GET["search"]))
	{
		$search = htmlspecialchars($_GET["search"]);
		
		$search = strtolower($search);
		$search = strip_tags(trim($search));
		$search = $polaczenie -> escape_string($search);
		
		$id = mysqli_query($polaczenie,"SELECT * FROM wpisy WHERE tytul LIKE '%$search%' OR tresc LIKE '%$search%'");
		
		$ile = mysqli_num_rows($id);
	}
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		$zalogowany=true;
	}
	else $zalogowany=false;
	
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title>Zarządzaj stroną - przegladaj</title>
	
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
		
		<section id="right"><!-- NARZĘDZIE --><!-- PRZEGLĄDAJ -->
		
			<div id="tools">
			
			<div id="search">
			
				<form method="GET" action="">
				
					<input class="search-bar" type="text" name="search" placeholder="">
					
					<input type="submit" value="Szukaj" id="button-search">
				
				</form>
				<div class="clear-both"></div>
			
			</div>
			
			<?php

				if(isset($search))
				{
					echo '<br /><h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Znaleziono '.$ile; 
				
					if($ile == 1) echo ' artykuł';
					else if(($ile >= 2)&&($ile <= 4)) echo ' artykuły';
					else echo ' artykułów';
					
					echo '</h3>';
				}
				
				if(isset($_GET["search"]))
				{
					$id = mysqli_query($polaczenie,"SELECT * FROM wpisy WHERE tytul LIKE '%$search%' OR tresc LIKE '%$search%'");
				}
				else
				{
					$id = mysqli_query($polaczenie, "SELECT wpisy.id,wpisy.tytul,wpisy.tresc,wpisy.widoczny,wpisy.data,kategorie.nazwa FROM wpisy INNER JOIN kategorie ON wpisy.kategoria = kategorie.idKat");
				}

				while($row = mysqli_fetch_assoc($id))
				{
					$tresc = strip_tags(trim($row["tresc"]));
					$tresc = substr($tresc, 0, 500);
					
					echo	'<section class="rectangle">
							
								<div>
								
									<h2>'.$row["tytul"].'</h2>
									
									<p>'.$tresc.'... &nbsp; <span class="read-more">czytaj dalej</span></p>
							
								</div>

								<div class="menu-nav">
								
									<ul>
								
										<li><a href="edit.php?id='.$row["id"].'" title="Edytuj wybrany artykuł">[EDYTUJ]</a></li>

										<li>
											<form method="POST" action="pokaz-ukryj.php">
												<input type="hidden" name="id" value="'.$row["id"].'"/>
												<input type="hidden" name="widoczny" value="'.$row["widoczny"].'"/>';
												if($row["widoczny"])
												{
													echo '<input type="submit" title="Ukryje wpis, ale go nie usunie" value="[UKRYJ]" id="pokaz-ukryj"/>';
												}
												else
												{
													echo '<input type="submit" title="Ukryty wpis znowy będzie widoczny" value="[POKAZ]" id="pokaz-ukryj"/>';
												}
					echo					'</form>
										</li>
										
									</ul>
									
								</div>
								
							</section>';
				}
		
			?>
			
			</div>

		</section>
	
	</main>
	
	<?php
	mysqli_free_result($id);
	mysqli_close($polaczenie);
	?>
	
</body>
</html>