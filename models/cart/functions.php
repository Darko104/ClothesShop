<?php

    function getCartItems() {
        if (!isset($_SESSION["logged_user"])) {
            $products = getCartItemsNoAuthentication();
        }
        else {
            $userId = $_SESSION["logged_user"]->id;
            $products = getItemsByUserId($userId);
        }
        return $products;
    }
    function getItemsByUserId($userId) {
        return executeQuery("SELECT *, p.id AS productId, p.name AS productName, i.name AS imageName FROM product p INNER JOIN product_image pri ON p.id = pri.product_id INNER JOIN image i ON i.id = pri.image_id INNER JOIN product_price pp ON p.id = pp.product_id INNER JOIN cart c ON p.id = c.product_id WHERE c.user_id = $userId AND pri.main = 1");
    }
    function getCartItemsNoAuthentication() {
        $cartCookie = getCookieValuesFromString();
        $products = [];
        foreach ($cartCookie as $cookie) {
            // One cart instance looks like: [2]=> string(5) "12,11"
            $cookie = explode(",", $cookie);
            $product = getProductById($cookie[0]);
            $quantity = $cookie[1];

            $product->quantity = $quantity;
            $products[] = $product;
        }
        return $products;
    }
    function getCookieValuesFromString () {
        if ( isset($_COOKIE["cart"]) ) {
            $cart = substr($_COOKIE["cart"], 1, -1);
            // Currently it might look like this example: [1,1],[11,5],[12,11]
            $cart = explode("[", $cart);
            // [0]=> string(0) "" [1]=> string(5) "1,1]," [2]=> string(6) "11,5]," [3]=> string(6) "12,11]"
            $cart = implode("", $cart);
            // 1,1],11,5],12,11]
            $cart = preg_split("/],|]/", $cart);
            // [0]=> string(3) "1,1" [1]=> string(4) "11,5" [2]=> string(5) "12,11" [3]=> string(0) ""
            array_pop($cart);
            // Last unneeded item is poped
            //[0]=> string(3) "1,1" [1]=> string(4) "11,5" [2]=> string(5) "12,11"
            $newArray = [];
            foreach($cart as $cartItem) {
                $cartItem = explode(",", $cartItem);
                $newArray[] = $cartItem;
            }
            // Array of arrays
            // array(2) { [0]=> string(1) "1" [1]=> string(1) "1" } array(2) { [0]=> string(2) "11" [1]=> string(1) "5" } array(2) { [0]=> string(2) "12" [1]=> string(2) "11" }

            return $cart;
        }
        else {
            return [];
        }
    }

    // Get id values of products that are inside a customers cart. This is so that program can look for products inside one specific array instead of searching them in database each time product elements are written in html.
    function getProductIdValuesInCart() {
        if ( !isset($_SESSION["logged_user"]) ) {
            return getItemIdValuesNoAuthentication();
        }
        else {
            return getItemIdValuesByUserId( $_SESSION["logged_user"]->id );
        }
    }
    function getItemIdValuesByUserId($userId) {
        $items = getItemsByUserId($userId);

        $IdValuesInCart = [];
        foreach ($items as $item) {
            $IdValuesInCart[] = $item->productId;
        }
        return $IdValuesInCart;
    }
    function getItemIdValuesNoAuthentication() {
        $cartCookie = getCookieValuesFromString();
        $idValues = [];
        foreach($cartCookie as $cookie) {
            $id = explode(",", $cookie)[0];
            $idValues[] = $id;
        }
        return $idValues;
    }

    function isProductInCart($userId, $id) {
        $idRegex = '/^\d+$/';
        $exists = 2; // Regex match failed
        if( preg_match($idRegex, $id) ) {
            $productInWishList = executeQuery("SELECT * FROM cart WHERE product_id = $id AND user_id LIKE $userId", true);
            
            if($productInWishList) $exists = 1; // Exists
            else $exists = 0; // Doesn't exist
        }
        return $exists;
    }
    function countItems($userId) {
        $num = executeQuery("SELECT COUNT(*) AS numberOfPr FROM cart WHERE user_id = $userId", true);
        return $num->numberOfPr;
    }
    function deleteAllInCartPerUser($userId) {
        executeQueryNoReturn("DELETE FROM cart WHERE user_id = $userId");
    }