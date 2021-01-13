<?php 
    include 'main.php';
    if (isset($_POST['callFunc2'])) {
        $stmt = $con->prepare('SELECT adminLevel FROM accounts WHERE id = ?');
        $stmt->bindParam(1, $_SESSION['id']);
        $stmt->execute();
        $accessLevel = $stmt->fetchAll();
        $stmt = $con->prepare('SELECT manage_categories FROM accessLevel WHERE id = ?');
        $stmt->bindParam(1, $accessLevel[0]['adminLevel']);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result[0] == 1) {
            $index = 1;
            foreach ($_POST['callFunc2'] as $key) {
                $stmt = $con->prepare('UPDATE product_showcase SET productId = ? WHERE id = ?');
                $stmt->bindParam(1, $key);
                $stmt->bindParam(2, $index);
                $stmt->execute();
                $index++;
            }
            header('Location: adminPanel.php');
        }
        else {
            echo "You do not have permission to preform this action.";
        }
    }