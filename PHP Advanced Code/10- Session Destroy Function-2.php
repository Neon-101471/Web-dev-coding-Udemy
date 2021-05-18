<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> PHP | SESSION </title>
	</head>
	<body>
		<?php
			session_start ();
			session_unset ();
			session_destroy ();
		?>
		<pre>
			Note: session_destroy () function is used for destroy or deleting these variable
			which are created by session_start () function.
			And when destroy these variable, it can not working with other PHP file.
		</pre>
	</body>
</html>