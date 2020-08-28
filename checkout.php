<?php
include_once('modules/jcart/jcart-edited.php');
/* sessions */
session_start();

//memanggil module setting
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
                    <div id="shopping-cart" class="bs-docs-sidenav"></div>
                </div>
                <div id="contents" class="span9" style="padding-top:30px">
                	<div class="row">
                		<div id="jcart"><?php $jcart->display_cart();?></div>
                	</div>
                	<hr />
                	<div class="row">
                		<form id="formorder" class="form-horizontal">
                			<fieldset>
                				<label for="cuname">Fullname :</label>
                				<input type="text" id="cuname" class="input-medium" value="" />
                				<label for="cumail">E-Mail Address :</label>
                				<input type="email" id="cumail" class="input-medium" value="" required />
                				<label for="cuphone">Phone #. :</label>
                				<input type="text" id="cuphone" class="input-medium" value="" required />
                                                <label for="xaddress">Address #. :</label>
                                                <textarea id="caddress" class="input-medium" style="resize: none;"></textarea>
                				
                				<div style='margin-top:10px'>
                					<button id="submitorder" type="submit" class="btn btn-success"><i class="icon-share icon-white"> </i> Process My Order &rarr;</button>
                				</div>
                			</fieldset>
                		</form>
                	</div>
            	</div>
        	</div>
        </div>
        <!-- site plugins -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="modules/jcart/js/jcart-extended.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
				$("#submitorder").bind('click',function(){
					var jcartdata = "";
					$("#cartbox tbody tr").each(function(){
						var itemId = $(this).find("input[type='hidden'][name='jcartItemId[]']").val();
						var itemQty = $(this).find("input[type='text'][name='jcartItemQty[]']").val();
						jcartdata += ""+itemId+","+itemQty+"|";
					});
					//console.log(jcartdata);
					var cname = $("#cuname").val();
					var cmail = $("#cumail").val();
					var cphone = $("#cuphone").val();
                                        var caddress = $("#caddress").val();
					var axtFile = "send_order.php?xname="+cname+"&xmail="+cmail+"&xphone="+cphone+"&xaddress="+caddress+"&jcartdata="+jcartdata+"";
                                        
					$.getJSON(axtFile,function(data){
						var result = data.ajaxresult;
						if(result==="sent"){
							var message = data.ajaxmessage;
							alert(message);
							$("form#formorder")[0].reset();
							document.location='./';
						} else {
							var message = data.ajaxmessage;
							alert(message);
							$("form#formorder")[0].reset();
						}
					});
					return false;
				});
            });
        </script>
    </body>
</html>
