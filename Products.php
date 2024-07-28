<?php
session_start();
include('connection.php');

if(isset($_POST['btnRegister']))
{
    $txtProductName = $_POST['txtProductName'];
    $txtBrandName = $_POST['cboBrandName'];
    $txtCategoryName = $_POST['cboCategoryName'];
    $txtMD = $_POST['txtMD'];
    $txtED = $_POST['txtED'];
    $txtQuantity = $_POST['txtQty'];
    $txtPurchasePrice = $_POST['txtPPrice'];
    $txtSellPrice = $_POST['txtSPrice'];
    $txtProfit = $txtSellPrice - $txtPurchasePrice;
    $txtDescription = $_POST['txtDescription'];
    $txtProductStatus = $_POST['rdoStatus'];

// Photo Insert 1
$filePhotoName1 = $_FILES['txtProductPhoto1']['name']; //brand.jpg , file name, 'name' is fixed
$folder1 = "ProductPhoto/"; //folder name
$fileName1 = $folder1 . '_' .  $filePhotoName1; //BrandPhoto/_staff.jpg //store in database

$copy1 = copy($_FILES['txtProductPhoto1']['tmp_name'], $fileName1); //'tmp_name' is fixed,  source, dest_file

// Photo Insert 2
$filePhotoName2 = $_FILES['txtProductPhoto2']['name']; //brand.jpg , file name, 'name' is fixed
$folder2 = "ProductPhoto/"; //folder name
$fileName2 = $folder2 . '_' .  $filePhotoName2; //BrandPhoto/_staff.jpg //store in database

$copy2 = copy($_FILES['txtProductPhoto2']['tmp_name'], $fileName2);

// Photo Insert 3
$filePhotoName3 = $_FILES['txtProductPhoto3']['name']; //brand.jpg , file name, 'name' is fixed
$folder3 = "ProductPhoto/"; //folder name
$fileName3 = $folder3 . '_' .  $filePhotoName3; //BrandPhoto/_staff.jpg //store in database

$copy3 = copy($_FILES['txtProductPhoto3']['tmp_name'], $fileName3);

if(!$copy1 || !$copy2 || !$copy3) {
    echo "There is something error in uploading photo.";
    exit();
}
else {
// Product already exists check
    $query = "SELECT * FROM Products WHERE ProductName = '$txtProductName'";
    $ret = mysqli_query($connection,$query);
    $count = mysqli_num_rows($ret);
    if($count>0) {
        echo "<script>window.alert('This Product already exists.')</script>";
        echo "<script>window.location = './Products.php' </script>";
    }
    else { 
            $Insert = "INSERT INTO Products(ProductName, BrandID, CategoryID, ManufacturedDate, ExpiredDate, Quantity, PurchasePrice, SellPrice, Profit, Description, ProductStatus, Image1, Image2, Image3)
                    VALUES ('$txtProductName','$txtBrandName', '$txtCategoryName', '$txtMD', '$txtED', '$txtQuantity',
                    '$txtPurchasePrice', '$txtSellPrice', '$txtProfit', '$txtDescription', '$txtProductStatus',
                    '$fileName1', '$fileName2', '$fileName3')";
            $ret=mysqli_query($connection,$Insert);

            if($ret) {
                echo "<script>window.alert('Successfully Added')</script>";
                echo "<script>window.location = './Products.php' </script>";
            }
            else {
                echo "<script>window.alert('Something is wrong. Please try again.')</script>";
            }
        }
        
    }    
}
    $position_ID = $_SESSION['PositionID'];
    $select1 = "SELECT * FROM Positions WHERE PositionID = '$position_ID'";
    $query1 = mysqli_query($connection,$select1);
    $row1 = mysqli_fetch_array($query1);
    
    $position_Name = $row1['PositionName'];
// $position_Name = $_SESSION['StaffPosition'];
// echo $position_Name;    
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
    <title>Products Entry</title>
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
                            <a class="sideMenuActive" href="./Products.php">Products</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./Purchase.php">Purchases</a>
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
                            <a class="sideMenuActive" href="./Products.php">Products</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./Purchase.php">Purchases</a>
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
            <form action="Products.php" method="post" class="positionForm" enctype="multipart/form-data">
                <h2>Entry form : <span style="color:#f797a5"> Products</span></h2>
                <div class="inputContainer">
                    <div class="inputGroup">
                        <label for="">Product Name <span style="color: red;">*</span></label> <br>
                        <input type="text" name="txtProductName" placeholder="eg., Bella Lipstick" required>
                        <br><br>
                    </div>
                    <br>
                    <div class="inputGroup">
                        <label for="">Brand <span style="color: red;">*</span></label> <br>
                        <select name="cboBrandName">
                            <option>Choose Brand</option>
                            <?php
                                    $query = "SELECT * FROM Brands";
                                    $ret = mysqli_query($connection,$query);
                                    $count = mysqli_num_rows($ret);

                                    for ($i=0; $i < $count ; $i++) { 
                                        $row = mysqli_fetch_array($ret);
                                        $brandID = $row['BrandID'];
                                        ?>
                            <option value="<?php echo $brandID ?>">
                                <?php echo $row['BrandID']. " - " .$row['BrandName']; ?></option>
                            <?php
                                    }

                                ?>
                        </select>
                    </div>
                    <br><br>
                    <div class="inputGroup">
                        <label for="">Category <span style="color: red;">*</span></label> <br>
                        <select name="cboCategoryName">
                            <option>Choose Category</option>
                            <?php
                                    $query = "SELECT * FROM Categories";
                                    $ret = mysqli_query($connection,$query);
                                    $count = mysqli_num_rows($ret);

                                    for ($i=0; $i < $count ; $i++) { 
                                        $row = mysqli_fetch_array($ret);
                                        $categoryID = $row['CategoryID'];
                                        ?>
                            <option value="<?php echo $categoryID ?>">
                                <?php echo $row['CategoryID']. " - " .$row['CategoryName']; ?></option>
                            <?php
                                    }

                                ?>
                        </select>
                    </div>
                    <br><br>
                    <div class="inputGroup">
                        <label for="">Manufactured Date <span style="color: red;">*</span></label> <br>
                        <input type="date" name="txtMD" required>
                        <br><br>
                    </div>
                    <br>
                    <div class="inputGroup">
                        <label for="">Expired Date <span style="color: red;">*</span></label> <br>
                        <input type="date" name="txtED" required>
                        <br><br>
                    </div>
                    <br>
                    <div class="inputGroup">
                        <label for="">Quantity <span style="color: red;">*</span></label> <br>
                        <input type="number" name="txtQty" required>
                        <br><br>
                    </div>
                    <br>
                    <div class="inputGroup">
                        <label for="">Price (Purchase Price) <span style="color: red;">*</span></label> <br>
                        <input type="number" name="txtPPrice" required>
                        <br><br>
                    </div>
                    <br>
                    <div class="inputGroup">
                        <label for="">Price (Sell Price) <span style="color: red;">*</span></label> <br>
                        <input type="number" name="txtSPrice" required>
                        <br><br>
                    </div>
                    <br>
                    <div class="inputGroup">
                        <label for="">Description <span style="color: red;">*</span></label> <br>
                        <textarea name="txtDescription" required></textarea>
                        <br><br>
                    </div>
                    <br>
                    <div class="inputGroup">
                        <label for="">Product Status <span style="color: red;">*</span></label> <br>
                        <input type="radio" name="rdoStatus" value="Active" checked>&nbsp; Active
                        <input type="radio" name="rdoStatus" value="Inactive">&nbsp; Inactive
                        <input type="radio" name="rdoStatus" value="Popular">&nbsp; Popular
                        <input type="radio" name="rdoStatus" value="Promotion">&nbsp; Promotions
                        <br><br>
                    </div>
                    <br>
                    <div class="inputGroup">
                        <label for="">Product Image 1 <span style="color: red;">*</span></label> <br>
                        <input type="file" name="txtProductPhoto1" required>
                        <br><br>
                    </div>
                    <div class="inputGroup">
                        <label for="">Product Image 2 <span style="color: red;">*</span></label> <br>
                        <input type="file" name="txtProductPhoto2" required>
                        <br><br>
                    </div>
                    <div class="inputGroup">
                        <label for="">Product Image 3 <span style="color: red;">*</span></label> <br>
                        <input type="file" name="txtProductPhoto3" required>
                        <br><br>
                    </div>

                    <input class="btnFrmSubmit" type="submit" value="Register" name="btnRegister"> <br />
                </div>
            </form>
            <hr class="hr">


            <!-- Disply 1 -->
            <h2 class="tblHeader">Product Information</h2>
            <div class="displayList">
                <table>
                    <?php
                    $roleQuery = "SELECT * 
                                  FROM Products p, Brands b, Categories c
                                  WHERE p.BrandID = b.BrandID
                                  AND p.CategoryID = c.CategoryID";
                    $roleRet = mysqli_query($connection,$roleQuery);
                    $count = mysqli_num_rows($roleRet);
                
                    if($count < 1) {
                        echo "No data in the Products table";
                    }

                ?>
                    <table class="tblInfo">
                        <tr class="thContainer">
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Manage</th>
                        </tr>

                        <?php
                        for ($i=0; $i <$count ; $i++) { 
                            $row = mysqli_fetch_array($roleRet);
                            // $rowBr = mysqli_fetch_array($retBrands);
                            // $rowCat = mysqli_fetch_array($retCategories);

                            $productID = $row['ProductID'];
                            $productName = $row['ProductName'];
                            $brandName = $row['BrandName'];
                            $categoryName = $row['CategoryName'];

                    ?>
                        <tr class="tdGroup">
                            <td><?php echo $productID ?></td>
                            <td><?php echo $productName ?></td>
                            <td><?php echo $brandName ?></td>
                            <td><?php echo $categoryName ?></td>

                            <td>
                                <a href='Products_Edit.php?ProductID=<?php echo $productID ?>'> Edit </a> |
                                <a href='Products_Delete.php?ProductID=<?php echo $productID ?>'> Delete </a>
                            </td>
                        </tr>

                        <?php

                                }

                            ?>

                    </table>
                </table>
            </div>
            <br><br>
            <!-- Disply 2 -->
            <h2 class="tblHeader">Product Information</h2>
            <div class="displayList">
                <table>
                    <?php
                    $roleQuery = "SELECT * FROM Products";
                    $roleRet = mysqli_query($connection,$roleQuery);
                    $count = mysqli_num_rows($roleRet);
                
                    if($count < 1) {
                        echo "No data in the table";
                    }
                ?>
                    <table class="tblInfo">
                        <tr class="thContainer">
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>MFG Date</th>
                            <th>ED</th>
                            <th>Qty</th>
                            <th>Manage</th>
                        </tr>

                        <?php
                        for ($i=0; $i <$count ; $i++) { 
                            $row = mysqli_fetch_array($roleRet);
                            $productID = $row['ProductID'];
                            $productName = $row['ProductName'];
                            $MFG = $row['ManufacturedDate'];
                            $ED = $row['ExpiredDate'];
                            $Qty = $row['Quantity'];

                    ?>
                        <tr class="tdGroup">
                            <td><?php echo $productID ?></td>
                            <td><?php echo $productName ?></td>
                            <td><?php echo $MFG ?></td>
                            <td><?php echo $ED ?></td>
                            <td><?php echo $Qty ?></td>

                            <td>
                                <a href='Products_Edit.php?ProductID=<?php echo $productID ?>'> Edit </a> |
                                <a href='Products_Delete.php?ProductID=<?php echo $productID ?>'> Delete </a>
                            </td>
                        </tr>

                        <?php

                                }

                            ?>

                    </table>
                </table>
            </div>
            <br><br>
            <!-- Disply 3 -->
            <h2 class="tblHeader">Product Information</h2>
            <div class="displayList">
                <table>
                    <?php
                    $roleQuery = "SELECT * FROM Products";
                    $roleRet = mysqli_query($connection,$roleQuery);
                    $count = mysqli_num_rows($roleRet);
                
                    if($count < 1) {
                        echo "No data in the table";
                    }
                ?>
                    <table class="tblInfo">
                        <tr class="thContainer">
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Purchase Price</th>
                            <th>Sell Price</th>
                            <th>Profit</th>
                            <th>Manage</th>
                        </tr>

                        <?php
                        for ($i=0; $i <$count ; $i++) { 
                            $row = mysqli_fetch_array($roleRet);
                            $productID = $row['ProductID'];
                            $productName = $row['ProductName'];
                            $purchasePrice = $row['PurchasePrice'];
                            $sellPrice = $row['SellPrice'];
                            $profit = $row['Profit'];

                    ?>
                        <tr class="tdGroup">
                            <td><?php echo $productID ?></td>
                            <td><?php echo $productName ?></td>
                            <td><?php echo $purchasePrice ?></td>
                            <td><?php echo $sellPrice ?></td>
                            <td><?php echo $profit ?></td>

                            <td>
                                <a href='Products_Edit.php?ProductID=<?php echo $productID ?>'> Edit </a> |
                                <a href='Products_Delete.php?ProductID=<?php echo $productID ?>'> Delete </a>
                            </td>
                        </tr>

                        <?php

                                }

                            ?>

                    </table>
                </table>
            </div>
            <br><br>

            <!-- Disply 4 -->
            <h2 class="tblHeader">Product Information</h2>
            <div class="displayList">
                <table>
                    <?php
                    $roleQuery = "SELECT * FROM Products";
                    $roleRet = mysqli_query($connection,$roleQuery);
                    $count = mysqli_num_rows($roleRet);
                
                    if($count < 1) {
                        echo "No data in the table";
                    }
                ?>
                    <table class="tblInfo">
                        <tr class="thContainer">
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Manage</th>
                        </tr>

                        <?php
                        for ($i=0; $i <$count ; $i++) { 
                            $row = mysqli_fetch_array($roleRet);
                            $productID = $row['ProductID'];
                            $productName = $row['ProductName'];
                            $description = $row['Description'];
                            $productStatus = $row['ProductStatus'];

                    ?>
                        <tr class="tdGroup">
                            <td><?php echo $productID ?></td>
                            <td><?php echo $productName ?></td>
                            <td><?php echo $description ?></td>
                            <td><?php echo $productStatus ?></td>

                            <td>
                                <a href='Products_Edit.php?ProductID=<?php echo $productID ?>'> Edit </a> |
                                <a href='Products_Delete.php?ProductID=<?php echo $productID ?>'> Delete </a>
                            </td>
                        </tr>

                        <?php

                                }

                            ?>

                    </table>
                </table>
            </div>

        </div>
    </div>
    <script src="./Serenity_1.js"></script>
    <script src="./modalBox.js"></script>
</body>

</html>