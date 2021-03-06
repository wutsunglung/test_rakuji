<?php

$db_host = 'localhost';
$db_user = 'rakuji';
$db_pass = 'rakuji';
$db_name = 'rakuji';

$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8";

$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_BOTH, // 預設值
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8 "
];

$pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);

if(! isset($_SESSION)){
    session_start();
}