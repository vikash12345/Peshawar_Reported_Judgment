<?php 
	require 'simple_html_dom.php';
	$MyWebsite = 'http://www.peshawarhighcourt.gov.pk/PHCCMS/reportedJudgments.php?action=search';
	$html = file_get_html($MyWebsite);
	echo $html;
	foreach($html->find(".employee_list thead tbody tr") as $element)		
	{
			echo $name = $element->find("//*[@id='employee_list']/tbody[1]/tr/td[1]")->plaintext;
			'<br/>';
	}	
?>

