<?php
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
        <link rel="stylesheet" type="text/css" href="assets/css/apps.css">
        <link rel="stylesheet" type="text/css" href="assets/css/apps-responsive.css">
        <link rel="stylesheet" type="text/css" href="assets/css/docs.css">
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
                            <li class="appxlink"><a id="home" href="index.php">Home</a></li>
                            <li class="appxlink"><a id="about" href="about.php">About</a></li>
                            <li class="appxlink active"><a id="contact" href="contact.php">Contact</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container">
			<div class="row" style='padding-top:10px'>
				<div class="span3">
<div>
	<br>
	<h1>Kontak Kami</h1>
	<p>Silahkan kirim apapun kepada kami melalui kontak yang tersedia</p>
</div>
				</div>
				<div class="span9">
					<h3>Contact Tokoku via Web :</h3>
					<hr />
					<form id="contactform" class="form-horizontal">
						<fieldset>
							<div class="control-group">
								<label class="control-label" for="inputName">Name</label>
								<div class="controls">
									<input type="text" id="inputName" placeholder="Your Name" class="input-medium">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="inputEmail">Email</label>
								<div class="controls">
									<input type="text" id="inputEmail" placeholder="Your E-Mail Address" class="input-medium">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="inputPhone">Phone</label>
								<div class="controls">
									<input type="text" id="inputPhone" placeholder="Your Phone Number" class="input-medium">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="inputMsg">Short Message</label>
								<div class="controls">
									<input type="text" id="inputMsg" placeholder="Your Message" class="input-xxlarge">
								</div>
							</div>
							<div class="control-group">
								<div class="controls">
									<button id="submitcontact" type="submit" class="btn btn-success">Send Contact Message</button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
        </div>
        <!-- site plugins -->
        <script src="assets/js/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
				$("#submitcontact").bind('click',function(){
					var xname = $("#inputName").val();
					var xemail = $("#inputEmail").val();
					var xphone = $("#inputPhone").val();
					var xmessage = $("#inputMsg").val();
					var ctxForm = "contactform.php?ctxname="+xname+"&ctxemail="+xemail+"&ctxphone="+xphone+"&ctxmessage="+xmessage+"";
					$.getJSON(ctxForm,function(data){
						var result = data.ajaxresult;
						if(result==="sent"){
							var message = data.ajaxmessage;
							$("form#contactform")[0].reset();
							alert(message);
							document.location='./';
						} else {
							$("form#contactform")[0].reset();
							alert(message);
						}
					});
					return false;
				});
            });
        </script>
    </body>
</html>