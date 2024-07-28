<?php
session_start();
include('connection.php');
include('ShoppingCart_func.php');

if(!isset($_SESSION['CustomerID'])) {
    echo "<script>window.alert('Please Login first')</script>";
    echo "<script>window.location='Customers_SignIn.php'</script>";
}

$cusID = $_SESSION['CustomerID'];
$cusName = $_SESSION['CustomerName'];
$cusPhone = $_SESSION['CustomerPhone'];
$cusEmail = $_SESSION['CustomerEmail'];

if(isset($_POST['btnSubmit'])) {
    $CustomerName = $_POST['txtCustomerName'];
    $CustomerEmail = $_POST['txtContactEmail'];
    $CustomerPhone= $_POST['txtContactPhone'];
    $ContactMessage= $_POST['txtContactMessage'];
    $CusID= $_POST['txtCusID'];


    $Insert = "INSERT INTO Contacts( CustomerName, ContactPhone, ContactEmail, ContactMessage, ContactStatus,  CustomerID)
                        VALUES ('$CustomerName', '$CustomerPhone', '$CustomerEmail', '$ContactMessage', 'Pending', '$CusID')";
    $ret=mysqli_query($connection,$Insert);

    if($ret) {
        echo "<script>window.alert('Successfully Added')</script>";
        echo "<script>window.location = 'Contact.php' </script>";
    }
    else {
        echo "<script>window.alert('Something is wrong. Please try again.')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./Style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <title>Contact Us</title>
</head>

<body class="cusBody">
    <nav class="navWholeContainer">
        <div class="logoLoginContainer">
            <div class="logoContainer">
                <img src="./Images/LogoJpeg.png" width="100px" height="100px" alt="Logo">
                <a href="./HomePage.php">
                    <h1 class="logoText"><span>S</span>erenity</h1>
                </a>
            </div>
            <div class="headerGrp">
                <div class="cartIcon">
                    <a href="./ShoppingCart.php">
                        <i class="fa fa-solid fa-basket-shopping"></i>
                    </a>
                    &nbsp; &nbsp;
                    <b>(<?php  echo CalculateTotalQuantity(); ?>)</b>
                </div>
                <!-- To be responsive login/out btn in small and large screen -->
                <div class="LogInBtn_LgScr">
                    <?php 
                        if( isset($_SESSION['CustomerID']) && !empty($_SESSION['CustomerID']) ) { ?>
                    <button class="cusLogInBtn" id="onClickLogout">
                        <a href="#" class="logBtn">Log Out</a>
                        <i class="fa fa-solid fa-arrow-right-from-bracket"></i>
                    </button>
                    <?php }else{ ?>
                    <button class="cusLogInBtn">
                        <a href="customers_SignIn.php" class="logBtn">Log In</a>
                        <i class="fa-solid fa-arrow-right-to-bracket loginIcon"></i>
                    </button>
                    <?php } ?>
                </div>
                <div class="LogInBtn_SmScr">
                    <?php if( isset($_SESSION['CustomerID']) && !empty($_SESSION['CustomerID']) ) { ?>
                    <button class="cusLogInBtn" id="onClickLogoutSm">
                        <a href="#" class="logBtn">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        </a>
                    </button>
                    <?php }else{ ?>
                    <button class="cusLogInBtn">
                        <a href="customers_SignIn.php" class="logBtn">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i>
                        </a>
                    </button>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="navMainContainer">
            <div class="navContents">
                <ul class="navUl">
                    <li>
                        <a href="HomePage.php">HOME</a>
                    </li>
                    <li>
                        <a href="About.php?">ABOUT</a>
                    </li>
                    <li>
                        <a href="Products_Catalog.php">PRODUCTS</a>
                    </li>
                    <li class="navActive">
                        <a href="Contact.php">CONTACT</a>
                    </li>
                    <li>
                        <a href="Reviews.php">REVIEWS</a>
                    </li>
                </ul>
                <div class="hamburger homeHamburger">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
                <ul class="dropdownMenu navUl homeDropdown">
                    <li>
                        <a href="HomePage.php">HOME</a>
                    </li>
                    <li>
                        <a href="About.php?">ABOUT</a>
                    </li>
                    <li>
                        <a href="Products_Catalog.php">PRODUCTS</a>
                    </li>
                    <li class="navActive">
                        <a href="Contact.php">CONTACT</a>
                    </li>
                    <li>
                        <a href="Reviews.php">REVIEWS</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Modal box -->
    <div id="modalBox" class="modal">
        <div class="modal-box">
            <div class="close">&times;</div>
            <br><br><br>
            <div class="modalGroup">
                <h3>Are you sure you want to log out?</h3>
                <br><br><br>
                <div class="modalBtnGroup">
                    <button class="cancel">Cancel</button>
                    <button class="confirm"><a href="./Customers_SignOut.php">Log out</a></button>
                </div>
            </div>
        </div>
    </div>

    <section>
        <div class="home_Flex">
            <form action="Contact.php" method="post" class="contactFrm">
                <h2>Contact Us</h2>
                <br>
                <div class="admInputGroup">
                    <input type="hidden" name="txtCusID" value="<?php echo $cusID; ?>" required>

                    <label for="">Full Name <span style="color: red;">*</span></label> <br>
                    <input type="text" name="txtCustomerName" value="<?php echo $cusName; ?>" required>
                    <br><br>

                    <label for="">Email Address <span style="color: red;">*</span></label> <br>
                    <input type="email" name="txtContactEmail" value="<?php echo $cusEmail; ?>" required>
                    <br><br>

                    <label for="">Contact Phone <span style="color: red;">*</span></label> <br>
                    <input type="text" name="txtContactPhone" value="<?php echo $cusPhone; ?>" required> <br>
                    <br><br>

                    <label for="">Message <span style="color: red;">*</span></label> <br>
                    <textarea name="txtContactMessage" cols="30" rows="10" required></textarea>
                    <br>

                    <div class="admBtnGroup">
                        <input style="width: 100%; margin-top:42px" class="btnFrmSubmit" type="submit" value="Submit"
                            name="btnSubmit"> <br />
                    </div>
                </div>
            </form>
            <div class="contactInfoGrp">
                <div class="contactInfo">
                    <h3>
                        <span>
                            <i class="fa fa-solid fa-shop"></i>
                        </span>
                        Shop Address
                    </h3>
                    <br>
                    <p>3rd Floor, Mingalar Market, Set Yone Road, Yangon</p>
                </div>
                <br><br>
                <div class="contactInfo">
                    <h3>
                        <span>
                            <i class="fa fa-solid fa-envelope"></i>
                        </span>
                        Email Address
                    </h3>
                    <br>
                    <span>
                        <a href="mailto:UTinMaung@gmail.com.com">UTinMaung@gmail</a>
                    </span>
                </div>
                <br><br>
                <div class="contactInfo">
                    <h3>
                        <span>
                            <i class="fa fa-solid fa-phone-volume"></i>
                        </span>
                        Phone Number
                    </h3>
                    <br>
                    <span>
                        <a href="tel:+959876543212">+959876543212</a>
                    </span>
                </div>
            </div>
        </div>

    </section>

    <footer>
        <div class="footerRow">
            <div class="footerCol">
                <img src="./Images/LogoJpeg.png" width="100px" height="100px" alt="Logo">
                <a href="./HomePage.php">
                    <h1 class="footerLogo"><span>S</span>erenity</h1>
                </a>
            </div>
            <div class="footerCol">
                Serenity &copy; All Rights Reserved 2023 
                <!-- <br>
                For an Educational Purpose -->
            </div>
            <div class="footerColRow">
                <a href="./PrivacyPolicy.php" class="footerLink">Privacy Policy</a>
                <a href="./Terms.php" class="footerLink">Terms & Conditions</a>
                <a href="Contact.php" class="footerLink">Contact Us</a>
            </div>
            <div class="footerCol">

                <a href="https://www.facebook.com/" class="footerIcon"><i class="fa fa-brands fa-facebook"></i></a>
                <a href="https://www.youtube.com/" class="footerIcon"><i class="fa-brands fa-youtube "
                        id="iconYoutube"></i></a>
                <a href="https://www.linkedin.com/" class="footerIcon"><i class="fa-brands fa-linkedin"></i></a>
                <a href="https://www.twitter.com/" class="footerIcon"><i class="fa-brands fa-twitter"></i></a>
            </div>
        </div>
    </footer>
    <script src="./Serenity.js"></script>
    <!-- <script src="./Serenity_1.js"></script> -->
    <script src="./modalBox.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>