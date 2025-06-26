 <!---------------- Session starts form here ----------------------->
 <?php  
	session_start();

	if (!$_SESSION["LoginFaculty"]){
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}

	require_once "../connection/connection.php";

    $Fac_ID=$_SESSION['LoginFaculty'];
	$query = "SELECT * FROM `faculty` WHERE `Fac_ID` = '$Fac_ID' ";
    $run = mysqli_query($con, $query);
    $row = mysqli_fetch_array($run);
	$Fac_Dept=$row['Fac_Dept'];

?>
<!---------------- Session Ends form here ------------------------>

<?php
	if (isset($_POST['submit_csv'])) {
		$records = $_POST['records'];
		foreach ($records as $record) {
			$Stud_ID = mysqli_real_escape_string($con, $record['Stud_ID']);
			$CGPA = mysqli_real_escape_string($con, $record['CGPA']);
			$Backlogs = mysqli_real_escape_string($con, $record['Backlogs']);

			$query= "UPDATE student SET CGPA = '$CGPA', Stud_Backlogs = '$Backlogs' WHERE Stud_ID = '$Stud_ID'";			
			$run = mysqli_query($con, $query);
		}

		if ($run) {
			echo "<script>alert('Records updated successfully'); window.location.href = window.location.href; </script>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty - Update Data</title> 
</head>
    <body>
        <?php include('../Common/header.php'); ?>
        <?php include('../Common/faculty-sidebar.php'); ?>
        
        <main role="main" class="mt-1 mb-3 px-md-4 page-content-index">
			<div class="sub-main">
				<div class="dashboard-header flex-wrap flex-md-no-wrap px-3 pt-2 pb-1 mb-3 text-white">
                    <div class="d-flex flex-row">
                        <div class="p-2"><h4>Update Stduent Academic & Placement Data</h4></div>
                    </div>
                </div>
				<section class="mt-3">					
					<label>
						<h5>Select Batch</h5>
					</label>
					<form class="row row-cols-lg-auto g-3 align-items-center" action="" method="post" enctype="multipart/form-data">
						<div class="col-12">
							<select class="form-select" name="Stud_Batch">
								<option>Select Batch</option>
								<?php
								for ($i = 2020; $i <= 2030; $i++) {
									$selected = (isset($_POST['Stud_Batch']) && $_POST['Stud_Batch'] == $i) ? 'selected' : '';
									echo "<option value='$i' $selected>$i</option>";
								}
								?>
							</select>
						</div>
						<div class="col-12">
							<input type="submit" class="btn btn-primary" name="Search2" value="View Academics">
						</div>
						<div class="col-12">
							<input type="file" class="form-control" name="csv_file" accept=".csv">
						</div>
						<div class="col-12">
							<input type="submit" class="btn btn-primary" name="Search1" value="Update Academics">
						</div>
					</form>				
				</section>
				<?php 
					if(isset($_REQUEST['Search1'])){
						$students = [];
						if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == 0) {
							$file = $_FILES['csv_file']['tmp_name'];
							if (($handle = fopen($file, "r")) !== FALSE) {
								$isHeader = true;
								while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Use tab-delimiter
									if ($isHeader) {
										$isHeader = false;
										continue;
									}
									if (count($data) < 4) continue; // Ensure valid row

									$students[] = [
										'Stud_ID' => $data[0],
										'Stud_Name' => $data[1],
										'CGPA' => $data[2],
										'Backlogs' => $data[3]
									];
								}
								fclose($handle);
							}
						}
					
				?>
						<section class="mt-3">
							<form method="POST">	
								<table class="w-100 table table-bordered border-dark table-hover text-center" cellpadding="5">
									<tr class="table-dark text-white">
										<th class="w-20">Roll No</th>
										<th class="w-20">Student ID</th>
										<th class="w-20">Name</th>
										<th class="w-20">CGPA</th>
										<th class="w-20">Backlogs</th>
									</tr>
									<?php foreach ($students as $i => $student): ?>
										<tr>
											<td><?= $i + 1 ?></td>
											<td><input type="text" class="form-control" name="records[<?= $i ?>][Stud_ID]" value="<?= $student['Stud_ID'] ?>" readonly></td>
											<td><input type="text" class="form-control" name="records[<?= $i ?>][Stud_Name]" value="<?= $student['Stud_Name'] ?>" readonly></td>
											<td><input type="text" class="form-control" name="records[<?= $i ?>][CGPA]" value="<?= $student['CGPA'] ?>" readonly></td>
											<td><input type="text" class="form-control" name="records[<?= $i ?>][Backlogs]" value="<?= $student['Backlogs'] ?>" readonly></td>
										</tr>
									<?php endforeach; ?>
								</table>
								<div class="text-center mt-2">
									<input type="submit" name="submit_csv" value="Update" class="btn btn-success">				
								</div>
							</form>
						</section>
				<?php	
					}
					if(isset($_REQUEST['Search2'])){
						$Stud_Batch=$_POST['Stud_Batch'];
						$Fac_Dept = $row['Fac_Dept'];
						$query="SELECT * FROM student where Stud_Batch='$Fac_Dept' and Stud_Year='$Stud_Batch' order by Stud_Name";
						$run=mysqli_query($con,$query);
						$i=1;
						if(mysqli_num_rows($run)>0){
				?>
							<section class="mt-3">
								<form method="POST">	
									<table class="w-100 table table-bordered border-dark table-hover text-center" cellpadding="5">
										<tr class="table-dark text-white">
											<th class="w-20">Roll No</th>
											<th class="w-20">Student ID</th>
											<th class="w-20">Name</th>
											<th class="w-20">CGPA</th>
											<th class="w-20">Backlogs</th>
										</tr>
										<?php
											while($row=mysqli_fetch_array($run)) {
										?>
										<tr>
											<td><?php echo $i++; ?></td>
											<td><?php echo $row['Stud_ID']; ?></td>
											<td><?php echo $row['Stud_Name']; ?></td>
											<td><?php echo $row['CGPA']; ?></td>
											<td><?php echo $row['Stud_Backlogs']; ?></td>
										</tr>
										<?php
											}
										?>
									</table>
									<div class="text-center mt-2">
										<input type="submit" value="Update" class="btn btn-success">				
									</div>
								</form>
							</section>
				<?php	
						}
						else{
							echo '<div class="alert alert-danger text-center mt-3" role="alert">No Data Found!</div>';
						}			
					}
				?>
			</div>
        </main>

        <?php include('../Common/footer.php'); ?>

        <script>
            (() => {
                'use strict';
                const tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.forEach(tooltipTriggerEl => {
                    new bootstrap.Tooltip(tooltipTriggerEl);
                });
            })();
        </script>
    </body>
</html>
