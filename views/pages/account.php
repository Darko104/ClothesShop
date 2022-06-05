<?php 
    if (isset($_SESSION["logged_user"])):
?>
<?php
    include "models/basic/functions.php";
    include "models/product/functions.php";
    include "models/cart/functions.php";
    include "models/user/functions.php";
    include "models/wishlist/functions.php";
    include "models/order/functions.php";
    include "models/review/functions.php";
    $categories = getProductCategories();
    $collections = getProductCollections();
    $brands = getProductBrands();
?>
<header>  
    <?php include 'views/fixed/account_nav.php' ?>
</header>
<main>
    <section id="user-panel">
        <aside id="user-info-menu">
            <ul id="user-info-categories">
                <?php 
                    $getPagesForUserPrivilege = getUserPages($_SESSION["logged_user"]->privilege);

                    $pageToShow = "";
                    if (!isset($_GET["page"])) $pageToShow = "user-profile";
                    else $pageToShow = $_GET["page"];
                    foreach($getPagesForUserPrivilege as $page):
                        $selectedLink = "";
                        $selectedMark = "";
                        if ($page->link == $pageToShow || $page->link == $pageToShow) {
                            $selectedLink = "class='selected-user-info-category'";
                            $selectedMark = "<div class='selected-mark'></div>";
                        }
                ?>
                <li <?php echo $selectedLink?>>
                    <a href="index.php?page=account&view=<?=$page->link?>">
                        <?php echo $selectedMark ?>
                        <i class="<?=$page->icon?>"></i><?=$page->name?>
                    </a>
                </li>
                <?php endforeach; ?>
                <li>
                    <a href="index.php?page=log_off">
                        <i class="fas fa-power-off"></i>log off
                    </a>
                </li>
            </ul>
        </aside>
        <section id="user-info-showcase">
        <?php 
            if ($_SESSION['logged_user']->privilege == 2):
                if ( !isset($_GET['view']) || (isset($_GET['view']) && $_GET['view'] == "user-profile") ):
                    include "views/pages/account/profile.php";
                else: 
                    switch ($_GET['view']):
                        case 'user-orders':
                            include "views/pages/account/orders.php";
                        break;
                        case 'user-wishlist':
                            include "views/pages/account/wishlist.php";
                        break;
                        case 'user-reviews':
                            include "views/pages/account/reviews.php";
                        break;
                        case 'user-rate-service':
                            include "views/pages/account/rate_service.php";
                        break;
                        default:
                            header('Location: index.php');
                    endswitch; 
                endif;
            elseif ($_SESSION['logged_user']->privilege == 1):
                include "models/admin/functions.php";
                if ( !isset($_GET['view']) || (isset($_GET['view']) && $_GET['view'] == "user-profile") ):
                    include "views/pages/admin/main.php";
                else: 
                    switch ($_GET['view']):
                        case 'panel-main':
                            include "views/pages/admin/main.php";
                        break;
                        case 'panel-stats':
                            include "views/pages/admin/stats.php";
                        break;
                        case 'panel-products':
                            include "views/pages/admin/products.php";
                        break;
                        case 'panel-add':
                            include "views/pages/admin/add_product.php";
                        break;
                        default:
                            header('Location: index.php');
                    endswitch;
                endif;
            endif;
        ?>
        </section>
    </section>
    <section class="full-page-cover">
        <?php include "views/partials/aside_menu.php"; ?>
        <section id="view-order">
        </section>
        <div id="specific-product-quick-view" class="specific-product">
            <div id="quick-view-images">
                <div id="quick-view-all-images">
                    <img src="images/featured-top-2.jpg" class="aside-image aside-image-selected">
                    <img src="images/featured-top-22.jpg" class="aside-image">
                    <img src="images/featured-top-23.jpg" class="aside-image">
                </div>
                <img src="images/featured-top-2.jpg" id="quick-view-wide-image">
            </div>
            <div id="specific-product-info">
                <div id="specific-product-info-header">
                    <h3 class="specific-product-name">NIKECOURT AIR ZOOM PRESTIGE</h3>
                    <p id="quick-view-price">$290.00</p>
                </div>
                <div id="specific-product-info-body">
                    <div class="product-attributes">
                        <p class="product-attribute"><span class="pa-key">Availability:</span> <span id="product-stock-info">In stock</span></p>
                        <p id="product-code" class="product-attribute"><span class="pa-key">PID:</span> <span>Sport-001</span></p>
                    </div>
                    <p id="product-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque assumenda blanditiis consequatur eius non!</p>
                    <div id="product-finish-purchase">
                        <div class="product-quantity">
                            <input type="number" value="1" max="15">
                            <div class="product-quantity-change">
                                <i class="fas fa-chevron-up"></i>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <button>Add to cart</button>
                    </div>
                    <p id="specific-product-add-to-wishlist"><img src="images/love.svg">Add to wishlist</p>
                </div>
                <div id="specific-product-info-footer">
                    <div class="product-attributes">
                        <p id="product-tags" class="product-attribute"><span class="pa-key">Categories:</span> <span>Sport, Shop, Newest</span></p>
                        <p id="product-brands" class="product-attribute"><span class="pa-key">Brands:</span> <span>Iqva</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php unset($_SESSION["errors"]); ?>
<?php else: include header('Location: index.php?page=sign_in'); endif; ?>