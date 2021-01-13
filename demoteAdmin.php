<?php
    include 'main.php';
    $stmt = $con->prepare('SELECT adminLevel FROM accounts WHERE id = ?');
    $stmt->bindParam(1, $_SESSION['id']);
    $stmt->execute();
    $accessLevel = $stmt->fetchAll();
    $stmt = $con->prepare('SELECT manage_accessLevel FROM accessLevel WHERE id = ?');
    $stmt->bindParam(1, $accessLevel[0]['adminLevel']);
    $stmt->execute();
    $result = $stmt->fetch();
    if ($result[0] >= $accessLevel[0]['adminLevel']) {
        $stmt = $con->prepare('UPDATE accounts SET adminLevel = ? WHERE id = ?');
        $stmt->bindParam(1,  $a = 4);
        $stmt->bindParam(2, $_POST['id']);
        $stmt->execute();
        echo $_POST['id'];
    }
    else {
        echo "You do not have permission to preform this action.";
    }