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
	$message = "";
if (isset($_POST['submit'])) {
	$account = $_POST['account'];
	$user_id = $_POST['user_id'];
	$query="update login set account='$account' where user_id = '$user_id'";
	$run=mysqli_query($con,$query);
	if ($run) {
		if($account=="Activate"){
			$message='<div class="alert alert-success text-center mt-3" role="alert">Account Activated Successfully!!!</div>';
		}
		else{
			$message='<div class="alert alert-danger text-center mt-3" role="alert">Account Deactivated Successfully!!!</div>';
		}
	}	
	else{
		$message='<div class="alert alert-success text-center mt-3" role="alert">Account not found!!!</div>';
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Accounts</title> 
</head>
    <body>
        <?php include('../Common/header.php'); ?>
        <?php include('../Common/admin-sidebar.php'); ?>
        
        <main role="main" class="mt-1 mb-3 px-md-4 page-content-index">
            <div class="sub-main">
                <div class="dashboard-header flex-wrap flex-md-no-wrap px-3 pt-2 pb-1 mb-3 text-white">
                    <div class="d-flex flex-row">
                        <div class="p-2"><h4>Manage Accounts</h4></div>
                    </div>
                </div>
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<form class="row row-cols-lg-auto g-3 align-items-center" action="" method="post">
									<div class="col-12">
										<input type="text" name="user_id" class="form-control" required placeholder="Enter User ID"
											value="<?php echo isset($_POST['user_id']) ? htmlspecialchars($_POST['user_id']) : ''; ?>">
									</div>
									<div class="col-12">
										<select name="account" class="form-select">
											<option>Select Account Status</option>
											<?php
											$statuses = ["Activate", "Deactivate"];
											foreach ($statuses as $status) {
												$selected = (isset($_POST['account']) && $_POST['account'] == $status) ? 'selected' : '';
												echo "<option value='$status' $selected>$status</option>";
											}
											?>
										</select>
									</div>
									<div class="col-12">
										<input type="submit" class="btn btn-primary px-4 ml-4" name="submit" value="Change">
									</div>
								</form>
							</div>
							<div class="col-md-12">
								<?php echo $message ?>
							</div>
						</div>
					</div>
				</div>
			</div>
        </main>

        <?php include('../Common/footer.php'); ?>

        <script>
            (() => {
                'use strict';
                const tooltipTriggerList = Array.from(document.queryrySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.forEach(tooltipTriggerEl => {
                    new bootstrap.Tooltip(tooltipTriggerEl);
                });
            })();
        </script>
    </body>
</html>
