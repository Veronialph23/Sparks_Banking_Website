<?php
	$servername = 'localhost';
	$user = 'id17062644_sandesh';
	$pass = 'Priscilla@23';
	$dbname = 'id17062644_vincydb';

	$conn = mysqli_connect($servername,$user,$pass,$dbname);

	if(!$conn){
		die("Could Not Connect to the database".mysqli_connect_error());
	}

?>