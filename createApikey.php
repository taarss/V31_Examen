<?php 
    include 'main.php';
    $stmt = $con->prepare('SELECT adminLevel FROM accounts WHERE id = ?');
    $stmt->bindParam(1, $_SESSION['id']);
    $stmt->execute();
    $accessLevel = $stmt->fetchAll();
    $stmt = $con->prepare('SELECT manage_api FROM accessLevel WHERE id = ?');
    $stmt->bindParam(1, $accessLevel[0]['adminLevel']);
    $stmt->execute();
    $result = $stmt->fetch();
    if ($result[0] == 1) {
        $bytes = random_bytes(24);
        $key = bin2hex($bytes);
        $stmt = $con->prepare('INSERT INTO apiKey (apiKey) VALUES (?)');
        $stmt->bindParam(1, $key);
        $stmt->execute();
        header('Location: adminPanel.php');
    }
    else {
        echo "You do not have permission to preform this action.";
    }
    
    