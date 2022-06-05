<?php
    header("Content-type: application/json");
    session_start();

    if( isset($_POST["collection"]) ){
        include "../../config/connection.php";
        include "functions.php";
        include "../cart/functions.php";

        $collection = $_POST["collection"];

        if ($collection == "all") {
            $products = getFeaturedProducts();

            $response = new stdClass();
            $response->{"products"} = $products;
            $response->{"productIdsInCart"} = getProductIdValuesInCart();
            echo json_encode($response);
            http_response_code(200);
        }
        else {
            $stsmProducts = $conn->prepare("SELECT *, p.id AS productId, p.name AS productName, i.name AS imageName, cat.id AS categoryId, col.id AS collectionId, b.id AS brandId, b.name AS brandName, pp.current_price AS productPrice FROM product p INNER JOIN product_image pri ON p.id = pri.product_id INNER JOIN image i ON i.id = pri.image_id INNER JOIN category cat ON cat.id = p.category_id LEFT JOIN collection col ON col.id = p.collection_id INNER JOIN brand b ON p.brand_id = b.id INNER JOIN product_price pp ON p.id = pp.product_id INNER JOIN product_featured pf ON pf.product_id = p.id WHERE pri.main = 1 AND col.id = :collection LIMIT 5");
            $stsmProducts->bindParam(":collection", $collection);

            try {
                $stsmProducts->execute();
                $products = $stsmProducts->fetchAll();

                $response = new stdClass();
                $response->{"products"} = $products;
                $response->{"productIdsInCart"} = getProductIdValuesInCart();

                echo json_encode($response);
                http_response_code(200);
            }
            catch(PDOException $exception) {
                echo json_encode(['error', 'Database error: ' . $exception->getMessage()]);
                http_response_code(500);
            }

        }
    }
    else {
        http_response_code(404);
    }