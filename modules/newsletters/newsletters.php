 <?php
	// enable && disable
	switch ($pg) {
		case "newsletters-enable":
			$object_newsletters = new newsletters();
			$object_newsletters->setId(intval($_GET["i"]));
			$object_newsletters->enable();
			break;
		case "newsletters-disable":
			$object_newsletters = new newsletters();
			$object_newsletters->setId(intval($_GET["i"]));
			$object_newsletters->disable();
			break;
	}

	// get list
	$object_newsletters = new newsletters();
	$newsletters_list = $object_newsletters->returnAllregistries();
?>
<h1 class="pageTitle">Newsletter Subscriptions</h1>
<div class="category-list">
	<div class="button-area">
		<a href="<?php print $configuration["path-bo"] ?>/0/newsletters-export/" class="grey" title="export"><i class="fa fa-download"></i></a>
	</div>

	<table class="db-list">
		<tr>
			<th>#</th>
			<th>Email</th>
			<th>Code</th>
			<th>Stat.</th>
			<th>Sel.</th>
		</tr>
		<?php
			foreach($newsletters_list as $newsletter_entry){
				if ($newsletter_entry['active']) {
					$active = '<img src="'.$configuration["path-bo"].'/site-assets/images/icon_on.png" alt="on" />';
				} else {
					$active = '<img src="'.$configuration["path-bo"].'/site-assets/images/icon_off.png" alt="off" />';
				}

				print
				'<tr title="'.$newsletter_entry['date'].'">'.
				'<td>'.$newsletter_entry['id'].'</td>'.
				'<td>'.$newsletter_entry['email'].'</td>'.
				'<td>'.$newsletter_entry['code'].'</td>'.
				'<td>'.$active.'</td>'.
				'<td>'.
					'<a href="'.$configuration["path-bo"].'/0/newsletters-enable/'.$newsletter_entry['id'].'" class="green" title="enable"><i class="fa fa-check-circle-o"></i></a> '.
					'<a href="'.$configuration["path-bo"].'/0/newsletters-disable/'.$newsletter_entry['id'].'" class="red" title="disable"><i class="fa fa-circle-o"></i></i></a>'.
				'</td>'.
				'</tr>';

			}
		?>
	</table>

	<div class="button-area">
		<a href="<?php print $configuration["path-bo"] ?>/0/newsletters-export/" class="grey" title="export"><i class="fa fa-download"></i></a>
	</div>
</div>
