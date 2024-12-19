<!---------------- Session starts form here ----------------------->
<?php  
	session_start();
	if (!$_SESSION["LoginAdmin"])
	{
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}
		require_once "../connection/connection.php";
		$_SESSION["LoginStudent"]="";
	?>
<!---------------- Session Ends form here ------------------------>

<!doctype html>
<html lang="en">

<head>
	<title>Admin - View Applications</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>
	<?php include('../common/common-header.php') ?>
	<?php include('../common/admin-sidebar.php') ?>
	<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 w-100">
		<div class="sub-main">
			<div class="text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
				<div class="d-flex">
					<h4 class="mr-5">View Applications</h4>
				</div>
			</div>
			<section class="mt-3">
				<label>
					<h5>Application Search</h5>
				</label>
				<form action="" method="post">
					<div class="row">
						<div class="col-6">
							<div class="input-group">
								<select class="form-control" name="J_ID">
									<option>Select Job Title</option>
									<?php
										$query="SELECT * from Job";
										$run=mysqli_query($con,$query);
										while($row=mysqli_fetch_array($run)) {
											echo"<option value=".$row['J_ID'].">".$row['J_Title']."</option>";
										}
                   					?>
								</select>
								<input type="submit" class="btn btn-primary px-4 ml-4" name="search" value="Search">
							</div>
						</div>
					</div>
				</form>				
			</section>
			<?php 
				if(isset($_REQUEST['search'])){
					$J_ID=$_POST['J_ID'];
			?>
			<section class="mt-3">
				<table class="w-100 table-elements mb-5 table-three-tr text-center" cellpadding="10">
					<tr class="table-tr-head table-three text-white">
						<th>Student ID</th>
						<th>Name</th>
						<th>Course</th>
						<th>Job</th>
						<th>Company</th>
						<th>Status</th>
					</tr>
					<?php	
						$query ="SELECT * FROM application a, student s, job j, company c WHERE a.Stud_ID=s.Stud_ID AND a.J_ID=j.J_ID AND a.C_ID=c.C_ID AND a.J_ID=$J_ID";	
						$run=mysqli_query($con,$query);							
						while($row=mysqli_fetch_array($run)){	
							echo "<tr>";
							echo "<td>".$row['Stud_ID']."</td>";
							echo "<td>".$row['Stud_Name']."</td>";
							echo "<td>".$row['Stud_Course']."</td>";
							echo "<td>".$row['J_Title']."</td>";
							echo "<td>".$row['C_Name']."</td>";
							echo "<td>".$row['App_Status']."</td>";
							echo "</tr>";
						}
					?>
				</table>
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