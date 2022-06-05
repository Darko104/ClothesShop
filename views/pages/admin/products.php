<section id="panel-products">
    <div class="white-box">
        <div class="white-box-header">
            <p>Products</p>
        </div>
        <div class="white-box-content white-box-table">
            <form id="panel-products-options" onsubmit="return form.searchProducts()">
                <div id="ppo-row-1">
                    <div id="ppo-dropdowns">
                        <select name="category[]" class="panel-select ppo-dropdown">
                            <?php 
                                foreach($categories as $category):
                            ?>
                            <option value="<?=$category->categoryId?>"><?=$category->categoryName?></option>
                            <?php endforeach; ?>
                        </select>
                        <select name="collection[]" class="panel-select ppo-dropdown">
                            <?php 
                                foreach($collections as $collection):
                            ?>
                            <option value="<?=$collection->collectionId?>"><?=$collection->collectionName?></option>
                            <?php endforeach; ?>
                        </select>
                        <select name="brand[]" class="panel-select ppo-dropdown">
                            <?php 
                                foreach($brands as $brand):
                            ?>
                            <option value="<?=$brand->brandId?>"><?=$brand->brandName?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div id="ppo-prices">
                        <input type="number" name="min-price" placeholder="Min. price">
                        <input type="number" name="max-price" placeholder="Max. price">
                    </div>
                </div>
                <div id="ppo-row-2">
                    <input type="text" id="ppo-search" name="keyword" placeholder="Search by name">
                </div>
                <div id="ppo-row-3">
                    <div id="ppo-sort-wrapper" class="products-sort-type">
                        <p>Sort by</p>
                        <select name="sort" class="select-light">
                            <option>Name</option>
                            <option>Price</option>
                        </select>
                        <input type="hidden" id="sort-type" name="sorttype" value="asc">
                        <i id="change-sort-type" class="fas fa-long-arrow-alt-up"></i>
                    </div>
                </div>
                <div id="ppo-row-4">
                    <button type="button" id="panel-product-search">Search</button>
                </div>
            </form>
            <table id="panel-table-products" class="panel-table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Brand</th>
                    <th>Units sold</th>
                    <th>View</th>
                    <th>Delete</th>
                </tr>
                <?php 
                    $products = getAllProducts("productName", "asc");

                    foreach($products as $product):
                ?>
                <tr>
                    <td><?=$product->productId?></td>
                    <td><?=$product->productName?></td>
                    <td><?=$product->productPrice?></td>
                    <td class="page-name"><?=$product->brandName?></td>
                    <td><?=$product->units_sold?></td>
                    <td><button class="panel-btn panel-view-btn"><a href="index.php?page=product&productId=<?=$product->productId?>">View</a></button></td>
                    <td><button class="panel-btn panel-delete-btn" data-id="<?=$product->productId?>"><a>Delete</a></button></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</section>