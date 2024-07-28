<?php
function AddProduct($productID, $purchasePrice, $purchaseQty)
{
    include('connection.php');

    $query = "SELECT * FROM Products, Brands, Categories
                WHERE Products.BrandID = Brands.BrandID
                AND Products.CategoryID = Categories.CategoryID
                AND Products.ProductID = '$productID'";
    $ret = mysqli_query($connection, $query);
    $count = mysqli_num_rows($ret);
    $arr = mysqli_fetch_array($ret);
    // data fetch from database
    $productName = $arr['ProductName'];
    $brandName = $arr['BrandName'];
    $categoryName = $arr['CategoryName'];
    $productImg = $arr['Image2'];



    if ($count < 1) {
        echo "<h3>No product is found.</h3>";
        exit();
    }

    if (isset($_SESSION['AddProduct'])) { //if there is session
        $Index=IndexOf($productID);
		if($Index == -1) 
		{
			$size=count($_SESSION['AddProduct']);
            
            $_SESSION['AddProduct'][$size]['ProductID'] = $productID; 
            $_SESSION['AddProduct'][$size]['ProductPrice'] = $purchasePrice;
            $_SESSION['AddProduct'][$size]['ProductQty'] = $purchaseQty;
            $_SESSION['AddProduct'][$size]['ProductName'] = $productName;
            $_SESSION['AddProduct'][$size]['ProductPrice'] = $purchasePrice;
            $_SESSION['AddProduct'][$size]['BrandName'] = $brandName;
            $_SESSION['AddProduct'][$size]['CategoryName'] = $categoryName;
            $_SESSION['AddProduct'][$size]['ProductImage'] = $productImg;
			
		}
		else
		{
			$_SESSION['AddProduct'][$Index]['ProductQty']+=$purchaseQty;
		}
    } else { //if there is no session
        $_SESSION['AddProduct'] = array(); //create Session Array
        $_SESSION['AddProduct'][0]['ProductID'] = $productID; // row col
        $_SESSION['AddProduct'][0]['ProductPrice'] = $purchasePrice;
        $_SESSION['AddProduct'][0]['ProductQty'] = $purchaseQty;
        $_SESSION['AddProduct'][0]['ProductName'] = $productName;
        // $_SESSION['AddProduct'][0]['ProductPrice'] = $purchasePrice;
        $_SESSION['AddProduct'][0]['BrandName'] = $brandName;
        $_SESSION['AddProduct'][0]['CategoryName'] = $categoryName;
        $_SESSION['AddProduct'][0]['ProductImage'] = $productImg;
    }
}


function RemoveProduct($ProductID)
{
    $Index = IndexOf($ProductID);

    unset($_SESSION['AddProduct'][$Index]);

    $_SESSION['AddProduct'] = array_values($_SESSION['AddProduct']);

    echo "<script>window.location='Purchase.php'</script>";
}

function CalculateTotalAmount()
{
	if(isset($_SESSION['AddProduct'])) 
	{
		$TotalAmount=0;

		$size=count($_SESSION['AddProduct']);

		for ($i=0; $i < $size; $i++) 
		{ 
			$TotalAmount += ($_SESSION['AddProduct'][$i]['ProductQty'] * $_SESSION['AddProduct'][$i]['ProductPrice']);
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
	if(isset($_SESSION['AddProduct'])) 
	{
		$TotalQuantity=0;

		$size=count($_SESSION['AddProduct']);

		for ($i=0; $i < $size; $i++) 
		{ 
			$PurchaseQuantity=$_SESSION['AddProduct'][$i]['ProductQty'];
			$TotalQuantity += ($PurchaseQuantity);
		}

		return $TotalQuantity;
	}
	else
	{
		$TotalQuantity=0;

		return $TotalQuantity;
	}
}
function IndexOf($ProductID)
{
    if (!isset($_SESSION['AddProduct'])) {
        return -1;
    }
    if (isset($_SESSION['AddProduct'])) {
        $size = count($_SESSION['AddProduct']);
        if ($size < 1) {
            return -1;
        } else {
            for ($i = 0; $i < $size; $i++) {
                if ($ProductID == $_SESSION['AddProduct'][$i]['ProductID']) {
                    return $i;
                }
            }
            return -1;
        }
    }
}
