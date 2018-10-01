<?php
    
    $connect = mysqli_connect("localhost", "id6685101_97032", "maqojana199*", "id6685101_mydatabase");
    
    $name = $_POST["name"];
    $age = $_POST["surname"];
    $username = $_POST["username"];
    $password = $_POST["dob"];
    $gender = $_POST["gender"]
     function registerUser() {
        global $connect, $name, $surname, $username, $dob, $gender;
        $statement = mysqli_prepare($connect, "INSERT INTO user (name, surname, username, dob, 'gender') VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($statement, "siss", $name, $surname, $username, $dob, $gender);
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);     
    }
    function usernameAvailable() {
        global $connect, $username;
        $statement = mysqli_prepare($connect, "SELECT * FROM user WHERE username = ?"); 
        mysqli_stmt_bind_param($statement, "s", $username);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        $count = mysqli_stmt_num_rows($statement);
        mysqli_stmt_close($statement); 
        if ($count < 1){
            return true; 
        }else {
            return false; 
        }
    }
    $response = array();
    $response["success"] = false;  
    if (usernameAvailable()){
        registerUser();
        $response["success"] = true;  
    }
    
    echo json_encode($response);
?>
