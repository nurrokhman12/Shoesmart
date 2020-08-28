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
                            <li class="appxlink active"><a id="about" href="about.php">About</a></li>
                            <li class="appxlink"><a id="contact" href="contact.php">Contact</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container">
			<div class="row">
<div>
    <br>
    <h1>Tentang Kami</h1>
    <p>Kami adalah toko yang bergerak di bidang jual beli online, Tokoku merupakan Toko Online Alas Kaki, meliputi sepatu dan sandal untuk kebutuhan pria & wanita dewasa serta Anak-anak. Kami menyediakan ribuan koleksi terbaik dari berbagai merek lokal buatan Luar negeri </p>
</div>
			</div>
        </div>
        <!-- site plugins -->
        <script src="assets/js/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){

            });
        </script>
    </body>
</html>