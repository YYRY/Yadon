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
$pdf -> setFont ( GOTHIC , '' , '22px' );
$pdf -> write ( 20 , '�\��֘A���͎��� PDF');
$pdf -> Ln (10);

/*****************
* �f��ʔ���グ
*****************/
$pdf -> setFont ( GOTHIC , '' , '18px' );
$pdf -> write ( 50 , '�f��ʔ���グ');
//���s
$pdf -> Ln (30);
$pdf -> setFont ( GOTHIC , '' , '12px' );

		
//SQL �f�於�𒊏o
$sql = "
SELECT DISTINCT title , count(*)*1800 , count(*)
FROM movie_m AS MM 

JOIN movie AS m
ON m.movie_id = MM.movie_id

GROUP BY m.movie_id
ORDER BY count(m.movie_id) DESC";
				
//SQL���s
$res = mysql_query( $sql , $con );		//$res�ɂ́u���� true�v���u���s false�v������

//�Y�����p�ϐ�
$count = 1;


$pdf -> setFillColor(90 , 90 , 90);
$pdf -> setTextColor(255 , 255 , 255);
$pdf -> cell(100 , 10 , "�^�C�g��" , '1' , 0 , "C" , 1);
$pdf -> cell(40 , 10 , "����グ" , 'TBLR' , 0 , "C" , 1);		//TBLR�͏㉺���E�ɐݒ�i�ʂɎw��ł���j 1�ň͂ށ@0�Řg����
$pdf -> cell(40 , 10 , "����" , 'TBLR' , 1 , "C" , 1);

$pdf -> setFillColor(255 , 255 , 255);
$pdf -> setTextColor(0 , 0 , 0);

//�F�A�C�R���Ɖf��^�C�g���\��
while( $row = mysql_fetch_array( $res ) ){
	$row[0] = substr($row[0], 0, 40);
	$pdf -> cell(100 , 10 , $row[0] , '1' , 0 , "C" , 1);
	$pdf -> cell(40 , 10 , $row[1]."�~" , '1' , 0 , "C" , 1);
	$pdf -> cell(40 , 10 , $row[2]."��" , '1' , 1 , "C" , 1);
	$count++;
}






//���y�[�W
$pdf -> addPage();



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



//�o�͕��@���ݒ�@��jI,D,F�iword�Q�Ɓj
$pdf -> output( 'test.pdf' , 'I' );

?>