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


    //echo "You need access level " . $result['manage_accessLevel'];
    //echo "Your access level is ". var_dump($accessLevel);
    if ($result[0] >= $accessLevel[0]['adminLevel']) {
        $manageProducts = $_POST['manageProductsRadio'];
        $manageCategories = $_POST['manageCategoriesRadio'];
        $manageApi = $_POST['manageApiRadio'];
        $manageAccessLevel = $_POST['manageAccessLevelRadio'];
        if ($manageCategories == null) {
            $manageCategories = 0;
        }
        if ($manageProducts == null) {
            $manageProducts = 0;
        }
        if ($manageApi == null) {
            $manageApi = 0;
        }
        if ($manageAccessLevel == null) {
            $manageAccessLevel = 0;
        }
        $stmt = $con->prepare('UPDATE accessLevel SET manage_products = ?, manage_categories = ?, manage_api = ?, manage_accessLevel = ? WHERE id = ?');
        $stmt->bindParam(1, $manageProducts);
        $stmt->bindParam(2, $manageCategories);
        $stmt->bindParam(3, $manageApi);
        $stmt->bindParam(4, $manageAccessLevel);
        $stmt->bindParam(5, $_POST['id']);
        $stmt->execute();
        header('Location: adminPanel.php');
    }
    else {
        echo "You do not have permission to preform this action.";
    }
    
    