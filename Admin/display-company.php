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


<?php  
	require_once "../connection/connection.php";

    $C_ID = $_REQUEST['C_ID'];

	$query = "SELECT * FROM Company";
       
    $run = mysqli_query($con, $query);
        
    $row = mysqli_fetch_array($run);
?>

<!doctype html>
<html lang="en">
	<head>
		<title>Faculty Information</title>
        <style>
            tr,th,td{
                width: 50%;                
            }
            td{
                text-align: center;
            }
        </style>
	</head>
	<body>
		<?php include('../common/common-header.php') ?> 
        <div class="container mt-5 mb-5 border border-dark rounded"> 
            <div class='header text-center mt-3'>
                <h3 class='text-dark'>Faculty Profile</h3>
            </div>      
            <div class="row mt-3">                
                <div class="col">
                    <table class="table table-light table-hover table-bordered border-info" align="center">
                        <tr class="table-info text-center">
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
            <div class='footer text-center mb-3'>
                <a class='btn btn-danger' href="javascript: history.back()">Close</a>
            </div>	
        </div>
	</body>
</html>

