<?php
    include 'main.php';
    if (isset($_POST['callFunc2'])) {
            $stmt = $con->prepare('SELECT * FROM product_showcase');
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json=json_encode($result);
            echo $json;
        }