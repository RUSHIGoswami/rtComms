<?php
function h($string = '')
{
    return htmlspecialchars($string);
}

function is_request_post()
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function getInputValue($input)
{
    if (isset($_POST[$input])) {
        echo $_POST[$input];
    }
}

function logOut()
{
    unset($_SESSION['user_id']);
    $_SESSION = array();
    session_destroy();
    session_regenerate_id();
    return true;
}

function url_for($script)
{
    return WWW_ROOT . $script;
}

function redirect_to($location)
{
    header("Location:" . $location);
    exit;
}
