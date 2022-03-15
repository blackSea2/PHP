<?php
$user = 'root';
$password = 'root';
$db = 'testing';
$host = 'localhost';

$dsn = 'mysql:host=' . $host . ';dbname=' . $db;
$pdo = new PDO ($dsn, $user, $password);