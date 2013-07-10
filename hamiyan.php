<?php

require_once("mainfile.php");
require_once("config.php");
require_once("includes/sql_layer.php");
require_once("db/db.php");

header("Content-Type: text/xml");
$asc = false;
error_reporting(E_ALL & ~E_NOTICE);

$actiontemplates = array();

$result = $db->sql_query("SELECT * FROM hemayat ORDER BY id DESC");
$itemcount = 10;
$items = array();

while ($thread = mysql_fetch_array($result)){

   $threadfilename = $thread['user'];
   $lastmod = $thread['date'];
   $cost = $thread['cost'];
   $item2 = $thread['item'];
   $nom = $thread['id'];
   $items[$itemcount] = Array('nom'=>$nom,'loc'=>$threadfilename,'lastmod'=>$lastmod,'priority'=>$cost,'changefreq'=>$item2);
   $itemcount++;

   $log = Array(
	'a' => $loga,
 	'b' => $logv
	);

}

echo<<<END
<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="hamiyan.xsl"?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
 xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
 xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
END;

foreach($items AS $item){
   echo "\t<url>\r\n";
   echo "\t\t<nom>".$item['nom']."</nom>\r\n";
   echo "\t\t<loc>".$item['loc']."</loc>\r\n";
   echo "\t\t<priority>".$item['priority']." تومان</priority>\r\n";
   echo "\t\t<lastmod>".$item['lastmod']."</lastmod>\r\n";
   echo "\t\t<changefreq>".$item['changefreq']."</changefreq>\r\n";
   echo "\t</url>\r\n";
}

if($query->max_num_pages > 1){
echo '<div>';
get_paged_navigation();
echo '</div>';
}


?>
</urlset>