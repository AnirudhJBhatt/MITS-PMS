<!---------------- Session starts form here ----------------------->
<?php  
	session_start();
	if (!$_SESSION["LoginAdmin"])
	{
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}
		require_once "../connection/connection.php";
		$_SESSION["LoginStudent"]="";
	?>
<!---------------- Session Ends form here ------------------------>

<!doctype html>
<html lang="en">

<head>
	<title>Admin - View Details</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>
	<?php include('../common/common-header.php') ?>
	<?php include('../common/admin-sidebar.php') ?>
	<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 w-100">
		<div class="sub-main">
			<div class="text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
				<div class="d-flex">
					<h4 class="mr-5">View Details</h4>
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
								<select class="form-control" name="Stud_Course">
									<option>Select Batch</option>
									<option value="CS">CS</option>
									<option value="CS-AI">CS-AI</option>
									<option value="AI&DS">AI&DS</option>
									<option value="CS-CY">CS-CY</option>
									<option value="ME">ME</option>
									<option value="CE">CE</option>
									<option value="EEE">EEE</option>
									<option value="ECE">ECE</option>	
									<option value="MCA">MCA</option>													
								</select>
								<input type="submit" class="btn btn-primary px-4 ml-4" name="deptsearch" value="Search">
							</div>
						</div>
						<div class="col-">			
							<h5>OR</h5>
						</div>
						<div class="col-5">
							<div class="input-group">
								<input type="text" name="Stud_ID" class="form-control" placeholder="Enter Roll no">
								<input type="submit" class="btn btn-primary px-4 ml-4" name="idsearch" value="Search">
							</div>
						</div>
					</div>
					<input type="hidden" name="form" value="1">
				</form>				
			</section>
			<section class="mt-3">
				<label>
					<h5>Company Search</h5>
				</label>
				<form action="" method="post">
					<div class="row">
						<div class="col-5">
							<div class="input-group">
								<input type="text" name="C_ID" class="form-control" placeholder="Enter Company ID">
								<input type="submit" class="btn btn-primary px-4 ml-4" name="idsearch" value="Search">
							</div>
						</div>						
					</div>
					<input type="hidden" name="form" value="2">
				</form>				
			</section>
			<?php 
				if(isset($_REQUEST['form'])){
					if($_REQUEST['form']=="1"){
						include('search-student.php');
					}	
					if($_REQUEST['form']=="2"){
						include('search-company.php');
					}						
				}
			?>
		</div>
	</main>
	<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>