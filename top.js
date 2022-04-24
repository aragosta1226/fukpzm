//スクロールしたら
function FixedAnime() {
    let headerH = $("#header").outerHeight(true);
    let scroll = $(window).scrollTop();
    if(scroll >= headerH) {
        $("#header").addClass("fixed");
    } else {
        $("#header").removeClass("fixed");
    }
}