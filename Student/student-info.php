<!---------------- Session starts form here ----------------------->
<?php  
	session_start();

	if (!$_SESSION["LoginStudent"])
	{
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}

	require_once "../connection/connection.php";

    $Stud_ID=$_SESSION['LoginStudent'];

	$query = "SELECT * FROM `student` WHERE `Stud_ID` = '$Stud_ID' ";
       
    $run = mysqli_query($con, $query);
        
    $row = mysqli_fetch_array($run);
?>
<!---------------- Session Ends form here ------------------------>


<!doctype html>
<html lang="en">
	<head>
		<title>Student - Profile</title>    
	</head>
	<body>
		<?php include('../common/common-header.php') ?>
        <div class="container mt-5 mb-5 border border-dark rounded">        
            <div class="row mt-3">
                <div class="col align-self-center text-center">
                    <?php  $Stud_Image= $row["Stud_Image"]; ?>
					<figure class="figure">
						<img src="<?php echo "../admin/images/$Stud_Image" ?>" class="figure-img img-fluid border" height='290px' width='250px'>
					</figure>                       
                </div>
                <div class="col">
                    <table class="table table-light table-hover table-bordered border-info" align="center">
                        <tr class="table-info text-center">
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
                            <th>Email</th>
                            <td><?php echo $row['Stud_Address']; ?></td>
                        </tr>
                        <tr>
                            <th>Caste</th>
                            <td><?php echo $row['Stud_Caste']; ?></td>
                        </tr>
                        <tr>
                            <th>Mother Tongue</th>
                            <td><?php echo $row['Stud_M_T']; ?></td>
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
                    <table class="table table-light table-hover table-bordered border-info" align="center">
                        <tr class="table-info text-center">
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
                            <th>Guardian Email</th>
                            <td><?php echo $row['Guardian_Email']; ?></td>
                        </tr>
                        <tr>
                            <th>Annual Income</th>
                            <td><?php echo $row['Annual_Income']; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col">
                    <table class="table table-light table-hover table-bordered border-info" align="center">
                        <tr class="table-info text-center">
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
            <div class='footer text-center mb-3'>
                <a class="btn btn-success" href="update-student.php?Stud_ID=<?php echo $row['Stud_ID'];?>">Update</a>
                <a class='btn btn-danger' href="javascript: history.back()">Close</a>
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
	</body>
</html>