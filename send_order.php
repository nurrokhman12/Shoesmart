<?php
include_once('modules/jcart/jcart-edited.php');
/* sessions */
session_start();
require_once("modules/setting.inc.php");
//$cart = $_SESSION['jcart']; if(!is_object($cart)) $cart = new jcart();
$xname = $_GET['xname']; 
$xmail = $_GET['xmail']; 
$xphone = $_GET['xphone'];
$xaddress = $_GET ['xaddress'];

$jcartdata = $_GET['jcartdata'];
try {
	//koneksi ke database dan binding database
	$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
    $stmt = $dbcon->prepare("INSERT INTO orders(order_date,nama,email_address,phone,address) VALUES(CURDATE(),UCASE(:xname),:xmail,:xphone,:xaddress)");
	$stmt->bindValue(':xname', $xname, PDO::PARAM_STR);
	$stmt->bindValue(':xmail', $xmail, PDO::PARAM_STR);
	$stmt->bindValue(':xphone', $xphone, PDO::PARAM_STR);
        $stmt->bindValue(':xaddress', $xaddress, PDO::PARAM_STR);
    $stmt->execute();
	$stmt_customer = $dbcon->prepare("SELECT * FROM orders WHERE order_date = CURDATE() AND nama = :xname");
	$stmt_customer->bindValue(':xname', "".$xname."", PDO::PARAM_STR);
	$stmt_customer->execute();
	if($stmt_customer->rowCount()==1){
		while($rowset_customer = $stmt_customer->fetch(PDO::FETCH_ASSOC)){
			$customeridx = intVal($rowset_customer['idx']);
		}
		/* get order details */
		$datajcart = substr($jcartdata,0,-1);
		$xData = explode("|",$datajcart);
		foreach($xData as $key=>$val){
			$zData = explode(",",$val);
			$itemidx = intVal($zData[0]);
			$itemqtyx = intVal($zData[1]);
			$stmt_detail = $dbcon->prepare("INSERT INTO order_detail(customerid,itemid,qty) VALUES(:customerid,:itemid,:qty)");
			$stmt_detail->bindValue(':customerid', $customeridx, PDO::PARAM_INT);
			$stmt_detail->bindValue(':itemid', $itemidx, PDO::PARAM_INT);
			$stmt_detail->bindValue(':qty', $itemqtyx, PDO::PARAM_STR);
			$stmt_detail->execute();
		}
		$stmt_synch = $dbcon->prepare("UPDATE order_detail,product SET order_detail.price = product.price, order_detail.itemname = product.code, order_detail.image = product.filename WHERE order_detail.customerid = :customerid AND product.idx = order_detail.itemid AND order_detail.charged = '0.00' AND order_detail.xstatus = '0'");
		$stmt_synch->bindValue(':customerid', $customeridx, PDO::PARAM_INT);
		$stmt_synch->execute();
		$stmt_charge = $dbcon->prepare("UPDATE order_detail SET charged = price * qty WHERE customerid = :customerid AND charged = '0.00' AND order_detail.xstatus = '0'");
		$stmt_charge->bindValue(':customerid', $customeridx, PDO::PARAM_INT);
		$stmt_charge->execute();
    	$response = array("ajaxresult"=>"sent","ajaxmessage"=>"Pesanan Anda telah kami terima, klik tombol 'oke' anda akan di hubungi oleh admin perihal pesanan anda selanjutnya");
    	echo json_encode($response);
	} else {
    	$response = array("ajaxresult"=>"error","ajaxmessage"=>"isi dulu");
    	echo json_encode($response);
	}
	$dbcon = null;
	$jcart->empty_cart();
} catch(PDOException $e){
    $response = array("ajaxresult"=>"error","ajaxmessage"=>$e->getMessage());
    echo json_encode($response);
}
?>
