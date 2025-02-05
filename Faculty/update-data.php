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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST['CGPA'], $_POST['Backlogs'], $_POST['Placement'], $_POST['Package']) &&
        is_array($_POST['CGPA']) &&
        is_array($_POST['Backlogs']) &&
        is_array($_POST['Placement']) &&
        is_array($_POST['Package'])
    ) {
        $success = true;

        foreach ($_POST['CGPA'] as $Stud_ID => $CGPA) {
            $Backlogs = $_POST['Backlogs'][$Stud_ID];
            $Placement = $_POST['Placement'][$Stud_ID];
            $Package = $_POST['Package'][$Stud_ID];

            // Sanitize inputs
            $Stud_ID = mysqli_real_escape_string($con, $Stud_ID);
            $CGPA = mysqli_real_escape_string($con, $CGPA);
            $Backlogs = mysqli_real_escape_string($con, $Backlogs);
            $Placement = mysqli_real_escape_string($con, $Placement);
            $Package = mysqli_real_escape_string($con, $Package);

            // Validate numeric inputs
            if (!is_numeric($CGPA) || !is_numeric($Backlogs)) {
                echo "<script>alert('Invalid CGPA or Backlogs for Student ID: $Stud_ID');</script>";
                $success = false;
                continue;
            }

            // Update student record
            $query = "UPDATE student 
                      SET CGPA = '$CGPA', Stud_Backlogs = '$Backlogs', Stud_Placement = '$Placement', Stud_Package = '$Package' 
                      WHERE Stud_ID = '$Stud_ID'";
            $run = mysqli_query($con, $query);

            if (!$run) {
                $success = false;
                echo "<script>alert('Error updating record for Student ID: $Stud_ID');</script>";
                continue;
            }

			if ($Placement == '1') {
				$insertQuery = "
					INSERT INTO placement (Stud_ID, Stud_Name)
					SELECT '$Stud_ID', (SELECT Stud_Name FROM student WHERE Stud_ID = '$Stud_ID')
					WHERE NOT EXISTS (
						SELECT 1 FROM placement WHERE Stud_ID = '$Stud_ID'
					)
				";
				$insertRun = mysqli_query($con, $insertQuery);
			
				if (!$insertRun) {
					$success = false;
					echo "<script>alert('Error inserting into placement table for Student ID: $Stud_ID');</script>";
				}
			}
        }

        if ($success) {
            echo "<script>alert('Records updated successfully'); window.location.href = window.location.href; </script>";
        }
    } 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['C_ID'], $_POST['C_Desg'], $_POST['P_LPA'])) {
        $success = true;

        foreach ($_POST['C_ID'] as $Stud_ID => $C_ID) {
            $C_Desg = isset($_POST['C_Desg'][$Stud_ID]) ? $_POST['C_Desg'][$Stud_ID] : null;
            $P_LPA = isset($_POST['P_LPA'][$Stud_ID]) ? $_POST['P_LPA'][$Stud_ID] : null;

            $Stud_ID = mysqli_real_escape_string($con, $Stud_ID);
            $C_ID = mysqli_real_escape_string($con, $C_ID);
            $C_Desg = mysqli_real_escape_string($con, $C_Desg);
            $P_LPA = mysqli_real_escape_string($con, $P_LPA);

            $query = "UPDATE `placement` SET `C_ID`='$C_ID',`C_Desg`='$C_Desg',`P_LPA`='$P_LPA' WHERE `Stud_ID` = '$Stud_ID'";
            $run = mysqli_query($con, $query);
			if(!$run){
				echo $query;
			}
        }
        if ($success) {
            echo "<script>alert('Records updated successfully'); window.location.href = window.location.href; </script>";
        } else {
			echo "<script>alert('Error updating CGPA');</script>";
		}
		
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
					<form class="row row-cols-lg-auto g-3 align-items-center" action="" method="post">
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
							<input type="submit" class="btn btn-primary" name="Search1" value="Update Academics">
						</div>
						<div class="col-12">
							<input type="submit" class="btn btn-primary" name="Search2" value="Update Placement">
						</div>
					</form>				
				</section>
				<?php 
					if(isset($_REQUEST['Search1'])){
						$Stud_Batch=$_POST['Stud_Batch'];
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
											<th class="w-20">Placement Status</th>
											<th class="w-20">Package</th>
										</tr>
										<?php
											while($row=mysqli_fetch_array($run)) {
										?>
										<tr>
											<td><?php echo $i++; ?></td>
											<td><?php echo $row['Stud_ID']; ?></td>
											<td><?php echo $row['Stud_Name']; ?></td>
											<td><input type="text" class="form-control" name="CGPA[<?php echo $row['Stud_ID'] ?>]" value="<?php echo $row['CGPA'] ?>" required></td>
											<td><input type="text" class="form-control" name="Backlogs[<?php echo $row['Stud_ID'] ?>]" value="<?php echo $row['Stud_Backlogs'] ?>" required></td>
											<td>
												<select class="form-select" name="Placement[<?php echo $row['Stud_ID']; ?>]">
													<option value="1" <?php echo ($row['Stud_Placement'] == 1) ? 'selected' : ''; ?>>Yes</option>
													<option value="0" <?php echo ($row['Stud_Placement'] == 0) ? 'selected' : ''; ?>>No</option>
												</select>
											</td>
											<td>
												<select class="form-select" name="Package[<?php echo $row['Stud_ID']; ?>]">
													<option value="0" <?php echo ($row['Stud_Package'] == 0) ? 'selected' : ''; ?>>Low</option>
													<option value="1" <?php echo ($row['Stud_Package'] == 1) ? 'selected' : ''; ?>>Medium</option>
													<option value="2" <?php echo ($row['Stud_Package'] == 2) ? 'selected' : ''; ?>>High</option>
												</select>
											</td>
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

					if(isset($_REQUEST['Search2'])){
						$Stud_Batch=$_POST['Stud_Batch'];
						$query="SELECT * FROM placement p, student s WHERE p.Stud_ID=s.Stud_ID and s.Stud_Batch='$Fac_Dept' and s.Stud_Year='$Stud_Batch' order by s.Stud_Name";
						$run=mysqli_query($con,$query);
						$i=1;
						if(mysqli_num_rows($run)>0){
				?>
							<section class="mt-3">
								<form method="POST">
									<table class="w-100 table table-bordered border-dark table-hover text-center" cellpadding="5">
										<tr class="table-dark text-white">
											<th>Roll No</th>
											<th>Student ID</th>
											<th>Name</th>
											<th>Company Name</th>
											<th>Designation</th>
											<th>LPA</th>
										</tr>
										<?php
											while($row=mysqli_fetch_array($run)) {
										?>
										<tr>
											<td><?php echo $i++; ?></td>
											<td><?php echo $row['Stud_ID']; ?></td>
											<td><?php echo $row['Stud_Name']; ?></td>
											<td>
												<select class="form-select" name="C_ID[<?php echo $row['Stud_ID'] ?>]" required>
													<option>Select Company Name</option>
													<?php
														$query = "SELECT * FROM company";
														$run1 = mysqli_query($con, $query);
														while ($company = mysqli_fetch_array($run1)) {
															$selected = ($company['C_ID'] == $row['C_ID']) ? 'selected' : '';
															echo "<option value='".$company['C_ID']."' $selected>".$company['C_Name']."</option>";
														}
													?>
												</select>
											</td>
											<td><input type="text" class="form-control" name="C_Desg[<?php echo $row['Stud_ID'] ?>]" value="<?php echo $row['C_Desg'] ?>" required></td>
											<td><input type="text" class="form-control" name="P_LPA[<?php echo $row['Stud_ID'] ?>]" value="<?php echo $row['P_LPA'] ?>" required></td>
										</tr>
										<?php
											}
										?>
									</table>
									<div class="text-center mt-2">
										<input type="submit" value="Update Data" class="btn btn-success">				
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
