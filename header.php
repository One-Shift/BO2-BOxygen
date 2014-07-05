<?php
    // CONFIGURAÇÕES
    include './configuration.php';
    include './connect.php';

    // CLASSES
    include "./class/class.GibberishAES.php";
    include './class/class.article.php';
    include './class/class.product.php';
    include './class/class.category.php';
    include './class/class.user.php';
    include './class/class.newsletters.php';

    // OUTROS
    include './functions.php';
    include './languages/'.$configuration['language'].'.php';
