<?php

use MyApp\FormSanitizer;

require "core/init.php";
if (!isset($_SESSION['user_id'])) {
    redirect_to(url_for("login.php"));
}
if (isset($_GET['uname']) && !empty($_GET['uname'])) {
    $uname = FormSanitizer::sanitizeUsername($_GET['uname']);
    $profileData = $loadfromUser->getUserbyUsername($uname);
    if (!$profileData) {
        redirect_to(url_for("index.php"));
    }
    $pageTitle = "Video Call with " . $profileData->fname . ' ' . $profileData->lname;
    $profileId = $profileData->uid;
}
// 
$loadfromUser->updateSession();
$userData = $loadfromUser->userData();

require "shared/header.php";
?>
<div class="u-p-id" data-userid="<?= $userData->uid; ?>" data-profileid="<?= $profileId; ?>"></div>
<header class="g-header">
    <div class="site-logo">
        <a href="<?php echo url_for("index.php"); ?>" class="anchor">
            <img src="<?= url_for("assets/images/11mantras.jpg"); ?>" width="40" height="40" alt="">
        </a>
    </div>
    <div class="g-header-right">
        <span class="user-status"><?php echo $userData->onlineStatus; ?></span>
        <div class="user-wrapper">
            <img src="<?= url_for($userData->profile_img); ?>" alt="<?= $userData->fname . ' ' . $userData->lname; ?>" height="40px" width="40px">
            <span class="username"><?= $userData->fname . ' ' . $userData->lname; ?></span>
        </div>
        <a href="<?php echo url_for('logout.php'); ?>" class="logout-status">
            <i class="fa fa-sign-out"></i>
        </a>
    </div>
</header>
<section class="page-container">
    <aside>
        <div class="top-aside">
            <div class="nf-1 custom-style">

                <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="205.000000pt" height="246.000000pt" viewBox="0 0 205.000000 246.000000" preserveAspectRatio="xMidYMid meet">

                    <g transform="translate(0.000000,246.000000) scale(0.100000,-0.100000)" fill="#008066" stroke="none">
                        <path d="M969 2331 c-17 -18 -29 -40 -29 -56 0 -14 -6 -27 -12 -29 -7 -2 -47
-11 -90 -20 -241 -53 -461 -243 -551 -475 -54 -138 -57 -171 -57 -607 l0 -401
-101 -117 c-82 -95 -100 -122 -97 -144 l3 -27 970 -3 c534 -1 980 0 993 3 44
11 27 48 -77 171 l-100 117 -3 426 c-4 471 -5 474 -74 620 -81 173 -198 292
-371 379 -67 34 -191 72 -235 72 -25 0 -28 4 -28 31 0 39 -48 89 -85 89 -16 0
-38 -12 -56 -29z m226 -228 c168 -42 342 -181 422 -338 75 -146 75 -150 80
-615 l5 -415 59 -80 60 -80 -395 -3 c-217 -1 -575 -1 -796 0 l-401 3 60 80 60
80 3 415 c4 356 7 424 22 475 69 241 275 437 506 484 114 23 208 21 315 -6z" />
                        <path d="M605 318 c33 -153 205 -258 420 -258 136 0 252 39 330 111 50 46 78
93 88 147 l7 32 -63 0 c-63 0 -63 0 -76 -35 -34 -95 -222 -154 -381 -121 -97
21 -159 58 -185 113 l-20 42 -63 1 -64 0 7 -32z" />
                    </g>
                </svg>

                <div class="nf-text">Notifications</div>
            </div>
            <div class="nf-2 custom-style active" style="flex:2.2">
                <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="20.000000pt" height="20.000000pt" viewBox="0 0 20.000000 20.000000" preserveAspectRatio="xMidYMid meet">

                    <g transform="translate(0.000000,20.000000) scale(0.100000,-0.100000)" fill="#008066" stroke="none">
                        <path d="M50 130 c0 -15 5 -20 18 -18 9 2 17 10 17 18 0 8 -8 16 -17 18 -13 2
-18 -3 -18 -18z" />
                        <path d="M115 140 c-8 -14 3 -30 21 -30 8 0 14 9 14 20 0 21 -24 28 -35 10z" />
                        <path d="M28 79 c-32 -18 -19 -29 37 -29 56 0 70 11 36 30 -25 13 -51 12 -73
-1z" />
                        <path d="M142 73 c3 -19 48 -32 48 -14 0 10 -31 31 -45 31 -4 0 -5 -8 -3 -17z" />
                    </g>
                </svg>
                <div class="nf-text">Connected Peers</div>
            </div>
            <div class="nf-3 custom-style">
                <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="240.000000pt" height="240.000000pt" viewBox="0 0 240.000000 240.000000" preserveAspectRatio="xMidYMid meet">

                    <g transform="translate(0.000000,240.000000) scale(0.100000,-0.100000)" fill="#008066" stroke="none">
                        <path d="M761 2379 c-294 -63 -531 -247 -661 -514 -71 -144 -94 -247 -94 -415
0 -168 23 -271 94 -415 122 -250 356 -439 625 -507 136 -34 334 -32 467 5 134
37 282 113 361 186 l28 25 372 -372 372 -372 38 37 37 38 -372 372 -372 372
25 28 c73 79 149 227 186 361 37 133 39 331 5 467 -30 119 -106 271 -183 368
-122 153 -321 281 -509 327 -127 32 -299 35 -419 9z m424 -114 c112 -33 201
-79 294 -154 136 -108 235 -256 287 -426 24 -80 27 -106 27 -235 0 -129 -3
-155 -27 -235 -34 -113 -81 -202 -155 -294 -108 -136 -256 -235 -426 -287 -80
-24 -106 -27 -235 -27 -129 0 -155 3 -235 27 -170 52 -318 151 -426 287 -74
92 -121 181 -155 294 -24 80 -27 106 -27 235 0 129 3 155 27 235 34 113 81
202 155 294 129 162 316 273 528 311 89 16 269 4 368 -25z" />
                    </g>
                </svg>

                <div class="nf-text">Search</div>
            </div>
        </div>
        <div class="g-users"></div>
        <div class="g-search hidden">Search</div>
        <div class="g-notify-msg hidden">Notifications</div>
    </aside>
    <main class="main-content">
        <div class="call-wrap">
            <video id="local-video" autoplay playinline></video>
            <div class="remote-video-wrap">
                <div class="call-hang-status">
                    <div class="calling-status-wrap" id="conf-int">
                        <div class="user-connected-img">
                            <img src="<?= url_for($profileData->profile_img); ?>" alt="<?= $profileData->fname . ' ' . $profileData->lname; ?>">
                        </div>
                        <div class="user-status-text">
                            <div class="user-calling-status">Make a call with &nbsp;</div>
                            <div class="user-connected-name"><?= ' ' . $profileData->fname . ' ' . $profileData->lname; ?></div>
                        </div>
                        <div class="calling-action">
                            <div class="video-call" data-profileid="<?= $profileData->uid; ?>" data-userid="<?= $userData->uid; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" focusable="false" width="24" height="24" viewBox="0 0 24 24" class="cam-icon">
                                    <path d="M18 10.48V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-4.48l4 3.98v-11l-4 3.98zm-2-.79V18H4V6h12v3.69z" />
                                </svg>
                            </div>
                            <div class="audio-call">
                                <i class="fa fa-phone audio-icon-top"></i>
                            </div>
                        </div>
                    </div>
                    <div class="calling-status-wrap hidden-status" id="call-status">
                        <!-- <div class="user-connected-img">
                            <img src="<?= url_for($profileData->profile_img); ?>" alt="<?= $profileData->fname . ' ' . $profileData->lname; ?>">
                        </div>
                        <div class="user-status-text">
                            <div class="user-connected-name"><?= ' ' . $profileData->fname . ' ' . $profileData->lname; ?></div>
                            <div class="user-calling-status">&nbsp;is Calling</div>
                        </div>
                        <div class="calling-action">
                            <div class="call-accept" data-profileid="<?= $profileData->uid; ?>" data-userid="<?= $userData->uid; ?>">
                                <i class="fa fa-phone audio-icon"></i>
                            </div>
                            <div class="call-reject">
                                <i class="fa fa-close close-icon"></i>
                            </div>
                        </div> -->
                    </div>
                </div>
                <video id="remote-video" autoplay playinline></video>
            </div>
        </div>
    </main>
</section>

<script src="<?= url_for('assets/js/jquery.js'); ?>"></script>
<script src="<?= url_for('assets/js/common.js'); ?>"></script>
<script>
    var conn = new WebSocket('ws://localhost:8080/webrtc/?token=<?= $userData->session_id; ?>');
</script>
<script src="<?= url_for('assets/js/client.js'); ?>"></script>
</body>

</html>