<?php
function autoID($tableName, $fieldName, $Prefix, $noOfLeadingZeros) {
    include('connection.php');
    $newID = "";
    $sql = "";
    $value = 1;

    $sql = "SELECT " . $fieldName . " FROM " . $tableName . " ORDER BY " . $fieldName . " DESC LIMIT 1";
    // Added spaces between keywords and identifiers, and added LIMIT 1 to get only the latest ID
    
    $query = mysqli_query($connection, $sql);
    $ret = mysqli_num_rows($query);
    $row = mysqli_fetch_array($query);

    if($ret < 1) {
        return $Prefix . str_pad($value, $noOfLeadingZeros, '0', STR_PAD_LEFT);
    } else {
        $lastID = $row[$fieldName];
        $lastID = substr($lastID, strlen($Prefix)); // Remove prefix from last ID
        $value = (int)$lastID + 1; // Increment ID
        return $Prefix . str_pad($value, $noOfLeadingZeros, '0', STR_PAD_LEFT);
    }
}
?>

