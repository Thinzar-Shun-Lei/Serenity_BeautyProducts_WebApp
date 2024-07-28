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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <title>Home Page</title>
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
                    <li class="navActive">
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
                        <a href="HomePage.php" class="navActive">HOME</a>
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

    <!-- Slideshow -->
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="./Images/Image1_1.png" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="./Images/Image2.png" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="./Images/Image3.png" alt="Third slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="./Images/Image4.png" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <section>
        <div class="home_Flex">
            <div class="home_FlexText">
                <p>
                    Step into the world of beauty and indulge your senses with our exquisite range of cosmetics.
                    From luxurious skincare essentials to vibrant makeup palettes, our collection is meticulously
                    curated to cater to
                    every aspect of your beauty routine.
                </p>
            </div>
            <div class="home_FlexImg">
                <img src="./Images/ImageHome6.png" alt="A model wearing lipstick">
            </div>
        </div>
        <div class="home_Flex">
            <div class="home_FlexImg">
                <img src="./Images/ImageHome5.1.png" alt="Eyeshadow palettes">
            </div>
            <div class="home_FlexText home_FlexText2">
                <p>
                    Discover the transformative power of high-quality products that enhance your
                    natural radiance and empower you to express your unique style with confidence.
                </p>
                <br><br>
                <button class="home_FlexBtn">
                    <a href="./Products_Catalog.php" class="shopNow">
                        SHOP NOW
                    </a>
                </button>
            </div>
        </div>
    </section>

    <br><br>
    <!-- Products Display -->
    <!-- Change css design into card -->
    <section>
        <div class="Brand_Heading">
            <h2>Popular Products</h2>
        </div>
        <div class='PCardContainer'>
            <?php
                        $query1="SELECT * FROM Products
                                WHERE ProductStatus = 'Popular'";
                        $result1=mysqli_query($connection,$query1);
                        $count1 = mysqli_num_rows($result1);

                        if($count1==0) {
                            echo "<p>Popular Products cannot be available.</p>";
                        }
                        else {
                            for ($i=0; $i < $count1; $i+=4) { 
                                $query1 = "SELECT * FROM Products
                                           WHERE ProductStatus = 'Popular' 
                                           LIMIT $i,4"; 
                                $ret1=mysqli_query($connection,$query1);
                                $count1=mysqli_num_rows($ret1);

                                for ($j=0; $j < $count1 ; $j++) { 
                                    $row1 = mysqli_fetch_array($ret1);
                                   
                                    $ProductImage = $row1['Image2'];
                                    $ProductName = $row1['ProductName'];
                                    $Price = $row1['SellPrice'];

                                ?>
            <div class="BrandContainer">
                <img src="<?php echo $ProductImage ?>" class="img_Popular" alt="Popular Product Image"><br>
                <h3><?php echo $ProductName; ?></h3>
                <p>Price : <?php echo $Price; ?> MMK</p>
                <br>
                <div class="btn_More">
                    <a href="Products_Catalog.php">More</a>
                    <i class="fa fa-solid fa-arrow-right"></i>
                </div>
            </div>

            <?php
                                }
                            }
                        }
                    ?>
        </div>
    </section>

    <br>
    <!-- Brands Display -->
    <section>
        <div class="Brand_Heading">
            <h2>Available Brands</h2>
        </div>
        <div class='PCardContainer'>
            <?php
                        $query="SELECT * FROM Brands";
                        $result=mysqli_query($connection,$query);
                        $count = mysqli_num_rows($result);

                        if($count==0) {
                            echo "<p>Brands cannot be available.</p>";
                        }
                        else {
                            for ($i=0; $i < $count; $i+=2) { //for row, 1row mhr 2pon paw chin loc ,, p, pitchtypes pt WHERE pt.PitchTypeID = p.PitchTypeID
                                $query1 = "SELECT * FROM Brands b LIMIT $i,2"; //apaw query nk name ma tuu ag, $i, anouk mhr apaw ka limit loke htr dk hr htae
                                $ret1=mysqli_query($connection,$query1);
                                $count1=mysqli_num_rows($ret1);

                                for ($j=0; $j < $count1 ; $j++) { //for col, 1khu p 1khu swal htoke
                                    $row2 = mysqli_fetch_array($ret1);
                                   
                                    $BrandImage = $row2['BrandImage'];
                                    $BrandName = $row2['BrandName'];
                                ?>
            <div class="BrandContainer">
                <img src="<?php echo $BrandImage ?>" class="img_Brand" width="120px" height="120px"
                    alt="Brand Logo"><br>
                <h3><?php echo $BrandName; ?></h3>
            </div>

            <?php
                                }
                            }
                        }
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