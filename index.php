<?php include 'action.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Patient Details</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="index.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  		<a class="navbar-brand" href="index.php">CRUD</a>
  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    	<span class="navbar-toggler-icon"></span>
  	</button>

  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"></a>
      </li>
    </ul>
  </div>
</nav>

<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<h3 class="text-center text-dark p-2">N-Layer Machine Problem</h3>
			<hr>
			<?php if (isset($_SESSION['response'])) { ?>
				<div class="alert-alert-<?= $_SESSION['res_type']; ?> alert-dismissible text-center">
					<button type="button" class="close" data-dismissible="alert">&times;</button>
					<?= $_SESSION['response']; ?>
				</div>
			<?php } unset($_SESSION['response']); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 mt-5">
			<h3 class="text-center text-info mt-3">Input Patient Info</h3>
			<hr>
			<form action="action.php" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?= $id; ?>">
				<div class="form-group">
					<input type="number" name="dosage" class="form-control" value="<?= $dosage; ?>" onchange="setFourNumberDecimal()" min="0" max="50" step="0.10" value="0.00" placeholder="Input Dosage" required />
				</div>
				<div class="form-group">
					<input type="text" name="drug" class="form-control" value="<?= $drug; ?>" placeholder="Input Drug" required>
				</div>
				<div class="form-group">
					<input type="text" name="patient" class="form-control" value="<?= $patient; ?>" placeholder="Input Patient" required>
				</div>
				<input type="hidden" name="date" value="<?= $date; ?>">
				<div class="form-group">
					<?php if($update==true) { ?>
						<input type="submit" name="update" class="btn btn-success btn-block" value="Update Record" onclick="return confirm('Do you want to update this record?')">
					<?php } else {	?>
						<input type="submit" name="save" class="btn btn-primary btn-block" value="Add Record" onclick="return confirm('Do you want to save this record?')">
					<?php } ?>
				</div>
			</form>
		</div>
		<div class="col-md-8">

				<?php
					$query = "SELECT * FROM patient ORDER BY date DESC";
					$stmt = $conn->prepare($query);
					$stmt->execute();
					$result = $stmt->get_result();
				?>

			<h3 class="text-center text-info mt-3">Patient Details</h3>
			<hr>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Dosage</th>
						<th>Drug</th>
						<th>Patient</th>
						<th>Date</th>
						<th colspan="2">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php while($row=$result->fetch_assoc()) { ?>
					<tr>
						<td><?= number_format($row['dosage'],2); ?></td>
						<td><?= $row['drug']; ?></td>
						<td><?= $row['patient']; ?></td>
						<td><?= $row['date']; ?></td>
						<td>
							<a href="index.php?edit=<?= $row['id']; ?>" class="badge badge-primary p-2">Edit</a>
							<a href="action.php?delete=<?= $row['id']; ?>" class="badge badge-danger p-2" onclick="return confirm('Do you want to delete this record?')">Delete</a>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

</body>
</html>