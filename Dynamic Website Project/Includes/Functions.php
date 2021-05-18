<?php
	include_once "Connection.php";
	function Jumbotron ()
	{
		echo '<div class="jumbotron jumbotron-fluid">
				<div class="container">
				<h1 class="display-4"> </h1>
				<p class="lead"> </p>
				</div>
			  </div>';
	}
	
	function getAuthorName ($id)
	{
		global $connection;
		$sql = "SELECT * FROM `author` WHERE AuthorId='$id'";
		$result = mysqli_query ($connection, $sql);
		
		while ($row = mysqli_fetch_assoc($result))
		{
			$AuthorName = $row['AuthorName'];
			echo $AuthorName;
		}
	}
	
	function getCategoryName ($id)
	{
		global $connection;
		$sql = "SELECT * FROM `category` WHERE CategoryId='$id'";
		$result = mysqli_query ($connection, $sql);
		
		while ($row = mysqli_fetch_assoc($result))
		{
			$CategoryName = $row['CategoryName'];
			echo $CategoryName;
		}
	}
	function GetSetValue ($Setting)
	{
		global $connection;
		$sql = "SELECT * FROM settings WHERE SettingName = '$Setting'";
		$result = mysqli_query($connection, $sql);
		
		while ($row = mysqli_fetch_assoc($result))
		{
			$SettingValue = $row['SettingValue'];
			echo $SettingValue;
		}
	}
	
	function SetSettingsValue ($Setting, $SetValue)
	{
		global $connection;
		$sql = "UPDATE settings SET SettingValue = '$SetValue' WHERE SettingName = '$Setting'";
		
		if (mysqli_query($connection, $sql))
		{
			return true;
			Exit ();
		}
		else
		{
			return false ();
			Exit ();
		}
	}
?>