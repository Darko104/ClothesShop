<aside id="aside-menu">
    <div id="aside-menu-header">
        <p id="aside-menu-title">Menu</p>
        <p id="aside-menu-close" class="close-modal">X</p>
    </div>
    <ul id="aside-menu-pages">
        <?php if(isset($_SESSION["logged_user"])): ?>
        <li class="aside-action-link">
            <div class="aside-link-title level1">
                <div class="aside-link-title-icon">
                    <img src="assets/images/user.svg" class="nav-icon">
                    <p><?=$_SESSION["logged_user"]->first_name?> <?=$_SESSION["logged_user"]->last_name?></p>
                </div>
                <span class="extend-aside-menu"><i class="fas fa-chevron-down"></i></span>
            </div>
            <ul class="aside-submenu">
                <li>
                    <a href="account.php" class="aside-link-title level2">
                        <p>account</p>
                    </a>
                </li>
                <li>
                    <a href="account.php?view=user-orders" class="aside-link-title level2">
                        <p>order</p>
                    </a>
                </li>
                <li>
                    <a href="account.php?view=user-wishlist" class="aside-link-title level2">
                        <p>wish list</p>
                    </a>
                </li>
                <li>
                    <a href="account.php?view=user-reviews" class="aside-link-title level2">
                        <p>past reviews</p>
                    </a>
                </li>
                <li>
                    <a href="account.php?view=user-rate-service" class="aside-link-title level2">
                        <p>rate service</p>
                    </a>
                </li>
                <li>
                    <a href="models/user/log_off.php" class="aside-link-title level2">
                        <p>log off</p>
                    </a>
                </li>
            </ul>
        </li>
        <?php else: ?>
        <li class="aside-action-link">
            <div class="aside-link-title level1">
                <div class="aside-link-title-icon">
                    <img src="assets/images/user.svg" class="nav-icon">
                    <p>Account</p>
                </div>
                <span class="extend-aside-menu"><i class="fas fa-chevron-down"></i></span>
            </div>
            <ul class="aside-submenu">
                <li>
                    <a href="sign_in.php" class="aside-link-title level2">
                        <p>Log In</p>
                    </a>
                </li>
                <li>
                    <a href="sign_up.php" class="aside-link-title level2">
                        <p>Register</p>
                    </a>
                </li>
            </ul>
        </li>
        <?php endif; ?>
        <li class="aside-action-link">
            <a href="account.php?view=user-wishlist" class="aside-link-title level1">
                <div class="aside-link-title-icon">
                    <img src="assets/images/love.svg" class="nav-icon">
                    <p>favourites</p>
                </div>
            </a>
        </li>
        <li class="aside-action-link">
            <a href="cart.php" class="aside-link-title level1">
                <div class="aside-link-title-icon">
                    <img src="assets/images/shopping-cart.svg" class="nav-icon">
                    <p>cart</p>
                </div>
            </a>
        </li>
        
        <li>
            <a href="index.php" class="aside-link-title level1">
                <p>home</p>
            </a>
        </li>
        <li>
            <a href="shop.php" class="aside-link-title level1">
                <p>shop</p>
            </a>
        </li>
        <li>
            <a class="aside-link-title level1">
                <p>explore</p>
                <span class="extend-aside-menu"><i class="fas fa-chevron-down"></i></span>
            </a>
            <ul class="aside-submenu">
                <li>
                    <div class="aside-link-title level2">
                        <p>categories</p>
                        <span class="extend-aside-menu"><i class="fas fa-chevron-down"></i></span>
                    </div>
                    <ul class="aside-submenu">
                        <?php 
                            foreach($categories as $category):
                        ?>
                        <li>
                            <a href="shop.php?category%5B%5D=<?=$category->categoryId?>" class="aside-link-title level3">
                                <p><?=$category->categoryName?></p>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li>
                    <div class="aside-link-title level2">
                        <p>collections</p>
                        <span class="extend-aside-menu"><i class="fas fa-chevron-down"></i></span>
                    </div>
                    <ul class="aside-submenu">
                        <?php 
                            foreach($collections as $collection):
                        ?>
                        <li>
                            <a href="shop.php?collection%5B%5D=<?=$collection->collectionId?>" class="aside-link-title level3">
                                <p><?=$collection->collectionName?></p>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li>
                    <div class="aside-link-title level2">
                        <p>featured</p>
                        <span class="extend-aside-menu"><i class="fas fa-chevron-down"></i></span>
                    </div>
                    <ul class="aside-submenu">
                        <?php 
                            foreach($featuredProducts as $ftProduct):
                        ?>
                        <li>
                            <a href="product.php?productId=<?=$ftProduct->productId?>" class="aside-link-title level3">
                                <p><?=$ftProduct->productName?></p>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li>
                    <div class="aside-link-title level2">
                        <p>accessories</p>
                        <span class="extend-aside-menu"><i class="fas fa-chevron-down"></i></span>
                    </div>
                    <ul class="aside-submenu">
                        <?php 
                            foreach($featuredAccessories as $ftProduct):
                        ?>
                        <li>
                            <a href="product.php?product&productId=<?=$ftProduct->productId?>" class="aside-link-title level3">
                                <p><?=$ftProduct->productName?></p>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <a href="about.php" class="aside-link-title level1">
                <p>about me</p>
            </a>
        </li>
    </ul>
</aside>