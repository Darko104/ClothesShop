<section id="user-orders">
    <div class="white-box">
        <div class="white-box-header">
            <p>All orders</p>
        </div>
            <?php
                // Delivery is supposed to arrive after 3 days.
                updateOrderStatus();
                
                $orders = getOrdersByUserId($_SESSION["logged_user"]->id);
                if(count($orders) == 0):
            ?>
            <p class="items-not-found">You have not ordered anything yet.<a href="index.php?page=shop">Shop now</a></p>
            <?php
                else:
            ?>
            <div id="all-orders" class="white-box-content">
            <?php
                foreach($orders as $order):
                    $orderSerial = getOrderSerialNumberPerCustomer($_SESSION["logged_user"]->id, $order->invoiceId);

                    $timestamp = strtotime($order->invoiceCreation);
                    $dateFormat = date("d M Y, G:i A", $timestamp);
            ?>
            <div class="single-order">
                <div class="single-order-header">
                    <div class="single-order-basic-info">
                        <p class="order-number">Order #<span><?=$orderSerial?></span></p>
                        <p class="date-ordered"><?=$dateFormat?></p>
                    </div>
                    <div class="single-order-status-wrapper">
                        <p class="single-order-status-title">Status:</p>
                        <p class="single-order-status" style="color:<?=$order->color?>;" data-invoiceid="<?=$order->invoiceId?>"><?=$order->statusName?></p>
                    </div>
                </div>
                <div class="single-order-products" data-invoiceid="<?=$order->invoiceId?>">
                    <?php 
                        // Products per single order (maximum 2 can be initialy shown)
                        $productsPerOrder = getProductsByInvoiceId($order->invoiceId);
                        $numberOfProductsPerOrder = count($productsPerOrder);

                        if ($productsPerOrder > 1) $numberOfShownProducts = 2;
                        else $numberOfShownProducts = $numberOfShownProducts = 1;

                        for($i = 0; $i < $numberOfShownProducts; $i++):
                    ?> 
                    <div class="ordered-product">
                        <img src="assets/images/<?=$productsPerOrder[$i]->imageName?>" class="ordered-product-image">
                        <div class="ordered-product-info">
                            <p class="ordered-product-name">
                            <?=$productsPerOrder[$i]->productName?>
                            </p>
                            <div class="ordered-product-purchase-info">
                                <p class="ordered-product-price">$<?=$productsPerOrder[$i]->current_price?></p>
                                <p class="ordered-product-quantity">Qty: <span><?=$productsPerOrder[$i]->quantity?></span></p>
                            </div>
                        </div>
                    </div>
                    <?php endfor; ?>
                    <p id="more-in-cart"><i class="fa-solid fa-ellipsis"></i></p>
                </div>
                <div class="single-order-footer">
                    <div class="single-order-total">
                        <p class="single-order-total-products">X<?=$numberOfProductsPerOrder?> Items</p>
                        <p class="single-order-total-price">$<?=$order->price?></p>
                    </div>
                    <div class="single-order-action">
                        <button class="view-order" data-invoiceid="<?=$order->invoiceId?>">View</button>
                        <?php if($order->statusName == "processed"): ?>
                            <button class="cancel-order" data-invoiceid="<?=$order->invoiceId?>">Cancel</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            </div>
            <?php endif; ?>
    </div>
</section>