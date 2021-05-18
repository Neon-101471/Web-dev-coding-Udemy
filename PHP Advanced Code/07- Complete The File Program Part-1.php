<!DOCTYPE html>
<html>
	<head>
		<title> PHP | File </title>
	</head>
	<body>
	
		<form method = "post">
			File name:	<input type = "text" name = "filename"> </br> </br>
			Content:	<textarea type = "text" name = "content"> </textarea> </br> </br>
						<input type = "submit" name = "add" value = "Continue">
						<input style = "margin-left:100px;" type = "submit" name = "show" value = "Show"> </br> </br>
		</form>
		
		<?php 
			if (isset($_POST['add']))
			{
				$filename = $_POST['filename'];
				$content = $_POST['content'];
				
				$file = fopen($filename, "w") or die ("Something Error");
				fwrite($file, "$content");
				fclose ($file);
				
				echo "File added successfully";
			}
			
			if (isset($_POST['show']))
			{
				$filename = $_POST['filename'];
				
				$file = fopen($filename, "r") or die ("This file is not exist now.");
				while (!feof($file))
				{
					echo fgets ($file);
				}
				fclose($file);
			}
		?>
	
	</body>
</html>