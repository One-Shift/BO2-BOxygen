<?php
	if ($account["login"]) {
		switch($pg) {
			case 'home':
				include "./modules/home/home.php";
				break;
			// -- Article
			case 'article-add':
				include "./modules/article_add/article_add.php";
				break;
			case 'article-edit':
		    	include "./modules/article_edit/article_edit.php";
				break;
			case 'article-del':
				include "./modules/article_del/article_del.php";
				break;
			case 'article-list':
				include "./modules/article_list/article_list.php";
				break;
			// -- Products
			case 'product-add':
				include "./modules/product_add/product_add.php";
				break;
			case 'product-edit':
				include "./modules/product_edit/product_edit.php";
				break;
			case 'product-del':
				include "./modules/product_del/product_del.php";
				break;
			case 'product-list':
				include "./modules/product_list/product_list.php";
				break;
			// -- Categories
			case 'category-add':
				include "./modules/category_add/category_add.php";
				break;
			case 'category-edit':
				include "./modules/category_edit/category_edit.php";
				break;
			case 'category-del':
				include "./modules/category_del/category_del.php";
				break;
			case 'category-list':
				include "./modules/category_list/category_list.php";
				break;
			// -- User Info
			case 'user-add':
				include "./modules/user_add/user_add.php";
				break;
			case 'user-edit':
				include "./modules/user_edit/user_edit.php";
				break;
			case 'user-del':
				include "./modules/user_del/user_del.php";
				break;
			case 'user-list':
				include "./modules/user_list/user_list.php";
				break;
            		// -- Newsletters
			case 'newsletters':
				include "./modules/newsletters/newsletters.php";
				break;
			// -- Session
            case 'logout':
                include "./modules/logout/logout.php";
                break;

			default:
				include "./modules/not_found/not-found.php";
				break;
		}
	} else {
		echo "<script>goTo('./');</script>";
	}
