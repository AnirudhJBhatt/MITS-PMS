<!---------------- Session starts form here ----------------------->
<?php  
	session_start();
	if (!$_SESSION["LoginCompany"])
	{
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}
		require_once "../connection/connection.php";
		
	$C_ID=$_SESSION['LoginCompany'];
	?>
<!---------------- Session Ends form here ------------------------>
<?php  
	if (isset($_POST['submit'])) {

		$J_Title=$_POST['J_Title'];
		$J_Desc=$_POST['J_Desc'];
		$J_Type=$_POST['J_Type'];
		$J_Loc=$_POST['J_Loc'];
		$J_Eligibility=$_POST['J_Eligibility'];
		$J_Package=$_POST['J_Package'];
		$J_Date=$_POST['J_Date'];

		$query="INSERT INTO `job`(`J_Title`, `J_Desc`, `J_Type`, `J_Loc`, `J_Eligibility`, `J_Package`, `J_Date`, `C_ID`) VALUES ('$J_Title', '$J_Desc', '$J_Type', '$J_Loc', '$J_Eligibility', '$J_Package', '$J_Date', '$C_ID')";
		echo $query;
		$run=mysqli_query($con, $query);
		if ($run) {
			echo "<script>alert('Success'); history.back();</script>";
 		}
 		else {
			echo "<script>alert('Failed'); history.back();</script>";
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
		<?php include('../common/company-sidebar.php') ?>  
		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 mb-2 w-100">
			<div class="sub-main">
				<div class="bar-margin text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<h4>Job Management System </h4>
				</div>
				<div class="row">
					<div class="col-md-12 container-fluid">
						<form method="POST" enctype="multipart/form-data">
							<div class="row mt-3">
								<div class="col-md-6">
									<label>Title</label>
									<input type="text" name="J_Title" class="form-control" required>
								</div>
								<div class="col-md-6">
									<label>Description</label>
									<input type="text" name="J_Desc" class="form-control" required>
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-md-6">
									<label>Type</label>
									<input type="text" name="J_Type" class="form-control">
								</div>
								<div class="col-md-6">
									<label>Location</label>
									<input type="text" name="J_Loc" class="form-control" id="">
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-md-6">
									<label>Eligibility</label>
									<input type="text" name="J_Eligibility" class="form-control">
								</div>
								<div class="col-md-6">
									<label>	Package</label>
									<input type="text" name="J_Package" class="form-control" id="">
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-md-6">
									<label>Last Date</label>
									<input type="date" name="J_Date" class="form-control" id="">
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
							<table class="w-100 table-elements table-three-tr text-center" cellpadding="5">
								<tr class="table-tr-head table-three text-white">
									<th>Job ID</th>
									<th>Title</th>
									<th>Description</th>
									<th>Type</th>
									<th>Location</th>
									<th>Package</th>
									<th>Eligibility</th>
									<th>Last Date</th>
									<th>Action</th>
								</tr>
								<?php
									$query="SELECT * FROM Job WHERE `C_ID`='$C_ID'";
									$run=mysqli_query($con,$query);
									while($row=mysqli_fetch_array($run)) {
								?>
								<tr>
									<td><?php echo $row['J_ID']; ?></td>
									<td><?php echo $row['J_Title']; ?></td>
									<td><?php echo $row['J_Desc']; ?></td>
									<td><?php echo $row['J_Type']; ?></td>
									<td><?php echo $row['J_Loc']; ?></td>
									<td><?php echo $row['J_Package']; ?></td>
									<td><?php echo $row['J_Eligibility']; ?></td>
									<td><?php echo $row['J_Date']; ?></td>
									<td width='200'>
										<?php
											echo '<a class="btn btn-danger" href=../admin/delete.php?J_ID='.$row['J_ID'].' onClick="return confirm(\'Do you want to delete ?\')">Delete</a>';
										?>
									</td>
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