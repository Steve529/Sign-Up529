<?php


session_start();

if(isset($_POST['submit'])){

	include_once 'dbh.inc.php';

	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$password = mysqli_real_escape_string($connection, $_POST['password']);

	
	if(empty($email) || empty($password)){
		header("Location: ../index.php?login=empty");
		exit();
	}
	$sql = "SELECT * FROM users WHERE user_email= '$username'";
	$result = mysqli_query($connection, $sql);
	$result_check = mysqli_num_rows($result);

	if($result_check == 0){
		header("Location: ../index.php?login=error");
		exit();
	}

	
	if($row = mysqli_fetch_assoc($result)){
		
		$hashed_password_check = password_verify($password, $row['user_password']);

		
		if($hashed_password_check == false){
			header("Location: ../index.php?login=error");
			exit();
		}

		elseif($hashed_password_check == true){

			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['user_first'] = $row['user_firstname'];
			$_SESSION['user_last'] = $row['user_lastname'];
			$_SESSION['user_email'] = $row['user_email'];

			header("Location: ../index.php?login=success");
			exit();
		}

		else{
			echo "wtf";
		}
	}
}

else{
	header("Location: ../index.php");
			exit();
}
 


