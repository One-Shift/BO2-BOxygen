<?php
	$object_orders = new orders();
	$orders_list = $object_orders->returnAllOrders();
?>
<h1 class="pageTitle">Lista de Encomendas</h1>
<div class="button-area">
	<a href="<?php print $configuration["path-bo"] ?>/0/orders/0/list" class="green"><i class="fa fa-plus"></i></a>	
</div>
<table class="db-list">
	<tr>
		<th>#</th>
		<th>Utilizador</th>
		<th>Data</th>
		<th>Estado</th>
		<th>Sel.</th>
	</tr>
	<?php
	foreach ($orders_list as $order) {
		if ($order['status']) {
			$published = '<img src="' . $configuration["path-bo"] . '/site-assets/images/icon_on.png" alt="on" />';
		} else {
			$published = '<img src="' . $configuration["path-bo"] . '/site-assets/images/icon_off.png" alt="off" />';
		}
		
		$object_user = new user();
		$object_user->setId($order['user_id']);
		$user = $object_user->returnOneUser();
		
		print
				'<tr>' .
				'<td>' . $order['id'] . '</td>' .
				'<td>' . $user["name"] . '</td>' .
				'<td>' . $order['date_update'] . '</td>' .
				'<td>' . $published . '</td>' .
				'<td>'
			. '<a href="' . $configuration["path-bo"] . '/0/orders/' . $order['id'] . '/answer" onclick="return confirm(\'' . $language["template"]["are-you-sure"] . '\')" class="orange"><i class="fa fa-eye"></i></a> '
			. '<a href="' . $configuration["path-bo"] . '/0/orders/' . $order['id'] . '/disable" onclick="return confirm(\'' . $language["template"]["are-you-sure"] . '\')" class="red"><i class="fa fa-trash"></i></a></td>' .
				'</tr>';
	}
	?>
</table>

<div class="button-area">
	<a href="<?php print $configuration["path-bo"] ?>/0/orders/0/list" class="green"><i class="fa fa-plus"></i></a>
</div>