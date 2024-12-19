<!---------------- Session starts form here ----------------------->
<?php  
	session_start();
	if (!$_SESSION["LoginFaculty"])
	{
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}
	
	require_once "../connection/connection.php";

	$Fac_ID=$_SESSION['LoginFaculty'];

	$query = "SELECT Fac_Dept FROM `faculty` WHERE `Fac_ID` = '$Fac_ID' ";
		
	$run = mysqli_query($con, $query);
			
	$row = mysqli_fetch_array($run);

	$Fac_Dept=$row['Fac_Dept'];

?>
<!---------------- Session Ends form here ------------------------>


<!--*********************** PHP code starts from here for data insertion into database ******************************* -->

<?php
if (isset($_POST['records'])) {
    $records = $_POST['records'];
    foreach ($records as $record) {
        $Stud_ID = mysqli_real_escape_string($con, $record['Stud_ID']);
        $Stud_Name = mysqli_real_escape_string($con, $record['Stud_Name']);
        $Stud_Course = mysqli_real_escape_string($con, $record['Stud_Course']);
        $Stud_Batch = mysqli_real_escape_string($con, $record['Stud_Batch']);
        $Stud_Year = mysqli_real_escape_string($con, $record['Stud_Year']);

        $query1= "INSERT INTO student (`Stud_ID`, `Stud_Name`,`Stud_Course`, `Stud_Batch`,`Stud_Year`) VALUES ('$Stud_ID', '$Stud_Name','$Stud_Course','$Stud_Batch', '$Stud_Year')";
        echo $query1;
		$query2="INSERT INTO `login`(`user_id`, `Password`, `Role`, `account`) VALUES ('$Stud_ID','Student123*','Student','Activate')";
        
        $run1=mysqli_query($con, $query1);
		$run2=mysqli_query($con, $query2);
    }

    if ($run1 && $run2) {
		echo "<script>alert('Success'); window.location='add-student.php';</script>";
 		}
 	else {
		echo "<script>alert('Failed'); window.location = 'add-student.php';</script>";
 	}
}
?>
<!--*********************** PHP code end from here for data insertion into database ******************************* -->

<!doctype html>
<html lang="en">

<head>
	<title>Admin - Add User</title>
</head>

<body>
	<?php include('../common/common-header.php') ?>
	<?php include('../common/faculty-sidebar.php') ?>
	<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 w-100">
		<div class="sub-main">
			<div class="text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
				<div class="d-flex">
					<h4 class="mr-5">User Management</h4>
				</div>
			</div>
		</div>
		<section>					
			<label>
				<h5>Add a new Batch</h5>
			</label>
			<form action="" method="post">
				<div class="row">
					<div class="col-2">
						<select class="form-control" name="Stud_Year">
							<option>Select Year</option>
							<?php
								for($i=2020;$i<=2030;$i++) {
									echo"<option value=".$i.">".$i."</option>";
								}
							?>
						</select>
					</div>
					<div class="col-2">
						<select class="form-control" name="Stud_Course">
							<option>Select Course</option>
							<option value="B.Tech">B.Tech</option>
							<option value="M.Tech">M.Tech</option>
							<option value="MCA">MCA</option>
						</select>
					</div>
					<div class="col-3">
						<div class="input-group">
							<input type="number" class="form-control" name="Stud_No" placeholder="No of students">
							<input type="submit" class="btn btn-primary px-4 ml-4" name="Add" value="Add">
						</div>
					</div>
				</div>
			</form>				
		</section>
			
		<?php 
			if(isset($_REQUEST['Add'])){
				$Stud_Year=$_POST['Stud_Year'];
				$Stud_Course=$_POST['Stud_Course'];
				$Stud_No=$_POST['Stud_No'];
		?>
				<section class="mt-3">
					<form method="POST">
						<table class="w-100 table-elements table-three-tr text-center" cellpadding="10">
							<tr class="table-tr-head table-three text-white">
								<th>Roll No</th>
								<th>Student ID</th>
								<th>Name</th>
								<th>Course</th>
								<th>Department</th>
								<th>Year</th>
							</tr>
							<?php
							 for($i=1;$i<=$Stud_No;$i++){
							?>
								<tr>
									<td><?php echo $i ?></td>
									<td><input type="text" class="form-control" name="records[<?= $i ?>][Stud_ID]" required></td>
									<td><input type="text" class="form-control" name="records[<?= $i ?>][Stud_Name]" required></td>
									<td><input type="text" class="form-control" value= "<?php echo $Stud_Course ?>" name="records[<?= $i ?>][Stud_Course]" readonly></td>
									<td><input type="text" class="form-control" value= "<?php echo $Fac_Dept ?>" name="records[<?= $i ?>][Stud_Batch]" readonly></td>
									<td><input type="text" class="form-control" value= "<?php echo $Stud_Year ?>" name="records[<?= $i ?>][Stud_Year]" readonly></td>
								</tr>
							
							<?php	
							}
							?>
						</table>
						<div class="text-center mt-2">
							<input type="submit" value="Add Students" class="btn btn-success">				
						</div>
					</form>				
				</section>
				<?php				
					}
				?>
	</main>
	<script>
		function validateForm() {
			const form = document.getElementById("studentForm");
			const name = form["Stud_Name"].value;
			if (!/^[A-Za-z\s-]+$/.test(name)) {
				alert("Names should only contain alphabets");
				return false;
			}
			if (form["Stud_ID"].value === "") {
				alert("Admission No is required.");
				return false;
			}
			return true;
		}
	</script>
	<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>