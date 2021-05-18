<?php

	$file = fopen ("File.txt", "r") or die ("Sorry! This file is displayed or can not be found.");
	while (!feof($file))
	{
		echo fgets ($file)."</br>";
	}
	fclose($file);

?>
	<pre>
	Note: or you can use different way to read the file.
	using this code: echo fileread("File.txt");
	</pre>