<?php

use Alerts\Alerts;
use Datainterface\Insertion;
use Datainterface\Selection;
use GlobalsFunctions\Globals;

@session_start();

global $total;
if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $_SESSION['total'] = $_GET['total'];
}

$currentUser = Globals::user();
$cartItems = Selection::selectById('cart', ['ownerid' => Globals::user()[0]['uid']]);
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['continuecheckout'])) {
    global $total;
    if (
        empty($_POST['firstname']) || empty($_POST['email']) || empty($_POST['phone']) ||
        empty($_POST['address'])
    ) {
        echo Alerts::alert('danger', "Field all mandatory fields");
        goto outside;
    }

    $data = [
        'customername' => htmlspecialchars(strip_tags($_POST['firstname'])),
        'customeremail' => htmlspecialchars(strip_tags($_POST['email'])),
        'customerphone' => htmlspecialchars(strip_tags($_POST['phone'])),
        'customeraddress' => htmlspecialchars(strip_tags($_POST['address'])),
        'customerstate' => htmlspecialchars(strip_tags($_POST['state'])),
        'customercity' => htmlspecialchars(strip_tags($_POST['city'])),
        'customerzip' => htmlspecialchars(strip_tags($_POST['zip'])),
        'productdetails' => json_encode($cartItems),
        'total' => $_SESSION['total']
    ];
    $_SESSION['order'] = Insertion::insertRow('orders', $data);
    if (!empty($_SESSION['order'])) {
        //sending email to customer of confirmation and to seller
        echo '<META HTTP-EQUIV="Refresh" Content="1; URL=payment">';
    }

    outside:
}
?>
<link rel="stylesheet" href="css/cheakout.css">
<div class="container">
<section class="cheak-out">
    <form action="<?php echo Globals::url(); ?>" method="POST">
        <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i>  Full Name</label>
            <input type="text" id="fname" name="firstname" value="<?php echo $currentUser[0]['firstname'] . ' ' . $currentUser[0]['lastname']; ?>" placeholder="">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" value="<?php echo $currentUser[0]['mail']; ?>" placeholder="">
            <label for="phone"><i class="fa-solid fa-phone"></i> Contact Number</label>
            <input type="text" id="phone" name="phone" value="<?php echo $currentUser[0]['phone']; ?>" placeholder="">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="" <label for="state">State</label>
            <input type="text" id="state" name="state" placeholder="">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="">
            <label for="zip">pin-code</label>
            <input type="text" id="zip" name="zip" placeholder="">

            <input type="submit" name="continuecheckout" value="Continue to Pay" class="btn">

        </div>
    </form>
</section>
</div>
