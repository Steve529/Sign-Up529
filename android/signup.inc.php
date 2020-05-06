<?php


if(isset($_POST['submit'])){

	include_once 'dbh.inc.php';

	$first_name = mysqli_real_escape_string($connection, $_POST['first']);
	$last_name = mysqli_real_escape_string($connection, $_POST['last']);
	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$password = mysqli_real_escape_string($connection, $_POST['password']);


	if(empty($first_name) || empty($last_name) || empty($email) || empty($password)){
		header("Location: ../signup.php?signup=empty");
		exit();
	
	}

	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		header("Location: ../signup.php?signup=email");
		exit();
	}


		$hashed_pasword = password_hash($password, PASSWORD_DEFAULT);

		$sql = "INSERT INTO  users (user_firstname, user_lastname, user_email, user_password) VALUES ('$first_name', '$last_name', '$email', '$hashed_pasword');";
		mysqli_query($connection, $sql);

		header("Location: ../signup.php?signup=success");
		exit();
	}
			
}

else{
	header("Location: ../signup.php");
	exit();
}

