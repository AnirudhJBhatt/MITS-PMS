<?php  
	session_start();
	if (!$_SESSION["LoginAdmin"])	{
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}
	require_once "../connection/connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Faculty</title>

</head>
<style>
    input{
        margin-bottom: 15px;
    }
</style>
<?php
    $Fac_ID = $_REQUEST['Fac_ID'];
    $query = "SELECT * FROM `faculty` WHERE `Fac_ID` = '$Fac_ID'";   
    $run = mysqli_query($con, $query);    
    $row = mysqli_fetch_array($run);    
    $file1 = $row['Fac_Image'];
?>
<body>
	<?php include('../Common/header.php') ?>
    <div class="col-xl-12 col-lg-12 col-md-12 w-100">
		<div class="bg-secondary text-center">
			<div class="table-one flex-wrap flex-md-no-wrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
				<h4>Faculty Updation Form</h4>
			</div>
		</div>
	</div>
    <div class="container mt-5 mb-5">        
        <form id="facregform" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <h5>Personal Details</h5>
            <div class="row">           
                <div class="col">
                    <label>Name</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Fac_Name']; ?>" name="Fac_Name">
                    <div class="error text-danger"></div>
                </div>
                <div class="col">
                    <label>Date of Birth</label>
                    <input type="text" class="form-control" value = "<?php echo $row['Fac_DOB'] ?>" name="Fac_DOB">
                </div>
                <div class="col">
                    <label>Gender</label>
                    <select class="form-select" name="Fac_Gender">
                        <option value="Male" <?php echo ($row['Fac_Gender'] == "Male") ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($row['Fac_Gender'] == "Female") ? 'selected' : ''; ?>>Female</option>
                    </select>  
                </div>
            </div>
            <div class="row">                        
                <div class="col">
                    <label>Address</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Fac_Address']; ?>" name="Fac_Address">
                </div>
                <div class="col">
                    <label>Mobile No</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Fac_Mob']; ?>" name="Fac_Mob">
                    <div class="error text-danger"></div>
                </div>
                <div class="col">
                    <label>Email</label>
                    <input type="email" class="form-control" value= "<?php echo $row['Fac_Email']; ?>" name="Fac_Email">
                    <div class="error text-danger"></div>
                </div>
            </div>
            <div class="row">   
                <div class="col">
                    <label>Department</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Fac_Dept']; ?>" name="Fac_Dept">
                </div> 
                <div class="col">
                    <label>Designation</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Fac_Desg']; ?>" name="Fac_Desg">
                </div>
                <div class="col">
                    <label>Faculty Image</label>
                    <input type="file" class="form-control" name="Fac_Image">
                </div> 
            </div>
            <div class="mt-3 text-center">
                <input type="Submit" class="btn btn-success" value="Update" name="update">
                <input type="Button" class="btn btn-danger" value="Close" onClick="window.close()">
            </div>
        </form>
    </div>
    <script>
        function validateForm() {
            // Clear previous error messages
            document.querySelectorAll('.error').forEach(el => el.textContent = '');

            let isValid = true;

            // Name Validation
            const nameField = document.querySelector(`input[name="Fac_Name"]`);
            const name = nameField.value.trim();
            if (!/^[A-Za-z\s-]+$/.test(name)) {
                showError(nameField, "Please enter a valid name.");
                isValid = false;
            }

            // Mobile Number Validation
            const mobileField = document.querySelector(`input[name="Fac_Mob"]`);
            const mobile = mobileField.value.trim();
            if (!/^[6-9]\d{9}$/.test(mobile)) {
                showError(mobileField, "Please enter a valid mobile number.");
                isValid = false;
            }

            // Email Validation
            const emailField = document.querySelector(`input[name="Fac_Email"]`);
            const email = emailField.value.trim();
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                showError(emailField, "Please enter a valid email address.");
                isValid = false;
            }

            return isValid; // Only allow form submission if all validations pass
        }

        function showError(field, message) {
            const errorDiv = field.nextElementSibling;
            if (errorDiv && errorDiv.classList.contains('error')) {
                errorDiv.textContent = message;
            }
        }
    </script>
	<?php include('../Common/footer.php') ?>
</body>
</html>
<?php
    if(isset($_POST['update'])){
        $Fac_Name = $_POST['Fac_Name'];
        $Fac_DOB = $_POST['Fac_DOB'];
        $Fac_Gender = $_POST['Fac_Gender'];
        $Fac_Mob = $_POST['Fac_Mob'];
        $Fac_Email = $_POST['Fac_Email'];
        $Fac_Address = $_POST['Fac_Address'];
        $Fac_Dept = $_POST['Fac_Dept'];
        $Fac_Desg = $_POST['Fac_Desg'];

        if (isset($_FILES['Fac_Image']) && $_FILES['Fac_Image']['error'] == 0) {
            $Fac_Image = file_get_contents($_FILES['Fac_Image']['tmp_name']);
            $Fac_Image = mysqli_real_escape_string($con, $Fac_Image);
        } else {
            $Fac_Image = $file1; 
        }

        $upquery = "UPDATE `faculty` SET `Fac_Name` = '$Fac_Name', `Fac_DOB` = '$Fac_DOB', `Fac_Gender` = '$Fac_Gender', `Fac_Mob` = '$Fac_Mob', `Fac_Email` = '$Fac_Email', `Fac_Address` = '$Fac_Address', `Fac_Dept` = '$Fac_Dept', `Fac_Desg` = '$Fac_Desg', `Fac_Image` = '$Fac_Image' WHERE `Fac_ID` = '$Fac_ID'";

        $run1 = mysqli_query($con, $upquery);

        if ($run1) {
            echo "<script> confirm('Record updated'); window.location.href = window.location.href; </script>";
        } else {
            echo "<script>alert('Record not updated');</script>";
        }
    }
?>

