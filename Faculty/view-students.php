<!---------------- Session starts form here ----------------------->
<?php  
	session_start();
	if (!$_SESSION["LoginFaculty"]){
		echo '<script> alert("Your Are Not Authorized	 Person For This link");</script>';
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
    if (isset($_POST['download'])) {
		ob_clean();
		ob_start();
        header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=data.csv');

		$output = fopen('php://output', 'w');
		$Stud_Year=$_POST['Stud_Year'];
		$query = "SELECT * FROM student WHERE Stud_Batch='$Fac_Dept' and Stud_Year='$Stud_Year'";
		$run = mysqli_query($con, $query);

		if (mysqli_num_rows($run) > 0) {
			$fields = mysqli_fetch_fields($run);
			$columns = [];
			foreach ($fields as $field) {
				$columns[] = $field->name;
			}
			fputcsv($output, $columns);
		}

		while ($row = mysqli_fetch_assoc($run)) {
			fputcsv($output, $row);
		}
		fclose($output);
		ob_end_flush();
		exit(); 
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
					</form>				
				</section>
				<?php 
					if(isset($_REQUEST['Search'])){
						$Stud_Batch=$_POST['Stud_Batch'];
						$query="SELECT * FROM student where Stud_Batch='$Fac_Dept' and Stud_Year='$Stud_Batch' order by Stud_Name";
						$run=mysqli_query($con,$query);
						if(mysqli_num_rows($run)>0){
							$i=1;
				?>
							<section class="mt-3">
								<table class="w-100 table-elements table-three-tr text-center" cellpadding="10">
									<tr class="table-tr-head table-three text-white">
										<th>Roll No</th>
										<th>Student ID</th>
										<th>Name</th>
										<th>DOB</th>
										<th>Action</th>
									</tr>
									<?php
										while($row=mysqli_fetch_array($run)) {
									?>
									<tr>
										<td width=20><?php echo $i++; ?></td>
										<td width=20><?php echo $row['Stud_ID']; ?></td>
										<td width=20><?php echo $row['Stud_Name']; ?></td>
										<td width=20><?php echo $row['Stud_DOB']; ?></td>
										<td width=20><?php 
												echo "<a class='btn btn-success' href=display-student.php?Stud_ID=".$row['Stud_ID'].">View</a>";
												echo " <a class='btn btn-info' href=update-student.php?Stud_ID=".$row['Stud_ID'].">Update</a>";
												echo " <a class='btn btn-danger' href=display-student.php?Stud_ID=".$row['Stud_ID'].">Delete</a>"; 
											?>
										
										</td>
										<!-- <td width='200'>
											<?php
												echo '<a class="btn btn-success" href=delete.php?C_ID='.$row['C_ID'].' onClick="return confirm(\'Do you want to delete ?\')">View</a>';
											?>
										</td> -->
									</tr>
									<?php
										}
									?>
								</table>
								<div class="text-center mt-2">
									<form method="POST">
										<input type="hidden" name="Stud_Year" value=<?php echo $Stud_Batch ?>>
										<input type="submit" name="download" value="Download" class="btn btn-success">				
									</form>									
								</div>				
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