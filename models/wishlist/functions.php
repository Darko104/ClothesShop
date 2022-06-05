<?php
    function getAllWishlistItems($userId) {
        return executeQuery("SELECT *, p.id AS productId, p.name AS productName, pp.current_price AS productPrice, i.name AS imageName, b.id AS brandId, b.name AS brandName FROM product p INNER JOIN product_image pri ON p.id = pri.product_id INNER JOIN product_price pp ON p.id = pp.product_id INNER JOIN image i ON i.id = pri.image_id INNER JOIN brand b ON p.brand_id = b.id INNER JOIN wishlist w ON w.product_id = p.id WHERE pri.main = 1 AND user_id = $userId");
    }
    function isProductInWishlist($userId, $productId) {
        $idRegex = '/^\d+$/';
        $exists = 2; // Regex match failed
        if( preg_match($idRegex, $productId) ) {
            $productInWishList = executeQuery("SELECT * FROM wishlist WHERE product_id = $productId AND user_id LIKE $userId", true);
            
            if($productInWishList) $exists = 1; // Exists
            else $exists = 0; // Doesn't exist
        }
        return $exists;
    }