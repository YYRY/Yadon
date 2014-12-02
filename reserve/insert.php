<?php
include '../header.php';
include "../include_session/session.php";
?>
	<article>
	<form>
		<table class="reserved_t1">
			<tr>
				<td rowspan="2" class="reserved_t1_left">予約する画像</td>
				<td>予約日</td>
			</tr>
			<tr>
				<td>予約人数（～人）、座席番号（Ａ－１）</td>
			</tr>
		</table>

		<table class="reserved_t2">
			<tr>
				<td>名前</td>
				<td>姓<input type="text">　名<input type="text"></td>
			</tr>
			<tr>
				<td>メールアドレス</td>
				<td><input type="text>"></td>
			</tr>
		</table>

		<div class="regist1">
			上記の内容でユーザー登録をしますか？　<input type="checkbox">
		</div>

		<table class="reserved_t3">
			<tr>
				<td>クレジット番号</td>
				<td><input type="text">-<input type="text">-<input type="text">-<input type="text"></td>
			</tr>
			<tr>
				<td>有効期限</td>
				<td><input type="text"> / <input type="text"></td>
			</tr>
			<tr>
				<td>名義</td>
				<td></td>
			<tr>
				<td>セキュリティコード</td>
				<td><input type="text"></td>
			</tr>
		</table>

		<div class="regist2">
			上記の内容でカード情報を登録をしますか？　<input type="checkbox">
		</div>

		<div class="regist3">
			利用規約に同意しますか？　<input type="checkbox">
		</div>

		<input type="submit" value="予約を完了する">

	</form>
</article>
<?php
include '../footer.php';
?>