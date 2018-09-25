<!DOCTYPE html>
<html>
<head>
	<title>My Art Project</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<nav>
			<div class="wrapper">
				<ul>
					<li><a href="index.php">Art is life</a></li>
				</ul>
				<div class="login-navig">

					<a href="index.php"  class="current">Home</a>
					<a href="">Relate</a>
					<a href="#">Share</a>
					<a href="#">About us</a>

					<?php
						if (isset($_SESSION['u_id'])) {
							echo '<form action="extras/exit.ex.php" method="POST">
							<button type="submit" name ="submit">Exit</button>
							</form>';
						
						}
						else {
							echo '<form action="extras/signin.ex.php"
									method="POST"><input type="text" name="uid" placeholder="Username/email">
									<input type="password" name="pwd" placeholder="password">
									<button type="submit" name="submit">SignIn</button></form>
									<a href="signup.php">Signup</a>';
						}
						?>
			
			</div>
		</div>
		</nav>
	</header>

</body>
</html>