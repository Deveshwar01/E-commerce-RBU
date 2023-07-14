<?php

use Datainterface\Selection;
use GlobalsFunctions\Globals;

@session_start();
if (!empty(Globals::user())) {
    $productsInCart = Selection::runQueries("SELECT cart.id as cid, cart.name as cname, cart.quatity as cquatity, cart.sizes as csizes, products.id as pid, products.name as pname,products.price as pprice,products.image as pimage FROM cart LEFT JOIN products ON cart.productid = products.id WHERE cart.ownerid = " . Globals::user()[0]['uid']);
}
$cart = "";
if (empty($productsInCart)) {
    $cart = '<h3>No items in your cart</h3>';
} else {

    foreach ($productsInCart as $item) {
        //get subtotal
        $itemcart = "<tr>
        <td><a href='remove?item={$item['cid']}'><i class='far fa-times-circle'></i></a></td>
        <td><img src='{$item['pimage']}' alt=''></td>
        <td>{$item['cname']}</td>
        <td> {$item['pprice']} </td>
        <td> {$item['cquatity']}</td>
    </tr>";
        $cart .= $itemcart;
    }
}
?>
<link rel="stylesheet" href="css/cart.css">
</section>

<section id="cart" class=" section-p1">
    <table width="100%">
        <thead>
            <tr>
                <td> remove</td>
                <td>image</td>
                <td>product</td>
                <td>price</td>
                <td>quanitiy</td>
            </tr>
        </thead>
        <tbody>
            <?php echo $cart; ?>
        </tbody>
    </table>

</section>
<section id="cart-add" class="section-p1">
    <div class="subtotal">
        <h3><strong>Cart Total</strong>
        </h3>
        <table>
            <tr>
                <td>Cart Subtotal</td>
                <td></td>
            </tr>
            <tr>
                <td><strong>total</strong></td>
                <td><strong>$35</strong></td>
            </tr>
        </table>
        <button class=" normal" id="checkout"> Procced to cheak out</button>
    </div>
</section>
<script>
    document.getElementById('checkout').addEventListener('click', (e) => {
        window.location.replace('check-out?total=20');
    })
</script>