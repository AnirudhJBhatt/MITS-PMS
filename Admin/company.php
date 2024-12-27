<!---------------- Session starts form here ----------------------->
<?php  
	session_start();
	if (!$_SESSION["LoginAdmin"]){
		header('location:../login/login.php');
	}
	require_once "../connection/connection.php";
?>
<!---------------- Session Ends form here ------------------------>

<!--*********************** PHP code starts from here for data insertion into database ******************************* -->
<?php  
 	if (isset($_POST['Submit'])) {

		$C_ID=$_POST["C_ID"];

		$C_Name=$_POST["C_Name"];

		$C_Type=$_POST["C_Type"];
		
		$C_YOE=$_POST["C_YOE"];

		$C_Email=$_POST["C_Email"];
 		
 		$C_Phone=$_POST["C_Phone"];
 		
 		$C_Address=$_POST["C_Address"];

 		$C_Person=$_POST["C_Person"];

 		$C_Website=$_POST["C_Website"];


		$query= "INSERT INTO company (`C_ID`, `C_Name`, `C_Type`, `C_YOE`, `C_Address`, `C_Email`, `C_Phone`, `C_Person`, `C_Website`) VALUES ('$C_ID', '$C_Name', '$C_Type', '$C_YOE', '$C_Address', '$C_Email', '$C_Phone', '$C_Person', '$C_Website')";

		$run=mysqli_query($con, $query);
		
		if($run){
			echo "<script>alert('Success'); window.location='company.php';</script>";
 		}
 		else {
			echo "<script>alert('Failed'); window.location='company.php';</script>";
 		}
		
 	}
?>

<!--*********************** PHP code end from here for data insertion into database ******************************* -->
 

<!doctype html>
<html lang="en">
	<head>
		<title>Admin - Register Company</title>
	</head>
	<body>
		<?php include('../common/common-header.php') ?>
		<?php include('../common/admin-sidebar.php') ?>
		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 mb-2 w-100">
			<div class="sub-main">
				<div class="text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<div class="d-flex">
						<h4 class="mr-5">Company Management System</h4>
						<button type="button" class="btn btn-primary ml-5" data-toggle="modal" data-target=".bd-example-modal-lg">Add Company</button>
					</div>
				</div>
				<section class="mt-3">
					<label>
						<h5>Company Search</h5>
					</label>
					<form action="" method="post">
						<div class="row">
							<div class="col-5">
								<div class="input-group">
									<input type="text" name="C_Name" class="form-control" placeholder="Enter Company Name">
									<input type="submit" class="btn btn-primary px-4 ml-4" name="Search" value="Search">
								</div>
							</div>						
						</div>	
					</form>				
				</section>
				
				<div class="row w-100">
					<div class=" col-lg-6 col-md-6 col-sm-12 mt-1 ">
						<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header bg-info text-white">
										<h4 class="modal-title text-center">Add New company</h4>
									</div>
									<div class="modal-body">
										<form action="company.php" method="post" enctype="multipart/form-data" id="companyForm"  onsubmit="return validateForm()">
											<h5>Company Information</h5>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Company ID: </label>
														<input type="text" name="C_ID" class="form-control" required>
													</div>
												</div>
												<div class="col-md-4">
												  	<div class="form-group">
														<label for="exampleInputEmail1">Name</label>
														<input type="text" name="C_Name" class="form-control" required>
													</div>
												</div>
												<div class="col-md-4">
												  	<div class="form-group">
														<label for="exampleInputEmail1">Sector</label>
														<input type="text" name="C_Type" class="form-control" required>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Year of Establishment</label>
														<input type="date" name="C_YOE" class="form-control" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Address: </label>
														<input type="text" name="C_Address" class="form-control" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputPassword1">Phone No</label>
														<input type="tel" name="C_Phone" class="form-control" format="[0-9]{10}" required>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputPassword1">Email:</label>
														<input type="text" name="C_Email" class="form-control" required 
														pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"  required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
													<label for="exampleInputPassword1">Contact Person:</label>
													<input type="text" name="C_Person" class="form-control" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
													<label for="exampleInputPassword1">Website:</label>
													<input type="text" name="C_Website" class="form-control" required>
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-primary" name="Submit" value="Submit">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
					if(isset($_POST['Search'])){
						$C_Name=$_POST['C_Name'];
						$query ="SELECT * FROM company WHERE C_Name LIKE '%$C_Name%'";				
				?>
						<section class="mt-3">
							<table class="w-100 table-elements mb-5 table-three-tr text-center" cellpadding="10">
								<tr class="table-tr-head table-three text-white">
									<th>Company ID</th>
									<th>Name</th>
									<th>Type</th>
									<th>Address</th>
									<th colspan="1">Operations</th>
								</tr>
								<?php
									$run=mysqli_query($con,$query);							
									while($row=mysqli_fetch_array($run)){
								?>
								<tr>
									<td><?php echo $row["C_ID"] ?></td>
									<td><?php echo $row["C_Name"] ?></td>
									<td><?php echo $row["C_Type"] ?></td>
									<td><?php echo $row["C_Address"] ?></td>						
									<td width='300'>
									<?php 
										echo "<a class='btn btn-info' href=display-company.php?C_ID=".$row['C_ID']." target='_blank'>Profile</a> ";
										echo '<a class="btn btn-danger" href=delete.php?C_ID='.$row['C_ID'].' onClick="return confirm(\'Do you want to delete ?\')">Delete</a>';
									?>
									</td>
								</tr>
								<?php		
									}
								?>
							</table>		
						</section>
				<?php
					}
					else{
				?>
						<div class="row">
							<div class="col-md-12 container-fluid">
								<section class="mt-3">							
									<table class="w-100 table-elements mb-5 table-three-tr" cellpadding="10">
										<tr class="table-tr-head table-three text-white">
											<th>Company ID</th>
											<th>Company Name</th>
											<th>Sector</th>
											<th>Contact Person</th>
											<th>Operations</th>
										</tr>
										<?php 
										$query="select * from company";
										$run=mysqli_query($con,$query);
										while($row=mysqli_fetch_array($run)) {
											echo "<tr>";
												echo "<td>".$row["C_ID"]."</td>";
												echo "<td>".$row["C_Name"]."</td>";
												echo "<td>".$row["C_Type"]."</td>";
												echo "<td>".$row["C_Person"]."</td>";
												echo "<td width='250'>";
													echo "<a class='btn btn-info' href=display-company.php?C_ID=".$row['C_ID']." target='_blank'>Profile</a>";
													echo " <a class='btn btn-primary' href=update-company.php?C_ID=".$row['C_ID']." target='_blank'>Update</a>";
													echo ' <a class="btn btn-danger" href=delete.php?C_ID='.$row['C_ID'].' onClick="return confirm(\'Do you want to delete ?\')">Delete</a>';
												echo "</td>";
											echo "</tr>";									
										}
										?>
									</table>				
								</section>
							</div>
						</div>
				<?php		
					}
				?>	 	
			</div>
		</main>
		<script>
			function validateForm() {
				// Validate company name, sector, and contact person name (alphabets, spaces, and hyphens only)
				const nameFields = ["C_Name", "C_Type", "C_Person"];
				for (let field of nameFields) {
					let name = document.forms["companyForm"][field].value;
					if (!/^[A-Za-z\s-]+$/.test(name)) {
						alert("Please enter a valid name");
						return false;
					}
				}

				// Validate Phone Number (10 digits)
				let phone = document.forms["companyForm"]["C_Phone"].value;
				if (!/^\d{10}$/.test(phone)) {
					alert("Please enter a valid 10-digit phone number.");
					return false;
				}

				// Validate Email
				let email = document.forms["companyForm"]["C_Email"].value;
				let emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
				if (!emailPattern.test(email)) {
					alert("Please enter a valid email address.");
					return false;
				}

				// Validate Website URL
				let website = document.forms["companyForm"]["C_Website"].value;
				if (!/^https?:\/\/.+\..+$/.test(website)) {
					alert("Please enter a valid URL starting with http or https.");
					return false;
				}

				return true; // Allow form submission if all validations pass
			}
		</script>
		<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>


