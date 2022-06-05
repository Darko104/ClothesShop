<?php
    session_start();
    require_once "../../config/connection.php";
    require_once "../basic/functions.php";
    
    if(isset($_POST['submit-experience'])){
        $userId = $_SESSION["logged_user"]->id;
        $nickname = $_POST["experience-nickname"];
        $title = $_POST["experience-summary"];
        $review = $_POST["experience-review"];

        $regexNickname = '/^[A-z0-9_]{1,80}$/';
        $regexTitle = '/^[\w\s?!.,:"\'@]{3,100}$/';
        $regexReview = '/^[\w\s?!.,:"\'@]{3,200}$/';

        $errors = [];

        checkRegexWriteMessage($nickname, $regexNickname, "Nickname can only contain letters, numbers and '_' character. Minimum length is 2 and maximum is 80.", $errors, "experience-nickname");
        checkRegexWriteMessage($title, $regexTitle, "Title can only contain letters, numbers and certain special characters: ?!.,:\"'@. Minimum length is 3 and maximum 100.", $errors, "experience-title");
        checkRegexWriteMessage($review, $regexReview, "Review can only contain letters, numbers and certain special characters: ?!.,:\"'@. Minimum length is 3 and maximum 200.", $errors, "experience-review");

        if (count($errors) > 0) {
            $_SESSION["errors"] = $errors;
            header("Location: ../../index.php?page=account&view=user-rate-service");
        }
        else {
            try {
                $conn->beginTransaction();
                $query = "INSERT INTO experience_review (user_id, nickname, title, review) VALUES (:user_id, :nickname, :title, :review)";
                $stsm = $conn->prepare($query);
                $stsm->bindParam(":user_id", $userId);
                $stsm->bindParam(":nickname", $nickname);
                $stsm->bindParam(":title", $title);
                $stsm->bindParam(":review", $review);
                $stsm->execute();

                $conn->commit();
                $_SESSION["review_info"] = ["success-form", "You have submited your experience!"];
                header("Location: ../../index.php?page=account&view=user-rate-service");
            }
            catch(PDOException $exception) {
                $conn->rollback();
                $_SESSION["review_info"] = ["error-form", "Error adding your experience."];
                header("Location: ../../index.php?page=account&view=user-rate-service");
            }
        }
    }
    else {
        http_response_code(404);
    }