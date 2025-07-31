 <!---------------- Session starts form here ----------------------->
 <?php  
	session_start();

	if (!$_SESSION["LoginFaculty"]){
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}

	require_once "../connection/connection.php";

    $Fac_ID=$_SESSION['LoginFaculty'];
	$query = "SELECT * FROM `faculty` WHERE `Fac_ID` = '$Fac_ID' ";
    $run = mysqli_query($con, $query);
    $row = mysqli_fetch_array($run);
	$Fac_Dept=$row['Fac_Dept'];

?>
<!---------------- Session Ends form here ------------------------>

<?php
    if (isset($_POST['download'])) {
        ob_clean();
        ob_start();
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.csv');

        $output = fopen('php://output', 'w');
        
        $Stud_Batch = $_POST['Stud_Batch'];
        $Stud_Course = $_POST['Stud_Course'];
        $query = "SELECT c.C_Name, COUNT(p.Stud_ID) AS C_Count, p.P_LPA 
                  FROM placement p, company c, student s 
                  WHERE p.C_ID=c.C_ID AND s.Stud_ID=p.Stud_ID 
                  AND s.Stud_Course='$Stud_Course' 
                  AND s.Stud_Batch='$Fac_Dept' 
                  AND s.Stud_Year=$Stud_Batch 
                  GROUP BY c.C_Name";    
        $run = mysqli_query($con, $query);
        
        if (mysqli_num_rows($run) > 0) {
            $fields = mysqli_fetch_fields($run);
            $columns = ['Sl.No']; // Add "Sl.No" to the header
            foreach ($fields as $field) {
                $columns[] = $field->name;
            }
            fputcsv($output, $columns); // Write the header row
        }

        $sl_no = 1; // Initialize serial number
        while ($row = mysqli_fetch_assoc($run)) {
            $row_data = [$sl_no]; // Start with the serial number
            foreach ($row as $column_value) {
                $row_data[] = $column_value;
            }
            fputcsv($output, $row_data); // Write the data row
            $sl_no++; // Increment serial number
        }

        fclose($output);
        ob_end_flush();
        exit(); 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty - Placement Statistics</title>
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
        <?php include('../Common/header.php'); ?>
        <?php include('../Common/faculty-sidebar.php'); ?>
        
        <main role="main" class="mt-1 mb-3 px-md-4 page-content-index">
			<div class="sub-main">
				<div class="dashboard-header flex-wrap flex-md-no-wrap px-3 pt-2 pb-1 mb-3 text-white">
					<div class="d-flex flex-row">
						<div class="p-2"><h4>Placement Statistics</h4></div>
					</div>
				</div>
				<section class="mt-3">
					<form class="row row-cols-lg-auto g-3 align-items-center" action="" method="post">
						<div class="col-12">
							<select class="form-select" name="Stud_Batch">
								<option>Select Batch</option>
								<?php
								for ($i = 2020; $i <= 2030; $i++) {
									$selected = (isset($_POST['Stud_Batch']) && $_POST['Stud_Batch'] == $i) ? 'selected' : '';
									echo "<option value='$i' $selected>$i</option>";
								}
								?>
							</select>
						</div>
						<div class="col-12">
							<select class="form-select" name="Stud_Course">
								<option>Select Course</option>
								<?php
								$courses = ["B.Tech", "M.Tech", "MCA"];
								foreach ($courses as $course) {
									$selected = (isset($_POST['Stud_Course']) && $_POST['Stud_Course'] == $course) ? 'selected' : '';
									echo "<option value='$course' $selected>$course</option>";
								}
								?>
							</select>
						</div>
						<div class="col-12">
							<div class="input-group">
								<input type="submit" class="btn btn-success px-4 ml-4" name="Search" value="View">
							</div>
						</div>
					</form>			
				</section>
				<?php 
					if(isset($_REQUEST['Search'])){
						$Stud_Batch=$_POST['Stud_Batch'];
						$Stud_Course=$_POST['Stud_Course'];
						$query ="SELECT c.C_Name, COUNT(p.Stud_ID) AS C_Count, p.P_LPA FROM placement p, company c, student s WHERE p.C_ID=c.C_ID AND s.Stud_ID=p.Stud_ID AND s.Stud_Course='$Stud_Course' AND s.Stud_Batch='$Fac_Dept' AND s.Stud_Year=$Stud_Batch GROUP BY c.C_Name";	
						$run=mysqli_query($con,$query);
						if(mysqli_num_rows($run)>0){
				?>
							<section class="mt-3">
								<table class="w-100 table table-bordered table-hover border-dark mb-5 text-center" cellpadding="10">
									<tr class="table-dark text-white">
										<th colspan=3>Recruiter Wise Analysis of <?php echo $Stud_Batch ?> Batch</th>
									</tr>
									</tr>
									<tr>
										<th colspan=3>
											<?php
												$query1 ="SELECT SUM(COUNT(p.Stud_ID)) OVER () AS Total_Count, max(p.P_LPA) as Max_LPA FROM placement p, company c, student s WHERE p.C_ID=c.C_ID AND s.Stud_ID=p.Stud_ID AND s.Stud_Course='$Stud_Course' AND s.Stud_Batch='$Fac_Dept' AND s.Stud_Year=$Stud_Batch";
												$run1=mysqli_query($con,$query1);	
												$row=mysqli_fetch_array($run1);
												echo "Total offers: ".$row['Total_Count']." Highest Package: ".$row['Max_LPA']." LPA";
											?>
											
										</th>
									</tr>
									<tr class="table-dark">
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
								<div class="text-center">
									<form method="POST">
										<input type="hidden" name="Stud_Batch" value=<?php echo $Stud_Batch ?>>
										<input type="hidden" name="Stud_Course" value=<?php echo $Stud_Course ?>>
										<input type="submit" name="download" value="Download" class="btn btn-success">				
									</form>									
								</div>			
							</section>
				<?php	
						}
						else{
							echo '<div class="alert alert-danger text-center mt-3" role="alert">No Data Found!</div>';
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
