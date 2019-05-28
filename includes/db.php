<?php
session_start();
	$host = 'localhost';
	$dbname = 'dekc1_16_babywalking';
	$user = 'admin';
	$pass = 'supersecurepassword123';

	try {
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
?>