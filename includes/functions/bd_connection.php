<?php
    $conn = new mysqli('localhost', 'root', '', 'gdlwebcamp', '3306');

    if ($conn->connect_error) {
        echo $error -> $conn->connect_error;
    }
    $conn->set_charset("utf8");
?>