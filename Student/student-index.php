<!---------------- Session starts form here ----------------------->
 <?php  
	session_start();
	if (!$_SESSION["LoginStudent"])
	{
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}
		require_once "../connection/connection.php";
		$Stud_ID=$_SESSION['LoginStudent'];
		
	?>
<!---------------- Session Ends form here ------------------------>
<?php
	$query = "SELECT * FROM `student` WHERE `Stud_ID` = '$Stud_ID' ";

	$run=mysqli_query($con,$query);
	
	$row=mysqli_fetch_array($run);
?>


<!doctype html>
<html lang="en">
	<head>
		<title>Student - Dashboard</title>
	</head>
	<body>
		<?php include('../common/common-header.php') ?>
		<?php include('../common/student-sidebar.php') ?>  

		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 mb-2 w-100">
			<div class="sub-main">
				<div class="text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<h4 class="">Welcome <?php echo $row['Stud_Name']; ?> </h4>
				</div>
				<div class="container mt-5 mb-5 border border-dark rounded"> 
					<div class='header text-center mt-3'>
						<h3 class='text-dark'>Student Profile</h3>
					</div>       
					<div class="row mt-3">
						<div class="col align-self-center text-center">
							<?php  $Stud_Image= $row["Stud_Image"]; ?>
							<figure class="figure">
								<img src="<?php echo '../Images/'.$Stud_Image; ?>" class="figure-img img-fluid border" height='290px' width='250px'>
							</figure>                      
						</div>
						<div class="col">
							<table class="table table-light table-hover table-bordered border-info" align="center">
								<tr class="table-info text-center">
									<th colspan="2">Personal Information</th>
								</tr>
								<tr>
									<th>Admission No</th>
									<td><?php echo $row['Stud_ID']; ?></td>
								</tr>
								<tr>
									<th>Name</th>
									<td><?php echo $row['Stud_Name']; ?></td>
								</tr>                    
								<tr>
									<th>Programme</th>
									<td><?php echo $row['Stud_Course']; ?></td>
								</tr>
								<tr>
									<th>Date of Birth</th>
									<td><?php echo $row['Stud_DOB']; ?></td>
								</tr>
								<tr>
									<th>Gender</th>
									<td><?php echo $row['Stud_Gender']; ?></td>
								</tr>
								<tr>
									<th>Phone Number</th>
									<td><?php echo $row['Stud_Mob']; ?></td>
								</tr>								
							</table>
						</div>                        
					</div>
				</div>	
			</div>
		</main>
		<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>