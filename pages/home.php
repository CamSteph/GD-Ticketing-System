<?php include('../components/header.php'); ?>
<?php if(!$_SESSION['user'] && !$_SESSION['user_name']){
    header('Location: ../');
}
?>
<main class="home-container" id="home-container">
    <?php 
        include('../db/db_conn.php');
        $username = $_SESSION['user_name'];
        $sql = "SELECT * FROM users WHERE username='".$username."'";
        $query = $conn->query($sql);
        if ($query->num_rows) {
            while($row = $query -> fetch_row()){
                printf ("%s\n", $row[3]);
                $role = $row[3];
            }
            $row2 = mysqli_fetch_assoc($query);
        }else{
            echo "</br>Username isn't present: " . $_SESSION['user_name'];
        }
    ?>
    <h1 class="home-container-header">Welcome back, <?php echo $username; ?>!</h1>
    <button class="logout-btn" id="logout-btn" onclick="logout()">Logout -></button>
    <section class="ticket-list-section" id="ticket-list-section">
        <?php
        if($role == "customer"){
            echo "
                <script>
                const goToTicket = (val) => {
                    window.location.href = '../pages/ticket-page.php?ticket_id=' + val + '&role=customer';
                }
                </script>
            ";
        }else{
            echo "
                <script>
                const goToTicket = (val) => {
                    window.location.href = '../pages/ticket-page.php?ticket_id=' + val + '&role=analyst';
                }
                </script>
            ";
        }
    ?>
        <?php
            $outgoing_id = $_SESSION['user'];
            if($outgoing_id){
                if($role == 'customer'){
                    //echo '<br/>' . $role;
                $sql = "SELECT * FROM users WHERE unique_id_val ='".$outgoing_id."'";
                $query = $conn->query($sql);
                if($query){
                    if($query->num_rows){
                        while($row = mysqli_fetch_assoc($query)){
                            if($outgoing_id == $row['unique_id_val']){
                            $sql_two = "SELECT * FROM messages WHERE unique_user_id='".$outgoing_id."' GROUP BY unique_ticket_id ORDER BY last_edit_time DESC";
                            $query_two = $conn->query($sql_two);
                            if($query_two){
                                if($query_two->num_rows){
                                    while($row = mysqli_fetch_assoc($query_two)){
                                    $current_msg_content = $row['msg_content'];
                                    $current_msg_user_id = $row['unique_user_id'];
                                    $current_category = $row['category'];
                                    $unique_ticket_id = $row['unique_ticket_id'];
                                    $sender = $row['sender'];
                                    if($sender == $_SESSION['user_name']) $sender = 'You';
                                    $current_category = str_replace(' ', '</br>', $current_category);
                                    $ticket_info = "customer-" . $unique_ticket_id;
                                    echo '
                                    <div class="ticket-row-container" id="ticket-row-container" onclick="goToTicket('. $unique_ticket_id .')">
                                        <span class="ticket-row-name" id="ticket-row-name" style="font-size:14px;"> ' . strtoupper($current_category) . ' </span>
                                        <span class="ticket-row-message-conten" id="ticket-row-message-content" style="font-size:17px;margin:0 20px 0 20px;font-weight:bold;"> ' . $sender . ' </span>
                                        <span class="ticket-row-message-content" id="ticket-row-message-content">' . $current_msg_content . '</span>
                                        <input type="hidden" value="' . $unique_ticket_id . '">
                                    </div>';
                                    }
                                }else{
                                    echo'
                                    <div style="width:50vw;min-height:100px;display: grid;place-items:center;">
                                        <h2 style="color:grey;">No open tickets</h2>
                                    </div>
                                    ';
                                }
                            }else{
                                //echo 'query_two doesnt exist';
                            }
                            }
                        }
                        //echo '<br/>current_id: ' . $outgoing_id;
                    }else{
                        echo $conn->error;
                    }
                }
                }elseif ($role == 'analyst'){
                    //echo '<br/>' . $role;
                $sql = "SELECT * FROM users WHERE NOT unique_id_val ='".$outgoing_id."'";
                $sql = "SELECT * FROM users";
                $query = $conn->query($sql);
                if($query){
                    if($query->num_rows){
                        while($row = mysqli_fetch_assoc($query)){
                            if($outgoing_id == $row['unique_id_val']){
                            $sql_two = "SELECT * FROM messages WHERE NOT unique_user_id='".$outgoing_id."' GROUP BY unique_ticket_id ORDER BY last_edit_time DESC";
                            $query_two = $conn->query($sql_two);
                            if($query_two){
                                if($query_two->num_rows){
                                    while($row = mysqli_fetch_assoc($query_two)){
                                    $current_msg_content = $row['msg_content'];
                                    $current_msg_user_id = $row['unique_user_id'];
                                    $current_category = $row['category'];
                                    $unique_ticket_id = $row['unique_ticket_id'];
                                    $sender = $row['sender'];
                                    if($sender == $_SESSION['user_name']) $sender = 'You';
                                    $current_category = str_replace(' ', '</br>', $current_category);
                                    $href = '../actions/create-ticket.php';
                                    echo '
                                    <span style="display:flex;align-items:center;justify-content:space-between;">
                                    <div class="ticket-row-container" id="ticket-row-container" onclick="goToTicket(' . $unique_ticket_id . ')">
                                        <span class="ticket-row-name" id="ticket-row-name" style="font-size:14px;"> ' . strtoupper($current_category) . ' </span>
                                        <span class="ticket-row-message-conten" id="ticket-row-message-content" style="font-size:17px;margin:0 20px 0 20px;font-weight:bold;"> ' . $sender . ' </span>
                                        <span class="ticket-row-message-content" id="ticket-row-message-content">' . $current_msg_content . '</span>
                                        <input type="hidden" value="' . $unique_ticket_id . '">
                                    </div>
                                        <button class="ticket-row-delete-msg-btn" id="ticket-row-delete-msg-btn" onclick="deleteTicket(' . $unique_ticket_id . ')">Delete</button>
                                    </span>
                                    ';
                                    }
                                }else{
                                    echo'
                                    <div style="width:50vw;min-height:100px;display: grid;place-items:center;">
                                        <h2 style="color:grey;">No open tickets</h2>
                                    </div>
                                    ';
                                }
                            }else{
                                //echo 'query_two doesnt exist';
                            }
                            }
                        }
                        //echo '<br/>current_id: ' . $outgoing_id;
                    }else{
                        echo $conn->error;
                    }
                }
                }
            }else{
                echo "No ID.";
            }
        ?>
    </section>
    <?php if($role == "customer"){ ?><button class="create-new-ticket-btn" id="create-new-ticket-btn" onclick="createTicket()">Create new ticket</button> <?php } ?>
</main>
<script defer type="text/javascript" link="../scripts/logout.js"></script>
<script>
    const logout = () => {
        if(confirm('Are you sure you want to log out?')){
            window.location.href = "../actions/logout.php";
        }
    }
    const createTicket = () => {
        window.location.href = "../actions/create-ticket.php";
    }
    const deleteTicket = val => {
        if(confirm('Are you sure you want to delete this ticket?')){
            window.location.href = "../actions/delete-ticket.php?ticket_id=" + val;
        }
    }
</script>
<?php include('../components/footer.php'); ?>