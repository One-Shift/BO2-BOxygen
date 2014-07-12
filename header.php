<?php
    // CONFIGURAÇÕES
    include './configuration.php';
    include './connect.php';

    // CLASSES
    include "./class/class.article.php";
    include "./class/class.cart.php";
    include "./class/class.category.php";
    include "./class/class.GibberishAES.php";
    include "./class/class.history.php";
    include "./class/class.newsletters.php";
    include "./class/class.orders.php";
    include "./class/class.product.php";
    include "./class/class.productsearch.php";
    include "./class/class.user.php";

    // OUTROS
    include './functions.php';
    include './languages/'.$configuration['language'].'.php';
