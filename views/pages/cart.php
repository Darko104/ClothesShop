<?php
    include "models/product/functions.php";
    include "models/cart/functions.php";
?>
<header>
    <?php include 'views/fixed/navigation.php' ?>
</header>
<main>
    <section id="cart">
        <h1 class="section-center-title">Shopping cart</h1>
        <?php 
            if(!empty($cartProducts)): // If cart is not empty
        ?>
        <div id="cart-info">
            <section id="cart-items">
                <div id="cart-table">
                    <div id="cart-table-header">
                        <div class="cart-table-header-field">
                            <p>Item</p>
                        </div>
                        <div class="cart-table-header-field">
                            <p>Price</p>
                        </div>
                        <div class="cart-table-header-field">
                            <p>Qty</p>
                        </div>
                        <div class="cart-table-header-field">
                            <p>Subtotal</p>
                        </div>
                    </div>
                    <div id="cart-table-small-scale-header">
                        <p>Item</p>
                    </div>
                    <div id="cart-table-products">
                        <?php 
                            $subtotalOfAll = 0;
                            foreach($cartProducts as $product):
                                $totalPrice = $product->current_price * $product->quantity;
                                $subtotalOfAll += $totalPrice;
                        ?>
                        <div class="cart-table-row">
                            <div class="cart-table-row-product">
                                <img src="assets/images/<?=$product->imageName?>" class="cart-image">
                                <p><?=$product->productName?></p>
                            </div>
                            <div class="cart-table-row-price">
                                <p class="cart-info-type-inside-row">Price:</p>
                                <p>$<?=$product->current_price?></p>
                            </div>
                            <div class="cart-table-row-quantity">
                                <p class="cart-info-type-inside-row">Quantity:</p>
                                <div class="product-quantity">
                                    <input type="number" class="pq-input" min="1" max="15" value="<?=$product->quantity?>" data-id="<?=$product->productId?>">
                                    <div class="product-quantity-change">
                                        <i class="fas fa-chevron-up change-quantity" data-id="<?=$product->productId?>" data-page="cart" data-direction="up"></i>
                                        <i class="fas fa-chevron-down change-quantity" data-id="<?=$product->productId?>" data-page="cart" data-direction="down"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-table-row-subtotal">
                                <p class="cart-info-type-inside-row">Subtotal:</p>
                                <p class="product-subtotal-price" data-id="<?=$product->productId?>" data-productprice="<?=$product->current_price?>" data-subtotalprice="<?=$totalPrice?>">$<?=$totalPrice?></p>
                                <p class="remove-from-cart" data-id="<?=$product->productId?>"><i class="fas fa-times-circle"></i></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div id="cart-options">
                    <button id="back-to-shop-action" onclick="location.href = 'index.php?page=shop';">Continue shoping</button>
                    <button id="clear-cart">Clear shopping cart</button>
                </div>
            </section>
            <aside>
                <div id="cart-summary">
                    <div id="cart-summary-header">
                        <b>Summary</b>
                    </div>
                    <div id="cart-summary-body">
                        <p><span>Subtotal</span><span id="summary-subtotal">$<?=$subtotalOfAll?></span></p>
                        <p><span>Shipping</span><span>$5.00</span></p>
                        <p><span>Order total</span><span id="summary-total-price">$<?=$subtotalOfAll+5?></span></p>
                    </div>
                    <div id="cart-summary-body">
                        <form action="index.php" method="get">
                            <?php
                                foreach($cartProducts as $product):
                            ?>
                                <input type="hidden" name="product-quantity[]" value="<?=$product->productId?>,<?=$product->quantity?>">
                            <?php endforeach; ?>
                            <input type="hidden" id="form-subtotal" name="subtotal" value="<?=$subtotalOfAll?>">
                            <input type="hidden" name="page" value="checkout">
                            <button id="go-to-checkout">Proceed to checkout</button>
                        </form>
                    </div>
                </div>
            </aside>
        </div>
        <?php else: // If cart is empty ?> 
            <div id="no-products-info">
                <img src="assets/images/sad_cart.svg" id="no-products-image">
                <p>No products in cart found <a href="index.php?page=shop">Go Shopping</a></p>
            </div>
        <?php endif; ?>
    </section>
    <section class="full-page-cover">
        <?php include "views/partials/aside_menu.php"; ?>
    </section>
</main>
<?php include "views/fixed/footer.php" ?>