<?php  
	session_start();
	if (!$_SESSION["LoginFaculty"])
	{
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}

	require_once "../connection/connection.php";

    $Fac_ID = $_REQUEST['Fac_ID'];

    $query = "SELECT * FROM `faculty` WHERE `Fac_ID` = '$Fac_ID'";
    
    $run = mysqli_query($con, $query);
    
    $row = mysqli_fetch_array($run);
    
    $file1 = $row['Fac_Image'];
?>

<?php
    if(isset($_POST['update'])){
   
        $Fac_Name =$_POST['Fac_Name'];

		$Fac_DOB =$_POST['Fac_DOB'];

		$Fac_Gender =$_POST['Fac_Gender'];

		$Fac_Mob =$_POST['Fac_Mob'];

		$Fac_Email =$_POST['Fac_Email'];

		$Fac_Address =$_POST['Fac_Address'];

		$Fac_Dept =$_POST['Fac_Dept'];

		$Fac_Desg =$_POST['Fac_Desg'];


    if(!file_exists($_FILES['Fac_Image']['tmp_name']) || !is_uploaded_file($_FILES['Fac_Image']['tmp_name'])) 
    {
        $Fac_Image = $file1;        
    }
    else
    {       
        $Fac_Image = $_FILES['Fac_Image']['name'];
        $tmp_name=$_FILES['Fac_Image']['tmp_name'];
        $path1 = "images/".$Fac_Image;
        move_uploaded_file($tmp_name, $path1);
    }
    
    $upquery = "UPDATE `faculty` SET `Fac_Name`='$Fac_Name',`Fac_DOB`='$Fac_DOB',`Fac_Gender`='$Fac_Gender',`Fac_Mob`='$Fac_Mob',`Fac_Email`='$Fac_Email',`Fac_Address`='$Fac_Address',`Fac_Dept`='$Fac_Dept',`Fac_Desg`='$Fac_Desg' WHERE `Fac_ID`='$Fac_ID'";
    
    $run1=mysqli_query($con,$upquery);

    if ($run1) {
        echo "<script>confirm('Record updated'); window.location='Faculty-index.php';</script>";
    }
    else {
        echo "<script>alert('Record not updated'); window.location='Faculty-index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Faculty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<style>
    input{
        margin-bottom: 15px;
    }
</style>

<body>
    <div class="col-xl-12 col-lg-12 col-md-12 w-100">
		<div class="bg-secondary text-center">
			<div class="table-one flex-wrap flex-md-no-wrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
				<h4>Faculty Updation Form</h4>
			</div>
		</div>
	</div>
    <div class="container mt-5 mb-5">        
        <form id="Facregform" method="POST" enctype="multipart/form-data">
            <h5>Personal Details</h5>
            <div class="row">           
                <div class="col">
                    <label>Name</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Fac_Name']; ?>" name="Fac_Name">
                </div>
                <div class="col">
                    <label>Date of Birth</label>
                    <input type="text" class="form-control" value = "<?php echo $row['Fac_DOB'] ?>" name="Fac_DOB">
                </div> 
                <div class="col-sm-4">
                    <label>Department</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Fac_Dept']; ?>" name="Fac_Dept">
                </div>
            </div>
            <div class="row"> 
                <div class="col">
                    <label>Gender</label>
                    <select class="form-control" name="Fac_Gender">
                        <option value="Male" <?php echo ($row['Fac_Gender'] == "Male") ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($row['Fac_Gender'] == "Female") ? 'selected' : ''; ?>>Female</option>
                    </select>    
                </div>
                <div class="col-sm-4">
                    <label>Address</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Fac_Address']; ?>" name="Fac_Address">
                </div>
                <div class="col">
                    <label>Mobile No</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Fac_Mob']; ?>" name="Fac_Mob">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <label>Email</label>
                    <input type="email" class="form-control" value= "<?php echo $row['Fac_Email']; ?>" name="Fac_Email">
                </div>
                <div class="col-sm-4">
                    <label>Designation</label>
                    <input type="text" class="form-control" value= "<?php echo $row['Fac_Desg']; ?>" name="Fac_Desg">
                </div>
                <div class="col-sm-4">
                    <label>Faculty Image</label>
                    <input type="file" class="form-control" value= "<?php echo $row['Fac_Image']; ?>" name="Fac_Image">
                </div> 
            </div>

            <div class="footer mt-3 text-center">
                <input type="Submit" class="btn btn-success" value="Update" name="update">
                <input type="Button" class="btn btn-danger" value="Back" onClick="history.back()">
            </div>
        </form>
    </div>
    <script>
        
        function validateForm() {
			const form = document.getElementById("Facregform");

			// Validate all name fields
			const nameFields = ["Fac_Name", "Fac_Father_Name", "Fac_Mother_Name"];
			for (let field of nameFields) {
				let name = form[field].value;
				if (!/^[A-Za-z\s-]+$/.test(name)) {
					alert("Names should only contain alphabets");
					return false;
				}
			}

			// Validate Mobile Numbers
			const mobileFields = ["Fac_Mob", "Fac_Father_No", "Fac_Mother_No"];
			for (let field of mobileFields) {
				let mobile = form[field].value;
				if (!/^\d{10}$/.test(mobile)) {
					alert("Please enter a valid 10-digit mobile number.");
					return false;
				}
			}

			// Validate Email
			let email = form["Fac_Email"].value;
			let emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
			if (!emailPattern.test(email)) {
				alert("Please enter a valid email address.");
				return false;
			}

			// Validate Aadhaar Number (12 digits)
			let aadhaar = form["Fac_ID_No"].value;
			if (!/^\d{12}$/.test(aadhaar)) {
				alert("Please enter a valid 12-digit Aadhaar Number.");
				return false;
			}

			// Validate CGPA
			let cgpa = form["CGPA"].value;
			if (!/^(10|[0-9](\.\d{1,2})?)$/.test(cgpa)) {
				alert("Please enter a valid CGPA between 0 and 10.");
				return false;
			}

			return true;
		}
    </script>
</body>
</html>
