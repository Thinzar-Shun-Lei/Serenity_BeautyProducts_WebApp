<?php
session_start();
include('connection.php');
include('AutoIDFun.php'); //to connect with AutoIDFun.php
include('AddProduct.php');

if (isset($_POST['btnAdd'])) {
    $productID = $_POST['cboProductID'];
    $purchasePrice = $_POST['txtPurchasedPrice'];
    $purchaseQty = $_POST['txtPurchasedQty'];

    AddProduct($productID, $purchasePrice, $purchaseQty);
}

if (isset($_REQUEST['Remove'])) {
    $pid = $_REQUEST['Remove'];
    RemoveProduct($pid);
}

$staffNameSession = $_SESSION['StaffName'] ;
$select = "SELECT * FROM Staff WHERE StaffName = '$staffNameSession'";
$query = mysqli_query($connection, $select);
$count = mysqli_num_rows($query);
$arr = mysqli_fetch_array($query);
if($count > 0) {
    $StaffID = $arr['StaffID'];
}


if (isset($_POST['btnSave'])) {
    $purchaseID = $_POST['txtPurchaseID'];
    $purchaseDate = $_POST['txtPurchaseDate'];
    $staffID = $StaffID;
    $supplierID = $_POST['cboSupplierID'];
    $totalamount = CalculateTotalAmount();
    $totalquantity = CalculateTotalQuantity();
    // $purchasePrice = $_SESSION['AddProduct'][$i]['ProductPrice'];
    // $purchasestatus = "Purchase";

    $insert = "INSERT into Purchases 
                values('$purchaseID','$purchaseDate','$staffID','$supplierID','$totalquantity','$totalamount')";
    $query = mysqli_query($connection, $insert);

    $size = count($_SESSION['AddProduct']);

    for ($i = 0; $i < $size; $i++) {
        $productid = $_SESSION['AddProduct'][$i]['ProductID'];
        $price = $_SESSION['AddProduct'][$i]['ProductPrice'];
        $quantity = $_SESSION['AddProduct'][$i]['ProductQty'];
        $totalPrice = $_SESSION['AddProduct'][$i]['ProductQty'] * $_SESSION['AddProduct'][$i]['ProductPrice'];

        $insert1 = "INSERT  INTO PurchaseDetails 
                    values('$purchaseID','$productid','$quantity','$price','$totalPrice')";
        $query1 = mysqli_query($connection, $insert1);

        $update = "UPDATE Products set Quantity=Quantity+$quantity where ProductID='$productid'";
        $query2 = mysqli_query($connection, $update);

        $update2 = "UPDATE Products set PurchasePrice='$price' where ProductID='$productid'";
        $query3 = mysqli_query($connection, $update2);
    }
    if ($query1) {
        echo "<script>alert('Purchase Record Successful')</script>";
        echo "<script>window.location='Purchase.php'</script>";
        unset($_SESSION['AddProduct']);
    }
}
    $position_ID = $_SESSION['PositionID'];
    $select1 = "SELECT * FROM Positions WHERE PositionID = '$position_ID'";
    $query1 = mysqli_query($connection,$select1);
    $row1 = mysqli_fetch_array($query1);
    
    $position_Name = $row1['PositionName'];
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
    <title>Purchase Entry</title>
</head>

<body>
    <nav class="nav">
        <div class="logoContainer">
            <img src="./Images/LogoJpeg.png" width="100px" height="100px" alt="Logo">
            <a href="#">
                <h1 class="logoText"><span>S</span>erenity</h1>
            </a>
        </div>
        <div class="navContainer">
            <ul class="navList">
                <div class="navBtn" id="onClickLogout">
                    <i class="fa fa-solid fa-arrow-right-from-bracket logoutIcon"></i>
                    <a href="#">Log Out </a>
                </div>
            </ul>
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
                    <button class="confirm"><a href="./Admin_Logout.php">Log out</a></button>
                </div>
            </div>
        </div>
    </div>

    <div class="sideMain">
        <div class="hamBtn">
            <i class="fa fa-solid fa-bars"></i>
        </div>
        <!-- Side Bar Lg Screen  -->
        <div class="sideBar">
            <div class="closeBtn">&times;</div>
            <div class="sideContent">
                <br>
                <div class="sideProfile">
                    <a href="./Admin_LandingPage.php" class="admProfile">
                        <img src="<?php echo $_SESSION['StaffPhoto'] ?>" alt="Staff Photo" width="100px" height="100px"
                        style="border-radius: 50%; border:1px solid white">
                        <h4 style="color:white; letter-spacing:1px">
                            <?php echo $_SESSION['StaffName'] ?>
                        </h4>
                    </a>
                </div>
                <hr width="80%">
                <?php if($position_Name == "Owner" || $position_Name == "Manager") { ?>
                <div class="sideMenu">
                    <ul style="width: 100%; padding: 0;">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./Staff.php">Staff</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./Suppliers.php">Suppliers</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="Positions.php">Positions</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./Townships.php">Townships</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./Brands.php">Brands</a>
                        </li>
                        <hr class=" hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./Categories.php">Categories</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./Products.php">Products</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuActive" href="./Purchase.php">Purchases</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./PurchaseReport.php">Purchase Report</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./Customers_Display.php">Customers List</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./Orders_Display.php">Customer Orders</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./Reviews_Display.php">Customer Reviews</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./Delivery_Display.php">Delivery List</a>
                        </li>
                    </ul>
                </div>
                <?php }else{ ?>
                <div class="sideMenu">
                    <ul style="width: 100%; padding: 0;">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiMute" href="#">Staff</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiMute" href="#">Suppliers</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiMute" href="#">Positions</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiMute" href="#">Townships</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./Brands.php">Brands</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./Categories.php">Categories</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./Products.php">Products</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuActive" href="./Purchase.php">Purchases</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./PurchaseReport.php">Purchase Report</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./Customers_Display.php">Customers List</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./Orders_Display.php">Customer Orders</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./Reviews_Display.php">Customer Reviews</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./Delivery_Display.php">Delivery List</a>
                        </li>
                    </ul>
                </div>
                <?php } ?>
            </div>
        </div>

        <!-- Form  -->
        <div class="contentContainer">
            <form action="Purchase.php" method="post" class="positionForm" enctype="multipart/form-data">
                <h2>Entry form : <span style="color:#f797a5"> Purchases</span></h2>
                <br><br>

                <div>
                    <h3>Purchase Information</h3>
                    <br><br>
                    <div class="inputContainer">
                        <!-- Customised Auto ID -->
                        <div class="inputGroup">
                            <label for="">Purchase ID</label> <br>
                            <input type="text" name="txtPurchaseID"
                                value="<?php echo autoID("Purchases", "PurchaseID", "Pc_", 6) ?>" readonly>
                            <!-- Ps_000001 -->
                            <br><br>
                        </div>
                        <div class="inputGroup">
                            <label for="">Purchase Date</label> <br>
                            <input type="date" name="txtPurchaseDate" value="<?php echo date('Y-m-d') ?>" >
                            <br><br>
                        </div>
                        <div class="inputGroup">
                            <label for="">Staff Name</label> <br>
                            <input type="text" name="txtStaffName" value="<?php echo $_SESSION['StaffName'] ?>"
                                readonly>
                            <br><br>
                        </div>
                        <hr class="hr">
                    </div>

                    <!-- </div> -->
                    <h3>Product Information</h3>
                    <br><br>
                    <div class="inputContainer">
                        <div class="inputGroup">
                            <label for="">Product <span style="color: red;">*</span></label> <br>
                            <select name="cboProductID">
                                <option>Choose Product</option>
                                <?php
                                $query = "SELECT * FROM Products";
                                $ret = mysqli_query($connection, $query);
                                $count = mysqli_num_rows($ret);

                                for ($i = 0; $i < $count; $i++) {
                                    $row = mysqli_fetch_array($ret);
                                    $productID = $row['ProductID'];
                                ?>
                                <option value="<?php echo $productID ?>">
                                    <?php echo $row['ProductID'] . " - " . $row['ProductName']; ?></option>
                                <?php
                                }

                                ?>
                            </select>
                        </div>
                        <br><br>
                        <div class="inputGroup">
                            <label for="">Unit Price <small>(MMK)</small> <span style="color: red;">*</span></label>
                            <br>
                            <input type="number" name="txtPurchasedPrice">
                            <br><br>
                        </div>
                        <br>
                        <div class="inputGroup">
                            <label for="">Unit Quantity <small>(pcs)</small> <span style="color: red;">*</span></label>
                            <br>
                            <input type="number" name="txtPurchasedQty">
                            <br><br>
                        </div>
                        <hr class="hr">
                    </div>

                    <h3>Price Information</h3>
                    <br><br>
                    <div class="inputContainer">
                        <div class="inputGroup">
                            <label for="">Total Quantity </label><small>(pcs)</small> <br>
                            <input type="number" name="txtTotalQty" value="<?php echo CalculateTotalQuantity() ?>"
                                readonly>
                            <br><br>
                        </div>
                        <div class="inputGroup">
                            <label for="">Total Price </label> <small>(MMK)</small> <br>
                            <input type="number" name="txtTotalPrice" value="<?php echo CalculateTotalAmount() ?>"
                                readonly>
                            <br><br>
                        </div>
                        <input class="btnFrmSubmit" type="submit" value="Add to List" name="btnAdd"> <br />
                    </div>
                </div>
                <hr>
                <!-- Add Display -->
                <div class="displayList-Purchase">
                    <!-- <table> -->
                    <table class="tblInfo">
                        <tr class="thContainer">
                            <th>Product ID</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Total Amount</th>
                            <th>Manage</th>
                        </tr>
                        <?php

            if (!isset($_SESSION['AddProduct'])) {
                echo "<p>No Product Record</p>";
            } else {

                $size = count($_SESSION['AddProduct']);

                for ($i = 0; $i < $size; $i++) {
                    $ProductID = $_SESSION['AddProduct'][$i]['ProductID'];
                    $ProductPrice = $_SESSION['AddProduct'][$i]['ProductPrice'];
                    $ProductQty = $_SESSION['AddProduct'][$i]['ProductQty'];
                    $ProductName = $_SESSION['AddProduct'][$i]['ProductName'];
                    $BrandName = $_SESSION['AddProduct'][$i]['BrandName'];
                    $CategoryName = $_SESSION['AddProduct'][$i]['CategoryName'];
                    $ProductImg = $_SESSION['AddProduct'][$i]['ProductImage'];
            ?>

                        <!-- Disply 1 -->
                        <!-- <h2 class="tblHeader">Product Information</h2> -->

                        <tr class="tdGroup">
                            <td><?php echo $ProductID ?></td>
                            <td><img src="<?php echo $ProductImg ?>" alt="Product Image" width="80px" height="80px">
                            </td>
                            <td><?php echo $ProductName ?></td>
                            <td><?php echo $BrandName ?></td>
                            <td><?php echo $CategoryName ?></td>
                            <td><?php echo $ProductPrice ?></td>
                            <td><?php echo $ProductQty ?></td>
                            <td><?php echo $ProductQty * $ProductPrice ?></td>

                            <td>
                                <a href='Purchase.php?Remove=<?php echo $ProductID ?>'><i
                                        class="fa fa-solid fa-trash-can" style="color: red;"></i></a>
                            </td>
                        </tr>
                        <br><br>
                        <?php
                }
            }
            ?>
                        <br><br>
                        <!-- Supplier -->
                        <tr>
                            <td colspan="4"></td>
                            <td class="txtSupplier">Supplier</td>
                            <td colspan="2">
                                <select name="cboSupplierID" class="cboSupplier">
                                    <option>Choose Supplier Name</option>
                                    <?php
                                        $query = "SELECT * FROM Suppliers";
                                        $ret = mysqli_query($connection, $query);
                                        $count = mysqli_num_rows($ret);

                                        for ($i = 0; $i < $count; $i++) {
                                            $row = mysqli_fetch_array($ret);
                                            $SupplierID = $row['SupplierID'];

                                            echo "<option value='$SupplierID'>" . $SupplierID . ' - ' . $row['SupplierName'] . "</option>";
                                        }
                                        ?>
                                </select>
                            </td>
                            <td colspan="3">
                                <input class="btnFrmSubmit" type="submit" value="Save" name="btnSave"> <br />
                            </td>
                        </tr>
                    </table>
                    <!-- </table> -->
                </div>
                <br><br>
            </form>


        </div>
    </div>
    <script src="./Serenity_1.js"></script>
    <script src="./modalBox.js"></script>
</body>

</html>