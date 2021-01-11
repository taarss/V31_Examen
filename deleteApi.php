<?php 
    include 'main.php';
        echo var_dump($_POST);
        $stmt = $con->prepare('DELETE FROM apiKey WHERE id = ?');
        $stmt->bind_param('i', $_POST['id']);
        $stmt->execute();
        $stmt->close();
        
        
        


