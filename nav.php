<div class="top container">
        <div class="language">
            <div class="flag">
                <img src="img/ikon.png" alt="Dansk ikon">
                <span><?php echo var_dump($_SESSION); ?>Dansk</span>
            </div>
            <span>DKK</span>
        </div>
        <div class="search">
            <input type="text" placeholder="Indtast søgning"><input type="submit" value="Søg">
        </div>
    </div>
    <hr>
    <div class="container home">
        <a href="index.php"><img src="img/homeIcon.png" alt="Forside ikon"></a>
        <!-- Velkomstbesked -->
        <h2>Velkommen <?= $_SESSION['name'] ?>!</h2>
    </div>
    <hr>
<div class="container navbar">
        <nav>
            <ul>
                <li class="<?php if($currentPage =='home'){echo 'active';}?>"><a href="index.php">Forside</a></li>
                <li class="<?php if($currentPage =='products'){echo 'active';}?>"><a href="products.php">Produkter</a></li>
                <li class="<?php if($currentPage =='news'){echo 'active';}?>"><a href="#">Nyheder</a></li>
                <li class="<?php if($currentPage =='tos'){echo 'active';}?>"><a href="#">Handelsbetingelser</a></li>
                <?php if(!$_SESSION['loggedin']) { ?> 
                    <li><a href='#' class='loginBtn'>Log ind</a></li>
                    <li><a href='#' class='registerBtn'>Opret bruger</a></li>
                <?php }
                else {?>
                     <li><a href='logout.php'>Log ud</a></li>
               <?php }?>
               <?php
               $stmt = $con->prepare('SELECT adminLevel FROM accounts WHERE id = ?');
               $stmt->bindParam(1, $_SESSION['id']);
               $stmt->execute();
               $adminLevel = $stmt->fetch();
               if (intval($adminLevel[0]) <= 3 && $_SESSION['id'] != null) {?>
                <li class="<?php if($currentPage =='adminpanel'){echo 'active';}?>"><a href='adminPanel.php'>Admin Panel</a></li>
              <?php }
               ?>
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

				<div class="loginmsg"></div>

                    <input type="submit" value="Login">
                    <a class="forgotPass" href="forgotpassword.php">Forgot Password?</a>
            
        </form>
        <a id="newUser" class="registerBtn" href="#">Ny bruger?</a>
    </div>
    <div class="register container">
    <form action="register.php" method="post" autocomplete="off">
          <input
            type="text"
            name="username"
            placeholder="Username"
            id="username"
            required
          />
          <input
            type="password"
            name="password"
            placeholder="Password"
            id="password"
            required
          />
          <input
            type="password"
            name="cpassword"
            placeholder="Confirm Password"
            id="cpassword"
            required
          />
          <input
            type="email"
            name="email"
            placeholder="Email"
            id="email"
            required
          />
          <input type="submit" value="Register" />
          <div class="registermsg"></div>

        </form>
    </div>
    <hr>




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






