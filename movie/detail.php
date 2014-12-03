<?php
include "../header.php";
include "../include_session/session.php";

//ログインしていないときログインさせる
if( strlen($c_id) == 0 ){
	header( "location:../login/login.php?link1=1" );
	exit;
}

?>

<!DOCTYPE html>
<html>
	<head>
	<title>上映中作品詳細</title>
	<meta charset="utf-8">
	<meta name="keywords" content="HALシネマ東京"><!-- ＳＥＯ対策　-->
	<meta name="description" content="HALシネマのサイトです">
	<meta name="author" content="Kaito Shidara" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<link rel="apple-touch-icon" href="img/icon/" /><!-- スマホで見るなら -->
	<!--  css  -->
	<link href="../css/common.css" rel="stylesheet" type="text/css">
	<link href="../css/movie/movie.css" rel="stylesheet" type="text/css">
	<link href="../css/movie/movie_sheet.css" rel="stylesheet" type="text/css">
	<!--  js  -->
	<script type="text/javascript" src="../js/movie/movie.js"></script>

<script>

window.onload = function(){

//座席クリック
$("td").not(".none").click(function(){

	var this_td = $(this);
	var td = $(this).text();

	//座席予約登録
	$.ajax({
		type:"POST",
		url:"AJAXsheet.php",
		data:{
			"td":td,
			"c_id":<?= $c_id ?>
		},
		success:sc,
		error:er
	});	
	function sc(data){
//		window.location.reload();
//		alert("OK");
		if(data == "登録"){
			var yoyaku = this_td.text();
			var sei = "男性";
			var yen = "1800";
			$("#yoyaku").append("<span class="+td+">予約座席："+yoyaku+"　"+sei+"　"+yen+"円<br /></span>");
		}
		else if(data == "削除"){
			$("."+td).remove();
		}
		else if(data == "登録済み"){
			alert("他のユーザーが登録済みです");
		}
	}
	function er(){ 
		alert("通信エラー");
	}

	
	//座席の色を戻す
	if(this_td.css('z-index') == '101'){
		//普通席
		$(this).css({
			"background":"#ddd",
			"z-index":"100"
		});
	}
	else if(this_td.css('z-index') == '103'){
		//車椅子
		$(this).css({
			"background":"#0CF",
			"z-index":"102"
		});
	}
	else if(this_td.css('z-index') == '105'){
		//ペアシート
		$(this).css({
			"background":"#52e26d",
			"z-index":"104"
		});
	}
	
	else{
		if(this_td.css('z-index') == '100'){
		//普通席クリック
		$(this).css({
			"background":"#fc9d50",
			"z-index":"101"
		});
		}
		//車椅子席クリック
		else if(this_td.css('z-index') == '102'){
			$(this).css({
				"background":"#fc9d50",
				"z-index":"103"
			});
		}
		//ペアシートクリック
		else if(this_td.css('z-index') == '104'){
			$(this).css({
				"background":"#fc9d50",
				"z-index":"105"
			});
		}

	}

});//クリック終了

}
</script>



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
	
	
	
	//予約済み席抽出
	$sql="
	select distinct
	  m.x
	, m.retu
	from
	  movie AS m
	join
	  seat2_1 AS s
	on
	  m.seat_id = s.seat_id
	where
	  m.movie_id = 1 AND
	  m.cinema_id = 1 AND
	  m.screen_id = 1 AND
	  m.seat_id = 1
	ORDER BY
	  s.y , s.x , retu
	";

/*
	select
	  m.x
	, m.retu
	from
	  movie AS m
	join
	  seat2_1 AS s
	on
	  m.seat_id = s.seat_id
	where
	  m.movie_id = 1 AND
	  m.cinema_id = 1 AND
	  m.screen_id = 1 AND
	  m.seat_id = 1
	ORDER BY
	  s.y , s.x
*/


	$res = mysql_query($sql,$con);
	
	$i = 0;
	
	while($row = mysql_fetch_array($res)){
		$x[$i] = $row[0];
		$retu[$i] = $row[1];

		$i++;
	}


	$movie_id = "1";
	if(isset($_GET["movie_id"])){
		$movie_id = htmlspecialchars($_GET["movie_id"], ENT_QUOTES);
	}
	if (!preg_match("/^[0-9]*$/", $movie_id)){
			header("Location:../index.php");
		}
	$host_name = "localhost";
	$dbms_user = "root";
	$dbms_pass = "";

	//DBMS(MySQL)へ接続
	$con = mysql_connect($host_name,$dbms_user,$dbms_pass);
	mysql_select_db("iw32",$con);
	mysql_query('SET NAMES utf8', $con );
	$sql = "SELECT s.movie_id ,title, description ,s.movie_start ,m.3d FROM movie_m AS m JOIN schedule AS s ON m.movie_id = s.movie_id WHERE m.movie_id = '$movie_id'";

	$res = mysql_query($sql , $con);
	mysql_close($con);


	while($row = mysql_fetch_array($res)){
		if( $row["3d"] ==0){
			$real = "なし";
		}else{
			$real = "あり";
		}
		echo "<div id=\"main\">";
			echo"<div id=\"main_img\">";
				echo "<img src='../img/moviePhoto/".$row['movie_id'].".jpg'\">";
			echo "</div>";
			echo "<div id=\"main_text\">";
				echo $row["title"];
				echo "<br>";
				echo $row["description"];
			echo "</div>";
			echo "<div class=\"clear\"></div>";
			echo "<div class=\"box2_text\">";
				echo "<div class=\"movieStart\">".$row["movie_start"]."～</div>";
				echo "3D上映".$real;
			echo "</div>";
		echo "</div>";
	}
?>

	<div class="clear"></div>

	<div class="full_content">
   		<div class="menu active">9/1(月)</div>
 	  	<div class="content">
   			<!--<div class="drag"><img src="../img/movie/men.png"></div>
			<div class="drag"><img src="../img/movie/girl.png"></div>
			<div class="drag"><img src="../img/movie/kuruma.png"></div>-->
            
            <h1>スクリーン1</h1>

        	<table id="sheet">
	        	<tr>
					<?php
					$con = mysql_connect($host_name , $dbms_user , $dbms_pass);
					mysql_query("SET NAMES utf8");
					mysql_select_db( "iw32" , $con );
                    //席の座標を抽出する
                    $sql = "
                    SELECT
                      x
                    , retu
                    , type
                    FROM seat2_1
                    ORDER BY y , x ,retu";

                    //SQL実行
                    $res = mysql_query( $sql , $con );
                    
                    //席改行用変数
                    $count = 1;
                    
					$i = 0;
					
                    //席の表示
                    while( $row = mysql_fetch_array( $res ) ){

						if($row[0]==1 && $count!=1){
							echo "</tr><tr>";
						}

						if($row[2]=="普通席"){
							if( $x[$i] == $row[0] && $retu[$i] == $row[1] ){
								echo "<td class='select'>".$row[1] ."-". $row[0]."</td>";
								$i++;
							}else{
								echo "<td class='seat1'>".$row[1] ."-". $row[0]."</td>";
							}
						}
						else if($row[2]=="車椅子"){
							if( $x[$i] == $row[0] && $retu[$i] == $row[1] ){
								echo "<td class='select'>".$row[1] ."-". $row[0]."</td>";
								$i++;
							}else{
								echo "<td class='seat2'>".$row[1] ."-". $row[0]."</td>";
							}
						}
						else if($row[2]=="ペアシート"){
							if( $x[$i] == $row[0] && $retu[$i] == $row[1] ){
								echo "<td class='select'>".$row[1] ."-". $row[0]."</td>";
								$i++;
							}else{
								echo "<td class='seat3'>".$row[1] ."-". $row[0]."</td>";
							}
						}else{
							echo "<td class='none'></td>";
						}

						$count++;
					}
					?>
				</tr>
            </table>

			<div id="yoyaku"></div>


   		</div>

   		<div class="menu">9/2(火)</div>
   			<div class="content">
   			ここに内容が入ります。    
   		</div>

		<div class="menu">9/3(水)</div>
		   	<div class="content">
		   	ここに内容が入ります。    
		</div>
   
		<div class="menu">9/4(木)</div>
		   	<div class="content">
		   	ここに内容が入ります。    
		</div>
    
   		<div class="menu">9/5(金)</div>
   			<div class="content">
   			ここに内容が入ります。    
   			</div>
		</div>

<?php
include('../footer.php');
?>