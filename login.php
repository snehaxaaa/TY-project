<?php
    session_start();
    if(isset($_SESSION['username'])){
        header("Location: welcome.php");
    }
?>
<?php
    $login = false;
    include('connection.php');
    if (isset($_POST['submit'])) {
        $username = $_POST['user'];
        $password = $_POST['pass'];
        echo $password;
        $sql = "select * from signup where username = '$username'or email = '$username'";  
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
        
        if($row){  
            echo $count;

            if(password_verify($password, $row["password"])){
                $login=true;
                session_start();

                $sql = "select username from signup where username = '$username'or email = '$username'";     
                $r = mysqli_fetch_array(mysqli_query($conn, $sql), MYSQLI_ASSOC);  

                $_SESSION['username']= $r['username'];
                $_SESSION['loggedin'] = true;
                header("Location: welcome.php");
            }
        } 
        
        else{  
            echo  '<script>
                        
                        alert("Login failed. Invalid username or password!!")
                        window.location.href = "login.php";
                    </script>';
        }     
    }
    ?>
    <?php 
    include("connection.php");
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
         
            </div>
            <form name="form" action="login.php" method="POST" required>
                <div class="login-content">
                    <div class="form-item"><br><br><br>
                        <label for="email">Username</label><br>
                        <input type="text" id="user" name="user">
                       
              
                        <div class="form-item">
                        <label for="password">Password</span></label>
                        <label for="text"></label>
                        <input type="password" id="pass" name="pass" required></br></br>
                        <button type="submit" id="btn" value="Login" name = "submit">LogIn</button>
                    
                        <!-- <span class="show">Show</span> -->
                    </div>
                    </div>
                   
                </div>
              
            </form>
        </div>
     
        <img src="adoptpet.jpg" style="height: 500px; width: 500px;">
        </div>
    </div>
    
</body>

</html>
        <script>
            function isvalid(){
                var user = document.form.user.value;
                if(user.length==""){
                    alert(" Enter username or email id!");
                    return false;
                }
                
            }
        </script>
    </body>
</html>