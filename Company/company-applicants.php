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


<!doctype html>
<html lang="en">
	<head>
		<title>Company - Applicants</title>
	</head>
	<body>
		<?php include('../common/common-header.php') ?>
		<?php include('../common/company-sidebar.php') ?>  

		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 mb-2 w-100">
			<div class="sub-main">
				<div
					class="bar-margin text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<h4>View Applicants</h4>
				</div>
				<div class="row">
					<div class="col-md-12 container-fluid">
						<section class="mt-3">
							<table class="w-100 table-elements table-three-tr text-center" cellpadding="5">
								<tr class="table-tr-head table-three text-white">
									<th>Student ID</th>
									<th>Name</th>
									<th>Course</th>
									<th>CGPA</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
								<?php
									$query="SELECT * FROM application a, student s, job j, company c WHERE a.Stud_ID=s.Stud_ID AND a.J_ID=j.J_ID AND a.C_ID=c.C_ID AND a.C_ID='$C_ID'";
									$run=mysqli_query($con,$query);
									while($row=mysqli_fetch_array($run)) {
										echo "<tr>";
										echo "<td>".$row["Stud_ID"]."</td>";
										echo "<td>".$row["Stud_Name"]."</td>";
										echo "<td>".$row["Stud_Course"]."</td>";
										echo "<td>".$row["CGPA"]."</td>";
										echo "<td>".$row["App_Status"]."</td>";
										echo "<td class='w-25'><a class='btn btn-info' href=display-student.php?Stud_ID=".$row['Stud_ID'].">View Profile</a>
										<a class='btn btn-success' href=action.php?App_ID=".$row['App_ID']."&App_Status=Approved>Approve</a> 
										<a class='btn btn-danger' href=action.php?App_ID=".$row['App_ID']."&App_Status=Denied>Reject</a></td>";
										echo "</tr>";
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