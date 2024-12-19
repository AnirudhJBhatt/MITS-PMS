<!---------------- Session starts form here ----------------------->
<?php  
	session_start();
	if (!$_SESSION["LoginFaculty"])
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
		<title>Faculty - Circulars</title>
	</head>
	<body>	
		<?php include('../common/common-header.php') ?>
		<?php include('../common/faculty-sidebar.php') ?>  
		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 mb-2 w-100">
			<div class="sub-main">
				<div class="bar-margin text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<h4>Notice Board</h4>
				</div>
				<div class="row">
					<div class="container-fluid">
						<section class="mt-3">
							<table class="w-100 table-elements table-three-tr text-center" cellpadding="5">
								<tr class="table-tr-head table-three text-white">
									<th>Circular No</th>
									<th>Name</th>
									<th>Description</th>
									<th>Document</th>
								</tr>
								<?php
									$query="SELECT * FROM circular WHERE C_To ='ALL' OR C_To='faculty'";
									$run=mysqli_query($con,$query);
									while($row=mysqli_fetch_array($run)) {
								?>
								<tr>
									<td><?php echo $row['C_ID']; ?></td>
									<td><?php echo $row['C_Name']; ?></td>
									<td><?php echo $row['C_Desc']; ?></td>
									<td><a href="<?php $C_Doc=$row['C_Doc']; echo "../admin/images/$C_Doc" ?>" target="_blank" class="btn btn-success">View</a></td>
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