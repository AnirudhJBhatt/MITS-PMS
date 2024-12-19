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


<!--*********************** PHP code starts from here for data insertion into database ******************************* -->
<?php  
 	if (isset($_POST['submit'])) {

		$Stud_ID =$_POST['Stud_ID'];

		$Stud_Name =$_POST['Stud_Name'];

		$Stud_DOB =$_POST['Stud_DOB'];

		$Stud_Gender =$_POST['Stud_Gender'];

		$Stud_Mob =$_POST['Stud_Mob'];

		$Stud_Email =$_POST['Stud_Email'];

		$Stud_Address =$_POST['Stud_Address'];

		$Stud_Caste =$_POST['Stud_Caste'];

		$Stud_M_T =$_POST['Stud_M_T'];

		$Stud_Course =$_POST['Stud_Course'];

		$Stud_Batch =$_POST['Stud_Batch'];

		$Stud_Year =$_POST['Stud_Year'];

		$Stud_ID_No =$_POST['Stud_ID_No'];

		$Stud_Reg_No =$_POST['Stud_Reg_No'];

		$Stud_Father_Name =$_POST['Stud_Father_Name'];

		$Stud_Father_Occ =$_POST['Stud_Father_Occ'];

		$Stud_Father_No =$_POST['Stud_Father_No'];

		$Stud_Mother_Name =$_POST['Stud_Mother_Name'];

		$Stud_Mother_Occ =$_POST['Stud_Mother_Occ'];

		$Stud_Mother_No =$_POST['Stud_Mother_No'];

		$Guardian_Email =$_POST['Guardian_Email'];

		$Annual_Income =$_POST['Annual_Income'];

		$Board_12th =$_POST['Board_12th'];

		$School_12th =$_POST['School_12th'];

		$Stream_12th =$_POST['Stream_12th'];

		$YOP_12th =$_POST['YOP_12th'];

		$Board_10th =$_POST['Board_10th'];

		$School_10th =$_POST['School_10th'];

		$YOP_10th =$_POST['YOP_10th'];

		$CGPA =$_POST['CGPA'];

// *****************************************Images upload code starts here********************************************************** 
		$Stud_Image = $_FILES['Stud_Image']['name'];
		$tmp_name=$_FILES['Stud_Image']['tmp_name'];
		$path1 = "images/".$Stud_Image;
		move_uploaded_file($tmp_name, $path1);

		$Mark_List_10th = $_FILES['Mark_List_10th']['name'];
		$tmp_name=$_FILES['Mark_List_10th']['tmp_name'];
		$path2 = "images/".$Mark_List_10th;
		move_uploaded_file($tmp_name, $path2);

		$Mark_List_12th = $_FILES['Mark_List_12th']['name'];
		$tmp_name=$_FILES['Mark_List_12th']['tmp_name'];
		$path3 = "images/".$Mark_List_12th;
		move_uploaded_file($tmp_name, $path3);
		
// *****************************************Images upload code end here********************************************************** 
		$query1= "INSERT INTO student (`Stud_ID`, `Stud_Name`, `Stud_DOB`, `Stud_Gender`, `Stud_Mob`, `Stud_Email`, `Stud_Address`, `Stud_Caste`, `Stud_M_T`, `Stud_Course`, `Stud_Batch`, `Stud_Year`, `Stud_ID_No`, `Stud_Reg_No`, `Stud_Father_Name`, `Stud_Father_Occ`, `Stud_Father_No`, `Stud_Mother_Name`, `Stud_Mother_Occ`, `Stud_Mother_No`, `Guardian_Email`, `Annual_Income`, `Board_12th`, `School_12th`, `Stream_12th`, `YOP_12th`, `Board_10th`, `School_10th`, `YOP_10th`, `CGPA`, `Stud_Image`, `Mark_List_10th`, `Mark_List_12th`) VALUES ('$Stud_ID', '$Stud_Name', '$Stud_DOB', '$Stud_Gender', '$Stud_Mob', '$Stud_Email', '$Stud_Address', '$Stud_Caste', '$Stud_M_T', '$Stud_Course', '$Stud_Batch', '$Stud_Year', '$Stud_ID_No', '$Stud_Reg_No', '$Stud_Father_Name', '$Stud_Father_Occ', '$Stud_Father_No', '$Stud_Mother_Name', '$Stud_Mother_Occ', '$Stud_Mother_No', '$Guardian_Email', '$Annual_Income', '$Board_12th', '$School_12th', '$Stream_12th', '$YOP_12th', '$Board_10th', '$School_10th', '$YOP_10th', '$CGPA', '$Stud_Image', '$Mark_List_10th', '$Mark_List_12th')";
		
		$query2="INSERT INTO `login`(`user_id`, `Password`, `Role`, `account`) VALUES ('$Stud_ID','Student123*','Student','Activate')";

		$run1=mysqli_query($con, $query1);

		$run2=mysqli_query($con, $query2);
 		
		if ($run1 && $run2) {
			echo "<script>alert('Success'); window.location='student.php';</script>";
 		}
 		else {
			echo "<script>alert('Failed'); window.location = 'student.php';</script>";
 		}
 	}
?>

<!--*********************** PHP code end from here for data insertion into database ******************************* -->

<!doctype html>
<html lang="en">

<head>
	<title>Admin - Add Student</title>
</head>

<body>
	<?php include('../common/common-header.php') ?>
	<?php include('../common/admin-sidebar.php') ?>
	<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 w-100">
		<div class="sub-main">
			<div class="text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
				<div class="d-flex">
					<h4 class="mr-5">Student Management System </h4>
					<button type="button" class="btn btn-primary ml-5" data-toggle="modal"
						data-target=".bd-example-modal-lg">Add Student</button>
				</div>
			</div>
			<div class="col-md-2 pt-3 w-100">
				<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
					aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header bg-info text-white">
								<h4 class="modal-title text-center">Add New Student</h4>
							</div>
							<div class="modal-body">
								<form id="studentForm" action="student.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
									<h5>Student Details</h5>
									<div class="row mt-3">
										<div class="col-md-4">
											<div class="form-group">
												<label>Admission No:*</label>
												<input type="text" name="Stud_ID" class="form-control" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Name:*</label>
												<input type="text" name="Stud_Name" class="form-control" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Date of Birth: </label>
												<input type="date" name="Stud_DOB" class="form-control" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Gender:</label>
												<select class="browser-default custom-select" name="Stud_Gender" required>
													<option>Select Gender</option>
													<option value="Male">Male</option>
													<option value="Female">Female</option>
													<option value="Other">Other</option>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Mobile No:*</label>
												<input type="text" name="Stud_Mob" class="form-control" format="[0-9]{10}" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Email:*</label>
												<input type="email" name="Stud_Email" class="form-control"
													pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Address: </label>
												<input type="text" name="Stud_Address" class="form-control" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Caste/Religion:</label>
												<input type="text" name="Stud_Caste" class="form-control" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Mother Tongue:</label>
												<input type="text" name="Stud_M_T" class="form-control" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Course:</label>
												<select class="browser-default custom-select" name="Stud_Course" required id="Stud_Course" onchange="addfield()">
													<option>Select Course</option>
													<option value="B.Tech">B.Tech</option>
													<option value="M.Tech">M.Tech</option>
													<option value="MCA">MCA</option>													
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Batch:</label>
												<select class="browser-default custom-select" name="Stud_Batch" required>
													<option>Select Batch</option>
													<option value="CS">CS</option>
													<option value="CS-AI">CS-AI</option>
													<option value="AI&DS">AI&DS</option>
													<option value="CS-CY">CS-CY</option>
													<option value="ME">ME</option>
													<option value="CE">CE</option>
													<option value="EEE">EEE</option>
													<option value="ECE">ECE</option>	
													<option value="Computer Applications">Computer Applications</option>													
												</select>
											</div>
										</div>										
										<div class="col-md-4">
											<div class="form-group">
												<label>Semester:</label>
												<select class="browser-default custom-select" name="Stud_Year" required>
													<option>Select Semester</option>
													<option value="I">I</option>
													<option value="II">II</option>
													<option value="III">III</option>
													<option value="IV">IV</option>
													<option value="V">V</option>
													<option value="VI">VI</option>
													<option value="VII">VII</option>
													<option value="VIII">VIII</option>												
												</select>
											</div>
										</div>										
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Aadhar No:</label>
												<input type="text" name="Stud_ID_No" class="form-control" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>University Reg No: </label>				
												<input type="text" name="Stud_Reg_No" class="form-control" required>
											</div>
										</div>	
										<div class="col-md-4">
											<div class="form-group">
												<label>Student Image:</label>
												<input type="file" name="Stud_Image" class="form-control" required>
											</div>
										</div>									
									</div>
									<h5>Parental Information</h5>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Father's Name:</label>
												<input type="text" name="Stud_Father_Name" class="form-control" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Father's Occupation:</label>
												<input type="text" name="Stud_Father_Occ" class="form-control" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Father's Mobile No:</label>
												<input type="text" name="Stud_Father_No" class="form-control" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Mother's Name:</label>
												<input type="text" name="Stud_Mother_Name" class="form-control" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Mother's Occupation:</label>
												<input type="text" name="Stud_Mother_Occ" class="form-control" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Mother's Mobile No:</label>
												<input type="text" name="Stud_Mother_No" class="form-control" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Guardian Email:</label>
												<input type="email" name="Guardian_Email" class="form-control"
												pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Annual Income:</label>
												<input type="text" name="Annual_Income" class="form-control" required>
											</div>
										</div>
									</div>
									<h5>Academic Detials</h5>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>12th Board:</label>
												<input type="text" name="Board_12th" class="form-control" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>School:</label>
												<input type="text" name="School_12th" class="form-control" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Stream:</label>
												<input type="text" name="Stream_12th" class="form-control" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Year of Passing:</label>
												<input type="text" name="YOP_12th" class="form-control" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>10th Board:</label>
												<input type="text" name="Board_10th" class="form-control" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>10th School:</label>
												<input type="text" name="School_10th" class="form-control" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Year of Passing:</label>
												<input type="text" name="YOP_10th" class="form-control" required>
											</div>
										</div>	
										<div class="col-md-4">
											<div class="form-group">
												<label>10th Marklist:</label>
												<input type="file" name="Mark_List_10th" class="form-control" value="there is no image" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>12th Marklist:</label>
												<input type="file" name="Mark_List_12th" class="form-control" value="there is no image" required>
											</div>
										</div>
									</div>
									<div class="row" id="conditional">
										<div class="col-md-4">
											<div class="form-group">
												<label>Year of Passing:</label>
												<input type="text" name="YOP_10th" class="form-control" required>
											</div>
										</div>	
										<div class="col-md-4">
											<div class="form-group">
												<label>10th Marklist:</label>
												<input type="file" name="Mark_List_10th" class="form-control" value="there is no image" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>12th Marklist:</label>
												<input type="file" name="Mark_List_12th" class="form-control" value="there is no image" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Current Semester CGPA:</label>
												<input type="text" name="CGPA" class="form-control" required>
											</div>
										</div>	
									</div>
									<div class="modal-footer">
										<input type="submit" class="btn btn-primary" name="submit">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 container-fluid">
					<section class="mt-3">						
						<table class="w-100 table-elements mb-5 table-three-tr text-center" cellpadding="10">
							<tr class="table-tr-head table-three text-white">
								<th>Admission No</th>
								<th>Name</th>
								<th>Course</th>
								<th>Batch</th>
								<th>Semester</th>
								<th colspan="1">Operations</th>
							</tr>
							<?php 
								
								$query ="SELECT `Stud_ID`,`Stud_Name`,`Stud_Course`,`Stud_Batch`,`Stud_Year` FROM student;";
								$run=mysqli_query($con,$query);
								while($row=mysqli_fetch_array($run)) {?>
							<tr>
								
								<td>
									<?php echo $row["Stud_ID"] ?>
								</td>
								<td>
									<?php echo $row["Stud_Name"] ?>
								</td>
								<td>
									<?php echo $row["Stud_Course"] ?>
								</td>
								<td>
									<?php echo $row["Stud_Batch"] ?>
								</td>
								<td>
									<?php echo $row["Stud_Year"] ?>
								</td>
								<td width='250'>
									<?php 
										echo "<a class='btn btn-info' href=display-student.php?Stud_ID=".$row['Stud_ID'].">Profile</a>";
										echo '  <a class="btn btn-primary" href=update-student.php?Stud_ID='.$row['Stud_ID'].'>Update</a>';
										echo '	<a class="btn btn-danger" href=delete.php?Stud_ID='.$row['Stud_ID'].' onClick="return confirm(\'Do you want to delete ?\')">Delete</a>';
									?>
								</td>
							</tr>
							<?php }
								?>
						</table>
					</section>
				</div>
			</div>
		</div>
	</main>
	<script>
		function validateForm() {
			const form = document.getElementById("studentForm");

			// Validate all name fields
			const nameFields = ["Stud_Name", "Stud_Father_Name", "Stud_Mother_Name"];
			for (let field of nameFields) {
				let name = form[field].value;
				if (!/^[A-Za-z\s-]+$/.test(name)) {
					alert("Names should only contain alphabets");
					return false;
				}
			}

			// Validate Admission Number
			if (form["Stud_ID"].value === "") {
				alert("Admission No is required.");
				return false;
			}

			// Validate Mobile Numbers
			const mobileFields = ["Stud_Mob", "Stud_Father_No", "Stud_Mother_No"];
			for (let field of mobileFields) {
				let mobile = form[field].value;
				if (!/^\d{10}$/.test(mobile)) {
					alert("Please enter a valid 10-digit mobile number.");
					return false;
				}
			}

			// Validate Email
			let email = form["Stud_Email"].value;
			let emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
			if (!emailPattern.test(email)) {
				alert("Please enter a valid email address.");
				return false;
			}

			// Validate Aadhaar Number (12 digits)
			let aadhaar = form["Stud_ID_No"].value;
			if (!/^\d{12}$/.test(aadhaar)) {
				alert("Please enter a valid 12-digit Aadhaar Number.");
				return false;
			}

			// Validate CGPA
			let cgpa = form["CGPA"].value;
			if (!/^(10|[0-9](\.\d{1,2})?)$/.test(cgpa)) {
				alert("Please enter a valid CGPA between 0 and 10.");
				return false;
			}

			return true;
		}

		function addfield() {
			const course = document.getElementById("Stud_Course").value;
            const ug_marks = document.getElementById("conditional");
            if (course === "B.Tech") {
                ug_marks.style.display = "none";
            } else {
                ug_marks.style.display = "block";
            }			
		}

	</script>
	<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>