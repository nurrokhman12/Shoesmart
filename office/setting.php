<?php
session_start();
require_once("../modules/setting.inc.php");
if(isset($_GET['command']) && isset($_GET['userid'])){
	$userid = intVal($_GET['userid']);
	try {
		$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
	    $stmt = $dbcon->prepare("DELETE FROM users WHERE idx = :userid");
		$stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
	    $stmt->execute();
		$dbcon = null;
	} catch(PDOException $e){
	    /* do nothing */
	}
}
if(isset($_POST['commandadduser']) && isset($_POST['uusername'])){
	$username = $_POST['uusername']; $password = sha1($_POST['upasswordx']);
	try {
		$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
	    $stmt = $dbcon->prepare("INSERT INTO users(username,password) VALUES(:username,:password)");
		$stmt->bindValue(':username', $username, PDO::PARAM_STR);
		$stmt->bindValue(':password', $password, PDO::PARAM_STR);
	    $stmt->execute();
		$dbcon = null;
	} catch(PDOException $e){
	    /* do nothing */
	}
}
if(isset($_POST['commandchangepassword']) && isset($_POST['passwordy'])){
	$passwordx = sha1($_POST['passwordx']); $passwordy = sha1($_POST['passwordy']);
	try {
		$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
	    $stmt = $dbcon->prepare("UPDATE users SET password = :password WHERE idx = :userid");
		$stmt->bindValue(':userid', $_SESSION['wxINFO']['userid'], PDO::PARAM_INT);
		$stmt->bindValue(':password', $passwordy, PDO::PARAM_STR);
	    $stmt->execute();
		$dbcon = null;
	    session_unset();
	    session_destroy();
	    header("Location: http://".$appxinfo['_appx_url_']['_server_address_'] . $appxinfo['_appx_url_']['_office_root_']. "");
	    exit;
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
                            <li class="appxlink active"><a href="setting.php">Settings</a></li>
                            <li><a id="exit" href="../modules/exit.php?exit=true">Exit</a></li>
                        </ul>
                    </div>
                    <div id="appx-menu" class="nav-collapse">
                        <ul class="nav">
                            <li class="appxlink"><a href="index.php">Home</a></li>
                            <li class="appxlink"><a href="transaction.php">Transaction</a></li>
                            <li class="appxlink"><a href="product.php">Products</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
            	<div class="span4">
            		<h4><i class="icon-lock"> </i> Ganti Password</h4>
            		<hr />
            		<form id="changepasswordform" method="post" action="setting.php" enctype="multipart/form-data">
            			<fieldset>
            				<input type="hidden" id="commandchangepassword" name="commandchangepassword" value="changepasswordnow" />
            				<label for="passwordx">Password Lama :</label>
            				<input type="password" id="passwordx" name="passwordx" value="" class="input-medium" />
            				<label for="passwordy">Password Baru :</label>
            				<input type="password" id="passwordy" name="passwordy" value="" class="input-medium" />
            				<label for="passwordz">Konfirmasi Password Baru :</label>
            				<input type="password" id="passwordz" name="passwordz" value="" class="input-medium" />
            				<div style="margin-top:10px">
            					<button type="submit" id="submitchangepassword" class="btn btn-primary">Ganti Password &rarr;</button>
            				</div>
            			</fieldset>
            		</form>
            	</div>
            	<div class="span4">
            		<h4><i class="icon-user"> </i> Pengguna / User</h4>
            		<hr />
            		<form id="adduserform" name="adduserform" method="post" action="setting.php" enctype="multipart/form-data">
            			<fieldset>
            				<input type="hidden" id="commandadduser" name="commandadduser" value="adduser" />
            				<label for="uusername">Username :</label>
            				<input type="text" id="uusername" name="uusername" value="" class="input-medium" />
            				<label for="upasswordx">Password :</label>
            				<input type="password" id="upasswordx" name="upasswordx" value="" class="input-medium" />
            				<label for="upasswordy">Konfirmasi Password :</label>
            				<input type="password" id="upasswordy" name="upasswordy" value="" class="input-medium" />
            				<div style="margin-top:10px">
            					<button type="submit" id="submitadduser" class="btn btn-primary">Tambah &rarr;</button>
            				</div>
            			</fieldset>
            		</form>
            	</div>
            	<div class="span4">
            		<table id="userlist" class="table table-bordered table-condensed table-striped">
            			<thead>
            				<tr><th style='width:24px'>No.</th><th style='width:24px'>ID</th><th style='width:170px'>Username</th><th></th></tr>
            			</thead>
            			<tbody>
<?php
try {
	$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
    $stmt = $dbcon->prepare("SELECT * FROM users ORDER BY idx");
    $stmt->execute();
	$counter = 1;
    while($rowset = $stmt->fetch(PDO::FETCH_ASSOC)){
    	if($rowset['username']=="admin"){
    		echo("<tr><td><strong>".$counter."</strong></td><td><strong>".$rowset['idx']."</strong></td><td><strong>".$rowset['username']."</strong></td><td style='text-align:center'><strong>NO-DELETE</strong></td></tr>");
    	} else {
    		echo("<tr><td>".$counter."</td><td>".$rowset['idx']."</td><td>".$rowset['username']."</td><td style='text-align:center'><a href='setting.php?command=deleteuser&userid=".$rowset['idx']."'>DELETE</a></td></tr>");
    	}
		$counter++;
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
            <div class="row">
            	<div class="span12">
            		
            	</div>
            </div><!--/row-->
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
<?php
else:
	
endif;
?>