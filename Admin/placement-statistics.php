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
	<title>Admin - Placement Statistics</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<style>
        table th, table td {
            text-align: center;
        }
        table th, table td {
            width: 33.33%; /* Ensures equal width */
        }
    </style>
</head>

<body>
	<?php include('../common/common-header.php') ?>
	<?php include('../common/admin-sidebar.php') ?>
	<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 w-100">
		<div class="sub-main">
			<div class="text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
				<div class="d-flex">
					<h4 class="mr-5">View Placement Statistics</h4>
				</div>
			</div>
			<section class="mt-3">
				<label>
					<h5>Application Search</h5>
				</label>
				<form action="" method="post">
					<div class="row">
						<div class="col-5">
							<div class="input-group">
								<select class="form-control" name="Stud_Batch">
									<option>Select Batch</option>
									<?php
										for($i=2020;$i<=2030;$i++) {
											echo"<option value=".$i.">".$i."</option>";
										}
									?>
								</select>
								<input type="submit" class="btn btn-primary px-4 ml-4" name="search" value="Search">
							</div>
						</div>
					</div>
				</form>				
			</section>
			<?php 
				if(isset($_REQUEST['search'])){
					$Stud_Batch=$_POST['Stud_Batch'];
					$query ="SELECT c.C_Name, COUNT(p.Stud_ID) AS C_Count, p.P_LPA FROM placement p, company c, student s where p.C_ID=c.C_ID and s.Stud_ID=p.Stud_ID and s.Stud_Year=$Stud_Batch GROUP BY c.C_Name";	
					$run=mysqli_query($con,$query);
					if(mysqli_num_rows($run)>0){
			?>
						<section class="mt-3">
							<table class="w-100 table-elements mb-5 table-three-tr text-center" cellpadding="10">
								<tr class="table-tr-head table-three text-white">
									<th colspan=3>Recruiter Wise Analysis of <?php echo $Stud_Batch ?> Batch</th>
								</tr>
								</tr>
								<tr class="table-tr-head">
									<th colspan=3>
										<?php
											$query1 ="SELECT SUM(COUNT(p.Stud_ID)) OVER () AS Total_Count, max(p.P_LPA) as Max_LPA FROM placement p, company c, student s where p.C_ID=c.C_ID and s.Stud_ID=p.Stud_ID and s.Stud_Year=$Stud_Batch";	
											$run1=mysqli_query($con,$query1);	
											$row=mysqli_fetch_array($run1);
											echo "Total offers: ".$row['Total_Count']." Highest Package: ".$row['Max_LPA']." LPA";
										?>
										
									</th>
								</tr>
								<tr class="table-tr-head table-three text-white">
									<th>Company</th>
									<th>Offers</th>
									<th>CTC</th>
								</tr>
								<?php							
									while($row=mysqli_fetch_array($run)){	
										echo "<tr>";
										echo "<td>".$row['C_Name']."</td>";
										echo "<td>".$row['C_Count']."</td>";
										echo "<td>".$row['P_LPA']."</td>";
										echo "</tr>";
									}
								?>
							</table>
						</section>
			<?php	
					}
					else{
						echo '<div class="alert alert-danger mt-3" role="alert">No Data Found!</div>';
					}			
				}
			?>
		</div>
	</main>
	<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>