<?php 

require "core/init.php";
if(isset($_SESSION['user_id'])){
    logOut();
    redirect_to(url_for('login.php'));
}