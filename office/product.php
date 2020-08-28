<?php
session_start();
require_once("../modules/setting.inc.php");
if(isset($_POST['addproduct'])){
	$code = $_POST['productcode'];
        $category = $_POST['catname'];
        $price = $_POST['price'];
        $summary = $_POST['summary'];
        $filename = $_FILES['fileimage']['tmp_name'];
        $filez = $_FILES['fileimage']['name'];
        move_uploaded_file($filename, "../assets/images/showcase/".$filez);
        $stock = $_POST['stock'];
	try {
		$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
	    $stmt = $dbcon->prepare("INSERT INTO product(code,category,price,summary,filename,stock) VALUES(UCASE(:code),:category,:price,:summary,:filename,:stock)");
		$stmt->bindValue(':code', $code, PDO::PARAM_STR);
		$stmt->bindValue(':category', $category, PDO::PARAM_STR);
		$stmt->bindValue(':price', $price, PDO::PARAM_STR);
		$stmt->bindValue(':summary', $summary, PDO::PARAM_STR);
		$stmt->bindValue(':filename', $filez, PDO::PARAM_STR);
		$stmt->bindValue(':stock', $stock, PDO::PARAM_INT);
	    $stmt->execute();
		$dbcon = null;
	} catch(PDOException $e){
            print $e;
	}
}
if(isset($_GET['productdelete']) && isset($_GET['pidx'])){
	$productidx = intVal($_GET['pidx']);
	try {
		$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
	    $stmt = $dbcon->prepare("DELETE FROM product WHERE idx = :productidx");
		$stmt->bindValue(':productidx', $productidx, PDO::PARAM_INT);
	    $stmt->execute();
		$dbcon = null;
	} catch(PDOException $e){
	    /* do nothing */
	}
}
if(isset($_GET['deletecategory']) && isset($_GET['categoryid'])){
	$catidx = intVal($_GET['categoryid']);
	try {
		$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
	    $stmt = $dbcon->prepare("DELETE FROM category WHERE idx = :catidx");
		$stmt->bindValue(':catidx', $catidx, PDO::PARAM_INT);
	    $stmt->execute();
		$dbcon = null;
	} catch(PDOException $e){
	    /* do nothing */
	}
}
if(isset($_POST['addcategory']) && isset($_POST['catname'])){
	$catname = $_POST['catname']; $cattext = $_POST['cattext'];
	try {
		$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
	    $stmt = $dbcon->prepare("INSERT INTO category(category,catstring) VALUES(:catname,:cattext)");
		$stmt->bindValue(':catname', $catname, PDO::PARAM_STR);
		$stmt->bindValue(':cattext', $cattext, PDO::PARAM_STR);
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
                            <li class="appxlink"><a href="index.php">Home</a></li>
                            <li class="appxlink"><a href="transaction.php">Transaction</a></li>
                            <li class="appxlink active"><a href="product.php">Products</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
            	<div class="span3">
            		<h4><i class="icon-share-alt"> </i> Kategori Produk</h4>
            		<hr />
            		<form id="productcategoryform" method="post" action="product.php" enctype="multipart/form-data">
            			<fieldset>
            				<input type="hidden" id="addcategory" name="addcategory" value="addcategory" />
            				<label for="catname">Kategori :</label>
            				<input type="text" id="catname" name="catname" value="" class="input-medium" />
            				<label for="cattext">Label Kategori :</label>
            				<input type="text" id="cattext" name="cattext" value="" class="input-medium" />
            				<div style="margin-top:10px">
            					<button type="submit" id="submitaddcategory" class="btn btn-primary">Tambah Kategori &rarr;</button>
            				</div>
            			</fieldset>
            		</form>
            	</div>
            	<div class="span3">
            		<table id="catlist" class="table table-bordered table-condensed table-striped">
            			<thead>
            				<tr><th style='width:24px'>No.</th><th style='width:170px'>Kategori</th><th>Label</th><th></th></tr>
            			</thead>
            			<tbody>
<?php
try {
	$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
    $stmt = $dbcon->prepare("SELECT * FROM category ORDER BY category");
    $stmt->execute();
	$counter = 1;
    while($rowset = $stmt->fetch(PDO::FETCH_ASSOC)){
    	echo("<tr><td>".$counter."</td><td>".$rowset['category']."</td><td>".$rowset['catstring']."</td><td style='text-align:center'><a href='product.php?deletecategory=delete&categoryid=".$rowset['idx']."'>DELETE</a></td></tr>");
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
            <hr />
            <div class="row">
            	<div class="span4">
            		<h4><i class="icon-share-alt"> </i> Tambah Produk</h4>
            		<hr />
            		<form id="addproductform" name="addproductform" method="post" action="product.php" enctype="multipart/form-data">
            			<fieldset>
            				<input type="hidden" id="addproduct" name="addproduct" value="addproduct" />
            				<label for="productcode">Kode/Nama Produk :</label>
            				<input type="text" id="productcode" name="productcode" value="" class="input-medium" />
            				<label for="catname">Kategori :</label>
            				<select id="catname" name="catname">
            					<option value="">== PILIH KATEGORI ==</option>
<?php
try {
	$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
    $stmt = $dbcon->prepare("SELECT * FROM category ORDER BY category");
    $stmt->execute();
    while($rowset = $stmt->fetch(PDO::FETCH_ASSOC)){
    	echo("<option value=\"".$rowset['category']."\">".$rowset['catstring']."</option>");
    }
	$dbcon = null;
} catch(PDOException $e){
    echo("");
}
?>
            				</select>
            				<label for="price">Harga :</label>
            				<input type="text" id="price" name="price" value="" class="input-medium" />
            				<label for="summary">Keterangan :</label>
            				<input type="text" id="summary" name="summary" value="" class="input-xlarge" />
            				<label for="fileimage">File Gambar :</label>
            				<input type="file" id="fileimage" name="fileimage"  />
            				<label for="price">Jumlah Stok :</label>
            				<input type="number" id="stock" name="stock" value="" class="input-medium" required/>
            				<div style="margin-top:10px">
            					<button type="submit" id="submitaddproduct" class="btn btn-primary">Tambah Produk &rarr;</button>
            				</div>
            			</fieldset>
            		</form>
            	</div>
            	<div class="span8">
            		<table class="table table-bordered">
            			<thead>
            				<tr>
            					<th style='width:24px'>No.</th>
            					<th style='width:72px'>Kode</th>
            					<th style='width:86px'>Kategori</th>
            					<th style='width:80px'>Gambar</th>
            					<th style='width:72px'>Harga</th>
            					<th>Keterangan</th>
            					<th style='width:48px'>Stok</th>
            					<th style='width:120px'></th>
            				</tr>
            			</thead>
            			<tbody>
<?php
try {
	$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
    $stmt = $dbcon->prepare("SELECT * FROM product ORDER BY category,code");
    $stmt->execute();
	$counterp = 1;
    while($rowset = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo("<tr><td>".$counterp.".</td><td>".$rowset['code']."</td><td>".$rowset['category']."</td><td><img src=\"../assets/images/showcase/".$rowset['filename']."\" width=\"75\" /></td><td style='text-align:right'>".number_format($rowset['price'],2,'.',',')."</td><td>".$rowset['summary']."</td><td style='text-align:right'>".$rowset['stock']."</td><td style='text-align:center'><a href='product_edit.php?pidx=".$rowset['idx']."'>EDIT</a> | <a href='product.php?productdelete=delete&pidx=".$rowset['idx']."'>DELETE</a></td></tr>");
		$counterp++;
    }
	$dbcon = null;
} catch(PDOException $e){
    echo("");
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