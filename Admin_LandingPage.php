<?php
session_start();
include('connection.php');


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <title>Admin Dashboard</title>
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
        <div class="contentContainer_Adm">
            <div class="profileFlex_profile">
                <img src="./Images/adminDashboard_cover.png" alt="Cover Image" width="100%" height="300px"
                    style="border-radius: 5px;"><br><br><br>

                <h2 class="animate__animated animate__pulse animate__infinite" style="text-align:center;">Welcome From
                    <span style="color:#f797a5"> "Serenity" Cosmetics and Beauty Aids Online shop</span> management</h2>
            </div><br><br><br>
            <!-- Update -->
            <div class="adm_profile">

                <div class="inputContainer">
                    <div class="inputGroup">
                        <label for="">Profile Photo</label> <br><br>
                        <img src="<?php echo $_SESSION['StaffPhoto'] ?>" alt="Staff Photo" width="120px" height="120px"
                            style="border-radius: 5px;">
                        <br><br>
                    </div>
                    <div class="inputGroup">
                        <label for="">Name</label> <br>
                        <input type="text" value="<?php echo $_SESSION['StaffName']; ?>">
                        <br><br>
                    </div>
                    <br>
                    <div class="inputGroup">
                        <label for="">Position<!--<span style="color: red;">*</span>--></label> <br>
                        <?php
                                $staffID = $_SESSION['StaffID'];
                                $select = "SELECT * 
                                FROM Staff s, Positions p
                                WHERE s.PositionID = p.PositionID
                                AND s.StaffID = '$staffID'";
                            $query = mysqli_query($connection,$select);
                            $rowP = mysqli_fetch_array($query);
                            ?>
                        <input type="text" name="txtBrandName" value="<?php echo $rowP['PositionName']; ?>" readonly>
                    </div>
                    <br>
                    <div class="inputGroup">
                        <label for="">Phone</label> <br>
                        <input type="text" value="<?php echo $_SESSION['StaffPhone']; ?>" readonly>
                        <br><br>
                    </div><br>
                    <div class="inputGroup">
                        <label for="">Email Address</label> <br>
                        <input type="text" value="<?php echo $_SESSION['StaffEmail']; ?>" readonly>
                        <br><br>
                    </div><br>
                    <div class="inputGroup">
                        <label for="">Address</label> <br>
                        <input type="text" value="<?php echo $_SESSION['StaffAddress']; ?>" readonly>
                        <br><br>
                    </div><br>
                    <button class="btnAdm_Edit">
                        <a target="_blank" href='Admin_Edit.php?AdminID=<?php echo $staffID ?>'> Edit </a>
                    </button>
                </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
    <!-- <script src="./Serenity.js"></script> -->
    <script src="./Serenity_1.js"></script>
    <script src="./modalBox.js"></script>

</body>

</html>