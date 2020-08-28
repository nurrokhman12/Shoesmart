<?php

// jCart v1.3
// http://conceptlogic.com/jcart/

// This file takes input from Ajax requests and passes data to jcart.php
// Returns updated cart HTML back to submitting page

header('Content-type: text/html; charset=utf-8');

// Include jcart before session start
require_once("../setting.inc.php");
include_once('jcart-edited.php');
// Process input and return updated cart HTML
$jcart->display_cart();
header("Location: http://".$appxinfo['_appx_url_']['_server_address_']."".$appxinfo['_appx_url_']['_base_root_']."");
exit;
?>