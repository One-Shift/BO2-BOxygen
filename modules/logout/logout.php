<h1 class="pageTitle">Logout</h1>
<?php
	if($logout) {
		print '<p>Session terminated with success.</p>';
		print "<script>goToAfter('".$configuration["path-bo"]."/', 2000);</script>";
	} else {
		print '<p>Error: Session not terminated.</p>';
	}
