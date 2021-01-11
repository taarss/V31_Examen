<?php
    include 'main.php';
    if (isset($_POST['callFunc2'])) {
            $stmt = $con->prepare('SELECT * FROM apiKey');
            $stmt->execute();
            $result = $stmt->fetchAll();
            $json=json_encode($result);
            echo $json;
        }