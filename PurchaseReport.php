<?php
session_start();
include('connection.php');

//Position check
$position_ID = $_SESSION['PositionID'];
$select1 = "SELECT * FROM Positions WHERE PositionID = '$position_ID'";
$query1 = mysqli_query($connection,$select1);
$row1 = mysqli_fetch_array($query1);
    
$position_Name = $row1['PositionName'];

//Display query



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
                            <a class="sideMenuLiLink" href="./Purchase.php">Purchases</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuActive" href="./PurchaseReport.php">Purchase Report</a>
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
                            <a class="sideMenuActive" href="./PurchaseReport.php">Purchase Report</a>
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

        <div class="contentContainer">
            <form action="PurchaseReport.php" method="post" class="purchaseReport" enctype="multipart/form-data">
                <h2 class="tblHeader">Purchase Report</h2> <br><br>
                <div class="searchColFlex">
                    <div class="searchBy">
                        <div>
                            <input class="rdoCode" type="radio" name="rdoSearchType" value="1"> &nbsp; &nbsp;
                            <span>Search by Code</span> <br><br>
                        </div>
                        <select class="optCode" name="cboPurchaseID">
                            <option>Choose Purchase Code</option>
                            <?php
                                            $query = "SELECT * FROM Purchases";
                                            $ret = mysqli_query($connection,$query);
                                            $count = mysqli_num_rows($ret);

                                            for ($i=0; $i < $count ; $i++) { 
                                                $row = mysqli_fetch_array($ret);
                                                $purchaseID = $row['PurchaseID'];
                                                ?>
                            <option value="<?php echo $purchaseID ?>">
                                <?php echo $row['PurchaseID']; ?></option>
                            <?php
                                            }
                                        ?>
                        </select>
                    </div>
                    <!-- New Add -->
                    <div class="searchBy">
                        <div>
                            <input class="rdoSupplier" type="radio" name="rdoSearchType" value="2"> &nbsp; &nbsp;
                            <span>Search by Suppliers</span> <br><br>
                        </div>
                        <select class="optSupplier" name="cboSupplierID">
                            <option>Choose Supplier</option>
                            <?php
                                            $query1 = "SELECT * FROM Suppliers";
                                            $ret1 = mysqli_query($connection,$query1);
                                            $count1 = mysqli_num_rows($ret1);

                                            for ($l=0; $l < $count1 ; $l++) { 
                                                $row1 = mysqli_fetch_array($ret1);
                                                $supplierID = $row1['SupplierID'];
                                                $supplierName = $row1['SupplierName'];
                                                ?>
                            <option value="<?php echo $supplierID ?>">
                                <?php echo $row1['SupplierID'] . "-" . $row1['SupplierName']; ?>
                            </option>
                            <?php
                                            }
                                        ?>
                        </select>
                    </div>
                    <!-- New Add -->
                    <div class="searchBy">
                        <div>
                            <input class="rdoStaff" type="radio" name="rdoSearchType" value="4"> &nbsp; &nbsp;
                            <span>Search by Staff</span> <br><br>
                        </div>
                        <select class="optStaff" name="cboStaffID">
                            <option>Choose Staff</option>
                            <?php
                                            $query2 = "SELECT * FROM Staff";
                                            $ret2 = mysqli_query($connection,$query2);
                                            $count2 = mysqli_num_rows($ret2);

                                            for ($h=0; $h < $count2 ; $h++) { 
                                                $row2 = mysqli_fetch_array($ret2);
                                                $staffID = $row2['StaffID'];
                                                ?>
                            <option value="<?php echo $staffID ?>">
                                <?php echo $row2['StaffID'] . "-" . $row2['StaffName']; ?></option>
                            <?php
                                            }
                                        ?>
                        </select>
                    </div>
                    <div class="searchBy">
                        <div>
                            <input class="rdoDate" type="radio" name="rdoSearchType" value="3"> &nbsp; &nbsp;
                            <span>Search by Date</span>
                        </div>
                        <br>
                        <br>
                        <div class="flexRow optDate">
                            <div>
                                <label for="">From</label> &nbsp;
                                <span>
                                    <input type="date" name="txtFrom" value="<?php echo date('Y-m-d'); ?>" />
                                </span>
                            </div> &nbsp; &nbsp;
                            <div>
                                <label for="">To</label> &nbsp;
                                <span>
                                    <input type="date" name="txtTo" value="<?php echo date('Y-m-d'); ?>" />
                                </span>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="btnPGroup">
                        <input type="submit" name="btnSearch" value="Search"> &nbsp; &nbsp;
                        <input type="submit" name="btnShowAll" value="Show All"> <br>
                    </div>
                </div>
            </form>
            <br><br><br>
            <div class="displayList">
                <table>
                    <?php
                    if(isset($_POST['btnSearch'])) { 
                        $rdoSearchType = $_POST['rdoSearchType'];
                        if ($rdoSearchType == 1) {
                            $purchaseID = $_POST['cboPurchaseID'];

                            $select = "SELECT * FROM Purchases p, Suppliers s, Staff st
                                          WHERE p.PurchaseID = '$purchaseID'
                                          AND p.SupplierID = s.SupplierID
                                          AND p.StaffID = st.StaffID";
                            $query = mysqli_query($connection,$select);
                            // $countType = mysqli_num_rows($queryType);
                        }
                        elseif ($rdoSearchType == 2) {
                            $supplierID = $_POST['cboSupplierID'];

                            $select = "SELECT * FROM Purchases p, Suppliers s, Staff st
                                          WHERE p.StaffID = st.StaffID
                                          AND p.SupplierID = s.SupplierID
                                          AND p.SupplierID = '$supplierID'";
                            $query = mysqli_query($connection,$select);
                        }
                        elseif ($rdoSearchType == 4) {
                            $staffID = $_POST['cboStaffID'];

                            $select = "SELECT * FROM Purchases p, Suppliers s, Staff st
                                          WHERE p.StaffID = st.StaffID
                                          AND p.SupplierID = s.SupplierID
                                          AND p.StaffID = '$staffID'";
                            $query = mysqli_query($connection,$select);
                        }
                        elseif ($rdoSearchType == 3) {
                            $from = date('Y-m-d',strtotime($_POST['txtFrom']));
                            $to = date('Y-m-d',strtotime($_POST['txtTo']));

                            $select = "SELECT * FROM Purchases p, Suppliers s, Staff st
                                          WHERE p.PurchaseDate BETWEEN '$from' AND '$to'
                                          AND p.SupplierID = s.SupplierID
                                          AND p.StaffID = st.StaffID";
                            $query = mysqli_query($connection,$select);
                        }
                    }
                    elseif(isset($_POST['btnShowAll'])) { //show all
                        $select = "SELECT * FROM Purchases p, Suppliers s, Staff st
                                   WHERE p.SupplierID = s.SupplierID
                                   AND p.StaffID = st.StaffID";
                        $query = mysqli_query($connection,$select); }
                    else {
                        $date = date('Y-m-d');
                        $select = "SELECT * FROM Purchases p, Suppliers s, Staff st
                                   WHERE p.PurchaseDate = '$date'
                                   AND p.SupplierID = s.SupplierID
                                   AND p.StaffID = st.StaffID";
                        $query = mysqli_query($connection,$select); }
                    
                    $count = mysqli_num_rows($query);
                    if($count < 1) {
                        echo "No data in the table";
                    }
                    else {
                ?>
                    <table class="tblInfo">
                        <tr class="thContainer">
                            <th>Purchase ID</th>
                            <th>Purchase Date</th>
                            <th>Staff </th>
                            <th>Supplier</th>
                            <th>Total Qty</th>
                            <th>Total Amount</th>

                            <th>Manage</th>
                        </tr>

                        <?php
                        for ($i=0; $i <$count ; $i++) { 
                            $row = mysqli_fetch_array($query);
                            $purchaseID = $row['PurchaseID'];
                            $purchaseDate = $row['PurchaseDate'];
                            $staff = $row['StaffName'];
                            $supplier = $row['SupplierName'];
                            $totalQty = $row['TotalQuantity'];
                            $totalAmount = $row['TotalAmount'];


                    ?>
                        <tr class="tdGroup">
                            <td><?php echo $purchaseID ?></td>
                            <td><?php echo $purchaseDate ?></td>
                            <td><?php echo $staff ?></td>
                            <td><?php echo $supplier ?></td>
                            <td><?php echo $totalQty ?></td>
                            <td><?php echo $totalAmount ?></td>

                            <td>
                                <a href='PurchaseDetailsReport.php?PurchaseID=<?php echo $purchaseID ?>'> Details </a>
                                <!-- if the button is accessed via link, it would be used as REQUEST instead of POST and GET -->
                            </td>
                        </tr>
                        <?php

                                }
                        
                    }

                            ?>

                    </table>
                </table>
                <br><br>
            </div>
        </div>
    </div>


    <script>
    // Purchase Checked 
    var rdoCode = document.getElementsByClassName("rdoCode")[0];
    var rdoSupplier = document.getElementsByClassName("rdoSupplier")[0];
    var rdoDate = document.getElementsByClassName("rdoDate")[0];
    var optCode = document.getElementsByClassName("optCode")[0];
    var optSupplier = document.getElementsByClassName("optSupplier")[0];
    var optDate = document.getElementsByClassName("optDate")[0];
    var rdoStaff = document.getElementsByClassName("rdoStaff")[0];
    var optStaff = document.getElementsByClassName("optStaff")[0];

    // Purchase Event
    rdoCode.addEventListener("change", function() {
        if (rdoCode.checked) {
            optCode.style.display = "block";
            optSupplier.style.display = "none";
            optDate.style.display = "none";
            optStaff.style.display = "none";
        }
    });

    rdoSupplier.addEventListener("change", function() {
        if (rdoSupplier.checked) {
            optCode.style.display = "none";
            optSupplier.style.display = "block";
            optDate.style.display = "none";
            optStaff.style.display = "none";
        }
    });

    rdoDate.addEventListener("change", function() {
        if (rdoDate.checked) {
            optCode.style.display = "none";
            optSupplier.style.display = "none";
            optDate.style.display = "block";
            optStaff.style.display = "none";
        }
    });

    rdoStaff.addEventListener("change", function() {
        if (rdoStaff.checked) {
            optCode.style.display = "none";
            optSupplier.style.display = "none";
            optDate.style.display = "none";
            optStaff.style.display = "block";
        }
    });
    </script>
    <script src="./Serenity_1.js"></script>
    <script src="./modalBox.js"></script>
</body>

</html>