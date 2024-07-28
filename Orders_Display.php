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
    <title>Orders List</title>
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
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./Purchase.php">Purchases</a>
                        </li>
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./PurchaseReport.php">Purchase Report</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./Customers_Display.php">Customers List</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuActive" href="./Orders_Display.php">Customer Orders</a>
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
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./Purchase.php">Purchases</a>
                        </li>
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./PurchaseReport.php">Purchase Report</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuLiLink" href="./Customers_Display.php">Customers List</a>
                        </li>
                        <hr class="hrSide" width="100%">
                        <li class="sideMenuLi">
                            <a class="sideMenuActive" href="./Orders_Display.php">Customer Orders</a>
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
            <form action="Orders_Display.php" method="post" class="purchaseReport" enctype="multipart/form-data">
                <h2 class="tblHeader">Customer Orders List</h2> <br><br>
                <div class="searchColFlex">
                    <div class="searchBy">
                        <div>
                            <input class="rdoOCode" type="radio" name="rdoSearchType" value="1"> &nbsp; &nbsp;
                            <span>Search by Code</span> <br><br>
                        </div>
                        <select class="optOCode" name="cboOrderID">
                            <option>Choose Order Code</option>
                            <?php
                                            $query = "SELECT * FROM Orders";
                                            $ret = mysqli_query($connection,$query);
                                            $count = mysqli_num_rows($ret);

                                            for ($i=0; $i < $count ; $i++) { 
                                                $row = mysqli_fetch_array($ret);
                                                $orderID = $row['OrderID'];
                                                ?>
                            <option value="<?php echo $orderID ?>">
                                <?php echo $row['OrderID']; ?></option>
                            <?php
                                            }
                                        ?>
                        </select>
                    </div>
                    <!-- New Add -->
                    <div class="searchBy">
                        <div>
                            <input class="rdoCustomer" type="radio" name="rdoSearchType" value="2"> &nbsp; &nbsp;
                            <span>Search by Customers</span> <br><br>
                        </div>
                        <select class="optCustomer" name="cboCustomerID">
                            <option>Choose Customer</option>
                            <?php
                                            $query1 = "SELECT * FROM Customers";
                                            $ret1 = mysqli_query($connection,$query1);
                                            $count1 = mysqli_num_rows($ret1);

                                            for ($l=0; $l < $count1 ; $l++) { 
                                                $row1 = mysqli_fetch_array($ret1);
                                                $customerID = $row1['CustomerID'];
                                                $customerName = $row1['CustomerName'];
                                                ?>
                            <option value="<?php echo $customerID ?>">
                                <?php echo $row1['CustomerID'] . "-" . $row1['CustomerName']; ?>
                            </option>
                            <?php
                                            }
                                        ?>
                        </select>
                    </div>
                    <div class="searchBy">
                        <div>
                            <input class="rdoODate" type="radio" name="rdoSearchType" value="3"> &nbsp; &nbsp;
                            <span>Search by Date</span>
                        </div>
                        <br>
                        <br>
                        <div class="flexRow optODate">
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
                    if(isset($_POST['btnSearch'])) { //search
                        $rdoSearchType = $_POST['rdoSearchType'];
                        if ($rdoSearchType == 1) {
                            $orderID = $_POST['cboOrderID'];

                            $select = "SELECT * FROM Orders o, Customers c, Townships t
                                          WHERE o.OrderID = '$orderID'
                                          AND o.TownshipID = t.TownshipID
                                          AND o.CustomerID = c.CustomerID";
                            $query = mysqli_query($connection,$select);
                            // $countType = mysqli_num_rows($queryType);
                        }
                        elseif ($rdoSearchType == 2) {
                            $customerID = $_POST['cboCustomerID'];

                            $select = "SELECT * FROM Orders o, Customers c, Townships t
                                          WHERE o.CustomerID = c.CustomerID
                                          AND o.TownshipID = t.TownshipID
                                          AND o.CustomerID = '$customerID'";
                            $query = mysqli_query($connection,$select);
                        }
                        elseif ($rdoSearchType == 3) {
                            $from = date('Y-m-d',strtotime($_POST['txtFrom']));
                            $to = date('Y-m-d',strtotime($_POST['txtTo']));

                            $select = "SELECT * FROM Orders o, Customers c, Townships t
                                          WHERE o.OrderDate BETWEEN '$from' AND '$to'
                                          AND o.TownshipID = t.TownshipID
                                          AND o.CustomerID = c.CustomerID";
                            $query = mysqli_query($connection,$select);
                        }
                    }
                    elseif(isset($_POST['btnShowAll'])) { //show all
                        $select = "SELECT * FROM Orders o, Customers c, Townships t
                                   WHERE o.CustomerID = c.CustomerID
                                   AND o.TownshipID = t.TownshipID";
                        $query = mysqli_query($connection,$select); }
                    else {
                        $date = date('Y-m-d');
                        $select = "SELECT * FROM Orders o, Customers c, Townships t
                                   WHERE o.OrderDate = '$date'
                                   AND o.CustomerID = c.CustomerID
                                   AND o.TownshipID = t.TownshipID";
                        $query = mysqli_query($connection,$select); }
                    
                    $count = mysqli_num_rows($query);
                    if($count < 1) {
                        echo "No data in the table";
                    }
                    else {
                ?>
                    <table class="tblInfo">
                        <tr class="thContainer">
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>Customer </th>
                            <th>Delivery Address </th>
                            <th>Contact Phone </th>
                            <th>Payment Type </th>

                            <th>Total Qty</th>
                            <th>Total Amount</th>
                            <th>Status</th>

                            <th>Manage</th>
                        </tr>

                        <?php
                        for ($i=0; $i <$count ; $i++) { 
                            $row = mysqli_fetch_array($query);
                            $orderID = $row['OrderID'];
                            $orderDate = $row['OrderDate'];
                            $customer = $row['CustomerName'];
                            $address = $row['DeliveryAddress'];
                            $phone = $row['ContactPhone'];
                            $payment = $row['PaymentType'];
                            $totalQty = $row['TotalQuantity'];
                            $totalAmount = $row['GrandTotal'];
                            $status = $row['OrderStatus'];


                    ?>
                        <tr class="tdGroup">
                            <td><?php echo $orderID ?></td>
                            <td><?php echo $orderDate ?></td>
                            <td><?php echo $customer ?></td>
                            <td><?php echo $address ?></td>
                            <td><?php echo $phone ?></td>
                            <td><?php echo $payment ?></td>

                            <td><?php echo $totalQty ?></td>
                            <td><?php echo $totalAmount ?></td>
                            <td><?php echo $status ?></td>


                            <td>
                                <a href='Orders_Details.php?OrderID=<?php echo $orderID ?>'> Details </a> |
                                <a href='Order_Cancel.php?OrderID=<?php echo $orderID ?>'> Cancel </a>
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
    // Order Checked
    var rdoCustomer = document.getElementsByClassName("rdoCustomer")[0];
    var optCustomer = document.getElementsByClassName("optCustomer")[0];
    var rdoOCode = document.getElementsByClassName("rdoOCode")[0];
    var optOCode = document.getElementsByClassName("optOCode")[0];
    var rdoODate = document.getElementsByClassName("rdoODate")[0];
    var optODate = document.getElementsByClassName("optODate")[0];

    // Order Event

    rdoOCode.addEventListener("change", function() {
        if (rdoOCode.checked) {
            optOCode.style.display = "block";
            optCustomer.style.display = "none";
            optODate.style.display = "none";
            // optStaff.style.display = "none";
        }
    });
    rdoODate.addEventListener("change", function() {
        if (rdoODate.checked) {
            optOCode.style.display = "none";
            optCustomer.style.display = "none";
            optODate.style.display = "block";
            // optStaff.style.display = "none";
        }
    });
    rdoCustomer.addEventListener("change", function() {
        if (rdoCustomer.checked) {
            optOCode.style.display = "none";
            optCustomer.style.display = "block";
            optODate.style.display = "none";
            // optStaff.style.display = "none";
        }
    });
    </script>
    <script src="./modalBox.js"></script>
    <script src="./Serenity_1.js"></script>

</body>

</html>