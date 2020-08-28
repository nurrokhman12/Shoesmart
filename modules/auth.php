<?php
session_start();
require_once("setting.inc.php");
/* passing post data */
$user_name = htmlspecialchars(trim($_GET['username']));
$pass_word = sha1(htmlspecialchars($_GET['password']));
try{
    $dbcon = new PDO("mysql:host=".$appxinfo['_db_host_'].";dbname=".$appxinfo['_db_name_']."","".$appxinfo['_db_user_']."","".$appxinfo['_db_pass_']."");
    $stmt = $dbcon->prepare("SELECT idx FROM users WHERE username = :username AND password = :password");
    $stmt->bindParam(':username', $user_name, PDO::PARAM_STR);
    $stmt->bindParam(':password', $pass_word, PDO::PARAM_STR);
    $stmt->execute();
    if($stmt->rowCount()==1){
        while($rowset = $stmt->fetch(PDO::FETCH_ASSOC)){
            $iduser = $rowset['idx'];
        }
        $stmtdetailed = $dbcon->prepare("SELECT * FROM users WHERE idx = '".$iduser."'");
        $stmtdetailed->execute();
        while($detrowset = $stmtdetailed->fetch(PDO::FETCH_ASSOC)){
            $nd_idx         = $detrowset['idx'];
            $nd_username    = $detrowset['username'];
        }
        $_SESSION['wxINFO'] = array(
            "userid" => $nd_idx, 
            "username" => $nd_username
        );
        $dbcon = NULL;
        $authresponse = array("authresult"=>"authorised","authmessage"=>"Anda telah mendapat otorisasi login");
        echo json_encode($authresponse);
    }else{
        $dbcon = NULL;
        $authresponse = array("authresult"=>"unauthorised","authmessage"=>"Anda gagal mendapat otorisasi login.");
        echo json_encode($authresponse);
    }
} catch(PDOException $e){
    $sysresponse =  $e->getMessage();
    $authresponse = array("authresult"=>"failure","authmessage"=>$sysresponse);
    echo json_encode($authresponse);
}
?>