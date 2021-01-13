<?php
    include 'main.php';
    if (isset($_POST['callFunc2'])) {
            $stmt = $con->prepare('SELECT id, username, email, adminLevel FROM accounts WHERE adminLevel <= 3');
            $stmt->execute();
            $result = $stmt->fetchAll();
            $json=json_encode($result);
            echo $json;
        }