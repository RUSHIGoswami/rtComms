var base_url = 'http://localhost/webrtc/'


function loadConnectedPeers() {
    var userid = $(".u-p-id").data("userid");
    var profileid = $(".u-p-id").data("profileid");
    if (userid != undefined) {
        $.post(base_url + 'core/ajax/loadConnectedPeers.php', { userid: userid, otherid: profileid }, function (data) {
            $(".g-users").html(data);
        })
    }
    
}

loadConnectedPeers()

$(document).on("click", ".nf-1", () => {
    $(".nf-1").addClass("active");
    $(".nf-2").removeClass("active");
    $(".nf-3").removeClass("active");
    $(".g-notify-msg").show(500);
    $(".g-users").hide(500);
    $(".g-search").hide(500);
});
$(document).on("click", ".nf-2", () => {
    $(".nf-2").addClass("active");
    $(".nf-1").removeClass("active");
    $(".nf-3").removeClass("active");
    $(".g-notify-msg").hide(500);
    $(".g-users").show(500);
    $(".g-search").hide(500);
});
$(document).on("click", ".nf-3", () => {
    $(".nf-3").addClass("active");
    $(".nf-2").removeClass("active");
    $(".nf-1").removeClass("active");
    $(".g-notify-msg").hide(500);
    $(".g-users").hide(500);
    $(".g-search").show(500);
});