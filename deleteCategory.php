<?php 
    include 'main.php';
        echo var_dump($_POST);
        $stmt = $con->prepare('SELECT adminLevel FROM accounts WHERE id = ?');
    $stmt->bindParam(1, $_SESSION['id']);
    $stmt->execute();
    $accessLevel = $stmt->fetchAll();
    $stmt = $con->prepare('SELECT manage_categories FROM accessLevel WHERE id = ?');
    $stmt->bindParam(1, $accessLevel[0]['adminLevel']);
    $stmt->execute();
    $result = $stmt->fetch();
    if ($result[0] >= $accessLevel[0]['adminLevel']) {
        if ($_POST['productRealtion'] == "1") {
            $stmt = $con->prepare('DELETE categories, products FROM categories  
            INNER JOIN products ON categories.id=products.type  
            WHERE categories.id = ?');
            $stmt->bindParam(1, $_POST['id']);
            $stmt->execute();
        }
        else {
            $stmt = $con->prepare('DELETE FROM categories WHERE id = ?');
            $stmt->bindParam(1, $_POST['id']);
            $stmt->execute();
        }
    }
    else {
        echo "You do not have permission to preform this action.";
    }
    
        



    
