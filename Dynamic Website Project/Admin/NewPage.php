<?php
	include_once "../Includes/Connection.php";
	session_start ();
	ob_start ();
	if(!isset($_POST['AddPage']))
	{
		header ("LOCATION: Page.php?message=Please+submit+the+form.");
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
				header ("LOCATION: Page.php?message=SORRY!+You+can't+access+this+page.");
				Exit ();
			}
			else if ($_SESSION['AuthorRole'] == "Admin")
			{
				$PageTitle = mysqli_real_escape_string($connection, $_POST['PageTitle']);
				$PageContent = mysqli_real_escape_string($connection, $_POST['PageContent']);
				
				$sql = "INSERT INTO page (`PageTitle`, `PageContent`) VALUES ('$PageTitle', '$PageContent');";
				if(mysqli_query($connection, $sql))
				{
					header ("LOCATION: Page.php?message=Your+page+is+added+successfully.");
					Exit ();
				}
				else
				{
					header ("LOCATION: Page.php?message=Something+Error!+Page+doesn't+added.");
					Exit ();
				}
			}
		}
	}
?>