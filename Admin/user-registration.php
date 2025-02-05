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
 	if (isset($_POST['add-student'])) {

		$Stud_ID =$_POST['Stud_ID'];

		$Stud_Name =$_POST['Stud_Name'];

		$Stud_DOB =$_POST['Stud_DOB'];

		$Stud_Course =$_POST['Stud_Course'];

		$Stud_Batch =$_POST['Stud_Batch'];

		$Stud_Year =$_POST['Stud_Year'];

		$query1= "INSERT INTO student (`Stud_ID`, `Stud_Name`, `Stud_DOB`, `Stud_Course`, `Stud_Batch`, `Stud_Year`) VALUES ('$Stud_ID', '$Stud_Name', '$Stud_DOB', '$Stud_Course', '$Stud_Batch', '$Stud_Year')";
		
		$query2="INSERT INTO `login`(`user_id`, `Password`, `Role`, `account`) VALUES ('$Stud_ID','Student123*','Student','Activate')";

		$run1=mysqli_query($con, $query1);

		$run2=mysqli_query($con, $query2);
 		
		if ($run1 && $run2) {
			echo "<script>alert('Success'); window.location='student.php';</script>";
 		}
 		else {
			echo "<script>alert('Failed'); window.location = 'student.php';</script>";
 		}
 	}
?>

<?php  
 	if (isset($_POST['add-faculty'])) {

		$Fac_ID =$_POST['Fac_ID'];

		$Fac_Name =$_POST['Fac_Name'];

		$Fac_DOB =$_POST['Fac_DOB'];

		$Fac_Dept =$_POST['Fac_Dept'];

		$query1= "INSERT INTO faculty (`Fac_ID`, `Fac_Name`, `Fac_DOB`, `Fac_Dept`) VALUES ('$Fac_ID', '$Fac_Name', '$Fac_DOB', '$Fac_Dept')";
		
		$query2="INSERT INTO `login`(`user_id`, `Password`, `Role`, `account`) VALUES ('$Fac_ID','Faculty123*','Faculty','Activate')";

		$run1=mysqli_query($con, $query1);

		$run2=mysqli_query($con, $query2);
 		
		if ($run1 && $run2) {
			echo "<script>alert('Success'); window.location='user-registration.php';</script>";
 		}
 		else {
			echo "<script>alert('Failed'); window.location = 'user-registration.php';</script>";
 		}
 	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User Registration</title> 
</head>
    <body>
        <?php include('../Common/header.php'); ?>
        <?php include('../Common/admin-sidebar.php'); ?>
        
        <main role="main" class="mt-1 mb-3 px-md-4 page-content-index">
            <div class="sub-main">
                <div class="dashboard-header flex-wrap flex-md-no-wrap px-3 pt-2 pb-1 mb-3 text-white">
                    <div class="d-flex flex-row">
                        <div class="p-2"><h4>User Registration</h4></div>
                        <div class="p-2"><button type="button" class="btn btn-primary py-1" data-bs-toggle="modal" data-bs-target="#modal1">Add Student</button></div>
                        <div class="p-2"><button type="button" class="btn btn-primary py-1" data-bs-toggle="modal" data-bs-target="#modal2">Add Faculty</button></div>
                    </div>
                </div>
                <section class="mt-3">
                    <label>
                        <h5>Faculty Search</h5>
                    </label>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-3">
                                <input type="text" name="Fac_Name" class="form-control" placeholder="Enter Faculty Name"
                                    value="<?php echo isset($_POST['Fac_Name']) ? htmlspecialchars($_POST['Fac_Name']) : ''; ?>">
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
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Student</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="studentForm" action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                                            <h5>Student Details</h5>
                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Admission No:*</label>
                                                        <input type="text" name="Stud_ID" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Name:*</label>
                                                        <input type="text" name="Stud_Name" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Date of Birth: </label>
                                                        <input type="date" name="Stud_DOB" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Course:</label>
                                                        <select class="form-select" name="Stud_Course" required id="Stud_Course" onchange="addfield()">
                                                            <option>Select Course</option>
                                                            <option value="B.Tech">B.Tech</option>
                                                            <option value="M.Tech">M.Tech</option>
                                                            <option value="MCA">MCA</option>													
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Branch:</label>
                                                        <select class="form-select" name="Stud_Batch" required>
                                                            <option>Select Branch</option>
                                                            <option value="CS">CS</option>
                                                            <option value="CS-AI">CS-AI</option>
                                                            <option value="AI&DS">AI&DS</option>
                                                            <option value="CS-CY">CS-CY</option>
                                                            <option value="ME">ME</option>
                                                            <option value="CE">CE</option>
                                                            <option value="EEE">EEE</option>
                                                            <option value="ECE">ECE</option>	
                                                            <option value="Computer Applications">Computer Applications</option>													
                                                        </select>
                                                    </div>
                                                </div>							
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Batch:</label>
                                                        <select class="form-select" name="Stud_Year">
                                                            <option>Select Batch</option>
                                                            <?php
                                                                for($i=2020;$i<=2030;$i++) {
                                                                    echo"<option value=".$i.">".$i."</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>										
                                            </div>
                                            <div class="modal-footer mt-3">
                                                <input type="submit" class="btn btn-primary" name="add-student" value="Add Student">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row w-100">
                    <div class=" col-lg-6 col-md-6 col-sm-12 mt-1 ">
                        <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered ">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark text-white">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel1">Add Faculty Coordinator</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="studentForm" action="" method="POST" enctype="multipart/form-data">
                                            <h5>Faculty Details</h5>
                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Faculty ID:</label>
                                                        <input type="text" name="Fac_ID" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Name:*</label>
                                                        <input type="text" name="Fac_Name" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Date of Birth: </label>
                                                        <input type="date" name="Fac_DOB" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Department   :</label>
                                                        <select class="form-select" name="Fac_Dept">
                                                            <option>Select Department</option>
                                                            <option value="CS-AI">CS-AI</option>
                                                            <option value="AI&DS">AI&DS</option>
                                                            <option value="CS">CS</option>
                                                            <option value="CS-CY">CS-CY</option>
                                                            <option value="ME">ME</option>
                                                            <option value="CE">CE</option>
                                                            <option value="ECE">ECE</option>
                                                            <option value="EEE">EEE</option>
                                                            <option value="MCA">MCA</option>													
                                                        </select>
                                                    </div>
                                                </div>										
                                            </div>
                                            <div class="modal-footer mt-3">
                                                <input type="submit" class="btn btn-primary" name="add-faculty" value="Add Faculty">
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
                        $Fac_Name=$_POST['Fac_Name'];
                        $query ="SELECT * FROM faculty WHERE Fac_Name LIKE '%$Fac_Name%'";	
                        $run=mysqli_query($con,$query);
                        if(mysqli_num_rows($run)>0){
                ?>
                            <section class="mt-3">
                                <table class="w-100 table table-bordered table-hover border-dark text-center" cellpadding="10">
                                    <tr class="table-dark">
                                        <th>Company ID</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Address</th>
                                        <th colspan="1">Operations</th>
                                    </tr>
                                    <?php							
                                        while($row=mysqli_fetch_array($run)){
                                    ?>
                                    <tr>
                                        <td><?php echo $row["Fac_ID"] ?></td>
                                        <td><?php echo $row["Fac_Name"] ?></td>
                                        <td><?php echo $row["Fac_Dept"] ?></td>
                                        <td><?php echo $row["Fac_Email"] ?></td>						
                                        <td width='300'>
                                        <?php 
                                            echo "<a class='btn btn-info' href=display-faculty.php?Fac_ID=".$row['Fac_ID'].">Profile</a> ";
                                            echo '  <a class="btn btn-primary" href=update-faculty.php?Fac_ID='.$row['Fac_ID'].'>Update</a>';
                                            echo '	<a class="btn btn-danger" href=delete.php?Fac_ID='.$row['Fac_ID'].' onClick="return confirm(\'Do you want to delete ?\')">Delete</a>';
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
                                            <th>Faculty ID</th>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th colspan="1">Operations</th>
                                        </tr>
                                        <?php 								
                                            $query ="SELECT `Fac_ID`,`Fac_Name`,`Fac_Dept` FROM Faculty;";
                                            $run=mysqli_query($con,$query);
                                            while($row=mysqli_fetch_array($run)) {?>
                                        <tr>		
                                            <td><?php echo $row["Fac_ID"] ?></td>
                                            <td><?php echo $row["Fac_Name"] ?></td>
                                            <td><?php echo $row["Fac_Dept"] ?></td>
                                            <td width='250'>
                                                <?php 
                                                    echo "<a class='btn btn-info' href=display-faculty.php?Fac_ID=".$row['Fac_ID']." target='_blank'>Profile</a>";
                                                    echo '  <a class="btn btn-primary" href=update-faculty.php?Fac_ID='.$row['Fac_ID'].'  target="_blank">Update</a>';
                                                    echo '	<a class="btn btn-danger" href=delete.php?Fac_ID='.$row['Fac_ID'].' onClick="return confirm(\'Do you want to delete ?\')">Delete</a>';
                                                ?>
                                            </td>
                                        </tr>
                                        <?php 
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
			const form = document.getElementById("studentForm");
			const name = form["Stud_Name"].value;
			if (!/^[A-Za-z\s-]+$/.test(name)) {
				alert("Names should only contain alphabets");
				return false;
			}
			if (form["Stud_ID"].value === "") {
				alert("Admission No is required.");
				return false;
			}

			return true;
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
