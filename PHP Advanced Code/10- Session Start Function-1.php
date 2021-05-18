<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> PHP | SESSION </title>
	</head>
	<body>
		<?php
			session_start ();
			$_SESSION['name'] = "Saif Uddin Ahmed";
			echo $_SESSION['name'];
		?>
		<pre>
			Note: session_start () function is used for creating a variable
			which can be used anywhere of PHP file.
		</pre>
	</body>
</html>