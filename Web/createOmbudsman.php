<?php
header("Content-Type: application/json");

$description =$_POST['description'];
$service_type = $_POST['service_type'];
$files =  json_decode($_POST['files'],true);

die($description .'  '.$service_type .'  '.json_encode($files) );

?>