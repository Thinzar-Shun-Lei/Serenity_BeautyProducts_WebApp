<?php
session_start();
include('connection.php');
include('AutoIDFun.php'); //to connect with AutoIDFun.php
include('AddDelivery.php');

if (isset($_POST['btnAdd'])) {
    $orderID = $_POST['cboOrderID'];
    // $deliDate = $_POST['txtDeliDate'];

    AddDeli($orderID);
}

if (isset($_REQUEST['Remove'])) {
    $oid = $_REQUEST['Remove'];
    RemoveOrder($oid);
}

// $staffNameSession = $_SESSION['StaffName'] ;
// $select = "SELECT * FROM Staff WHERE StaffName = '$staffNameSession'";
// $query = mysqli_query($connection, $select);
// $count = mysqli_num_rows($query);
// $arr = mysqli_fetch_array($query);
// if($count > 0) {
//     $StaffID = $arr['StaffID'];
// }


if (isset($_POST['btnSave'])) {
    $deliveryID = $_POST['txtDeliID'];
    $deliDate = $_POST['txtDeliDate'];
    $staffID = $_POST['cboStaffID'];
    $delists = $_POST['rdoStatus'];
    $remark = $_POST['txtDeliRemarks'];


    $insert = "INSERT INTO Deliveries
                VALUES ('$deliveryID','$deliDate','$delists','$remark','$staffID')";
    $query = mysqli_query($connection, $insert);

    $size = count($_SESSION['AddDeli']);

    for ($i = 0; $i < $size; $i++) {
        $orderid = $_SESSION['AddDeli'][$i]['OrderID'];
        // $orderDate = $_SESSION['AddDeli'][$i]['OrderDate'];
        // $deliveryID = $_SESSION['AddDeli'][$i]['DeliveryID']; 


        $update = "UPDATE Orders set DeliveryID ='$deliveryID'  where OrderID='$orderid'";
        $query2 = mysqli_query($connection, $update);

//         // error checking
// if (!$query2) {
//     // Error occurred while executing the query
//     echo "Error updating DeliveryID: " . mysqli_error($connection);
// } else {
//     // Query executed successfully, check the number of affected rows
//     if (mysqli_affected_rows($connection) > 0) {
//         echo "DeliveryID updated successfully.";
//     } else {
//         echo "No rows were affected. DeliveryID may not have been updated.";
//     }
// }

        $update2 = "UPDATE Orders set OrderStatus='Confirmed' where OrderID='$orderid'";
        $query3 = mysqli_query($connection, $update2);
    }
    if ($query) {
        echo "<script>alert('Delivery Record Successful')</script>";
        echo "<script>window.location='Delivery_Display.php'</script>";
        unset($_SESSION['AddDeli']);
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
    <title>Delivery List</title>
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

        <!-- Form  -->
        <div class="contentContainer">
            <form action="Delivery_Display.php" method="post" class="positionForm" enctype="multipart/form-data">
                <h2>Entry form : <span style="color:#f797a5"> Delivery</span></h2>
                <br><br>

                <div>
                    <h3>Delivery Information</h3>
                    <br><br>
                    <div class="inputContainer">
                        <!-- Customised Auto ID -->
                        <div class="inputGroup">
                            <label for="">Delivery ID</label> <br>
                            <input type="text" name="txtDeliID"
                                value="<?php echo autoID("Deliveries", "DeliveryID", "DY_", 6) ?>" readonly>
                            <!-- Ps_000001 -->
                            <br>
                        </div>
                        <br><br>
                        <div class="inputGroup">
                            <label for="">Choose Order ID by Township</label> <br>
                            <?php
                                        $query = "SELECT * FROM Orders o 
                                                INNER JOIN Townships t ON o.TownshipID = t.TownshipID
                                                WHERE o.DeliveryID IS NULL";
                                        $ret = mysqli_query($connection, $query);
                                        $count = mysqli_num_rows($ret);
                                    
                            if ($count == 0) { ?>
                            &nbsp;<p style="font-size: 14px; color:gray;">No Pending Orders...</p>
                            <?php    }
                            else { ?>

                            <select name="cboOrderID" class="cboTownship">
                                <option>Choose Order ID by Township</option>
                                <?php
                                    for ($i = 0; $i < $count; $i++) {
                                        $row = mysqli_fetch_array($ret);
                                        $OrderID = $row['OrderID'];
                                        $TownshipName = $row['TownshipName'];
    
                                        echo "<option value='$OrderID'>" . $OrderID . ' - ' . $TownshipName . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <br><br>
                        <div class="inputGroup">
                            <label for="">Remarks</label>
                            <br>
                            <input type="text" name="txtDeliRemarks">
                            <br><br>
                        </div>
                        <input class="btnFrmSubmit" type="submit" value="Add to List" name="btnAdd"> <br />
                    </div>
                </div>
                <hr><br>
                <!-- Add Display CONT.-->
                <div class=" display-Deli">
                    <h2>Orders assigned to be Delivered</h2>
                    <!-- <table> -->
                    <table class="tblInfo tblDeli">
                        <tr class="thContainer">
                            <!-- <th>Delivery Date</th> -->
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>Delivery Fee</th>
                            <th>Delivery Address</th>
                            <th>Township</th>
                            <th>Contact Phone</th>
                            <th>Payment Type</th>
                            <th>Manage</th>
                        </tr>
                        <?php

            if (!isset($_SESSION['AddDeli'])) {
                echo "<p>No Delivery List Record</p>";
            } else {

                $size = count($_SESSION['AddDeli']);
                
                if($size < 1) {
                    echo "<br>";
                    echo "<p>No Delivery List Record</p>";
               }
                for ($i = 0; $i < $size; $i++) {

                   $OrderID = $_SESSION['AddDeli'][$i]['OrderID']; 
                //    $DeliveryID = $_SESSION['AddDeli'][$i]['DeliveryID']; 
                   $OrderDate = $_SESSION['AddDeli'][$i]['OrderDate'] ;
                   $DeliFee = $_SESSION['AddDeli'][$i]['DeliveryFee'];
                   $CustomerName = $_SESSION['AddDeli'][$i]['CustomerName'];
                   $TownshipName = $_SESSION['AddDeli'][$i]['TownshipName'];
                   $DeliAddress = $_SESSION['AddDeli'][$i]['DeliveryAddress'];
                   $ConPhone = $_SESSION['AddDeli'][$i]['ContactPhone'];
                   $PaymentType = $_SESSION['AddDeli'][$i]['PaymentType'];
                   $OrderSts = $_SESSION['AddDeli'][$i]['OrderStatus'];
            ?>

                        <!-- Disply 1 -->
                        <!-- <h2 class="tblHeader">Product Information</h2> -->

                        <tr class="tdGroup">
                            <td><?php echo $OrderID  ?></td>
                            <td><?php echo $OrderDate ?></td>
                            <td><?php echo $DeliFee ?></td>
                            <td><?php echo $DeliAddress ?></td>
                            <td><?php echo $TownshipName ?></td>
                            <td><?php echo $ConPhone ?></td>
                            <td><?php echo $PaymentType ?></td>

                            <td>
                                <a href='Delivery_Display.php?Remove=<?php echo $OrderID ?>'><i
                                        class="fa fa-solid fa-trash-can" style="color: red;"></i></a>
                            </td>
                        </tr>
                        <br><br>
                        <?php
                }
               
            }
            ?>
                        <br><br>
                    </table>
                    <!-- </table> -->

                </div>
                <br><br>
                <div class="inputDeliContainer">
                    <div class="inputDeli">
                        <label for="">Staff <span style="color: red;">*</span></label> <br>
                        <select name="cboStaffID" class="cboTownship">
                            <option>Choose Staff</option>
                            <?php
                                            $query1 = "SELECT * FROM Staff s, Positions p
                                                    WHERE s.PositionID = p.PositionID
                                                    AND p.PositionName = 'Delivery Man'";
                                            $ret1 = mysqli_query($connection, $query1);
                                            $count1 = mysqli_num_rows($ret1);

                                            for ($i = 0; $i < $count1; $i++) {
                                                $row1 = mysqli_fetch_array($ret1);
                                                $StaffID = $row1['StaffID'];
                                                $StaffName = $row1['StaffName'];

                                                echo "<option value='$StaffID'>" . $StaffID . ' - ' . $StaffName . "</option>";
                                            }
                                            ?>
                        </select>
                    </div>
                    <div class="inputDeli">
                        <label for="">Delivery Date <span style="color: red;">*</span></label> <br>
                        <input type="date" name="txtDeliDate">
                    </div>
                    <div class="inputDeli">
                        <h3 class="txtSupplier">Delivery Status</h3>
                        <div class="inputGroup">
                            <input type="radio" name="rdoStatus" value="Assigned" checked>&nbsp; Assigned
                            <input type="radio" name="rdoStatus" value="Completed">&nbsp; Completed
                        </div>
                        <br>
                    </div>
                </div>
                <br>
                <div class="inputDeliContainer">
                    <input class="btnFrmSubmit btnDeliSave" type="submit" value="Save" name="btnSave"> <br />
                    <button class="btnFrmSubmit btnDeliSave btnDeliMgt">
                        <a href="./Delivery_Details.php" class="lnkDeliSave">
                            Delivery Record Management
                        </a>
                    </button>
                </div>
            </form>


        </div>
    </div>
    <script src="./Serenity_1.js"></script>
    <script src="./modalBox.js"></script>
</body>

</html>