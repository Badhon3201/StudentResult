<?php require_once "config.php"; ?>

<?php
	$id = $name = $intake = $section = " ";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$id = $_REQUEST["stdid"];
		$name = $_REQUEST["stdname"];
		$intake = $_REQUEST["stdintake"];
		$section = $_REQUEST["stdsection"];
		
		$sql = "UPDATE student SET std_name=:name, std_intake=:intake, std_section=:section WHERE std_id=:id";
		$stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(":name", $name);
		$stmt->bindParam(":intake", $intake);
		$stmt->bindParam(":section", $section);
		$stmt->bindParam(":id", $id);
        $stmt->execute();
        unset($stmt);
	}
?>

<?php
// Include config file
	//require_once "config.php";
	$id = $name = $intake = $section = "";
	if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
		// Get URL parameter
		$id =  trim($_GET["id"]);
		
		// Prepare a select statement
		$sql = "SELECT * FROM student WHERE std_id = :id";
		if($stmt = $pdo->prepare($sql)){
			// Bind variables to the prepared statement as parameters
			$stmt->bindParam(":id", $param_id);
			
			// Set parameters
			$param_id = $id;
			
			// Attempt to execute the prepared statement
			if($stmt->execute()){
				if($stmt->rowCount() == 1){
					$row = $stmt->fetch(PDO::FETCH_ASSOC);
						$id = $row["std_id"];
						$name = $row["std_name"];
						$intake = $row["std_intake"];
						$section = $row["std_section"];
				} else{
					// URL doesn't contain valid id. Redirect to error page
					header("location: error.php");
					exit();
				}
				
			} else{
				echo "Oops! Something went wrong. Please try again later.";
			}
		}
		
		// Close statement
		unset($stmt);
		
		// Close connection
		unset($pdo);
	}
?>

<!DOCTYPE html>
<html>
	<head>
	<title> Update </title>
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
					<input type="text" id="fname" name="stdid" value="<?php echo $id; ?>">

					<label for="lname">Student Name</label>
					<input type="text" id="lname" name="stdname" value="<?php echo $name; ?>">
					
					<label for="lname">Intake</label>
					<input type="text" id="intake" name="stdintake" value="<?php echo $intake; ?>">
					
					<label for="lname">Section</label>
					<input type="text" id="section" name="stdsection" value="<?php echo $section; ?>">
				  
					<input type="submit" value="Submit">
				</form>
			</div>
		</div>
	</body>
</html> 