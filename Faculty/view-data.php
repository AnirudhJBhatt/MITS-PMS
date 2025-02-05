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
    if (isset($_POST['download1'])) {
        ob_clean();
        ob_start();
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.csv');

        $output = fopen('php://output', 'w');
        $Stud_Year = $_POST['Stud_Year'];
        $query = "SELECT * FROM student WHERE Stud_Batch='$Fac_Dept' and Stud_Year='$Stud_Year'";
        $run = mysqli_query($con, $query);

        if (mysqli_num_rows($run) > 0) {
            $fields = mysqli_fetch_fields($run);
            $columns = ['Sl.No']; // Add "Sl.No" to the header
            foreach ($fields as $field) {
                $columns[] = $field->name;
            }
            fputcsv($output, $columns); // Write header
        }

        $sl_no = 1; // Initialize serial number
        while ($row = mysqli_fetch_assoc($run)) {
            $row_data = [$sl_no]; // Start with serial number
            foreach ($row as $column_value) {
                $row_data[] = $column_value;
            }
            fputcsv($output, $row_data);
            $sl_no++; // Increment serial number
        }
        fclose($output);
        ob_end_flush();
        exit();
    }

    if (isset($_POST['download2'])) {
        ob_clean();
        ob_start();
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.csv');

        $output = fopen('php://output', 'w');
        $Stud_Batch = $_POST['Stud_Year'];
        $Fac_Dept = $_POST['Fac_Dept'];
        $query = "SELECT s.Stud_ID, s.Stud_Name, c.C_Name, p.C_Desg, p.P_LPA FROM placement p, student s, company c WHERE s.Stud_ID=p.Stud_ID AND c.C_ID=p.C_ID AND s.Stud_Batch='$Fac_Dept' AND s.Stud_Year='$Stud_Batch'";
        $run = mysqli_query($con, $query);

        if (mysqli_num_rows($run) > 0) {
            $fields = mysqli_fetch_fields($run);
            $columns = ['Sl.No']; // Add "Sl.No" to the header
            foreach ($fields as $field) {
                $columns[] = $field->name;
            }
            fputcsv($output, $columns); // Write header
        }

        $sl_no = 1; // Initialize serial number
        while ($row = mysqli_fetch_assoc($run)) {
            $row_data = [$sl_no]; // Start with serial number
            foreach ($row as $column_value) {
                $row_data[] = $column_value;
            }
            fputcsv($output, $row_data);
            $sl_no++; // Increment serial number
        }
        fclose($output);
        ob_end_flush();
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty - View Data</title> 
</head>
    <body>
        <?php include('../Common/header.php'); ?>
        <?php include('../Common/faculty-sidebar.php'); ?>
        
        <main role="main" class="mt-1 mb-3 px-md-4 page-content-index">
			<div class="sub-main">
				<div class="dashboard-header flex-wrap flex-md-no-wrap px-3 pt-2 pb-1 mb-3 text-white">
					<div class="d-flex flex-row">
						<div class="p-2"><h4>View Batch Data</h4></div>
					</div>
				</div>
				<section class="mt-3">	
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
							<select class="form-select" name="Stud_Course">
								<option>Select Course</option>
								<?php
								$courses = ["B.Tech", "M.Tech", "MCA"];
								foreach ($courses as $course) {
									$selected = (isset($_POST['Stud_Course']) && $_POST['Stud_Course'] == $course) ? 'selected' : '';
									echo "<option value='$course' $selected>$course</option>";
								}
								?>
							</select>
						</div>
						<div class="col-12">
							<input type="submit" class="btn btn-primary" name="Search1" value="View Students">
						</div>
						<div class="col-12">
							<input type="submit" class="btn btn-primary" name="Search2" value="View Placed Students">
						</div>
					</form>
				</section>
				<?php 
					if(isset($_REQUEST['Search1'])){
						$Stud_Course=$_POST['Stud_Course'];
						$Stud_Batch=$_POST['Stud_Batch'];
						$query="SELECT * FROM student WHERE Stud_Course='$Stud_Course' AND Stud_Batch='$Fac_Dept'AND Stud_Year='$Stud_Batch' ORDER BY Stud_Name";
						$run=mysqli_query($con,$query);
						if(mysqli_num_rows($run)>0){
							$i=1;
				?>
							<section class="mt-3">
								<table class="w-100 table table-bordered border-dark table-hover text-center" cellpadding="5">
									<tr class="table-dark text-white">
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
												echo "<a class='btn btn-success' href=display-student.php?Stud_ID=".$row['Stud_ID']." target='_blank'>View</a>";
												echo " <a class='btn btn-info' href=update-student.php?Stud_ID=".$row['Stud_ID']." target='_blank'>Update</a>";
												echo " <a class='btn btn-danger' href=display-student.php?Stud_ID=".$row['Stud_ID'].">Delete</a>"; 
											?>
										
										</td>
									</tr>
									<?php
										}
									?>
								</table>
								<div class="text-center mt-2">
									<form method="POST">
										<input type="hidden" name="Stud_Year" value=<?php echo $Stud_Batch ?>>
										<input type="submit" name="download1" value="Download" class="btn btn-success">				
									</form>									
								</div>				
							</section>
				<?php	
						}
						else{
							echo '<div class="alert alert-danger text-center mt-3" role="alert">No Data Found!</div>';
						}			
					}

					if(isset($_REQUEST['Search2'])){
						$Stud_Course=$_POST['Stud_Course'];
						$Stud_Batch=$_POST['Stud_Batch'];
						$query="SELECT s.*, p.*, c.* from placement p, student s, company c WHERE s.Stud_ID=p.Stud_ID AND c.C_ID=p.C_ID AND s.Stud_Course='$Stud_Course' AND s.Stud_Batch='$Fac_Dept' AND s.Stud_Year='$Stud_Batch'";
						$run=mysqli_query($con,$query);
						if(mysqli_num_rows($run)>0){
							$i=1;
				?>
							<section class="mt-3">
								<table class="w-100 table table-bordered border-dark table-hover text-center" cellpadding="5">
									<tr class="table-dark text-white">
										<th>SL. No</th>
										<th>Student ID</th>
										<th>Name</th>
										<th>Company Name</th>
										<th>Role</th>
										<th>Package</th>
									</tr>
									<?php
										while($row=mysqli_fetch_array($run)) {
									?>
									<tr>
										<td><?php echo $i++; ?></td>
										<td><?php echo $row['Stud_ID']; ?></td>
										<td><?php echo $row['Stud_Name']; ?></td>
										<td><?php echo $row['C_Name']; ?></td>
										<td><?php echo $row['C_Desg']; ?></td>
										<td><?php echo $row['P_LPA']." LPA"; ?></td>
									</tr>
									<?php
										}
									?>
								</table>
								<div class="text-center mt-2">
									<form method="POST">
										<input type="hidden" name="Stud_Year" value="<?php echo $Stud_Batch; ?>">
										<input type="hidden" name="Fac_Dept" value="<?php echo $Fac_Dept; ?>">
										<input type="submit" name="download2" value="Download" class="btn btn-success">				
									</form>									
								</div>				
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
