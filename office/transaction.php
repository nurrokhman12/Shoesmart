<?php
session_start();
require_once("../modules/setting.inc.php");
if(isset($_GET['orderdelete'])){
	$orderidx = $_GET['orderid'];
	try {
		$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
	    $stmt = $dbcon->prepare("UPDATE orders SET xstatus = '9' WHERE idx = :orderidx");
		$stmt->bindValue(':orderidx', $orderidx, PDO::PARAM_INT);
	    $stmt->execute();
		$dbcon = null;
	} catch(PDOException $e){
	    /* do nothing */
	}
}
if(isset($_GET['orderfinish'])){
	$orderidx = $_GET['orderid'];
	try {
		$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
	    $stmt = $dbcon->prepare("UPDATE orders SET xstatus = '8' WHERE idx = :orderidx");
		$stmt->bindValue(':orderidx', $orderidx, PDO::PARAM_INT);
	    $stmt->execute();
		$dbcon = null;
	} catch(PDOException $e){
	    /* do nothing */
	}
}
if(isset($_SESSION['wxINFO'])): ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo("".$appxinfo['_appx_name_']."");?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--[if lt IE 9]><script src="../assets/js/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" type="text/css" href="../assets/css/apps.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/apps-responsive.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/docs.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/datepicker-improved.css">
        <style type="text/css">
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
            .sidebar-nav {
                padding: 9px 0;
            }
            .separated {border-right:1px solid #999999;padding-right:10px;}
        </style>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div id="appx-menu-container" class="container-fluid">
                    <a class="brand" href="#" style="margin-right:30px;color:#FFF;"><i class="icon-home separated"></i> Tokoku</a>
                    <div class="nav-collapse pull-right">
                        <ul class="nav">
                            <li class="appxlink"><a href="setting.php">Settings</a></li>
                            <li><a id="exit" href="../modules/exit.php?exit=true">Exit</a></li>
                        </ul>
                    </div>
                    <div id="appx-menu" class="nav-collapse">
                        <ul class="nav">
                            <li class="appxlink"><a href="index.php">Home</a></li>
                            <li class="appxlink active"><a href="transaction.php">Transaction</a></li>
                            <li class="appxlink"><a href="product.php">Products</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <div class="container">
            <div id="appx_content" class="row">
            	<div class="span12">
            		<form id="trxselectdate" name="trxselectdate" method="post" action="transaction.php" enctype="multipart/form-data" class="form-inline">
			        	<fieldset>
			        		<a href="transaction_process.php" class="btn btn-primary"><i class="icon-eye-open icon-white"> </i> Ke Halaman Proses &larr;</a>
				            <label class="checkbox"><strong>Tampilkan Order Tanggal :</strong>
				                <input id="trxdate" name="trxdate" type="text" class="input-small" value="">
				            </label>
				            <button id="searchcommand" type="submit" class="btn btn-danger">Cari data &rarr;</button>
			        	</fieldset>
            		</form>
            	</div>
            </div><!--/row-->
            <hr />
            <div class="row">
            	<div class="span12">
            		<table class="table table-bordered table-condensed table-striped">
            			<thead>
				            <tr>
				                <th style='width:24px'>No.</th>
				                <th style='width:64px'>Tanggal</th>
				                <th style='width:100px'>Nomor/Kode</th>
				                <th style='width:180px'>Nama</th>
				                <th style='width:180px'>E-Mail</th>
				                <th>Phone</th>
				                <th style='width:140px'></th>
				            </tr>
            			</thead>
            			<tbody>
<?php
if(isset($_POST['trxdate'])){
	$xtrdate = $_POST['trxdate'];
	$orderdate = strval("".substr($xtrdate,6,4)."-".substr($xtrdate,3,2)."-".substr($xtrdate,0,2)."");
	try {
		$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
	    $stmt = $dbcon->prepare("SELECT * FROM orders WHERE order_date = :orderdate AND xstatus != '9'");
	    $stmt->bindValue(':orderdate', $orderdate, PDO::PARAM_STR);
	    $stmt->execute();
		$counter = 1;
	    while($rowset = $stmt->fetch(PDO::FETCH_ASSOC)){
	    	if($rowset['xstatus']=="0"){
	    		echo("<tr><td>".$counter."</td><td>".substr($rowset['order_date'],8,2)."/".substr($rowset['order_date'],5,2)."/".substr($rowset['order_date'],0,4)."</td><td>".$rowset['order_code']."</td><td>".$rowset['nama']."</td><td>".$rowset['email_address']."</td><td>".$rowset['phone']."</td><td style='text-align:center'><a href=\"transaction_process.php?orderid=".$rowset['idx']."\">PROCESS</a> | <a href=\"transaction.php?orderdelete=delete&orderid=".$rowset['idx']."\">DELETE</a></td></tr>");
	    	} elseif($rowset['xstatus']=="1"){
	    		echo("<tr><td>".$counter."</td><td>".substr($rowset['order_date'],8,2)."/".substr($rowset['order_date'],5,2)."/".substr($rowset['order_date'],0,4)."</td><td>".$rowset['order_code']."</td><td>".$rowset['nama']."</td><td>".$rowset['email_address']."</td><td>".$rowset['phone']."</td><td style='text-align:center'><a href=\"transaction_process.php?orderid=".$rowset['idx']."\">PROCESS</a> | <a href=\"transaction.php?orderdelete=delete&orderid=".$rowset['idx']."\">DELETE</a></td></tr>");
	    	} elseif($rowset['xstatus']=="2"){
	    		echo("<tr><td>".$counter."</td><td>".substr($rowset['order_date'],8,2)."/".substr($rowset['order_date'],5,2)."/".substr($rowset['order_date'],0,4)."</td><td>".$rowset['order_code']."</td><td>".$rowset['nama']."</td><td>".$rowset['email_address']."</td><td>".$rowset['phone']."</td><td style='text-align:center'><a href=\"transaction_process.php?orderid=".$rowset['idx']."\">PROCESS</a> | <a href=\"transaction.php?orderdelete=delete&orderid=".$rowset['idx']."\">DELETE</a></td></tr>");
	    	} else {
	    		echo("<tr><td>".$counter."</td><td>".substr($rowset['order_date'],8,2)."/".substr($rowset['order_date'],5,2)."/".substr($rowset['order_date'],0,4)."</td><td>".$rowset['order_code']."</td><td>".$rowset['nama']."</td><td>".$rowset['email_address']."</td><td>".$rowset['phone']."</td><td style='text-align:center'><a href=\"transaction_process.php?orderid=".$rowset['idx']."\">PROCESS</a> | <a href=\"transaction.php?orderdelete=delete&orderid=".$rowset['idx']."\">DELETE</a></td></tr>");
	    	}
			$counter++;
	    }
		$dbcon = null;
	} catch(PDOException $e){
	    echo("<tr><td>No data.</td></tr>");
	}
} else {
	try {
		$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
	    $stmt = $dbcon->prepare("SELECT * FROM orders WHERE order_date = CURDATE() AND xstatus != '9'");
	    $stmt->execute();
		$counter = 1;
	    while($rowset = $stmt->fetch(PDO::FETCH_ASSOC)){
	    	if($rowset['xstatus']=="0"){
	    		echo("<tr><td>".$counter."</td><td>".substr($rowset['order_date'],8,2)."/".substr($rowset['order_date'],5,2)."/".substr($rowset['order_date'],0,4)."</td><td>".$rowset['order_code']."</td><td>".$rowset['nama']."</td><td>".$rowset['email_address']."</td><td>".$rowset['phone']."</td><td style='text-align:center'><a href=\"transaction_process.php?orderid=".$rowset['idx']."\">PROCESS</a> | <a href=\"transaction.php?orderdelete=delete&orderid=".$rowset['idx']."\">DELETE</a></td></tr>");
	    	} elseif($rowset['xstatus']=="1"){
	    		echo("<tr><td>".$counter."</td><td>".substr($rowset['order_date'],8,2)."/".substr($rowset['order_date'],5,2)."/".substr($rowset['order_date'],0,4)."</td><td>".$rowset['order_code']."</td><td>".$rowset['nama']."</td><td>".$rowset['email_address']."</td><td>".$rowset['phone']."</td><td style='text-align:center'><a href=\"transaction_process.php?orderid=".$rowset['idx']."\">PROCESS</a> | <a href=\"transaction.php?orderdelete=delete&orderid=".$rowset['idx']."\">DELETE</a></td></tr>");
	    	} elseif($rowset['xstatus']=="2"){
	    		echo("<tr><td>".$counter."</td><td>".substr($rowset['order_date'],8,2)."/".substr($rowset['order_date'],5,2)."/".substr($rowset['order_date'],0,4)."</td><td>".$rowset['order_code']."</td><td>".$rowset['nama']."</td><td>".$rowset['email_address']."</td><td>".$rowset['phone']."</td><td style='text-align:center'><a href=\"transaction_process.php?orderid=".$rowset['idx']."\">PROCESS</a> | <a href=\"transaction.php?orderdelete=delete&orderid=".$rowset['idx']."\">DELETE</a></td></tr>");
	    	} else {
	    		echo("<tr><td>".$counter."</td><td>".substr($rowset['order_date'],8,2)."/".substr($rowset['order_date'],5,2)."/".substr($rowset['order_date'],0,4)."</td><td>".$rowset['order_code']."</td><td>".$rowset['nama']."</td><td>".$rowset['email_address']."</td><td>".$rowset['phone']."</td><td style='text-align:center'><a href=\"transaction_process.php?orderid=".$rowset['idx']."\">PROCESS</a> | <a href=\"transaction.php?orderdelete=delete&orderid=".$rowset['idx']."\">DELETE</a></td></tr>");
	    	}
			$counter++;
	    }
		$dbcon = null;
	} catch(PDOException $e){
	    echo("<tr><td>No data.</td></tr>");
	}
}
?>
            			</tbody>
            		</table>
            	</div>
            </div>
            <hr />
            <div class="row">
            	<div class="span12">
            		<table class="table table-bordered table-condensed table-striped">
            			<thead>
            				<tr><th colspan='7' style='text-align:center'>Order Payment Due Date Today : <?php echo("".Date('d/m/Y')."");?></th></tr>
				            <tr>
				                <th style='width:24px'>No.</th>
				                <th style='width:64px'>Tanggal</th>
				                <th style='width:100px'>Nomor/Kode</th>
				                <th style='width:180px'>Nama</th>
				                <th style='width:180px'>E-Mail</th>
				                <th>Phone</th>
				                <th style='width:140px'></th>
				            </tr>
            			</thead>
            			<tbody>
<?php
	try {
		$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
	    $stmt = $dbcon->prepare("SELECT * FROM orders WHERE duedate = CURDATE() AND xstatus != '8'");
	    $stmt->execute();
		$counter = 1;
	    while($rowset = $stmt->fetch(PDO::FETCH_ASSOC)){
	    	if($rowset['xstatus']=="0"){
	    		echo("<tr><td>".$counter."</td><td>".substr($rowset['order_date'],8,2)."/".substr($rowset['order_date'],5,2)."/".substr($rowset['order_date'],0,4)."</td><td>".$rowset['order_code']."</td><td>".$rowset['nama']."</td><td>".$rowset['email_address']."</td><td>".$rowset['phone']."</td><td style='text-align:center'><a href=\"transaction_process.php?orderid=".$rowset['idx']."\">PROCESS</a> | <a href=\"transaction.php?orderfinish=finish&orderid=".$rowset['idx']."\">SELESAI</a></td></tr>");
	    	} elseif($rowset['xstatus']=="1"){
	    		echo("<tr><td>".$counter."</td><td>".substr($rowset['order_date'],8,2)."/".substr($rowset['order_date'],5,2)."/".substr($rowset['order_date'],0,4)."</td><td>".$rowset['order_code']."</td><td>".$rowset['nama']."</td><td>".$rowset['email_address']."</td><td>".$rowset['phone']."</td><td style='text-align:center'><a href=\"transaction_process.php?orderid=".$rowset['idx']."\">PROCESS</a> | <a href=\"transaction.php?orderfinish=finish&orderid=".$rowset['idx']."\">SELESAI</a></td></tr>");
	    	} elseif($rowset['xstatus']=="2"){
	    		echo("<tr><td>".$counter."</td><td>".substr($rowset['order_date'],8,2)."/".substr($rowset['order_date'],5,2)."/".substr($rowset['order_date'],0,4)."</td><td>".$rowset['order_code']."</td><td>".$rowset['nama']."</td><td>".$rowset['email_address']."</td><td>".$rowset['phone']."</td><td style='text-align:center'><a href=\"transaction_process.php?orderid=".$rowset['idx']."\">PROCESS</a> | <a href=\"transaction.php?orderfinish=finish&orderid=".$rowset['idx']."\">SELESAI</a></td></tr>");
	    	} else {
	    		echo("<tr><td>".$counter."</td><td>".substr($rowset['order_date'],8,2)."/".substr($rowset['order_date'],5,2)."/".substr($rowset['order_date'],0,4)."</td><td>".$rowset['order_code']."</td><td>".$rowset['nama']."</td><td>".$rowset['email_address']."</td><td>".$rowset['phone']."</td><td style='text-align:center'><a href=\"transaction_process.php?orderid=".$rowset['idx']."\">PROCESS</a> | <a href=\"transaction.php?orderfinish=finish&orderid=".$rowset['idx']."\">SELESAI</a></td></tr>");
	    	}
			$counter++;
	    }
		$dbcon = null;
	} catch(PDOException $e){
	    echo("<tr><td>No data.</td></tr>");
	}
?>
            			</tbody>
            		</table>
            	</div>
            </div>
        <hr>
        
        <footer>
        <p class="pull-right">Copyright &copy; <?php echo("".Date('Y')." - ".$appxinfo['_appx_company_']."");?></p>
        </footer>
        
        </div><!--/.fluid-container-->
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/bootstrap-datepicker-improved.js"></script>
        <script type="text/javascript">
		!function ($){
		    $(function(){
				$("#trxdate").datepicker({format:'dd/mm/yyyy'});
		    });
		}(window.jQuery);
        </script>
    </body>
</html>
<?php
else:
	
endif;
?>