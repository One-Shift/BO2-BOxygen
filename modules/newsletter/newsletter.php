<?php
// enable && disable
switch ($pg) {
	case "newsletters-enable":
		$object_newsletters = new newsletter();
		$object_newsletters->setId($id);
		$object_newsletters->enable();
		break;
	case "newsletters-disable":
		$object_newsletters = new newsletter();
		$object_newsletters->setId($id);
		$object_newsletters->disable();
		break;
}

// get list
$object_newsletters = new newsletter();
$newsletters_list = $object_newsletters->returnAllregistries();
?>
<h1 class="pageTitle">Newsletter Subscriptions</h1>
<div class="category-list">
	<div class="button-area">
		<a href="<?= $configuration["path-bo"] ?>/0/newsletter/0/export" class="grey" title="export"><i class="fa fa-download"></i></a>
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
		if (count($vcard_list) != 0) {
			$line = file_get_contents("modules/newsletters/templates-e/line.html");

			foreach ($newsletters_list as $newsletter_entry) {
				if ($newsletter_entry["active"]) {
					$active = "<i class=\"fa fa-check-circle\"></i>";
				} else {
					$active = "<i class=\"fa fa-circle\"></i>";
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
						$newsletter_entry["date"],
						$newsletter_entry["id"],
						$newsletter_entry["email"],
						$newsletter_entry["code"],
						$active,
						$configuration["path-bo"]
					),
					$line
				);
			}
		} else {
			print str_replace(
				"{c2r-noresults}",
				$language["template"]["noresults"],
				$line_noresult
			);
		}
		?>
	</table>

	<div class="button-area">
		<a href="<?= $configuration["path-bo"] ?>/0/newsletter/0/export" class="grey" title="export"><i class="fa fa-download"></i></a>
	</div>
</div>
