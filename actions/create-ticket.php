<?php include('../components/header.php'); ?>
<?php if(!$_SESSION['user'] && !$_SESSION['user_name']){
    header('Location: ../');
}
?>
<?php 
if($_POST['category-select'] && $_POST['msg-content']){
    $category = $_POST['category-select'];
    $msg_content = strip_tags($_POST['msg-content']);
    if(strlen($msg_content) < 3000){
    $msg_content = addslashes($msg_content);
    $unique_user_id = $_SESSION['user'];
    $unique_user_name = $_SESSION['user_name'];
    $num1 = rand(000000, 99999);
    $num2 = rand(000000, 99999);
    $unique_ticket_id = $num1 . $num2;
    $last_edit_time = $mysqldate = date('Y-m-d H:i:s');
    include('../db/db_conn.php');
    echo strlen($msg_content);
    // create new message ticket with submitted values (category,  msg content, unique user id, unique ticket id for grouping messages, creation date for keeping order in ticket itself)
    $sql = "INSERT INTO messages (category, msg_content, unique_user_id, unique_ticket_id, last_edit_time, sender)
VALUES ('$category', '$msg_content', '$unique_user_id', '$unique_ticket_id', '$last_edit_time', '$unique_user_name')";
    if ($conn->query($sql) === TRUE) {
        echo "Ticket added successfully";
        header('Location: ../pages/home.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    }
    else{
        $too_many_chars = true;
    }
}
?>
<main class="create-ticket-container">
    <a href="javascript:history.go(-1)">&#60;- Go back</a>
    <h1 class="create-ticket-title">Create new ticket:</h1>
    <form class="create-ticket-form" id="create-ticket-form" method="POST" action="create-ticket.php">
        <span>
        <label for="subject" name="subject">Select category:</label>
        <select class="category-select" name="category-select">
            <option value="malware">Malware Removal</option>
            <option value="hosting">Hosting</option>
            <option value="ssl">SSL</option>
            <option value="domain">Domain/DNS</option>
            <option value="payment">Payment</option>
            <option value="settings">Account Settings</option>
        </select>
        </span>
        <span>
        <label for="msg-content" id="msg-content">Message:</label>
        <?php if($too_many_chars){ ?><span style="color:#ff6347;">Too many chars</span><?php } ?>
        <textarea maxlength="6000" name="msg-content" placeholder="Provide any additional details here..." class="create-ticket-msg" id="create-ticket-msg" style="resize:vertical;min-width:400px;min-height:100px;padding:7px;border-radius:6px;max-height:500px;"></textarea>
        </span>
        <button type="submit" class="create-ticket-btn" id="create-">Create</button>
    </form>
</main>
<?php include('../components/footer.php'); ?>