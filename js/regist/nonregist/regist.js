window.onload = function(){

//idを取得
var btn = document.getElementById("button");

//画像の切り替え
btn.onmouseover = function(){
	btn.src="../../img/regist/nonregist/sousin2.png";
}
btn.onmouseout = function(){
	btn.src="../../img/regist/nonregist/sousin1.png";
}


}