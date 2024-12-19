<!---------------- Session starts form here ----------------------->
<?php  
	session_start();
	if (!$_SESSION["LoginAdmin"])
	{
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}
	require_once "../connection/connection.php";

?>
<!---------------- Session Ends form here ------------------------>
<?php  
	if (isset($_POST['submit'])) {

		$D_ID=$_POST['D_ID'];
		$D_Name=$_POST['D_Name'];
		$Marks_10th=$_POST['Marks_10th'];
		$Marks_12th=$_POST['Marks_12th'];
		$Marks_UG=$_POST['Marks_UG'];
		$CGPA=$_POST['CGPA'];
		$D_Date=$_POST['D_Date'];

		$query="INSERT INTO `drive`(`D_ID`, `D_Name`, `Marks_10th`, `Marks_12th`, `Marks_UG`, `CGPA`, `D_Date`) VALUES ('$D_ID', '$D_Name', '$Marks_10th', '$Marks_12th', '$Marks_UG', '$CGPA', '$D_Date')";
		$run=mysqli_query($con, $query);
		if ($run) {
			echo "<script>alert('Success'); history.back();</script>";
 		}
 		else {
			echo $query;
 		}
	}
?>


<!doctype html>
<html lang="en">
	<head>
		<title>Company - Jobs</title>
	</head>
	<body>
		<?php include('../common/common-header.php') ?>
		<?php include('../common/admin-sidebar.php') ?>  
		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 mb-2 w-100">
			<div class="sub-main">
				<div class="bar-margin text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<h4>Add Campus Drive</h4>
				</div>
				<div class="row">
					<div class="col-md-12 container-fluid">
						<form method="POST" enctype="multipart/form-data">
							<div class="row mt-3">
								<div class="col-md-6">
									<label>Drive ID</label>
									<input type="text" name="D_ID" class="form-control" required>
								</div>
								<div class="col-md-6">
									<label>Name</label>
									<input type="text" name="D_Name" class="form-control" required>
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-md-6">
									<label>10th Marks</label>
									<input type="number" name="Marks_10th" class="form-control">
								</div>
								<div class="col-md-6">
									<label>12th Marks</label>
									<input type="number" name="Marks_12th" class="form-control" id="">
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-md-6">
									<label>UG Marks</label>
									<input type="number" name="Marks_UG" class="form-control">
								</div>
								<div class="col-md-6">
									<label>Current CGPA</label>
									<input type="number" name="CGPA" class="form-control" id="">
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-md-6">
									<label>Last Date</label>
									<input type="date" name="D_Date" class="form-control" id="">
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-md-6">
									<input type="submit" name="submit" value="Upload" class="btn btn-primary">
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 container-fluid">
						<section class="mt-3">
							<table class="w-100 table-elements table-three-tr text-center" cellpadding="10">
								<tr class="table-tr-head table-three text-white">
									<th>Drive ID</th>
									<th>Name</th>
									<th>Last Date</th>
									<th>Applied Students</th>
								</tr>
								<?php
									$query="SELECT d.D_ID, d.D_Name, d.D_Date, COUNT(a.App_ID) FROM drive d, application a WHERE a.D_ID = d.D_ID GROUP BY d.D_ID, d.D_Name, d.D_Date;";
									$run=mysqli_query($con,$query);
									while($row=mysqli_fetch_array($run)) {
								?>
								<tr>
									<td><?php echo $row['D_ID']; ?></td>
									<td><?php echo $row['D_Name']; ?></td>
									<!-- <td><?php echo $row['Marks_10th']; ?></td>
									<td><?php echo $row['Marks_12th']; ?></td>
									<td><?php echo $row['CGPA']; ?></td>
									<td><?php echo $row['Marks_UG']; ?></td> -->
									<td><?php echo $row['D_Date']; ?></td>
									<td><?php echo $row['COUNT(a.App_ID)']; ?></td>
									<!-- <td width='200'>
										<?php
											echo '<a class="btn btn-danger" href=../admin/delete.php?J_ID='.$row['J_ID'].' onClick="return confirm(\'Do you want to delete ?\')">Delete</a>';
										?>
									</td> -->
								</tr>
								<?php
									}
								?>
							</table>				
						</section>
					</div>
				</div>
			</div>
		</main>
		<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>