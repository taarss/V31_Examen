<?php 
    include 'main.php';
        echo var_dump($_POST);
        $stmt = $con->prepare('SELECT adminLevel FROM accounts WHERE id = ?');
        $stmt->bindParam(1, $_SESSION['id']);
        $stmt->execute();
        $accessLevel = $stmt->fetchAll();
        $stmt = $con->prepare('SELECT manage_api FROM accessLevel WHERE id = ?');
        $stmt->bindParam(1, $accessLevel[0]['adminLevel']);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result[0] == 1) {
            $stmt = $con->prepare('DELETE FROM apiKey WHERE id = ?');
            $stmt->bindParam(1, $_POST['id']);
            $stmt->execute();
        }
        else {
            echo "You do not have permission to preform this action.";
        }
        
        
        
        


