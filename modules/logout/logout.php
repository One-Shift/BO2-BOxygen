<h1 class="pageTitle">Logout</h1>
<?php
	if ($logout) {
		print $language["actions"]["success"];
		printf("<script>goToAfter('%s', 2000);</script>", $configuration["path-bo"]);
	} else {
		print $language["actions"]["failure"];
	}
