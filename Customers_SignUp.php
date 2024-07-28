<?php
session_start();
include('connection.php');

if(isset($_POST['btnRegister'])) {
    $CustomerName = $_POST['txtCustomerName'];
    $CustomerEmail = $_POST['txtCustomerEmail'];
    $CustomerPw = $_POST['txtCustomerPw'];
    $CustomerPhone = $_POST['txtCustomerPhone'];
    $CustomerAddress = $_POST['txtCustomerAddress'];
    $CustomerCPassword = $_POST['txtConfirmPw'];

// Password Check
    $num = preg_match('@[0-9]@', $CustomerPw);
    $uppercase = preg_match('@[A-Z]@', $CustomerPw);
    $lowercase = preg_match('@[a-z]@', $CustomerPw);
    $specialChar = preg_match('@[^\w]@', $CustomerPw);

// Photo Insert
    $filePhotoName = $_FILES['txtCustomerPhoto']['name']; 
    $folder = "CustomerPhoto/"; 
    $fileName = $folder . '_' .  $filePhotoName; 

    $copy = copy($_FILES['txtCustomerPhoto']['tmp_name'], $fileName); 

    if(!$copy) {
        echo "There is something error in uploading photo.";
        exit();
    }
    else {
// Email already exists check
        $query = "SELECT * FROM Customers WHERE CustomerEmail = '$CustomerEmail'";
        $ret = mysqli_query($connection,$query);
        $count = mysqli_num_rows($ret);
        if($count>0) {
            echo "<script>window.alert('This email already exists.')</script>";
            echo "<script>window.location = 'Customers_SignUp.php' </script>";
        }
        else {
                // Password Check Condition
            if(strlen($CustomerPw) < 8 || strlen($CustomerPw) > 16 ) {
                echo "<script>window.alert('The password must have between 8 and 16 characters.')</script>";
            } 
            elseif(!$num) {
                echo "<script>window.alert('The password must have at least one number')</script>";
            }
            elseif(!$uppercase) {
                echo "<script>window.alert('The password must have at least one uppercase')</script>";
            }
            elseif(!$lowercase) {
                echo "<script>window.alert('The password must have at least one lowercase')</script>";
            }
            elseif(!$specialChar) {
                echo "<script>window.alert('The password must have at least one special character')</script>";
            }
            elseif($CustomerPw != $CustomerCPassword) {
                echo "<script>window.alert('Please confirm your password again.')</script>";
            }
            else {
                $Insert = "INSERT INTO Customers(CustomerName, CustomerEmail, CustomerPassword, CustomerPhone, CustomerAddress,  CustomerProfileImg)
                        VALUES ('$CustomerName', '$CustomerEmail', '$CustomerPw', '$CustomerPhone', '$CustomerAddress', '$fileName')";
                $ret=mysqli_query($connection,$Insert);

                if($ret) {
                    echo "<script>window.alert('Successfully Added')</script>";
                    echo "<script>window.location = 'Customers_SignUp.php' </script>";
                }
                else {
                    echo "<script>window.alert('Something is wrong. Please try again.')</script>";
                }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./Style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <title>Customer Sign Up</title>
</head>
<body>
    <div class="Card-Container">
            <div class="logoCus">
                <a href="./Customers_LandingPage">
                    <img src="./Images/Logo-removebg-preview.png"  alt="Cosmetics Photo">
                </a>
            </div>
            <div class="Card-cusLogin Card-cusSignUp">
                <form action="Customers_SignUp.php" method="post"  class="admFrmRegister" enctype="multipart/form-data"> <!-- photo is binary data -->
                    <h2>Sign-Up Here</h2>
                    <div class="admInputGroup">
                            <label for="">Full Name <span style="color: red;">*</span></label> <br>
                            <input type="text" name="txtCustomerName" placeholder="eg., Rosie" required>
                            <br><br>

                            <label for="">Email Address <span style="color: red;">*</span></label> <br>
                            <input type="email" name="txtCustomerEmail" placeholder="eg., example@gmail.com" required>
                            <br><br>
                        
                            <label for="">Password <span style="color: red;">*</span></label> <br>
                            <input type="password" name="txtCustomerPw" required> <br>
                            <small style="color: red;">
                                Your Password should have at least 8 characters, one Uppercase, one Lowercase and one Special Characters; ! @ # $ <br>
                            </small>
                            <br>
                            <label for="">Confirm your Password <span style="color: red;">*</span></label> <br>
                            <input type="password" name="txtConfirmPw" required>
                            <br><br>
                        <label for="">Phone Number <span style="color: red;">*</span></label> <br>
                        <input type="tel" name="txtCustomerPhone" placeholder="eg., 09*********" required>
                        <br><br>

                        <label for="">Profile Photo <span style="color: red;">*</span></label> <br>
                        <input type="file" name="txtCustomerPhoto" required>
                        <br><br>

                        <label for="">Full Address <span style="color: red;">*</span></label> <br>
                        <textarea name="txtCustomerAddress" cols="30" rows="10" required></textarea>
                        <br>

                    </div>
                    <div class="admBtnGroup">
                        <input style="width: 100%; margin-top:42px" class="btnFrmSubmit" type="submit" value="Register" name="btnRegister"> <br/>
                        <small style="text-align: center;">Already have an account? Please Login <a href="Customers_SignIn.php">Here.</a></small>
                    </div>
                </form>
                <br>
            </div>
            <br><br><br>
    </div>
<!-- <script src="./Serenity.js"></script>  -->
</body>

</html>