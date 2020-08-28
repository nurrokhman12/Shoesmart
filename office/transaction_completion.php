<?php
session_start();
require_once("../modules/setting.inc.php");
if(isset($_SESSION['wxINFO'])):
	if(isset($_POST['orderzzid'])):
		$xtrdate = $_POST['duedatex'];
		$orderdate = strval("".substr($xtrdate,6,4)."-".substr($xtrdate,3,2)."-".substr($xtrdate,0,2)."");
		$deficit = intVal($_POST['totalpurchase']) - intVal($_POST['downpayment']);
		try {
			$dbconx = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
		    $stmtx = $dbconx->prepare("UPDATE orders SET order_code = :ordercode,duedate = :duedatex,address = UCASE(:address),company = UCASE(:company),downpayment = :downpayment,completion = :deficit,balance = :balance,total = :total WHERE idx = :orderidx");
			$stmtx->bindValue(':orderidx', $_POST['orderzzid'], PDO::PARAM_INT);
			$stmtx->bindValue(':ordercode', $_POST['ordercode'], PDO::PARAM_STR);
			$stmtx->bindValue(':duedatex', $orderdate, PDO::PARAM_STR);
			$stmtx->bindValue(':address', $_POST['address'], PDO::PARAM_STR);
			$stmtx->bindValue(':company', $_POST['company'], PDO::PARAM_STR);
			$stmtx->bindValue(':total', $_POST['totalpurchase'], PDO::PARAM_INT);
			$stmtx->bindValue(':deficit', $deficit, PDO::PARAM_INT);
			$stmtx->bindValue(':downpayment', $_POST['downpayment'], PDO::PARAM_INT);
			$stmtx->bindValue(':balance', $_POST['balance'], PDO::PARAM_INT);
		    $stmtx->execute();
			$dbcon = null;
		} catch(PDOException $e){
		    
		}
	?>
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
            		<a href="transaction.php" class="btn btn-primary btn-small"><i class="icon-eye-open icon-white"> </i> Ke Halaman Transaksi &larr;</a>
            		<hr />
		<?php
		$orderidx = $_POST['orderzzid'];
		try {
			$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
		    $stmt = $dbcon->prepare("SELECT * FROM orders WHERE idx = :orderidx");
			$stmt->bindValue(':orderidx', $orderidx, PDO::PARAM_INT);
		    $stmt->execute();
		    while($rowset = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
			    <table class="table table-bordered table-striped">
			        <thead>
			            <tr>
			                <th colspan="4">Order ID : <?php echo("".$rowset['idx']." / KODE :".$rowset['order_code']." / Tanggal : ".substr($rowset['order_date'],8,2)."/".substr($rowset['order_date'],5,2)."/".substr($rowset['order_date'],0,4)."");?><span class="pull-right">Due Date: <?php echo("".substr($rowset['duedate'],8,2)."/".substr($rowset['duedate'],5,2)."/".substr($rowset['duedate'],0,4)."");?></span></th>
			            </tr>
			        </thead>
			        <tbody>
			            <tr>
			                <td>Name</td>
			                <td><strong><?php echo("".$rowset['nama']."");?></strong></td>
			                <td>Company</td>
			                <td><strong><?php echo("".$rowset['company']."");?></strong></td>
			            </tr>
			            <tr>
			                <td>Address</td>
			                <td><strong><?php echo("".$rowset['address']."");?></strong></td>
			                <td>Phone</td>
			                <td><strong><?php echo("".$rowset['phone']."");?></strong></td>
			            </tr>
			            <tr>
			                <td>E-Mail</td>
			                <td><strong><?php echo("".$rowset['email_address']."");?></strong></td>
			                <td>References</td>
			                <td>-</td>
			            </tr>
			            <tr>
			                <td>Payment Bank Account</td>
			                <td colspan="3"><strong><?php echo("".$appxinfo['_bank_account_']."");?></strong></td>
			            </tr>
			        </tbody>
			    </table>
			    <?php
			    if($rowset['order_code']=="" && $rowset['duedate']=="0000-00-00"): ?>
				    <form id="processorder" name="processorder" class="form-inline" method="post" action="transaction_completion.php" enctype="multipart/form-data">
				    	<fieldset>
				    		<div class="row">
				    			<input type="hidden" id="orderzzid" name="orderzzid" value="<?php echo("".$rowset['idx']."");?>" />
				    			<label>Address: <input type="text" id="address" name="address" value="" class="input-xlarge" /></label> | 
				    			<label>Company: <input type="text" id="company" name="company" value="" class="input-medium" /></label> | 
					    		<label>Order Code: <input type="text" id="ordercode" name="ordercode" value="" class="input-small" /></label> | 
					    		<label>Due Date Payment: <input type="text" id="duedatex" name="duedatex" value="" class="input-small" /></label>
				    		</div>
				    		<div class="row">
				    			<label>Total Purchase: <input type="text" id="totalpurchase" name="totalpurchase" value="" class="input-small" /></label> | 
				    			<label>Down Payment: <input type="text" id="downpayment" name="downpayment" value="" class="input-small" /></label> | 
				    			<label>Balance / In-Advance: <input type="text" id="balance" name="balance" value="" class="input-small uneditable-input" /></label> | 
				    			<button type="submit" name="submitprocess" id="submitprocess" class="btn btn-primary">Process &rarr;</button>
				    		</div>
				    	</fieldset>
				    </form>
				<?php
				else:
					echo("<hr />");
				endif;
			    ?>
			    <table class="table table-bordered">
			        <thead>
			            <tr>
			                <th style='width:24px'>No.</th>
			                <th style='width:72px'>Product Code</th>
			                <th>Product Image</th>
			                <th style='width:48px'>UNIT</th>
			                <th style='width:120px'>Price/Unit</th>
			                <th style='width:48px'>Qty.</th>
			                <th style='width:120px'>Subtotal</th>
			            </tr>
			        </thead>
			<?php
		    	$itemxidx = $rowset['idx'];
			    $stmt_total = $dbcon->prepare("SELECT SUM(charged) AS total FROM order_detail WHERE customerid = :orderxyzid");
				$stmt_total->bindValue(':orderxyzid', $itemxidx, PDO::PARAM_INT);
			    $stmt_total->execute();
			    while($rowset_item = $stmt_total->fetch(PDO::FETCH_ASSOC)){
			        echo("<tfoot>");
			            echo("<tr>");
			                echo("<td colspan=\"6\" style=\"text-align:right;\">Total</td>");
			                echo("<td style=\"text-align:right;\">".number_format($rowset_item['total'],2,'.',',')."</td>");
			            echo("</tr>");
			        echo("</tfoot>");
			    }
			?>
			        <tbody>
		    <?php
		    	$orderitemidx = $rowset['idx'];
			    $stmt_item = $dbcon->prepare("SELECT * FROM order_detail WHERE customerid = :orderxid");
				$stmt_item->bindValue(':orderxid', $orderitemidx, PDO::PARAM_INT);
			    $stmt_item->execute();
				$cntrx = 1;
			    while($rowset_item = $stmt_item->fetch(PDO::FETCH_ASSOC)){
		            echo("<tr>");
		                echo("<td>".$cntrx.".</td>");
		                echo("<td>".$rowset_item['itemname']."</td>");
		                echo("<td><img src=\"../assets/images/showcase/".$rowset_item['image']."\" width=\"75\" /></td>");
		                echo("<td>UNIT</td>");
		                echo("<td style=\"text-align:right;\">".$rowset_item['price']."</td>");
		                echo("<td style=\"text-align:right;\">".$rowset_item['qty']."</td>");
		                echo("<td style=\"text-align:right;\">".$rowset_item['charged']."</td>");
		            echo("</tr>");
					$cntrx++;
			    }
		    }
			$dbcon = null;
		} catch(PDOException $e){
		    echo("");
		}
		?>
					</tbody>
				</table>
            	</div>
            </div><!--/row-->
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
				$("#duedatex").datepicker({format:'dd/mm/yyyy'});
				$("#downpayment").on('keyup',function(){
					var downpay = parseInt($(this).val());
					var totalp = parseInt($("#totalpurchase").val());
					$("#balance").val(totalp - downpay);
				});
		    });
		}(window.jQuery);
        </script>
    </body>
</html>
		<?php
	else:
?>

<?php
	endif;
else:
	
endif;
?>