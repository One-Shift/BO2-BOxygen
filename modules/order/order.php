<div class="orders">
	<?php
	if ($a != null) {
		switch ($a) {
			case "answer": include "modules/order/answer.php";
				break;
			default: include "modules/order/list.php";
		}
	} else {
		include "modules/order/list.php";
	}
	?>
</div>
