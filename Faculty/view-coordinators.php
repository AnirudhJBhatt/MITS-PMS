<!---------------- Session starts form here ----------------------->
<?php  

    session_start();
	if (!$_SESSION["LoginFaculty"]){
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}

	require_once "../connection/connection.php";
?>
<!---------------- Session Ends form here ------------------------>

<!doctype html>
<html lang="en">
	<head>
		<title>Admin - Register company</title>
	</head>
	<body>
		<?php include('../common/common-header.php') ?>
		<?php include('../common/faculty-sidebar.php') ?>
		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 mb-2 w-100">
			<div class="sub-main">
				<div class="text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<div class="d-flex">
						<h4 class="mr-5">View Faculty Coordinators</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 container-fluid">
						<section class="mt-3">							
							<table class="w-100 table-elements mb-5 table-three-tr" cellpadding="10">
								<tr class="table-tr-head table-three text-white">
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
		<script>
			function validateForm() {
				// Validate company name, sector, and contact person name (alphabets, spaces, and hyphens only)
				const nameFields = ["C_Name", "C_Type", "C_Person"];
				for (let field of nameFields) {
					let name = document.forms["companyForm"][field].value;
					if (!/^[A-Za-z\s-]+$/.test(name)) {
						alert("Please enter a valid name");
						return false;
					}
				}

				// Validate Phone Number (10 digits)
				let phone = document.forms["companyForm"]["C_Phone"].value;
				if (!/^\d{10}$/.test(phone)) {
					alert("Please enter a valid 10-digit phone number.");
					return false;
				}

				// Validate Email
				let email = document.forms["companyForm"]["C_Email"].value;
				let emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
				if (!emailPattern.test(email)) {
					alert("Please enter a valid email address.");
					return false;
				}

				// Validate Website URL
				let website = document.forms["companyForm"]["C_Website"].value;
				if (!/^https?:\/\/.+\..+$/.test(website)) {
					alert("Please enter a valid URL starting with http or https.");
					return false;
				}

				return true; // Allow form submission if all validations pass
			}
		</script>
		<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>


