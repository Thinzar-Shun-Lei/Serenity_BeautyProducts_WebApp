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
    <title>Delivery Report</title>
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
                            <a class="sideMenuActive" href="./Delivery_Display.php">Delivery List</a>
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
                            <a class="sideMenuActive" href="./Delivery_Display.php">Delivery List</a>
                        </li>
                    </ul>
                </div>
                <?php } ?>
            </div>
        </div>

        <div class="contentContainer">
            <form action="Delivery_Details.php" method="post" class="purchaseReport" enctype="multipart/form-data">
                <h2 class="tblHeader">Delivery Report</h2> <br><br>
                <div class="searchColFlex">
                    <div class="searchBy">
                        <div>
                            <input class="rdoDelSts" type="radio" name="rdoSearchType" value="1"> &nbsp; &nbsp;
                            <span>Search by Delivery Status</span> <br><br>
                        </div>
                        <select class="optDelSts" name="cboDeliID">
                            <option>Choose Delivery Status</option>
                            
                            <option value="Assigned">Assigned</option>
                            <option value="Complete">Complete</option>
                           
                        </select>
                    </div>
                    <!-- New Add -->
                    <div class="searchBy">
                        <div>
                            <input class="rdoDelStaff" type="radio" name="rdoSearchType" value="4"> &nbsp; &nbsp;
                            <span>Search by Staff (Delivery Man)</span> <br><br>
                        </div>
                        <select class="optDelStaff" name="cboStaffID">
                            <option>Choose Staff</option>
                            <?php
                                            $query2 = "SELECT * FROM Staff s, Positions p
                                                        WHERE s.PositionID = p.PositionID
                                                        AND p.PositionName = 'Delivery Man'";
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
                            <input class="rdoDelDate" type="radio" name="rdoSearchType" value="3"> &nbsp; &nbsp;
                            <span>Search by Delivery Date</span>
                        </div>
                        <br>
                        <br>
                        <div class="flexRow optDelDate">
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
            <div class="display-Deli">
                <table>
                    <?php
                    if(isset($_POST['btnSearch'])) { //search
                        $rdoSearchType = $_POST['rdoSearchType'];
                        if ($rdoSearchType == 1) {
                            $deliID = $_POST['cboDeliID'];

                            $select = "SELECT * FROM Orders o, Deliveries d, Staff st, Customers c, Townships t
                                          WHERE o.DeliveryID = d.DeliveryID
                                          AND d.Status = '$deliID'
                                          AND d.StaffID = st.StaffID
                                          AND o.CustomerID = c.CustomerID
                                          AND o.TownshipID = t.TownshipID";
                            $query = mysqli_query($connection,$select);
                            // echo $deliID;
                            // $countType = mysqli_num_rows($queryType);
                        }
                        elseif ($rdoSearchType == 4) {
                            $staffID = $_POST['cboStaffID'];

                            $select = "SELECT * FROM Orders o, Deliveries d, Staff st, Customers c, Townships t
                                        WHERE o.DeliveryID = d.DeliveryID
                                        AND d.StaffID = st.StaffID
                                        AND o.CustomerID = c.CustomerID
                                        AND o.TownshipID = t.TownshipID
                                        AND st.StaffID = '$staffID'";
                            $query = mysqli_query($connection,$select);
                        }
                        elseif ($rdoSearchType == 3) {
                            $from = date('Y-m-d',strtotime($_POST['txtFrom']));
                            $to = date('Y-m-d',strtotime($_POST['txtTo']));

                            $select = "SELECT * FROM Orders o, Deliveries d, Staff st, Customers c, Townships t
                                       WHERE o.DeliveryID = d.DeliveryID
                                       AND d.StaffID = st.StaffID
                                       AND d.DeliveryDate BETWEEN '$from' AND '$to'
                                       AND o.CustomerID = c.CustomerID
                                       AND o.TownshipID = t.TownshipID";
                            $query = mysqli_query($connection,$select);
                        }
                    }
                    elseif(isset($_POST['btnShowAll'])) { //show all
                        $select = "SELECT * FROM Orders o, Deliveries d, Staff st, Customers c, Townships t
                                   WHERE o.DeliveryID = d.DeliveryID
                                   AND d.StaffID = st.StaffID
                                   AND o.CustomerID = c.CustomerID
                                   AND o.TownshipID = t.TownshipID";
                        $query = mysqli_query($connection,$select); }
                    else {
                        $date = date('Y-m-d');
                        $select = "SELECT * FROM Orders o, Deliveries d, Staff st, Customers c, Townships t
                                   WHERE o.DeliveryID = d.DeliveryID
                                   AND d.DeliveryDate = '$date'
                                   AND d.StaffID = st.StaffID
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
                            <th>Delivery ID</th>
                            <th>Order ID</th>
                            <th>Delivery Date</th>
                            <th>Order Date</th>
                            <th>Customer</th>
                            <th>Township</th>
                            <th>Delivery Fee</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Staff</th>
                            <th>Order Status</th>
                            <th>Delivery Status</th>

                            <th>Update</th>
                        </tr>

                        <?php
                        for ($i=0; $i <$count ; $i++) { 
                            $row = mysqli_fetch_array($query);
                            $deliveryID = $row['DeliveryID'];
                            $orderID = $row['OrderID'];
                            $deliveryDate = $row['DeliveryDate'];
                            $orderDate = $row['OrderDate'];
                            $cusName = $row['CustomerName'];
                            $tspName = $row['TownshipName'];
                            $tspDeli = $row['DeliveryFee'];
                            $total = $row['GrandTotal'];
                            $payment = $row['PaymentType'];
                            $staff = $row['StaffName'];
                            $ordSts = $row['OrderStatus'];
                            $deliSts = $row['Status'];
                    ?>
                        <tr class="tdGroup">
                            <td><?php echo $deliveryID ?></td>
                            <td><?php echo $orderID ?></td>
                            <td><?php echo $deliveryDate ?></td>
                            <td><?php echo $orderDate ?></td>
                            <td><?php echo $cusName ?></td>
                            <td><?php echo $tspName ?></td>
                            <td><?php echo $tspDeli ?></td>
                            <td><?php echo $total ?></td>
                            <td><?php echo $payment ?></td>
                            <td><?php echo $staff ?></td>
                            <td><?php echo $ordSts ?></td>
                            <td><?php echo $deliSts ?></td>
                            <td>
                                <a href='Delivery_Update.php?DeliveryID=<?php echo $deliveryID ?>'> Status </a>
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
    var rdoDelSts = document.getElementsByClassName("rdoDelSts")[0];
    var rdoDelDate= document.getElementsByClassName("rdoDelDate")[0];
    var optDelSts = document.getElementsByClassName("optDelSts")[0];
    var optDelDate = document.getElementsByClassName("optDelDate")[0];
    var rdoDelStaff = document.getElementsByClassName("rdoDelStaff")[0];
    var optDelStaff = document.getElementsByClassName("optDelStaff")[0];

    // Purchase Event
    rdoDelSts.addEventListener("change", function() {
        if (rdoDelSts.checked) {
            optDelSts.style.display = "block";
            optDelDate.style.display = "none";
            optDelStaff.style.display = "none";
        }
    });

    rdoDelDate.addEventListener("change", function() {
        if (rdoDelDate.checked) {
            optDelSts.style.display = "none";
            optDelDate.style.display = "block";
            optDelStaff.style.display = "none";
        }
    });

    rdoDelStaff.addEventListener("change", function() {
        if (rdoDelStaff.checked) {
            optDelSts.style.display = "none";
            optDelDate.style.display = "none";
            optDelStaff.style.display = "block";
        }
    });
    </script>
    <script src="./Serenity_1.js"></script>
    <script src="./modalBox.js"></script>
</body>

</html>