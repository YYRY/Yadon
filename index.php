<?php
include 'header.php';

/**********
* DB接続
**********/
$host_name = "localhost";
$dbms_user = "root";
$dbms_pass = "";
$con = mysql_connect($host_name , $dbms_user , $dbms_pass);
mysql_query("SET NAMES utf8");
mysql_select_db( "iw32" , $con );

?>
		<!-- メインコンテンツ -->
		<article class="main-contents">
			<!-- メインビジュアル -->
			<article class="main-visual">

				<ul>
					<li><img src="img/movie-top/GODZILLA.jpg" width="905" height="500" src="" alt="GODZILLA"></li>
					<li><img src="img/movie-top/マレフィセント.png" width="905" height="500" src="" alt="マレフィセント"></li>
					<li><img src="img/movie-top/pokemon.png" width="905" height="500" src="" alt="ポケモン・ザ・ムービーXY 「破壊の繭とディアンシー」"></li>
					<li><img src="img/movie-top/ma-ni-.png" width="905" height="500" src="" alt="思い出のマーニー"></li>
					<li><img src="img/movie-top/8ranger.png" width="905" height="500" src="" alt="エイトレンジャー2"></li>
					
				</ul>
			</article>

			<article class="main-info">
				<!-- ランキング -->
				<section>
					<h3>週間ランキング</h3>
					<dl>
						<dt>1</dt>
						<dd>GODZILLA</dd>
						<dt>2</dt>
						<dd>マレフィセント</dd>
						<dt>3</dt>
						<dd>ポケモン・ザ・ムービーXY 「破壊の繭とディアンシー」</dd>
						<dt>4</dt>
						<dd>思い出のマーニー</dd>
						<dt>5</dt>
						<dd>エイトレンジャー2</dd>
					</dl>
				</section>

				<!-- お知らせ -->
				<section>
					<h3>ハルシネマからのお知らせ</h3>

                    <dl>
			<?php
                        $sql = "SELECT title , registered_date FROM notice ORDER BY notice_id DESC LIMIT 6";
                        $res = mysql_query( $sql , $con );

                        while( $row = mysql_fetch_array( $res ) ){
							//文字列 切り出し
							$day = substr($row[1] , 5 , 5);
							?>
                        	<dt><time datetime="<?= $day ?>"><?= $day ?></time></dt>
                        	<dd><?= $row[0] ?></dd>
                        <?php }
                        mysql_close( $con );
                        ?>
                    </dl>

				</section>
			</article>

			<aside class="sub-info">
				<!-- 今日のサービス -->
				<section>
					<h3>今日のサービス</h3>
					<dl>
						<dt>レディースデイ</dt>
						<dd>女性は30%引き</dd>
						<dt>シニア割</dt>
						<dd>60歳以上の方は20%引き</dd>
					</dl>
				</section>

				<!-- 近日公開作品 -->
				<section>
					<h3>近日公開作品</h3>
					<dl>
						<dt><time datetime="2014-08-01">8月1日</time></dt>
						<dd>○○に公開</dd>
						<dt><time datetime="2014-08-01">8月1日</time></dt>
						<dd>○○に公開</dd>
						<dt><time datetime="2014-08-01">8月1日</time></dt>
						<dd>○○に公開</dd>
						<dt><time datetime="2014-08-01">8月1日</time></dt>
						<dd>○○に公開</dd>
						<dt><time datetime="2014-08-01">8月1日</time></dt>
						<dd>○○に公開</dd>
						<dt><time datetime="2014-08-01">8月1日</time></dt>
						<dd>○○に公開</dd>
					</dl>
				</section>

				<!-- バナー -->
				<section>
					<a href=""><img src="img/movie/000042158.jpg" class="banner" alt="バナー1"></a>
					<a href=""><img src="img/movie/000043174.jpg" class="banner" alt="バナー2"></a>
				</section>
			</aside>
		</article>

<?php
include 'footer.php';
?>