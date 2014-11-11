<?php
	$host_name = "localhost";
	$dbms_user = "root";
	$dbms_pass = "";

	//DBMS(MySQL)へ接続
	$con = mysql_connect($host_name,$dbms_user,$dbms_pass);
	mysql_select_db("iw32",$con);

	//sql文作成
	$sql = "SELECT title, description ,s.movie_id ,s.movie_start ,m.3d FROM movie_m AS m JOIN schedule AS s ON m.movie_id = s.movie_id ORDER BY movie_start DESC";

	//sql実行
	$res = mysql_query($sql , $con);

	//DB切断
	mysql_close($con);

?>
<!DOCTYPE html>
<html>
	<head>
	<title>上映予定作品一覧</title>
	<meta charset="utf-8">
	<meta name="keywords" content="HALシネマ東京"><!-- ＳＥＯ対策　-->
	<meta name="description" content="HALシネマのサイトです">
	<meta name="author" content="Kaito Shidara" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<link rel="apple-touch-icon" href="img/icon/" /><!-- スマホで見るなら -->
	<!--  css  -->
	<link href="../css/common.css" rel="stylesheet" type="text/css">
	<link href="../css/movie_plan/movie_plan.css" rel="stylesheet" type="text/css">
	<!--  js  -->
	<script src="js/script.js"></script>
	</head>
<body>
			<!-- ヘッダー -->
		<header>
			<h1><img src="./img/logo.png" alt="ハルシネマ"></h1>
			<p>キャッチコピー</p>

			<ul>
				<li><a href="" title="お問い合わせ"><img src="" width="50" height="50" alt="お問い合わせ"></a></li>
				<li><a href="" title="Q &amp; A"><img src="" width="50" height="50" alt="Q &amp; A"></a></li>
				<li><a href="" title="サイトマップ"><img src="" width="50" height="50" alt="サイトマップ"></a></li>
				<li><a href="" title="ログイン"><img src="" width="50" height="50" alt="ログイン"></a></li>
			</ul>
		</header>

		<!-- ナビゲーション -->
		<nav>
			<ul>
				<li><a href="">上映中作品一覧</a></li>
				<li><a href="">お知らせ</a></li>
				<li><a href="">上映予定作品一覧</a></li>
				<li><a href="">料金</a></li>
				<li><a href="">割引サービス</a></li>
				<li><a href="">アクセス方法</a></li>
			</ul>
		</nav>
	<div id="main">
		<div id="leftcolumn">
<?php
			while($row = mysql_fetch_array($res)){
				if( $row["3d"] ==0){
					$real = "なし";
				}else{
					$real = "あり";
				}
				echo "<div class=\"box1\">";
					echo"<div class=\"box1_img\">";
						echo "<img src='../img/moviePhoto/".$row['movie_id'].".jpg'\" width=\"150px\" height=\"100px\">";
					echo "</div>";
					echo "<div class=\"box1_text\">";
						echo $row["title"];
					echo "</div>";
					echo "<div class=\"box1_text\">";
						echo $row["description"];
					echo "</div>";
					echo "<div class=\"clear\"></div>";
					echo "<div class=\"box2_text\">";
						 echo "<div class=\"movieStart\">".$row["movie_start"]."～</div>";
						 echo "3D上映".$real;
					echo "</div>";
				echo "</div>";
			}
			$hakoDay = array('日曜めっちゃお得デイ♪','menzu','シニア割','ハードゲイ','レディースデイ','華の金曜！','うんこ');
			$hakoMoney = array(3300,2500,300,500,400,300,300); 
			$day = date('w');
?>
		</div>
	<!-- leftcolumn fin-->

		<div id="rightcolumn">
			<table class="company">
    				<tbody>
						<tr>
				        	<th class="arrow_box">今日のサービス</div></th>
				        </tr>
				        <tr>
				            <th class="arrow_box"><?php echo $hakoDay[$day];?></th>
				            <td><?php echo "チケットから".$hakoMoney[$day]."円引きです。";?></td>
				        </tr>
    				</tbody>
			</table>
		</div><!-- rightcolumn fin-->
		<div class="clear"></div>

	</div><!-- main fin -->
			<!-- フッター -->
		<footer>
			<section>
				<h3>分類１</h3>
				<ul>
					<li><a href="">プライバシーポリシー</a></li>
					<li><a href="">プライバシーポリシー</a></li>
					<li><a href="">プライバシーポリシー</a></li>
				</ul>
			</section>
			<section>
				<h3>分類２</h3>
				<ul>
					<li><a href="">特定商取引法に基づく表記</a></li>
					<li><a href="">特定商取引法に基づく表記</a></li>
					<li><a href="">特定商取引法に基づく表記</a></li>
				</ul>
			</section>
			<section>
				<h3>分類３</h3>
				<ul>
					<li><a href="">ご利用に際して</a></li>
					<li><a href="">ご利用に際して</a></li>
					<li><a href="">ご利用に際して</a></li>
				</ul>
			</section>

			<p><small>&copy; 2014 HAL Cinema Ltd. All Rights Reserved.</small></p>
		</footer>
</body>
</html>