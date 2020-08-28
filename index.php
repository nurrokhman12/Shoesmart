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
        <title><?php echo("" . $appxinfo['_appx_company_'] . ""); ?></title>
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
                    <a class="brand" href="#" style="margin-right:30px;color:#FFF;"><i class="icon-home separated icon-white"></i> | Shoesmart</a>
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
                            $dbcon = new PDO("mysql:host=" . $appxinfo['_db_host_'] . ";dbname=" . $appxinfo['_db_name_'] . "", "" . $appxinfo['_db_user_'] . "", "" . $appxinfo['_db_pass_'] . "");
                            $stmt = $dbcon->prepare("SELECT * FROM category ORDER BY idx");
                            $stmt->execute();
                            while ($rowset = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo("<li><a href='index.php?category=" . $rowset['category'] . "'><i class='icon-chevron-right'></i> " . $rowset['catstring'] . "</a></li>");
                            }
                            $dbcon = null;
                        } catch (PDOException $e) {
                            echo("");
                        }
                        ?>
                    </ul>
                    <div id="shopping-cart" class="bs-docs-sidenav"><div id="jcart"><?php $jcart->display_cart(); ?></div></div>
                </div>
                <div id="contents" class="span9">
                    <?php
                        if (isset($_GET['category'])) {
                            $category = $_GET['category'];
                            try {
                                $dbcon = new PDO("mysql:host=" . $appxinfo['_db_host_'] . ";dbname=" . $appxinfo['_db_name_'] . "", "" . $appxinfo['_db_user_'] . "", "" . $appxinfo['_db_pass_'] . "");
                                $stmt = $dbcon->prepare("SELECT * FROM product WHERE category = :category ORDER BY idx");
                                $stmt->bindValue(':category', $category, PDO::PARAM_STR);
                                $stmt->execute();
                                while ($rowset = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo("<div class=\"span3 product-box margin-left-reduced\">");
                                    echo("<div class=\"text-centered\"><img src=\"assets/images/showcase/" . $rowset['filename'] . "\" width=\"140\" height=\"140\" class=\"img-polaroid product-img\" /></div>");
                                    echo("<h4> " . $rowset['code'] . "</h4>");
                                    echo("<p class=\"text-justified\">" . $rowset['summary'] . "</p>");
                                    if ($rowset['price'] == "0") {
                                        echo("<h4 class=\"pull-right\">Price: [Please contact us!]</h4>");
                                    } else {
                                        echo("<h4 class=\"pull-right\">Price: IDR Rp. " . number_format($rowset['price'], '2', ',', '.') . "</h4>");
                                    }
                                    echo("<div class=\"buybox\"><a href=\"purchase_product.php?itemidx=" . $rowset['idx'] . "\" class=\"btn btn-success pull-left\"><i class=\"icon-basket icon-white\"> </i> Beli</a></div>");
                                    echo("</div>");
                                }
                                $dbcon = null;
                            } catch (PDOException $e) {
                                echo("<p class=\"alert-error\"><strong>Notice: </strong>" . $e->getMessage() . "</p>");
                            }
                        } else {
                            try {
                                $dbcon = new PDO("mysql:host=" . $appxinfo['_db_host_'] . ";dbname=" . $appxinfo['_db_name_'] . "", "" . $appxinfo['_db_user_'] . "", "" . $appxinfo['_db_pass_'] . "");
                                $stmt = $dbcon->prepare("SELECT * FROM product ORDER BY category");
                                $stmt->execute();
                                while ($rowset = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo("<div class=\"span3 product-box margin-left-reduced\">");
                                    echo("<div class=\"text-centered\"><img src=\"assets/images/showcase/" . $rowset['filename'] . "\" width=\"140\" height=\"140\" class=\"img-polaroid product-img\" /></div>");
                                    echo("<h4> " . $rowset['code'] . "</h4>");
                                    echo("<p class=\"text-justified\">" . $rowset['summary'] . "</p>");
                                    if ($rowset['price'] == "0") {
                                        echo("<h4 class=\"pull-right\">Price: [Please contact us!]</h4>");
                                    } else {
                                        echo("<h4 class=\"pull-right\">Price: IDR Rp. " . number_format($rowset['price'], '2', ',', '.') . "</h4>");
                                    }
                                    echo("<div class=\"buybox\"><a href=\"purchase_product.php?itemidx=" . $rowset['idx'] . "\" class=\"btn btn-success pull-left\"><i class=\"icon-basket icon-white\"> </i> Beli</a></div>");
                                    echo("</div>");
                                }
                                $dbcon = null;
                            } catch (PDOException $e) {
                                echo("<p class=\"alert-error\"><strong>Notice: </strong>" . $e->getMessage() . "</p>");
                            }
                        }
                    ?>
                    </div>
                </div>
            </div>
            <div>
            <?php
                        foreach ($jcart->get_contents() as $item) {
                            $itemId = $item['jcartItemId'];
                            $itemName = $item['jcartItemName'];
                            $itemPrice = $item['jcartItemPrice'];
                            $itemQty = $item['jcartItemQty'];
                            echo("" . $itemId . "<br />");
                        }
            ?>
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