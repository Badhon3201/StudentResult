<?php
	include "config.php";
	$sql = "SELECT * FROM result";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$total = 0;
		echo "STUDENT ID: ".$row['std_id']."</br>";
		$c = addFunction($row['c']);
		$cg = addCGPA($row['c']);
		$total = $total + $cg;
		echo "C: ".$c."</br>";
		$cc = addFunction($row['c++']);
		echo "C++: ".$cc."</br>";
		$cg1 = addCGPA($row['c++']);
		$total = $total + $cg1;
		$java = addFunction($row['java']);
		echo "Java: ".$java."</br>";
		$cg2 = addCGPA($row['java']);
		$total = $total + $cg2;
		$t = $total / 9;
		echo "CGPA: ".$t."</br>";
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