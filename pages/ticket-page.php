<?php include('../components/header.php'); ?>
<?php if(!$_SESSION['user'] && !$_SESSION['user_name']){
    header('Location: ../');
}
if($_GET['ticket_id'] && $_GET['ticket_id'] != 'undefined' && $_GET['ticket_id'] != '' && is_numeric($_GET['ticket_id'])){
    include ('../db/db_conn.php');
    $sql = "SELECT * FROM messages WHERE unique_ticket_id='".$_GET['ticket_id']."'";
    $query = $conn->query($sql);
    if($query){
        if ($query->num_rows) {
            $ticket_id = $_GET['ticket_id'];
        }else{
            header('Location: ../pages/home.php');
        }
    }else{
        echo "No messages for this ticket";
    }
}else{
    header('Location: ../pages/home.php');
}

if($_POST['reply-content']){
    $reply_content = strip_tags($_POST['reply-content']);
    if(strlen($reply_content) <= 3000){
        $reply_content = addslashes($reply_content);
        $ticket_id = $_GET['ticket_id'];
        $last_edit_time = $mysqldate = date('Y-m-d H:i:s');
        $unique_user_name = $_SESSION['user_name'];
        $unique_user_id = $_SESSION['user'];
        $sql2 = "INSERT INTO messages (category, msg_content, unique_user_id, unique_ticket_id, last_edit_time, sender)
VALUES ('reply_msg', '$reply_content', '$unique_user_id', '$ticket_id', '$last_edit_time', '$unique_user_name')";
    if ($conn->query($sql2) === TRUE) {
        //echo "<script>location.reload();</script>";
        // header('Location: '.$_SERVER['PHP_SELF']);
        header("Refresh:1");
    }else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
}
}
?>
<style>
    body{
        overflow-x:hidden;
    }
    .send-form{
    display: flex;
    flex-direction: row;
    align-items: flex-end;
    justify-content: space-around;
}

.send-btn{
    padding: 7px 16px 7px 16px;
    border: none;
    border-radius: 6px;
    color: #fff;
    font-weight: 900;
    font-size: 17px;
    transition: all 1.5 ease;
    background: #66b2b2;
    margin-left: 10px;
    cursor: pointer;
}

.send-btn:hover{
    transform: scale(.9);
}
</style>
<main class="ticket-page-container">
    <span style="display: flex;width:50vw;justify-content:space-around;align-items:center;">
        <a href="home.php">Go back</a>
        <h1 class="ticket-page-title"><?php echo "Ticket #: " . $ticket_id; ?></h1>
    </span>
    <section class="ticket-content-section" id="ticket-content-section">
        <?php 
            while($row = $query -> fetch_row()){
                //printf ("%s (%s)\n", $row[2], $row[1]);
                $analyst_msg = '';
                if($row[3] == $_SESSION['user']){
                    $analyst_msg = ' analyst_msg';
                    $row[2] = stripslashes($row[2]);
                    echo "
                        <span class='ticket-time' style='color:#777;font-size:11px;'>$row[5] UTC</span>
                        <div class='ticket-msg-container' style='min-height:35px;background:#F1F1F1;'>
                            <span class='ticket-sender-name' style='font-weight:900;'>You:</span>
                            <span class='ticket-msg-content'>$row[2]</span>
                        </div>
                    ";
                }else{
                    echo "
                        <span class='ticket-time' style='color:#777;font-size:11px;'>$row[5] UTC</span>
                        <div class='ticket-msg-container' style='min-height:35px;background:#b2d8d8'>
                            <span class='ticket-sender-name' style='font-weight:900;'>$row[6]:</span>
                            <span class='ticket-msg-content'>$row[2]</span>
                        </div>
                    ";
                }
            }
        ?>
    </section>
    <script>
        let section = document.getElementById('ticket-content-section');
        section.scrollTop = section.scrollHeight;
    </script>
    <?php if($_GET['role'] == 'analyst'){ ?>
    <section class="canned-response-section" style="margin:15px;cursor:pointer;">
        <span class="canned-response-option" style="cursor:pointer;" onclick="fillText('case-assigned')">Case Assigned</span>
        <span class="canned-response-option" style="cursor:pointer;" onclick="fillText('credentials')"> <b style="cursor:default;">&nbsp;|</b> &nbsp;Need working credentials <b style="cursor:default;"> &nbsp;|&nbsp;</b> </span>
        <span class="canned-response-option" style="cursor:pointer;" onclick="fillText('what-are-you-seeing')">What are you seeing</span>
    </section>
    <?php } ?>
    <form method="POST" action"ticket-page.php" class="send-form">
    <textarea name="reply-content" class="reply-section" id="reply-content" style="border-radius:6px;resize:vertical;min-height:155px;width:50vw;padding:12px;font-size:17px;"></textarea>
    <button type="submit" class="send-btn">Send</button>
    </form>
    </span>
</main>
<script>
    const fillText = val => {
        val = val.toString();
        const replyContent = document.getElementById('reply-content');
        switch(val){
            case 'case-assigned':
                replyContent.value = `Hi there,

I've got your ticket assigned and I am taking a look right now.

I will keep you posted with any progress that I make.`;
                break;
            case 'credentials':
                replyContent.value = `Hey there!

It looks like the supplied credentials aren't working on our end. We're currently receiving a 'incorrect username/password' error.

Do you mind kindly double-checking that information and getting back to us?

Thanks, talk to you soon! 😊`;
                break;
            case 'what-are-you-seeing':
                replyContent.value = `Hi there!

We've just completed performing a manual audit on your website and didn't find any malicious content. We also don't see your site on any block lists at the moment.

What makes you think your site is infected? Please send over any details that might assist in our investigation.

Thank you! 😊`;
                break;
            default:
                replyContent.value = '';
        }
    }
</script>
<?php include('../components/footer.php'); ?>