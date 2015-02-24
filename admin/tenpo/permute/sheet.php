<?php

$sc = "";
$x = "";
$y = "";
$se = "";

if( isset( $_POST["sc"] ) && isset( $_POST["x"] ) && isset( $_POST["y"] ) && isset( $_POST["se"] ) ){
	$sc = $_POST["sc"];
	$x = $_POST["x"];
	$y = $_POST["y"];
	$se = $_POST["se"];
}

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



/*===================
入力内要不備発見
===================*/
//チェック用SQL
$sql = "SELECT * FROM seat";

//SQL実行
$res = mysql_query( $sql , $con );

if($se != null){

	$flg = false;

	//1行ずつ繰り返す
	while( $row = mysql_fetch_array( $res ) ){
	
		//一致チェック
		if($x == $row["x"]){
			if($y == $row["y"]){
				if($sc == $row["seat_id"]){
					$flg = true;
					break;
				}
			}
		}
	}

	/*===================
	更新update
	===================*/
	if($flg){
		if($se=="なし"){
			$se="";
		}
		//シートテーブル選択
		if($sc == 1){
			$sql = "UPDATE `iw32`.`seat2_1` SET `type` = '$se' WHERE `seat2_1`.`x` = '$x' AND `seat2_1`.`y` = '$y'";
		}
		else if($sc == 2){
			$sql = "UPDATE `iw32`.`seat2_2` SET `type` = '$se' WHERE `seat2_2`.`x` = '$x' AND `seat2_2`.`y` = '$y'";
		}
		else if($sc == 3){
			$sql = "UPDATE `iw32`.`seat2_3` SET `type` = '$se' WHERE `seat2_3`.`x` = '$x' AND `seat2_3`.`y` = '$y'";
		}
		$res = mysql_query( $sql , $con );
	}

}



?>

<!DOCTYPE html>
<html>
	<head>
	<title>座席情報登録・変更</title>
	<meta charset="utf-8">
	<meta name="keywords" content="HALシネマ東京"><!-- ＳＥＯ対策　-->
	<meta name="description" content="HALシネマのサイトです">
	<meta name="author" content="Kaito Shidara" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<link rel="apple-touch-icon" href="img/icon/" /><!-- スマホで見るなら -->

	<!--  css  -->
	<link href="../../css/common.css" rel="stylesheet" type="text/css">
	<link href="../../css/tenpo/permute/sheet.css" rel="stylesheet" type="text/css">

	<!--  js  -->
	<script src=""></script>
	</head>
<body>


    <article id="WRAP">
    
        <h1 id="title">座席情報登録・変更</h1>

        <form action="sheet.php" method="post">
            スクリーン<br />
            <label><input type="radio" name="sc" value="1">スクリーン1.2.3</label>&nbsp;
            <label><input type="radio" name="sc" value="2">スクリーン4.5.6</label>&nbsp;
            <label><input type="radio" name="sc" value="3">スクリーン7.8</label><br /><br />
            
            <div class="area">
            	<label>X軸<br />
            	<input type="text" name="x" maxlength="2"></label><br /><br />
            </div>
            
            <div class="area">
            	<label>Y軸<br />
            	<input type="text" name="y" maxlength="2"></label><br /><br />
            </div>
            
            <div class="clear"></div>
            
            <div class="area" id="area2">
	            種類<br />
	            <label><input type="radio" name="se" value="普通席">普通席</label>&nbsp;
	            <label><input type="radio" name="se" value="車椅子">車椅子</label>&nbsp;
	            <label><input type="radio" name="se" value="ペアシート">ペアシート</label>&nbsp;
	            <label><input type="radio" name="se" value="なし">なし</label><br />
	            ※普通席をペアシートに変えることはできません<br /><br />
            </div>
            
            
            <div class="area">
		        <img src="../../img/tenpo/permute/1.png" alt="灰色">普通席<br />
    		    <img src="../../img/tenpo/permute/2.png" alt="青">車椅子<br />
    		    <img src="../../img/tenpo/permute/3.png" alt="オレンジ">ペアシート<br /><br />
            </div>
            
            <div class="clear"></div>
            
            <input type="submit" value="変更">
        </form>


		<?php
		///// DB接続設定 /////
		$host_name = "localhost";
		$dbms_user = "root";
		$dbms_pass = "";
		$con = mysql_connect($host_name , $dbms_user , $dbms_pass);
		mysql_query("SET NAMES utf8");
		mysql_select_db( "iw32" , $con );
		///// DB接続設定終わり /////

		//配列初期化用
		$sql="select * from seat2_1";
		$res = mysql_query($sql,$con);
		$i = 0;
		while($row = mysql_fetch_array($res)){
			$x[$i] = "";
			$retu[$i] = "";	
			$i++;
		}

		//スクリーンの数だけ繰り返す
		for($three_count=1 ; $three_count<=3 ; $three_count++){
			if($three_count == 1){
				$screen = "スクリーン1・2・3";
			}
			else if($three_count == 2){
				$screen = "スクリーン4・5・6";
			}
			else if($three_count == 3){
				$screen = "スクリーン7・8";
			}
			echo "<h1>".$screen."</h1><table id='sheet'><tr>";

			//席の座標を抽出する
			$sql = "
			SELECT
			  s.x
			, s.retu
			, s.type
			FROM seat2_".$three_count." as s
			ORDER BY s.y , s.x , s.retu";

			//SQL実行
			$res = mysql_query( $sql , $con );
                    
			//席改行用変数
			$count = 1;
			$count2 = 1;
			$i = 0;

			//席の表示
			while( $row = mysql_fetch_array( $res ) ){

				if($row[0]==1 && $count!=1){
					echo "</tr><tr>";
					$count2++;
				}

				if($row[2]=="普通席"){
					echo "<td class='select1'>".$row[1] ."-". $row[0]."<span class='".$count2."'><span></td>";
					$i++;
				}
				else if($row[2]=="車椅子"){
					echo "<td class='car'>".$row[1] ."-". $row[0]."<span class='".$count2."'><span></td>";
					$i++;
				}
				else if($row[2]=="ペアシート"){
					echo "<td class='pear'>".$row[1] ."-". $row[0]."<span class='".$count2."'><span></td>";
					$i++;
				}else{
					echo "<td class='null'></td>";
				}
				$count++;
			}
			echo "</tr></table>";
		}
		?>

    </article>

</body>
</html>