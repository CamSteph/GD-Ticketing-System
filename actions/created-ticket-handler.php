<?php session_start(); ?>
<?php 
if($_POST['category-select'] && $_POST['msg-content']){
    $category = htmlspecialchars($_POST['category-select']);
    $msg_content = htmlspecialchars($_POST['msg-content']);
    //$msg_content = mysqli_real_escape_string($msg_content);
    $unique_user_id = $_SESSION['user'];
    $num1 = rand(000000, 99999);
    $num2 = rand(000000, 99999);
    $unique_ticket_id = $num1 . $num2;
    $last_edit_time = $mysqldate = date('Y-m-d H:i:s');
    // echo $user_unique__id . '<br/>';
    // echo $category. '<br/>';
    // echo $msg_content . '<br/>';
    
    include('../db/db_conn.php');
    // create new message ticket with submitted values (category,  msg content, unique user id, unique ticket id for grouping messages, creation date for keeping order in ticket itself)
//     $stmt = $conn->prepare("INSERT INTO messages (category, msg_content, unique_user_id, unique_ticket_id, last_edit_time)
// VALUES (:category, :msg_content, :unique_user_id, :unique_ticket_id, :last_edit_time)");
// stmt->bindValue(':category', $category);
// stmt->bindValue(':msg_content', $msg_content);
// stmt->bindValue(':unique_user_id', $unique_user_id);
// stmt->bindValue(':unique_ticket_id', $unique_ticket_id);
// stmt->bindValue(':last_edit_time', $last_edit_time);
    $sql = "INSERT INTO messages (category, msg_content, unique_user_id, unique_ticket_id, last_edit_time)
VALUES ('$category', '$msg_content', '$unique_user_id', '$unique_ticket_id', '$last_edit_time')";
    if ($conn->query($sql) === TRUE) {
        echo "Ticket added successfully";
        header('Location: ../pages/home.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}else{
    echo "Invalid request.";
    exit();
}
?>