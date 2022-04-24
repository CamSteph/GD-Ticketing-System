<?php include('../components/header.php'); ?>
<?php 
$err = '';
if(isset($_GET['error'])){
    switch($_GET['error']){
        case 'user-exists':
            $err = "Username is already in use. Please try again.";
            break;
        case 'wrong-password':
            $err = "Password has invalid characters.";
            break;
        default:
            $err = "Something went wrong. Please try again.";
    }
    echo '<span style="background:#ff6347;position: absolute; right: 20px; top: 20px;color:#fff;padding: 5px;border-radius:6px;">' . $err . '</span>';
}
?>
<main class="login-container" id="login-container">
    <h1 class="login-header" id="login-header">GD Ticketing System</h1>
    <h2 class="login-title">Sign up:</h2>
    <form class="login-form" id="login-form" action="../actions/signup-submit.php" method="POST" name="loginForm">
        <span class="login-err-msg" id="login-err-msg">Err message here</span>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" placeholder="Enter username here..." required atuofocus>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Enter password here..." required>
        <button class="login-btn" id="login-btn">Sign up</button>
        <span class="sign-up-option" id="sign-up-option">Already have an account? Log in <a href="../">here</a>.</span>
    </form>
</main>
<script defer type="text/javascript" src="../scripts/login-validation.js"></script>
<!-- ../actions/signup-submit.php -->
<?php include('../components/footer.php'); ?>