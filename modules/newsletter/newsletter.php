<?php
// enable && disable
switch ($pg) {
	case "newsletters-enable":
		$object_newsletters = new newsletters();
		$object_newsletters->setId($id);
		$object_newsletters->enable();
		break;
	case "newsletters-disable":
		$object_newsletters = new newsletters();
		$object_newsletters->setId($id);
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
		<a href="<?= $configuration["path-bo"] ?>/0/newsletter-export/" class="grey" title="export"><i class="fa fa-download"></i></a>
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
		foreach ($newsletters_list as $newsletter_entry) {
			if ($newsletter_entry["active"]) {
				$active = "<img src=\"{c2r-path-bo}/site-assets/images/icon_on.png\" alt=\"on\" />";
			} else {
				$active = "<img src=\"{c2r-path-bo}/site-assets/images/icon_off.png\" alt=\"off\" />";
			}

			print str_replace(
				array(
					"{c2r-date}",
					"{c2r-id}",
					"{c2r-email}",
					"{c2r-code}",
					"{c2r-active}",
					"{c2r-path-bo}"
				),
				array(
					$newsletter_entry['date'],
					$newsletter_entry['id'],
					$newsletter_entry['email'],
					$newsletter_entry['code'],
					$active,
					$configuration["path-bo"]
				),
				file_get_contents("./modules/newsletters/templates-e/line.html")
			);
		}
		?>
	</table>

	<div class="button-area">
		<a href="<?= $configuration["path-bo"] ?>/0/newsletter-export/" class="grey" title="export"><i class="fa fa-download"></i></a>
	</div>
</div>
