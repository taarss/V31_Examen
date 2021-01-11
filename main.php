<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'christianvillads_techv31';
$DATABASE_PASS = 'Aspit12345';
$DATABASE_NAME = 'christianvillads_techv31';

$con;
try{
    $con = new PDO("mysql:host=$DATABASE_HOST;dbname=$DATABASE_NAME", $DATABASE_USER, $DATABASE_PASS);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}
// The below function will check if the user is logged-in and also check the remember me cookie
function checkLoggedIn($con)
{
    // You can add the remember me part below in all your files that require it (home, profile, etc).
    if (isset($_COOKIE['rememberme']) && !empty($_COOKIE['rememberme']) && !isset($_SESSION['loggedin'])) {
        // If the remember me cookie matches one in the database then we can update the session variables.
        $stmt = $con->prepare('SELECT id, username FROM accounts WHERE rememberme = ?');
        $stmt->bind_param('s', $_COOKIE['rememberme']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
        } else {
            // If the user is not logged in redirect to the login page.
            header('Location: index.php');
            exit;
        }
    } else if (!isset($_SESSION['loggedin'])) {
        // If the user is not logged in redirect to the login page.
        header('Location: index.php');
        exit;
    }
}