<?php
$stmt = $con->prepare('SELECT * FROM categories LIMIT 5');
$stmt->execute();
$result = $stmt->get_result();
$categories = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>
<nav class="d-flex bg-light pb-2 navbar-fixed-top border-bottom justify-content-between" id="navBar">
        <div class="d-flex col-6">
            <img class="img-fluid m-3" id="logo" src="img/wasd-logo.png">
            <div class="container m-0">
                <p id="notice">Free Shipping on All Orders!</p>
                <ul class="nav col-12 justify-content-between text-dark">
                    <li><a href="index.php" class="text-dark">Home</a></li>
                    <?php foreach ($categories as $key) {?>
                        <li><a href="products.php?category=<?=$key['id'] ?>" class="text-dark"><?=$key['name'] ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <?php 
            if ($_SESSION['name'] != '') { ?>
                <div class="dropdown show mt-4 mr-4">
                <a class="mr-5 align-self-center align-items-center dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="d-flex justify-content-center align-items-center">
                            <i class="far fa-user-circle fa-2x text-secondary"></i>
                        <p class="m-0"><?php echo $_SESSION['name'] ?></p>
                    </div>
                    
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="#">Orders</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                <?php 
                $_SESSION['isAdmin'] = (bool)$isAdmin;
                if ($_SESSION['isAdmin'] == true) {?>
                    <a class="dropdown-item" href="adminPanel.php">Admin Panel</a>
               <?php }
                ?>
                </div>
                </div>
        <?php
            }
            else {?>
                <a class="mr-5 align-self-center" href="login.php"><i class="fas fa-sign-in-alt fa-2x text-secondary "></i></a>
        <?php } ?>
       
    </nav>