<?php  
	session_start();
	if (!($_SESSION["LoginAdmin"] || $_SESSION["LoginTeacher"]))
	{
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}
	require_once "../connection/connection.php";
?>
<!-- --------------------------------Delete Student------------------------------------- -->
<?php 
	if (isset($_GET['Stud_ID'])) {
		$Stud_ID=$_GET['Stud_ID'];
		$query1="delete from student where Stud_ID='$Stud_ID'";
		$run1=mysqli_query($con,$query1);
		if ($run1) {
			echo "<script>alert('Successfully Deleted'); history.back();</script>";
		}
		else{
			echo "Record not deleted";
		}
	}
?>
<!-- --------------------------------Delete Company------------------------------------- -->
<?php 
	if (isset($_GET['C_ID'])) {
		$C_ID=$_GET['C_ID'];
		$query2="delete from Company where C_ID='$C_ID'";
		$run2=mysqli_query($con,$query2);
		if ($run2) {
			echo "<script>alert('Successfully Deleted'); history.back();</script>";
		}
		else{
			echo "Record not deleted";
		}
	}
?>

<!-- --------------------------------Delete Job------------------------------------- -->
<?php 
	if (isset($_GET['J_ID'])) {
		$J_ID=$_GET['J_ID'];
		$query3="delete from job where J_ID='$J_ID'";
		$run3=mysqli_query($con,$query3);
		if ($run3) {
			echo "<script>alert('Successfully Deleted'); history.back();</script>";
		}
		else{	
			echo "Record not deleted";
		}
	}
?>