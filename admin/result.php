<?php 
 include 'Session.php';
 Session::checkSession();
?>

<?php
	require_once "config.php";
	$id = $name = $intake = $section = " ";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$id = $_REQUEST["stdid"];
		$name = $_REQUEST["stdname"];
		$intake = $_REQUEST["stdintake"];
		$section = $_REQUEST["stdsection"];
		
		$sql = "INSERT INTO result (std_id, c,cc, java) VALUES (:std_id, :std_name, :std_intake, :std_section)";
		$stmt = $pdo->prepare($sql);
        $stmt->bindParam(":std_id", $id);
        $stmt->bindParam(":std_name", $name);
		$stmt->bindParam(":std_intake", $intake);
		$stmt->bindParam(":std_section", $section);
        $stmt->execute();
        unset($stmt);
	}
?>

<!DOCTYPE html>
<html>
	<head>
	<title> Dashboard </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class="sidebar">
			<a href="index.php"> Dashboard</a>
			<a href="student.php"> Student</a>
			<a href="result.php"> Result</a>
		</div>
		
		<div class="topbar">
			<a href="#home"> Logout</a>
		</div>

		<div class="main">
			<div class="fp">
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
					<label for="fname">Student ID</label>
					<input type="text" id="fname" name="stdid" placeholder="Student id..">

					<label for="lname">C Programming</label>
					<input type="text" id="lname" name="stdname" placeholder="Enter num..">
					
					<label for="lname">C++ Programming</label>
					<input type="text" id="intake" name="stdintake" placeholder="Enter num..">
					
					<label for="lname">Java programming</label>
					<input type="text" id="section" name="stdsection" placeholder="Enter num..">
				  
					<input type="submit" value="Submit">
				</form>
			</div>
		</div>
	</body>
</html> 