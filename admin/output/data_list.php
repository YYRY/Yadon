<?php

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

?>

<!DOCTYPE html>
<html>
	<head>
	<title>統計情報一覧</title>
	<meta charset="utf-8">
	<meta name="keywords" content="HALシネマ東京"><!-- ＳＥＯ対策　-->
	<meta name="description" content="HALシネマのサイトです">
	<meta name="author" content="Kaito Shidara" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<link rel="apple-touch-icon" href="img/icon/" /><!-- スマホで見るなら -->
	<!--  css  -->
	<link href="../css/common.css" rel="stylesheet" type="text/css">
	<link href="../css/output/data_list.css" rel="stylesheet" type="text/css">
	<!--  js  -->
	<script src="js/script.js"></script>

<style>
table , td{
	border:1px solid #000;
}

</style>

	</head>
<body>

<article>


<p>月別の映画予約状況</p>

<?php

for($getu=1 ; $getu<=12 ; $getu++){
echo $getu."月<br />";

if($getu == 1){
	$sql ="
	select
	  mm.title
	, count(mo.movie_id)
	, CHAR_LENGTH(mo.watch_day)
	, mo.movie_id
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
	, mo.movie_id
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
	, mo.movie_id
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

echo "<table>";
echo "<tr>";
echo "<th>タイトル</th><th>予約人数</th>";
echo "</tr>";

while( $row = mysql_fetch_array( $res ) ){

//movie_idの取得
$mov_id = $row["movie_id"];

echo "<tr>";
echo "<td><a href='select.php?movie=".$mov_id."'>".$row[0]."</a></td>";
echo "<td>".$row[1]."</td>";
echo "</tr>";
}
echo "</table>";

}


?>

		<!--映画別売り上げ-->
		<div class="INFO">
			<div class="I_Top">
				<p>映画別売り上げ</p>
				<img src="1.php" width="100" height="100">
			</div>

			<div class="I_Bottom">
				<?

				//SQL movie_idを件数で出力（映画別売り上げ用）
				$sql = "SELECT count(*) FROM movie GROUP BY movie_id ORDER BY count(*) DESC";
				
				//SQL実行
				$res = mysql_query( $sql , $con );
				
				
				//添え字用	1スタートなのは後に表示する画像やDBのidと辻褄を合わせるため
				$count = 1;
				
				//抽出
				while( $row = mysql_fetch_array( $res ) ){
				
					//基本料金
					$money_r = $row[0] * 1800;
				
					//値
					$money[$count] = $money_r;
					$m_count[$count] = $row[0];

					$count++;
				}
				
				//SQL 映画名を抽出
				$sql = "
				SELECT DISTINCT title 
				FROM movie_m AS MM 
				
				JOIN movie AS m
				ON m.movie_id = MM.movie_id
				
				GROUP BY m.movie_id
				ORDER BY count(m.movie_id) desc";
				
				//SQL実行
				$res = mysql_query( $sql , $con );		//$resには「成功 true」か「失敗 false」が入る


				//添え字用変数
				$count = 1;

				$color[] = "赤,紫,青,緑,橙";

				//色アイコンと映画タイトル表示
				while( $row = mysql_fetch_array( $res ) ){ ?>
					<img src="../img/output/<?= $count ?>.png" alt="<?= $color[$count] ?>" width="12px" height="12px">&ensp;
					<?php
					echo $row["title"] , "<br />";
					echo "&ensp;&ensp;&ensp;" , $money[$count] , "円";
					echo "&ensp;&ensp;&ensp;" , $m_count[$count] , "件<br />";
					$count++;
				}
				?>
			</div>
		</div>



		<!--ジャンル別売り上げ-->
		<div class="INFO">
			<div class="I_Top">
				<p>ジャンル別売り上げ</p>
				<img src="2.php" width="100" height="100">
			</div>

			<div class="I_Bottom">
	                <?
	                //SQL ジャンル名を抽出
	                $sql = "
	                SELECT count(*) , genre_name
	                FROM movie AS m
	                
	                JOIN movie_m AS MM
	                ON m.movie_id = MM.movie_id
	                
	                JOIN genre AS g
	                ON m.movie_id = g.movie_id
	                
	                JOIN genre_m AS GM
	                ON g.genre_t = GM.genre_t
	                
	                GROUP BY GM.genre_name
	                ORDER BY count(m.movie_id) desc";
	                
	                //SQL実行
	                $res = mysql_query( $sql , $con );		//$resには「成功 true」か「失敗 false」が入る


	                //添え字用変数
	                $count = 1;

	                $color[] = "赤,紫,青,緑,橙";

	                //色アイコンと映画タイトル表示
	                while( $row = mysql_fetch_array( $res ) ){ ?>
	                    <img src="../img/output/<?= $count ?>.png" alt="<?= $color[$count] ?>" width="12px" height="12px">&ensp;
	                    <?php
	                    echo $row["genre_name"] , "<br />";
	                    echo "&ensp;&ensp;&ensp;" , $row[0] , "件<br />";
	                    $count++;
	                }
	                ?>
	            </div>
	        </div>



		<!--性別売り上げ-->
		<div class="INFO">
			<div class="I_Top">
				<p>性別売り上げ</p>
				<img src="3.php" width="100" height="100">
			</div>

			<div class="I_Bottom">
				<?
				//SQL 性別を出力
				$sql = "
				SELECT sei, count(*)
				FROM movie AS m
				
				JOIN customer_m AS c
				ON m.customer_id = c.customer_id
				
				GROUP BY c.sei
				ORDER BY count(*) DESC";
				
				//SQL実行
				$res = mysql_query( $sql , $con );		//$resには「成功 true」か「失敗 false」が入る

                //添え字用変数
                $count = 1;

                $color[] = "赤,紫,青,緑,橙";

				//色アイコンと映画タイトル表示
				while( $row = mysql_fetch_array( $res ) ){ ?>
					<img src="../img/output/<?= $count ?>.png" alt="<?= $color[$count] ?>" width="12px" height="12px">&ensp;
					<?php
                    echo $row["sei"] , "<br />";
                    echo "&ensp;&ensp;&ensp;" , $row[1] , "人<br />";
                    $count++;
				}
				?>
			</div>
		</div>

		<div class="clear"></div>

		<!--年代別売り上げ-->
		<div class="INFO">
			<div class="I_Top">
				<p>年代別売り上げ</p>
				<img src="4.php" width="100" height="100">
			</div>

			<div class="I_Bottom">
				<?
				//SQL 生年月日を出力
				$sql = "
				SELECT seinenn, count(*)
				FROM movie AS m
				
				JOIN customer_m AS c
				ON m.customer_id = c.customer_id
				
				GROUP BY seinenn
				ORDER BY seinenn";
				
				//SQL実行
				$res = mysql_query( $sql , $con );		//$resには「成功 true」か「失敗 false」が入る


				//添え字用変数
				$count = 1;

				$color[] = "赤,紫,青,緑,橙";

				//色アイコンと映画タイトル表示
				while( $row = mysql_fetch_array( $res ) ){ ?>
					<img src="../img/output/<?= $count ?>.png" alt="<?= $color[$count] ?>" width="12px" height="12px">&ensp;
					<?php
					$seinenn = substr($row["seinenn"], 0, 4);
					echo $seinenn , "年代<br />";
					echo "&ensp;&ensp;&ensp;" , $row[1] , "人<br />";
					$count++;
				}
				?>
			</div>
		</div>



		<!--時間帯別売り上げ-->
		<div class="INFO">
			<div class="I_Top">
				<p>時間帯別売り上げ</p>
				<img src="5.php" width="100" height="100">
			</div>
            
			<div class="I_Bottom">
			<?
			//SQL 鑑賞時間帯を出力
				$sql = "
				SELECT watch_time , count(*)
				FROM movie
				GROUP BY watch_time";
				
				//SQL実行
				$res = mysql_query( $sql , $con );		//$resには「成功 true」か「失敗 false」が入る


				//添え字用変数
				$count = 1;
                
				$color[] = "赤,紫,青,緑,橙";
                
				//色アイコンと映画タイトル表示
				while( $row = mysql_fetch_array( $res ) ){ ?>
					<img src="../img/output/<?= $count ?>.png" alt="<?= $color[$count] ?>" width="12px" height="12px">&ensp;
					<?php
					$time = substr($row["watch_time"], 0, 5);
					/*時間表示名変更*/
					if($time == "930"){
						$time = "9:30";
					}
					else if($time == "1530"){
						$time = "15:30";
					}
					echo $time , "～<br />";
					echo "&ensp;&ensp;&ensp;" , $row[1] , "人<br />";
					$count++;
				}
				?>
			</div>
		</div>

		<!--登録件数（性別）-->
		<div class="INFO">
		<h2>登録件数</h2>
			<div class="I_Top">
				<p>性別</p>
				<img src="6.php" width="100" height="100">
			</div>
            
			<div class="I_Bottom">
				<?
				$sql = "
				SELECT sei , count(*)
				FROM customer_m
				WHERE sei = '男' or sei = '女'
				GROUP BY sei
				ORDER BY count(*) DESC";
				
				//SQL実行
				$res = mysql_query( $sql , $con );		//$resには「成功 true」か「失敗 false」が入る


				//添え字用変数
				$count = 1;
				
				$color[] = "赤,紫,青,緑,橙";
                
				//色アイコンと映画タイトル表示
				while( $row = mysql_fetch_array( $res ) ){ ?>
					<img src="../img/output/<?= $count ?>.png" alt="<?= $color[$count] ?>" width="12px" height="12px">&ensp;
					<?php
					echo $row["sei"] , "性<br />";
					echo "&ensp;&ensp;&ensp;" , $row[1] , "人<br />";
					$count++;
				}
				?>
			</div>
		</div>



        
		<div class="clear"></div>

		<a href="pdf.php">
     		<img src="../img/output/button.png" alt="PDF化">
		</a>


	</article>
    
    <div class="clear"></div>

</body>
</html>