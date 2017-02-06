<?php
	include "simple_html_dom.php";
	$MyWebsite = ("http://web.archive.org/web/20140824112027/http://www.peshawarhighcourt.gov.pk/PHCCMS/reportedJudgments.php?action=search");
 	 $html  = file_get_html($MyWebsite);
	echo $html;
  ?>
