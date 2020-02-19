<?php 
	include 'Session.php';
	Session::checkSession(); 
	
?>

<?php 
	if(isset($_GET['action']) && $_GET['action'] == "logout"){
		Session::destroy();
	}
?>

<?php
	include "config.php";
	$id = "";
	if(isset($_GET["user"]) && !empty(trim($_GET["user"]))){
		// Get URL parameter
		$id =  $_GET["user"];
		//echo $id;
		
	}
	$name="";
	$sql = "SELECT * FROM student WHERE std_id= $id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$name = $row['std_name'];
	}
?>

<?php
	$sql = "SELECT * FROM result WHERE std_id= $id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$s1 = $s2 = $s3 = $s4 = "";
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
		$total = 0;
		//echo $row['std_id'];		
		$c = addFunction($row['c']);
		$cg = addCGPA($row['c']);
		$total = $total + $cg;
		//echo $c;
		$s1 = $c;
		$cc = addFunction($row['cc']);
		$cg1 = addCGPA($row['cc']);
		$total = $total + $cg1;
		//echo $cc;
		$s2 = $cc;
					
		$j = addFunction($row['java']);
		$cg2 = addCGPA($row['java']);
		$total = $total + $cg2;
		$t = $total / 9;	
		//echo $j;
		$s3 = $j;
		//echo number_format($t,2);
		$s4 = $t;
	}
	function addFunction($num1) {
		if ($num1 >= 80) {
			return "A+";
		} elseif ($num1 >= 75 && $num1 < 79) {
			return "A";
		} elseif ($num1 >= 70 && $num1 < 74) {
			return "A-";
		} elseif ($num1 >= 65 && $num1 < 69) {
			return "B+";
		} elseif ($num1 >= 60 && $num1 < 64) {
			return "B";
		} elseif ($num1 >= 55 && $num1 < 59) {
			return "B-";
		} elseif ($num1 >= 50 && $num1 < 54) {
			return "C+";
		} elseif ($num1 >= 45 && $num1 < 49) {
			return "C";
		} elseif ($num1 >= 40 && $num1 < 44) {
			return "D";
		} else {
			return "F";
		}
	}
		
	function addCGPA($num1) {
		if ($num1 >= 80) {
			return 4*3;
		} elseif ($num1 >= 75 && $num1 < 79) {
			return 3.75*3;
		} elseif ($num1 >= 70 && $num1 < 74) {
			return 3.50*3;
		} elseif ($num1 >= 65 && $num1 < 69) {
			return 3.25*3;
		} elseif ($num1 >= 60 && $num1 < 64) {
			return 3*3;
		} elseif ($num1 >= 55 && $num1 < 59) {
			return 2.75*3;
		} elseif ($num1 >= 50 && $num1 < 54) {
			return 2.5*3;
		} elseif ($num1 >= 45 && $num1 < 49) {
			return 2.25*3;
		} elseif ($num1 >= 40 && $num1 < 44) {
			return 2.00*3;
		} else {
			return 0;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Home</title>
		<link rel="stylesheet" href="Username.css">
	</head>
	
	<body>
	<div class="center">
		<div class="logout">
			<a href="?action=logout"> Logout</a>
		</div>
		
		<div class="main">
			<form action="/home.php">
			<b> <label >ID: </label> </b>
			<label for="male"><?php echo $id; ?></label> </br>
			<b> <label for="male">NAME: </label> </b>
			<label for="male"><?php echo $name; ?></label> </br>
			<hr>
		</form> 
		</div>
		
		<table>
  <tr>
    <th>C Programming</th>
    <th>C++ Programming</th>
    <th>Java Programming</th>
	<th>CGPA</th>
  </tr>
  <tr>
    <td><?php echo $s1; ?></td>
    <td><?php echo $s2; ?></td>
    <td><?php echo $s3; ?></td>
	<td><?php echo number_format($s4,2); ?></td>
  </tr>
</table>
	</body>
</html>