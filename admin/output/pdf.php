<?php

//DB接続に使う変数（ユーザー名とかパスワードとか）
$host_name = "localhost";
$dbms_user = "root";
$dbms_pass = "";

//DBMS(MySQL)に接続
$con = mysql_connect($host_name , $dbms_user , $dbms_pass);

//文字化けを解消（無理やりなやり方）
mysql_query("SET NAMES SJIS");

//データベースを選択
mysql_select_db( "iw32" , $con );



require('fpdf/mbfpdf.php');

//PDF生成
$pdf = new MbfPDF();

//ページ追加
$pdf -> addPage();

//フォントの設定
$pdf -> addMbFont ( GOTHIC , 'SJIS' );
$pdf -> addMbFont ( MINCHO , 'SJIS' );

//文字サイズとフォント
$pdf -> setFont ( GOTHIC , '' , '22px' );
$pdf -> write ( 20 , '予約関連分析資料 PDF');
$pdf -> Ln (10);

/*****************
* 映画別売り上げ
*****************/
$pdf -> setFont ( GOTHIC , '' , '18px' );
$pdf -> write ( 50 , '映画別売り上げ');
//改行
$pdf -> Ln (30);
$pdf -> setFont ( GOTHIC , '' , '12px' );

		
//SQL 映画名を抽出
$sql = "
SELECT DISTINCT title , count(*)*1800 , count(*)
FROM movie_m AS MM 

JOIN movie AS m
ON m.movie_id = MM.movie_id

GROUP BY m.movie_id
ORDER BY count(m.movie_id) DESC";
				
//SQL実行
$res = mysql_query( $sql , $con );		//$resには「成功 true」か「失敗 false」が入る

//添え字用変数
$count = 1;


$pdf -> setFillColor(90 , 90 , 90);
$pdf -> setTextColor(255 , 255 , 255);
$pdf -> cell(100 , 10 , "タイトル" , '1' , 0 , "C" , 1);
$pdf -> cell(40 , 10 , "売り上げ" , 'TBLR' , 0 , "C" , 1);		//TBLRは上下左右に設定（個別に指定できる） 1で囲む　0で枠無し
$pdf -> cell(40 , 10 , "件数" , 'TBLR' , 1 , "C" , 1);

$pdf -> setFillColor(255 , 255 , 255);
$pdf -> setTextColor(0 , 0 , 0);

//色アイコンと映画タイトル表示
while( $row = mysql_fetch_array( $res ) ){
	$row[0] = substr($row[0], 0, 40);
	$pdf -> cell(100 , 10 , $row[0] , '1' , 0 , "C" , 1);
	$pdf -> cell(40 , 10 , $row[1]."円" , '1' , 0 , "C" , 1);
	$pdf -> cell(40 , 10 , $row[2]."件" , '1' , 1 , "C" , 1);
	$count++;
}






//改ページ
$pdf -> addPage();



/********************
*　セル（表の描画）
*********************/
//カーソル位置設定
$pdf -> setXY(10 , 10);


//1~12月
for($getu=1 ; $getu<=12 ; $getu++){

if($getu == 7){
	//改ページ
	$pdf -> addPage();
}

//セル出力（出力文字列にintのものを入れたい場合、(string)に変換すればエラーが出ない）
//背景色（cell側で最後の0（透過）が必要）
$pdf -> setFillColor(150 , 150 , 255);
$pdf -> setTextColor(255 , 255 , 255);
$pdf -> cell(50 , 10 , $getu."月" , '0' , 0 , "C" , 1);

$pdf -> setFillColor(90 , 90 , 90);
$pdf -> setTextColor(255 , 255 , 255);
$pdf -> cell(50 , 10 , "タイトル" , 'TBLR' , 0 , "C" , 1);		//TBLRは上下左右に設定（個別に指定できる） 1で囲む　0で枠無し
$pdf -> cell(50 , 10 , "予約人数" , 'TBLR' , 1 , "C" , 1);

$pdf -> setFillColor(255 , 255 , 255);
$pdf -> setTextColor(0 , 0 , 0);


//1月のときに10~12月との誤判定消し
if($getu == 1){
	$sql ="
	select
	  mm.title
	, count(mo.movie_id)
	, CHAR_LENGTH(mo.watch_day)
	from
	 movie AS mo
	join
	  movie_m AS mm
	on
	  mo.movie_id=mm.movie_id
	where
	  mo.watch_day LIKE '1%' && CHAR_LENGTH(mo.watch_day) = 3
	group by
	  mo.movie_id
	";
}else if($getu == 11 || $getu == 12){
$sql ="
	select
	  mm.title
	, count(mo.movie_id)
	from
	 movie AS mo
	join
	  movie_m AS mm
	on
	  mo.movie_id=mm.movie_id
	where
	  mo.watch_day LIKE '".$getu."%' && CHAR_LENGTH(mo.watch_day) = 4
	group by
	  mo.movie_id
	";
}
else{
$sql ="
	select
	  mm.title
	, count(mo.movie_id)
	from
	 movie AS mo
	join
	  movie_m AS mm
	on
	  mo.movie_id=mm.movie_id
	where
	  mo.watch_day LIKE '".$getu."%' && CHAR_LENGTH(mo.watch_day) = 3
	group by
	  mo.movie_id
	";
}
$res = mysql_query( $sql , $con );

while( $row = mysql_fetch_array( $res ) ){


$row[0] = substr($row[0], 0, 22);

$pdf -> cell(50 , 10 , "" , '' , 0);
$pdf -> cell(50 , 10 , $row[0] , 'TBLR' , 0);
$pdf -> cell(50 , 10 , $row[1]."人" , 'TBLR' , 1);

}
//改行
$pdf -> Ln (10);

}



//出力方法も設定可　例）I,D,F（word参照）
$pdf -> output( 'test.pdf' , 'I' );

?>