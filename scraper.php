<?php 
require 'simple_html_dom.php';
 $MyWebsite = 'http://www.peshawarhighcourt.gov.pk/PHCCMS/reportedJudgments.php?action=search';
 $html = file_get_html($MyWebsite);
echo $html;

?>
