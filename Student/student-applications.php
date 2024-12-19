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

<!doctype html>
<html lang="en">

<head>
	<title>Student - Fee</title>
</head>

<body>	
	<?php include('../common/common-header.php') ?>
	<?php include('../common/student-sidebar.php') ?>  

	<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 mb-2 w-100">
		<div class="sub-main">
			<div
				class="bar-margin text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
				<h4>Applications</h4>
			</div>
			<div class="row">
				<div class="col-md-12 container-fluid">
					<section class="mt-3">
						<table class="w-100 table-elements table-three-tr text-center" cellpadding="10">
							<tr class="table-tr-head table-three text-white">
								<th>Application ID</th>
								<th>Drive ID</th>
								<th>Drive Name</th>
							</tr>
							<?php
								$query="SELECT * FROM application a, student s, drive d WHERE a.S_ID=s.Stud_ID AND a.D_ID=D.D_ID and a.S_ID='$Stud_ID'";
								$run=mysqli_query($con,$query);
								while($row=mysqli_fetch_array($run)) {
									echo "<tr>";
									echo "<td>".$row["App_ID"]."</td>";
									echo "<td>".$row["D_ID"]."</td>";
									echo "<td>".$row["D_Name"]."</td>";
									echo "</tr>";
								}
							?>
						</table>				
					</section>
				</div>	
			</div>
		</div>
	</main>
	<script type="text/javascript" src="../bootstrap/js/jquery$query.min.js"></script>
	<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>