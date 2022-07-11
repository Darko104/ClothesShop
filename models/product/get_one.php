<?php
    header("Content-type: application/json");
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../../config/connection.php";
        include "functions.php";
        include "../wishlist/functions.php";
        include "../cart/functions.php";
        include "../review/functions.php";

        $id = $_POST["id"];
        
        $isProductInWishlist = 0;
        if ( isset($_SESSION["logged_user"]) ) {
            $userId = $_SESSION["logged_user"]->id;
            $isProductInWishlist = isProductInWishlist($userId, $id);
        }

        $stsmProduct = $conn->prepare("SELECT *, p.id AS productId, p.name AS productName, b.id AS brandId, b.name AS brandName, c.name AS categoryName FROM product p INNER JOIN brand b ON p.brand_id = b.id INNER JOIN product_price pp ON p.id = pp.product_id INNER JOIN category c ON p.category_id = c.id WHERE p.id = :id");
        $stsmProduct->bindParam(":id", $id);

        $images = getProductImages($id);

        // Is product in cart
        $inCart = false;
        $cartProductIds = getProductIdValuesInCart();
        if ( in_array($id, $cartProductIds) ) $inCart = true;

        // Average rating
        $rating = getAverageRatingPerProduct($id);

        try {
            $stsmProduct->execute();
            //$stsmImages->execute();

            $product = $stsmProduct->fetch();
            //$productImages = $stsmImages->fetchAll();

            $product->{"images"} = $images;
            $product->{"isWishlist"} = $isProductInWishlist;
            $product->{"inCart"} = $inCart;
            $product->{"rating"} = $rating;

            echo json_encode($product);
            http_response_code(200);
        }
        catch(PDOException $exception) {
            echo json_encode(['error', 'Database error: ' . $exception->getMessage()]);
            http_response_code(500);
        }
    }
    else{
        http_response_code(404);
    }
?>
