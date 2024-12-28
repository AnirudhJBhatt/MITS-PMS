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


<!doctype html>
<html lang="en">
	<head>
		<title>Admin - Placements</title>
	</head>
	<body>
		<?php include('../common/common-header.php') ?>
		<?php include('../common/admin-sidebar.php') ?>  

		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 mb-2 w-100">
			<div class="sub-main">
				<div class="bar-margin text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<h4>Placement Deatils</h4>
				</div>
				<section class="mt-3">
					<form action="" method="post">
						<div class="row">
							<div class="col-5">
								<div class="input-group">
									<select class="form-control" name="Stud_Batch">
										<option>Select Batch</option>
										<option value="CS">CS</option>
										<option value="CS-AI">CS-AI</option>
										<option value="AI&DS">AI&DS</option>
										<option value="CS-CY">CS-CY</option>
										<option value="ME">ME</option>
										<option value="CE">CE</option>
										<option value="EEE">EEE</option>
										<option value="ECE">ECE</option>	
										<option value="Computer Applications">MCA</option>													
									</select>
									<input type="submit" class="btn btn-primary px-4 ml-4" name="Search" value="Search">
								</div>
							</div>
						</div>
						<input type="hidden" name="form" value="1">
					</form>				
				</section>
				<?php 
					if(isset($_REQUEST['Search'])){
						$Stud_Batch=$_POST['Stud_Batch'];
						$query="SELECT * FROM application a, student s, job j, company c WHERE a.Stud_ID=s.Stud_ID AND a.J_ID=j.J_ID AND a.C_ID=c.C_ID AND s.Stud_Batch='$Stud_Batch' AND a.App_Status='Approved'";
						$run=mysqli_query($con,$query);
						if(mysqli_num_rows($run)>0){
				?>
				<section class="mt-3">
					<table class="w-100 table-elements table-three-tr text-center" cellpadding="10">
						<tr class="table-tr-head table-three text-white">
							<th>StudentID</th>
								<th>Name</th>
								<th>Course</th>
								<th>Company</th>
								<th>Title</th>
								<th>Description</th>
								<th>Type</th>
								<th>Location</th>
								<th>Package</th>
							</tr>
							<?php								
								while($row=mysqli_fetch_array($run)) {
							?>
							<tr>
								<td><?php echo $row['Stud_ID']; ?></td>
								<td><?php echo $row['Stud_Name']; ?></td>
								<td><?php echo $row['Stud_Course']; ?></td>
								<td><?php echo $row['C_Name']; ?></td>
								<td><?php echo $row['J_Title']; ?></td>
								<td><?php echo $row['J_Desc']; ?></td>
								<td><?php echo $row['J_Type']; ?></td>
								<td><?php echo $row['J_Loc']; ?></td>
								<td><?php echo $row['J_Package']; ?></td>
							</tr>
							<?php
								}
							?>
					</table>
					<?php
						}
					else{
						echo '<div class="alert alert-danger text-center mt-3" role="alert">No Data Found!</div>';
					}
					?>
				</section>
				<?php				
					}
				?>
			</div>
		</main>
		<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
