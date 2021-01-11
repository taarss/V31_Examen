<?php
include 'main.php';
// No need for the user to see the login form if they're logged-in so redirect them to the home page
if (isset($_SESSION['loggedin'])) {
	// If the user is not logged in redirect to the home page.
	header('Location: index.php');
	exit;
}
// Also check if they are "remembered"
/*
if (isset($_COOKIE['rememberme']) && !empty($_COOKIE['rememberme'])) {
	// If the remember me cookie matches one in the database then we can update the session variables.
	$stmt = $con->prepare('SELECT id, username FROM accounts WHERE rememberme = ?');
	$stmt->bind_param('s', $_COOKIE['rememberme']);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		// Found a match
		$stmt->bind_result($id, $username);
		$stmt->fetch();
		$stmt->close();
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $username;
		$_SESSION['id'] = $id;
		header('Location: index.php');
		exit;
	}
}*/
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,minimum-scale=1">
	<title>Login</title>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
</head>

<body class="d-flex justify-content-center align-items-center" id="loginBackground">
<nav class="d-flex bg-light pb-2 navbar-fixed-top border-bottom justify-content-between" id="navBar">
        <div class="d-flex col-6">
            <img class="img-fluid m-3" id="logo" src="img/wasd-logo.png">
            <div class="container m-0">
                <p id="notice">Free Shipping on All Orders!</p>
                <ul class="nav col-12 justify-content-between text-dark">
                    <li><a href="index.php" class="text-dark">Home</a></li>
                    <li><a href="#" class="text-dark">Full Boards</a></li>
                    <li><a href="#" class="text-dark">Switches</a></li>
                    <li><a href="#" class="text-dark">Keycaps</a></li>
                    <li><a href="#" class="text-dark">Accessories</a></li>
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
                </div>
                </div>
        <?php
            }
            else {?>
                <a class="mr-5 align-self-center" href="login.php"><i class="fas fa-sign-in-alt fa-2x text-secondary "></i></a>
        <?php } ?>
       
    </nav>
	<svg xmlns="http://www.w3.org/2000/svg" style="display: none">
		<symbol id="checkmark" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-miterlimit="10" fill="none" d="M22.9 3.7l-15.2 16.6-6.6-7.1">
			</path>
		</symbol>
	</svg>
	<div class="login bg-light rounded d-flex flex-column col-2">
		<h1 class="py-5 text-center">Login</h1>
		<div class="loginWrapper">
			<form action="authenticate.php" method="post">
				<div>
					<input type="text" name="username" placeholder="Username" id="username" required>
				</div>
				<div>
					<input type="password" name="password" placeholder="Password" id="password" required>
				</div>

				<div class="msg"></div>

				<div class="promoted-checkbox">
					<input name="rememberme" id="tmp" type="checkbox" class="promoted-input-checkbox" />
					<p>remember me</p>
				</div>
				<a class="forgotPass" href="forgotpassword.php">Forgot Password?</a>
				<div>
					<input type="submit" value="Login">
				</div>

				<div>
					<p class="regHere">Don't have an account? Register here:</p>
					<div class="links">
						<a href="register.html">Register</a>
					</div>

			</form>

		</div>
	</div>
	<script>
		$(".login form").submit(function(event) {
			event.preventDefault();
			var form = $(this);
			var url = form.attr('action');
			$.ajax({
				type: "POST",
				url: url,
				data: form.serialize(),
				success: function(data) {
					if (data.toLowerCase().includes("success")) {
						window.location.href = "index.php";
					} else {
						$(".msg").text(data);
					}
				}
			});
		});
	</script>
	
</body>

</html>