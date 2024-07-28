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
    <title>Product Catalog</title>
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

    <!-- Search Box -->
    <form action="Products_Catalog.php" method="POST">
        <div class="wclDiv">
            <!-- <h1>Available Pitches and its Pitch Types</h1>
                    <p>The info details of available Pitches and Pitch Types can be searched below.</p> -->
            <div class="ptySearchParent">
                <input class="searchContainer ptySearch" type="text" name="txtSearch"
                    placeholder="Please type Item name or Brand..." />
                <!-- <input type="submit" name="btnSearch" value="Search" class="ptySearchBtn"> -->
                <!-- Search By Categories -->
                <select class="" name="cboCategoryID">
                    <option>Search by Category</option>
                    <?php
                            $query = "SELECT * FROM Categories";
                            $ret = mysqli_query($connection,$query);
                            $count = mysqli_num_rows($ret);

                            for ($i=0; $i < $count ; $i++) { 
                                $row = mysqli_fetch_array($ret);
                                $categoryID = $row['CategoryID'];
                                ?>
                    <option value="<?php echo $categoryID ?>">
                        <?php echo $row['CategoryName']; ?></option>
                    <?php
                        }
                    ?>
                </select>
                <button type="submit" name="btnSearch">
                    <i class="fa fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>
    </form>
    <div class='PCardContainer'>
        <!-- Here -->
        <?php
                if(isset($_POST['btnSearch'])) {
                    
                $search=$_POST['txtSearch'];
                $searchCbo=$_POST['cboCategoryID'];
                // echo $searchCbo;

// Search by txt
                if($search != '') {
                    $query="SELECT * FROM Products p, Brands b, Categories c
                    WHERE p.BrandID = b.BrandID
                    AND p.CategoryID = c.CategoryID
                    AND (p.ProductName LIKE '%$search%'
                    OR b.BrandName LIKE '%$search%')";//kyike dk nay yar ka shr mhr moz % ko shayt nouk nyak 3 ya
                    
                    $result=mysqli_query($connection,$query);
                    $count = mysqli_num_rows($result);
                    if($count>0) {
                    
                        for ($i=0; $i < $count; $i+=30) { 
                            $query1 = "SELECT * FROM Products p, Brands b, Categories c
                            WHERE p.BrandID = b.BrandID
                            AND p.CategoryID = c.CategoryID
                            AND (p.ProductName LIKE '%$search%'
                            OR b.BrandName LIKE '%$search%')
                            LIMIT $i,30";// col 3 hti pl moz
                            
                            $ret1=mysqli_query($connection,$query1);
                            $count1 = mysqli_num_rows($ret1);

                            for ($j=0; $j < $count1; $j++) { 
                                $row2 = mysqli_fetch_array($ret1);
                                        $productID = $row2['ProductID'];
                                        $ProductName = $row2['ProductName'];
                                        $ProductImage = $row2['Image1'];
                                        $BrandName = $row2['BrandName'];
                                        $CategoryName = $row2['CategoryName'];
                                        $SellPrice = $row2['SellPrice'];
                                        $qty = $row2['Quantity'];

                                ?>
        <div class=" Card_Container">
            <div class="PImg_Container">
                <img src="<?php echo $ProductImage ?>" class="img_Product" alt="Product Image"><br>
            </div>
            <div class="PTxt_Container">
                <h3><?php echo $ProductName; ?></h3><br>
                <h4>Brand : <span><?php echo $BrandName; ?></span></h4>
                <p>Price : <?php echo $SellPrice; ?> MMK</p>
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

                <br><br>
                <?php
                    if($qty > 0) { ?>
                <div class>
                    <button class="btn_More">
                        <a href="Products_Details.php?PID=<?php echo $productID; ?>">More Details</a>
                        <i class="fa fa-solid fa-arrow-right"></i>
                    </button>
                </div>
                <?php  }
                ?>

            </div>
            <br>
        </div>

        <?php
                            }}
                        ?>
    </div>

    <?php }
        // check value in search box
        elseif($count < 1) { ?>
            <div class="notFoundContainer">
                <img src="./Images/SearchNotFound.png" alt="Search Not Found">
                <h2>Sorry... Your Search is not Found.</h2>
            </div>
            <?php
                                }
                 ?>
    <?php
        }

  // Search by Cat
  elseif($searchCbo!='') {
    // echo $searchCbo;
    $query="SELECT * FROM Products p, Brands b, Categories c
    WHERE p.BrandID = b.BrandID
    AND p.CategoryID = c.CategoryID
    AND p.CategoryID = '$searchCbo'";//kyike dk nay yar ka shr mhr moz % ko shayt nouk nyak 3 ya
    
    $result=mysqli_query($connection,$query);
    $count = mysqli_num_rows($result);
    if($count>0) {
    
        for ($i=0; $i < $count; $i+=30) { 
            $query1 = "SELECT * FROM Products p, Brands b, Categories c
            WHERE p.BrandID = b.BrandID
            AND p.CategoryID = c.CategoryID
            AND p.CategoryID = '$searchCbo'
            LIMIT $i,30";// col 3 hti pl moz
            
            $ret1=mysqli_query($connection,$query1);
            $count1 = mysqli_num_rows($ret1);

            for ($j=0; $j < $count1; $j++) { 
                $row2 = mysqli_fetch_array($ret1);
                        $productID = $row2['ProductID'];
                        $ProductName = $row2['ProductName'];
                        $ProductImage = $row2['Image1'];
                        $BrandName = $row2['BrandName'];
                        $CategoryName = $row2['CategoryName'];
                        $SellPrice = $row2['SellPrice'];
                        $qty = $row2['Quantity'];

                ?>
    <div class=" Card_Container">
        <div class="PImg_Container">
            <img src="<?php echo $ProductImage ?>" class="img_Product" alt="Product Image"><br>
        </div>
        <div class="PTxt_Container">
            <h3><?php echo $ProductName; ?></h3><br>
            <h4>Brand : <span><?php echo $BrandName; ?></span></h4>
            <p>Price : <?php echo $SellPrice; ?> MMK</p>
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

            <br><br>
            <?php
    if($qty > 0) { ?>
            <div class>
                <button class="btn_More">
                    <a href="Products_Details.php?PID=<?php echo $productID; ?>">More Details</a>
                    <i class="fa fa-solid fa-arrow-right"></i>
                </button>
            </div>
            <?php  }
?>
        </div>
        <br>
    </div>

    <?php
            }}
        ?>
    </div>

    <?php }
    elseif($count < 1) { ?>
    <div class="notFoundContainer">
        <img src="./Images/SearchNotFound.png" alt="Search Not Found">
        <h2>Sorry... Your Search is not Found.</h2>
    </div>
    <?php
                        }
         ?>
    <?php
    }      
    else { ?>
    <div class="notFoundContainer">
        <img src="./Images/SearchNotFound.png" alt="Search Not Found">
        <h2>Sorry... Your Search is not Found.</h2>
    </div>
    <?php
                    }
                }
                // Categories

                // Brands

                else {
                        ?>
    <div class='PCardContainer'>
        <?php
                        $query="SELECT * FROM Products p, Brands b, Categories c
                        WHERE p.BrandID = b.BrandID
                        AND p.CategoryID = c.CategoryID";
                        
                        $result=mysqli_query($connection,$query);
                        $count = mysqli_num_rows($result);

                        if($count==0) {
                            echo "<p>Information cannot be available.</p>";
                        }
                        else {
                            for ($i=0; $i < $count; $i+=2) { //for row, 1row mhr 2pon paw chin loc ,, p, pitchtypes pt WHERE pt.PitchTypeID = p.PitchTypeID
                                $query1 = "SELECT * FROM Products p, Brands b, Categories c
                                WHERE p.BrandID = b.BrandID
                                AND p.CategoryID = c.CategoryID
                                LIMIT $i,2"; //apaw query nk name ma tuu ag, $i, anouk mhr apaw ka limit loke htr dk hr htae
                                $ret1=mysqli_query($connection,$query1);
                                $count1=mysqli_num_rows($ret1);

                                for ($j=0; $j < $count1 ; $j++) { //for col, 1khu p 1khu swal htoke
                                    $row2 = mysqli_fetch_array($ret1);

                                    $productID = $row2['ProductID'];
                                    $ProductName = $row2['ProductName'];
                                    $ProductImage = $row2['Image1'];
                                    $BrandName = $row2['BrandName'];
                                    $CategoryName = $row2['CategoryName'];
                                    $SellPrice = $row2['SellPrice'];
                                    $qty = $row2['Quantity'];

                                ?>
        <div class=" Card_Container">
            <div class="PImg_Container">
                <img src="<?php echo $ProductImage ?>" class="img_Product" alt="Product Image"><br>
            </div>
            <div class="PTxt_Container">
                <h3><?php echo $ProductName; ?></h3><br>
                <h4>Brand : <span><?php echo $BrandName; ?></span></h4><br>
                <p>Price : <?php echo $SellPrice; ?> MMK</p>
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
                <br><br>
                <?php
                    if($qty > 0) { ?>
                <div class>
                    <button class="btn_More">
                        <a href="Products_Details.php?PID=<?php echo $productID; ?>">More Details</a>
                        <i class="fa fa-solid fa-arrow-right"></i>
                    </button>
                </div>
                <?php  }
                ?>
            </div>
            <br>
        </div>

        <?php
                                }
                            }
                        }
                    ?>
    </div>

    <?php }
                ?>
    <!-- Here -->
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

</body>

</html>