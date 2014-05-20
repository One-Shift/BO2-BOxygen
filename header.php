<?php
    // CONFIGURAÇÕES
	include './configuration.php';
	include './connect.php';

    // CLASSES
	include './class/class_article.php';
	include './class/class_product.php';
    include './class/class_category.php';
    include './class/class_user.php';
    include './class/class_newsletters.php';

    // OUTROS
	include './functions.php';
	include './languages/'.$configuration['language'].'.php';
