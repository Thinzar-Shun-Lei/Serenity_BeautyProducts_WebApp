<?php
session_start();
include('connection.php');

if(isset($_POST['btnLogIn'])) {
    $CustomerEmail = $_POST['txtCustomerEmail'];
    $CustomerPw = $_POST['txtCustomerPw'];
    
// Email already exists check
$query = "SELECT * FROM Customers WHERE CustomerEmail = '$CustomerEmail' AND CustomerPassword = '$CustomerPw'";
$ret = mysqli_query($connection,$query);
$count = mysqli_num_rows($ret);
$row = mysqli_fetch_array($ret);

if($count!=0) { //Session for reuse of Customer Information in Dashboard 
    $_SESSION['CustomerID'] = $row['CustomerID'];
    $_SESSION['CustomerName'] = $row['CustomerName'];
    $_SESSION['CustomerPhoto'] = $row['CustomerProfileImg'];
    $_SESSION['CustomerPhone'] = $row['CustomerPhone'];
    $_SESSION['CustomerEmail'] = $row['CustomerEmail'];
    $_SESSION['CustomerAddress'] = $row['CustomerAddress'];

    echo "<script>window.alert('Welcome from Serenity Cosmetics Shop')</script>";
    echo "<script>window.location = './HomePage.php' </script>";
}
else {
    echo "<script>window.alert('The user does not exist.')</script>";
    echo "<script>window.location = 'Customers_SignIn.php' </script>";
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
    <title>Customer Sign In</title>
</head>
<body class="admBody">
    <div class="Card-Container">
            <div class="logoCus">
                <a href="./HomePage.php">
                    <img src="./Images/Logo-removebg-preview.png"  alt="Cosmetics Photo">
                </a>
            </div>
            <div class="Card-cusLogin">
                <form action="Customers_SignIn.php" method="post"  class="admFrmRegister">
                    <h2>Login Here</h2>
                    <div class="admInputGroup">
                        <label for="">Email Address <span style="color: red;">*</span></label> <br>
                        <input type="email" name="txtCustomerEmail" placeholder="eg., example@gmail.com" required>
                        <br><br>

                        <label for="">Password <span style="color: red;">*</span></label> <br>
                        <input type="password" name="txtCustomerPw" required>
                        <br>
                    </div>
                    <div class="admBtnGroup">
                            <input style="width: 100%; margin-top:42px" class="btnFrmSubmit" type="submit" value="Log In" name="btnLogIn"> <br/>
                            <small>Do not have an account? Please Register <a href="Customers_SignUp.php">Here.</a></small>
                    </div>
                    <br>
                </form>
            </div>
    </div>
<!-- <script src="./Serenity.js"></script>     -->
</body>
</html>