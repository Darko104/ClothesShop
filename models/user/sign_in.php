<?php
    require_once "../../config/connection.php";
    require_once "functions.php";
    require_once "../basic/functions.php";
    session_start();

    if(isset($_POST['finish-sign-in'])) {
        $email = $_POST["sign-in-email"];
        $password = $_POST["sign-in-password"];

        $regexEmail = '/^[a-z\d\_\.\-]+\@[a-z\d]+(\.[a-z]{2,4})+$/';
        $regexPassword = ['/^.{4,50}$/', '/[a-z]|[A-Z]/', '/[0-9]/'];

        $errors = [];

        checkRegexWriteMessage($email, $regexEmail, "Icorrect email form. Example: name.surname@email.com", $errors, "sign-in-email");
        checkRegexWriteMessage($password, $regexPassword, "Password must contain between 4 and 50 characters with at least one letter and one number.", $errors, "sign-in-password");

        if (count($errors) > 0) {
            var_dump($errors);
            $_SESSION["errors"] = $errors;
            header("Location: ../../index.php?page=sign_in");
        }
        else {
            $password = md5($password);

            $query = "SELECT * FROM user WHERE email = :email AND password = :password";
            $stsm = $conn->prepare($query);
            $stsm->bindParam(":email", $email);
            $stsm->bindParam(":password", $password);
            $stsm->execute();

            $userValidation = $stsm->fetch();

            if ($userValidation) {
                $_SESSION['logged_user'] = $userValidation;
                header("Location: ../../index.php?page=account");
            }
            else {
                $errors[] = ["No user found with this username/email and matching passwords.", "sign-in-fail"];
                $_SESSION["errors"] = $errors;
                header("Location: ../../index.php?page=sign_in");
            }
        }
    }