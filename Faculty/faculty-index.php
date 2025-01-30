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
	
    $imageData = $row['Fac_Image'];
    $base64Image = base64_encode($imageData);
    $imageSrc = 'data:image/jpeg;base64,' . $base64Image;
?>
<!---------------- Session Ends form here ------------------------>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty - Dashboard</title>
	<style>
        table th, table td {
            width: 50%; /* Ensures equal width */
        }
    </style>
</head>
    <body>
        <?php include('../Common/header.php'); ?>
        <?php include('../Common/faculty-sidebar.php'); ?>
        
        <main role="main" class="mt-1 mb-3 px-md-4 page-content-index">
			<div class="dashboard-header flex-wrap flex-md-no-wrap px-3 pt-2 pb-1 mb-3 text-white">
                <div class="d-flex flex-row">
                    <div class="p-2"><h4 class="">Welcome <?php echo $row['Fac_Name']; ?></h4></div>
                </div>
            </div>
            <div class="container mt-5 mb-5 border border-dark rounded"> 
				<div class='header text-center mt-3'>
					<h3 class='text-dark'>Faculty Info</h3>
				</div>      
				<div class="row mt-3">
					<div class="col align-self-center text-center">
						<figure class="figure">
							<img src="<?php echo $imageSrc; ?>" class="figure-img img-fluid border" height="250px" width="250px">
						</figure> 
					</div>
					<div class="col">
						<table class="table table-bordered border-dark table-hover">
							<tr class="table-dark text-center">
								<th colspan="2">Personal Information</th>
							</tr>
							<tr>
								<th>Faculty ID</th>
								<td><?php echo $row['Fac_ID']; ?></td>
							</tr>                    
							<tr>
								<th>Name</th>
								<td><?php echo $row['Fac_Name']; ?></td>
							</tr>
							<tr>
								<th>Date of Birth</th>
								<td><?php echo $row['Fac_DOB']; ?></td>
							</tr>
							<tr>
								<th>Department</th>
								<td><?php echo $row['Fac_Dept']; ?></td>
							</tr>
							<tr>
								<th>Designation</th>
								<td><?php echo $row['Fac_Desg']; ?></td>
							</tr>
						</table>
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
