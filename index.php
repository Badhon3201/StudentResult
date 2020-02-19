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
		$foo = new Session('$username');
		$sql = "SELECT * FROM students WHERE std_id = '$username' and password = '$password'";
		$stmt = $pdo->prepare($sql);
        $stmt->execute();
		
		if($stmt->rowCount() > 0) {
			$value = $stmt->fetch(PDO::FETCH_ASSOC); 
			Session::set("login", true);
			Session::set("username", $value['username']);
			Session::set("userId", $value['id']);
			header("Location: home.php?user=".$username);
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
		<title>Home</title>
		<link rel="stylesheet" href="style.css">
	</head>
	
	<body>
	<div class="center">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<center> <h1> <label for="fname">BUBT</label> </h2> </center>
			<hr>
			<input type="text" name="username" placeholder="Enter ID">
			<input type="password" name="password" placeholder="Password">
			<input type="submit" name="submit" value="Submit"/>
			<hr>
			<center> <p>Create a new account? <a href="registration.php">Sign Up</a>.</p> </center>
		</form>
		</div>
	</body>
</html>