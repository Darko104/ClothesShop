<!DOCTYPE html>
<html lang="en">

<?php
    session_start();
    require_once "config/connection.php";
    include "models/basic/functions.php";
    include "models/product/functions.php";
    include "models/cart/functions.php";
    include "models/experience/functions.php";

    $currentPage = "Home";
    $featuredProducts = getTopFeaturedProducts();
    // All product Id values in cart
    $productsInCartIdValues = getProductIdValuesInCart();

    include "views/fixed/head.php";
?>
<body>
<header>
    <?php include 'views/fixed/navigation.php' ?>
    <div id="header-featured">
        <section id="header-featured-slider">
            <i class="fas fa-chevron-left next-product initial-carousel-arrow" data-direction="backward"></i>

            <div id="header-featured-product-info">
                <div id="header-product-basic">
                    <h2><?=$featuredProducts[0]->productName?></h2>
                    <p id="header-product-price">$ <?=$featuredProducts[0]->current_price?></p>
                </div>
                <p id="header-product-brand"><?=$featuredProducts[0]->brandName?></p>
                <a href="product.php?productId=<?=$featuredProducts[0]->productId?>" id="slider-buy">
                    <div id="header-product-buy">
                        <div id="header-product-buy-text">Buy now</div>
                        <div id="header-product-buy-icon"><i class="fas fa-shopping-cart"></i></div>
                    </div>
                </a>
            </div>

            <div id="header-carousel-image">
                <img src="assets/images/<?=$featuredProducts[0]->image?>">
                <div id="slider-shadow"></div>
            </div>

            <i class="fas fa-chevron-right next-product initial-carousel-arrow" data-direction="forward"></i>
            <div id="carousel-thin-arrows">
                <i class="fas fa-chevron-left next-product"></i>
                <i class="fas fa-chevron-right next-product"></i>
            </div>
        </section>

        <section id="header-featured-track-wrapper">
            <section id="header-featured-track">
                <?php for($i = 0; $i < count($featuredProducts); $i++):
                        $selected = "0";
                        if ($i == 0)  $selected = "1";
                ?>
                    <article class="header-featured-product" data-serial="<?=$i?>" data-productid="<?=$featuredProducts[$i]->productId?>" data-name="<?=$featuredProducts[$i]->productName?>" data-price="<?=$featuredProducts[$i]->current_price?>" data-brand="<?=$featuredProducts[$i]->brandName?>" data-image="<?=$featuredProducts[$i]->image?>">
                        <img src="assets/images/<?=$featuredProducts[$i]->image?>" class="header-featured-img">
                        <div class="header-featured-info">
                            <p class="header-featured-name"><?=$featuredProducts[$i]->productName?></p>
                            <p class="header-featured-price">$<?=$featuredProducts[$i]->current_price?></p>
                        </div>
                    </article>
                <?php endfor; ?>
            </section>
        </section>
    </div>
</header>
<main id="home-main">
    <section id="news-cards">
        <div class="promo-card" id="news-card-1">
            <a href="shop.php?brand%5B%5D=2">
                <div class="promo-card-text">
                    <p class="promo-card-title">Just do it. <img src="assets/images/nike-logo.png" id="nike-logo-small"></p>
                    <p class="promo-card-desc">Check out new <span>nike</span> products</p>
                </div>
                <div class="promo-card-overlay"></div>
            </a>
        </div>
        <div class="promo-card" id="news-card-2">
            <a href="shop.php?category%5B%5D=3">
                <div class="promo-card-text">
                    <p class="promo-card-title">Hello winter</p>
                    <p class="promo-card-desc">Our new <span>sweatshirt</span> collection</p>
                </div>
                <div class="promo-card-overlay"></div>
            </a>
        </div>
        <div class="promo-card" id="news-card-3">
            <a href="shop.php?category%5B%5D=1">
                <div class="promo-card-text">
                    <p class="promo-card-title">Now or never</p>
                    <p class="promo-card-desc">new sneakers, <span>check them out</span></p>
                </div>
                <div class="promo-card-overlay"></div>
            </a>
        </div>
    </section>
    <section class="products-list">
        <div class="section-title-wrapper">
            <h3 class="section-small-title"><span class="section-small-title-highlighted">Top featured</span> Products</h3>
            <div class="product-track-categories">
                <ul>
                    <li class="product-track-category product-track-category-active" data-collection="all">All products</li>
                    <li class="product-track-category" data-collection="2">Women's</li>
                    <li class="product-track-category" data-collection="1">Men's</li>
                    <li class="product-track-category" data-collection="3">Kids</li>
                </ul>
            </div>
        </div>
        <?php 
        ?>
        <div id="featured-products-track" class="home-products-track">
            <?php 
                $moreFeaturedProducts = getFeaturedProducts();

                foreach($moreFeaturedProducts as $product):
                    $mainButtonClasses = "cart-default-qty";
                    $mainButtonText = "Add to cart";
                    if ( in_array($product->productId, $productsInCartIdValues) ) {
                        $mainButtonClasses = "in-cart";
                        $mainButtonText = "Item in cart";
                    }
            ?>
            <article class="product-card">
                <a href="product.php?productId=<?=$product->productId?>"><img src="assets/images/<?=$product->imageName?>"></a>
                <div class="product-card-info">
                    <p class="product-card-name">
                        <a href="product.php?productId=<?=$product->productId?>"><?=cropString($product->productName, 33);?></a>    
                    </p>
                    <p class="product-card-brand"><?=$product->brandName?></p>
                    <p class="product-card-price">
                        <?php if($product->old_price != null): ?>
                        <span class="current-price" style="color:#cc1414;">$<?=$product->current_price?></span>
                        <span class="old-price">$<?=$product->old_price?></span>
                        <?php else: ?>
                        <span class="current-price">$<?=$product->current_price?></span>
                        <?php endif; ?>
                    </p>
                </div>
                <div class="product-card-action">
                    <button type="button" class="main-action-button <?=$mainButtonClasses?> invisible-button" data-id="<?=$product->productId?>"><?=$mainButtonText?></button>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </section>
    <section id="categories-grid-wrapper">
        <section id="categories-grids">
            <article id="grid-small-1">
                <a href="shop.php?category%5B%5D=1"><button class="grid-section-button">Sneakers</button></a>
            </article>
            <article id="grid-small-2">
                <a href="shop.php?category%5B%5D=1&category%5B%5D=4&collection%5B%5D=1&collection%5B%5D=2"><button class="grid-section-button">Running</button></a>
            </article>
            <article id="grid-big">
                <a href="shop.php?category%5B%5D=1&category%5B%5D=3&category%5B%5D=4&collection%5B%5D=1&collection%5B%5D=2"><button class="grid-section-button">Training</button></a>
            </article>
            <article id="grid-small-3">
                <a href="shop.php?min-price=&max-price=150&sort=productPrice&sorttype=asc">
                <button class="grid-section-button">Affordable</button></a>
            </article>
            <article id="grid-small-4">
                <a href="shop.php?category%5B%5D=5"><button class="grid-section-button">Accessories</button></a>
            </article>
        </section>
        <a href="shop.php"><button id="categories-grid-main-button" class="grid-section-button">View all products</button></a>
    </section>
    <div id="moving-letters">
        <div id="scrolling-text">
            <p>Brand new products</p>
            <p>More than 20% off</p>
            <p>Check out new accessories</p>
        </div>
    </div>
    <section class="products-list">
        <div class="section-title-wrapper">
            <h3 class="section-left-side-title">Top selling products</h3>
        </div>
        <div class="home-products-track">
            <?php 
                $topSellingProducts = getTopSellingProducts();

                foreach($topSellingProducts as $product):
                    $mainButtonClasses = "cart-default-qty";
                    $mainButtonText = "Add to cart";
                    if ( in_array($product->productId, $productsInCartIdValues) ) {
                        $mainButtonClasses = "in-cart";
                        $mainButtonText = "Item in cart";
                    }
            ?>
            <article class="product-card">
                <a href="product.php?productId=<?=$product->productId?>"><img src="assets/images/<?=$product->imageName?>"></a>
                <div class="product-card-info">
                    <p class="product-card-name">
                        <a href="product.php?productId=<?=$product->productId?>"><?=cropString($product->productName, 33);?></a>
                    </p>
                    <p class="product-card-brand"><?=$product->brandName?></p>
                    <p class="product-card-price">
                        <?php if($product->old_price != null): ?>
                        <span class="current-price" style="color:#cc1414;">$<?=$product->current_price?></span>
                        <span class="old-price">$<?=$product->old_price?></span>
                        <?php else: ?>
                        <span class="current-price">$<?=$product->current_price?></span>
                        <?php endif; ?>
                    </p>
                </div>
                <div class="product-card-action">
                    <button type="button" class="main-action-button <?=$mainButtonClasses?> invisible-button" data-id="<?=$product->productId?>"><?=$mainButtonText?></button>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </section>
    <section id="customer-opinions-wrapper">
        <div class="section-title-wrapper above-main-content">
            <h3 class="section-small-title"><span class="section-small-title-highlighted">Customer</span> reviews</h3>
        </div>
        <section id="customer-opinions">
            <div id="customer-feedbacks">
                <?php 
                    $customerExperiences = getAllExperiences();

                    foreach ($customerExperiences as $experience):
                ?>
                <div class="customer-feedback-card">
                    <div class="customer-feedback-header">
                        <div class="customer-name"><?=$experience->nickname?>:</div>
                        <div class="customer-occupation"><?=$experience->title?></div>
                    </div>
                    <p class="customer-comment">"<?=$experience->review?>"</p>
                </div>
                <?php endforeach; ?>
            </div>
            <div id="message-on-customers">
                <i class="far fa-thumbs-up"></i>
                <div id="message-about-customers">
                    Customers Are Satisfied<br>
                    With Our <span>Perfect & Friendly</span> Service
                </div>
                <button><a href="shop.php">Shop now</a></button>
            </div>
        </section>
    </section>
    <section class="full-page-cover">
        <?php include "views/fixed/aside_menu.php"; ?>
    </section>
</main>
<?php include "views/fixed/footer.php"; include "views/fixed/scripts.php"; ?>
</body>
</html>
<!-- <?php
    // if (!isset($_GET['page'])) {
    //     include "views/pages/home.php";
    // }
    // else {
    //     switch($_GET['page']) {
    //         case 'shop':
    //             include "views/pages/shop.php";
    //             break;
    //         case 'product':
    //             include "views/pages/product.php";
    //             break;
    //         case 'cart':
    //             include "views/pages/cart.php";
    //             break;
    //         case 'checkout':
    //             include "views/pages/checkout.php";
    //             break;
    //         case 'sign_in':
    //             include "views/pages/sign_in.php";
    //             break;
    //         case 'sign_up':
    //             include "views/pages/sign_up.php";
    //             break;
    //         case 'account':
    //             include "views/pages/account.php";
    //             break;
    //         case 'log_off':
    //             include "views/pages/log_off.php";
    //             break;
    //         case 'about':
    //             include "views/pages/about.php";
    //             break;
    //     }
    // }

    // include "views/fixed/scripts.php";
?> -->