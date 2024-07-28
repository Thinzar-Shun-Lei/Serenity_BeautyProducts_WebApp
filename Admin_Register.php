<?php
session_start();
include('connection.php');

if(isset($_POST['btnRegister'])) {
    $StaffName = $_POST['txtStaffName'];
    $StaffPosition = $_POST['cboPositionID'];
    $StaffEmail = $_POST['txtStaffEmail'];
    $StaffPw = $_POST['txtStaffPw'];
    $StaffPhone = $_POST['txtStaffPhone'];
    $StaffAddress = $_POST['txtStaffAddress'];
    $StaffCPassword = $_POST['txtConfirmPw'];

// Password Check
    $num = preg_match('@[0-9]@', $StaffPw);
    $uppercase = preg_match('@[A-Z]@', $StaffPw);
    $lowercase = preg_match('@[a-z]@', $StaffPw);
    $specialChar = preg_match('@[^\w]@', $StaffPw);

// Photo Insert
    $filePhotoName = $_FILES['txtStaffPhoto']['name']; //staff.jpg , file name, 'name' is fixed
    $folder = "StaffPhoto/"; //folder name
    $fileName = $folder . '_' .  $filePhotoName; //StaffPhoto/_staff.jpg //store in database

    $copy = copy($_FILES['txtStaffPhoto']['tmp_name'], $fileName); //'tmp_name' is fixed,  source, dest_file

    if(!$copy) {
        echo "There is something error in uploading photo.";
        exit();
    }
    else {
// Email already exists check
        $query = "SELECT * FROM Staff WHERE StaffEmail = '$StaffEmail'";
        $ret = mysqli_query($connection,$query);
        $count = mysqli_num_rows($ret);
        if($count>0) {
            echo "<script>window.alert('This email already exists.')</script>";
            echo "<script>window.location = 'Admin_Register.php' </script>";
        }
        else {
                // Password Check Condition
            if(strlen($StaffPw) < 8 || strlen($StaffPw) > 16 ) {
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
            elseif($StaffPw != $StaffCPassword) {
                echo "<script>window.alert('Please confirm your password again.')</script>";
            }
            else {
                $Insert = "INSERT INTO Staff(PositionID, StaffName, StaffPhone, StaffAddress, StaffEmail, StaffPassword, StaffPhoto)
                        VALUES ('$StaffPosition','$StaffName', '$StaffPhone', '$StaffAddress', '$StaffEmail', '$StaffPw', '$fileName')";
                $ret=mysqli_query($connection,$Insert);

                if($ret) {
                    echo "<script>window.alert('Successfully Added')</script>";
                    echo "<script>window.location = 'Admin_SignIn.php' </script>";
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
    <title>Admin Registration</title>
</head>
<body>
    <nav class="nav">
        <div class="logoContainer">
            <img src="./Images/LogoJpeg.png" width="100px" height="100px" alt="Logo">
            <a href="#"><h1 class="logoText"><span>S</span>erenity</h1></a>
        </div>
    </nav>



    <div class="bodyContainer">
        <img src="./Images/AdmRegister.jpg" alt="Cosmetics Photo">
            <div class="sideOptions">
                <form action="Admin_Register.php" method="post"  class="admFrmRegister" enctype="multipart/form-data"> <!-- photo is binary data -->
                    <h2>Registration Form</h2>
                    <div class="admInputGroup">
                        <label for="">Full Name <span style="color: red;">*</span></label> <br>
                        <input type="text" name="txtStaffName" placeholder="eg., U Thant Sin" required>
                        <br><br>

                        <label for="">Position <span style="color: red;">*</span></label> <br>
                        <select name="cboPositionID" class="cboPosition">
                            <option>Choose Position</option>
                            <?php
                                $query = "SELECT * FROM Positions";
                                $ret = mysqli_query($connection,$query);
                                $count = mysqli_num_rows($ret);

                                for ($i=0; $i < $count ; $i++) { 
                                    $row = mysqli_fetch_array($ret);
                                    $positionID = $row['PositionID'];
                                    ?>
                                        <option value="<?php echo $positionID ?>"><?php echo $row['PositionID']. " - " .$row['PositionName']; ?></option>
                                    <?php
                                }

                            ?>
                        </select>
                        <br><br>

                        <label for="">Email Address <span style="color: red;">*</span></label> <br>
                        <input type="email" name="txtStaffEmail" placeholder="eg., example@gmail.com" required>
                        <br><br>

                        <label for="">Password <span style="color: red;">*</span></label> <br>
                        <input type="password" name="txtStaffPw" required> <br>
                        <small style="color: red;">
                            Your Password should have at least 8 characters, one Uppercase, one Lowercase and one Special Characters; ! @ # $ <br>
                        </small>
                        <br>
                        <label for="">Confirm your Password <span style="color: red;">*</span></label> <br>
                        <input type="password" name="txtConfirmPw" required>
                        <br><br>

                        <label for="">Phone Number <span style="color: red;">*</span></label> <br>
                        <input type="tel" name="txtStaffPhone" placeholder="eg., 09*********" required>
                        <br><br>

                        <label for="">Profile Photo <span style="color: red;">*</span></label> <br>
                        <input type="file" name="txtStaffPhoto" required>
                        <br><br>

                        <label for="">Full Address <span style="color: red;">*</span></label> <br>
                        <textarea name="txtStaffAddress" cols="30" rows="10" required></textarea>
                        <br>

                    </div>
                    <div class="admBtnGroup">
                        <input style="width: 100%; margin-top:42px" class="btnFrmSubmit" type="submit" value="Register" name="btnRegister"> <br/>
                        <small style="text-align: center;">Already have an account? Please Login <a href="Admin_SignIn.php">Here.</a></small>
                    </div>
                </form>
            </div>
    </div>
<!-- <script src="./Serenity.js"></script>  -->
</body>

</html>