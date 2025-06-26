<!---------------- Session starts form here ----------------------->
<?php  
   session_start();
   if (!$_SESSION["LoginFaculty"]){
       echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
       echo '<script>window.location="../login/login.php"</script>';
   }
   
   require_once "../connection/connection.php";

   $Stud_ID = $_REQUEST['Stud_ID'];
   $query = "SELECT * FROM `student` WHERE `Stud_ID` = '$Stud_ID' ";      
   $run = mysqli_query($con, $query);       
   $row = mysqli_fetch_array($run);
   
   $imageData = $row['Stud_Image'];
   $base64Image = base64_encode($imageData);
   $imageSrc = 'data:image/jpeg;base64,' . $base64Image;
?>
<!---------------- Session Ends form here ------------------------>

<!doctype html>
<html lang="en">
	<head>
		<title>Student - Profile</title>    
	</head>
    <style>
        table th, table td {
            width: 50%; /* Ensures equal width */
        }
    </style>
	<body>
        <?php include('../Common/header.php') ?>
        <div class="container mt-5 mb-5 border border-dark rounded">        
            <div class="row mt-3">
                <div class="col align-self-center text-center">
					<figure class="figure">
						<img src="<?php echo $imageSrc; ?>" class="figure-img img-fluid border" height='250px' width='250px'>
					</figure>                       
                </div>
                <div class="col">
                    <table class="table table-bordered table-hover border-dark border-info" align="center">
                        <tr class="table-dark text-center">
                            <th colspan="2">Personal Information</th>
                        </tr>
                        <tr>
                            <th>Admission No</th>
                            <td><?php echo $row['Stud_ID']; ?></td>
                        </tr>                    
                        <tr>
                            <th>Programme</th>
                            <td><?php echo $row['Stud_Course']; ?></td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td><?php echo $row['Stud_Name']; ?></td>
                        </tr>
                        <tr>
                            <th>Date of Birth</th>
                            <td><?php echo $row['Stud_DOB']; ?></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td><?php echo $row['Stud_Gender']; ?></td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td><?php echo $row['Stud_Mob']; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $row['Stud_Email']; ?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td><?php echo $row['Stud_Address']; ?></td>
                        </tr>
                        <tr>
                            <th>Course</th>
                            <td><?php echo $row['Stud_Course']; ?></td>
                        </tr>
                        <tr>
                            <th>Batch</th>
                            <td><?php echo $row['Stud_Batch']; ?></td>
                        </tr>
                        <tr>
                            <th>Semester</th>
                            <td><?php echo $row['Stud_Year']; ?></td>
                        </tr>
                        <tr>
                            <th>ID-Proof Number</th>
                            <td><?php echo $row['Stud_ID_No']; ?></td>
                        </tr>
                        <tr>
                            <th>University Register No</th>
                            <td><?php echo $row['Stud_Reg_No']; ?></td>
                        </tr>
                    </table>
                </div>                        
            </div>            
            <div class="row">
                <div class="col">
                    <table class="table table-bordered table-hover border-dark border-info" align="center">
                        <tr class="table-dark text-center">
                            <th colspan="2">Parental Information</th>
                        </tr>
                        <tr>
                            <th>Father's Name</th>
                            <td><?php echo $row['Stud_Father_Name']; ?></td>
                        </tr>
                        <tr>
                            <th>Occupation</th>
                            <td><?php echo $row['Stud_Father_Occ']; ?></td>
                        </tr>
                        <tr>
                            <th>Mobile Number</th>
                            <td><?php echo $row['Stud_Father_No']; ?></td>
                        </tr>
                        <tr>
                            <th>Mother's Name</th>
                            <td><?php echo $row['Stud_Mother_Name']; ?></td>
                        </tr>
                        <tr>
                            <th>Occupation</th>
                            <td><?php echo $row['Stud_Mother_Occ']; ?></td>
                        </tr>
                        <tr>
                            <th>Mobile Number</th>
                            <td><?php echo $row['Stud_Mother_No']; ?></td>
                        </tr>
                        <tr>
                            <th>Annual Income</th>
                            <td><?php echo $row['Annual_Income']; ?></td>
                        </tr>
                    </table>
                    <table class="table table-bordered table-hover border-dark border-info">
                        <tr class="table-dark text-center">
                            <th colspan="2">Placement Information</th>
                        </tr>
                        <tr>
                            <th>CGPA</th>
                            <td><?php echo $row['CGPA']; ?></td>
                        </tr>
                        <tr>
                            <th>Backlogs</th>
                            <td><?php echo $row['Stud_Backlogs']; ?></td>
                        </tr>
                        <tr>
                            <th>Placement Status</th>
                            <td><?php echo ($row['Stud_Placement']==1) ? "Yes": "No" ?></td>
                        </tr>
                        <?php 
                            $query1="SELECT * FROM placement p, company c WHERE p.C_ID=c.C_ID AND p.Stud_ID='$Stud_ID'";
                            $run1 = mysqli_query($con, $query1);
                            if (mysqli_num_rows($run1) > 0){
                                $row1 = mysqli_fetch_array($run1);                                
                        ?>
                            <tr>
                                <th>Company Name</th>
                                <td><?php echo $row1['C_Name']; ?></td>
                            </tr>
                            <tr>
                                <th>Designation</th>
                                <td><?php echo $row1['C_Desg']; ?></td>
                            </tr>
                            <tr>
                                <th>Package</th>
                                <td><?php echo $row1['P_LPA']; ?></td>
                            </tr>
                        <?php
                            }
                        ?>
                    </table>
                </div>
                <div class="col">
                    <table class="table table-bordered table-hover border-dark border-info" align="center">
                        <tr class="table-dark text-center">
                            <th colspan="2">Academic Information</th>
                        </tr>
                        <tbody id="UG">    
                            <tr class="text-center">
                                <th colspan="2">Under Graduate</th>
                            </tr>
                            <tr>
                                <th>UG University</th>
                                <td><?php echo $row['UG_Univ']; ?></td>
                            </tr>
                            <tr>
                                <th>UG College</th>
                                <td><?php echo $row['UG_College']; ?></td>
                            </tr>
                            <tr>
                                <th>UG Course</th>
                                <td><?php echo $row['UG_Course']; ?></td>
                            </tr>
                            <tr>
                                <th>UG Marks(%)</th>
                                <td><?php echo $row['Marks_UG']; ?></td>
                            </tr>
                            <tr>
                                <th>Year of Passing</th>
                                <td><?php echo $row['YOP_UG']; ?></td>
                            </tr>
                        </tbody>
                        <tr class="text-center">
                            <th colspan="2">Class 12th</th>
                        </tr>
                        <tr>
                            <th>Board</th>
                            <td><?php echo $row['Board_12th']; ?></td>
                        </tr>
                        <tr>
                            <th>School</th>
                            <td><?php echo $row['School_12th']; ?></td>
                        </tr>
                        <tr>
                            <th>Stream</th>
                            <td><?php echo $row['Stream_12th']; ?></td>
                        </tr>
                        <tr>
                            <th>12th Marks(%)</th>
                            <td><?php echo $row['Marks_12th']; ?></td>
                        </tr>
                        <tr>
                            <th>Year of Passing</th>
                            <td><?php echo $row['YOP_12th']; ?></td>
                        </tr>
                        <tr class="text-center">
                            <th colspan="2">Class 10th</th>
                        </tr>
                        <tr>
                            <th>Board</th>
                            <td><?php echo $row['Board_10th']; ?></td>
                        </tr>
                        <tr>
                            <th>School</th>
                            <td><?php echo $row['School_10th']; ?></td>
                        </tr>
                        <tr>
                            <th>10th Marks(%)</th>
                            <td><?php echo $row['Marks_10th']; ?></td>
                        </tr>
                        <tr>
                            <th>Year of Passing</th>
                            <td><?php echo $row['YOP_10th']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class='text-center mb-3'>
                <a class='btn btn-danger' href="javascript: window.close()">Close</a>
            </div>
        </div>	    
        <script>
            const course = "<?php echo $row['Stud_Course']; ?>";
            const UG_Field = document.getElementById('UG');
            if (course === "MCA") {
                UG_Field.style.display = 'table-row-group';
            } else {
                UG_Field.style.display = 'none';
            }
        </script>
		<?php include('../Common/footer.php') ?>
	</body>
</html>