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

//アコーディオンをクリックした時の動作
$('.title').on('click', function() {//タイトル要素をクリックしたら
	$('.box').slideUp(500);//クラス名.boxがついたすべてのアコーディオンを閉じる

	let findElm = $(this).next(".box");//タイトル直後のアコーディオンを行うエリアを取得

	if($(this).hasClass('close')){//タイトル要素にクラス名closeがあれば
		$(this).removeClass('close');//クラス名を除去
	}else{//それ以外は
		$('.close').removeClass('close'); //クラス名closeを全て除去した後
		$(this).addClass('close');//クリックしたタイトルにクラス名closeを付与し
		$(findElm).slideDown(500);//アコーディオンを開く
	}
});

//ページが読み込まれた際にopenクラスをつけ、openがついていたら開く動作※不必要なら下記全て削除
$(window).on('load', function(){
	$('.accordion-area li:first-of-type section').addClass("open"); //accordion-areaのはじめのliにあるsectionにopenクラスを追加
	$(".open").each(function(index, element){	//openクラスを取得
		let Title =$(element).children('.title');	//openクラスの子要素のtitleクラスを取得
		$(Title).addClass('close');				///タイトルにクラス名closeを付与し
		let Box =$(element).children('.box');	//openクラスの子要素boxクラスを取得
		$(Box).slideDown(500);					//アコーディオンを開く
	});
});
