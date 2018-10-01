<?php
   
    $con = mysqli_connect("localhost", "id6685101_97032", "maqojana1997", "id6685101_mydatabase");
    
    $username = $_POST["name"];
    $password = $_POST["username"];
    
    $statement = mysqli_prepare($con, "SELECT * FROM user WHERE username = ?");
    mysqli_stmt_bind_param($statement, "s", $username);
    mysqli_stmt_execute($statement);
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $colUserID, $colName, $colSurname, $colUsername, $colDOB, $colGender);
    
    $response = array();
    $response["success"] = false;  
    
    while(mysqli_stmt_fetch($statement)){
        if (username_verify($username, $colUsername)) {
            $response["success"] = true;  
            $response["name"] = $colName;
            $response["surnmae"] = $colSurname;
        }
    }
    echo json_encode($response);
?>
