<?php
	$con=mysqli_connect("localhost","caddcent_user","asdf1234","caddcent_caddnew");   //create connection
	
	if(mysqli_connect_errno())
	{
		echo "Failed to connect to database".mysqli_connect_error();
	}
	
	/*else
	{
		echo "Connected to databasae";
	}
	*/
?>