<?php

if (!preg_match("/block-Subscription.php/", "$_SERVER[PHP_SELF]")) { 
	Header("Location: index.php");
	die();
}


global $prefix, $db, $sitename, $subscription_url, $user, $cookie;

if (paid()) {
	cookiedecode($user);
	$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_subscriptions WHERE userid='$cookie[0]'"));
	if ($subscription_url != "") {
		$content = "<center>"._YOUARE." <a href='$subscription_url'>"._SUBSCRIBER." #".$row['id']."</a> "._OF." $sitename<br>";
	} else {
		$content = "<center>"._YOUARE." "._SUBSCRIBER." "._OF." $sitename<br>";
	}
	$diff = $row[subscription_expire]-time();
	$yearDiff = floor($diff/60/60/24/365);
	$diff -= $yearDiff*60*60*24*365;
	if ($yearDiff < 1) {
		$diff = $row[subscription_expire]-time();
	}
	$daysDiff = floor($diff/60/60/24);
	$diff -= $daysDiff*60*60*24;
	$hrsDiff = floor($diff/60/60);
	$diff -= $hrsDiff*60*60;
	$minsDiff = floor($diff/60);
	$diff -= $minsDiff*60;
	$secsDiff = $diff;
	if ($yearDiff < 1) {
		$rest = "$daysDiff "._SBDAYS."<br>$hrsDiff "._SBHOURS."<br>$minsDiff "._SBMINUTES."<br>$secsDiff "._SBSECONDS."";
	} elseif ($yearDiff == 1) {
		$rest = "$yearDiff "._SBYEAR."<br>$daysDiff "._SBDAYS."<br>$hrsDiff "._SBHOURS."<br>$minsDiff "._SBMINUTES."<br>$secsDiff "._SBSECONDS."";
	} elseif ($yearDiff > 1) {
		$rest = "$yearDiff "._SBYEARS."<br>$daysDiff "._SBDAYS."<br>$hrsDiff "._SBHOURS."<br>$minsDiff "._SBMINUTES."<br>$secsDiff "._SBSECONDS."";
	}
	$content .= "<br><b>"._SUBEXPIREIN."<br><br><font color='#FF0000'>$rest</font></b></center>";
} else {
	$content = "<center>"._NOTSUB." $sitename. "._SUBFROM." <a href='$subscription_url'>"._HERE."</a> "._NOW."";
}

?>