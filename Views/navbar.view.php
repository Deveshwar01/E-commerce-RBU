<?php

use GlobalsFunctions\Globals;

@session_start();
$currentuser = Globals::user();
$products = [];
if (!empty($currentuser)) {
    $products = \Datainterface\Selection::selectById('cart', ["ownerid" => $currentuser[0]['uid']]);
}
$totalItemUser = count($products);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="titlepage"></title>
    <link rel="stylesheet" href="Css/home.css">
    <script src="https://kit.fontawesome.com/d03a15e86b.js" crossorigin="anonymous"></script>
</head>

<body>
    <section id="header">
        <a href="homepage"> <img src="images/RBU Logo - Edited.png" alt=""></a>
        <!-- <h1><span>R</span>BU<span> E-COMMERCE</span></h1> -->
        <ul id="navbar">
            <li><a href="homepage">Home</a></li>
            <li><a href="categories">shop</a></li>
            <li><a href="contact_page">Contact </a></li>
            <li><a href="signing-up">log-in </a></li>
            <li id="lg-bag"><a href="cart"><i class="fa-solid fa-bag-shopping"></i><?php echo $totalItemUser; ?></a></li>
            <a href="#" id="close"><i class="fa-regular fa-circle-xmark"></i></a>
        </ul>
        </div>
        <div id="mobile" style="list-style:none;">
            <li><a href="cart"><i class="fa-solid fa-bag-shopping"></i></a></li>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

    <body>