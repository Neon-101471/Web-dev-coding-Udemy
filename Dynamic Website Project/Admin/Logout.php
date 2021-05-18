<?php
	session_start ();
	session_unset ();
	session_destroy ();
	
	header ("LOCATION: Login.php?message=Logged+Out+Successfully");
	Exit ();
?>