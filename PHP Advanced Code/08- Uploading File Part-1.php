<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> PHP | Uploading File </title>
	</head>
	<body>
		<form method = "post" enctype = "multipart/form-data">
			<input type = "file" name = "file">
			<input type = "submit" name = "submit" value = "Upload">
		</form>
		
		<?php
			if(isset($_POST['submit']))
			{
				$file = $_FILES['file'];
		?>
			<pre>
				Note:  At first type print_r($file);
				Then see how many properties have been there.
				Then store it a variable & print with echo.
				Mind it print_r() is a function.
			</pre>
		
		<?php		
				$fileName = $file['name'];
				$fileType = $file['type'];
				$fileTemp = $file['tmp_name'];
				$fileError = $file['error'];
				$fileSize = $file['size'];
				$fileDestination = "File/".$fileName;
				
				echo $fileTemp."</br>";
				echo $fileName;
			}
			move_uploaded_file($fileTemp, $fileDestination);
		?>
	</body>
</html>