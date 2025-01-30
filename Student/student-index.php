 <!---------------- Session starts form here ----------------------->
 <?php  
	session_start();
	if (!$_SESSION["LoginStudent"]){
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}
	require_once "../connection/connection.php";
	$Stud_ID=$_SESSION['LoginStudent'];
    
    $query = "SELECT * FROM `student` WHERE `Stud_ID` = '$Stud_ID' ";
	$run=mysqli_query($con,$query);
	$row=mysqli_fetch_array($run);

    $imageData = $row['Stud_Image'];
    $base64Image = base64_encode($imageData);
    $imageSrc = 'data:image/jpeg;base64,' . $base64Image;
?>
<!---------------- Session Ends form here ------------------------>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student - Dashboard</title>
    <style>
        table th, table td {
            width: 50%; /* Ensures equal width */
        }
    </style>
</head>
    <body>
        <?php include('../Common/header.php'); ?>
        <?php include('../Common/student-sidebar.php'); ?>
        
        <main role="main" class="mt-1 mb-3 px-md-4 page-content-index">
			<div class="dashboard-header flex-wrap flex-md-no-wrap px-3 pt-2 pb-1 mb-3 text-white">
				<div class="d-flex flex-row">
					<div class="p-2"><h4 class="">Welcome <?php echo $row['Stud_Name'];?></h4></div>
				</div>
			</div>
            <div class="container mt-5 mb-5 border border-dark rounded"> 
				<div class='header text-center mt-3'>
					<h3 class='text-dark'>Student Profile</h3>
				</div>       
				<div class="row mt-3">
					<div class="col align-self-center text-center">
						<figure class="figure">
							<img src="<?php echo $imageSrc; ?>" class="figure-img img-fluid border" height='250px' width='250px'>
						</figure>                      
					</div>
					<div class="col">
						<table class="table table-bordered border-dark table-hover">
							<tr class="table-dark text-center">
								<th colspan="2">Personal Information</th>
							</tr>
							<tr>
								<th>Admission No</th>
								<td><?php echo $row['Stud_ID']; ?></td>
							</tr>
							<tr>
								<th>Name</th>
								<td><?php echo $row['Stud_Name']; ?></td>
							</tr>                    
							<tr>
								<th>Programme</th>
								<td><?php echo $row['Stud_Course']; ?></td>
							</tr>
							<tr>
								<th>Date of Birth</th>
								<td><?php echo $row['Stud_DOB']; ?></td>
							</tr>
							<tr>
								<th>Gender</th>
								<td><?php echo $row['Stud_Gender']; ?></td>
							</tr>
							<tr>
								<th>Phone Number</th>
								<td><?php echo $row['Stud_Mob']; ?></td>
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
