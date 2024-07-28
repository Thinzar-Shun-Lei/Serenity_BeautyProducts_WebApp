<?php
function AddDeli($orderID)
{
    include('connection.php');

    // echo $orderID;
    // echo $deliDate;
    $query = "SELECT * FROM Orders o, Customers c, Townships t
              WHERE o.OrderID = '$orderID'
              AND o.CustomerID = c.CustomerID
              AND o.TownshipID = t.TownshipID";
    $ret = mysqli_query($connection, $query);
    $arr = mysqli_fetch_array($ret);
    $count = mysqli_num_rows($ret);
    // data fetch from database
    $orderID = $arr['OrderID'];
    $orderDate = $arr['OrderDate'];
    $cusName = $arr['CustomerName'];
    $tspName = $arr['TownshipName'];
    $deliAddress = $arr['DeliveryAddress'];
    $phone = $arr['ContactPhone'];
    $payment = $arr['PaymentType'];
    $orderSts = $arr['OrderStatus'];
    $deliFee = $arr['DeliveryFee'];


    if ($count < 1) {
        echo "<h3>No product is found.</h3>";
        exit();
    }

    if (isset($_SESSION['AddDeli'])) { //if there is session
        $Index=IndexOf($orderID);
		if($Index == -1) 
		{
			$size=count($_SESSION['AddDeli']);

            // $_SESSION['AddDeli'][$size]['DeliDate'] = $deliDate;
            $_SESSION['AddDeli'][$size]['OrderID'] = $orderID; 
            $_SESSION['AddDeli'][$size]['OrderDate'] = $orderDate;
            $_SESSION['AddDeli'][$size]['CustomerName'] = $cusName;
            $_SESSION['AddDeli'][$size]['TownshipName'] = $tspName;
            $_SESSION['AddDeli'][$size]['DeliveryAddress'] = $deliAddress;
            // $_SESSION['AddDeli'][$size]['DeliDate'] = $deliDate;
            $_SESSION['AddDeli'][$size]['ContactPhone'] = $phone;
            $_SESSION['AddDeli'][$size]['PaymentType'] = $payment;
            $_SESSION['AddDeli'][$size]['OrderStatus'] = $orderSts;
            $_SESSION['AddDeli'][$size]['DeliveryFee'] = $deliFee;
            

            
			
		}

    } else { //if there is no session
        $_SESSION['AddDeli'] = array(); //create Session Array
            // $_SESSION['AddDeli'][0]['DeliDate'] = $deliDate;
            $_SESSION['AddDeli'][0]['OrderID'] = $orderID; 
            // $_SESSION['AddDeli'][0]['DeliveryID'] = $deliveryID; 
            $_SESSION['AddDeli'][0]['OrderDate'] = $orderDate;
            $_SESSION['AddDeli'][0]['CustomerName'] = $cusName;
            $_SESSION['AddDeli'][0]['TownshipName'] = $tspName;
            $_SESSION['AddDeli'][0]['DeliveryAddress'] = $deliAddress;
            $_SESSION['AddDeli'][0]['ContactPhone'] = $phone;
            $_SESSION['AddDeli'][0]['PaymentType'] = $payment;
            $_SESSION['AddDeli'][0]['OrderStatus'] = $orderSts;
            $_SESSION['AddDeli'][0]['DeliveryFee'] = $deliFee;

    }
}


function RemoveOrder($OrderID)
{
    $Index = IndexOf($OrderID);

    unset($_SESSION['AddDeli'][$Index]);

    $_SESSION['AddDeli'] = array_values($_SESSION['AddDeli']);

    echo "<script>window.location='Delivery_Display.php'</script>";
}

function IndexOf($OrderID)
{
    if (!isset($_SESSION['AddDeli'])) {
        return -1;
    }
    if (isset($_SESSION['AddDeli'])) {
        $size = count($_SESSION['AddDeli']);
        if ($size < 1) {
            return -1;
        } else {
            for ($i = 0; $i < $size; $i++) {
                if ($OrderID == $_SESSION['AddDeli'][$i]['OrderID']) {
                    return $i;
                }
            }
            return -1;
        }
    }
}