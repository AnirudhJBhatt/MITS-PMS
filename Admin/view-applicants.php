<!---------------- Session starts form here ----------------------->
<?php  
	session_start();
	if (!$_SESSION["LoginAdmin"])
	{
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}
		require_once "../connection/connection.php";
	?>
<!---------------- Session Ends form here ------------------------>
<?php
    if (isset($_POST['download'])) {
        if (!empty($_POST['columns'])) {
			$D_ID=$_POST['D_ID'];
            $columns = array_map('mysqli_real_escape_string', array_fill(0, count($_POST['columns']), $con), $_POST['columns']);
            $selected_columns = implode(", ", $columns);
            $query = "SELECT $selected_columns FROM student s, application a WHERE s.Stud_ID=a.S_ID and a.D_ID='$D_ID'";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result)>0) {
                if (isset($_POST['download'])) {
                    ob_clean();
                    ob_start();
                    header('Content-Type: text/csv; charset=utf-8');
                    header('Content-Disposition: attachment; filename=data.csv');
                    $output = fopen('php://output', 'w');
                    fputcsv($output, $_POST['columns']);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $row_data = [];
                        foreach ($_POST['columns'] as $column) {
                            $row_data[] = $row[$column];
                        }
                        fputcsv($output, $row_data);
                    }

                    fclose($output);
                    ob_end_flush();
                    exit();
                }
            }
        } 
    }
?>
<!doctype html>
<html lang="en">
	<head>
		<title>Admin - Drive Applicants</title>
	</head>
	<body>
		<?php include('../common/common-header.php') ?>
		<?php include('../common/admin-sidebar.php') ?>  
		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 mb-2 w-100">
			<div class="sub-main">
				<div class="bar-margin text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<h4>View Applicants</h4>
				</div>
				<section class="mt-3">					
					<label>
						<h5>Select Drive</h5>
					</label>
					<form method="post">
						<div class="row">
							<div class="col-6">
								<div class="input-group">
									<select class="form-control" name="D_ID">
										<option>Select Job Title</option>
										<?php
											$query="SELECT * from drive";
											$run=mysqli_query($con,$query);
											while($row=mysqli_fetch_array($run)) {
												echo"<option value=".$row['D_ID'].">".$row['D_Name']."</option>";
											}
										?>
									</select>
									<input type="submit" class="btn btn-primary px-4 ml-4" name="Search" value="Search">
									<input type="submit" class="btn btn-success px-4 ml-4" name="View" value="View">
								</div>
							</div>
						</div>
					</form>				
				</section>
				<?php 
					if(isset($_REQUEST['Search'])){
						$D_ID=$_POST['D_ID'];
				?>
						<section class="mt-3">
							<table class="w-100 table-elements table-three-tr text-center" cellpadding="10">
								<tr class="table-tr-head table-three text-white">
									<th>Student ID</th>
									<th>Name</th>
									<th>Branch</th>
									<th>Year</th>
								</tr>
								<?php
									$query="SELECT * FROM application a, Student s where a.S_ID=s.Stud_ID and a.D_ID='$D_ID'";
									$run=mysqli_query($con,$query);
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
								<button type="button" class="btn btn-success" data-toggle="modal"data-target=".bd-example-modal-lg">Download</button>
							</div>
							<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header bg-info text-white">
											<h4 class="modal-title text-center">Add New Student</h4>
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
																<div class='col-md-4'>
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
												<div class="modal-footer">
													<input type="submit" class="btn btn-primary" name="download" value="Download">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>				
						</section>
				<?php				
					}
					if(isset($_REQUEST['View'])){
						$D_ID=$_POST['D_ID'];
				?>
						<section class="mt-3">
							<table class="w-100 table-elements table-three-tr text-center" cellpadding="10">
								<tr class="table-tr-head table-three text-white">
									<th class="w-25">Drive ID</th>
									<th class="w-25">Name</th>
									<th class="w-25">Eligible Students</th>
									<th class="w-25"	>Applied Students</th>
								</tr>
								<?php
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
				?>
			</div>
		</main>
		<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>