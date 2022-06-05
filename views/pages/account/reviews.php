<section id="user-reviews">
    <div class="white-box">
        <div class="white-box-header">
            <p>Past reviews</p>
        </div>
        <div id="past-reviews" class="white-box-content">
            <?php 
                $reviews = getReviewsPerUser($_SESSION["logged_user"]->id);
                if (count($reviews) == 0):
            ?>
            <p class="items-not-found">You have not rated any products.<a href="index.php?page=shop">Shop now</a></p>
            <?php else: 
                foreach($reviews as $review):
                    $timestamp = strtotime($review->created_at);
                    $dateFormat = date("j/n/Y", $timestamp);
            ?>
            <div class="product-single-review">
                <h5 class="product-review-header past-review-header">You have posted comment with summary:&nbsp;&nbsp;<span class="past-review-summary"><?=$review->summary?></span>&nbsp;&nbsp;under alias&nbsp;&nbsp;<span class="past-review-alias"><?=$review->nickname?></span></h5>
                <p class="product-review-comment"><?=$review->summary?></p>
                <div class="product-review-info">
                    <p class="product-review-date">Posted on <span><?=$dateFormat?></span></p>
                </div>
                <div class="product-review-rating">
                    <p>Rating:&nbsp;</p>
                    <div class="rating-stars">
                        <?php writeStars($review->rating); ?>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</section>