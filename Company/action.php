<!---------------- Session starts form here ----------------------->
<?php  
	session_start();
	if (!$_SESSION["LoginCompany"])
	{
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}
		require_once "../connection/connection.php";
	?>
<!---------------- Session Ends form here ------------------------>
<?php 
	if(isset($_GET['App_ID'])){
        $App_ID=$_GET['App_ID'];
        $App_Status=$_GET['App_Status'];
        $query="UPDATE `application` SET `App_Status`='$App_Status' WHERE `App_ID`='$App_ID'";
        $run=mysqli_query($con,$query);
        if($run){
            header('Location: company-applicants.php');
        }
    }
?>
