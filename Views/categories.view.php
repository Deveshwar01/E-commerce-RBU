<?php @session_start();
require_once 'Views/navbar.view.php';
global $products;
$products = \Datainterface\Selection::selectAll("products");
$divs = "";
if(!empty($products)){

    foreach ($products as $product){
        $div = "<div class='pro' onclick='window.location.href='product?id={$product['id']}';'>
            <img src='{$product['image']}' alt=''>
            <div class='des'>
                <span>no brand</span>
                <h5>{$product['name']}</h5>
                <h4>price {$product['price']}</h4>
            </div>
            <a href='product?id={$product['id']}'><i class='fa-solid fa-cart-shopping'></i></a>
        </div>";
        $divs .= $div;
    }
}else{
    $divs = "<h2>Empty shop</h2>";
}
?>
<link rel="stylesheet" href="css/shop.css">

<section id="page-header">
    <h2> BUY NOW </h2>
    <p>Unleash Your School Spirit with Official University Merchandise</p>
</section>
<section id="product1" class="section-p1">
    <div class="pro-container">
        <?php echo $divs; ?>
    </div>
</section>
<!-- <section id="pagination" class="section-p1 section-m1">
    <a href="#">1</a>
    <a href="#">2</a>
    <a href="#"><i class="fal fa-long-arrow-alt-right"></i></a>
</section> -->
