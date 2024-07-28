<?php
session_start();
include('connection.php');


    if(isset($_REQUEST['ContactID'])) {
        $contactid = $_REQUEST['ContactID'];
        $query1 = "SELECT * FROM Contacts
                   WHERE ContactID = '$contactid'";
        $ret1 = mysqli_query($connection,$query1);
        $row = mysqli_fetch_array($ret1);
        $status = $row['ContactStatus'];
        if ($status !== "Contacted") {
            $query = "UPDATE Contacts 
                  SET ContactStatus = 'Contacted'
                  WHERE ContactID = '$contactid'";
            $ret = mysqli_query($connection,$query);
            if($ret) {
                echo "<script>alert('Successfully Updated.')</script>";
                echo "<script>window.location='Customers_Display.php'</script>";
            }
        }
        else {
            echo "<script>alert('This customer has been contacted already')</script>";
            echo "<script>window.location='Customers_Display.php'</script>";
        } 
    }
?>