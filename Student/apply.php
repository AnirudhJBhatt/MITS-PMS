<!---------------- Session starts form here ----------------------->
 <?php  
	session_start();
	if (!$_SESSION["LoginStudent"]){
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}
	require_once "../connection/connection.php";
	$Stud_ID=$_SESSION['LoginStudent'];
?>
<!---------------- Session Ends form here ------------------------>
<?php
    $D_ID=$_GET['D_ID'];
    $query="INSERT INTO `application`(`S_ID`, `D_ID`) VALUES ('$Stud_ID','$D_ID')";
    $run=mysqli_query($con,$query);
    if($run){
		header('Location: student-drive.php');
    }
	else{
		echo $query;
	}
    
?>