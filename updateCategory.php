<?php 
    include 'main.php';
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
            //0.5mb
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
          }      
        if (in_array($file_extn, $allowed) === true && $uploadOk == 1) {
          updateCategoryWithIcon($_POST['name'], $_POST['id'], $file_temp, $file_extn, $con);
        } elseif (in_array($file_extn, $allowed) === false) {
            echo 'Incorrect file type ';
            echo implode(',', $allowed);
        } else {
        echo 'fejl';
        }
      }
      else {
        updateCategory($_POST['name'], $_POST['id'], $con, $_POST['productRelation']);
      }
    

    function updateCategoryWithIcon($name, $id, $file_temp, $file_extn, $con)
    {
      $file_path = 'uploads/' . substr(md5(time()), 0, 10) . '.' . $file_extn;
      move_uploaded_file($file_temp, $file_path);
      $stmt = $con->prepare('UPDATE categories SET name = ?, icon = ? WHERE id = ?');
      $stmt->bindParam(1, $name);
      $stmt->bindParam(2, $file_path);
      $stmt->bindParam(3, $id);
      $stmt->execute();
    };
    function updateCategory($name, $id, $con, $productRealtion)
    {
      $stmt = $con->prepare('UPDATE categories SET name = ? WHERE id = ?');
      $stmt->bindParam(1, $name);
      $stmt->bindParam(2, $id);
      $stmt->execute();
    };
    header('Location: adminPanel.php');