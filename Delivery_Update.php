<?php  
session_start();
include('connection.php');

if(isset($_POST['btnUpdate'])) 
{
	$txtDeliveryID=$_POST['txtDeliveryID'];
	$rdoDeliStatus=$_POST['rdoDeliStatus'];

	$Update="UPDATE Deliveries
			 SET 
			 Status='$rdoDeliStatus' 
			 WHERE 
			 DeliveryID='$txtDeliveryID'
			 ";
	$ret=mysqli_query($connection,$Update);
	
	if($ret) 
	{
		echo "<script>window.alert('Successfully Updated!');</script>";
		echo "<script>window.location='Delivery_Details.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Delivery Status Update : " . mysqli_error($connection) . "</p>";
	}
}



$deliID = $_GET['DeliveryID'];
$Select = "SELECT * FROM Deliveries WHERE DeliveryID = '$deliID'";
$ret = mysqli_query($connection,$Select);
$row = mysqli_fetch_array($ret);

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
    <title>Delivery Status Update</title>
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
        <!-- Side Bar  -->
        <div class="sideBar">
            <div class="closeBtn">&times;</div>
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
        <!-- Update Form -->
        <div class="contentContainer">
            <form action="Delivery_Update.php" method="post" class="positionForm">
                <h2>Update Form : <span style="color:#f797a5"> Delivery Status</span></h2>
                <div class="inputContainer">
                    <div class="inputGroup">
                        <label for="">Delivery ID <span style="color: red;">*</span></label> <br>
                        <input type="text" value="<?php echo $row['DeliveryID'] ?>" readonly>
                        <br><br>
                    </div>
                    <br>
                    <div class="inputGroup">
                        <label for="">Delivery Status <span style="color: red;">*</span></label> <br>
                        <?php
               
                    echo   "<input type='radio' name='rdoDeliStatus' value='Complete' checked > &nbsp; Complete";
                    echo   "<input type='radio' name='rdoDeliStatus' value='Cancelled'> &nbsp; Cancelled";
                    
            ?>
                    </div>
                    <br><br>
                    <input type="hidden" name="txtDeliveryID" value="<?php echo $row['DeliveryID'] ?>" /><br><br>
                    <input class="btnFrmSubmit" type="submit" value="Update" name="btnUpdate"> <br />
                </div>
            </form>
        </div>
        <script src="./Serenity_1.js"></script>
        <script src="./modalBox.js"></script>
</body>

</html>