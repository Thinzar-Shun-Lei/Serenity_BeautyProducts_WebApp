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
    <title>Reviews</title>
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
                    <li>
                        <a href="Contact.php">CONTACT</a>
                    </li>
                    <li class="navActive">
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
                    <li>
                        <a href="Contact.php">CONTACT</a>
                    </li>
                    <li class="navActive">
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
        <div class="reviewHeader">
            <h2>Your Reviews are Important !</h2><br><br>
            <button>
                <a href="Products_Catalog.php">
                    REVIEW NOW !
                </a>
            </button>
        </div>
        <div class="reviewCardContainer">
            <?php
            $query="SELECT * FROM Reviews r, Products p, Customers c
            WHERE r.ProductID = p.ProductID
            AND r.CustomerID = c.CustomerID";
            
            $result=mysqli_query($connection,$query);
            $count = mysqli_num_rows($result);
            if($count>0) {
            
                for ($i=0; $i < $count; $i+=30) { 
                    $query1 = "SELECT * FROM Reviews r, Products p, Customers c
                    WHERE r.ProductID = p.ProductID
                    AND r.CustomerID = c.CustomerID
                    LIMIT $i,30";// col 3 hti pl moz
                    
                    $ret1=mysqli_query($connection,$query1);
                    $count1 = mysqli_num_rows($ret1);

                    for ($j=0; $j < $count1; $j++) { 
                        $row2 = mysqli_fetch_array($ret1);
                                $reviewID = $row2['ReviewID'];
                                $productID = $row2['ProductID'];
                                $ProductName = $row2['ProductName'];
                                $ProductImage = $row2['Image1'];
                                $CustomerName = $row2['CustomerName'];
                                $CusProfile = $row2['CustomerProfileImg'];
                                $rating = $row2['Rating'];
                                $rDescription = $row2['ReviewDescription'];        

                        ?>

            <div class="reviewCard">
                <div class="reviewLine">
                    <div class="ratingGrp">
                        <input type="hidden" value="<?php echo $productID; ?>">
                        <?php
                            if($rating == 5) { ?>
                                <i class="fa fa-solid fa-star fullStar"></i>
                                <i class="fa fa-solid fa-star fullStar"></i>
                                <i class="fa fa-solid fa-star fullStar"></i>
                                <i class="fa fa-solid fa-star fullStar"></i>
                                <i class="fa fa-solid fa-star fullStar"></i>
                            <?php }
                            elseif ($rating == 4) { ?>
                                <i class="fa fa-solid fa-star fullStar"></i>
                                <i class="fa fa-solid fa-star fullStar"></i>
                                <i class="fa fa-solid fa-star fullStar"></i>
                                <i class="fa fa-solid fa-star fullStar"></i>
                                <i class="fa fa-regular fa-star noStar"></i>
                            <?php }
                            elseif ($rating == 3) { ?>
                                <i class="fa fa-solid fa-star fullStar"></i>
                                <i class="fa fa-solid fa-star fullStar"></i>
                                <i class="fa fa-solid fa-star fullStar"></i>
                                <i class="fa fa-regular fa-star noStar"></i>
                                <i class="fa fa-regular fa-star noStar"></i>
                            <?php }
                            elseif ($rating == 2) { ?>
                                <i class="fa fa-solid fa-star fullStar"></i>
                                <i class="fa fa-solid fa-star fullStar"></i>
                                <i class="fa fa-regular fa-star noStar"></i>
                                <i class="fa fa-regular fa-star noStar"></i>
                                <i class="fa fa-regular fa-star noStar"></i>
                            <?php }
                            elseif ($rating == 1) { ?>
                                <i class="fa fa-solid fa-star"></i>
                                <i class="fa fa-regular fa-star noStar"></i>
                                <i class="fa fa-regular fa-star noStar"></i>
                                <i class="fa fa-regular fa-star noStar"></i>
                                <i class="fa fa-regular fa-star noStar"></i>
                            <?php }
                            elseif ($rating == 0) { ?>
                                <i class="fa fa-regular fa-star noStar"></i>
                                <i class="fa fa-regular fa-star noStar"></i>
                                <i class="fa fa-regular fa-star noStar"></i>
                                <i class="fa fa-regular fa-star noStar"></i>
                                <i class="fa fa-regular fa-star noStar"></i>
                            <?php }
                        ?>
                    </div>
                    <div class="cusRow">
                        <h4>
                            <?php echo $CustomerName; ?>
                        </h4> &nbsp; &nbsp;
                        <img src="<?php echo $CusProfile; ?>" width="40px" height="40px" style="border-radius: 50%;"
                            alt="Customer Image">
                    </div>
                </div>
                <br><br>
                <!-- <hr style="width: 60%; align-self: center;"> -->
                <div class="reviewLine">
                    <h4 style="width: 60%;">
                        <?php echo $ProductName; ?>
                    </h4> &nbsp; &nbsp;
                    <img src="<?php echo $ProductImage; ?>" width="75px" height="75px" style="border-radius: 8px;"
                        alt="Customer Image">
                </div>
                <br>
                <!-- <hr style="width: 60%; align-self: center;"> -->
                <div class="reviewLine">
                    <div class="desRow">
                        <h4>Description</h4> &nbsp; &nbsp;
                        <br>
                        <i>
                            <?php echo $rDescription; ?>
                        </i>
                    </div>
                </div>
                <br>
                <!-- <hr style="width: 60%; align-self: center;"> -->
                <div class="iconView">
                    <a href="Products_Details.php?PID=<?php echo $productID; ?>">
                        <i class="fa fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <?php  }}}
                                ?>
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
                <a href="./Policy.php" class="footerLink">Privacy Policy</a>
                <a href="./Policy.php" class="footerLink">Terms & Conditions</a>
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