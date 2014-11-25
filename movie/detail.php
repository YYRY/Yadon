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
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script type="text/javascript" src="../js/movie/movie.js"></script>
	<script type="text/javascript">
	$ (function(){
        $ (".content:not('.active + .content')").hide();       
        $(".menu").hover(function(){
                $ (this).addClass("hover")
        },
        function(){
                $(this).removeClass("hover")
        });    
        $ (".menu").click(function(){
                $(".menu").removeClass("active");
                $ (this).addClass("active");
                $(".content:not('.active + .content')").fadeOut();
        $ (".active + .content").fadeIn();     
        });

	//drag
/*	$(".drag").draggable({
		snap:".snap"
	});
*/

});
	</script>



<?php
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

?>
<?php
include('../header.php');
?>
<?php
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
                    , y
                    , retu
                    , type
                    FROM seat2_1
                    ORDER BY y , x";

                    //SQL実行
                    $res = mysql_query( $sql , $con );
                    
                    //席改行用変数
                    $count = 1;
                    
                    //席の表示
                    while( $row = mysql_fetch_array( $res ) ){
					
						if($row[0]==1 && $count!=1){
							echo "</tr><tr>";
						}
						
						if($row[3]=="普通席"){
							echo "<td class='seat1'>".$row[2] ."-". $row[0]."</td>";
						}
						else if($row[3]=="車椅子"){
							echo "<td class='seat2'>".$row[2] ."-". $row[0]."</td>";
						}
						else if($row[3]=="ペアシート"){
							echo "<td class='seat3'>".$row[2] ."-". $row[0]."</td>";
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