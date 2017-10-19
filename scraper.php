<?
// This is a template for a PHP scraper on morph.io (https://morph.io)
// including some code snippets below that you should find helpful

require 'scraperwiki.php';
require 'scraperwiki/simple_html_dom.php';
for($pageloop = 1 ; $pageloop < 62; $pageloop++)
{
  $linkofpage ='http://www.cust.edu.pk/alumni/index.php?r=alumniInfo/allalumni&AlumniInfo_sort=Ref_No&ajax=alumni-info-grid&page='.$pageloop;
$page   = file_get_html($linkofpage);
  if($page)
    {
      foreach($page->find("//[@id='alumni-info-grid']/table/tbody/tr")as $items)
      {
        $sr_num =  $items->find("td",0)->plaintext;
        $reg_num =  $items->find("td",1)->plaintext;
        $name =  $items->find("td",2)->plaintext;
        $degree =  $items->find("td",3)->plaintext;
        $year =  $items->find("td",4)->plaintext;
        if($reg_num != null)
        {
   			   
$record = array( 'urlofpage' =>$linkofpage, 'sr_no' => $sr_num ,'reg_num' => $reg_num ,'name' => $name,'degree' => $degree , 'years' => $year);
  
 scraperwiki::save(array('urlofpage','sr_no','reg_num','name','degree','years'), $record);
        }
      }
    }
  }
  
  
// // Read in a page
// $html = scraperwiki::scrape("http://foo.com");
//
// // Find something on the page using css selectors
// $dom = new simple_html_dom();
// $dom->load($html);
// print_r($dom->find("table.list"));
//
// // Write out to the sqlite database using scraperwiki library
// scraperwiki::save_sqlite(array('name'), array('name' => 'susan', 'occupation' => 'software developer'));
//
// // An arbitrary query against the database
// scraperwiki::select("* from data where 'name'='peter'")

// You don't have to do things with the ScraperWiki library.
// You can use whatever libraries you want: https://morph.io/documentation/php
// All that matters is that your final data is written to an SQLite database
// called "data.sqlite" in the current working directory which has at least a table
// called "data".
?>
