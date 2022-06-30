<?php

require "../init.php";

if (is_request_post()) {
    if (isset($_POST['reciever']) && !empty($_POST['reciever'])) {
        $reciever = (int)h($_POST['reciever']);
        $calleeData = $loadfromUser->userData($reciever);
        echo json_encode(array(
            "sender" => $loadfromUser->userId,
            "receiver" => $calleeData->uid,
            "name" => $calleeData->fname . ' ' . $calleeData->lname,
            "profileImg" => $calleeData->profile_img
        ));
    }
}
