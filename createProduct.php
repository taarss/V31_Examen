<?php 
    include 'main.php';
    $stmt = $con->prepare('SELECT adminLevel FROM accounts WHERE id = ?');
    $stmt->bindParam(1, $_SESSION['id']);
    $stmt->execute();
    $accessLevel = $stmt->fetchAll();
    $stmt = $con->prepare('SELECT manage_products FROM accessLevel WHERE id = ?');
    $stmt->bindParam(1, $accessLevel[0]['adminLevel']);
    $stmt->execute();
    $result = $stmt->fetch();
    if ($result[0] == 1) {
    $uploadOk = 1;
    $allowed = array('jpg', 'jpeg', 'gif', 'png', strtolower(end(explode('.', $profile_pic))));
		$file_name = $_FILES['post_img']['name'];
		$file_extn = strtolower(end(explode('.', $file_name)));
        $file_temp = $_FILES['post_img']['tmp_name'];
        $check = getimagesize($_FILES["post_img"]["tmp_name"]);       
        if($check !== false) {
         // echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
        } else {
         echo "File is not an image.";
          $uploadOk = 0;
        }
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
          }      
		if (in_array($file_extn, $allowed) === true && $uploadOk == 1) {
			uploadProduct($_POST['post_name'], $_POST['post_price'], $_POST['post_description'], $_POST['post_manufactur'], $_POST['post_type'], $file_temp, $file_extn, $con, $_POST['clothingsex']);
		} elseif (in_array($file_extn, $allowed) === false) {
			echo 'Incorrect file type ';
			echo implode(',', $allowed);
		} else {
		echo 'fejl';
    }
  }
  else {
    echo "You do not have permission to preform this action.";
}

    function uploadProduct($name, $price, $description, $manufactur, $type, $file_temp, $file_extn, $con, $clothingsex)
    {
        $file_path = 'uploads/' . substr(md5(time()), 0, 10) . '.' . $file_extn;
        move_uploaded_file($file_temp, $file_path);
        $stmt = $con->prepare('INSERT INTO products (name, price, description, manufactur, type, img, sex, createdBy) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $price);
        $stmt->bindParam(3, $description);
        $stmt->bindParam(4, $manufactur);
        $stmt->bindParam(5, $type);
        $stmt->bindParam(6, $file_path);
        $stmt->bindParam(7, $clothingsex);
        $stmt->bindParam(8, $_SESSION['id']);
        $stmt->execute();
        header('Location: adminPanel.php');
    }

  