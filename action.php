<?php
	
	session_start();
	include 'config.php';

	$id = "";
	$dosage = "";
	$drug = "";
	$patient = "";
	$date = date('Y-m-d');
	$update = false;

	if (isset($_POST['save'])) {

		$dosage = $_POST['dosage'];
		$drug = $_POST['drug'];
		$patient = $_POST['patient'];
		$date = $_POST['date'];

		$duplisql = "SELECT * FROM patient WHERE dosage = '$dosage' AND drug = '$drug' AND patient = '$patient' AND date = '$date'";
		$duplirow = $conn->prepare($duplisql);
		if (mysqli_num_rows($duplirow) > 0) {
   			$_SESSION['response'] = "Duplicate Record";
   			$_SESSION['res_type'] = "danger";
		} else {
		$query = "INSERT INTO patient(dosage, drug, patient, date) VALUES(?,?,?,?)";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("ssss", $dosage, $drug, $patient, $date);
		$stmt->execute();

		header("location:index.php");
		$_SESSION['response'] = "Data Successfully Added";
		$_SESSION['res_type'] = "success";
		}
		/* $dosage = $_POST['dosage'];
		$drug = $_POST['drug'];
		$patient = $_POST['patient'];
		$date = $_POST['date'];

		$query = "SELECT * FROM patientdetails WHERE patient='$patient' AND date='$date'";
		$stmt = $conn->prepare($query);
		$num_rows = mysql_num_rows($stmt);

		if ($num_rows==0) {
			$query1 = "INSERT INTO patient(dosage, drug, patient, date) VALUES(?,?,?,?)";
			$stmt = $conn->prepare($query);
			$stmt->bind_param("ssss", $dosage, $drug, $patient, $date);
			$stmt->execute();

			header("location:index.php");
			$_SESSION['response'] = "Data Successfully Added";
			$_SESSION['res_type'] = "success";
		} else{
			$_SESSION['response'] = "Duplicate Data";
			$_SESSION['res_type'] = "warning";
		} */

	}

	if (isset($_GET['delete'])) {
		 $id = $_GET['delete'];

		 $query = "DELETE FROM patient WHERE id=?";
		 $stmt = $conn->prepare($query);
		 $stmt->bind_param("i", $id);
		 $stmt->execute();

		 header("location:index.php");
		 $_SESSION['response'] = "Successfully Deleted";
		 $_SESSION['res_type'] = "danger";
	}

	if (isset($_GET['edit'])) {
		 $id = $_GET['edit'];

		 $query = "SELECT * FROM patient WHERE id=?";
		 $stmt = $conn->prepare($query);
		 $stmt->bind_param("i", $id);
		 $stmt->execute();
		 $result = $stmt->get_result();
		 $row = $result->fetch_assoc();

		 $dosage = $row['dosage'];
		 $drug = $row['drug'];
		 $patient = $row['patient'];

		 $update = true;
	}

	if (isset($_POST['update'])) {
		
		$id = $_POST['id'];
		$dosage = $_POST['dosage'];
		$drug = $_POST['drug'];
		$patient = $_POST['patient'];
		$date = $_POST['date'];

		$query = "UPDATE patient SET dosage=?, drug=?, patient=?, date=? WHERE id=?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("ssssi", $dosage, $drug, $patient, $date, $id);
		$stmt->execute();

		header("location:index.php");
		$_SESSION['response'] = "Successfully Updated";
		$_SESSION['res_type'] = "primary";
	}

?>