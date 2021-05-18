<?php
	include "connection.php";
	if (isset($_GET['id']))
	{
		$id = $_GET['id'];
		$sql = "DELETE FROM `Price` WHERE id='$id'";
		
		if(mysqli_query($connection, $sql))
		{
			header ("LOCATION: Show.php");
		}
	}
	else
	{
		header ("LOCATION: Show.php");
	}

?>