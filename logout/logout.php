<?php
session_start();

//セッション情報破棄
session_destroy();

//リダイレクト（画面遷移）
header( "location:../index.php" );
exit;