<?php

namespace Myapp;

require "core/init.php";
if (isset($_SESSION['user_id'])) {
    redirect_to(url_for('index.php'));
}
if (is_request_post()) {
    if (isset($_POST['loginBtn'])) {
        $uname = FormSanitizer::sanitizeUsername($_POST['uname']);
        $pass = FormSanitizer::sanitizePassword($_POST['pass']);

        $result = $account->login($uname, $pass);
        if ($result) {
            session_regenerate_id();
            $_SESSION['user_id'] = $result;
            redirect_to(url_for('index.php'));
        }
    }
}

$pageTitle = 'Login';
require "shared/header.php";
?>
<div class="container">
    <h1>Login to 11Mantras</h1>
    <form action="<?php echo h($_SERVER['PHP_SELF']); ?>" method="POST">
        <?php echo $account->getError(Constant::$loginerror); ?>
        <div class="form-control">
            <input type="text" name="uname" value="<?php getInputValue('uname'); ?>" required>
            <label>Username or Email</label>
        </div>
        <div class="form-control">
            <input type="password" name="pass" required>
            <label>Password</label>
        </div>
        <input class="btn" type="submit" name="loginBtn" value="Register">
        <p class="text">Don't have an account ? <a href="register.php">Register</a> </p>
    </form>
</div>
<script src="assets/js/script.js"></script>
</body>

</html>