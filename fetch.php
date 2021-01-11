<?php
include 'main.php';
//connects to database
$connect = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}


$output = '';
if (isset($_POST["query"])) {
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
    if ($_POST["category"] == 0) {
        $query = "
        SELECT * FROM products
        WHERE name LIKE '%" . $search . "%'
        OR id LIKE '%" . $search . "%' 
        ";
    }
    else {
        $query = "
        SELECT * FROM products
        WHERE name LIKE '%" . $search . "%'
        AND type = " . $_POST['category'] . "
        OR id LIKE '%" . $search . "%' 
        AND type = " . $_POST['category'];
    }
    
} else {
	$query = "
	SELECT * FROM products ORDER BY id LIMIT 100";
}
$result = mysqli_query($connect, $query);
if (mysqli_num_rows($result) > 0) {
	while ($row = $result->fetch_all(MYSQLI_ASSOC)) {
		$output .= json_encode($row);
	}
	echo $output;
} else {
	echo 'Data Not Found';
}

/*
    $stmt;
    if ($_POST['category'] != 0) {
        $stmt = $con->prepare('SELECT * FROM products WHERE type = ? name LIKE ?');
        $stmt->bind_param('ss', $_POST['category'], $_POST['searchQuery']);
    }
    else {
        $stmt = $con->prepare("SELECT * FROM products WHERE name LIKE ?");
        $test = $_POST['searchQuery'];
        $name = "%$test%"; // prepare the $name variable 
        $stmt->bind_param('s', $name);

    }
    $stmt->execute();
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $json=json_encode($products);
    echo $json;*/