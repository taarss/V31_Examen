<?php 
    include 'main.php';
        echo var_dump($_POST);
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
        
        



    
