<?php
include("connection.php");
session_start();

$usernameerror = $emailerror  = $passworderror = $confirmpassworderror = "";
$msg = '';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = SHA1($password);
    $confirmpassword = $_POST['confirmpassword'];


    // Validation
    if (empty($username)) {
        $lastnameerror = 'Last name is required';
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
        $usernameerror = "Only letters and white space allowed";
    } elseif (empty($email)) {
        $emailerror = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailerror = 'Invalid email format';
    } elseif (empty($password)) {
        $passworderror = 'Password is required';
    } elseif ($password != $confirmpassword) {
        $confirmpassworderror = 'Password Mismatch';
    } else {
        $check_duplicate = "SELECT email FROM users WHERE email='$email'";
        $query = mysqli_query($conn, $check_duplicate);
        $count = mysqli_num_rows($query);

        if($count != 0){
            $msg = 'User Already Exist in our Database, Use another Email and Try Again!';
        }else{
            $query = "INSERT INTO users(username,email,password)VALUES('$username','$email', '$hashed_password')";
            $result = mysqli_query($conn, $query);

            header('location: login.php');

            if ($conn) {
                echo "you are now a user";
            } else {
                echo "something went wrong";
            }

     }
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
            <form action="" method="post">
                <h2>Registration Form</h2>
                
                <p>
                    <input type="text" placeholder="Username" name="username" id="username">
                <p class="error"><?php echo $usernameerror; ?></p>
                </p>
                <br>
                <p>
                    <input type="email" placeholder="Email" name="email" id="email">
                <!-- <p class="error"><?php echo $emailerror; ?></p> -->
                <!-- <p class="error"><?php echo $emailerr; ?></p> -->
                </p>
                <br>
                <p>
                    <input type="password" placeholder="Password" name="password" id="password">
                <!-- <p class="error"><?php echo $passworderror; ?></p> -->
                </p>
                <br>
                <p>
                    <input type="password" placeholder="Confirm Password" name="confirmpassword" id="confirmPassword">
                <!-- <p class="error"><?php echo $confirmpassworderror; ?></p> -->
                </p>
                <br>
                <P class="login">by registering you have accetped our <a href="terms.php">terms and condition</a></P>
                <br>
                <button type="submit" name="register">Register</button>
                <br><br>
                <p class="login">you already have an account <a href="login.php">LOGIN</a></p>
                <br>
            </form>
        </div>
    </body>

</html>