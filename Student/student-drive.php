 <!---------------- Session starts form here ----------------------->
 <?php  
	session_start();
	if (!$_SESSION["LoginStudent"]){
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}
	require_once "../connection/connection.php";
	$Stud_ID=$_SESSION['LoginStudent'];
	$applied_jobs = array();
	$query = "SELECT D_ID FROM application WHERE S_ID = '$Stud_ID'";
	$run = mysqli_query($con, $query);
	while ($row = mysqli_fetch_assoc($run)) {
		$applied_jobs[] = $row['D_ID'];
	}
?>
<!---------------- Session Ends form here ------------------------>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student - Campus Drive</title> 
</head>
    <body>
        <?php include('../Common/header.php'); ?>
        <?php include('../Common/student-sidebar.php'); ?>
        
        <main role="main" class="mt-1 mb-3 px-md-4 page-content-index">
            <div class="sub-main">
				<div class="dashboard-header flex-wrap flex-md-no-wrap px-3 pt-2 pb-1 mb-3 text-white">
					<div class="d-flex flex-row">
						<div class="p-2"><h4>Campus Drives</h4></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 container-fluid">
						<section class="mt-3">
							<table class="w-100 table table-bordered border-dark table-hover text-center" cellpadding="5">
								<tr class="table-dark text-white">
									<th>Drive ID</th>
									<th>Name</th>
									<th>10th Marks</th>
									<th>12th Marks</th>
									<th>UG Marks</th>
									<th>Current CGPA</th>
									<th>Last Date</th>
									<th>Action</th>
								</tr>
								<?php
									$query="SELECT d.D_ID, d.D_Name, d.Marks_10th, d.Marks_12th, d.Marks_UG, d.CGPA, d.D_Date 
        							FROM drive d, student s WHERE FIND_IN_SET(s.Stud_Course, d.Course) > 0 
									AND FIND_IN_SET(s.Stud_Batch, d.Branch) > 0 
									AND d.Year = s.Stud_Year 
									AND d.Marks_10th <= s.Marks_10th 
									AND d.Marks_12th <= s.Marks_12th 
									AND (s.Marks_UG <= 0 OR d.Marks_UG <= s.Marks_UG) 
									AND d.CGPA <= s.CGPA AND d.Backlogs <= s.Stud_Backlogs 
									AND d.D_Package <= s.Stud_Package 
									AND s.Stud_ID='$Stud_ID'";
									$run=mysqli_query($con,$query);
									while($row=mysqli_fetch_array($run)) {
										$D_ID=$row['D_ID'];
								?>
								<tr>
									<td><?php echo $row['D_ID']; ?></td>
									<td><?php echo $row['D_Name']; ?></td>
									<td><?php echo $row['Marks_10th']; ?></td>
									<td><?php echo $row['Marks_12th']; ?></td>
									<td><?php echo $row['Marks_UG']; ?></td>
									<td><?php echo $row['CGPA']; ?></td>
									<td><?php echo $row['D_Date']; ?></td>
									<td width='200'>
										<?php if (in_array($D_ID, $applied_jobs)) { ?>
											<button class="btn btn-secondary" disabled>Applied</button>
										<?php 
										} else { ?>
											<a class="btn btn-success" href="apply.php?D_ID=<?php echo $row['D_ID']; ?>">Apply</a>
										<?php	
										} ?>
									</td>
								</tr>
								<?php
									}
								?>
							</table>				
						</section>
					</div>
				</div>
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
