 <!---------------- Session starts form here ----------------------->
 <?php  
	session_start();
	if (!$_SESSION["LoginAdmin"]){
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}
		require_once "../connection/connection.php";
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
        $Stud_Branch = $_POST['Stud_Branch'];
        $query = "SELECT * FROM student WHERE Stud_Batch='$Stud_Branch' and Stud_Year='$Stud_Year'";
        $run = mysqli_query($con, $query);

        if (mysqli_num_rows($run) > 0) {
            // Fetch column names from query result
            $fields = mysqli_fetch_fields($run);
            $columns = ['Sl.No']; // Add "Sl.No" as the first column
            foreach ($fields as $field) {
                $columns[] = $field->name;
            }
            fputcsv($output, $columns); // Write header row
        }

        $sl_no = 1; // Initialize serial number
        while ($row = mysqli_fetch_assoc($run)) {
            // Prepend serial number to each row
            $row = array_merge(['Sl.No' => $sl_no], $row);
            fputcsv($output, $row);
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
		$Stud_Batch=$_POST['Stud_Year'];
		$Stud_Branch=$_POST['Stud_Branch'];
		$query="SELECT s.Stud_ID, s.Stud_Name, c.C_Name, p.C_Desg, p.P_LPA from placement p, student s, company c WHERE s.Stud_ID=p.Stud_ID AND c.C_ID=p.C_ID AND s.Stud_Batch='$Stud_Branch' AND s.Stud_Year='$Stud_Batch'";
		$run = mysqli_query($con, $query);

		if (mysqli_num_rows($run) > 0) {
			$fields = mysqli_fetch_fields($run);
			$columns = ['Sl.No'];
			foreach ($fields as $field) {
				$columns[] = $field->name;
			}
			fputcsv($output, $columns);
		}

		$sl_no = 1;
		while ($row = mysqli_fetch_assoc($run)) {
            $row = array_merge(['Sl.No' => $sl_no], $row);
			fputcsv($output, $row);
			$sl_no++;
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
    <title>Admin - Placement Data</title>
</head>
    <body>
        <?php include('../Common/header.php'); ?>
        <?php include('../Common/admin-sidebar.php'); ?>
        
        <main role="main" class="mt-1 mb-3 px-md-4 page-content-index">
            <div class="sub-main">
                <div class="dashboard-header flex-wrap flex-md-no-wrap px-3 pt-3 pb-2 mb-3 text-white">
                    <h4>Placement Data</h4>
                </div>
				<section class="mt-3">					
					<label>
						<h5>Search by Batch</h5>
					</label>
					<form class="row row-cols-lg-auto g-3 align-items-center" action="" method="post">
						<div class="col-12">
							<select class="form-select" name="Stud_Batch">
								<option>Select Year</option>
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
								<option value="B.Tech" <?php echo (isset($_POST['Stud_Course']) && $_POST['Stud_Course'] == "B.Tech") ? 'selected' : ''; ?>>B.Tech</option>
								<option value="M.Tech" <?php echo (isset($_POST['Stud_Course']) && $_POST['Stud_Course'] == "M.Tech") ? 'selected' : ''; ?>>M.Tech</option>
								<option value="MCA" <?php echo (isset($_POST['Stud_Course']) && $_POST['Stud_Course'] == "MCA") ? 'selected' : ''; ?>>MCA</option>
							</select>
						</div>
						<div class="col-12">
							<select class="form-select" name="Stud_Branch">
								<option>Select Branch</option>
								<?php
								$branches = ["CS-AI", "AI&DS", "CS", "CS-CY", "ME", "CE", "ECE", "EEE", "Computer Applications"];
								foreach ($branches as $branch) {
									$selected = (isset($_POST['Stud_Branch']) && $_POST['Stud_Branch'] == $branch) ? 'selected' : '';
									echo "<option value='$branch' $selected>$branch</option>";
								}
								?>
							</select>
						</div>
						
						<div class="col-12">
							<select class="form-select" name="">
								<option>Select Band</option>
								<option value="B.Tech">Low</option>
								<option value="M.Tech">Medium</option>
								<option value="MCA">High</option>
							</select>
						</div>
						<div class="col-6">
							<input type="submit" class="btn btn-primary px-4 ml-4" name="Search1" value="View Students">
						</div>
						<div class="col-6	">
							<input type="submit" class="btn btn-primary px-4 ml-4" name="Search2" value="View Placed Students">
						</div>
					</form>
				</section>
				<?php 
					if(isset($_REQUEST['Search1'])){
						$Stud_Course=$_POST['Stud_Course'];
						$Stud_Branch=$_POST['Stud_Branch'];
						$Stud_Batch=$_POST['Stud_Batch'];
						$query="SELECT * FROM student WHERE Stud_Course='$Stud_Course' AND Stud_Batch='$Stud_Branch'AND Stud_Year='$Stud_Batch' ORDER BY Stud_Name";
						$run=mysqli_query($con,$query);
						if(mysqli_num_rows($run)>0){
							$i=1;
				?>
							<section class="mt-3">
								<table class="w-100 table table-bordered table-hover border-dark text-center" cellpadding="10">
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
												echo "<a class='btn btn-success' target='_blank' href=display-student.php?Stud_ID=".$row['Stud_ID'].">View</a>";
												echo " <a class='btn btn-info' target='_blank' href=update-student.php?Stud_ID=".$row['Stud_ID'].">Update</a>";
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
										<input type="hidden" name="Stud_Branch" value="<?php echo $Stud_Branch; ?>">
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
						$Stud_Branch=$_POST['Stud_Branch'];
						$Stud_Batch=$_POST['Stud_Batch'];
						$query="SELECT s.*, p.*, c.* from placement p, student s, company c WHERE s.Stud_ID=p.Stud_ID AND c.C_ID=p.C_ID AND s.Stud_Course='$Stud_Course' AND s.Stud_Batch='$Stud_Branch'AND s.Stud_Year='$Stud_Batch' ORDER BY s.Stud_Name";
						$run=mysqli_query($con,$query);
						if(mysqli_num_rows($run)>0){
							$i=1;
				?>
							<section class="mt-3">
								<table class="w-100 table table-bordered table-hover border-dark text-center" cellpadding="10">
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
										<input type="hidden" name="Stud_Branch" value="<?php echo $Stud_Branch; ?>">
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
