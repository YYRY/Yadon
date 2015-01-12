window.onload = function(){

//classを取得
var btn = document.getElementsByClassName("detail");


//詳細ボタンの画像変更
for(var i = 0 ; i < btn.length ; i++){
	//オンマウス
	btn[i].addEventListener('mouseover' , function(){
		if(this.style.top != "920px")
			this.src="../img/news/detail1-1.png";
	});
	
	//マウスアウト
	btn[i].addEventListener('mouseout' , function(){
		if(this.style.top != "920px")
			this.src="../img/news/detail1.png";
	});
}


//ニュース詳細の表示非表示
$(".detail").click(function(){
	//非表示
	if(this.style.top == "920px"){
		this.src="../img/news/detail1.png";
		$(this.parentNode.parentNode).animate({"height":"200px"},300)
		$(this.previousSibling.previousSibling).animate({"height":"90px"},300)
		$(this).animate({"top" : "0px"},0)
	}else{
		$(this).animate({"top" : "920px"},0)
		this.src="../img/news/detail2.png";
		$(this.parentNode.parentNode).animate({"height":"405px"},300)
		$(this.previousSibling.previousSibling).animate({"height":"300px"},300)
	}
});




}