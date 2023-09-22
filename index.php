<?php
$host = "localhost";
$db = "31b";
$user = "root";
$password = "";

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

global $oPDO;
try {
    $oPDO = new PDO($dsn, $user, $password);
    if ($oPDO) {
        echo "Connected to the $db database successfully";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>