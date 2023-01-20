<?php 
include_once('config.php');
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
    $db->delete('problema',array('id'=>$_REQUEST['delId']));
    header('location: browse-users.php?msg=rds');
    exit;
}
?>