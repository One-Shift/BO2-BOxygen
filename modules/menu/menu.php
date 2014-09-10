<?php if ($account["login"]){ ?>
<ul>
	<li onclick="goTo('<?= $configuration["path-bo"] ?>/user-list/');"><?php echo $language["menu-users"]; ?></li>
	<li onclick="goTo('<?= $configuration["path-bo"] ?>/category-list/');"><?php echo $language["menu-categories"]; ?></li>
	<li onclick="goTo('<?= $configuration["path-bo"] ?>/article-list/');"><?php echo $language["menu-articles"]; ?></li>
	<!--li onclick="goTo('<?= $configuration["path-bo"] ?>/archive/');">Archive (Soon)</li-->
	<li onclick="goTo('<?= $configuration["path-bo"] ?>/product-list/');"><?php echo $language["menu-products"]; ?></li>
	<li onclick="goTo('<?= $configuration["path-bo"] ?>/newsletters/');"><?php echo $language["menu-newsletters"]; ?></li>
</ul>
<h3><?php echo $language["menu-account"]; ?></h3>
<ul>
	<li onclick="goTo('<?= $configuration["path-bo"] ?>');"><?php echo $language["menu-begin"]; ?></li>
	<li onclick="if (confirm('Are You Sure?')) {goTo('./backoffice/logout/');}"><?php echo $language["menu-logout"]; ?></li>
</ul>

<?php } ?>
