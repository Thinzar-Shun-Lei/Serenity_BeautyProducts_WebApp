<?php
session_start();
include('connection.php');

if(isset($_POST['btnRegister']))
{
    $txtBrandName = $_POST['txtBrandName'];
    $txtBrandStatus = $_POST['rdoStatus'];

// Photo Insert
$filePhotoName = $_FILES['txtBrandPhoto']['name']; //brand.jpg , file name, 'name' is fixed
$folder = "BrandPhoto/"; //folder name
$fileName = $folder . '_' .  $filePhotoName; //BrandPhoto/_staff.jpg //store in database

$copy = copy($_FILES['txtBrandPhoto']['tmp_name'], $fileName); //'tmp_name' is fixed,  source, dest_file

if(!$copy) {
    echo "There is something error in uploading photo.";
    exit();
}
else {
// Brand already exists check
    $query = "SELECT * FROM Brands WHERE BrandName = '$txtBrandName'";
    $ret = mysqli_query($connection,$query);
    $count = mysqli_num_rows($ret);
    if($count>0) {
        echo "<script>window.alert('This Brand already exists.')</script>";
        echo "<script>window.location = './Brands.php' </script>";
    }
    else { 
            $Insert = "INSERT INTO Brands(BrandName, BrandStatus, BrandImage)
                    VALUES ('$txtBrandName','$txtBrandStatus', '$fileName')";
            $ret=mysqli_query($connection,$Insert);

            if($ret) {
                echo "<script>window.alert('Successfully Added')</script>";
                echo "<script>window.location = './Brands.php' </script>";
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
    <title>Brand Entry</title>
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
                            <a class="sideMenuActive" href="./Brands.php">Brands</a>
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
                            <a class="sideMenuActive" href="./Brands.php">Brands</a>
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
            <form action="Brands.php" method="post" class="positionForm" enctype="multipart/form-data">
                <h2>Entry form : <span style="color:#f797a5"> Brands</span></h2>
                <div class="inputContainer">
                    <div class="inputGroup">
                        <label for="">Brand Name <span style="color: red;">*</span></label> <br>
                        <input type="text" name="txtBrandName" placeholder="eg., Bella" required>
                        <br><br>
                    </div>
                    <br>
                    <div class="inputGroup">
                        <label for="">Brand Status <span style="color: red;">*</span></label> <br>
                        <input type="radio" name="rdoStatus" value="Active" checked>&nbsp; Active
                        <input type="radio" name="rdoStatus" value="Inactive">&nbsp; Inactive
                        <br><br>
                    </div>
                    <br>
                    <div class="inputGroup">
                        <label for="">Brand Image <span style="color: red;">*</span></label> <br>
                        <input type="file" name="txtBrandPhoto" required>
                        <br><br>
                    </div>

                    <input class="btnFrmSubmit" type="submit" value="Register" name="btnRegister"> <br />
                </div>
            </form>
            <hr class="hr">


            <!-- Disply 2 -->
            <h2 class="tblHeader">Brand Information</h2>
            <div class="displayList">
                <table>
                    <?php
                    $roleQuery = "SELECT * FROM Brands";
                    $roleRet = mysqli_query($connection,$roleQuery);
                    $count = mysqli_num_rows($roleRet);
                
                    if($count < 1) {
                        echo "No data in the table";
                    }
                ?>
                    <table class="tblInfo">
                        <tr class="thContainer">
                            <th>ID</th>
                            <th>Brand Name</th>
                            <th>Status</th>
                            <th>Manage</th>
                        </tr>

                        <?php
                        for ($i=0; $i <$count ; $i++) { 
                            $row = mysqli_fetch_array($roleRet);
                            $brandID = $row['BrandID'];
                            $brandName = $row['BrandName'];
                            $brandStatus = $row['BrandStatus'];

                    ?>
                        <tr class="tdGroup">
                            <td><?php echo $brandID ?></td>
                            <td><?php echo $brandName ?></td>
                            <td><?php echo $brandStatus ?></td>
                            <td>
                                <a href='Brands_Edit.php?BrandID=<?php echo $brandID ?>'> Edit </a> |
                                <a href='Brands_Delete.php?BrandID=<?php echo $brandID ?>'> Delete </a>
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
    <!-- <script src="./Serenity.js"></script> -->
    <script src="./modalBox.js"></script>

</body>

</html>