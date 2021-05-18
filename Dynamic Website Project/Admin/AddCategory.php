<?php
	include_once "../Includes/Connection.php";
	session_start ();
	ob_start ();
	if(!isset($_POST['AddCategory']))
	{
		header ("LOCATION: Category.php?message=Please+add+A+category.");
		Exit ();
	}
	else
	{
		if(!isset($_SESSION['AuthorRole']))
		{
			header ("LOCATION: Login.php?message=Please+login.");
			Exit ();
		}
		else
		{
			if($_SESSION['AuthorRole'] != "Admin")
			{
				header ("LOCATION: Category.php?message=SORRY!+You+can't+access+this+page.");
				Exit ();
			}
			else if ($_SESSION['AuthorRole'] == "Admin")
			{
				$CategoryName = mysqli_real_escape_string($connection, $_POST['CategoryName']);
				$sql = "INSERT INTO `category` (`CategoryName`) VALUES ('$CategoryName');";
				if(mysqli_query($connection, $sql))
				{
					header ("LOCATION: Category.php?message=Category+added+successfully.");
					Exit ();
				}
				else
				{
					header ("LOCATION: Category.php?message=Something+Error!+Category+doesn't+added.");
					Exit ();
				}
			}
		}
	}
?>