<?php

if ($account["login"]) { // verificar se está autenticado
	switch ($pg) {
		case "home":
			include "modules/home/home.php";
			break;
		// -- Article
		case "article": include "modules/article/article.php";
			break;
		// -- Product
		case "product": include "modules/product/product.php";
			break;
		// -- Orders
		case "order":
			include "modules/order/order.php";
			break;
		// -- Categories
		case "category":
			include "modules/category/category.php";
			break;
		// -- User
		case "user":
			include "modules/user/user.php";
			break;
		// -- Newsletters
		case "newsletter":
			include "modules/newsletter/newsletter.php";
			break;
		case "newsletters-enable":
			include "modules/newsletter/newsletter.php";
			break;
		case "newsletters-disable":
			include "modules/newsletter/newsletter.php";
			break;

		// -- files
		case "controller-file":
			include "modules/controller-file/controller-files.php";
			break;
		// -- Session
		case "logout":
			include "modules/logout/logout.php";
			break;

		default:
			include "modules/not-found/not-found.php";
			break;
	}
} else {
	printf("<script>goTo('%s');</script>", $configuration["path-bo"]);
}
