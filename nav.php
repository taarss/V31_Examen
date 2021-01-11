<div class="container navbar">
        <nav>
            <ul>
                <li class="active"><a href="index.php">Forside</a></li>
                <li><a href="#">Produkter</a></li>
                <li><a href="#">Nyheder</a></li>
                <li><a href="#">Handelsbetingelser</a></li>
                <li><a href="#">Om os</a></li>
                <?php if(!$_SESSION['loggedin']) { ?> 
                    <li><a href='#' class='loginBtn'>Log ind</a></li>
                    <li><a href='register.html'>Opret bruger</a></li>
                <?php }
                else {?>
                     <li><a href='logout.php'>Log ud</a></li>
               <?php }?>
            </ul>
        </nav>
        <div class="basket">
            <div class="basketContent">
                <p>Din indkøbskurv er tom</p>
            </div>
            <div class="shopIcon">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </div>
        </div>
</div>
    <div class="login container">
        <form class="login d-flex flex-wrap" action="authenticate.php" method="post">
					<input type="text" name="username" placeholder="Username" id="username" required>
					<input type="password" name="password" placeholder="Password" id="password" required>

				<div class="msg"></div>

                    <input type="submit" value="Login">
                    <a class="forgotPass" href="forgotpassword.php">Forgot Password?</a>

            
        </form>
        <a id="newUser" href="register.php">Ny bruger?</a>
    </div>




<?php 

/*
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
       
    </nav>*/

?>






