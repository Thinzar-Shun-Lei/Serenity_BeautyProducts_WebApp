<?php
session_start();
include('connection.php');


    if(isset($_REQUEST['OrderID'])) {
        $orderid = $_REQUEST['OrderID'];
        $query1 = "SELECT * FROM Orders
                   WHERE OrderID = '$orderid'";
        $ret1 = mysqli_query($connection,$query1);
        $row = mysqli_fetch_array($ret1);
        $status = $row['OrderStatus'];
        if ($status !== "Confirmed") {
            $query = "UPDATE Orders 
                  SET OrderStatus = 'Cancelled'
                  WHERE OrderID = '$orderid'";
            $ret = mysqli_query($connection,$query);
            if($ret) {
                echo "<script>alert('The order has been cancelled.')</script>";
                echo "<script>window.location='Orders_Display.php'</script>";
            }
        }
        else {
            echo "<script>alert('This order has been confirmed already. Fail to Cancel the order.')</script>";
            echo "<script>window.location='Orders_Display.php'</script>";
        } 
    }
?>