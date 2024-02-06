<?php
    session_start();
    if(isset($_SESSION['username'])){
        header("Location: welcome.php");
    }
?>
<?php
    include("connection.php");
    if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($conn, $_POST['user']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['pass']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpass']);
        
        $sql="select * from signup where username='$username'";
        $result = mysqli_query($conn, $sql);
        $count_user = mysqli_num_rows($result);

        $sql="select * from signup where email='$email'";
        $result = mysqli_query($conn, $sql);
        $count_email = mysqli_num_rows($result);

        if($count_user == 0 & $count_email==0){
            if($password==$cpassword){
               $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO signup (username, email, password) VALUES('$username', '$email', '$hash')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    header("Location: login.php");
                }
            }
            else{
                echo '<script>
                    alert("Passwords do not match");
                    window.location.href = "signup.php";
                </script>';
            }
        }
        else{
            if($count_user>0){
                echo '<script>
                    window.location.href="index.php";
                    alert("Username already exists!!");
                </script>';
            }
            if($count_email>0){
                echo '<script>
                    window.location.href="index.php";
                    alert("Email already exists!!");
                </script>';
            }
        }
        
    }
?>
<?php
    include("navbar.php");
?>   
<html>
    <head>
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    </head>
    <body>
     
<link rel="stylesheet" href="stylesheet.css">
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <title>Login-Form</title>
</head>

<body>
   
    <div class="container" id="home">
        <div class="login-left">
            <div class="login-header">
         
      
            <form name="form" action="signup.php" method="POST">
                <div class="login-content">
                    <div class="form-item"><br>
                        <label for="email">Username</label><br>
                        <input type="text" id="user" name="user" required><br>
                            
                     
                        <label for="email">Enter Email: </label><br>
                        <input type="email" id="email" name="email" required><br>
                      
                        <label for="password">Create Password: </label><br>
                        <input type="password" id="pass" name="pass" required><br>
                   
                        <label for="password">Retype Password: </label><br>
                        <input type="password" id="cpass" name="cpass" required><br><br></div></div>
                        <button type="submit" id="btn" value="SignUp" name = "submit">Sign up</button>
</div>
 </form>
 </div>
        <div class="login-right">
            <img src="signup.png" style="height: 410px; width: 400px;">
        </div>
    </div>
    </body>
</html>