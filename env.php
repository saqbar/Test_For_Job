<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";


$connectBD = new mysqli("$servername", "$username", "$password", "$dbname");
if ($connectBD->connect_error) {
    die("Ошибка: " . $connectBD->connect_error);
}