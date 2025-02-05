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
 	if (isset($_POST['Submit'])) {

		$C_ID=$_POST["C_ID"];

		$C_Name=$_POST["C_Name"];

		$C_Type=$_POST["C_Type"];
		
		$C_YOE=$_POST["C_YOE"];

		$C_Email=$_POST["C_Email"];
 		
 		$C_Phone=$_POST["C_Phone"];
 		
 		$C_Address=$_POST["C_Address"];

 		$C_Person=$_POST["C_Person"];

 		$C_Website=$_POST["C_Website"];


		$query= "INSERT INTO company (`C_ID`, `C_Name`, `C_Type`, `C_YOE`, `C_Address`, `C_Email`, `C_Phone`, `C_Person`, `C_Website`) VALUES ('$C_ID', '$C_Name', '$C_Type', '$C_YOE', '$C_Address', '$C_Email', '$C_Phone', '$C_Person', '$C_Website')";

		$run=mysqli_query($con, $query);
		
		if($run){
			echo "<script>alert('Success'); window.location='company-registration.php';</script>";
 		}
 		else {
			echo "<script>alert('Failed'); window.location='company-registration.php';</script>";
 		}
		
 	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Company Registration</title> 
</head>
    <body>
        <?php include('../Common/header.php'); ?>
        <?php include('../Common/admin-sidebar.php'); ?>
        
        <main role="main" class="mt-1 mb-3 px-md-4 page-content-index">
            <div class="sub-main">
                <div class="dashboard-header flex-wrap flex-md-no-wrap px-3 pt-2 pb-1 mb-3 text-white">
                    <div class="d-flex flex-row">
                        <div class="p-2"><h4>Company Registration</h4></div>
                        <div class="p-2"><button type="button" class="btn btn-primary py-1" data-bs-toggle="modal" data-bs-target="#modal1">Add Company</button></div>
                    </div>
                </div>
                <section class="mt-3">
                    <label>
                            <h5>Company Search</h5>
                    </label>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-3">
                                <input type="text" name="C_Name" class="form-control" placeholder="Enter Faculty Name"
                                    value="<?php echo isset($_POST['C_Name']) ? htmlspecialchars($_POST['C_Name']) : ''; ?>">
                            </div>			
                            <div class="col-5">
                                <input type="submit" class="btn btn-primary px-4 ml-4" name="Search" value="Search">
                            </div>			
                        </div>	
                    </form>				
                </section>
                <div class="row w-100">
                    <div class=" col-lg-6 col-md-6 col-sm-12 mt-1 ">
                        <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered ">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark text-white">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Company</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" enctype="multipart/form-data" id="companyForm"  onsubmit="return validateForm()">
											<h5>Company Information</h5>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Company ID: </label>
														<input type="text" name="C_ID" class="form-control" required>
													</div>
												</div>
												<div class="col-md-4">
												  	<div class="form-group">
														<label for="exampleInputEmail1">Name</label>
														<input type="text" name="C_Name" class="form-control" required>
													</div>
												</div>
												<div class="col-md-4">
												  	<div class="form-group">
														<label for="exampleInputEmail1">Sector</label>
														<input type="text" name="C_Type" class="form-control" required>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Year of Establishment</label>
														<input type="date" name="C_YOE" class="form-control" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Address: </label>
														<input type="text" name="C_Address" class="form-control" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputPassword1">Phone No</label>
														<input type="tel" name="C_Phone" class="form-control" format="[0-9]{10}" required>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputPassword1">Email:</label>
														<input type="text" name="C_Email" class="form-control" required 
														pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"  required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
													<label for="exampleInputPassword1">Contact Person:</label>
													<input type="text" name="C_Person" class="form-control" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
													<label for="exampleInputPassword1">Website:</label>
													<input type="text" name="C_Website" class="form-control" required>
													</div>
												</div>
											</div>
											<div class="modal-footer mt-3">
												<input type="submit" class="btn btn-primary" name="Submit" value="Submit">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
											</div>
										</form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
					if(isset($_POST['Search'])){
						$C_Name=$_POST['C_Name'];
						$query ="SELECT * FROM company WHERE C_Name LIKE '%$C_Name%'";
                        $run=mysqli_query($con,$query);	
						if(mysqli_num_rows($run)>0){			
				?>
							<section class="mt-3">
								<table class="w-100 table table-bordered table-hover border-dark text-center">
									<tr class="table-dark text-white">
										<th>Company ID</th>
										<th>Name</th>
										<th>Type</th>
										<th>Address</th>
										<th colspan="1">Operations</th>
									</tr>
									<?php
										$run=mysqli_query($con,$query);							
										while($row=mysqli_fetch_array($run)){
									?>
									<tr>
										<td><?php echo $row["C_ID"] ?></td>
										<td><?php echo $row["C_Name"] ?></td>
										<td><?php echo $row["C_Type"] ?></td>
										<td><?php echo $row["C_Address"] ?></td>						
										<td width='300'>
										<?php 
											echo "<a class='btn btn-info' href=display-company.php?C_ID=".$row['C_ID']." target='_blank'>Profile</a> ";
											echo '<a class="btn btn-danger" href=delete.php?C_ID='.$row['C_ID'].' onClick="return confirm(\'Do you want to delete ?\')">Delete</a>';
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
                    else{
                ?>
						<div class="row">
							<div class="col-md-12 container-fluid">
								<section class="mt-3">	
                                    <table class="w-100 table table-bordered table-hover border-dark text-center">
                                        <tr class="table-dark text-white">
											<th>Company ID</th>
											<th>Company Name</th>
											<th>Sector</th>
											<th>Contact Person</th>
											<th>Operations</th>
										</tr>
										<?php 
										$query="select * from company";
										$run=mysqli_query($con,$query);
										while($row=mysqli_fetch_array($run)) {
											echo "<tr>";
												echo "<td>".$row["C_ID"]."</td>";
												echo "<td>".$row["C_Name"]."</td>";
												echo "<td>".$row["C_Type"]."</td>";
												echo "<td>".$row["C_Person"]."</td>";
												echo "<td width='250'>";
													echo "<a class='btn btn-info' href=display-company.php?C_ID=".$row['C_ID']." target='_blank'>Profile</a>";
													echo " <a class='btn btn-primary' href=update-company.php?C_ID=".$row['C_ID']." target='_blank'>Update</a>";
													echo ' <a class="btn btn-danger" href=delete.php?C_ID='.$row['C_ID'].' onClick="return confirm(\'Do you want to delete ?\')">Delete</a>';
												echo "</td>";
											echo "</tr>";									
										}
										?>
									</table>				
								</section>
							</div>
						</div>
				<?php		
					}
				?>	 
            </div>
        </main>

        <?php include('../Common/footer.php'); ?>

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
