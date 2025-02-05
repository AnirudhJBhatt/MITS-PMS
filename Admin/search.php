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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Search User</title> 
</head>
    <body>
        <?php include('../Common/header.php'); ?>
        <?php include('../Common/admin-sidebar.php'); ?>        
        <main role="main" class="mt-1 mb-3 px-md-4 page-content-index">
            <div class="sub-main">
                <div class="dashboard-header flex-wrap flex-md-no-wrap px-3 pt-2 pb-1 mb-3 text-white">
                    <div class="d-flex flex-row">
                        <div class="p-2"><h4>Search User</h4></div>
                    </div>
                </div>
				<section class="mt-3">
					<label>
						<h5>Student Search</h5>
					</label>
					<form action="" method="post">
						<div class="row">
							<div class="col-5">
								<div class="input-group">
									<select class="form-select" name="Stud_Course">
										<option>Select Batch</option>
										<?php
											$courses = ["CS", "CS-AI", "AI&DS", "CS-CY", "ME", "CE", "EEE", "ECE", "MCA"];
											foreach ($courses as $course) {
												$selected = (isset($_POST['Stud_Course']) && $_POST['Stud_Course'] == $course) ? 'selected' : '';
												echo "<option value='$course' $selected>$course</option>";
											}
										?>
									</select>
									<input type="submit" class="btn btn-primary px-4 ml-4" name="deptsearch" value="Search">
								</div>
							</div>
							<div class="col-1 text-center p-2">			
								<h5>OR</h5>
							</div>
							<div class="col-5">
								<div class="input-group">
									<input type="text" name="Stud_ID" class="form-control" placeholder="Enter Roll no"
										value="<?php echo isset($_POST['Stud_ID']) ? htmlspecialchars($_POST['Stud_ID']) : ''; ?>">
									<input type="submit" class="btn btn-primary px-4 ml-4" name="idsearch" value="Search">
								</div>
							</div>
						</div>
						<input type="hidden" name="form" value="1">
					</form>
				</section>
				<?php 
					if(isset($_REQUEST['form'])){
						if($_REQUEST['form']=="1"){
							
							if(isset($_POST['idsearch'])||isset($_POST['deptsearch'])){
								if(isset($_POST['idsearch'])){
									$Stud_ID=$_POST['Stud_ID'];
									$query ="SELECT * FROM student WHERE Stud_ID='$Stud_ID'";
								}
								elseif(isset($_POST['deptsearch'])){							
									$Stud_Course=$_POST['Stud_Course'];
									$query ="SELECT * FROM student WHERE Stud_Course='$Stud_Course'";
								}
								$run=mysqli_query($con,$query);	
								if(mysqli_num_rows($run)>0){
							?>
								<section class="mt-3">
									<table class="w-100 table table-bordered table-hover border-dark mb-5 text-center" cellpadding="10">
										<tr class="table-dark text-white">
											<th>Student ID</th>
											<th>Name</th>
											<th>Batch</th>
											<th colspan="1">Operations</th>
										</tr>
										<?php									
											while($row=mysqli_fetch_array($run)){		
										?>
										<tr>
											<td><?php echo $row["Stud_ID"] ?></td>
											<td><?php echo $row["Stud_Name"] ?></td>
											<td><?php echo $row["Stud_Course"] ?></td>						
											<td width='300'>
											<?php 
												echo "<a class='btn btn-info' href=display-student.php?Stud_ID=".$row['Stud_ID']." target='_blank'>Profile</a> ";
												echo '<a class="btn btn-danger" href=delete.php?Stud_ID='.$row['Stud_ID'].' onClick="return confirm(\'Do you want to delete ?\')">Delete</a>';
											?>
											</td>
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
