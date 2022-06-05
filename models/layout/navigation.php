<?php

class navigationLink {
    public $name;
    public $href;
    public $hrefId;
    public $arrow;

    public function __construct($name, $href, $hrefId, $arrow, $list = null) {
        $this->name = $name;
        $this->href = $href;
        $this->hrefId = $hrefId;
        $this->arrow = $arrow;
    }
}
function writeNavPageLinks($currentPage = "") {
    $links = [];
    $links[] = new navigationLink('Home', 'index.php', false, false);
    $links[] = new navigationLink('Shop', 'index.php?page=shop', false, false);
    $links[] = new navigationLink('Explore', '#', "link-shop", true);
    $links[] = new navigationLink('About Me', 'index.php?page=about', false, false);

    $output = "";

    foreach($links as $link) {
        $hrefId = "";
        $arrow = "";
        $checked = "";
        if ($link->hrefId) {
            $hrefId = "id='$link->hrefId'";
        }
        if ($link->arrow) {
            $arrow = "&nbsp;<i class='fas fa-chevron-down extend-link'></i>";
        }
        if ($currentPage == $link->name) {
            $checked = "class='active-page'";
        }
        $output .= "<li><a $hrefId href='$link->href' $checked>$link->name$arrow</a></li>";
    }

    echo $output;
}
function getAccessories() {
    return executeQuery("SELECT *, p.name AS productName, p.id AS productId FROM product p INNER JOIN category c ON p.category_id = c.id WHERE c.id = 5 LIMIT 5");
}