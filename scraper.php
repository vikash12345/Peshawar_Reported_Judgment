<?php 
require 'simple_html_dom.php';
 $MyWebsite = 'http://www.peshawarhighcourt.gov.pk/PHCCMS/reportedJudgments.php?action=search';
 $html = file_get_html($MyWebsite);
//This is for Remarks
echo $html->find("//*[@id='employee_list']/tbody/tr[1]/td[2]", 0)


?>
