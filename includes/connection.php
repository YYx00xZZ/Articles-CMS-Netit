<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=cms1', 'root', '');
} catch (PDOException $e) {
    exit('DB err');
}
?>