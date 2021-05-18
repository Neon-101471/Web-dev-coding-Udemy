<?php
	include_once "../Includes/Connection.php";
	include_once "../Includes/Functions.php";
	ob_start ();
	session_start ();
	
	if(!isset($_GET['id']))
	{
		header ("LOCATION: EditPage.php?message=Didn't+get+any+id.");
		Exit ();
	}
	else
	{
		if(!isset($_SESSION['AuthorRole']))
		{
			header ("LOCATION: Index.php?message=Please+login.");
			Exit ();
		}
		else
		{
			if($_SESSION['AuthorRole'] == "Admin")
			{
				$id = mysqli_real_escape_string($connection, $_GET['id']);
				$sql = "SELECT * FROM page WHERE PageId='$id'";
				$result = mysqli_query($connection, $sql);
				
				if(mysqli_num_rows($result)<=0)
				{
					header ("LOCATION: EditPage.php?message=No+results+found.");
					Exit ();
				}
				else
				{
					$PageId = $_GET['id'];
					$sql = "DELETE FROM page WHERE PageId='$PageId'";
					if(mysqli_query($connection, $sql))
					{
						header ("LOCATION: Page.php?message=Record+deleted+successfully.");
						Exit ();
					}
					else
					{
						header ("LOCATION: Page.php?message=ERROR+Something!+Record+couldn't+be+deleted.");
						Exit ();
					}
				}
			}
			else
			{
				header ("LOCATION: EditPage.php?message=SORRY!+You+can't+access+this+page.");
				Exit ();
			}
		}
	}
?>