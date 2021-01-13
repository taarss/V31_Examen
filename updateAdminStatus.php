<?php
    include 'main.php';
    if (isset($_POST['callFunc2'])) {
        $stmt = $con->prepare('SELECT adminLevel FROM accounts WHERE id = ?');
        $stmt->bindParam(1, $_SESSION['id']);
        $stmt->execute();
        $accessLevel = $stmt->fetchAll();
        $stmt = $con->prepare('SELECT manage_accessLevel FROM accessLevel WHERE id = ?');
        $stmt->bindParam(1, $accessLevel[0]['adminLevel']);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result[0] == 1) {
            $stmt = $con->prepare('UPDATE accounts SET adminLevel = ? WHERE id = ?');
            $stmt->bindParam(1, $_POST['status']);
            $stmt->bindParam(2, $_POST['user']);
            $stmt->execute();
            echo $_POST['user'];
            echo "    ";
            echo $_POST['status'];
        }
        else {
          echo "You do not have permission to preform this action.";
      }
    }
    else{
        echo "incorrect call method";
    }