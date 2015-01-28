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
		$sql = 
		"UPDATE iw32 . seat SET type = '$se'
		WHERE seat . seat_id = '$sc' AND x = $x AND y = '$y'";
				
		//SQL実行
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
	            <label><input type="radio" name="se" value="ペアシート">ペアシート</label><br />
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



        <h1>スクリーン1・2・3</h1>

        <table>
	        <tr>

				<?php
                for($seat=1 ; $seat<=3 ; $seat++){
					
                
                    //席の座標を抽出する
                    $sql = "
                    SELECT
                      x
                    , y
                    , type
                    , seat_id
                    FROM seat
                    WHERE seat_id = ".$seat."
                    ORDER BY y , x";
                    
                    //SQL実行
                    $res = mysql_query( $sql , $con );
                    
                    //席番号合わせのための変数
                    $count = 1;
                    
                    //席の表示
                    while( $row = mysql_fetch_array( $res ) ){
                    
                        //ペアシートのとき
                        if($row[2] == "ペアシート"){
                            
                            //改行したらペアシートだったとき
                            if($count > $row[0]){
                                //countの値を合わせる
                                $count = $row[0];
                                //改行
                                echo "</tr><tr>";
                                
                                //空白を作って席の形を合わせる
                                for($i=1 ; $count>$i ; $i++){
                                    echo "<td class='null'></td>";
                                }
                            }
                        
                            //席の表示
                            echo "<td colspan=2 class='pear'>" , $row[0] , "</td>";
                            //ペアシートなので２個分数を取る
                            $count+=2;
                        }
                        //通常の席表示
                        else if($count == $row[0]){
                        
                            //xが1のとき<tr>開始
                            if($count == 1){
                                echo "<tr>";
                            }
                
                            //車椅子席の場合のCSS
                            if($row["2"] == "車椅子"){
                                echo "<td class='car'>" , $row[0] , "</td>";
                            }else{
                                echo "<td>" , $row[0] , "</td>";
                            }
                            $count++;
                        }
                        //席が3始まり
                        else if($row[0] == 3){
                            //車椅子席の場合のCSS
                            if($row["2"] == "車椅子"){
                                echo "<tr><td class='null'></td>";
                                echo "<td class='null'></td>";
                                echo "<td class='car'>" , $row[0] , "</td>";
                            }else{
                                echo "<tr><td class='null'></td>";
                                echo "<td class='null'></td>";
                                echo "<td>" , $row[0] , "</td>";
                            }
                            $count = 4;
                        }
                        //席が5始まり
                        else if($row[0] == 5){
                            //車椅子席の場合のCSS
                            if($row["2"] == "車椅子"){
                                echo "<tr><td class='null'></td>";
                                echo "<td class='null'></td>";
                                echo "<td class='null'></td>";
                                echo "<td class='null'></td>";
                                echo "<td class='car'>" , $row[0] ,"</td>";
                            }else{
                                echo "<tr><td class='null'></td>";
                                echo "<td class='null'></td>";
                                echo "<td class='null'></td>";
                                echo "<td class='null'></td>";
                                echo "<td>" , $row[0] ,"</td>";
                            }
                            $count = 6;
                        }
                        //xが1とかに戻ったとき（改行）
                        else if($count > $row[0]){
                            echo "</tr>";
                            //車椅子席の場合のCSS
                            if($row["2"] == "車椅子"){
                                echo "<tr><td class='car'>" , $row[0] , "</td>";
                            }else{
                                echo "<tr><td>" , $row[0] , "</td>";
                            }
                            $count = 2;
                        }
                    }
                    //次のスクリーンに移る
                    echo "</tr></table><br /><br />";
                    if($seat == 1){
                        echo "<h1>スクリーン4・5・6</h1><table>";
                    }
                    else if($seat == 2){
                        echo "<h1>スクリーン7・8</h1><table>";
                    }
                }
                //DB接続切断
                mysql_close( $con );
                ?>
    </article>

	<footer>
		<p><small>Copyright IH12B334	kaito shidara ALLRIGHTS RESERVED.</small>
		</p>
	</footer>
</body>
</html>