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
				
				$fileExtension = explode('.', $fileName);
				//print_r($fileExtension);
				
				$LastIndexExtension = strtolower(end($fileExtension));
				//strtolower() function is used for grab the extension with lower case.
				
				$allowedExtension = array ("jpg", "jpeg", "png", "pdf", "doc", "odt", "svg", "gif");				
				if(in_array($LastIndexExtension, $allowedExtension))
				{
					if($fileError === 0)
					{
						if($fileSize < 10000000)
						{
							$newFileName = uniqid('', true).'.'.$LastIndexExtension;
							//echo "$newFileName";
							
							$destination = "File/$newFileName";
							move_uploaded_file($fileTemp, $destination);
							
							echo "Your file is uploaded SUCCESSFULLY.".'</br>';
							echo "<a href = '$destination'> Click Here </a> to see your file.";
						}
						else
						{
							echo "Your file is too much, so that it can not be uploaded";
						}
						
					}
					else
					{
						echo "Sorry! Your file can't uploaded successfully";
					}
					
				}
				else
				{
					echo "You uploaded a file which type of extension are not allowed in this website.";
				}
			}
		?>
	</body>
</html>