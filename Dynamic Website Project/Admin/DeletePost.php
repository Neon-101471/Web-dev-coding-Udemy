<?php
	session_start ();
	include_once "../Includes/Connection.php";
	
	if(!isset($_GET['id']))
	{
		header ("LOCATION: Index.php?message=Couldn't+found+any+id.");
		Exit ();
	}
	else
	{
		//Checking session is active or not:
		if(!isset($_SESSION['AuthorRole']))
		{
			header ("LOCATION: Login.php?message=Please+login.");
			Exit ();
		}
		else
		{
			if($_SESSION['AuthorRole'] != "Admin")
			{
				header ("LOCATION: Index.php?message=ERROR!+You+are+not+allowed+to+take+this+action!");
				Exit ();
			}
			else if($_SESSION['AuthorRole'] == "Admin")
			{
				$DeleteId = $_GET['id'];
				$sqlCheck = "SELECT * FROM `post` WHERE PostId='$DeleteId'";
				$result = mysqli_query($connection, $sqlCheck);
				
				if(mysqli_num_rows($result)<=0)
				{
					header ("LOCATION: Post.php?message=No+file+exists.");
					Exit ();
				}
				
				$sql = "DELETE FROM `post` WHERE PostId='$DeleteId'";				
				if(mysqli_query($connection, $sql))
				{
					header("LOCATION: Post.php?message=Record+is+deleted+successfully.");
					Exit ();
				}
				else
				{
					header("LOCATION: Post.php?message=Sorry!+Something+error.+Your+record+could+be+deleted.");
					Exit ();
				}
			}			
		}
	}
?>