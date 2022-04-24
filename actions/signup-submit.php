<?php
session_start();
include('../components/ip_check.php');
$user_status = getIPAddress();
if($_POST['username'] && $_POST['password']){
    include ('../db/db_conn.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username='".$username."'";
    $query = $conn->query($sql);
    if (!$query->num_rows) {
        if(strlen($username) >= 7 && strlen($username) <= 50){
        if(strlen($password) >= 8 && strlen($password) <= 250){
            if($user_status == "homer"){
                $role = "analyst";
            }else{
                $role = "customer";
            }
            $unique_id_val = rand(time(), 10000000000);
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, password, role, unique_id_val)
VALUES ('$username', '$password', '$role', '$unique_id_val')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['user_name'] = $username;
            $_SESSION['user'] = $unique_id_val;
            header('Location: ../pages/signedup.php?signedup=true');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
        }
    }
    }else{
        echo 'Username is already taken';
        header('Location: ../pages/signup.php?error=user-exists');
        exit();
    }
}else{
    echo "Entries do not exist";
    exit();
}
?>