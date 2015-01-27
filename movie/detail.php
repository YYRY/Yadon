<?php
//セッションフラグ
$s_flg = false;

//セッションスタート
@session_start();

//セッションが無い状態
if( !isset( $_SESSION["c_id"] ) || $_SESSION["c_id"] == null ){
	$c_id = "";
}
//セッションがあった
else{
	$c_id = $_SESSION["c_id"];
	$s_flg = true;
}

//ログインしていないときログインさせる
if( strlen($c_id) == 0 || $c_id == "" ){
	header( "location:../login/login.php?link1=1" );
	exit;
}

//movie_id取得
if( isset( $_GET["mov"] ) ){
	$mov = $_GET["mov"];
}else{
	header( "location:../index.php" );
	exit;
}


if( isset( $_GET["day"] ) ){
	$day = $_GET["day"];
}


if( isset( $_GET["time"] ) ){
	$time = $_GET["time"];
}


include "../header.php";

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
	var y = $(this).find("span").attr("class");

	//表示された内容削除
	$("."+td).remove();

	//座席予約登録
	$.ajax({
		type:"POST",
		url:"AJAXsheet.php",
		data:{
			"td":td,
			"y":y,
			"c_id":<?= $c_id ?>,
			"mov":<?= $mov ?>,
			"day":<?= $day ?>,
			"time":<?= $time ?>
		},
		success:sc,
		error:er
	});	
	function sc(data){
		if(data == "登録"){
			var yoyaku = this_td.text();
			var yen = "1800";
			$("#yoyaku").append("<span class="+td+">予約座席："+yoyaku+" "+yen+"円<br /></span>");
		}
		else if(data == "削除"){
			$(this_td).removeClass("select1");
			$(this_td).removeClass("select2");
			$(this_td).addClass("seat1");
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
	, m.customer_id
	from
	  movie AS m
	join
	  seat2_1 AS s
	on
	  m.seat_id = s.seat_id
	where
	  m.movie_id = '$mov' AND
	  m.watch_day = '$day' AND
	  m.watch_time = '$time' AND
	  m.cinema_id = 1 AND
	  m.screen_id = 1 AND
	  m.seat_id = 1
	ORDER BY
	  m.retu , m.x
	";
	$res = mysql_query($sql,$con);

	$i = 0;

	while($row = mysql_fetch_array($res)){
		$x[$i] = $row[0];
		$retu[$i] = $row[1];
		$customer_id[$i] = $row[2];

		$i++;
	}

/*
	$movie_id = "1";
	if(isset($_GET["movie_id"])){
		$movie_id = htmlspecialchars($_GET["movie_id"], ENT_QUOTES);
	}
	if (!preg_match("/^[0-9]*$/", $movie_id)){
			header("Location:../index.php");
	}
*/
	$host_name = "localhost";
	$dbms_user = "root";
	$dbms_pass = "";

	//DBMS(MySQL)へ接続
	$con = mysql_connect($host_name,$dbms_user,$dbms_pass);
	mysql_select_db("iw32",$con);
	mysql_query('SET NAMES utf8', $con );
	$sql = "SELECT s.movie_id ,title, description ,s.movie_start ,m.3d FROM movie_m AS m JOIN schedule AS s ON m.movie_id = s.movie_id WHERE m.movie_id = '$mov'";

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
   		<div class="menu active"></div>
 	  	<div class="content">
   			<!--<div class="drag"><img src="../img/movie/men.png"></div>
			<div class="drag"><img src="../img/movie/girl.png"></div>
			<div class="drag"><img src="../img/movie/kuruma.png"></div>-->
            

        	<table id="sheet">
	        	<tr>
					<?php
					$con = mysql_connect($host_name , $dbms_user , $dbms_pass);
					mysql_query("SET NAMES utf8");
					mysql_select_db( "iw32" , $con );
                    //席の座標を抽出する
                    $sql = "
                    SELECT
                      s.x
                    , s.retu
                    , s.type
                    FROM seat2_1 as s
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
							if( $x[$i] == $row[0] && $retu[$i] == $row[1] ){
								if($c_id == $customer_id[$i]){
									echo "<td class='select1'>".$row[1] ."-". $row[0]."<span class='".$count2."'><span></td>";
									$i++;
								}else{
									echo "<td class='select2'>".$row[1] ."-". $row[0]."<span class='".$count2."'><span></td>";
									$i++;
								}
							}else{
								echo "<td class='seat1'>".$row[1] ."-". $row[0]."<span class='".$count2."'><span></td>";
							}
						}
						else if($row[2]=="車椅子"){
							if( $x[$i] == $row[0] && $retu[$i] == $row[1] ){
								echo "<td class='select'>".$row[1] ."-". $row[0]."<span class='".$count2."'><span></td>";
								$i++;
							}else{
								echo "<td class='seat2'>".$row[1] ."-". $row[0]."<span class='".$count2."'><span></td>";
							}
						}
						else if($row[2]=="ペアシート"){
							if( $x[$i] == $row[0] && $retu[$i] == $row[1] ){
								echo "<td class='select'>".$row[1] ."-". $row[0]."<span class='".$count2."'><span></td>";
								$i++;
							}else{
								echo "<td class='seat3'>".$row[1] ."-". $row[0]."<span class='".$count2."'><span></td>";
							}
						}else{
							echo "<td class='none'></td>";
						}

						$count++;
					}
					?>
				</tr>
            </table>

			<div id="yoyaku">
            	<a href="../reserve/insert.php?day=<?= $day ?>&time=<?= $time ?>&mov=<?= $mov ?>">予約確認</a><br />
            </div>

   		</div>

<!--   		<div class="menu">12/18(木)</div>
   			<div class="content">
   			ここに内容が入ります。    
   		</div>

		<div class="menu">12/19(金)</div>
		   	<div class="content">
		   	ここに内容が入ります。    
		</div>
   
		<div class="menu">12/20(土)</div>
		   	<div class="content">
		   	ここに内容が入ります。    
		</div>
    
   		<div class="menu">12/21(日)</div>
   			<div class="content">
   			ここに内容が入ります。    
   			</div>-->

	</div>

<?php
include('../footer.php');
?>