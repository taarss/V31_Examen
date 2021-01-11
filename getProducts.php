<?php
    include 'main.php';
    if (isset($_POST['get100'])) {
            $stmt = $con->prepare('SELECT * FROM products LIMIT 100');
            $stmt->execute();
            $products = $stmt->fetch();
            $json=json_encode($products);
            echo $json;
        }
    if (isset($_POST['getFromCategory'])) {
            $stmt = $con->prepare('SELECT * FROM products WHERE type = ?');
            $stmt->bindParam(1, $_POST['category']);
            $stmt->execute();
            $products = $stmt->fetch();
            $json=json_encode($products);
            echo $json;
    }