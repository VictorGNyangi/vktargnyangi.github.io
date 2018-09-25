<?php
/*we could redirect user to a page where user can see his/her information...more of a profile picture with contact chips where he/she could upload a picture like redirect him/her to relation.php
*/
session_start();

if(isset($_POST['submit'])) {
	require_once 'dbh.ex.php';

	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

	if(empty($uid) || empty($pwd)) {
		header("Location: ../index.php?login=empty");
		exit();
	
	}
	else {
		$sql = "SELECT * FROM arts WHERE art_uid='$uid'";
		$result = @mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1) {
			header("Location: ../index.php?login=error");
			exit();

		}
		else {
			if ($row = mysqli_fetch_assoc($result)) {
				$hashedPwdCheck = password_verify($pwd, $row['art_pwd']);
				if ($hashedPwdCheck == false) {
					header("Location: ../index.php?login=error");
					exit();
			}
			elseif ($hashedPwdCheck == true) {
				$_SESSION['a_uid'] = $row['art_uid'];
				$_SESSION['a_first'] = $row['art_first'];
				$_SESSION['a_last'] = $row['art_last'];
				$_SESSION['a_pwd'] = $row['art_pwd'];
				$_SESSION['a_soc'] = $row['art_soc'];
				$_SESSION['a_mid'] = $row['art_mid'];
				$_SESSION['a_likart'] = $row['art_likart'];
				$_SESSION['a_email'] = $row['art_email'];
				header("Location: ../index.php?login=success");
				}
			}
		}
	}
}

else{
	header("Location: ../index.php?login=error");
	exit();
}