<?php
	session_start();
	if(!isset($_POST)) {
		echo "Non sei registrato!";
		die();
	}
	
/*
SELECT password_passeggero
FROM RPASSEGGERI
WHERE email = 'danesi@cacca.babbuino'
*/ 
	include_once("Database.php");
	// try {
	// 	$database = new Database("localhost", "carpooling", "phpmyadmin", "Simone@2");
	// }
	// catch (PDOException $exception ) {
	// 	echo "Database non disponibile!";
	// 	die();
	// }
	
//danesi@cacca.babbuino
	$password = false;
	
	$stmt = "SELECT password_passeggero
	FROM RPASSEGGERI
	WHERE email = ?";

	$p_stmt = $connection->prepare($stmt);
	$p_stmt->execute([$_POST['email']]);

	$password = $p_stmt->fetch(PDO::FETCH_ASSOC)['password_passeggero'];
	// try {
	// 	$password = $database->getPassengerHashedPassword($_POST['email']);
	// }
	// catch (PDOException $exception ) {
	// 	echo "Errore di connessione!";
	// 	die();
	// }
	// $password = $database->getPassengerHashedPassword($_POST['email']);

	if($password === false) {
		echo "Utente non registrato!";
		session_destroy();
		die();
	}

	if(!password_verify($_POST['psw'], $password)) {
		echo "Password errata!";
		session_destroy();
		die();
	}
	$_SESSION['email'] = $_POST['email'];
	header('Location: corse.php');
	exit();
?>