<?php 
 include 'Session.php';
 Session::init();
?>

<?php 
 Session::checkLogin();
?>
<?php
	include "config.php";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$username = $_REQUEST["username"];
		$password = $_REQUEST["password"];
		$sql = "SELECT * FROM admin WHERE username = '$username' and password = '$password'";
		$stmt = $pdo->prepare($sql);
        $stmt->execute();
		
		if($stmt->rowCount() > 0) {
			$value = $stmt->fetch(PDO::FETCH_ASSOC); 
			Session::set("login", true);
			Session::set("username", $value['username']);
			Session::set("userId", $value['id']);
			header("Location: index.php");
		} else {
			echo "<span style='color:red;font-size:18px;'>Username or Password Not Matched !!</span>";
		}
        unset($stmt);
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<link rel="stylesheet" href="login.css">
	</head>
	
	<body>
	<div class="center">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<center><label for="fname">ADMIN LOGIN</label></center>
			<input type="text" name="username" placeholder="Username">
			<input type="password" name="password" placeholder="Password">
			<input type="submit" value="Submit"/>
		</form>
		</div>
	</body>
</html>