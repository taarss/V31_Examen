<?php 
    include 'main.php';
    $currentPage = 'products';
    if(!isset($_GET['category']))
    {
        header('Location: products.php?category=0');
    }
    $currentCategory = $_GET['category'];
    $stmt = $con->prepare('SELECT * FROM categories');
	$stmt->execute();
	$categories = $stmt->fetchAll();

    $products;
    if ($currentCategory != "0") {
        $stmt = $con->prepare('SELECT * FROM products WHERE type = ?');
        $stmt->bindParam(1, $currentCategory);
        $stmt->execute();
        $products = $stmt->fetchAll();
    }
    else {
        $stmt = $con->prepare('SELECT * FROM products');
        $stmt->execute();
        $products = $stmt->fetchAll();
    }
    if (isset($_GET['gender'])) {
        $products = array_filter($products, "filterByGender");
    }
    function filterByGender($productArray)
    {
        if ($productArray['sex'] == $_GET['gender']) {
            return $productArray;
        }
    }

    if (isset($_POST['newPage'])) {
        $newCategory = $_POST['newCategory'];
        header("Location: https://christianvillads.tech/opgaver/webShop/products.php?category=$newCategory");  
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
</head>

<body>
   <?php     include 'nav.php';?>
    <main class="d-flex justify-content-center">
        <div class="col-9 pt-5 mt-5" style="background-color: ghostWhite; min-height: 100vh">
        <div class="products">
            <div class="inspiration">
                <div class="catMen">
                    <img src="img/kategoriHerre.jpg" alt="">
                    <h5>Herretøj</h5>
                    <div class="action"><a href="#" class="genderMale">Se mere</a></div>
                </div>
                <div class="catWomen">
                    <img src="img/kategoriKvinde.jpg" alt="">
                    <h5>Kvindetøj</h5>
                    <div class="action"><a href="#" class="genderFemale">Se mere</a></div>
                </div>
                <div class="catWomen">
                    <img src="img/unisex.jpeg" alt="">
                    <h5>Unisex</h5>
                    <div class="action"><a href="#" class="genderUnisex">Se mere</a></div>
                </div>
            </div>
        </div>
        
            <div class="border-bottom d-flex justify-content-end">
                    <select class="productPageSearch mr-5 mb-3">
                        <option selected="selected" value=0>All Categories</option>
                    </select>
                </div>
                <div class="d-flex flex-wrap mt-5">
                    <?php foreach ($products as $key) {?>   
                        <div class="col-3 d-block ">
                            <div class="card mb-2 productPageContainer">
                                    <a href="product.php?id=<?=$key['id']?>">
                                        <img class="card-img-top productImg" src="<?=$key['img']?>" alt="Card image cap">
                                    </a>
                                    <div class="card-body">
                                        <h4 class="card-title"><?=$key['name']?></h4>
                                        <p class="card-text"><?=$key['price']?>.00$</p>
                                        <a class="btn" id="addToCart" style="background-color: #333; color: white" href="#">Add to cart</a>
                                    </div>
                            </div>
                        </div>      
                   <?php }?>
                </div>
            </div>
    </main>
    
    <footer>

    </footer>
    <script src="js/productPage.js"></script>
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
						$(".loginmsg").text(data);
					}
				}
			});
		});
    </script>
    
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')
    </script>
    <script src="js/plugins.js"></script>
    <script>
      $(".register form").submit(function (event) {
        event.preventDefault();
        var form = $(this);
        var url = form.attr("action");
        $.ajax({
          type: "POST",
          url: url,
          data: form.serialize(),
          success: function (data) {
            $(".registermsg").text(data);
          },
        });
      });
    </script>
        <script src="js/myScript.js"></script>
</body>

</html>