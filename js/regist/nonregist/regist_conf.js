window.onload = function(){

//idを取得
var btn = document.getElementById("button");

//画像の切り替え
btn.onmouseover = function(){
	btn.src="../../img/regist/nonregist/touroku2.png";
}
btn.onmouseout = function(){
	btn.src="../../img/regist/nonregist/touroku1.png";
}

}





//入力チェック1
function check1(){

	//idと入力値を取得
	var f2 = document.getElementById("f2");
	var f2 = f2.value;

	var f1 = document.getElementById("f1");
	var f1 = f1.value;

	//エラー文章と送信ボタンのid
	var error = document.getElementById("error");
	var btn = document.getElementById("button");
	
	//最初のみ入力状態はスルー
	if(f2 != ""){
		//入力値が同じ
		if(f1 == f2){
			//背景を元に戻す
			var f1 = document.getElementById("f1");
			f1.style.background="";
			
			var f2 = document.getElementById("f2");
			f2.style.background="";

			//エラー文非表示・ボタン表示
			error.style.display="none";
			btn.style.display="block";
		}
		//入力値が異なる場合
		else{
			//背景を赤くする
			var f1 = document.getElementById("f1");
			f1.style.background="#fdd";
			
			var f2 = document.getElementById("f2");
			f2.style.background="#fdd";
			
			//エラー文表示・ボタン非表示
			error.style.display="block";
			btn.style.display="none";
		}
	}

}


//入力チェック2
function check2(){

	//idと入力値を取得
	var f1 = document.getElementById("f1");
	var f1 = f1.value;

	var f2 = document.getElementById("f2");
	var f2 = f2.value;

	var error = document.getElementById("error");
	var btn = document.getElementById("button");

	if(f1 != ""){
		if(f1 == f2){
			var f2 = document.getElementById("f2");
			f2.style.background="";
			var f1 = document.getElementById("f1");
			f1.style.background="";
			error.style.display="none";
			btn.style.display="block";
		}else{
			var f2 = document.getElementById("f2");
			f2.style.background="#fdd";
			var f1 = document.getElementById("f1");
			f1.style.background="#fdd";
			error.style.display="block";
			btn.style.display="none";
		}
	}

}