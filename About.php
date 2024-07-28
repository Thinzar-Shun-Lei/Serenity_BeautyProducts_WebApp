<?php
session_start();
include('connection.php');
include('ShoppingCart_func.php');

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
    <title>About Us</title>
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
                    <li class="navActive">
                        <a href="About.php?">ABOUT</a>
                    </li>
                    <li>
                        <a href="Products_Catalog.php">PRODUCTS</a>
                    </li>
                    <li>
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
                    <li class="navActive">
                        <a href="About.php?">ABOUT</a>
                    </li>
                    <li>
                        <a href="Products_Catalog.php">PRODUCTS</a>
                    </li>
                    <li>
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
        <div class="abt-Bg"></div>
        <div class="bg-text">
            <h2>Welcome to Serenity</h2>
            <br>
            <p>We offer our customers at a reasonable price with superior customer service.</p>
        </div>
        <div>
            <div class="home_Flex">
                <div class="home_FlexText">
                    <h1>ABOUT US ?</h1>
                    <br>
                    <p>Serenity, cosmetics and beauty aids, is a beloved mid-sized cosmetic shop nestled within the
                        vibrant
                        Mingalar Market.
                        With nearly two decades of operation, Serenity has become a cornerstone of the local community,
                        offering
                        a wide array of cosmetic products to meet the diverse needs of its loyal clientele.</p>
                </div>
                <div class="home_FlexImg">
                    <img src="./Images/ImageAbout.png" alt="A model wearing lipstick">
                </div>
            </div>
            <div class="home_Flex">
                <div class="home_FlexImg">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3819.6784833272036!2d96.17094147449916!3d16.792664283996587!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1ed43b1d0a4e5%3A0xaa92055b69e3f7!2sMingalar%20Market!5e0!3m2!1sen!2smm!4v1712939759718!5m2!1sen!2smm"
                        width="400" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="home_FlexText">
                    <h1>Discover Serenity: Your Destination for Beauty Essentials in Mingalar Market, Yangon</h1>
                    <br>
                    <p>Welcome to Serenity Cosmetics, nestled within the bustling Mingalar Market, one of the most
                        renowned markets in Yangon, Myanmar. Founded nearly two decades ago by the visionary
                        entrepreneur U Thant Sin, Serenity has become
                        a cherished destination for beauty enthusiasts seeking quality cosmetics and
                        skincare essentials.</p>
                </div>
            </div>

        </div>

        <br>
        <div class="membersBox">
            <h2>Our Members</h2>
            <div class="membersContainer">
                <div class="memberCard">
                    <img src="./Images/UTinMaungProfile.jpg" alt="U Tin Maung Photo">
                    <br>
                    <div class="memberText">
                        <h3>U Tin Maung</h3><br>
                        <p>Inventory Control Manager</p>
                        <br>
                        <span>
                            <i class="fa-solid fa-envelope"></i> &nbsp;
                            <a href="mailto:UTinMaung@gmail.com.com">UTinMaung@gmail</a>
                        </span>
                    </div>
                </div>
                <div class="memberCard">
                    <img src="./Images/UThantSinProfile.jpg" alt="U Tin Maung Photo">
                    <br>
                    <div class="memberText">
                        <h3>U Thant Sin</h3><br>
                        <p>Inventory Control Manager</p>
                        <br>
                        <span>
                            <i class="fa-solid fa-envelope"></i> &nbsp;
                            <a href="mailto:UThantSin@gmail.com">UThantSin@gmail.com</a>
                        </span>
                    </div>
                </div>
                <div class="memberCard">
                    <img src="./Images/DawAyeMyintProfile.jpg" alt="U Tin Maung Photo">
                    <br>
                    <div class="memberText">
                        <h3>Daw Aye Myint</h3><br>
                        <p>Sales and Customer Service Manager</p>
                        <br>
                        <span>
                            <i class="fa-solid fa-envelope"></i> &nbsp;
                            <a href="mailto:DawAyeMyint@gmail.com">DawAyeMyint@gmail.com</a>
                        </span>
                    </div>
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
            <!-- <br> For an Educational Purpose -->
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

</body>

</html>