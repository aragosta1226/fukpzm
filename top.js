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

//画面をスクロールをしたら動かしたい場合
$(window).scroll(function() {
    FixedAnime(); /*スクロールしたら途中からヘッダーを出現させる関数を呼ぶ*/
});

//ページが読み込まれたらすぐに動かしたい場合
$(window).on("load", function() {
    FixedAnime(); /*スクロール途中からヘッダーを出現させる関数を呼ぶ*/
});