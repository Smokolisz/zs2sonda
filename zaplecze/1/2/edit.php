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
	
	$idWpisu = htmlspecialchars($_GET["id"]);

	if(!$idWpisu)
	{
		header('Location: index.php');
		exit();
	}
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		$zalogowany=true;
	}
	else $zalogowany=false;
	
	if(isset($_POST["tresc"]))
	{
		$tresc=$_POST["tresc"];
		$tytul=$_POST["tytul"];
		$kategoria=$_POST["kategoria"];

		if ($polaczenie->query("UPDATE wpisy SET tytul='$tytul', tresc='$tresc', kategoria='$kategoria' WHERE id='$idWpisu'"))
		{
			echo 'Sukces!';
		} else {
			echo 'ERROR!';
			header('refresh: 2;');
			exit;
		}
	}
		
	//echo $_SERVER['DOCUMENT_ROOT'];

	//mysqli_query($polaczenie, "INSERT INTO wpisy VALUES '', ".$tresc.", '' ");

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title>Zarządzaj stroną - edytuj</title>
	
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="description" content="Opis w Google" />
	<meta name="keywords" content="słowa, kluczowe, wypisane, po, porzecinku" />

	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=bkr0u90h8tiyezsozj326n24epto1zw0xj27ilf2v3dhgk30"></script>
	<script>
		
		tinymce.init({
			relative_urls : false,
			remove_script_host : false,
			convert_urls : true,
		
			
			selector: '#mytextarea',  // change this value according to your HTML
			//plugins: 'code image',
			
			plugins: [
			'advlist autolink lists link charmap print preview anchor textcolor',
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
					<li class="pozycja-menu"><a href="nowa-kategoria.php">NOWY KATEGORIA</a></li>
					<li class="pozycja-menu"><a href="powiadomienia.php">TRANSMISJA</a></li>
				</ul>
				<div class="clear-both"></div> 
				
			</nav>
			
		</section>
		
		<section id="right">	<!-- NARZĘDZIE --> <!-- NOWY ARTYKUŁ -->
		
			<header id="title">
			
				<h1>Dodaj nowy artykuł</h1>
			
			</header>
		
			<div id="editor">
			
				<form enctype="multipart/form-data" method="post" action="">
				
					<?php

						$id = mysqli_query($polaczenie, "SELECT * FROM wpisy WHERE id='$idWpisu'");
						$row = mysqli_fetch_assoc($id);

					?>
				
					<br>

					<input type="text" name="tytul" placeholder="Tytuł" value="<?php echo $row["tytul"]; ?>" required>
		
					<textarea name="tresc" id="mytextarea" ><?php echo $row["tresc"]; ?></textarea><br />

					<br><br>
					
					<label for="kategoria" style="text-align:center;">Wybierz kategorie</label><br />
					<select name="kategoria" id="kategoria" required>
						
						<option value="" disabled selected hidden>Wybierz kategorie</option>
					
						<?php
						
							$id = mysqli_query($polaczenie, "SELECT * FROM kategorie");
							
							while($row = mysqli_fetch_assoc($id))
							{
								echo '<option value="'.$row["idKat"].'">'.$row["nazwa"].'</option>';
							}
						
						?>
											
					</select>
				
					<input type="submit">
				
				</form>
				
			</div>	
			

		</section>
	
	</main>
	
	<?php
	mysqli_close($polaczenie);
	?>
	
</body>
</html>