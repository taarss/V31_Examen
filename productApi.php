<?php
header("Content-Type:application/json");
    include 'main.php';
    $key= $_GET['key'];
    if ($key == null) {
        echo "NO API KEY GIVEN ERR 400";
    }
    else {
        $stmt = $con->prepare('SELECT apiKey FROM apiKey WHERE apiKey = ?');
        $stmt->bindParam(1, $key);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result == null) {
            echo "INCORRECT API KEY ERR 200";

        }
        else {
            $stmt = $con->prepare('SELECT name, description, manufactur, price FROM products');
            $stmt->execute();;
            while ($rows_get_rows = $stmt->fetch(PDO::FETCH_ASSOC)) 
            $json=json_encode($rows_get_rows);
            echo $json;
        }
    }
