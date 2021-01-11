<?php
    include 'main.php';
    $stmt = $con->prepare('DELETE FROM products WHERE id = ?');
    $stmt->bindParam(1, $_POST['id']);
    $stmt->execute();
    $stmt->close();

