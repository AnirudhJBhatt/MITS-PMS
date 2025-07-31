<?php
    if (isset($_SESSION["LoginAdmin"])) {
        $userid = $_SESSION["LoginAdmin"];
        $username = "MITS Placement Cell";
    } elseif (isset($_SESSION["LoginFaculty"])) {
        $Fac_ID=$_SESSION['LoginFaculty'];
        $query = "SELECT * FROM `faculty` WHERE `Fac_ID` = '$Fac_ID' ";
        $run = mysqli_query($con, $query);
        $res = mysqli_fetch_array($run);
        $username = $res['Fac_Name'];
    } elseif (isset($_SESSION["LoginStudent"])) {
        $Stud_ID=$_SESSION['LoginStudent'];
	    $query = "SELECT * FROM `student` WHERE `Stud_ID` = '$Stud_ID' ";
        $run = mysqli_query($con, $query);
        $res = mysqli_fetch_array($run);
        $username = $res['Stud_Name'];
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../Css/style.css">        
</head>
<body>
    <nav class="navbar navbar-expand-lg  navbar-dark header-back sticky-top">
        <a class="navbar-brand d-flex align-items-center" href="">
            <img src="../Images/cdc_mits_logo.png" class="logo-image bg-white" width="50" height="50">
            <h3 class="text-light text-uppercase ml-2">MITS PMS</h3>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" 
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item d-flex align-items-center me-3">
                    <span class="nav-link text-light text-uppercase disabled">
                        <?php echo $username; ?>
                    </span>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn" href="../login/logout.php">
                        <i class="bi bi-power" aria-hidden="true"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
        <!-- <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link btn" href="../login/logout.php">
                        <i class="bi bi-power" aria-hidden="true"></i>  Logout
                    </a>
                </li>
            </ul>
        </div> -->
    </nav>
</body>
</html>
