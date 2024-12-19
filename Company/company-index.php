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
<?php
	$query="select * from Company where C_ID='$C_ID'";
	$run=mysqli_query($con,$query);
	$row=mysqli_fetch_array($run);
?>
<!---------------- Session Ends form here ------------------------>



<html lang="en">
	<head>
		<title>Company - Dashboard</title>
	</head>
	<body>
		<?php include('../common/common-header.php') ?>
		<?php include('../common/company-sidebar.php') ?>  

		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 main-background mb-2 w-100">
			<div class="sub-main">
				<div class="text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<h4 class="">Welcome <?php echo $row['C_Name']; ?> </h4>
				</div>				
				<div class="row">
					<div class="col-md-12">
						<section class="container-fluid">
							<div class="container mt-5 mb-5 border border-dark rounded"> 
								<div class="row mt-3">
									<div class="col">
										<table class="table table-light table-hover table-bordered border-info" align="center">
											<tr class="table-info text-center">
												<th colspan="2">Company Information</th>
											</tr>
											<tr>
												<th>Company ID</th>
												<td><?php echo $row['C_ID']; ?></td>
											</tr>                    
											<tr>
												<th>Name</th>
												<td><?php echo $row['C_Name']; ?></td>
											</tr>
											<tr>
												<th>Year of Establishment</th>
												<td><?php echo $row['C_YOE']; ?></td>
											</tr>
											<tr>
												<th>Address</th>
												<td><?php echo $row['C_Address']; ?></td>
											</tr>
											<tr>
												<th>Email</th>
												<td><?php echo $row['C_Email']; ?></td>
											</tr>
											<tr>
												<th>Phone</th>
												<td><?php echo $row['C_Phone']; ?></td>
											</tr>
											<tr>
												<th>Contact Person</th>
												<td><?php echo $row['C_Person']; ?></td>
											</tr>
											<tr>
												<th>Website</th>
												<td><?php echo $row['C_Website']; ?></td>
											</tr>
										</table>
									</div>                        
								</div>
							</div>  
						</section>
					</div>
				</div>
			</div>
		</main>
		<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>