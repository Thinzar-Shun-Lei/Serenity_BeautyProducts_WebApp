<?php
session_start();
include('connection.php');

if(isset($_POST['btnLogIn'])) {
    $StaffEmail = $_POST['txtStaffEmail'];
    $StaffPw = $_POST['txtStaffPw'];
    
// Email already exists check
$query = "SELECT * FROM Staff WHERE StaffEmail = '$StaffEmail' AND StaffPassword = '$StaffPw'";
$ret = mysqli_query($connection,$query);
$count = mysqli_num_rows($ret);
$row = mysqli_fetch_array($ret);

if($count!=0) { //Session for reuse of Staff Information in Dashboard 
    $_SESSION['StaffID'] = $row['StaffID'];
    $_SESSION['StaffName'] = $row['StaffName'];
    $_SESSION['StaffPhoto'] = $row['StaffPhoto'];
    $_SESSION['PositionID'] = $row['PositionID'];
    $_SESSION['StaffPhone'] = $row['StaffPhone'];
    $_SESSION['StaffEmail'] = $row['StaffEmail'];
    $_SESSION['StaffAddress'] = $row['StaffAddress'];




    echo "<script>window.alert('Welcome from Serenity Cosmetics Shop')</script>";
    echo "<script>window.location = './Admin_LandingPage.php' </script>";
}
else {
    echo "<script>window.alert('The user does not exist.')</script>";
    echo "<script>window.location = 'Admin_SignIn.php' </script>";
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./Style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <title>Admin SignIn</title>
</head>
<body class="admBody">
    <nav class="nav">
        <div class="logoContainer">
            <img src="./Images/LogoJpeg.png" width="100px" height="100px" alt="Logo">
            <a href="#"><h1 class="logoText"><span>S</span>erenity</h1></a>
        </div>
    </nav>


    <div class="bodyContainer">
        <img src="./Images/SidePhoto_AdminLogin.jpg" alt="Cosmetics Photo">
            <div class="sideOptions">
                <form action="Admin_SignIn.php" method="post"  class="admFrmRegister">
                    <h2>Login Form</h2>
                    <div class="admInputGroup">

                        <label for="">Email Address <span style="color: red;">*</span></label> <br>
                        <input type="email" name="txtStaffEmail" placeholder="eg., example@gmail.com" required>
                        <br><br>

                        <label for="">Password <span style="color: red;">*</span></label> <br>
                        <input type="password" name="txtStaffPw" required>
                        <br>
                    </div>
                    <div class="admBtnGroup">
                            <input style="width: 100%; margin-top:42px" class="btnFrmSubmit" type="submit" value="Log In" name="btnLogIn"> <br/>
                            <small>Do not have an account? Please Register <a href="Admin_Register.php">Here.</a></small>
                    </div>
                </form>
            </div>
    </div>
<!-- <script src="./Serenity.js"></script>     -->
</body>
</html>