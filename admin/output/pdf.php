<?php

//DB�ڑ��Ɏg���ϐ��i���[�U�[���Ƃ��p�X���[�h�Ƃ��j
$host_name = "localhost";
$dbms_user = "root";
$dbms_pass = "";

//DBMS(MySQL)�ɐڑ�
$con = mysql_connect($host_name , $dbms_user , $dbms_pass);

//���������������i�������Ȃ����j
mysql_query("SET NAMES SJIS");

//�f�[�^�x�[�X��I��
mysql_select_db( "iw32" , $con );



require('fpdf/mbfpdf.php');

//PDF����
$pdf = new MbfPDF();

//�y�[�W�ǉ�
$pdf -> addPage();

//�t�H���g�̐ݒ�
$pdf -> addMbFont ( GOTHIC , 'SJIS' );
$pdf -> addMbFont ( MINCHO , 'SJIS' );

//�����T�C�Y�ƃt�H���g
$pdf -> setFont ( GOTHIC , '' , '12px' );



/********************
*�@�Z���i�\�̕`��j
*********************/
//�J�[�\���ʒu�ݒ�
$pdf -> setXY(10 , 10);


//1~12��
for($getu=1 ; $getu<=12 ; $getu++){

if($getu == 7){
	//���y�[�W
	$pdf -> addPage();
}

//�Z���o�́i�o�͕������int�̂��̂���ꂽ���ꍇ�A(string)�ɕϊ�����΃G���[���o�Ȃ��j
//�w�i�F�icell���ōŌ��0�i���߁j���K�v�j
$pdf -> setFillColor(150 , 150 , 255);
$pdf -> setTextColor(255 , 255 , 255);
$pdf -> cell(50 , 10 , $getu."��" , '0' , 0 , "C" , 1);

$pdf -> setFillColor(90 , 90 , 90);
$pdf -> setTextColor(255 , 255 , 255);
$pdf -> cell(50 , 10 , "�^�C�g��" , 'TBLR' , 0 , "C" , 1);		//TBLR�͏㉺���E�ɐݒ�i�ʂɎw��ł���j 1�ň͂ށ@0�Řg����
$pdf -> cell(50 , 10 , "�\��l��" , 'TBLR' , 1 , "C" , 1);

$pdf -> setFillColor(255 , 255 , 255);
$pdf -> setTextColor(0 , 0 , 0);


//1���̂Ƃ���10~12���Ƃ̌딻�����
if($getu == 1){
	$sql ="
	select
	  mm.title
	, count(mo.movie_id)
	, CHAR_LENGTH(mo.watch_day)
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

while( $row = mysql_fetch_array( $res ) ){


$row[0] = substr($row[0], 0, 22);

$pdf -> cell(50 , 10 , "" , '' , 0);
$pdf -> cell(50 , 10 , $row[0] , 'TBLR' , 0);
$pdf -> cell(50 , 10 , $row[1]."�l" , 'TBLR' , 1);

}
//���s
$pdf -> Ln (10);

}




//���s
$pdf -> Ln (10);


//���y�[�W
$pdf -> addPage();



//�o�͕��@���ݒ�@��jI,D,F�iword�Q�Ɓj
$pdf -> output( 'test.pdf' , 'I' );

?>