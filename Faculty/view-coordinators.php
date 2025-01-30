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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty - View Coordinators</title> 
</head>
    <body>
        <?php include('../Common/header.php'); ?>
        <?php include('../Common/faculty-sidebar.php'); ?>
        
        <main role="main" class="mt-1 mb-3 px-md-4 page-content-index">
			<div class="sub-main">
				<div class="dashboard-header flex-wrap flex-md-no-wrap px-3 pt-2 pb-1 mb-3 text-white">
					<div class="d-flex flex-row">
						<div class="p-2"><h4>View Faculty Coordinators</h4></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 container-fluid">
						<section class="mt-3">	
							<table class="w-100 table table-bordered border-dark table-hover text-center" cellpadding="5">
								<tr class="table-dark text-white">
									<th class="w-20">SL. No</th>
									<th class="w-20">Faculty ID</th>
									<th class="w-20">Name</th>
									<th class="w-20">Department</th>
									<th class="w-20">Phone</th>
									<th class="w-20">Email</th>
								</tr>
								<?php 
									$query = "SELECT * FROM `faculty`"; 
									$run=mysqli_query($con,$query);
									$i=1;
									while($row=mysqli_fetch_array($run)) {
										echo "<tr>";
											echo "<td>".$i++."</td>";
											echo "<td>".$row["Fac_ID"]."</td>";
											echo "<td>".$row["Fac_Name"]."</td>";
											echo "<td>".$row["Fac_Dept"]."</td>";
											echo "<td>".$row["Fac_Mob"]."</td>";
											echo "<td>".$row["Fac_Email"]."</td>";
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
