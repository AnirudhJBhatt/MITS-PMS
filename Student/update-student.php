<?php  
	session_start();
	if (!$_SESSION["LoginStudent"]){
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}

	require_once "../connection/connection.php";

    $Stud_ID = $_REQUEST['Stud_ID'];

    $query = "SELECT * FROM `student` WHERE `Stud_ID` = '$Stud_ID'";
    
    $run = mysqli_query($con, $query);
    
    $row = mysqli_fetch_array($run);
    
    $file1 = $row['Stud_Image'];
    $file2 = $row['Mark_List_10th']; 
    $file3 = $row['Mark_List_12th'];
    $file4 = $row['Mark_List_UG'];
?>

<?php
    if(isset($_POST['update'])){
   
        $Stud_Name = mysqli_real_escape_string($con, $_POST['Stud_Name']);

		$Stud_DOB =$_POST['Stud_DOB'];

		$Stud_Gender =$_POST['Stud_Gender'];

		$Stud_Mob =$_POST['Stud_Mob'];

		$Stud_Email =$_POST['Stud_Email'];

		$Stud_Address =$_POST['Stud_Address'];

		$Stud_Caste =$_POST['Stud_Caste'];

		$Stud_M_T =$_POST['Stud_M_T'];

		$Stud_ID_No =$_POST['Stud_ID_No'];

		$Stud_Reg_No =$_POST['Stud_Reg_No'];

		$Stud_Father_Name =mysqli_real_escape_string($con, $_POST['Stud_Father_Name']);

		$Stud_Father_Occ =$_POST['Stud_Father_Occ'];

		$Stud_Father_No =$_POST['Stud_Father_No'];

		$Stud_Mother_Name =mysqli_real_escape_string($con, $_POST['Stud_Mother_Name']);

		$Stud_Mother_Occ =$_POST['Stud_Mother_Occ'];

		$Stud_Mother_No =$_POST['Stud_Mother_No'];

		$Guardian_Email =$_POST['Guardian_Email'];

		$Annual_Income =$_POST['Annual_Income'];

		$UG_Univ =$_POST['UG_Univ'];

		$UG_College =mysqli_real_escape_string($con, $_POST['UG_College']);

		$UG_Course =mysqli_real_escape_string($con, $_POST['UG_Course']);

		$Marks_UG =$_POST['Marks_UG'];

		$YOP_UG=$_POST['YOP_UG'];

		$Board_12th =$_POST['Board_12th'];

		$School_12th =mysqli_real_escape_string($con, $_POST['School_12th']);

		$Stream_12th =mysqli_real_escape_string($con, $_POST['Stream_12th']);

		$Marks_12th =$_POST['Marks_12th'];

		$YOP_12th =$_POST['YOP_12th'];

		$Board_10th =$_POST['Board_10th'];

		$School_10th =mysqli_real_escape_string($con, $_POST['School_10th']);

		$Marks_10th =$_POST['Marks_10th'];

		$YOP_10th =$_POST['YOP_10th'];
        
        if (isset($_FILES['Stud_Image']) && $_FILES['Stud_Image']['error'] == 0) {
            $Stud_Image = file_get_contents($_FILES['Stud_Image']['tmp_name']);
            $Stud_Image = mysqli_real_escape_string($con, $Stud_Image);
        } else {
            $Stud_Image = $file1;
        }
        
        if (isset($_FILES['Mark_List_10th']) && $_FILES['Mark_List_10th']['error'] == 0) {
            $Mark_List_10th = file_get_contents($_FILES['Mark_List_10th']['tmp_name']);
            $Mark_List_10th = mysqli_real_escape_string($con, $Mark_List_10th);
        } else {
            $Mark_List_10th = $file2;
        }
        
        if (isset($_FILES['Mark_List_12th']) && $_FILES['Mark_List_12th']['error'] == 0) {
            $Mark_List_12th = file_get_contents($_FILES['Mark_List_12th']['tmp_name']);
            $Mark_List_12th = mysqli_real_escape_string($con, $Mark_List_12th);
        } else {
            $Mark_List_12th = $file3;
        }
        
        if (isset($_FILES['Mark_List_UG']) && $_FILES['Mark_List_UG']['error'] == 0) {
            $Mark_List_UG = file_get_contents($_FILES['Mark_List_UG']['tmp_name']);
            $Mark_List_UG = mysqli_real_escape_string($con, $Mark_List_UG);
        } else {
            $Mark_List_UG = $file4;
        } 

        $upquery = "UPDATE `student` SET `Stud_Name`='$Stud_Name',`Stud_DOB`='$Stud_DOB',`Stud_Gender`='$Stud_Gender', `Stud_Mob`='$Stud_Mob',`Stud_Email`='$Stud_Email',`Stud_Address`='$Stud_Address',`Stud_Caste`='$Stud_Caste',`Stud_M_T`='$Stud_M_T',`Stud_ID_No`='$Stud_ID_No',`Stud_Reg_No`='$Stud_Reg_No',`Stud_Father_Name`='$Stud_Father_Name',`Stud_Father_Occ`='$Stud_Father_Occ',`Stud_Father_No`='$Stud_Father_No',`Stud_Mother_Name`='$Stud_Mother_Name',`Stud_Mother_Occ`='$Stud_Mother_Occ',`Stud_Mother_No`='$Stud_Mother_No',`Guardian_Email`='$Guardian_Email',`Annual_Income`='$Annual_Income',`UG_Univ`='$UG_Univ',`UG_College`='$UG_College',`UG_Course`='$UG_Course',`Marks_UG`='$Marks_UG',`Marks_UG`='$Marks_UG',`YOP_UG`='$YOP_UG',`YOP_12th`='$YOP_12th',`Board_12th`='$Board_12th',`School_12th`='$School_12th',`Stream_12th`='$Stream_12th',`Marks_12th`='$Marks_12th',`YOP_12th`='$YOP_12th',`Board_10th`='$Board_10th',`School_10th`='$School_10th',`Marks_10th`='$Marks_10th',`YOP_10th`='$YOP_10th',`Stud_Image`='$Stud_Image',`Mark_List_10th`='$Mark_List_10th',`Mark_List_12th`='$Mark_List_12th',`Mark_List_UG`='$Mark_List_UG' WHERE `Stud_ID`='$Stud_ID'";
        
        $run1=mysqli_query($con,$upquery);

        if ($run1) {
            echo "<script>confirm('Record updated'); window.location.href = window.location.href;</script>";
        }
        else {
            echo "<script>alert('Record not updated');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<style>
    input{
        margin-bottom: 15px;
    }
</style>

<body>
    <?php include('../Common/header.php') ?>
    <div class="col-xl-12 col-lg-12 col-md-12 w-100">
		<div class="bg-secondary text-center">
			<div class="table-one flex-wrap flex-md-no-wrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
				<h4>Student Updation Form</h4>
			</div>
		</div>
	</div>
    <div class="container mt-5 mb-5">        
        <form id="studregform" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <h5>Personal Details</h5>
            <div class="row">           
                <div class="col">
                    <label>Name</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Stud_Name']; ?>" name="Stud_Name">
                    <div class="error text-danger"></div>
                </div>
                <div class="col">
                    <label>Date of Birth</label>
                    <input type="text" class="form-control" value = "<?php echo $row['Stud_DOB'] ?>" name="Stud_DOB">
                </div>
                <div class="col">
                    <label>Gender</label>
                    <select class="form-select" name="Stud_Gender">
                        <option value="Male" <?php echo ($row['Stud_Gender'] == "Male") ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($row['Stud_Gender'] == "Female") ? 'selected' : ''; ?>>Female</option>
                    </select>    
                </div>
            </div>
            <div class="row"> 
                <div class="col">
                    <label>Mobile No</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Stud_Mob']; ?>" name="Stud_Mob">
                    <div class="error text-danger"></div>
                </div>
                <div class="col">
                    <label>Email</label>
                    <input type="email" class="form-control" value= "<?php echo $row['Stud_Email']; ?>" name="Stud_Email">
                    <div class="error text-danger"></div>
                </div>                       
                <div class="col">
                    <label>Address</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Stud_Address']; ?>" name="Stud_Address">
                    <div class="error text-danger"></div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>Caste/Religion</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Stud_Caste']; ?>" name="Stud_Caste">
                    <div class="error text-danger"></div>
                </div>
                <div class="col">
                    <label>Mother Tongue</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Stud_M_T']; ?>" name="Stud_M_T">
                    <div class="error text-danger"></div>
                </div> 
                <div class="col">
                    <label>Student ID Proof No</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Stud_ID_No']; ?>" name="Stud_ID_No">
                    <div class="error text-danger"></div>
                </div>                
            </div>
            <div class="row"> 
                <div class="col-sm-4">
                    <label>University Reg No</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Stud_Reg_No']; ?>" name="Stud_Reg_No">
                </div>  
                <div class="col-sm-4">
                    <label>Student Image</label>
                    <input type="file" class="form-control" name="Stud_Image">
                </div> 
            </div>
            <h5>Parental Information</h5>
            <div class="row">
                <div class="col">
                    <label>Father's Name</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Stud_Father_Name']; ?>" name="Stud_Father_Name">
                    <div class="error text-danger"></div>
                </div>
                <div class="col">
                    <label>Father's Occupation</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Stud_Father_Occ']; ?>" name="Stud_Father_Occ">
                    <div class="error text-danger"></div>
                </div>
                <div class="col">
                    <label>Father's Mobile No</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Stud_Father_No']; ?>" name="Stud_Father_No">
                    <div class="error text-danger"></div>
                </div>
            </div>            
            <div class="row">
                <div class="col">
                    <label>Mother's Name</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Stud_Mother_Name']; ?>" name="Stud_Mother_Name">
                    <div class="error text-danger"></div>
                </div>
                <div class="col">
                    <label>Mother's Occupation</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Stud_Mother_Occ']; ?>" name="Stud_Mother_Occ">
                    <div class="error text-danger"></div>
                </div>
                <div class="col">
                    <label>Mother's Mobile No</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Stud_Mother_No']; ?>" name="Stud_Mother_No">
                    <div class="error text-danger"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <label>Guardian Email</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Guardian_Email']; ?>" name="Guardian_Email">
                    <div class="error text-danger"></div>
                </div>
                <div class="col-sm-4">
                    <label>Annual Income</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Annual_Income']; ?>" name="Annual_Income">
                </div>
            </div>
            <h5>Academic Information</h5>            
            <div id="UG">
                <div class="row">
                    <div class="col">
                        <label>UG University</label>
                        <input type="text" class="form-control" value= "<?php echo $row['UG_Univ']; ?>" name="UG_Univ">
                        <div class="error text-danger"></div>
                    </div>
                    <div class="col">
                        <label>UG College</label>
                        <input type="text" class="form-control" value= "<?php echo $row['UG_College']; ?>" name="UG_College">
                        <div class="error text-danger"></div>
                    </div>
                    <div class="col">
                        <label>UG Course</label>
                        <input type="text" class="form-control" value= "<?php echo $row['UG_Course']; ?>" name="UG_Course">
                        <div class="error text-danger"></div>
                    </div>
                </div>    
                <div class="row">
                    <div class="col">
                        <label>Year of Passing</label>
                        <input type="text" class="form-control" value= "<?php echo $row['YOP_UG']; ?>" name="YOP_UG">
                    </div>
                    <div class="col">
                        <label>UG Marks(%)</label>
                        <input type="text" class="form-control" value= "<?php echo $row['Marks_UG']; ?>" name="Marks_UG">
                    </div>
                    <div class="col-sm-4">
                        <label>UG Marklist</label>
                        <input type="file" class="form-control" name="Mark_List_UG">
                    </div>  
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>12th Board</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Board_12th']; ?>" name="Board_12th">
                    <div class="error text-danger"></div>
                </div>
                <div class="col">
                    <label>12th School</label>
                    <input type="text" class="form-control" value= "<?php echo $row['School_12th']; ?>" name="School_12th">
                    <div class="error text-danger"></div>
                </div>
                <div class="col">
                    <label>Stream</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Stream_12th']; ?>" name="Stream_12th">
                    <div class="error text-danger"></div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>Year of Passing</label>
                    <input type="text" class="form-control" value= "<?php echo $row['YOP_12th']; ?>" name="YOP_12th">
                </div>
                <div class="col">
                    <label>12th Marks(%)</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Marks_12th']; ?>" name="Marks_12th">
                </div>
                <div class="col-sm-4">
                    <label>12th Marklist</label>
                    <input type="file" class="form-control" name="Mark_List_12th">
                </div>  
            </div>
            <div class="row">
                <div class="col">
                    <label>10th Board</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Board_10th']; ?>" name="Board_10th">
                    <div class="error text-danger"></div>
                </div>
                <div class="col">
                    <label>10th School</label>
                    <input type="text" class="form-control" value= "<?php echo $row['School_10th']; ?>" name="School_10th">
                    <div class="error text-danger"></div>
                </div>
                <div class="col">
                    <label>Year of Passing</label>
                    <input type="text" class="form-control" value= "<?php echo $row['YOP_10th']; ?>" name="YOP_10th">
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <label>10th Marks(%)</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Marks_10th']; ?>" name="Marks_10th">
                </div>
                <div class="col-4">
                    <label>10th Marklist</label>
                    <input type="file" class="form-control" name="Mark_List_10th">
                </div>
            </div>
            <div class="mt-3 text-center">
                <input type="Submit" class="btn btn-success" value="Update" name="update">
                <input type="button" class="btn btn-danger" value="Close" onClick="window.location.href='../student/student-info.php';">
            </div>
        </form>
    </div>
    <script>
        const course = "<?php echo $row['Stud_Course']; ?>";
        const UG_Field = document.getElementById('UG');
        if (course === "MCA") {
            UG_Field.style.display = 'block';
        } else {
            UG_Field.style.display = 'none';
        }

        function validateForm() {
            // Clear previous error messages
            document.querySelectorAll('.error').forEach(el => el.textContent = '');

            let isValid = true;

            // Name Validation (Ensure no numbers)
            const nameFields = ["Stud_Name", "Stud_Father_Name", "Stud_Mother_Name"];
            for (let field of nameFields) {
                let inputField = document.querySelector(`input[name="${field}"]`);
                let name = inputField.value.trim();
                if (!/^[A-Za-z\s-]+$/.test(name)) {
                    showError(inputField, "Please enter a valid name (letters, spaces, and hyphens only).");
                    isValid = false;
                }
            }

            const stringFields = [
                "Board_10th", "School_10th", "Stream_12th", "School_12th", 
                "Board_12th", "UG_Course", "UG_College", "UG_Univ", 
                "Stud_Mother_Occ", "Stud_Father_Occ", "Stud_Caste"
            ];

            for (let field of stringFields) {
                let inputField = document.querySelector(`input[name="${field}"]`);
                let value = inputField.value.trim();
                if (/\d/.test(value)) {
                    showError(inputField, "Please enter a valid value");
                    isValid = false;
                }
            }

            const addressFields = ["Stud_Address"];
            for (let field of addressFields) {
                let inputField = document.querySelector(`input[name="${field}"]`);
                let address = inputField.value.trim();
                if (/\d/.test(address)) {
                    showError(inputField, "Please enter a valid address.");
                    isValid = false;
                }
            }

            // Mobile Validation
            const phoneFields = ["Stud_Mob", "Stud_Father_No", "Stud_Mother_No"];
            for (let field of phoneFields) {
                let inputField = document.querySelector(`input[name="${field}"]`);
                let phone = inputField.value.trim();
                if (!/^[6-9]\d{9}$/.test(phone)) {
                    showError(inputField, "Please enter a valid 10-digit mobile number.");
                    isValid = false;
                }
            }

            // Email Validation
            const emailFields = ["Stud_Email", "Guardian_Email"];
            for (let field of emailFields) {
                let inputField = document.querySelector(`input[name="${field}"]`);
                let email = inputField.value.trim();
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    showError(inputField, "Please enter a valid email address.");
                    isValid = false;
                }
            }

            // Aadhaar Validation
            let aadhaarField = document.querySelector(`input[name="Stud_ID_No"]`);
            let aadhaar = aadhaarField.value.trim();
            if (!/^\d{12}$/.test(aadhaar)) {
                showError(aadhaarField, "Please enter a valid 12-digit Aadhaar Number.");
                isValid = false;
            }

            return isValid; // Form submission only if all validations pass
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
