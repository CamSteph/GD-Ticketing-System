<?php include('../components/header.php'); ?>
<?php if(!$_SESSION['user'] && !$_SESSION['user_name'] && !$_GET['signedup']){
    header('Location: ../');
}
?>
<main class="success-msg>-container" style="text-align:center;">
    <h1 class="success-title" style="margin-bottom:20px;">Thank you for choosing us! 😊</h1>
    <h3 class="success-click-here">Click <a href="../pages/home.php" style="color:#66b2b2;">here</a> to go to the dashboard.</span>
</main>