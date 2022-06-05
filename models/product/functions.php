<?php

    function getAllProducts($orderBy, $orderType) {
        return executeQuery("SELECT *, p.id AS productId, p.name AS productName, i.name AS imageName, cat.id AS categoryId, col.id AS collectionId, b.id AS brandId, b.name AS brandName, pp.current_price AS productPrice FROM product p INNER JOIN product_image pri ON p.id = pri.product_id INNER JOIN image i ON i.id = pri.image_id INNER JOIN category cat ON cat.id = p.category_id LEFT JOIN collection col ON col.id = p.collection_id INNER JOIN brand b ON p.brand_id = b.id INNER JOIN product_price pp ON p.id = pp.product_id WHERE pri.main = 1 ORDER BY $orderBy $orderType");
    }
    function getProductById($id) {
        return executeQuery("SELECT *, p.id AS productId, p.name AS productName, i.name AS imageName, b.name AS brandName FROM product p INNER JOIN product_image pri ON p.id = pri.product_id INNER JOIN image i ON i.id = pri.image_id INNER JOIN product_price pp ON p.id = pp.product_id INNER JOIN brand b ON p.brand_id = b.id WHERE p.id = $id AND pri.main = 1", true);
    }
    function getLastInsertedProduct() {
        return executeQuery("SELECT id FROM product ORDER BY id DESC", true);
    }
    function getProductImages($productId) {
        return executeQuery("SELECT i.name FROM image i INNER JOIN product_image pri ON i.id = pri.image_id WHERE pri.product_id = $productId ORDER BY pri.main DESC");
    }
    function getProductCategories() {
        return executeQuery("SELECT c.id AS categoryId, c.name AS categoryName, count(*) AS categoryCount FROM category c INNER JOIN product p ON c.id = p.category_id GROUP by c.id");
    }
    function getProductCollections() {
        return executeQuery("SELECT c.id AS collectionId, c.name AS collectionName, count(*) AS collectionCount FROM collection c INNER JOIN product p ON c.id = p.collection_id GROUP by c.id");
    }
    function getProductBrands() {
        return executeQuery("SELECT b.id AS brandId, b.name AS brandName, count(*) AS brandCount FROM brand b INNER JOIN product p ON b.id = p.brand_id GROUP by b.id");
    }
    function getBrandByProduct($productId) {
        return executeQuery("SELECT b.id AS brandId FROM brand b INNER JOIN product p ON p.brand_id = b.id WHERE p.id = $productId", true);
    }
    function getPossibleProductAmounts() {
        return executeQuery("SELECT * FROM amount_products_shown ORDER BY amount ASC");
    }
    function getSortByOptions() {
        return executeQuery("SELECT * FROM sort_options ORDER BY id ASC");
    }
    function getHighestPrice() {
        $max = executeQuery("SELECT MAX(current_price) AS highestPrice FROM product_price", true);
        return $max->highestPrice;
    }
    // FeaturedProducts
    function getTopFeaturedProducts() {
        return executeQuery("SELECT *, p.id AS productId, p.name AS productName, b.name AS brandName FROM product_featured pf INNER JOIN product p ON pf.product_id = p.id INNER JOIN product_price pp ON pp.product_id = p.id INNER JOIN brand b ON p.brand_id = b.id ORDER BY pf.id ASC LIMIT 3");
    }
    function getFeaturedProducts() {
        return executeQuery("SELECT *, p.id AS productId, p.name AS productName, i.name AS imageName, cat.id AS categoryId, col.id AS collectionId, b.id AS brandId, b.name AS brandName, pp.current_price AS productPrice FROM product p INNER JOIN product_image pri ON p.id = pri.product_id INNER JOIN image i ON i.id = pri.image_id INNER JOIN category cat ON cat.id = p.category_id LEFT JOIN collection col ON col.id = p.collection_id INNER JOIN brand b ON p.brand_id = b.id INNER JOIN product_price pp ON p.id = pp.product_id INNER JOIN product_featured pf ON pf.product_id = p.id WHERE pri.main = 1 ORDER BY RAND() LIMIT 5");
    }
    // Top selling products
    function getTopSellingProducts() {
        return executeQuery("SELECT *, p.id AS productId, p.name AS productName, i.name AS imageName, cat.id AS categoryId, col.id AS collectionId, b.id AS brandId, b.name AS brandName, pp.current_price AS productPrice FROM product p INNER JOIN product_image pri ON p.id = pri.product_id INNER JOIN image i ON i.id = pri.image_id INNER JOIN category cat ON cat.id = p.category_id LEFT JOIN collection col ON col.id = p.collection_id INNER JOIN brand b ON p.brand_id = b.id INNER JOIN product_price pp ON p.id = pp.product_id INNER JOIN product_featured pf ON pf.product_id = p.id WHERE pri.main = 1 ORDER BY units_sold DESC LIMIT 5");
    }
    // Write filter parameter categories
    function writeFilterParameters($GETName, $allParameters, $idAliasKey, $labelNameKey, $countKey) {
        $IdsGET = [];
        if (isset($_GET[$GETName])) {
            $IdsGET = $_GET[$GETName];
        }

        foreach($allParameters as $parameter) {
            $html = "<input type='checkbox' name='".$GETName."[]' id='$GETName-".$parameter->{$idAliasKey}."' value='".$parameter->{$idAliasKey}."' class='parameter-select-field'";
            
            if (in_array($parameter->{$idAliasKey}, $IdsGET)) {
                $html .= "checked>";
            }
            else $html .= ">";

            $html .= "<label for='$GETName-".$parameter->{$idAliasKey}."' class='parameter-label'>
                        ".$parameter->{$labelNameKey}."
                        <span class='parameter-count'>(".$parameter->{$countKey}.")</span>
                    </label>";

            echo $html;
        }
    }
    // Pagination
    function validateAmountToShow($get, $numberOfProducts) {
        $availableAmounts = getPossibleProductAmounts();
        // If get is neither of available amounts than amount will be set to default value (12). This is done so that user doesn't enter too big or too small value like 1000.
        $isThereOneSame = false;
        foreach ($availableAmounts as $amount) {
            if($amount->amount == $get) {
                $isThereOneSame = true;
                $showAmount = $get;
            }
        }
        if ($isThereOneSame == false) {
            $showAmount = 12;
        }
        // If there are smaller number of products than the amount we want to view, we have to set view amount to that number so that errors don't occure.
        if($numberOfProducts < $showAmount) $showAmount = $numberOfProducts;

        return $showAmount;
    }
    function getPaginationValues($getParameters, $numberOfProducts, $showAmount) {
        // Calculating number of pages.
        $numberOfPages = ceil($numberOfProducts / $showAmount);

        // Current page. Value can't be larger that maximum number of pages or smaller than 0.
        if( !isset($getParameters["pagination"]) || $getParameters["pagination"] > $numberOfPages || $getParameters["pagination"] < 0) {
            $page = 0;
        }
        else $page = $getParameters["pagination"];

        // Pagination: Amount * page number --- Amount * page number + amount
        $startingPoint = $showAmount*$page;
        $endingPoint = $showAmount*$page+$showAmount;
        if ($endingPoint > $numberOfProducts) $endingPoint = $numberOfProducts;

        return [$page, $startingPoint, $endingPoint];
    }
    function rangeOfVisibleProducts($getParameters, $numberOfProducts) {
        if( !isset($getParameters["viewamount"]) ) {
            $showAmount = 12;
        }
        else {
            $showAmount = validateAmountToShow($getParameters["viewamount"], $numberOfProducts);
        }

        return $showAmount;
    }
    // Filtering
    function getAndFilterProducts($allGETParameters) {
        $products = getSortedProducts($allGETParameters);
        foreach($allGETParameters as $parameter => $array) {
            switch ($parameter) {
                case "category":
                    $products = filterByArray("categoryId", $array, $products);
                    break;
                case "collection":
                    $products = filterByArray("collectionId", $array, $products);
                    break;
                case "brand":
                    $products = filterByArray("brandId", $array, $products);
                    break;
                case "keyword":
                    $products = filterByKeyword($array, $products);
                    break;
                case "min-price":
                case "max-price":
                    $products = filterByPrice($products);
                    break;
            }
        }
        return $products;
    }
    function filterByKeyword($keyword, $products) {
        $keyword = strtolower($keyword);
        if ($keyword == null || $keyword == "") {
            return $products;
        }
        $filteredProducts = [];
        foreach($products as $product) {
            // If a keyword is similar or same as any of the words within a full name (maximum 2 letter difference), that product will be retrieved.
            $lowercaseProductName = strtolower($product->productName);
            $allwords = explode(" ", $lowercaseProductName);
            foreach($allwords as $word) {
                if (levenshtein($word, $keyword) <= 1) {
                    $filteredProducts[] = $product;
                    break;
                }
            }
        }

        return $filteredProducts;
    }
    function filterByArray($item, $array, $products) {
        $filteredProducts = [];

        foreach($products as $product) {
            if (in_array($product->{$item}, $array)) {
                $filteredProducts[] = $product;
            }
        }
        return $filteredProducts;
    }
    function filterByPrice($products) {
        $minPrice = trim($_GET["min-price"]);
        $maxPrice = trim($_GET["max-price"]);
        $regex = '/^[0-9]*$/';

        if ($minPrice == "" || !preg_match($regex, $minPrice)) $minPrice = 0;
        if ($maxPrice == "" || !preg_match($regex, $maxPrice)) $maxPrice = getHighestPrice();

        $filteredProducts = [];
        foreach($products as $product) {
            if ($product->current_price >= $minPrice && $product->current_price <= $maxPrice) {
                $filteredProducts[] = $product;
            }
        }
        return $filteredProducts;
    }
    // Sorting
    function getSortedProducts($allGETParameters) {
        $availableSortByOptions = ["productName", "productPrice"];
        $availableSortTypeOptions = ["asc", "desc"];

        $sortBy = assignSort($allGETParameters, "sort", $availableSortByOptions, "productName");
        $sortType = assignSort($allGETParameters, "sorttype", $availableSortTypeOptions, "asc");

        return getAllProducts($sortBy, $sortType);
    }
    function assignSort($getParameter, $GETKey, $allowedValues, $defaultValue) {
        if (isset($getParameter[$GETKey])) {
            // User can type only allowed values by which sorting will be done. This is to ensure that he doesn't add another SQL command that might be harmful.
            if (!in_array($getParameter[$GETKey], $allowedValues)) return $defaultValue;
            else {
                return $getParameter[$GETKey];
            }
        }
        // If get parameter is not set, than default value is assigned.
        else {
            return $defaultValue;
        }
    }
    // Related products
    function getRelatedProducts($productId) {
        $brand = getBrandByProduct($productId);
        
        if ($brand) {
            return executeQuery("SELECT *, p.id AS productId, p.name AS productName, i.name AS imageName, b.name AS brandName FROM product p INNER JOIN product_image pri ON p.id = pri.product_id INNER JOIN image i ON i.id = pri.image_id INNER JOIN product_price pp ON p.id = pp.product_id INNER JOIN brand b ON p.brand_id = b.id WHERE p.id != $productId AND pri.main = 1 AND b.id = $brand->brandId");
        }
        else return [];
    }