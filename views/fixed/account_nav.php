<?php 
        include "models/layout/navigation.php";
        $categories = getProductCategories();
        $collections = getProductCollections();
        $featuredProducts = getTopFeaturedProducts();
        $featuredAccessories = getAccessories();

        $brands = getProductBrands();

        $cartProducts = getCartItems();
        $numberOfProductsInCart = count($cartProducts);
?>
<nav>
    <div id="account-nav">
        <div id="account-nav-logo">
            <p id="navigation-logo" class="logo">clothes<span>shop</span></p>
        </div>
        <div id="account-nav-info">
            <p id="account-usertype-name"><span id="user-type"><?=getUserRole($_SESSION["logged_user"]->id, $conn);?> /</span><span id="user-name"><?=$_SESSION["logged_user"]->first_name." ".$_SESSION["logged_user"]->last_name?></span></p>
            <i id="nav-bar-open" class="fas fa-bars nav-bar"></i>
            <ul id="page-links">
                <?php if(isset($currentPage)) writeNavPageLinks($currentPage); else writeNavPageLinks(); ?>
            </ul>
            <ul id="action-links">
                <li id="action-user"><a href="#"><img src="assets/images/user.svg" class="nav-icon"></a>
                    <div id="nav-user-menu">
                        <div id="nav-arrow-logged-off" class="nav-menu-arrow"></div>
                        <div id="nav-user-menu-box">
                        <?php if(!isset( $_SESSION["logged_user"] )): ?>
                        <div id="nav-user-box-logged-off">
                            <ul class="nav-user-box-list">
                                <li><a href="sign_in.php">log in</a></li>
                                <li><a href="sign_up.php">register</a></li>
                            </ul>
                        </div>
                        <?php else: $user = $_SESSION["logged_user"]; ?>
                        <div id="nav-user-box-logged-in">
                            <div id="user-box-basic-info">
                                <p id="user-box-name"><?=$user->first_name?> <?=$user->last_name?></p>
                                <p id="user-box-email"><?=$user->email?></p>
                            </div>
                            <ul class="nav-user-box-list">
                                <?php 
                                    if ($user->privilege == 2):
                                ?>
                                <li><a href="account.php"><i class="fas fa-tasks"></i>&nbsp;settings/activity log</a></li>
                                <li><a href="account.php?view=user-orders"><i class="fas fa-dollar-sign"></i>&nbsp;orders</a></li>
                                <li><a href="account.php?view=user-wishlist"><i class="fas fa-heart"></i>&nbsp;wishlist</a></li>
                                <?php elseif($user->privilege == 1): ?>
                                <li><a href="account.php?view=panel-main"><i class="fa-solid fa-terminal"></i>&nbsp;main</a></li>
                                <li><a href="account.php?view=panel-stats"><i class="fa-solid fa-ranking-star"></i>&nbsp;page stats</a></li>
                                <li><a href="account.php?view=panel-products"><i class="fa-solid fa-box"></i>&nbsp;products</a></li>
                                <?php endif; ?>
                                <li id="user-box-log-off"><a href="models/user/log_off.php"><i class="fas fa-sign-out-alt"></i>&nbsp;log off</a></li>
                            </ul>
                        </div>
                        <?php endif; ?>
                    </div>
                    </div>
                </li>
                <li><a href="account.php?view=user-wishlist"><img src="assets/images/love.svg" class="nav-icon"></a></li>
                <li><a href="cart.php">
                    <img src="assets/images/shopping-bag.svg" class="nav-icon">
                    <p id="products-in-cart"><span><?=$numberOfProductsInCart?></span></p>
                </a></li>
            </ul>
        </div>
    </div>
    <div id="extended-navigation">
        <div id="extended-navigation-content">
            <div class="extended-nav-list">
                <p class="enl-title">Categories</p>
                <ul>
                    <?php foreach($categories as $category): ?>
                        <li><a href="shop.php?category%5B%5D=<?=$category->categoryId?>"><?=$category->categoryName?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="extended-nav-list">
                <p class="enl-title">Collections</p>
                <ul>
                    <?php foreach($collections as $collection): ?>
                        <li><a href="shop.php?collection%5B%5D=<?=$collection->collectionId?>"><?=$collection->collectionName?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="extended-nav-list">
                <p class="enl-title">Featured</p>
                <ul>
                    <?php foreach($featuredProducts as $product): ?>
                        <li><a href="product.php?productId=<?=$product->productId?>"><?=$product->productName?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="extended-nav-list">
                <p class="enl-title">accessories</p>
                <ul>
                <?php foreach($featuredAccessories as $product): ?>
                        <li><a href="product.php?productId=<?=$product->productId?>"><?=$product->productName?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="promo-card" id="extended-nav-image">
                <a href="shop.php?category%5B%5D=3">
                    <div class="promo-card-text">
                        <p class="promo-card-desc">Check out our new</br><span id="mid-row"><span>sweatshirt</span> collection</span></p>
                    </div>
                    <div class="promo-card-overlay"></div>
                </a>
            </div>
        </div>
    </div>
</nav>