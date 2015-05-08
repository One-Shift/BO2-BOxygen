<?php

if ($account["login"]) { // verificar se está autenticado
	switch ($pg) {
		case "home":
			include "./modules/home/home.php";
			break;
		// -- Article
		case "article": include "./modules/article/article.php";
			break;
		// -- Product
		case "product": include "./modules/product/product.php";
			break;
		// -- Orders
		case "orders":
			include "./modules/orders/orders.php";
			break;
		// -- Categories
		case "category":
			include "./modules/category/category.php";
			break;
		// -- User
		case "user":
			include "./modules/user/user.php";
			break;
		// -- Newsletters
		case "newsletters":
			include "./modules/newsletters/newsletters.php";
			break;
		case "newsletters-enable":
			include "./modules/newsletters/newsletters.php";
			break;
		case "newsletters-disable":
			include "./modules/newsletters/newsletters.php";
			break;

		// -- files
		case "controller-files":
			include "./modules/controller_files/controller_files.php";
			break;
		// -- Session
		case "logout":
			include "./modules/logout/logout.php";
			break;

		default:
			include "./modules/not_found/not-found.php";
			break;
	}
} else {
	printf("<script>goTo('%s');</script>", $configuration["path-bo"]);
}
