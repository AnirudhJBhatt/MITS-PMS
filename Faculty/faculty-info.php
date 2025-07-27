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
    
    $imageData = $row['Fac_Image'];
    $base64Image = base64_encode($imageData);
    $imageSrc = 'data:image/jpeg;base64,' . $base64Image;
?>
<!---------------- Session Ends form here ------------------------>

<!doctype html>
<html lang="en">
	<head>
		<title>Faculty - Profile</title>    
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
                    <?php  $Fac_Image= $row["Fac_Image"]; ?>
					<figure class="figure">
						<img src="<?php echo $imageSrc; ?>" class="figure-img img-fluid border" height='250px' width='250px'>
					</figure>                       
                </div>
                <div class="col">
                    <table class="table table-hover table-bordered border-dark">
                        <tr class="table-dark text-center">
                            <th colspan="2">Personal Information</th>
                        </tr>
                        <tr>
                            <th>Faculty ID</th>
                            <td><?php echo $row['Fac_ID']; ?></td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td><?php echo $row['Fac_Name']; ?></td>
                        </tr>
                        <tr>
                            <th>Date of Birth</th>
                            <td><?php echo $row['Fac_DOB']; ?></td>
                        </tr>                    
                        <tr>
                            <th>Department</th>
                            <td><?php echo $row['Fac_Dept']; ?></td>
                        </tr>                    
                        <tr>
                            <th>Designation</th>
                            <td><?php echo $row['Fac_Desg']; ?></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td><?php echo $row['Fac_Gender']; ?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td><?php echo $row['Fac_Address']; ?></td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td><?php echo $row['Fac_Mob']; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $row['Fac_Email']; ?></td>
                        </tr>
                    </table>
                </div>                        
            </div>
            <div class='text-center mb-3'>
                <a class="btn btn-success" href="update-faculty.php?Fac_ID=<?php echo $row['Fac_ID'];?>">Update</a>
                <a class='btn btn-danger' href="../Faculty/faculty-dashboard.php">Close</a>
            </div>
        </div>
		<?php include('../Common/footer.php') ?>
	</body>
</html>