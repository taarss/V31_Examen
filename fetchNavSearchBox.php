<?php
include 'main.php';
//connects to database
$connect = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}


$output = '';
if (isset($_POST["query"]) && $_POST["query"] != "") {
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
    $query = "
        SELECT id, name FROM products
        WHERE name LIKE '%" . $search . "%'
        OR id LIKE '%" . $search . "%' LIMIT 4
        ";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_all(MYSQLI_ASSOC)) {
                $output .= json_encode($row);
            }
            echo $output;
        } 
        else {
            echo 'Data Not Found';
        }
        
}
