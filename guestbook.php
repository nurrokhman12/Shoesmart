<?php
/* sessions */
session_start();
require_once("modules/setting.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo("" . $appxinfo['_appx_company_'] . ""); ?></title>
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
                            <li class="appxlink active"><a id="guestbook" href="guestbook.php">Guest Book</a></li>
                        </ul>
                    </div>
                    <div id="appx-menu" class="nav-collapse">
                        <ul class="nav">
                            <li class="appxlink"><a id="home" href="index.php">Home</a></li>
                            <li class="appxlink"><a id="about" href="about.php">About</a></li>
                            <li class="appxlink"><a id="contact" href="contact.php">Contact</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row" style='padding-top:20px'>
                <div class="span3">
                    <h3>Guestbook + Testimonial</h3>
                    <hr />
                    <form id="guestbookform">
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="inputName">Name</label>
                                <div class="controls">
                                    <input type="text" id="inputName" placeholder="Your Name" class="input-medium">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputMsg">Short Message</label>
                                <div class="controls">
                                    <input type="text" id="inputMsg" placeholder="Your Message" class="input-xlarge">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <button id="submitguest" type="button" class="btn btn-success">Send Guestbook/Testimoni</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="span9">
                    <?php
                    try {
                        $dbcon = new PDO("mysql:host=" . $appxinfo['_db_host_'] . ";dbname=" . $appxinfo['_db_name_'] . "", "" . $appxinfo['_db_user_'] . "", "" . $appxinfo['_db_pass_'] . "");
                        $stmt = $dbcon->prepare("SELECT * FROM guestbook WHERE xstatus = '1' ORDER BY tanggal DESC");
                        $stmt->execute();
                        while ($rowset = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo("<blockquote><p>" . $rowset['pesan'] . "</p><small>" . $rowset['nama'] . " <cite title='Source Title'> on " . substr($rowset['tanggal'], 8, 2) . "/" . substr($rowset['tanggal'], 5, 2) . "/" . substr($rowset['tanggal'], 0, 4) . "</cite></small></blockquote>");
                        }
                        $dbcon = null;
                    } catch (PDOException $e) {
                        echo("");
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- site plugins -->
        <script src="assets/js/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#submitguest").bind('click',function(){
                    var xname = $("#inputName").val();
                    var xmessage = $("#inputMsg").val();
                    var ctxForm = "guestform.php?ctxname="+xname+"&ctxmessage="+xmessage+"";
                    $.getJSON(ctxForm,function(data){
                        var result = data.ajaxresult;
                        if(result==="sent"){
                            var message = data.ajaxmessage;
                            $("form#guestbookform")[0].reset();
                            alert(message);
                            document.location='./';
                        } else {
                            $("form#guestbookform")[0].reset();
                            alert(message);
                        }
                    });
                    return false;
                });
            });
        </script>
    </body>
</html>