<!---------------- Session starts form here ----------------------->
<?php  
	session_start();
	if (!$_SESSION["LoginFaculty"]){
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
<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['CGPA']) && is_array($_POST['CGPA'])) {
			foreach ($_POST['CGPA'] as $Stud_ID => $CGPA) {

				$Stud_ID = mysqli_real_escape_string($con, $Stud_ID);
				$CGPA = mysqli_real_escape_string($con, $CGPA);

				$query = "UPDATE student SET `CGPA` = '$CGPA' WHERE `Stud_ID` = '$Stud_ID'";
				$run = mysqli_query($con, $query);

				if ($run) {
					echo "<script>alert('CGPA updated successfully'); window.location='updatemarks.php';</script>";
				} else {
					echo "<script>alert('Error updating CGPA');</script>";
				}
			}
		}
	}
?>
<!doctype html>
<html lang="en">
	<head>
		<title>Faculty - View Students</title>
	</head>
	<body>
		<?php include('../common/common-header.php') ?>
		<?php include('../common/faculty-sidebar.php') ?>  
		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 mb-2 w-100">
			<div class="sub-main">
				<div class="bar-margin text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<h4>View Students</h4>
				</div>
				<section class="mt-3">					
					<label>
						<h5>Search by Batch</h5>
					</label>
					<form action="" method="post">
						<div class="row">
							<div class="col-5">
								<div class="input-group">
									<select class="form-control" name="Stud_Batch">
										<option>Select Batch</option>
										<?php
											for($i=2020;$i<=2030;$i++) {
												echo"<option value=".$i.">".$i."</option>";
											}
										?>
									</select>
									<input type="submit" class="btn btn-primary px-4 ml-4" name="Search" value="Search">
								</div>
							</div>
						</div>
						<input type="hidden" name="form" value="1">
					</form>				
				</section>
				<?php 
					if(isset($_REQUEST['Search'])){
						$Stud_Batch=$_POST['Stud_Batch'];
						$query="SELECT * FROM student where Stud_Batch='$Fac_Dept' and Stud_Year='$Stud_Batch' order by Stud_Name";
						$run=mysqli_query($con,$query);
						$i=1;
						if(mysqli_num_rows($run)>0){
				?>
							<section class="mt-3">
								<form method="POST">
									<table class="w-100 table-elements table-three-tr text-center" cellpadding="10">
										<tr class="table-tr-head table-three text-white">
											<th>Roll No</th>
											<th>Student ID</th>
											<th>Name</th>
											<th>CGPA</th>
										</tr>
										<?php
											while($row=mysqli_fetch_array($run)) {
										?>
										<tr>
											<td class="w-25"><?php echo $i++; ?></td>
											<td class="w-25"><?php echo $row['Stud_ID']; ?></td>
											<td class="w-25"><?php echo $row['Stud_Name']; ?></td>
											<td class="w-25"><input type="text" class="form-control" name="CGPA[<?php echo $row['Stud_ID'] ?>]" value="<?php echo $row['CGPA'] ?>" required></td>
										</tr>
										<?php
											}
										?>
									</table>
									<div class="text-center mt-2">
										<input type="submit" value="Update CGPA" class="btn btn-success">				
									</div>
								</form>
							</section>
				<?php	
						}
						else{
							echo '<div class="alert alert-danger mt-3" role="alert">No Data Found!</div>';
						}			
					}
				?>
			</div>
		</main>
		<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>