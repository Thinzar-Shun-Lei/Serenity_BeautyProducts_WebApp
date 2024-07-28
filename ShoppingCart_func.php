<?php
 function AddToCart($pid,$qty) {
    include('connection.php');

    $query = "SELECT * FROM Products p, Categories c, Brands b
    WHERE p.CategoryID = c.CategoryID
    AND p.BrandID = b.BrandID
    AND p.ProductID = '$pid'";
    $ret = mysqli_query($connection,$query);
    $row = mysqli_fetch_array($ret);
    $count = mysqli_num_rows($ret);

    $productID = $row['ProductID'];
    $productName = $row['ProductName'];
    $price = $row['SellPrice'];
    $catName = $row['CategoryName'];
    $image = $row['Image3'];
    // $productQty = $qty;

    if ($count < 1) {
        echo "<h3>No product is found.</h3>";
        exit();
    }

    if (isset($_SESSION['Cart'])) { //if there is session
        $Index=IndexOf($pid);
		if($Index == -1) 
		{
			$size=count($_SESSION['Cart']);
            
            $_SESSION['Cart'][$size]['ProductID'] = $pid; 
            $_SESSION['Cart'][$size]['ProductName'] = $productName; 
            $_SESSION['Cart'][$size]['SellPrice'] = $price;
            $_SESSION['Cart'][$size]['CategoryName'] = $catName;
            $_SESSION['Cart'][$size]['Image1'] = $image;
            $_SESSION['Cart'][$size]['PQty'] = $qty;
            // $_SESSION['Cart'][$size]['TotalCount'] += 1;
			
		}
		else
		{
			$_SESSION['Cart'][$Index]['PQty']+=$qty;
		}
    } else { //if there is no session
        $_SESSION['Cart'] = array(); //create Session Array
       
        $_SESSION['Cart'][0]['ProductID'] = $pid; 
        $_SESSION['Cart'][0]['ProductName'] = $productName; 
        $_SESSION['Cart'][0]['SellPrice'] = $price;
        $_SESSION['Cart'][0]['CategoryName'] = $catName;
        $_SESSION['Cart'][0]['Image1'] = $image;
        $_SESSION['Cart'][0]['PQty'] = $qty;
        // $_SESSION['Cart'][0]['TotalCount'] = 1; //Count of product types
    }
 }

 function AddTsp($townshipID)
 {
     include('connection.php');
 
     $query1 = "SELECT * FROM Townships WHERE TownshipID = '$townshipID'";
     $ret1 = mysqli_query($connection, $query1);
     $count1 = mysqli_num_rows($ret1);
     $arr1 = mysqli_fetch_array($ret1);
     // data fetch from database
     $townshipName = $arr1['TownshipName'];
     $deliveryFee = $arr1['DeliveryFee'];
 
         //$_SESSION['AddProduct'] = array(); //create Session Array
         $_SESSION['TownshipName'] = $townshipName; // row col
         $_SESSION['DeliveryFee'] = $deliveryFee;
         $_SESSION['TownshipID'] = $townshipID;

         
 }
 
 function RemoveProduct($ProductID)
 {
     $Index = IndexOf($ProductID);
 
     unset($_SESSION['Cart'][$Index]);
 
     $_SESSION['Cart'] = array_values($_SESSION['Cart']);
 
     echo "<script>window.location='ShoppingCart.php'</script>";
 } 

 //can show totalQty
 function CalculateTotalAmount()
 {
     if(isset($_SESSION['Cart'])) 
     {
         $TotalAmount=0;
 
         $size=count($_SESSION['Cart']);
 
         for ($i=0; $i < $size; $i++) 
         { 
             // $purchaseQty=$_SESSION['AddProduct'][$i]['ProductQty'];
             // $purchasePrice=$_SESSION['AddProduct'][$i]['PurchasePrice'];
             // $TotalAmount += ($purchaseQty * $purchasePrice);
             $TotalAmount += ($_SESSION['Cart'][$i]['PQty'] * $_SESSION['Cart'][$i]['SellPrice']);
         }
 
         return $TotalAmount;
     }
     else
     {
         $TotalAmount=0;
 
         return $TotalAmount;
     }
 }

 function CalculateTotalQuantity()
{
	if(isset($_SESSION['Cart'])) 
	{
		$TotalQuantity=0;

		$size=count($_SESSION['Cart']);

		for ($i=0; $i < $size; $i++) 
		{ 
			$ProductQuantity=$_SESSION['Cart'][$i]['PQty'];
			$TotalQuantity += ($ProductQuantity);
		}

		return $TotalQuantity;
	}
	else
	{
		$TotalQuantity=0;

		return $TotalQuantity;
	}
}
function IndexOf($pid) {
    if (!isset($_SESSION['Cart'])) {
        return -1;
    }
    if (isset($_SESSION['Cart'])) {
        $size = count($_SESSION['Cart']);
        if ($size < 1) {
            return -1;
        } else {
            for ($i = 0; $i < $size; $i++) {
                if ($pid == $_SESSION['Cart'][$i]['ProductID']) {
                    return $i;
                }
            }
            return -1;
        }
    }
}



?>