<?php
/* sessions */
session_start();
require_once("modules/setting.inc.php");
$xname = $_GET['ctxname']; $xemail = $_GET['ctxemail']; $xphone = $_GET['ctxphone']; $xmessage = $_GET['ctxmessage']; 
try {
	$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
    $stmt = $dbcon->prepare("INSERT INTO contact(tanggal,nama,alamatemail,phone,pesan,xstatus) VALUES(CURDATE(),UCASE(:nama),:email,:phone,UCASE(:pesan),'0')");
	$stmt->bindValue(':nama', $xname, PDO::PARAM_STR);
	$stmt->bindValue(':email', $xemail, PDO::PARAM_STR);
	$stmt->bindValue(':phone', $xphone, PDO::PARAM_STR);
	$stmt->bindValue(':pesan', $xmessage, PDO::PARAM_STR);
    $stmt->execute();
	/* sending e-mail ke management */
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'To: '.$appxinfo['_biz_email_'].'' . "\r\n";
	$headers .= 'From: ' .$xemail. ' '.$appxinfo['_biz_email_'].'' . "\r\n";
	$orderbody = "
	<table style=\"width:100%;background:#DEDEDE;line-height:2em;border:1px solid #ADADAD;\">
		<tr>
			<td style=\"background:#C1C1C1;\">Request Kontak Tanggal/Oleh</td>
			<td>".Date('d/m/Y')." / ".$xemail." [".$xphone."]</td>
		<tr>
		<tr>
			<td style=\"background:#C1C1C1;\"><strong>Message</strong></td>
			<td>".$xmessage."</td>
		<tr>
	</table>
	";
	mail(''.$appxinfo['_biz_email_'].'', 'Website Contact Request', $orderbody, $headers);
	/* end */
    $response = array("ajaxresult"=>"sent","ajaxmessage"=>"Request kontak Anda telah terkirim. Silahkan tunggu respon kami.");
    echo json_encode($response);
	$dbcon = null;
} catch(PDOException $e){
    $response = array("ajaxresult"=>"error","ajaxmessage"=>$e->getMessage());
    echo json_encode($response);
}
?>