

	<?php
	
	 require 'simple_html_dom.php';

 $cHeadres = array(
      'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
      'Accept-Language: en-US,en;q=0.5',
      'Connection: Keep-Alive',
      'Pragma: no-cache',
      'Cache-Control: no-cache'
     );

 $MyWebsite = 'http://www.peshawarhighcourt.gov.pk/PHCCMS/reportedJudgments.php?action=search';

 function dlPage($href) {
  global $cHeadres;

  $ch = curl_init();
  if($ch){
   curl_setopt($ch, CURLOPT_URL, $href);
   curl_setopt($ch, CURLOPT_HTTPHEADER, $cHeadres);
   curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
   curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
   curl_setopt($ch, CURLOPT_HEADER, false);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
   curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)");
   $str = curl_exec($ch);
   curl_close($ch);

   $dom = new simple_html_dom();
   $dom->load($str);
   return $dom;
  }
 }

 $maincode = dlPage($MyWebsite);
 
 
 

 foreach($maincode->find("//*[@id='employee_list']/tbody[1]/tr") as $element) 
 {
   $number = $element->find("td", 0)->plaintext;
   $case = $element->find("td", 1)->plaintext;
   $remark = $element->find("td", 2)->plaintext;
   $citation = $element->find("td", 3)->plaintext;
   $desdate = $element->find("td", 4)->plaintext;
   $scstatus = $element->find("td", 5)->plaintext;
   $cat = $element->find("td", 6)->plaintext;
   $pdflink = $element->find(".//td/a", 0)->href;
  
  // echo  $number . ' -->' . $case . ' -->' . $remark . ' -->' . $citation . ' -->' . $desdate . ' -->' . $scstatus.  '-->'. $cat .'-->'.$pdflink;	
  // echo '<br\>';
 } 
 
 
 



$db = new PDO('sqlite:data.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {
  $db->query('CREATE TABLE data(
    case VARCHAR(200),
    number VARCHAR(100),
    remark VARCHAR(200),
    citation VARCHAR(200),
    desdate VARCHAR(200),
    scstatus VARCHAR(200),
    cat VARCHAR(200),
    pdflink VARCHAR(200),
    PRIMARY KEY (case))');
} catch (Exception $e) {
}
$articles = array(array('case' => '$case', 'number' => '$number', 'remark' => '$remark', 'citation' => '$citation' , 'desdate' =>'$desdate','scstatus' => '$scstatus', 'cat' => '$cat', 'pdflink' => '$pdflink'));
foreach ($articles as $article) {
  $exists = $db->query("SELECT * FROM data Where case = $case");
  if (!$exists) {
    $sql = "INSERT INTO data(case,number,remark,citation,desdate,scstatus,cat,pdflink) VALUES($case,$number,$remark,$citation,$desdate,$scstatus,$cat,$pdflink)";
  } 
    $statement = $db->prepare($sql);
    $statement->execute(array(
    ':$case' => $article['case'], 
    ':$number' => $article['number'],
    ':$remark' => $article['remark'],
    ':$citation' => $article['citation'],
    ':$desdate' => $article['desdate'],
    ':$scstatus' => $article['scstatus'],
    ':$cat' => $article['cat'],
    ':$pdflink' => $article['pdflink'],
    
  ));
}


 
 ?>
