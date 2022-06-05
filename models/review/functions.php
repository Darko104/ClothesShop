<?php

    function getProductReviews($productId) {
        return executeQuery("SELECT * FROM product_review WHERE product_id = $productId");
    }
    function getReviewsPerUser($userId) {
        return executeQuery("SELECT * FROM product_review WHERE user_id = $userId");
    }
    function getAverageRatingPerProduct($productId) {
        $average = executeQuery("SELECT AVG(rating) AS averageRating FROM product_review WHERE product_id = $productId", true);
        return round($average->averageRating);
    }
    function writeStars($rating) {
        if ($rating == 0) {
            echo "Product not rated";
        }
        else {
            for($i = 0; $i < $rating; $i++) {
                echo "<i class='fa-solid fa-star rating-star'></i>";
            }
            for($i = 0; $i < 5 - $rating; $i++) {
                echo "<i class='far fa-star rating-star'></i>";
            }
        }
    }