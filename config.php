<?php

	$conn = new mysqli("localhost:3309", "root", 'P@$$w0rd1997', "patientdetails");

	if ($conn->connect_error) {
		die("Could not Connect to the Database".$conn->connect_error);
	}


?>