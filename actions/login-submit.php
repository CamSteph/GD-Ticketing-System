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
    if ($query->num_rows) {
        //error_log("The username DOES exist.", 0);
        if(strlen($username) >= 7 && strlen($username) <= 50){
        if(strlen($password) >= 8 && strlen($password) <= 250){
            while($row = mysqli_fetch_assoc($query)){
                echo $row['password'];
                echo $password;
                if(password_verify($password, $row['password'])){
                    echo "<br/>Your password is correct";
                    //$session_uid = session_create_id('gd-ticketing-');
                    $today = date('YmdHi');
                    $num = rand(100000000, 9999999999);
                    $session_uid = $row['unique_id_val'];
                    $_SESSION['user'] = $session_uid;
                    $_SESSION['user_name'] = $username;
                    echo 'user_name: ' . $_SESSION['user_name'];
                    header('Location: ../pages/home.php');
                }else{
                    echo "<div>Password is wrong</div>";
                    header('Location: ../?error=wrong-password');
                }
            }
        $conn->close();
        }
    }
    }else{
        echo 'Username does not exist';
        header('Location: ../?error=wrong-username');
        exit();
    }
}else{
    echo "Entries do not exist";
    exit();
}
?>