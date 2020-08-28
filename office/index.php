<?php
session_start();
require_once("../modules/setting.inc.php");
if(isset($_GET['commandcf'])){
	$ctxid = $_GET['ctxid'];
	try {
		$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
	    $stmt = $dbcon->prepare("UPDATE contact SET xstatus = '1' WHERE idx = :ctidx");
		$stmt->bindValue(':ctidx', $ctxid, PDO::PARAM_INT);
	    $stmt->execute();
		$dbcon = null;
	} catch(PDOException $e){
	    /* do nothing */
	}
}
if(isset($_GET['commandgb'])){
	$gbxid = $_GET['gbxid'];
	try {
		$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
	    $stmt = $dbcon->prepare("UPDATE guestbook SET xstatus = '1' WHERE idx = :gbidx");
		$stmt->bindValue(':gbidx', $gbxid, PDO::PARAM_INT);
	    $stmt->execute();
		$dbcon = null;
	} catch(PDOException $e){
	    /* do nothing */
	}
}
if(isset($_GET['commandgbdel'])){
	$gbxid = $_GET['gbxid'];
	try {
		$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
	    $stmt = $dbcon->prepare("UPDATE guestbook SET xstatus = '2' WHERE idx = :gbidx");
		$stmt->bindValue(':gbidx', $gbxid, PDO::PARAM_INT);
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
                            <li class="appxlink active"><a href="index.php">Home</a></li>
                            <li class="appxlink"><a href="transaction.php">Transaction</a></li>
                            <li class="appxlink"><a href="product.php">Products</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
            	<div class="span12">
            		<table id="listcontact" class="table table-bordered table-condensed table-striped">
            			<thead>
            				<tr>
            					<th style='width:24px'>No.</th>
            					<th style='width:64px'>Tanggal</th>
            					<th style='width:180px'>Nama</th>
            					<th style='width:180px'>E-Mail</th>
            					<th style='width:180px'>Phone</th>
            					<th>Pesan Kontak</th>
            					<th style='width:72px'></th>
            				</tr>
            			</thead>
            			<tbody>
<?php
try {
	$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
    $stmt = $dbcon->prepare("SELECT * FROM contact WHERE xstatus = '0' ORDER BY tanggal DESC");
    $stmt->execute();
	$countercf = 1;
    while($rowset = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo("<tr><td>".$countercf."</td><td>".substr($rowset['tanggal'],8,2)."/".substr($rowset['tanggal'],5,2)."/".substr($rowset['tanggal'],0,4)."</td><td>".$rowset['nama']."</td><td>".$rowset['alamatemail']."</td><td>".$rowset['phone']."</td><td>".$rowset['pesan']."</td><td style='text-align:center'><a href=\"index.php?commandcf=delete&ctxid=".$rowset['idx']."\">DIBACA</a></td></tr>");
    	$countercf++;
    }
	$dbcon = null;
} catch(PDOException $e){
    echo("<tr><td>No data.</td></tr>");
}
?>
            			</tbody>
            		</table>
            	</div>
            </div><!--/row-->
        	<hr>
            <div class="row">
            	<div class="span12">
            		<table id="listguestbook" class="table table-bordered table-condensed table-striped">
            			<thead>
            				<tr>
            					<th style='width:24px'>No.</th>
            					<th style='width:64px'>Tanggal</th>
            					<th style='width:180px'>Nama</th>
            					<th>Pesan Guestbook/Testimoni</th>
            					<th style='width:140px'></th>
            				</tr>
            			</thead>
            			<tbody>
<?php
try {
	$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
    $stmt = $dbcon->prepare("SELECT * FROM guestbook WHERE xstatus = '0' ORDER BY tanggal DESC");
    $stmt->execute();
	$countergb = 1;
    while($rowset = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo("<tr><td>".$countergb."</td><td>".substr($rowset['tanggal'],8,2)."/".substr($rowset['tanggal'],5,2)."/".substr($rowset['tanggal'],0,4)."</td><td>".$rowset['nama']."</td><td>".$rowset['pesan']."</td><td style='text-align:center'><a href=\"index.php?commandgb=publish&gbxid=".$rowset['idx']."\">PUBLISH</a> | <a href=\"index.php?commandgbdel=delete&gbxid=".$rowset['idx']."\">DELETE</a></td></tr>");
    	$countergb++;
    }
	$dbcon = null;
} catch(PDOException $e){
    echo("<tr><td>No data.</td></tr>");
}
?>
            			</tbody>
            		</table>
            	</div>
            </div><!--/row-->
        <hr />
        <footer>
        <p class="pull-right">Copyright &copy; <?php echo("".Date('Y')." - ".$appxinfo['_appx_company_']."");?></p>
        </footer>
        
        </div><!--/.fluid-container-->
        <script src="../assets/js/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){

            });
        </script>
    </body>
</html>
<?php else: ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo("".$appxinfo['_appx_name_']."");?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--[if lt IE 9]><script src="js/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-responsive.css">
        <style type="text/css">
            @font-face {
              font-family: 'PacificoRegular';
              src: url('../assets/fonts/Pacifico-webfont.eot');
              src: url('../assets/fonts/Pacifico-webfont.eot?#iefix') format('embedded-opentype'),
                url('../assets/fonts/Pacifico-webfont.woff') format('woff'),
                url('../assets/fonts/Pacifico-webfont.ttf') format('truetype'),
                url('../assets/fonts/Pacifico-webfont.svg#PacificoRegular') format('svg');
              font-weight: normal;
              font-style: normal;
            }
            body {
                width:320px;
                margin:0 auto;
                padding:0;
                background: #FFFFFF; /* #8BAA00 */
            }
            .container-login {width:100%;}
            .login-box {margin-top:5px;}
            .login-box-legend {margin-bottom: 10px;}
            .notice-area {height:3em;}
            .login-footer-box {padding:10px 5px;background:#171717;}
            p.login-copyright {text-align:center;font-size:11px;color:#FFF;}
            .header-pacifico {font-family: 'PacificoRegular';text-align:center;}
        </style>
    </head>
    <body>
        <div class="container-login">
            <div class="span3">
                <div class="logo-head">
                    <h1 class="header-pacifico">Online Office</h1>
                </div>
                <form id="login" class="well login-box">
                    <fieldset>
                        <legend class="login-box-legend"><h5>System Login</h5></legend>
                        <div class="notice-area"><p id="notice" class="notice"> </p></div>
                        <label for="username">Username</label>
                        <input type="text" id="username" placeholder="Username" value="" />
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password" value="" />
                        <button type="submit" id="submitlogin" class="btn btn-large pull-right"><i class="icon-lock"> </i> Login</button>
                    </fieldset>
                </form>
                <div class="login-footer-box"><p class="login-copyright">Copyright &copy; <?php echo("".Date('Y')." ".$appxinfo['_appx_company_']."");?></p></div>
            </div>
        </div>
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/appsfactory.js"></script>
    </body>
</html>
<?php
endif;
?>