<?php  
session_start();
include('connection.php');

if(isset($_POST['btnUpdate'])) 
{
	$txtTownshipID=$_POST['txtTownshipID'];
	$txtTownshipName=$_POST['txtTownshipName'];
	$txtPostalCode=$_POST['txtPostalCode'];
	$txtDeliveryFee=$_POST['txtDeliveryFee'];
	$rdoStatus=$_POST['rdoStatus'];
	$txtMap=$_POST['txtMap'];

	$Update="UPDATE Townships
			 SET 
			 TownshipName='$txtTownshipName',
			 PostalCode='$txtPostalCode',
			 DeliveryFee='$txtDeliveryFee',
			 TownshipStatus='$rdoStatus', 
			 Map='$txtMap'
			 WHERE 
			 TownshipID='$txtTownshipID'
			 ";
	$ret=mysqli_query($connection,$Update);
	
	if($ret) 
	{
		echo "<script>window.alert('Successfully Updated!');</script>";
		echo "<script>window.location='Townships.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Township Update : " . mysqli_error($connection) . "</p>";
	}
}



$townshipID = $_GET['TownshipID'];
$Select = "SELECT * FROM Townships WHERE TownshipID = '$townshipID'";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./Style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <title>Townships Edit</title>
</head>
<body>
    <nav class="nav">
        <div class="logoContainer">
            <img src="./Images/LogoJpeg.png" width="100px" height="100px" alt="Logo">
            <a href="#"><h1 class="logoText"><span>S</span>erenity</h1></a>
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
                            <a class="sideMenuActive" href="./Townships.php">Townships</a>
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
<!-- Update Form -->
<div class="contentContainer">
    <form action="Townships_Edit.php" method="post" class="positionForm">
        <h2>Update Form : <span style="color:#f797a5"> Townships</span></h2>
        <div class="inputContainer">
            <div class="inputGroup">
                <label for="">Township Name <span style="color: red;">*</span></label> <br>
                <input type="text" name="txtTownshipName" value="<?php echo $row['TownshipName'] ?>">
                <br><br>
            </div>
            <br>
            <div class="inputGroup">
                <label for="">Postal Code <span style="color: red;">*</span></label> <br>
                <input type="text" name="txtPostalCode" value="<?php echo $row['PostalCode'] ?>">
                <br><br>
            </div>
            <br><div class="inputGroup">
                <label for="">Delivery fee<span style="color: red;">*</span></label> <br>
                <input type="text" name="txtDeliveryFee" value="<?php echo $row['DeliveryFee'] ?>">
                <br><br>
            </div>
            <br>
            <div class="inputGroup">
                <label for="">Towship Status <span style="color: red;">*</span></label> <br>
            <?php
                if ($row['TownshipStatus'] == "Active") {
                    echo   "<input type='radio' name='rdoStatus' value='Active' checked >Active";
                    echo   "<input type='radio' name='rdoStatus' value='Inactive'>Inactive";
                }
                else {
                    echo   "<input type='radio' name='rdoStatus' value='Active'>Active";
                    echo   "<input type='radio' name='rdoStatus' value='Inactive' checked >Inactive";
                }
            ?>
            </div>        
                <br><br>
            <div class="inputGroup">
                <label for="">Location Map<span style="color: red;">*</span></label> <br>
                <input type="text" name="txtMap" value="<?php echo $row['Map'] ?>">
                <br><br>
            </div>
                <input type="hidden" name="txtTownshipID" value="<?php echo $row['TownshipID'] ?>" /><br><br>
                <input class="btnFrmSubmit" type="submit" value="Update" name="btnUpdate"> <br/>
            </div>
    </form>
</div>
<script src="./Serenity_1.js"></script>
<script src="./modalBox.js"></script>
</body>
</html>