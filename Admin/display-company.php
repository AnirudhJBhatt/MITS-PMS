<!---------------- Session starts form here ----------------------->
<?php
    session_start();
	if (!$_SESSION["LoginAdmin"]){
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}
	require_once "../connection/connection.php";

    $C_ID = $_REQUEST['C_ID'];
	$query = "SELECT * FROM Company";    
    $run = mysqli_query($con, $query);
    $row = mysqli_fetch_array($run);
?>
<!---------------- Session Ends form here ------------------------>

<!doctype html>
<html lang="en">
	<head>
		<title>Company Information</title>
	</head>
    <style>
        table th, table td {
            width: 50%; /* Ensures equal width */
        }
    </style>
	<body>
        <?php include('../Common/header.php') ?>
        <div class="container mt-5 mb-5 border border-dark rounded"> 
            <div class='header text-center mt-3'>
                <h3 class='text-dark'>Company Profile</h3>
            </div>      
            <div class="row mt-3">                
                <div class="col d-flex justify-content-center">
                    <table class="table table-hover table-bordered border-dark w-50">
                        <tr class="table-dark text-center">
                            <th colspan="2">Company Information</th>
                        </tr>
                        <tr>
                            <th>Company ID</th>
                            <td><?php echo $row['C_ID']; ?></td>
                        </tr>                    
                        <tr>
                            <th>Name</th>
                            <td><?php echo $row['C_Name']; ?></td>
                        </tr>
                        <tr>
                            <th>Year of Establishment</th>
                            <td><?php echo $row['C_YOE']; ?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td><?php echo $row['C_Address']; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $row['C_Email']; ?></td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td><?php echo $row['C_Phone']; ?></td>
                        </tr>
                        <tr>
                            <th>Contact Person</th>
                            <td><?php echo $row['C_Person']; ?></td>
                        </tr>
                        <tr>
                            <th>Website</th>
                            <td><?php echo $row['C_Website']; ?></td>
                        </tr>
                    </table>
                </div>                        
            </div>
            <div class='text-center mb-3'>
                <a class='btn btn-danger' href="javascript: window.close()">Close</a>
            </div>	
        </div>
        <?php include('../Common/footer.php') ?>
	</body>
</html>

