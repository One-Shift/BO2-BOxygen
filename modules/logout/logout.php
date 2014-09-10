<?php
	if($logout) {
		print '<p>Session terminated with sucess.</p>';
		print "<script>goToAfter('".$configuration["path-bo"]."/', 2000);</script>";
	} else {
		print '<p>Error: Session not terminated.</p>';
	}
?>
