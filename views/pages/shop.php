<?php
    include "models/basic/functions.php";
    include "models/product/functions.php";
    include "models/cart/functions.php";

    $currentPage = "Shop";
?>
<header>
    <?php include 'views/fixed/navigation.php' ?>
</header>
<main>
    <section id="product-selection">
        <form method="GET" id="products-form">
        <aside id="product-options">
            <h4 id="product-options-header">Shopping options</h4>
            <div id="product-parameters-wrapper">
                <div class="parameters-wrapper">
                    <div class="parameter-header">
                        <h5>Categories</h5>
                    </div>
                    <div class="parameters-list">
                        <?php writeFilterParameters("category", $categories, "categoryId", "categoryName", "categoryCount"); ?>
                    </div>
                </div>
                <div class="parameters-wrapper">
                    <div class="parameter-header">
                        <h5>Collections</h5>
                    </div>
                    <div class="parameters-list">
                    <?php writeFilterParameters("collection", $collections, "collectionId", "collectionName", "collectionCount"); ?>
                    </div>
                </div>
                <div class="parameters-wrapper">
                    <div class="parameter-header">
                        <h5>Price</h5>
                    </div>
                    <div id="filter-price">
                        <?php 
                            $min = "";
                            $max = "";
                            if (isset($_GET["min-price"])) $min = $_GET["min-price"];
                            if (isset($_GET["max-price"])) $max = $_GET["max-price"];
                        ?>
                        <input type="number" name="min-price" min="0" placeholder="Min. price" class="edit-price-filter" value="<?=$min?>">
                        <input type="number" name="max-price" min="0" placeholder="Max. price" class="edit-price-filter" value="<?=$max?>">
                    </div>
                    <button type="submit" id="submit-price-filter">Filter</button>
                </div>
                <div class="parameters-wrapper">
                    <div class="parameter-header">
                        <h5>Brands</h5>
                    </div>
                    <div class="parameters-list">
                    <?php writeFilterParameters("brand", $brands, "brandId", "brandName", "brandCount"); ?>
                    </div>
                </div>
            </div>
        </aside>
        <div id="products-showcase">
            <div id="products-showcase-header">
                <div id="filter-products-row" class="products-showcase-header-row">
                    <div class="filter-products-header-parameter" data-type="category">
                        <p>category</p>
                        <i class="fas fa-cubes"></i>
                    </div>
                    <div class="filter-products-header-parameter" data-type="collection">
                        <p>collection</p>
                        <i class="fas fa-money-bill-alt"></i>
                    </div>
                    <div class="filter-products-header-parameter" data-type="brand">
                        <p>product brand</p>
                        <i class="fas fa-copyright"></i>
                    </div>
                </div>
                <div id="products-view-options" class="products-showcase-header-row">
                    <div id="products-amount">
                        <?php
                            $products = getAndFilterProducts($_GET);
                            $numberOfProducts = count($products);
                        ?>
                        <p id="number-of-shown-products">Found <span><?=$numberOfProducts?></span> items</p>
                    </div>
                    <div id="product-search" class="search-input">
                        <input type="text" name="keyword" id="product-search-bar" placeholder="Search products" <?php if(isset($_GET["keyword"])):?> value="<?=$_GET["keyword"]?>" <?php endif; ?>  >
                        <p id="product-search-icon"><i class="fas fa-search"></i></p>
                    </div>
                    <div id="second-row-pst" class="products-sort-type">
                        <p>Sort by</p>
                        <!-- Sorting options -->
                        <select name="sort" id="products-sort" class="select-light">
                            <?php
                                $sortOptions = getSortByOptions();
                                foreach($sortOptions as $option):
                                    if($option->database_alias == $_GET["sort"]):
                            ?>
                                <option value="<?=$option->database_alias?>" selected><?=$option->name?></option>
                            <?php else: ?>
                                <option value="<?=$option->database_alias?>"><?=$option->name?></option>
                            <?php 
                                endif; endforeach;
                            ?>
                        </select>
                        <input type="hidden" id="sort-type" name="sorttype" value="<?php if(isset($_GET["sorttype"])) echo $_GET["sorttype"]; else echo "asc"?>">

                        <?php if(isset($_GET["sorttype"])):
                            if($_GET["sorttype"] != "desc"):
                        ?>
                        <i id="change-sort-type" class="fas fa-long-arrow-alt-up"></i>
                        <?php else: ?>
                        <i id="change-sort-type" class="fas fa-long-arrow-alt-down"></i>
                        <?php endif;
                            else:
                        ?>
                        <i id="change-sort-type" class="fas fa-long-arrow-alt-up"></i>
                        <?php endif; ?>
                    </div>
                </div>
                <div id="products-view-options-more" class="products-showcase-header-row">
                    <div id="products-header-spa" class="show-products-amount">
                        <p>Show</p>
                        <select class="select-light">
                            <option>12</option>
                            <option>20</option>
                            <option>36</option>
                            <option>All</option>
                        </select>
                        <p>per page</p>
                    </div>
                    <div id="third-row-pst" class="products-sort-type">
                        <p>Sort by</p>
                        <select class="select-light">
                            <option>Name</option>
                            <option>Price</option>
                        </select>
                        <i class="fas fa-long-arrow-alt-down"></i>
                    </div>
                </div>
            </div>
            <div id="full-grid-products" class="track">
                <?php 
                    $showAmount = rangeOfVisibleProducts($_GET, $numberOfProducts);
                    
                    if ($numberOfProducts == 0):
                        $numberOfPages = 0;
                    ?>
                        <p id="no-products"><img src="assets/images/sad.svg" class="not-found-img">No products found</p>
                    <?php
                    else:
                    // Calculating number of pages.
                    $numberOfPages = ceil($numberOfProducts / $showAmount);

                    $paginationValues = getPaginationValues($_GET, $numberOfProducts, $showAmount);

                    $page = $paginationValues[0];
                    $startingPoint = $paginationValues[1];
                    $endingPoint = $paginationValues[2];

                    // All product Id values in cart
                    $productsInCartIdValues = getProductIdValuesInCart();

                    for($i = $startingPoint; $i < $endingPoint; $i++):
                        $mainButtonClasses = "cart-default-qty";
                        $mainButtonText = "Add to cart";
                        if ( in_array($products[$i]->productId, $productsInCartIdValues) ) {
                            $mainButtonClasses = "in-cart";
                            $mainButtonText = "Item in cart";
                        }
                ?>
                <article class="product-card">
                    <div class="product-card-info">
                        <img src="assets/images/<?=$products[$i]->imageName?>">
                        <p class="product-card-name">
                            <a href="index.php?page=product&productId=<?=$products[$i]->productId?>"><?=cropString($products[$i]->productName, 33);?></a>
                        </p>
                        <p class="product-card-brand"><?=$products[$i]->brandName?></p>
                        <p class="product-card-price">
                            <?php if($products[$i]->old_price != null): ?>
                            <span class="current-price" style="color:#cc1414;">$<?=$products[$i]->current_price?></span>
                            <span class="old-price">$<?=$products[$i]->old_price?></span>
                            <?php else: ?>
                            <span class="current-price">$<?=$products[$i]->current_price?></span>
                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="product-card-action">
                        <button type="button" class="main-action-button <?=$mainButtonClasses?>" data-id="<?=$products[$i]->productId?>"><?=$mainButtonText?></button>
                        <button type="button" class="gray-button quick-view" data-id="<?=$products[$i]->productId?>">Quick view <i class="fas fa-binoculars"></i></button>
                    </div>
                </article>
                <?php endfor; endif; ?>
            </div>
            <div id="show-products">
                <!-- Pagination -->
                <ul id="product-pages" class="select-page">
                    <?php
                        for ($i = 0; $i < $numberOfPages; $i++):
                    ?>
                        <input type="radio" name="pagination" value="<?=$i?>" id="page-<?=$i?>" class="page-number-radio">
                    <?php if ($page == $i): ?>
                        <label for="page-<?=$i?>" class="page-number active-product-page"><?=$i + 1?></label>
                    <?php else: ?>
                        <label for="page-<?=$i?>" class="page-number"><?=$i + 1?></label>
                    <?php endif; endfor; ?>
                </ul>
                <div id="bottom-spa" class="show-products-amount">
                    <p>Show</p>
                    <select id="product-amount" name="viewamount" class="select-light">
                        <?php 
                            $possibleAmounts = getPossibleProductAmounts();
                            foreach($possibleAmounts as $amount):
                                // Picked amount from URL needs to be seen first in select.
                                if ($amount->amount == $_GET["viewamount"] || (!isset($_GET["viewamount"]) && $amount->default_field == 1 ) ):
                        ?>
                        <option value="<?=$amount->amount?>" selected><?=$amount->amount?></option>
                        <?php else: ?>
                        <option value="<?=$amount->amount?>"><?=$amount->amount?></option>
                        <?php endif; endforeach; ?>
                    </select>
                    <p>per page</p>
                </div>
            </div>
        </div>
        <input type="hidden" name="page" value="shop">
        </form>
    </section>
    <section class="full-page-cover">
        <?php include "views/partials/aside_menu.php"; ?>
        <div id="specific-product-quick-view" class="specific-product">
        </div>
        <div id="filter-products-menu">
            <div id="filter-products-menu-header">
                <h3>Categories</h3>
                <p>* Select one or more</p>
            </div>
            <div id="filter-products-menu-body">
            </div>
            <div id="filter-products-menu-close" class="close-modal">X</div>
        </div>
    </section>
</main>
<?php include "views/fixed/footer.php" ?>