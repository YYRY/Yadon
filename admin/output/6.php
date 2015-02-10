<?php

/**********************
*【全登録件数（性別）】
**********************/


//DB接続に使う変数（ユーザー名とかパスワードとか）
$host_name = "localhost";
$dbms_user = "root";
$dbms_pass = "";

//DBMS(MySQL)に接続
$con = mysql_connect($host_name , $dbms_user , $dbms_pass);

//文字化けを解消（無理やりなやり方）
mysql_query("SET NAMES utf8");

//データベースを選択
mysql_select_db( "iw32" , $con );

//SQL 全登録者の性別の件数を出力
$sql = "
SELECT count(*)
FROM customer_m
WHERE sei = '男' or sei = '女'
GROUP BY sei
ORDER BY count(*) DESC";

//SQL実行
$res = mysql_query( $sql , $con );		//$resには「成功 true」か「失敗 false」が入る
  
//DB接続切断
mysql_close( $con );


//添え字用
$count = 0;

//抽出
while( $row = mysql_fetch_array( $res ) ){ 

	//値
	$values[$count] = $row[ 0 ];

	$count++;
}


 
//グラフに使う色
$colorset = array(
    'ff5555', 'dd77ee', '44aeff', 'aeff3b', 'ffa53b'
);
 
$width   = 240;
$height  = 240;
 
$cx = round( $width / 2 );
$cy = round( $height / 2 );
 
$image = imagecreatetruecolor($width, $height);
 
//背景
$bg = imagecolorallocate( $image, 255, 255, 255 );
imagefill($image, 0, 0, $bg);
 
list($red, $green, $blue) = parse_color($colorset[0]);
 
rsort($values);
$scale = 360 / array_sum($values);
$count = count($values);
 
$start = -90;
$end = $start;
 
foreach($values as $key => $value){
    list($red, $green, $blue) = parse_color( current($colorset) );
    $start = $end;
    $end = ($key === $count - 1) ? 270 : $end = $value * $scale + $start;
    $color = imagecolorallocate($image, $red, $green, $blue);
    imagefilledarc($image, $cx, $cy, $width, $height, $start, $end, $color, IMG_ARC_PIE);
    $res = next($colorset);
    if($res === false) reset($colorset);
}
 
// 画像出力
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
 
function parse_color($rgb){
    $res = str_split($rgb, 2);
    $red = intval($res[0], 16);
    $green = intval($res[1], 16);
    $blue = intval($res[2], 16);
    return array( $red, $green, $blue );
}
?>