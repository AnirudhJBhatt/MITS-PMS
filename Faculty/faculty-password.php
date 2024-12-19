 <!---------------- Session starts form here ----------------------->
 <?php  
	session_start();
	if (!$_SESSION["LoginFaculty"])
	{
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}
		require_once "../connection/connection.php";
	?>
<!---------------- Session Ends form here ------------------------>

<?php 
	if (isset($_POST['submit'])) {
		$ID=$_SESSION['LoginFaculty'];
		if(strcmp($_POST['new_pass'],$_POST['conf_pass'])){
			echo "<script>alert('Passwords does not match')</script>";
		}
		else{
			$password=$_POST['new_pass'];
			$query="UPDATE login set Password='$password' where ID='$ID'";
			$run=mysqli_query($con,$query);
			if($run){
				echo "<script>alert('Password Succesfully changed')</script>";
			}
		}		
	}
?>

<!doctype html>
<html lang="en">
	<head>
		<title>Teacher - Password</title>
	</head>
	<body>
		<?php include('../common/common-header.php') ?>
		<?php include('../common/faculty-sidebar.php') ?>  

		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 mb-2 w-100">
			<div class="sub-main">
				<div class="text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<h4 class="">Update Your Password</h4>
				</div>
				<div class="container pt-5">
					<div class="row">
						<div class="col-md-12">
							<form action="teacher-password.php" method="post">
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
			</div>
		</main>
		<script>
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
		<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
