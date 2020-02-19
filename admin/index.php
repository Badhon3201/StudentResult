<?php 
 include 'Session.php';
 Session::checkSession();
?>

<?php 
	if(isset($_GET['action']) && $_GET['action'] == "logout"){
		Session::destroy();
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
			<a href="?action=logout"> Logout</a>
		</div>

		<div class="main">
			<p> All Student List</p>
			<?php
				include "config.php";
				$sql = "SELECT * FROM student";
				$stmt = $pdo->prepare($sql);
				$stmt->execute();
			?>
			<table id="customers">
				<tr>
					<th>STUDENT ID</th>
					<th>NAME</th>
					<th>INTAKE</th>
					<th>SECTION</th>
					<th>ACTION</th>
				</tr>
				<?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {?>
					<tr>
					<td><?php echo $row['std_id']; ?></td>
					<td><?php echo $row['std_name']; ?></td>
					<td><?php echo $row['std_intake']; ?></td>
					<td><?php echo $row['std_section']; ?></td>
					<td>
						<a href="view.php?std_id= <?php echo urlencode($row['std_id']); ?>"> VIEW </a>
						<a> || </a>
						<a href="update.php?id=<?php echo $row["std_id"]; ?>">UPDATE</a>
						<a> || </a>
						<a href="delete.php?id=<?php echo $row["std_id"]; ?>">DELETE</a>
						</td>
						</tr>
					<?php }
				?>
			</table>
			
			<p> All Result List</p>
			<?php
				$sql = "SELECT * FROM result";
				$stmt = $pdo->prepare($sql);
				$stmt->execute();
			?>
			<table id="customers">
				<tr>
					<th>STUDENT ID</th>
					<th>C Programming</th>
					<th>C++ Programming</th>
					<th>Java Programming</th>
					<th>CGPA</th>
					
					<th>ACTION</th>
				</tr>
				<?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { $total = 0;?>
					<tr>
					<td><?php echo $row['std_id']; ?></td>
					<?php 
						$c = addFunction($row['c']);
						$cg = addCGPA($row['c']);
						$total = $total + $cg;
					?>
					<td><?php echo $c; ?></td>
					<?php 
						$cc = addFunction($row['cc']);
						$cg1 = addCGPA($row['cc']);
						$total = $total + $cg1;
					?>
					<td><?php echo $cc; ?></td>
					<?php
						$j = addFunction($row['java']);
						$cg2 = addCGPA($row['java']);
						$total = $total + $cg2;
						$t = $total / 9;
					?>
					<td><?php echo $j; ?></td>
					
					<td><?php echo number_format($t,2); ?></td>
					<td>
						<a href="view.php?std_id= <?php echo urlencode($row['std_id']); ?>"> VIEW </a>
						<a> || </a>
						<a href="#"> EDIT</a>
						<a> || </a>
						<a href="delete.php?std_id= <?php echo urlencode($row['std_id']); ?>"> DELETE</a>
						</td>
						</tr>
					<?php }
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
			</table>
		</div>
	</body>
</html> 