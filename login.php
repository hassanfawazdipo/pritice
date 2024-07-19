<?php include('connection.php'); 
session_start();
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashed_password = SHA1($password);

        $query = "SELECT * FROM users WHERE email='$email' AND password = '$hashed_password'";
        $result = mysqli_query($conn,$query);
        #check for an existing record from the Database

        $countUser = mysqli_num_rows($result);
        if($countUser !=0){
           $row=mysqli_fetch_array($result);
           $_SESSION['status'] = $row['status'];
           $_SESSION['id'] = $row['id'];
           $_SESSION['email'] = $row['email'];
           $_SESSION['username'] = $row['username'];

           if($_SESSION['status']==1){
                header('location: admin.php');
           } else{
                header('location: home.php ');
           }
        

           
        }else{
            echo 'E-MAIL / PASSWORD IS INCORRECT'.MYSQLI_error($conn);
        }


    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                margin: 0;
                padding: 0;
            }
    
            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }
    
            .container {
                max-width: 400px;
                margin: 50px auto;
                padding: 20px;
            }
    
            form {
                background-color: royalblue;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.5);
            }
    
            h2 {
                text-align: center;
                margin-bottom: 20px;
            }
    
            .form-group {
                position: relative;
                margin-bottom: 20px;
            }
    
            input {
                width: 100%;
                padding: 10px;
                border: none;
                border-bottom: 1px solid #ddd;
                background-color: transparent;
                transition: border-bottom-color 0.3s;
            }
    
            input:focus {
                outline: none;
                border-bottom-color:#ddd;
            }
    
            input::placeholder{
                color: whitesmoke;
            }
    
            button {
                width: 100%;
                padding: 10px;
                background: white;
                color: royalblue;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;
            }
    
            button:hover {
                background-color: whitesmoke;
            }
    
            .error {
                color: red;
                text-align: center;
            }
    
            .login{
                text-align: center;
            }
        </style>

    <body>
        <div class="container">
            <form action="" method="post"><br>
                <h2>LOGIN</h2>
                <input type="email" placeholder="Email" name="email"><br><br>
                <input type="password" placeholder="Password" name="password"><br><br>
                <button type="submit" name="login">Login</button><br><br>
                <p class="login">if you don't have an account register <a href="reg.php">REGISTER NOW</a></p>
            </form>
        </div>
    </body>

</html>