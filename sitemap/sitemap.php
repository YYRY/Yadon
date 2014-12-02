<?php
include('../header.php');

	$host_name = "localhost";
	$dbms_user = "root";
	$dbms_pass = "";
	$con = mysql_connect($host_name,$dbms_user,$dbms_pass);
	mysql_query('SET NAMES utf8', $con );
	mysql_select_db("iw32",$con);
	$sql = "SELECT service_name ,service_detail FROM discount_m";

	$res = mysql_query($sql , $con);
	mysql_close($con);
?>
	<a href="<?=$root ?>/index.php">TOP</a>>サイトマップ
	<div id="main">
		<div id="content">
			<!-- box1 -->
			<div class="box">
			<div class="inbox"><a href="<?=$root ?>/index.php">トップページ</a></div>
			<div class="inbox"><a href="<?=$root ?>/movie/list.php">上映作品一覧</a></div>
			<div class="inbox"><a href="<?=$root ?>/news/news.php">お知らせ</a></div>
			<div class="inbox"><a href="<?=$root ?>/movie_plan/list.php">上映予定作品一覧</a></div>
			<div class="inbox"><a href="<?=$root ?>/sale/list.php">料金</a></div>
			<div class="inbox"><a href="<?=$root ?>/sale/list.php">割引サービス</a></div>
			<div class="inbox"><a href="<?=$root ?>/index.php">アクセス方法</a></div>
			<div class="inbox"><a href="<?=$root ?>/inquiry/inquiry.php">お問い合わせ</a></div>
			<div class="inbox"><a href="<?=$root ?>/index.php">Q&A</a></div>
			</div><!-- box -->
			<!-- box2 -->
			<div class="box">
			<div class="inbox"><a href="<?=$root ?>/index.php">トップページ</a></div>
			<div class="inbox"><a href="<?=$root ?>/index.php">トップページ</a></div>
			<div class="inbox"><a href="<?=$root ?>/index.php">トップページ</a></div>
			<div class="inbox"><a href="<?=$root ?>/index.php">トップページ</a></div>
			<div class="inbox"><a href="<?=$root ?>/index.php">トップページ</a></div>
			<div class="inbox"><a href="<?=$root ?>/index.php">トップページ</a></div>
			<div class="inbox"><a href="<?=$root ?>/index.php">トップページ</a></div>
			<div class="inbox"><a href="<?=$root ?>/index.php">トップページ</a></div>
			<div class="inbox"><a href="<?=$root ?>/index.php">トップページ</a></div>
			</div><!-- box -->
			<!-- box3 -->
			<div class="box">
			<div class="inbox"><a href="<?=$root ?>/index.php">トップページ</a></div>
			<div class="inbox"><a href="<?=$root ?>/index.php">トップページ</a></div>
			<div class="inbox"><a href="<?=$root ?>/index.php">トップページ</a></div>
			<div class="inbox"><a href="<?=$root ?>/index.php">トップページ</a></div>
			<div class="inbox"><a href="<?=$root ?>/index.php">トップページ</a></div>
			<div class="inbox"><a href="<?=$root ?>/index.php">トップページ</a></div>
			<div class="inbox"><a href="<?=$root ?>/index.php">トップページ</a></div>
			<div class="inbox"><a href="<?=$root ?>/index.php">トップページ</a></div>
			<div class="inbox"><a href="<?=$root ?>/index.php">トップページ</a></div>
			</div><!-- box -->
		</div><!-- content fin -->
	</div><!-- main fin -->
<?php
include('../footer.php');
?>