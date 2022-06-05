<?php
    ob_start();
    session_start();
    require_once "../../config/connection.php";
    require_once "../basic/functions.php";
    require_once "../product/functions.php";
    require_once "../images/functions.php";

    if(isset($_POST['submit-product'])) {
        $name = $_POST["add-name"];
        $category = $_POST["add-category"];
        $collection = $_POST["add-collection"];
        $price = $_POST["add-price"];
        $brand = $_POST["add-brand"];

        $regexName = '/^[A-z0-9\s.\/]{3,100}$/';
        $regexCategory = '/^\d+$/';
        $regexCollection = '/^\d+$/';
        $regexPrice = '/^\d+$/';
        $regexBrand = '/^\d+$/';

        $errors = [];

        checkRegexWriteMessage($name, $regexName, "Product name can only contain letters, numbers, spaces and '/' and '.' special characters, between 3 and 100 characters in length.", $errors, "add-name");
        checkRegexWriteMessage($category, $regexCategory, "Please, select one of the options in dropdown menu.", $errors, "add-category");
        checkRegexWriteMessage($collection, $regexCollection, "Please, select one of the options in dropdown menu.", $errors, "add-collection");
        checkRegexWriteMessage($price, $regexPrice, "Please, enter a numeric value.", $errors, "add-price");
        checkRegexWriteMessage($brand, $regexBrand, "Please, select one of the options in dropdown menu.", $errors, "add-brand");

        if (isset($_FILES['images'])) {
            $imageTypes = array(
                'image/png',
                'image/gif',
                'image/jpeg');

            for($i = 0; $i < count($_FILES['images']['name']); $i++) {
                $filename = $_FILES['images']['name'][$i];
                $tmpName = $_FILES['images']['tmp_name'][$i];
                $fileSize = $_FILES['images']['size'][$i];  //50000000
                $fileType = $_FILES['images']['type'][$i];
    
                if ($fileSize > 50000000 || !in_array($fileType, $imageTypes)) {
                    $errors[] = ["Image type must be png, gif or jpg/jpeg and less than 50 MB in size.", "add-images-info"];
                    break;
                }
    
                if ( count($errors) == 0 ) {
                    // Resize image for thumbnail and upload it
                    $newSize = 445;
                    
                    list($width, $height) = getimagesize($tmpName);
    
                    $thumb = imagecreatetruecolor($newSize, $newSize);
                    switch ($fileType) {
                        case "image/gif":
                            $source = imagecreatefromgif($tmpName);
                            break;
                        case "image/jpeg":
                            $source = imagecreatefromjpeg($tmpName);
                            break;
                        case "image/png":
                            $source = imagecreatefrompng($tmpName);
                            break;
                    }
    
                    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newSize, $newSize, $width, $height);
    
                    // Upload thumbnail
                    $filePath = "../../assets/images/";
                    imagejpeg($thumb, $filePath."thumbnail"."_$filename");
                    
                    // Upload original
                    move_uploaded_file($tmpName, $filePath."original"."_$filename");
                }
            }
        }
        else {
            $errors[] = ["Please upload images for this product.", "add-images-info"];
        }

        // Error check
        if (count($errors) > 0) {
            $_SESSION["errors"] = $errors;

            header("Location: ../../index.php?page=account&view=panel-add");
        }
        // Insert product into database
        else {
            try {
                $conn->beginTransaction();
                $query = "INSERT INTO product (name, category_id, collection_id, brand_id, units_sold) VALUES (:name, :category_id, :collection_id, :brand_id, 0)";
                $stsm = $conn->prepare($query);
                $stsm->bindParam(":name", $name);
                $stsm->bindParam(":category_id", $category);
                $stsm->bindParam(":collection_id", $collection);
                $stsm->bindParam(":brand_id", $brand);
                $stsm->execute();

                $conn->commit();
                $wasProductInserted = true;
            }
            catch(PDOException $exception) {
                $conn->rollback();
                $wasProductInserted = false;
                http_response_code(500);
            }
            // Inserting products price
            if ($wasProductInserted) {
                try {
                    $productId = getLastInsertedProduct()->id;

                    $conn->beginTransaction();
                    $query = "INSERT INTO product_price (product_id, current_price, old_price) VALUES (:product_id, :current_price, NULL)";
                    $stsm = $conn->prepare($query);
                    $stsm->bindParam(":product_id", $productId);
                    $stsm->bindParam(":current_price", $price);
                    //$stsm->bindParam(":old_price", NULL);
                    $stsm->execute();
    
                    $conn->commit();
                    $wasPriceInserted = true;
                }
                catch(PDOException $exception) {
                    $conn->rollback();
                    $wasPriceInserted = false;
                    http_response_code(500);
                }
            }
            // Insert images
            if ($wasPriceInserted) {
                try {
                    $conn->beginTransaction();

                    for($i = 0; $i < count($_FILES['images']['name']); $i++) {
                        $filename = $_FILES['images']['name'][$i];
                        $originalName = "original"."_$filename";
                        $thumbnailName = "thumbnail"."_$filename";

                        // Upload images
                        $query = "INSERT INTO image (name, image_type_id) VALUES (:name, 1), (:name2, 2)";
                        $stsm = $conn->prepare($query);
                        $stsm->bindParam(":name", $originalName);
                        $stsm->bindParam(":name2", $thumbnailName);
                        $stsm->execute();

                    }
                    $conn->commit();

                    $limitForRetrievedImages = count($_FILES['images']['name']) * 2;
                    $insertedImagesIds = getLastInsertedImages($limitForRetrievedImages);
                    $insertedImagesIds = array_reverse($insertedImagesIds);
                    $wereImagesInserted = true;
                }
                catch(PDOException $exception) {
                    $wereImagesInserted = false;
                    $conn->rollback();
                    http_response_code(500);
                }
            }
            // Connect images with products. First image is main (both original and thumbnail versions).
            if ($wereImagesInserted) {
                try {
                    $conn->beginTransaction();

                    for($i = 0; $i < count($insertedImagesIds); $i++) {
                        $imageId = $insertedImagesIds[$i]->id;
                        if ($i == 0 || $i == 1) $main = 1;
                        else $main = 0;

                        $query = "INSERT INTO product_image (product_id, image_id, main) VALUES (:product_id, :image_id, :main);";
                        $stsm = $conn->prepare($query);
                        $stsm->bindParam(":product_id", $productId);
                        $stsm->bindParam(":image_id", $imageId);
                        $stsm->bindParam(":main", $main);
                        $stsm->execute();
                    }

                    $conn->commit();
                    $_SESSION["review_info"] = ["success-form", "You have submited new product!"];
                    header("Location: ../../index.php?page=account&view=panel-add");
                    exit();
                }
                catch(PDOException $exception) {
                    //echo $exception->getMessage();
                    $conn->rollback();
                    $_SESSION["review_info"] = ["error-form", "Error adding product."];
                    header("Location: ../../index.php?page=account&view=panel-add");
                }
            }
        }
    }
    else {
        http_response_code(404);
    }