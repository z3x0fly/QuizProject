<?php

$DBHOST = "localhost";
$DBUSER = "root";
$DBPASS = "bash1453";
$DBNAME = "quizproject";
$DBPORT = "3306";

try {
    $con = new PDO("mysql:host=$DBHOST;port=$DBPORT;dbname=$DBNAME", $DBUSER, $DBPASS);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->exec("set names utf8");
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

/////////////////////////// Time Zone Set Options \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
date_default_timezone_set('Europe/Istanbul');
$dateParam = date('Y.m.d'); //Mounth Date Year Listed
