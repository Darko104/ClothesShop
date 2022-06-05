<?php
    session_start();
    require_once "../../config/connection.php";
    require_once "../basic/functions.php";

    if(isset($_POST['submit-review'])){
        $url = $_POST["query"];

        $productId = $_POST["productId"];
        $nickname = $_POST["review-nickname"];
        $summary = $_POST["review-summary"];
        $review = $_POST["review-review"];
        $rating = $_POST["review-rating"];

        $regexNickname = '/^[A-z0-9_]{2,80}$/';
        $regexSummary = '/^[\w\s?!.,:"\'@]{3,100}$/';
        $regexReview = '/^[\w\s?!.,:"\'@]{3,200}$/';
        $regexRating = '/^[12345]$/';

        $errors = [];

        checkRegexWriteMessage($nickname, $regexNickname, "Nickname can only contain letters, numbers and '_' character. Minimum length is 2 and maximum is 80.", $errors, "review-nickname");
        checkRegexWriteMessage($summary, $regexSummary, "Review summary can only contain letters, numbers and certain special characters: ?!.,:\"'@. Minimum length is 3 and maximum 100.", $errors, "review-summary");
        checkRegexWriteMessage($review, $regexReview, "Review can only contain letters, numbers and certain special characters: ?!.,:\"'@. Minimum length is 3 and maximum 200.", $errors, "review-review");
        checkRegexWriteMessage($rating, $regexRating, "Plase, use rating system as intended.", $errors, "review-rating");

        // Is user authenticated
        $userId = null;
        if (isset($_SESSION["logged_user"])) {
            $userId = $_SESSION["logged_user"]->id;
        }

        if (count($errors) > 0) {
            $_SESSION["errors"] = $errors;
            header("Location: ".$url."#add-review");
        }
        else {
            try {
                $conn->beginTransaction();
                $query = "INSERT INTO product_review (user_id, nickname, summary, review, rating, product_id) VALUES (:user_id, :nickname, :summary, :review, :rating, :product_id)";
                $stsm = $conn->prepare($query);
                $stsm->bindParam(":nickname", $nickname);
                $stsm->bindParam(":summary", $summary);
                $stsm->bindParam(":review", $review);
                $stsm->bindParam(":rating", $rating);
                $stsm->bindParam(":product_id", $productId);
                $stsm->bindParam(":user_id", $userId);
                $stsm->execute();

                $conn->commit();
                $_SESSION["review_info"] = ["success-form", "You have submited your review!"];
                header("Location: ".$url."#add-review");
            }
            catch(PDOException $exception) {
                $conn->rollback();
                $_SESSION["review_info"] = ["error-form", "Error adding your review."];
                header("Location: ".$url."#add-review");
            }
        }
    }
    else {
        http_response_code(404);
    }