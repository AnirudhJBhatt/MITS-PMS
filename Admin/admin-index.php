 <!---------------- Session starts form here ----------------------->
	<?php  
	session_start();
	if (!$_SESSION["LoginAdmin"])
	{
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}
		require_once "../connection/connection.php";
	?>
<!---------------- Session Ends form here ------------------------>
<title>Admin - MITS PMS</title>
	<?php include('../common/common-header.php') ?>
	<?php include('../common/admin-sidebar.php') ?>  
		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 mb-2 w-100 page-content-index">
			<div class="flex-wrap flex-md-no-wrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
				<h4>Admin Dashboard</h4>
			</div>
			<img src="../images/Mits Logo.png" class="img-fluid mx-auto d-block"  height="500" width="500">
		</main>	
		<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>