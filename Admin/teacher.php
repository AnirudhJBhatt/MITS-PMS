<!---------------- Session starts form here ----------------------->
<?php  
	session_start();
	if (!$_SESSION["LoginAdmin"])
	{
		header('location:../login/login.php');
	}
		require_once "../connection/connection.php";
	?>
<!---------------- Session Ends form here ------------------------>

<!--*********************** PHP code starts from here for data insertion into database ******************************* -->
<?php  
 	if (isset($_POST['add-faculty'])) {

		$Fac_ID=$_POST["Fac_ID"];

		$Fac_Name=$_POST["Fac_Name"];

 		$Fac_DOB=$_POST["Fac_DOB"];

 		$Fac_Gender=$_POST["Fac_Gender"];

		$Fac_Email=$_POST["Fac_Email"];
 		
 		$Fac_Phone_No=$_POST["Fac_Phone_No"];
 		
 		$Fac_Address=$_POST["Fac_Address"];
 		
 		$Fac_Dept=$_POST["Fac_Dept"];
 		
 		$Fac_Desg=$_POST["Fac_Desg"];

		
// *****************************************Images upload code starts here********************************************************** 
		$Fac_Image = $_FILES['Fac_Image']['name'];
		$tmp_name=$_FILES['Fac_Image']['tmp_name'];
		$path = "images/".$Fac_Image;
		move_uploaded_file($tmp_name, $path);


// *****************************************Images upload code end here********************************************************** 

		$query= "INSERT INTO `faculty`(`Fac_ID`, `Fac_Name`, `Fac_DOB`, `Fac_Gender`, `Fac_Email`, `Fac_Phone_No`, `Fac_Image`, `Fac_Address`, `Fac_Dept`, `Fac_Desg`) 
		VALUES ('$Fac_ID', '$Fac_Name', '$Fac_DOB', '$Fac_Gender', '$Fac_Email', '$Fac_Phone_No', '$Fac_Image', '$Fac_Address', '$Fac_Dept', '$Fac_Desg')";

 		$run=mysqli_query($con, $query);
 		if ($run){
			
			
			$query2="INSERT INTO `login`(`user_id`, `Password`, `Role`, `account`) VALUES ('$Fac_ID','Faculty123*','Faculty','Activate')";
			
			$query1="SELECT * FROM `faculty` ORDER BY `Fac_ID` DESC LIMIT 1";
			$run1=mysqli_query($con,$query1);	
			$row = mysqli_fetch_array($run1);

			$Fac_ID=$row['Fac_ID'];

			$User_Name = $row['Fac_Name'].$row['Fac_ID'];

			$query2="insert into login(ID,user_id,Password,Role)values('$Fac_ID','$User_Name','teacher123*','Teacher')";
			$run2=mysqli_query($con, $query2);
			
			if($run2){
				echo "<script>alert('Success'); window.location='teacher.php';</script>";
			}
 		}
 		else {
			echo "<script>alert('Failed'); window.location = 'teacher.php';</script>";
 		}
		
 		$query2="insert into login(user_id,Password,Role)values('$Fac_Dept','$password','$role')";
 		$run2=mysqli_query($con, $query2);
 		if ($run2) {
 			echo "Your Data has been submitted into login";
 		}
 		else {
 			echo "Your Data has not been submitted into login";
 		}
 	}
?>

<!--*********************** PHP code end from here for data insertion into database ******************************* -->
 

<!doctype html>
<html lang="en">
	<head>
		<title>Admin - Register Teacher</title>
	</head>
	<body>
		<?php include('../common/common-header.php') ?>
		<?php include('../common/admin-sidebar.php') ?>
		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 mb-2 w-100">
			<div class="sub-main">
				<div class="text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<div class="d-flex">
						<h4 class="mr-5">Teacher Management System </h4>
						<button type="button" class="btn btn-primary ml-5" data-toggle="modal" data-target=".bd-example-modal-lg">Add Teacher</button>
					</div>
				</div>
				<div class="row w-100">
					<div class=" col-lg-6 col-md-6 col-sm-12 mt-1 ">
						<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header bg-info text-white">
										<h4 class="modal-title text-center">Add New Teacher</h4>
									</div>
									<div class="modal-body">
										<form action="teacher.php" method="post" enctype="multipart/form-data">
											<h5>Personal Information</h5>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Name: </label>
														<input type="text" name="Fac_Name" class="form-control" required required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Date of birth </label>
														<input type="date" name="Fac_DOB" class="form-control" required required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputPassword1">Gender:</label>
														<select class="browser-default custom-select" name="Fac_Gender" required>
															<option selected>Select Gender</option>
															<option value="Male">Male</option>
															<option value="Female">Female</option>
														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputPassword1">Email:</label>
														<input type="text" name="Fac_Email" class="form-control" required 
														pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"  required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputPassword1">Mobile No</label>
														<input type="tel" name="Fac_Phone_No" class="form-control" format="[0-9]{10}" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputPassword1">Select Your Profile </label>
														<input type="file" name="Fac_Image" class="form-control" required>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Address: </label>
														<input type="text" name="Fac_Address" class="form-control" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputPassword1">Date of join:</label>
														<input type="date" name="Fac_DOJ" class="form-control" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Department:</label>
														<select class="browser-default custom-select" name="Fac_Dept">
														<option>Select Course</option>
														<?php
															$query="select course_code from courses";
															$run=mysqli_query($con,$query);
															while($row=mysqli_fetch_array($run)) {
															 echo	"<option value=".$row['course_code'].">".$row['course_code']."</option>";
															}
														?>
														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Teacher Status: </label>
														<select class="browser-default custom-select" name="Fac_Status">
															<option selected>Select Status</option>
															<option value="Permanent">Permanent</option>
															<option value="Guest">Guest</option>
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputPassword1">Faculty ID Proof:</label>
														<input type="text" name="Fac_ID_Proof" class="form-control" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
													<label for="exampleInputPassword1">Faculty ID Proof No:</label>
													<input type="text" name="Fac_ID_No" class="form-control" required>
													</div>
												</div>
											</div>
											<h5>Academic Information</h5>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">UG University:</label>
														<input type="text" name="UG_University" class="form-control" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputPassword1">UG College:</label>
														<input type="text" name="UG_College" class="form-control" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputPassword1">UG Course:</label>
														<input type="text" name="UG_Course" class="form-control" required>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">UG Admission Number:</label>
														<input type="text" name="UG_Adm_No" class="form-control" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputPassword1">UG Academic Year:</label>
														<input type="text" name="UG_Acc_Year" class="form-control" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputPassword1">UG Certificate:</label>
														<input type="file" name="UG_Cert" class="form-control" required>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">PG University:</label>
														<input type="text" name="PG_University" class="form-control" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputPassword1">PG College:</label>
														<input type="text" name="PG_College" class="form-control" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputPassword1">PG Course:</label>
														<input type="text" name="PG_Course" class="form-control" required>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">PG Admission Number:</label>
														<input type="text" name="PG_Adm_No" class="form-control" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputPassword1">PG Academic Year:</label>
														<input type="text" name="Fac_Desg" class="form-control" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputPassword1">PG Certificate:</label>
														<input type="file" name="PG_Cert" class="form-control" required>
													</div>
												</div>
											</div>
											<!-- _________________________________________________________________________________
																				Hidden Values are here
											_________________________________________________________________________________ -->
											<div>
												<input type="hidden" name="password" value="teacher123*">
												<input type="hidden" name="role" value="Teacher">
											</div>
											<!-- _________________________________________________________________________________
																				Hidden Values are end here
											_________________________________________________________________________________ -->
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
				<div class="row">
					<div class="col-md-12 container-fluid">
						<section class="mt-3">							
							<table class="w-100 table-elements mb-5 table-three-tr" cellpadding="10">
								<tr class="table-tr-head table-three text-white">
									<th>Teacher ID</th>
									<th>Teacher Name</th>
									<th>Department</th>
									<th>Operations</th>
								</tr>
								<?php 
								$query="select * from faculty";
								$run=mysqli_query($con,$query);
								while($row=mysqli_fetch_array($run)) {
									echo "<tr>";
										echo "<td>".$row["Fac_ID"]."</td>";
										echo "<td>".$row["Fac_Name"]."</td>";
										echo "<td>".$row["Fac_Dept"]."</td>";
										echo "<td width='250'>";
											echo "<a class='btn btn-info' href=display-teacher.php?Fac_ID=".$row['Fac_ID'].">Profile</a>";
											echo " <a class='btn btn-primary' href=update-teacher.php?Fac_ID=".$row['Fac_ID'].">Update</a>";
											echo ' <a class="btn btn-danger" href=delete.php?Fac_ID='.$row['Fac_ID'].' onClick="return confirm(\'Do you want to delete ?\')">Delete</a>';
										echo "</td>";
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


