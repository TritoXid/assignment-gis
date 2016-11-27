<?php

// udaje na pripojenie k DB
$host = 'localhost';
$port = '5432';
$dbname = 'bratislava';
$user = 'postgres';
$password = 'postgres';

$db = new PDO("pgsql:dbname=$dbname; host=$host", "$user", "$password");

?>