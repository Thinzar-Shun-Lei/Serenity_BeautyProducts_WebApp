<?php
session_start();
include('connection.php');
include('AutoIDFun.php'); //to connect with AutoIDFun.php
include('ShoppingCart_func.php');

// if(isset($_SESSION['CustomerID'])) {
//     echo "<script>window.alert('Please login to proceed orders')</script>";
//     echo "<script>window.location = './Customers_SignIn.php' </script>";
// }
// echo $_SESSION['DeliveryFee']; 



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

// btnConfirm
if (isset($_POST['btnConfirm'])) {
    $orderID = $_POST['txtOrderID'];
    $orderDate = $_POST['txtOrderDate']; 
    $customerID = $_POST['txtCustomerID'];
    $townshipID = $_SESSION['TownshipID'];
    $deliveryAddress = $_POST['txtCAddress'];
    $contactPhone = $_POST['txtCPhone'];
    $paymentType = $_POST['rdoPaymentType'];
    $totalQty = CalculateTotalQuantity();
    $subtotal = CalculateTotalAmount();
    $deliFee = $_SESSION['DeliveryFee'];
    $grandTotal = CalculateTotalAmount() + $_SESSION['DeliveryFee'] ;
   

    $insert = "INSERT into Orders 
                values('$orderID','$orderDate','$customerID','$townshipID','$totalQty','$subtotal'
                ,'$deliFee', '$grandTotal', '$deliveryAddress', '$contactPhone', '$paymentType', 'Pending', NULL)";
    $query = mysqli_query($connection, $insert);

    // if ($query) {
    //     // Retrieve the last inserted OrderID
    // echo    $lastOrderID = mysqli_insert_id($connection);
    // //Testing
    // if ($query) {
    //     echo "<script>alert('Your Order has been recorded successfully')</script>";
    //     echo "<script>window.location='Checkout.php'</script>";
    //     // unset($_SESSION['Cart']);
    // }
    // // Testing 

    $size = count($_SESSION['Cart']);

    for ($i = 0; $i < $size; $i++) {
        $ProductID = $_SESSION['Cart'][$i]['ProductID'];
        $ProductPrice = $_SESSION['Cart'][$i]['SellPrice'];
        $ProductQty = $_SESSION['Cart'][$i]['PQty'];
        $totalPrice = $_SESSION['Cart'][$i]['PQty'] * $_SESSION['Cart'][$i]['SellPrice'];
        // $TotalPrice = $ProductQty * $ProductPrice;

        $insert1 = "INSERT  INTO OrderDetails 
                    values('$orderID','$ProductID','$ProductQty','$ProductPrice','$totalPrice')";
        $query1 = mysqli_query($connection, $insert1);

        $update1 = "UPDATE Products set Quantity=Quantity-$ProductQty where ProductID='$ProductID'";
        $query2 = mysqli_query($connection, $update1);

        // $update2 = "UPDATE Products set PurchasePrice='$price' where ProductID='$productid'";
        // $query3 = mysqli_query($connection, $update2);
    }
        if ($query1) {
            echo "<script>alert('Your Order has been recorded successfully')</script>";
            echo "<script>window.location='Products_Catalog.php'</script>";
            unset($_SESSION['Cart']);
        }
     }
    
// }

// btnConfirm



$CusName = $_SESSION['CustomerName'];
$CusID = $_SESSION['CustomerID'];
// echo $_SESSION['townshipID'];
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

    <form action="Checkout.php" method="POST">
        <h1 class="checkOutHeader">Check Out Details</h1>
        <div class="checkoutWrap">
            <div class="inputCheckOut">
                <h3 style="text-align: center;">Customer Info</h3>
                <br><br>
                <div class="inputGroup">
                    <label for="">Order ID</label> <br>
                    <input type="text" name="txtOrderID" value="<?php echo autoID("Orders", "OrderID", "Ord_", 6); ?>"
                        readonly>
                    <!-- Ps_000001 -->
                    <br><br>
                </div>
                <div class="inputGroup">
                    <label for="">Order Date</label> <br>
                    <input type="date" name="txtOrderDate" value="<?php echo date('Y-m-d'); ?>" readonly>
                    <br><br>
                </div>
                <div class="inputGroup">
                    <label for="">Name</label> <br>
                    <input type="text" name="txtCustomerName" value="<?php echo $CusName; ?>">
                    <input type="hidden" name="txtCustomerID" value="<?php echo $CusID; ?>">
                    <br><br>
                </div>
                <div class="inputGroup">
                    <label for="">Townships <span style="color: red;">*</span></label> <br>
                    <select name="cboTownshipID" class="cboTownship">
                        <option>Choose Township</option>
                        <?php
                                            $query = "SELECT * FROM Townships";
                                            $ret = mysqli_query($connection,$query);
                                            $count = mysqli_num_rows($ret);

                                            for ($i=0; $i < $count ; $i++) { 
                                                $row = mysqli_fetch_array($ret);
                                                $townshipID = $row['TownshipID'];
                                                ?>
                        <option value="<?php echo $townshipID ?>">
                            <?php echo $row['TownshipID']. " - " .$row['TownshipName']. "; Price : ".$row['DeliveryFee'] ; ?>
                        </option>
                        <?php
                                            }

                                        ?>
                    </select>
                </div>
                <br>
                <div class="inputGroup">
                    <label for="">Contact Phone</label> <br>
                    <input type="number" name="txtCPhone" value="<?php echo $_SESSION['CustomerPhone']; ?>">
                    <br><br>
                </div>
                <div class="inputGroup">
                    <label for="">Confirmed Address</label> <br>
                    <textarea name="txtCAddress" cols="30" rows="10"
                        required><?php echo $_SESSION['CustomerAddress']; ?></textarea>
                    <br><br>
                </div>
                <input class="btnFrmSubmit" type="submit" value="Check" name="btnCheck"> <br />
            </div>

            <div class="checkoutBox-Order">
                <h3 style="text-align: center;">Order Summary</h3>
                <hr class="hr">
                <div class="checkoutList-Order">
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
                    <div class="eachCardGrp ">
                        <div class="PShopCard CShopCard">
                            <div class="PShopContent">
                                <img src="<?php echo $ProductImg ?>" alt="Product Image" width="60px" height="60px"
                                    style="border-radius: 12px;">
                            </div>
                            <div class="PShopContent">
                                <h4><?php echo $ProductName; ?></h4>
                                <p class="cat"><?php echo $CategoryName; ?></p><br>
                                <p> Quantity : <span class="qty"><?php echo  $ProductQty; ?></span></p><br>
                                <h5><?php echo  $ProductPrice; ?> MMK</h5>
                                <p>Total Price : <?php echo $ProductQty * $ProductPrice ?> MMK</p>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                }
                ?>
                    <hr style="width: 60%; align-self: center;">
                    <br>
                    <div class="CSubtotal" style="min-height: 80px;">
                        <h4>Total Quantity &nbsp; : &nbsp; <?php  echo CalculateTotalQuantity(); ?></h4>
                        <br>
                        <h4>All Total &nbsp; : &nbsp; <?php echo CalculateTotalAmount(); ?></h4>
                    </div>
                    <br>
                    <div style="text-align: center;">
                        <a href="Products_Catalog.php">Continue Shopping</a> |
                        <a href='ShoppingCart.php'>Update the Cart</a>
                    </div>
                    <br>
                </div>
            </div>
            <br><br><br>
        </div>

        <div>

            <?php
            if (isset($_POST['btnCheck'])) {
                $townshipID = $_POST['cboTownshipID'];
            
                AddTsp($townshipID);
            
        ?>
            <br><br><br>
            <div style="padding: 60px;">
                <hr style="width: 100%; align-self: center;">
            </div>
            <div class=" CDeli">
                <h3>Delivery Information</h3>
                <div class="CDeliInput">
                    <label for="">Delivery Fee</label> <br>
                    <input type="text" value="<?php echo $_SESSION['DeliveryFee']; ?>" readonly>
                    <input type="hidden" value="<?php echo $_SESSION['TownshipID']; ?>">
                    <br><br>
                </div>

                <br>
                <div class="CDeliInput">
                    <label for="">Payment Type</label> <br><br>
                    <input class="rdoSupplier" type="radio" name="rdoPaymentType" value="Cash On Delivery"> Cash On
                    Delivery
                    <br><br>
                    <input class="rdoSupplier" type="radio" name="rdoPaymentType" value="Visa Card"> Visa Card <br><br>
                    <input class="rdoSupplier" type="radio" name="rdoPaymentType" value="Mobile Banking"> Mobile Banking
                    <br>
                </div>
                <br>
                <br>
                <div class="CDeliInput">
                    <label for="">Grand Total (Total Price + Delivery Fee) </label> <br>
                    <input type="text" value="<?php echo CalculateTotalAmount() + $_SESSION['DeliveryFee']; ?>"
                        readonly>
                    <br><br>
                </div>

                <br>
                <input class="btnFrmSubmit" type="submit" value="Confirm Order" name="btnConfirm"> <br />
                <?php
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
                Serenity &copy; All Rights Reserved 2023 <br>
                For an Educational Purpose
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
    <script src="./modalBox.js"></script>

</body>

</html>