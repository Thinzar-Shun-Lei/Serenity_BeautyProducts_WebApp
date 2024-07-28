<?php
session_start();
include('connection.php');
include('ShoppingCart_func.php');

if(!isset($_SESSION['CustomerID'])) {
    echo "<script>window.alert('Please Login first')</script>";
    echo "<script>window.location='Customers_SignIn.php'</script>";
}

if (isset($_POST['btnAdd'])) {
    $pid = $_POST['txtProductID'];
    $qty = $_POST['txtQuantity'];
    // $price = $_POST['txtProductPrice'];

    AddToCart($pid,$qty);
}

if (isset($_REQUEST['Remove'])) {
    $pID = $_REQUEST['Remove'];
    RemoveProduct($pID);
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
    <title>Shopping Cart</title>
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
                    <li class="navActive">
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

    <!-- Add Display -->
    <h1 class="cartHeader">Your Cart Details</h1>
    <div class="displayBox-Order">
        <div class="displayList-Order">
            <!-- <div > -->
            <?php
            if (!isset($_SESSION['Cart'])) {
                echo "<p>No Product Record</p>";
            } else {

                $size = count($_SESSION['Cart']);
                $totalRecord = 0;
                for ($i = 0; $i < $size; $i++) {
                    $ProductID = $_SESSION['Cart'][$i]['ProductID'];
                    $ProductName = $_SESSION['Cart'][$i]['ProductName'];
                    $ProductPrice = $_SESSION['Cart'][$i]['SellPrice'];
                    $ProductQty = $_SESSION['Cart'][$i]['PQty'];
                    $CategoryName = $_SESSION['Cart'][$i]['CategoryName'];
                    $ProductImg = $_SESSION['Cart'][$i]['Image1'];
                    // $totalCount = $_SESSION['Cart'][$i]['TotalCount'];
        ?>
            <div class="eachCardGrp">
                <div class="PShopCard">
                    <div class="imgText">
                        <div class="PShopContent">
                            <img src="<?php echo $ProductImg ?>" alt="Product Image" width="120px" height="120px"
                                style="border-radius: 12px;">
                        </div>
                        <div class="PShopContent">
                            <h3><?php echo $ProductName; ?></h3>
                            <p class="cat"><?php echo $CategoryName; ?></p><br>
                            <p> Quantity : <span class="qty"><?php echo  $ProductQty; ?></span></p><br>
                            <h4><?php echo  $ProductPrice; ?> MMK</h4>
                            <p>Total Price : <?php echo $ProductQty * $ProductPrice ?> MMK</p>
                        </div>
                    </div>
                    <button class="PShopContent removeCardBtn">
                        <a href='ShoppingCart.php?Remove=<?php echo $ProductID ?>'>
                            <i class="fa fa-solid fa-trash-can" style="color: red;"></i>
                        </a>
                    </button>
                </div>
            </div>
            <?php
                    }
                }
                ?>
        </div>
        <div class="subTotal">
            <h2>Subtotal</h2><br>
            <?php
                    if (!isset($_SESSION['Cart'])) {
                        echo "<p>No Product Record</p>";
                    } else {

                        $size = count($_SESSION['Cart']);
                        $totalRecord = 0;
                        for ($i = 0; $i < $size; $i++) {
                            $ProductName = $_SESSION['Cart'][$i]['ProductName'];
                            $ProductPrice = $_SESSION['Cart'][$i]['SellPrice'];
                ?>
            <div style="min-height: 80px;">
                <div class="eachSubtotal">
                    <p><?php echo $ProductName; ?></p> &nbsp; &nbsp; &nbsp;
                    <p><?php echo $ProductQty * $ProductPrice ?> MMK</p>
                </div>
                <?php
                    }
                }
                ?>
                <hr class="hr">
            </div>
            <div class="eachSubtotal" style="min-height: 80px;">
                <h4>Total Quantity &nbsp; : &nbsp; <?php  echo CalculateTotalQuantity(); ?></h4> &nbsp; &nbsp;
                <h4>Total Price &nbsp; : &nbsp; <?php echo CalculateTotalAmount(); ?> &nbsp; MMK</h4>
            </div>
            <div class="eachSubtotal" style="min-height: 80px;">
                <button>
                    <a class="cartLnk" href="Products_Catalog.php">Continue Shopping</a>
                </button>
                <button>
                    <a class="cartLnk" href='Checkout.php'>Proceed</a>
                </button>
            </div>
        </div>
    </div>
    </div>
    </div>

    <footer>
        <div class="footerRow">
            <div class="footerCol">
                <img src="./Images/LogoJpeg.png" width="100px" height="100px" alt="Logo">
                <a href="./HomePage.php">
                    <h1 class="footerLogo"><span>S</span>erenity</h1>
                </a>
            </div>
            <div class="footerCol">
                Serenity &copy; All Rights Reserved 2023 <br>
                For an Educational Purpose
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