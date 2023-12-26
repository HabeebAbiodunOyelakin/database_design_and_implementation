<?php

$host = "smart2database.cgmteav7lcdk.us-east-1.rds.amazonaws.com";
$username="Oyellarq2";
$password="Oyellarq2";
$database="smart2Database";


$mysql = new PDO("mysql:host=".$host.";dbname=".$database,$username,$password);

?>