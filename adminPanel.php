<?php 
    include 'main.php';
    $currentPage = 'adminpanel';
    checkLoggedIn($con);
    $stmt = $con->prepare('SELECT adminLevel FROM accounts WHERE id = ?');
    $stmt->bindParam(1, $_SESSION['id']);
    $stmt->execute();
    $adminLevel = $stmt->fetch();
    if (intval($adminLevel) == 1) {
    }
    else {
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
</head>
<body>
    <?php include 'nav.php'; ?>
    <main id="header" class="d-flex my-5 flex-wrap">
        <div class="border rounded p-5 col-4 m-3 shadow" id="adminProducts">
            <h5>Products</h5>
            <div>
                <p class="m-0 mt-2">Add new product</p>
                <button class="addProductBtn">Add</button>
            </div>
            <div>
                <p class="m-0 mt-2">Manage products</p>
                <button class="manageProductsBtn">Manage</button>
            </div>
            <div>
                <p class="m-0 mt-2">Manage product showcase</p>
                <button>Manage</button>
            </div>
        </div>
        <div class="border rounded p-5 col-3 m-3 shadow" id="adminOrders">
            <h5>Orders</h5>
            <div>
                <p class="m-0 mt-2">View orders</p>
                <button>View</button>
            </div>
            <div>
                <p class="m-0 mt-2">Manage orders</p>
                <button>Manage</button>
            </div>
        </div>
        <div class="border rounded p-5 col-2 m-3 shadow" id="adminAccounts">
            <h5>Accounts</h5>
            <div>
                <p class="m-0 mt-2">View Accounts</p>
                <button>View</button>
            </div>
            <div>
                <p class="m-0 mt-2">Manage accounts</p>
                <button>Manage</button>
            </div>
        </div> 
        <div class="border rounded p-5 col-2 m-3 shadow" id="adminCategories">
            <h5>Categories</h5>
            <div>
                <p class="m-0 mt-2">Add categories</p>
                <button class="addCategoriesBtn">Add</button>
            </div>
            <div>
                <p class="m-0 mt-2">Manage categories</p>
                <button class="manageCategoriesBtn">Manage</button>
            </div>
        </div>
        <div class="border rounded p-5 col-3 m-3 shadow" id="adminApiKey">
            <h5>Api Keys</h5>
            <div>
                <p class="m-0 mt-2">Generate new key</p>
                <button class="addApiKeyBtn">Generate</button>
            </div>
            <div>
                <p class="m-0 mt-2">Manage keys</p>
                <button class="manageApiKeyBtn">Manage</button>
            </div>
            <div>
                <p class="m-0 mt-2">Toggle api lock</p>
                <button class="toggleApiKeyBtn">Toggle</button>
            </div>
        </div>
    </main>
    <script src="adminJs/manageApiKeys.js"></script>
    <script src="adminJs/addApi.js"></script>
    <script src="adminJs/manageProducts.js"></script>
    <script src="adminJs/addProduct.js"></script>
    <script src="adminJs/manageCategories.js"></script>
    <script src="adminJs/addCategories.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/myScript.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>