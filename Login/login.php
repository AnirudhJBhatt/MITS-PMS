<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MITS-PMS Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #eeeeee;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-container img {
            max-width: 300px;
            margin-bottom: auto;
        }

        .login-container h2 {
            margin: 20px 0;
            font-weight: bold;
            color: #d32f2f;
        }

        .login-container form {
            margin-top: 20px;
        }

        .form-floating label {
            color: #6c757d;
        }

        .form-floating input {
            border-radius: 0.25rem;
        }

        .login-container .btn-login {
            width: 100%;
            margin-top: 20px;
            padding: 10px;
            font-size: 16px;
        }

        .login-container .forgot-password {
            margin-top: 15px;
            font-size: 0.9rem;
        }

        .login-container .forgot-password a {
            text-decoration: none;
            color: #6c757d;
        }

        .login-container .forgot-password a:hover {
            text-decoration: underline;
            color: #d32f2f;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <img src="../Images/Mits Logo.png" alt="MITS Logo">
        <form action="" method="POST">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
                <label for="username">Username</label>
            </div>
            <div class="form-floating mb-3 position-relative">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
                <button type="button" class="btn btn-outline-secondary btn-sm position-absolute top-50 end-0 translate-middle-y" id="togglePassword" aria-label="Show password" style="border: none; background: none;">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </button>
            </div>
            <button type="submit" name="submit" class="btn btn-success btn-login">Login</button>
            <div class="forgot-password">
                <a href="#">Forgot password?</a>
            </div>
        </form>
    </div>
</body>
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const passwordFieldType = passwordField.getAttribute('type');
        const icon = this.querySelector('i');
        
        if (passwordFieldType === 'password') {
            passwordField.setAttribute('type', 'text');
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        } else {
            passwordField.setAttribute('type', 'password');
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        }
    });
</script>

</html>
<?php 
    session_start();
    require_once "../connection/connection.php"; 
    $message="Username Or Password Does Not Match";
    if(isset($_POST["submit"]))
    {
        $username=$_POST["username"];
        $password=$_POST["password"];
        $query="select * from login where user_id='$username' and Password='$password' ";
        $result=mysqli_query($con,$query);
        if (mysqli_num_rows($result)>0) {
            while ($row=mysqli_fetch_array($result)) {
                if ($row["Role"]=="Admin")
                {
                    $_SESSION['LoginAdmin']=$row["ID"];
                    header('Location: ../admin/admin-index.php');
                }
                else if ($row["Role"]=="Faculty" and $row["account"]=="Activate")
                {
                    $_SESSION['LoginFaculty']=$row['user_id'];
                    header('Location: ../faculty/faculty-index.php');
                }
                else if ($row["Role"]=="Company" and $row["account"]=="Activate")
                {
                    $_SESSION['LoginCompany']=$row["user_id"];
                    header('Location: ../company/company-index.php');
                }
                else if ($row["Role"]=="Student" and $row["account"]=="Activate")
                {
                    $_SESSION['LoginStudent']=$row['user_id'];
                    header('Location: ../student/student-index.php');
                }
                
            }
        }
        else
        { 
            echo "<script>alert('Inavlid Credentials');</script>";
        }
    }
?>
