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
      if ($_FILES['post_img']['name'] != "") {
        $uploadOk = 1;
        $allowed = array('jpg', 'jpeg', 'gif', 'png', strtolower(end(explode('.', $profile_pic))));
        $file_name = $_FILES['post_img']['name'];
        $file_extn = strtolower(end(explode('.', $file_name)));
        $file_temp = $_FILES['post_img']['tmp_name'];
        $check = getimagesize($_FILES["post_img"]["tmp_name"]);       
        if($check !== false) {
          //echo "File is an image - " . $check["mime"] . ".";
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
            updateProduct($_POST['id'], $_POST['name'], $_POST['price'], $_POST['isOnSale'], $_POST['description'], $_POST['manufactur'], $_POST['saleValue'], $_POST['category'], $con, $_POST['clothingsex']);
            updateIcon($_POST['id'], $file_temp, $file_extn, $con);
        } elseif (in_array($file_extn, $allowed) === false) {
            echo 'Incorrect file type ';
            echo implode(',', $allowed);
        } else {
        echo 'fejl';
        }
      }
      else {
        updateProduct($_POST['id'], $_POST['name'], $_POST['price'], $_POST['isOnSale'], $_POST['description'], $_POST['manufactur'], $_POST['saleValue'], $_POST['category'], $con, $_POST['clothingsex']);
      }
    
    }
    else {
      echo "You do not have permission to preform this action.";
      echo "Your Access Level is ". $accessLevel[0]['adminLevel'];
      echo "You need Access level " . $result[0];
  }
  
    function updateIcon($id, $file_temp, $file_extn, $con){
      $file_path = 'uploads/' . substr(md5(time()), 0, 10) . '.' . $file_extn;
      move_uploaded_file($file_temp, $file_path);
      $stmt = $con->prepare('UPDATE products SET img = ? WHERE id = ?');
      $stmt->bindParam(1, $file_path);
      $stmt->bindParam(2, $id);
      $stmt->execute();
    };
    function updateProduct($id, $name, $price, $isOnSale, $description, $manufactur, $saleValue, $category, $con, $clothingSex)
    {
        if (strpos($saleValue, '%') !== false) {
            $saleValue = str_replace("%","",$saleValue);
        } 
        $stmt = $con->prepare('UPDATE products SET name = ?, price = ?, isOnSale = ?, description = ?, manufactur = ?, type = ?, saleValue = ?, sex = ? WHERE id = ?');
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $price);
        $stmt->bindParam(3, $isOnSale);
        $stmt->bindParam(4, $description);
        $stmt->bindParam(5, $manufactur);
        $stmt->bindParam(6, $category);
        $stmt->bindParam(7, $saleValue);
        $stmt->bindParam(8, $clothingSex);
        $stmt->bindParam(9, $id);

        $stmt->execute();
    };
    header('Location: adminPanel.php');