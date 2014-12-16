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
<body>
	<a href="<?=$root ?>/index.php">TOP</a>>Q&A
	<div id="main">
		<div id="leftcolumn">
			<div id="QA">
				<div class="Q">
					<img src="<?=$root ?>/img/Q&A/Q.png" class="imgbox">
					<h2>チケット購入について</h2>
					<p>購入したチケットの払い戻しはできますか？</p>
				</div>
				<div class="A">
					<img src="<?=$root ?>/img/Q&A/A.png" class="imgbox">
					<h2>回答</h2>
					<p>一度ご購入された後は、交通渋滞による来場遅延など、その他いかなる場合（お客様のご都合でチケットをお引取りにならない場合など）も払い戻しはいたしかねますのでご了承ください。</p>
				</div>
				<div class="Q">
					<img src="<?=$root ?>/img/Q&A/Q.png" class="imgbox">
					<h2>購入完了メール・購入番号について</h2>
					<p>チケットを購入したのに購入完了メールが届きません。どうすればいいですか？</p>
				</div>
				<div class="A">
					<img src="<?=$root ?>/img/Q&A/A.png" class="imgbox">
					<h2>回答</h2>
					<p>購入が完了したにも関わらず、購入完了メールが届かない要因といたしましては、入力していただいたメールアドレスが正確でない可能性があります。
					<br />＊携帯電話のドメイン指定受信を設定されている方は、<span id="mail">「hal.ticket@ml.haltheater.jp」</span>をご指定ください。
					なお、購入番号をお忘れの際は、恐れ入りますが、チケットカウンターにて発券の手続きをさせていただきます。
					<br />＊購入完了メールの再送はできかねますことをご了承ください。
					また、購入番号が表示されなかった場合など、チケット購入が無事完了しているかを確認したい場合には劇場にお問い合わせいただけますとお調べすることができます。

					</p>
				</div>
				<div class="Q">
					<img src="<?=$root ?>/img/Q&A/Q.png" class="imgbox">
					<h2>上映スケジュールについて</h2>
					<p>上映スケジュールはいつ更新されますか？</p>
				</div>
				<div class="A">
					<img src="<?=$root ?>/img/Q&A/A.png" class="imgbox">
					<h2>テキスト</h2>
					<p>基本的には毎週火曜日もしくは水曜日に、その週の土曜日から翌週金曜日までを決定しホームページを更新させていただいております。 
					<br />＊金曜日から公開作品がある場合は、火曜日に、その週の金曜日から翌週金曜日までを決定することもございます。</p>
				</div>
			</div><!-- Q&A -->
<!--<?php
while($row = mysql_fetch_array($res)){
				echo"<div>".$row['service_name']."</div>";
				echo "<div>".$row['service_detail']."</div>";
		}
?>-->
		</div><!-- leftcolumn fin -->
	</div><!-- main fin -->
<body>
<?php
include('../footer.php');
?>