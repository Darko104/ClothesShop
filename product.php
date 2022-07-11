<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    require_once "config/connection.php";

    include "views/fixed/head.php";
    require_once "config/connection.php";
    include "models/basic/functions.php";
    include "models/user/functions.php";
    include "models/product/functions.php";
    include "models/cart/functions.php";
    include "models/wishlist/functions.php";
    include "models/review/functions.php";

    if ( !isset($_GET["productId"]) ) :
        header("Location: shop.php");
    else:
        $product = getProductById($_GET["productId"]);
        $productImages = getProductImages($_GET["productId"]);

        // All product Id values in cart
        $productsInCartIdValues = getProductIdValuesInCart();
        if ( in_array($product->productId, $productsInCartIdValues) ) {
            $mainButtonClasses = "in-cart";
            $mainButtonText = "Item in cart";
        }
        else {
            $mainButtonClasses = "cart-custom-qty";
            $mainButtonText = "Add to cart";
        }

        // Is product in wishlist
        if ( isset($_SESSION["logged_user"]) ) {
            $userId = $_SESSION["logged_user"]->id;
            $isProductInWishlist = isProductInWishlist($userId, $product->productId);
        }
        else $isProductInWishlist = 0;

        // Product reviews
        $reviews = getProductReviews($_GET["productId"]);
        $numberOfReviews = count($reviews);

        $averageRating = getAverageRatingPerProduct($_GET["productId"]);
?>
<body>
<header>
    <?php include 'views/fixed/navigation.php' ?>
    <div id="current-page">
        <ul>
            <li>Home</li>
            <li><?=$product->productName;?></li>
        </ul>
    </div>
</header>
<main>
    <section id="full-page-product" class="specific-product">
        <div id="specific-product-images">
            <div id="specific-product-all-images">
                <?php 
                    for($i=0;$i < count($productImages);$i++):
                        if($i == 0):
                ?>
                    <img src="assets/images/<?=$productImages[$i]->name?>" class="aside-image aside-image-selected">
                <?php else: ?>
                    <img src="assets/images/<?=$productImages[$i]->name?>" class="aside-image">
                <?php endif; endfor; ?>
            </div>
            <div id="full-page-product-cover-image-wrapper">
                <img src="assets/images/<?=$product->imageName?>" id="full-page-product-cover-image" class="main-showcased-image">
            </div>
        </div>
        <div id="specific-product-info">
            <div id="specific-product-info-header">
                <h3 id="full-page-product-name" class="specific-product-name"><?=$product->productName?></h3>
                <div id="product-page-product-reviews" class="product-reviews">
                    <div class="rating-stars">
                        <?php writeStars($averageRating); ?>
                    </div>
                    <p class="product-reviews-count"><span><?=$numberOfReviews?></span>&nbsp;Review(s)</p>
                    <p class="add-review"><a href="#add-review">Add your review</a></p>
                </div>
                <p id="specific-product-price">$290.00</p>
            </div>
            <div id="specific-product-info-body">
                <div class="product-attributes">
                    <p class="product-attribute"><span class="pa-key">Availability:</span> <span id="product-stock-info">In stock</span></p>
                    <p id="product-code" class="product-attribute"><span class="pa-key">PID:</span> <span id="product-code-value"><?=$product->productId?></span></p>
                </div>
                <p id="product-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque assumenda blanditiis consequatur eius non!</p>
                <div id="product-finish-purchase">
                    <div class="product-quantity">
                        <input type="number" class="pq-input" value="1" max="15" data-id="<?=$product->productId?>">
                        <div class="product-quantity-change">
                            <i class="fas fa-chevron-up change-quantity" data-id="<?=$product->productId?>" data-page="product" data-direction="up"></i>
                            <i class="fas fa-chevron-down change-quantity" data-id="<?=$product->productId?>" data-page="product" data-direction="down"></i>
                        </div>
                    </div>
                    <button class="<?=$mainButtonClasses?>" data-id="<?=$product->productId?>"><?=$mainButtonText?></button>
                </div>
                <?php
                    if ($isProductInWishlist == 1):
                ?>

                <p id="specific-product-add-to-wishlist" class="remove-from-wishlist" data-id="<?=$product->productId?>" data-refresh="false"><i class="fa-solid fa-heart"></i><span>Remove from wishlist<span></p>

                <?php else: ?>

                <p id="specific-product-add-to-wishlist" class="add-to-wishlist" data-id="<?=$product->productId?>" data-refresh="true"><i class="fa-solid fa-heart"></i><span>Add to wishlist</span></p>

                <?php endif; ?>
            </div>
            <div id="specific-product-info-footer">
                <div class="product-attributes">
                    <p id="product-tags" class="product-attribute"><span class="pa-key">Categories:</span> <span class="footer-pa-value">Sport, Shop, Newest</span></p>
                    <p id="product-brands" class="product-attribute"><span class="pa-key">Brand:</span> <span class="footer-pa-value"><?=$product->brandName?></span></p>
                </div>
            </div>
        </div>
    </section>
    <section id="product-reviews-wrapper">
        <div class="section-title-wrapper">
            <h3 class="section-left-side-title">Reviews</h3>
        </div>
        <div id="reviews-all-add">
            <div id="all-reviews">
                <h4 class="review-title">Product reviews:</h4>
                <div id="reviews">
                    <?php
                        if (count($reviews) == 0):
                    ?>
                    <p class="items-not-found"><img src="assets/images/sad.svg" class="not-found-img">No reviews for this product found.</p>
                    <?php 
                        else:
                            foreach($reviews as $review):
                                $timestamp = strtotime($review->created_at);
                                $dateFormat = date("j/n/Y", $timestamp);
                    ?>
                    <div class="product-single-review">
                        <h5 class="product-review-header"><?=$review->summary?></h5>
                        <p class="product-review-comment"><?=$review->review?></p>
                        <div class="product-review-info">
                            <p class="product-review-user">Review by <span><?=$review->nickname?></span></p>
                            <p class="product-review-date">Posted on <span><?=$dateFormat?></span></p>
                        </div>
                        <div class="product-review-rating">
                            <p>Rating:&nbsp;</p>
                            <div class="rating-stars">
                                <?php writeStars($review->rating); ?>
                            </div>
                        </div>
                    </div>
                    <?php  endforeach; endif; ?>
                </div>
            </div>
            <div id="add-review">
                <h4 class="review-title">Add a review:</h4>
                <form action="models/review/insert.php" method="post" onsubmit="return review.validate()">
                    <div class="form-field">
                        <label for="review-nickname" class="form-field-title">Nickname <span class="required-field">*</span></label>
                        <input type="text" id="review-nickname" name="review-nickname" class="basic-input" value="<?=getUserAttribute("first_name");?>">
                        <p id="review-nickname-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                        <?php
                            writeErrorInFormField("review-nickname");
                        ?>
                    </div>
                    <div class="form-field">
                        <label for="review-summary" class="form-field-title">Summary <span class="required-field">*</span></label>
                        <input type="text" id="review-summary" name="review-summary" class="basic-input">
                        <p id="review-summary-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                        <?php
                            writeErrorInFormField("review-summary");
                        ?>
                    </div>
                    <div class="form-field">
                        <label for="review-review" class="form-field-title">Review <span class="required-field">*</span></label>
                        <textarea id="review-review" name="review-review" rows="4"></textarea>
                        <p id="review-review-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                        <?php
                            writeErrorInFormField("review-review");
                        ?>
                    </div>
                    <div id="rate-product">
                        <p>Rate this product:</p>
                        <div class="rating-stars">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                            <i class="far fa-star rating-star send-rate-star" data-serial="<?=$i?>"></i>
                            <?php endfor; ?>
                        </div>
                        <p id="review-rating-info" class="form-error"><svg viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#cf454a" d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg><span>Incorrect</span></p>
                        <?php
                            writeErrorInFormField("review-rating");
                        ?>
                    </div>
                    <input type="hidden" name="review-rating" id="review-rating" value="">
                    <input type="hidden" name="productId" value="<?=$product->productId?>">
                    <input type="hidden" name="query" value="<?=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']?>">
                    <button type="submit" id="submit-review" name="submit-review">Submit review</button>
                    <?php unset($_SESSION["errors"]); ?>
                </form>
                <?php if( isset($_SESSION["review_info"]) ): 
                    $elementId = $_SESSION["review_info"][0];
                    $elementText = $_SESSION["review_info"][1];
                ?>
                <div id="<?=$elementId?>" class="form-alert">
                    <p><?=$elementText?></p>
                </div>
                <?php endif; unset( $_SESSION["review_info"] ); ?>
            </div>
        </div>
    </section>
    <section>
        <div class="section-title-wrapper">
            <h3 class="section-left-side-title">Related products</h3>
        </div>
        <div class="home-products-track">
            <?php 
                $relatedProducts = getRelatedProducts($_GET["productId"], 5);
                // Max amount of shown products is 5
                $maxAmount = 5;
                if(count($relatedProducts) < $maxAmount) $maxAmount = count($relatedProducts);

                for($i = 0; $i < $maxAmount; $i++):
                // Is product in cart
                $relProClasses = "cart-default-qty";
                $relProText = "Add to cart";
                if ( in_array($relatedProducts[$i]->productId, $productsInCartIdValues) ) {
                    $relProClasses = "in-cart";
                    $relProText = "Item in cart";
                }
            ?>
            <article class="product-card">
                <a href="product.php?productId=<?=$relatedProducts[$i]->productId?>"><img src="assets/images/<?=$relatedProducts[$i]->imageName?>"></a>
                <div class="product-card-info">
                    <p class="product-card-name">
                        <a href="product.php?productId=<?=$relatedProducts[$i]->productId?>"><?=cropString($relatedProducts[$i]->productName, 33);?></a>
                    </p>
                    <p class="product-card-brand"><?=$relatedProducts[$i]->brandName?></p>
                    <p class="product-card-price">
                    <?php if($relatedProducts[$i]->old_price != null): ?>
                    <span class="current-price" style="color:#cc1414;">$<?=$relatedProducts[$i]->current_price?></span>
                    <span class="old-price">$<?=$relatedProducts[$i]->old_price?></span>
                    <?php else: ?>
                    <span class="current-price">$<?=$relatedProducts[$i]->current_price?></span>
                    <?php endif; ?>
                    </p>
                </div>
                <div class="product-card-action">
                    <button class="main-action-button invisible-button <?=$relProClasses?>" data-id="<?=$relatedProducts[$i]->productId?>"><?=$relProText?></button>
                </div>
            </article>
            <?php endfor; ?>
        </div>
    </section>
    <section class="full-page-cover">
        <?php include "views/fixed/aside_menu.php"; ?>
    </section>
</main>
<?php endif; include "views/fixed/scripts.php"; ?>
</body>
</html>