 <!---------------- Session starts form here ----------------------->
 <?php  
	session_start();
	if (!$_SESSION["LoginStudent"]){
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}
	require_once "../connection/connection.php";
	$Stud_ID=$_SESSION['LoginStudent'];
?>
<!---------------- Session Ends form here ------------------------>

<?php 
	if (isset($_POST['submit'])) {
		$Stud_ID=$_SESSION['LoginStudent'];
		if(strcmp($_POST['new_pass'],$_POST['conf_pass'])){
			echo "<script>alert('Passwords does not match')</script>";
		}
		else{
			$password=$_POST['new_pass'];
			$query="UPDATE login set Password='$password' where user_id='$Stud_ID'";
			$run=mysqli_query($con,$query);
			if($run){
				echo "<script>alert('Password Succesfully changed')</script>";
			}
		}		
	}	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student - Manage Account</title> 
</head>
    <body>
        <?php include('../Common/header.php'); ?>
        <?php include('../Common/student-sidebar.php'); ?>
        
        <main role="main" class="mt-1 mb-3 px-md-4 page-content-index">
			<div class="dashboard-header flex-wrap flex-md-no-wrap px-3 pt-2 pb-1 mb-3 text-white">
				<div class="d-flex flex-row">
					<div class="p-2"><h4>User Registration</h4></div>
				</div>
			</div>
			<div class="sub-main">
				<div class="row">
					<div class="col-md-12">
						<form action="" method="post">
							<div class="row">
								<div class="col">										
									<input type="password" name="new_pass" class="form-control" required placeholder="Enter New Password" id="new_pass">										
								</div>
								<div class="col">										
										<input type="password" name="conf_pass" class="form-control" required placeholder="Confirm New Password" id="conf_pass">																					
								</div>									
								<div class="col">										
									<input type="submit" name="submit" value="Update Password" class="btn btn-primary px-3">																				
								</div>									
							</div>
							<div class="row mt-3">
								<div class="col">
									<div class="form-check">
										<input type="checkbox" class="form-check-input" onclick="myFunction()" id="check">Show Password
									</div>										
								</div>
							</div>
						</form>
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
            function myFunction() {        
				var checkBox = document.getElementById("check");
				var x = document.getElementById("new_pass");
				var y = document.getElementById("conf_pass");
				if (checkBox.checked == true) {
					x.type = "text";
					y.type = "text";
				} else {
					x.type = "password";            
					y.type = "password";
				}
			}
        </script>
    </body>
</html>
