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
    <title>Student - Applications</title> 
</head>
    <body>
        <?php include('../Common/header.php'); ?>
        <?php include('../Common/student-sidebar.php'); ?>
        
        <main role="main" class="mt-1 mb-3 px-md-4 page-content-index">
            <div class="sub-main">
				<div class="dashboard-header flex-wrap flex-md-no-wrap px-3 pt-2 pb-1 mb-3 text-white">
					<div class="d-flex flex-row">
						<div class="p-2"><h4>Application History</h4></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 container-fluid">
						<section class="mt-3">
							<table class="w-100 table table-bordered border-dark table-hover text-center" cellpadding="10">
								<tr class="table-dark text-white">
									<th>Application ID</th>
									<th>Drive ID</th>
									<th>Drive Name</th>
									<th>Company Name</th>
								</tr>
								<?php
									$query="SELECT * FROM application a, student s, company c, drive d WHERE a.S_ID=s.Stud_ID AND a.D_ID=D.D_ID AND c.C_ID=d.C_ID AND a.S_ID='$Stud_ID'";
									$run=mysqli_query($con,$query);
									while($row=mysqli_fetch_array($run)) {
										echo "<tr>";
										echo "<td>".$row["App_ID"]."</td>";
										echo "<td>".$row["D_ID"]."</td>";
										echo "<td>".$row["D_Name"]."</td>";
										echo "<td>".$row["C_Name"]."</td>";
										echo "</tr>";
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
