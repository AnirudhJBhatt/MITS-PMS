<?php  
	session_start();
	if (!$_SESSION["LoginAdmin"])
	{
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}
	require_once "../connection/connection.php";
    
    $C_ID = $_REQUEST['C_ID'];
    $query = "SELECT * FROM `Company` WHERE `C_ID` = '$C_ID'";
    $run = mysqli_query($con, $query);
    $row = mysqli_fetch_array($run);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Company</title>
</head>
<style>
    input{
        margin-bottom: 15px;
    }
</style>

<?php
if(isset($_POST['update'])){
   
    $C_Name=$_POST['C_Name'];

    $C_Type =$_POST['C_Type'];

    $C_YOE =$_POST['C_YOE'];

    $C_Email =$_POST['C_Email'];

    $C_Address =$_POST['C_Address'];

    $C_Phone =$_POST['C_Phone'];

    $C_Person =$_POST['C_Person'];

    $C_Website =$_POST['C_Website'];

    $upquery = "UPDATE `company` SET `C_Name`='$C_Name',`C_Type`='$C_Type',`C_YOE`='$C_YOE',`C_Address`='$C_Address',`C_Email`='$C_Email',`C_Phone`='$C_Phone',`C_Person`='$C_Person',`C_Website`='$C_Website' WHERE `C_ID`='$C_ID'";

    $run1=mysqli_query($con,$upquery);

    if ($run1) {
        echo "<script>confirm('Record updated');</script>";
    }
    else {
        echo "<script>alert('Record not updated');</script>";
    }
}
?>
<body>    
    <?php include('../Common/header.php') ?>
    <div class="col-xl-12 col-lg-12 col-md-12 w-100">
		<div class="bg-secondary text-center">
			<div class="table-one flex-wrap flex-md-no-wrap pt-3 pb-2 mb-3 text-white pl-3">
				<h4>Company Updation Form</h4>
			</div>
		</div>
	</div>
    <div class="container mt-5 mb-5">        
        <form method="post" enctype="multipart/form-data" id="companyForm"  onsubmit="return validateForm()">
            <h5>Company Details</h5>
            <div class="row">
                <div class="col">
                    <label>Company Name</label>
                    <input type="text" class="form-control" value= "<?php echo $row['C_Name']; ?>" name="C_Name">
                </div>
                <div class="col">
                    <label>Sector</label>
                    <input type="text" class="form-control" value = "<?php echo $row['C_Type'] ?>" name="C_Type">
                </div>
                <div class="col">
                    <label>Year of Establishment</label>
                    <input type="text" class="form-control" value = "<?php echo $row['C_YOE'] ?>" name="C_YOE">
                </div>
            </div>
            <div class="row">        
                <div class="col">
                    <label>Address</label>
                    <input type="text" class="form-control" value= "<?php echo $row['C_Address']; ?>" name="C_Address">
                </div>
                <div class="col">
                    <label>Email</label>
                    <input type="text" class="form-control" value= "<?php echo $row['C_Email']; ?>" name="C_Email">
                </div>
                <div class="col">
                    <label>Phone</label>
                    <input type="text" class="form-control" value= "<?php echo $row['C_Phone']; ?>" name="C_Phone">
                </div>            
            </div>
            <div class="row">
                <div class="col-4">
                    <label>Contact Person</label>
                    <input type="text" class="form-control" value= "<?php echo $row['C_Person']; ?>" name="C_Person">
                </div>
                <div class="col-4">
                    <label>Website</label>
                    <input type="text" class="form-control" value= "<?php echo $row['C_Website']; ?>" name="C_Website">
                </div>
            </div>
            <div class='text-center mb-3 mt-3'>
                <input type="Submit" class="btn btn-success" value="Update" name = "update">
                <input type="Button" class="btn btn-danger" value="Back" onClick="window.close()">
            </div>
        </form>
    </div>
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
            if (!/^(https?:\/\/)?(www\.)?[^.]+\..+$/.test(website)) {
                alert("Please enter a valid URL.");
                return false;
            }
			return true; // Allow form submission if all validations pass
		}
	</script>
    <?php include('../Common/footer.php') ?>
</body>
</html>
