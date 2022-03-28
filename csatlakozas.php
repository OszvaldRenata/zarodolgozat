<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "phoneblog";


		$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) 
		{
		 die("Sikertelen csatlakozás: " . $conn->connect_error);
		} 
  ?>