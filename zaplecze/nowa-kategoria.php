<?php

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
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		$zalogowany=true;
	}
	else $zalogowany=false;
	
	if(isset($_POST["tytul"]))
	{
		$tytul=$_POST["tytul"];
		$opis=$_POST["opis"];
		
		mysqli_query($polaczenie, "INSERT INTO kategorie VALUES(NULL, '$tytul', '$opis', NULL)");
	}
		
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title>Zarządzaj stroną - nowa kategoria</title>
	
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="description" content="Opis w Google" />
	<meta name="keywords" content="słowa, kluczowe, wypisane, po, porzecinku" />
	<meta name="robots" content="noindex,nofollow" />

	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=bkr0u90h8tiyezsozj326n24epto1zw0xj27ilf2v3dhgk30"></script>
	<script>
		
		tinymce.init({
			
			selector: '#mytextarea',  // change this value according to your HTML
			//plugins: 'code image',
			
			plugins: [
			'advlist autolink lists link image charmap print preview anchor textcolor',
			'searchreplace visualblocks code',
			'insertdatetime media table contextmenu paste code help'
		  ],
			height: 700,
	
			images_upload_url: 'upload.php',
			
			images_upload_handler: function (blobInfo, success, failure) {
			var xhr, formData;
		  
			xhr = new XMLHttpRequest();
			xhr.withCredentials = false;
			xhr.open('POST', 'upload.php');
		  
			xhr.onload = function() {
				var json;
			
				if (xhr.status != 200) {
					failure('HTTP Error: ' + xhr.status);
					return;
				}
			
				json = JSON.parse(xhr.responseText);
			
				if (!json || typeof json.location != 'string') {
					failure('Invalid JSON: ' + xhr.responseText);
					return;
				}
			
				success(json.location);
			};
		  
			formData = new FormData();
			formData.append('file', blobInfo.blob(), blobInfo.filename());
		  
			xhr.send(formData);
		},
			file: {title: 'File', items: 'newdocument'},
			edit: {title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall'},
			insert: {title: 'Insert', items: 'link media | template hr'},
			view: {title: 'View', items: 'visualaid'},
			format: {title: 'Format', items: 'bold italic underline strikethrough superscript subscript | formats | removeformat'},
			table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
			tools: {title: 'Tools', items: 'spellchecker code'}
		
		});
	
	</script>
	
	
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
		
		<section id="right">	<!-- NARZĘDZIE --> <!-- NOWY ARTYKUŁ -->
		
			<header id="title">
			
				<h1>Dodaj nową kategorie</h1>
			
			</header>
		
			<div id="editor">
			
				<form method="post" action="">
				
					<br>
				
					<input type="text" name="tytul" placeholder="Nazwa kategorii" required><br>
					
					<input type="text" name="opis" placeholder="Opis kategorii (opcjonalnie)">
					
					<br><br>
				
					<input type="submit" value="Dodaj">
				
				</form>
				
				<br /><br /><label for="kategoria" style="text-align:center;">Wszystkie kategorie</label><br />
				<select name="kategoria" id="kategoria">
					
					<option value="" disabled selected hidden>Wszystkie kategorie</option>
				
					<?php
					
						$id = mysqli_query($polaczenie, "SELECT * FROM kategorie");
						
						while($row = mysqli_fetch_assoc($id))
						{
							echo '<option value="'.$row["id"].'" disabled selected>'.$row["nazwa"].'</option>';
						}
					
					?>
										
				</select>
				
			</div>	

		</section>
	
	</main>
	
	<?php
	mysqli_close($polaczenie);
	?>
	
</body>
</html>