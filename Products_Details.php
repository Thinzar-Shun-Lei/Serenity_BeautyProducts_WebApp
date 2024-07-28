<?php
session_start();
include('connection.php');
include('ShoppingCart_func.php');

if(isset($_REQUEST['PID'])) {
    $productID = $_REQUEST['PID'];
    $query = "SELECT * FROM Products p, Categories c, Brands b
               WHERE p.CategoryID = c.CategoryID
               AND p.BrandID = b.BrandID
               AND p.ProductID = '$productID'";
    $ret = mysqli_query($connection,$query);
    $row = mysqli_fetch_array($ret);

    $image1 = $row['Image1'];
    $image2 = $row['Image2'];
    $image3 = $row['Image3'];
    $productName = $row['ProductName'];
    $brandName = $row['BrandName'];
    $categoryName = $row['CategoryName'];

    $qty = $row['Quantity'];
    $productPrice = $row['SellPrice'];
    $productDescription = $row['Description'];
}
if(isset($_POST['btnReview']))
{
    $Description = $_POST['txtRDescription'];
    $rating = $_POST['rdoRate'];
    $productID = $_POST['productID'];
    $customerID = $_SESSION['CustomerID'];

        $Insert = "INSERT INTO Reviews(CustomerID, ProductID, Rating, ReviewDescription)
                VALUES ('$customerID','$productID','$rating','$Description')";
        $ret=mysqli_query($connection,$Insert);

        if($ret) {
            echo "<script>window.alert('Thank you for your feedback.')</script>";
            echo "<script>window.location = 'Products_Catalog.php'</script>";
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
    <title>Products Display</title>
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
                        <a href="Products_Catalog.php" >PRODUCTS</a>
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
                    <li>
                        <a href="About.php?">ABOUT</a>
                    </li>
                    <li class="naActive">
                        <a href="Products_Catalog.php" >PRODUCTS</a>
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
                    <button class="confirm"><a href="./customers_SignOut.php">Log out</a></button>
                </div>
            </div>
        </div>
    </div>


    <form action="ShoppingCart.php" method="POST">
        <!-- Data passing to ShoppingCart -->
        <input type="hidden" name="txtProductID" value="<?php echo $productID; ?>">
        <input type="hidden" name="txtProductPrice" value="<?php echo $price; ?>">
        <!-- can remove price -->

        <div class="detail_Container">
            <div class="DImg_Container">
                <img src="<?php echo $image1; ?>" alt="Product Image">
                <div class="DImg_Row">
                    <img src="<?php echo $image1; ?>" alt="Product Image">
                    <img src="<?php echo $image2; ?>" alt="Product Image">
                    <img src="<?php echo $image3; ?>" alt="Product Image">
                </div>
            </div>
            <div class="DTxt_Container">
                <div class="pill_Container">
                    <h1><?php echo $productName; ?></h1>
                    <p class="category_Pill"><?php echo $categoryName; ?></p>
                </div>

                <br>
                <br>
                <h2>Price : <?php echo $productPrice; ?> MMK</h2>
                <br>

                <p>Brand : <span><?php echo $brandName; ?> </span> </p>
                <p>
                    Stock :
                    <?php
                        if ($qty < 1) { ?>
                    <span style="color: red;">Out of Stock</span>
                    <?php }
                       else { ?>
                    <span style="color: green;">In Stock</span>
                    <?php } ?>
                </p>
                <br>
                <div class="Pdes">
                    <p>
                        <?php echo $productDescription; ?>
                    </p>
                </div>
                <br>
                <br>
                <div class="PInput_Container">
                    <div class="Pinput_Qty">
                        <span style="font-weight: 800;">Quantity</span> <span
                            style="color: red; font-size:22px; font-weight:600;">*</span> &nbsp;
                        <input type="number" name="txtQuantity" min="1" max="10" required />
                    </div>
                <!-- Login Check -->
                <?php
                    if( isset($_SESSION['CustomerID']) && !empty($_SESSION['CustomerID']) ) {
                    ?>
                    <input type="submit" name="btnAdd" value="Add to Cart" />
                    <?php    }
                    else { ?>
                    <button class="onClickLogIn">
                        <a href="Customers_SignIn.php">Add to Cart</a>
                    </button>
                    <?php    
                    }
                ?>
                </div>
            </div>
        </div>
    </form>
    <br><br>
    <!-- Reviews -->
    <form action="Products_Details.php" method="POST">
        <div class="reviews_Box">
            <h2>Reviews</h2><br><br>
            <input type="hidden" name="productID" value="<?php echo $productID;?>">
            <textarea name="txtRDescription" id="" cols="30" rows="10" required></textarea><br>
            <div class="ratingContaier">
                <h4>Ratings &nbsp; : </h4>
                <div class="rating">
                    <input type="radio" name="rdoRate" value="5" id="star5">
                    <label class="lblStar" for="star5"></label>

                    <input type="radio" name="rdoRate" value="4" id="star4">
                    <label class="lblStar" for="star4"></label>

                    <input type="radio" name="rdoRate" value="3" id="star3">
                    <label class="lblStar" for="star3"></label>

                    <input type="radio" name="rdoRate" value="2" id="star2">
                    <label class="lblStar" for="star2"></label>

                    <input type="radio" name="rdoRate" value="1" id="star1">
                    <label class="lblStar" for="star1"></label>
                </div>
            </div><br>
                <!-- Login Check -->
                <?php
                    if( isset($_SESSION['CustomerID']) && !empty($_SESSION['CustomerID']) ) {
                    ?>
                        <input class="reviewBtn" type="submit" value="Submit" name="btnReview">
                    <?php    }
                    else { ?>
                    <button class="btnLogInCheck">
                        <a href="Customers_SignIn.php">Submit</a>
                    </button>
                    <?php    
                    }
                ?>

        </div><br>
        <div class="reviewsD_Box">
            <h2>Customer Reviews</h2>
            <br><br>
            <div class="review_Card">
                <?php
                        $query="SELECT * FROM Reviews r, Customers c, Products p
                        WHERE r.ProductID = p.ProductID
                        AND r.CustomerID = c.CustomerID
                        AND r.ProductID ='$productID'";
                        
                        $result=mysqli_query($connection,$query);
                        $count = mysqli_num_rows($result);

                        if($count==0) {
                            echo "<p>No Review.</p>";
                        }
                        else {
                            for ($i=0; $i < $count; $i+=2) { //for row, 1row mhr 2pon paw chin loc ,, p, pitchtypes pt WHERE pt.PitchTypeID = p.PitchTypeID
                                $query1 = "SELECT * FROM Reviews r, Customers c, Products p
                                WHERE r.ProductID = p.ProductID
                                AND r.CustomerID = c.CustomerID
                                AND r.ProductID ='$productID'
                                LIMIT $i,2"; //apaw query nk name ma tuu ag, $i, anouk mhr apaw ka limit loke htr dk hr htae
                                $ret1=mysqli_query($connection,$query1);
                                $count1=mysqli_num_rows($ret1);

                                for ($j=0; $j < $count1 ; $j++) { //for col, 1khu p 1khu swal htoke
                                    $row2 = mysqli_fetch_array($ret1);

                                    $customerName = $row2['CustomerName'];
                                    $description = $row2['ReviewDescription'];
                                    $customerImage = $row2['CustomerProfileImg']; ?>
                <div class="PImg_Container">
                    <div class="img_Name">
                        <img src="<?php echo $customerImage ?>" class="review_Image" alt="Product Image">
                        <h3><?php echo $customerName ?></h3>
                    </div><br>
                    <div>
                        <p><?php echo $description; ?></p>
                    </div>
                </div>

                <?php
                                }
                            }
                        }
                                ?>
            </div>

        </div>
    </form>

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

            </div>
        </div>
    </footer>
<script>
    const onClickLogIn = document.querySelector(".onClickLogIn");
    const btnLogInCheck = document.querySelector(".btnLogInCheck")

    onClickLogIn.addEventListener("click", (e) => {
        alert("Please Log in first!");
    });

    btnLogInCheck.addEventListener("click", (e) => {
        alert("Please Log in first!");
    });
</script>
    <script src="./Serenity.js"></script>
    <!-- <script src="./Serenity_1.js"></script> -->
    <script src="./modalBox.js"></script>
</body>

</html>