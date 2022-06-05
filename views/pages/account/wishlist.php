<section id="user-wishlist">
    <div class="white-box">
        <div class="white-box-header">
            <p>Wish List</p>
        </div>
        <?php 
            if (isset($_SESSION["logged_user"])):
                $products = getAllWishlistItems($_SESSION["logged_user"]->id);
                if (count($products) == 0):
        ?>
        <p class="items-not-found">No items in your wishlist found.<a href="index.php?page=shop">Shop now</a></p>
        <?php else: ?>
        <div id="wishlist-items" class="white-box-content">
        <?php
            for ($i = 0; $i < count($products); $i++):
        ?>
            <article class="product-card">
                <img src="assets/images/<?=$products[$i]->imageName?>">
                <div class="product-card-info">
                    <p class="product-card-name">
                        <?php 
                            if(strlen($products[$i]->productName) > 33):
                        ?>
                        <?= substr($products[$i]->productName, 0, 33)."..." ?>
                        <?php else: ?>
                        <?=$products[$i]->productName?>
                        <?php endif; ?>
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
                    <button class="quick-view highlight-button" data-id="<?=$products[$i]->productId?>">Quick view <i class="fas fa-binoculars"></i></button>
                    <button class="remove-from-wishlist gray-button" data-id="<?=$products[$i]->productId?>" data-refresh="true">Remove <i class="fas fa-heart-broken"></i></button>
                </div>
            </article>
            <?php endfor; endif; endif; ?>
        </div>
    </div>
</section>