<?php
session_start();
require_once("setting.inc.php");
if(isset($_GET['exit'])){
    session_unset();
    session_destroy();
    header("Location: http://".$appxinfo['_appx_url_']['_server_address_'] . $appxinfo['_appx_url_']['_office_root_']. "");
    exit;
}
?>