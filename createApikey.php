<?php 
    include 'main.php';
        $bytes = random_bytes(24);
        $key = bin2hex($bytes);
        $stmt = $con->prepare('INSERT INTO apiKey (apiKey) VALUES (?)');
        $stmt->bindParam(1, $key);
        $stmt->execute();
        header('Location: adminPanel.php');
    