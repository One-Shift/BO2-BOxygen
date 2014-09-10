<?php if ($account["login"]){ ?>
<ul>
	<a href="<?php print $configuration["path-bo"] ?>/0/user-list/"><?php echo $language["menu-users"]; ?></a>
	<a href="<?php print $configuration["path-bo"] ?>/0/category-list/"><?php echo $language["menu-categories"]; ?></a>
	<a href="<?php print $configuration["path-bo"] ?>/0/article-list/"><?php echo $language["menu-articles"]; ?></a>
	<!--li onclick="goTo('<?php print $configuration["path-bo"] ?>/archive/');">Archive (Soon)</li-->
	<a href="<?php print $configuration["path-bo"] ?>/0/product-list/"><?php echo $language["menu-products"]; ?></a>
	<a href="<?php print $configuration["path-bo"] ?>/0/newsletters/"><?php echo $language["menu-newsletters"]; ?></a>
</ul>
<h3><?php echo $language["menu-account"]; ?></h3>
<ul>
	<a href="<?php print $configuration["path-bo"] ?>/"><?php echo $language["menu-begin"]; ?></a>
	<a onclick="return confirm('Are You Sure?'))" href="<?php print $configuration["path-bo"] ?>/0/logout/"><?php echo $language["menu-logout"]; ?></a>
</ul>

<?php } ?>
