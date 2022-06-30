<?php

require "../init.php";

if (is_request_post()) {
    if (isset($_POST['userid']) && !empty($_POST['userid'])) {
        $userid = h($_POST['userid']);
        $otherid = h($_POST['otherid']);
        if ($userid == $loadfromUser->userId) {
            $users = $loadfromUser->getConnectedPeers();
            foreach ($users as $user) {
                $activeclass = ((!empty($otherid) == $user->uid) ? 'activeClass' : ' ');
                echo '
                        <div class="user-connected">
                        <div class="u-connected-wrapper">
                            <img style="border-radius:50%" width="40px" height="40px" src="' . url_for($user->profile_img) . '" alt="' . $user->fname . ' ' . $user->lname . '">
                        </div>
                        <span class="u-connected-name">' . $user->fname . ' ' . $user->lname . '</span>
                        <div class="u-icons">
                    <a href="' . url_for($user->uname . '/videochat') . '"  ' . $activeclass . '" data-profileid="' . $user->uid . '">
                            <svg class="cam-icon-connected video-call" xmlns="http://www.w3.org/2000/svg" focusable="false" width="24" height="24" viewBox="0 0 24 24" class="Hdh4hc cIGbvc NMm5M">
                                <path d="M18 10.48V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-4.48l4 3.98v-11l-4 3.98zm-2-.79V18H4V6h12v3.69z" />
                            </svg>
                    </a>
                    <a href="' . url_for($user->uname . '/chat') . '" ' . $activeclass . '" data-profileid="' . $user->uid . '">
                            <i class="fa fa-comments audio-icon audio-call"></i>
                    </a>
                        </div>
                        </div>
                    ';
            }
        }
    }
}
