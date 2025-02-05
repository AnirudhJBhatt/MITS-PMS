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
    if (isset($_POST['download'])) {
        if (!empty($_POST['columns'])) {
            $D_ID = $_POST['D_ID'];
            $columns = array_map('mysqli_real_escape_string', array_fill(0, count($_POST['columns']), $con), $_POST['columns']);
            $selected_columns = implode(", ", $columns);
            $query = "SELECT $selected_columns FROM student s, application a WHERE s.Stud_ID=a.S_ID and a.D_ID='$D_ID'";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                ob_clean();
                ob_start();
                header('Content-Type: text/csv; charset=utf-8');
                header('Content-Disposition: attachment; filename=data.csv');
                $output = fopen('php://output', 'w');

                // Add "Sl.No" to the header
                $columns_with_serial = array_merge(['Sl.No'], $_POST['columns']);
                fputcsv($output, $columns_with_serial);

                $sl_no = 1; // Initialize serial number
                while ($row = mysqli_fetch_assoc($result)) {
                    $row_data = [$sl_no]; // Start with the serial number
                    foreach ($_POST['columns'] as $column) {
                        $row_data[] = $row[$column];
                    }
                    fputcsv($output, $row_data);
                    $sl_no++; // Increment serial number
                }

                fclose($output);
                ob_end_flush();
                exit();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Drive Details</title> 
</head>
    <body>
        <?php include('../Common/header.php'); ?>
        <?php include('../Common/admin-sidebar.php'); ?>
        
        <main role="main" class="mt-1 mb-3 px-md-4 page-content-index">
            <div class="sub-main">
                <div class="dashboard-header flex-wrap flex-md-no-wrap px-3 pt-2 pb-1 mb-3 text-white">
                    <div class="d-flex flex-row">
                        <div class="p-2"><h4>View Drive Applicants</h4></div>
                    </div>
                </div>
				<section class="mt-3">					
					<label>
						<h5>Select Drive</h5>
					</label>
					<form class="row row-cols-lg-auto g-3 align-items-center" action="" method="post">
						<div class="col-12">
							<select class="form-select" name="D_ID">
								<option>Select Job Title</option>
								<?php
								$query = "SELECT * FROM drive";
								$run = mysqli_query($con, $query);
								while ($row = mysqli_fetch_array($run)) {
									$selected = (isset($_POST['D_ID']) && $_POST['D_ID'] == $row['D_ID']) ? 'selected' : '';
									echo "<option value='{$row['D_ID']}' $selected>{$row['D_Name']}</option>";
								}
								?>
							</select>
						</div>
						<div class="col-12">
							<input type="submit" class="btn btn-primary px-4 ml-4" name="Search" value="View Applicants">
						</div>
						<div class="col-12">
							<input type="submit" class="btn btn-success px-4 ml-4" name="View" value="View Details">
						</div>
					</form>
				</section>
				<?php 
					if(isset($_REQUEST['Search'])){
						$D_ID=$_POST['D_ID'];
						$query="SELECT * FROM application a, Student s where a.S_ID=s.Stud_ID and a.D_ID='$D_ID'";
						$run=mysqli_query($con,$query);
                        if(mysqli_num_rows($run)>0){
				?>
							<section class="mt-3">
								<table class="w-100 table table-bordered table-hover border-dark text-center" cellpadding="10">
									<tr class="table-dark text-white">
										<th>Student ID</th>
										<th>Name</th>
										<th>Branch</th>
										<th>Year</th>
									</tr>
									<?php
										while($row=mysqli_fetch_array($run)) {
									?>
									<tr>
										<td><?php echo $row['Stud_ID']; ?></td>
										<td><?php echo $row['Stud_Name']; ?></td>
										<td><?php echo $row['Stud_Batch']; ?></td>
										<td><?php echo $row['Stud_Year']; ?></td>
									</tr>
									<?php
										}
									?>
								</table>
								<div class="text-center mt-2">
									<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">Download</button>
								</div>
								<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg modal-dialog-centered ">
										<div class="modal-content">
											<div class="modal-header bg-dark text-white">
												<h1 class="modal-title fs-5" id="exampleModalLabel">Download Data</h1>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">										
												<form method="POST">
													<div class="row">
														<?php
															echo "<input type='hidden' name='D_ID' value='$D_ID'>";
															$query = "SHOW COLUMNS FROM student";
															$run = mysqli_query($con, $query);
															if ($run){
																while($row=mysqli_fetch_assoc($run)) {
																	$column_name = $row['Field'];
																	echo "
																	<div class='col-md-4 mt-2'>
																		<div class='form-group'>
																			<div class='form-check form-check-inline'>
																				<input class='form-check-input' type='checkbox'  name='columns[]' value='$column_name'>$column_name
																			</div>
																		</div>
																	</div>";
																}
															}
														?>											
													</div>
													<div class="modal-footer mt-3">
														<input type="submit" class="btn btn-primary" name="download" value="Download">
														<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>	
							</section>
				<?php			
						}
						else{
                            echo '<div class="alert alert-danger text-center mt-3" role="alert">No Data Found!</div>';
                        }
					}
					if(isset($_REQUEST['View'])){
						$D_ID=$_POST['D_ID'];
						$query="SELECT 
									d.*, 
									COUNT(DISTINCT s.Stud_ID) AS Stud_Count,
									COUNT(DISTINCT a.App_ID) AS App_Count
								FROM 
									drive d
									LEFT JOIN student s 
										ON FIND_IN_SET(s.Stud_Course, d.Course) > 0 
										AND FIND_IN_SET(s.Stud_Batch, d.Branch) > 0 
										AND d.Year = s.Stud_Year 
										AND d.Marks_10th <= s.Marks_10th 
										AND d.Marks_12th <= s.Marks_12th 
										AND (s.Marks_UG <= 0 OR d.Marks_UG <= s.Marks_UG) 
										AND d.CGPA <= s.CGPA 
										AND d.Backlogs <= s.Stud_Backlogs 
										AND d.D_Package <= s.Stud_Package
									LEFT JOIN application a 
										ON a.D_ID = d.D_ID
									WHERE 
										d.D_ID = '$D_ID'
									GROUP BY 
										d.D_ID;";	
						$run=mysqli_query($con,$query);
                        if(mysqli_num_rows($run)>0){
				?>
							<section class="mt-3">
								<table class="w-100 table table-bordered table-hover border-dark text-center" cellpadding="10">
									<tr class="table-dark text-white">
										<th class="w-25">Drive ID</th>
										<th class="w-25">Name</th>
										<th class="w-25">Eligible Students</th>
										<th class="w-25">Applied Students</th>
									</tr>
									<?php
										while($row=mysqli_fetch_array($run)) {
									?>
									<tr>
										<td><?php echo $row['D_ID']; ?></td>
										<td><?php echo $row['D_Name']; ?></td>
										<td><?php echo $row['Stud_Count']; ?></td>
										<td><?php echo $row['App_Count']; ?></td>
									</tr>
									<?php
										}
									?>
								</table>				
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
