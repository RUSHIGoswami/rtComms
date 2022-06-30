<?php

namespace Myapp;


require "core/init.php";
if (isset($_SESSION['user_id'])) {
    redirect_to(url_for('index.php'));
}
if (is_request_post()) {
    if (isset($_POST['registerBtn'])) {
        $fname = FormSanitizer::sanitizeFormData($_POST['fname']);
        $lname = FormSanitizer::sanitizeFormData($_POST['lname']);
        $uname = FormSanitizer::sanitizeUsername($_POST['uname']);
        $email = FormSanitizer::sanitizeEmail($_POST['email']);
        $pass = FormSanitizer::sanitizePassword($_POST['pass']);
        $cpass = FormSanitizer::sanitizePassword($_POST['cpass']);

        $result = $account->register($fname, $lname, $uname, $email, $pass, $cpass);
        if ($result) {
            session_regenerate_id();
            $_SESSION['user_id'] = $result;
            redirect_to(url_for('index.php'));
        }
    }
}


require "shared/header.php"; ?>
<div class="container">
    <h1>Register Form</h1>
    <h2>To continue to rtComms...</h2>
    <form action="<?php echo h($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class="form-control">
            <input type="text" name="fname" value="<?php getInputValue('fname'); ?>" required>
            <?php echo $account->getError(Constant::$fnameChar) ?>
            <label>First Name</label>
        </div>
        <div class="form-control">
            <input type="text" name="lname" value="<?php getInputValue('lname'); ?>" required>
            <?php echo $account->getError(Constant::$lnameChar) ?>
            <label>Last Name</label>
        </div>
        <div class="form-control">
            <input type="text" name="uname" value="<?php getInputValue('uname'); ?>" required>
            <?php echo $account->getError(Constant::$unameChar) ?>
            <?php echo $account->getError(Constant::$unameTkn) ?>
            <label>Username</label>
        </div>
        <div class="form-control">
            <input type="email" name="email" value="<?php getInputValue('email'); ?>" required>
            <?php echo $account->getError(Constant::$emailTkn) ?>
            <?php echo $account->getError(Constant::$Invemail) ?>
            <label>Email</label>
        </div>
        <div class="form-control">
            <input type="password" name="pass" required>
            <?php echo $account->getError(Constant::$passerr) ?>
            <label>Password</label>
        </div>
        <div class="form-control">
            <input type="password" name="cpass" required>
            <?php echo $account->getError(Constant::$CpassErr); ?>
            <label>Confirm Password</label>
        </div>
        <input class="btn" type="submit" name="registerBtn" value="Register">
        <p class="text">Already have an account ? <a href="login.php">Login</a> </p>
    </form>
</div>

<script src="assets/js/script.js"></script>
</body>

</html>