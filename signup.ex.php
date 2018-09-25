<?php

if(isset($_POST['submit'])) {

	require_once 'dbh.ex.php';

	$first = mysqli_real_escape_string($conn, $_POST['first']);
	$last = mysqli_real_escape_string($conn, $_POST['last']);
	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
	$soc = mysqli_real_escape_string($conn, $_POST['soc']);
	$mid = mysqli_real_escape_string($conn, $_POST['mid']);
	$likart = mysqli_real_escape_string($conn, $_POST['likart']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);

if(empty($first) || empty($last) || empty($uid) || empty($pwd) || empty($soc) || empty($mid) || empty($likart) || empty($email)) {
	header("Location: ../signup.php?signup=empty");
	exit();

	}
	else {
		if(!preg_match("/^[a-zA-Z0-9]*$/", $first) || !preg_match("/^[a-zA-Z0-9]*$/", $last)) || !preg_match("/^[a-zA-Z0-9]*$/", $uid) || !preg_match("/^[a-zA-Z0-9]*$/", $soc) || !preg_match("/^[a-zA-Z0-9]*$/", $mid) || !preg_match("/^[a-zA-Z0-9]*$/", $likart) || !preg_match("/^[a-zA-Z0-9]*$/", $email)) {
			header("Location: ../signup.php?signup=invalid");
			exit();
		
		}
	else {
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			header("Location: ../signup.php?signup=email");
			exit();
		
		}
		else {
			//table called arts
			$sql = "SELECT * FROM arts WHERE art_uid='$art_uid'";
			$result = @mysqli_query($conn,$sql);
			$resultCheck =mysqli_num_rows($result);

			if($resultCheck >0) {
				header("Location: ../signup.php?signup=usernametaken");
				exit();

			}
			else {
				$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
				//attributes art_first,art_last,art_uid,art_pwd,art_soc,art_mid,art_likart,art_email
				$sql = "INSERT INTO arts(art_first, art_last,  art_uid, art_pwd, art_soc, art_mid, art_likart, art_email) VALUES(?,?,?,?,?,?,?,?)";
				$stmt = mysqli_query($conn, $sql);
				mysqli_stmt_bind_param($stmt, "ssssssss", $first, $last, $uid, $pwd, $soc, $mid, $likart, $email);
				mysqli_stmt_execute($stmt);
				$affected_rows = mysqli_stmt_affected_rows($stmt);

				if($affected_rows == 1) {
					header("Location: ../signup.php?signup=success");//you'd have to login
					mysqli_stmt_close($stmt);
					mysqli_close($conn);
					exit();
				
				}
				else {
					echo 'Error occurred<br>';
					mysqli_stmt_close($stmt);
					mysql_close($conn);
					exit();
				}

			}
		}
	} 
		
}
else {
	header("Location: ../signup.php");
	exit();
}