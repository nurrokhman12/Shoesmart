<?php
include_once('modules/jcart/jcart-edited.php');
/* sessions */
session_start();

require_once("modules/setting.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo("".$appxinfo['_appx_company_']."");?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Tokoku, the fine wood-craft art gallery. Tokoku, located in Blabak, Magelang, Central Java, Indonesia, is a fine wood-craft art gallery. Visit Tokoku Gallery to see the beauty of best tropical wood-craft in Indonesia.">
        <meta name="keywords" content="Tokoku,wood,craft,magelang,borobudur,yogyakarta,indonesia,gallery">
        <meta name="author" content="">
        <link rel="stylesheet" type="text/css" href="assets/css/apps.css" />
        <link rel="stylesheet" type="text/css" href="assets/css/apps-responsive.css" />
        <link rel="stylesheet" type="text/css" href="assets/css/docs.css" />
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div id="appx-menu-container" class="container-fluid">
                    <a class="brand" href="#" style="margin-right:30px;color:#FFF;"><i class="icon-home separated icon-white"></i> | Tokoku</a>
                    <div class="nav-collapse pull-right">
                        <ul class="nav">
                            <li class="appxlink"><a id="guestbook" href="guestbook.php">Guest Book</a></li>
                        </ul>
                    </div>
                    <div id="appx-menu" class="nav-collapse">
                        <ul class="nav">
                            <li class="appxlink active"><a id="home" href="index.php">Home</a></li>
                            <li class="appxlink"><a id="about" href="about.php">About</a></li>
                            <li class="appxlink"><a id="contact" href="contact.php">Contact</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div id="navbar" class="span3 bs-docs-sidebar">
                    <ul id="sidebar" class="nav nav-list bs-docs-sidenav">
                        <li><a id="all" href="index.php"><i class="icon-chevron-right"></i> All Products</a></li>
						<?php
						try {
							$dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
						    $stmt = $dbcon->prepare("SELECT * FROM category ORDER BY idx");
						    $stmt->execute();
						    while($rowset = $stmt->fetch(PDO::FETCH_ASSOC)){
								echo("<li><a href='index.php?category=".$rowset['category']."'><i class='icon-chevron-right'></i> ".$rowset['catstring']."</a></li>");
						    }
							$dbcon = null;
						} catch(PDOException $e){
						    echo("");
						}
						?>
                    </ul>
                    <div id="shopping-cart" class="bs-docs-sidenav"> </div>
                </div>
                <div id="contents" class="span9">
				<?php
				if(isset($_GET['itemidx'])){
					$item_idx = $_GET['itemidx'];
					try{
					    $dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
					    $stmt = $dbcon->prepare("SELECT * FROM product WHERE idx = :itemidx");
					    $stmt->bindParam(':itemidx', $item_idx, PDO::PARAM_INT);
					    $stmt->execute();
					    while($rowset = $stmt->fetch(PDO::FETCH_ASSOC)){
					        $idxitem = $rowset['idx'];
					        $codeitem = $rowset['code'];
					        $categoryitem = $rowset['category'];
					        $filenameitem = $rowset['filename'];
					        if($rowset['price']=="0"){
					        	$priceitem = $rowset['price'];
					        } else {
					        	$priceitem = $rowset['price'];
					        }
					        $summaryitem = $rowset['summary']; ?>
					<div class="row product-box">
					    <div class="span3">
					        <img src="assets/images/showcase/<?php echo("".$filenameitem."");?>" class="img-polaroid" width="300" height="300" alt="item image" />
					    </div>
					    <div class="span5">
					        <h3><?php echo("".$codeitem."");?></h3>
					        <p><?php echo("".$summaryitem."");?></p>
					        <form id="purchase-form" method="post" action="modules/jcart/relay-post.php" class="jcart">
					            <fieldset>
					                <input type="hidden" id="my-item-id" name="my-item-id" value="<?php echo("".$idxitem."");?>" />
					                <input type="hidden" id="my-item-name" name="my-item-name" value="<?php echo("".$codeitem."");?>" />
					                <input type="hidden" id="my-item-price" name="my-item-price" value="<?php echo("".$rowset['price']."");?>" />
					                <?php
							        if($rowset['price']=="0"){
										echo("<p>Price : <span>[Please contact us!]</span></p>");
							        } else {
							        	echo("<p>Price : <span>".$rowset['price']."</span></p>");
							        }
					                ?>
					                <div class="input-prepend input-append">
					                    <span class="add-on">Qty.:</span><input class="span2" id="appendedPrependedInput" name="my-item-qty" size="16" type="text" value="1" /><span class="add-on">pcs.</span>
					                </div>
					                <input type="submit" id="my-add-button" name="my-add-button" value="add to cart" class="btn btn-info" />
					            </fieldset>
					        </form>
					        <hr />
					        <div id="shopping-cart-main"><div id="jcart"><?php $jcart->display_cart();?></div></div>
					    </div>
					</div>
					        <?php
					    }
					    $dbcon = NULL;
					} catch(PDOException $e){
					    echo("".$e->getMessage()."");
					}
				}
				?>
                </div>
            </div>
        </div>
        <!-- site plugins -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="modules/jcart/js/jcart-extended.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){

            });
        </script>
    </body>
</html>