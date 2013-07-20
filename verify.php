<?php
require_once("mainfile.php");
$index = 0;
require_once("config.php");
global $module_name, $prefix, $db, $sitename, $cookie, $user, $admin_file, $gname;
$web='http://'.$_SERVER['SERVER_NAME'];
$server = $dbhost;
$username = $dbuname;
$password = $dbpass;
$dbname = $dbname;
mysql_connect($server,$username,$password);
@mysql_select_db($dbname) or die("Unable to select database");


$au = $_GET['Authority'];

$check2 = mysql_query("SELECT * FROM `hemayatverify` WHERE `res`='$au'");
$check = mysql_fetch_object($check2);
$amount = $check->amount;
$merchant = $check->merchant;
$user = $check->user;
$item = $check->item;

$result = mysql_query("SELECT * FROM `hemayat` WHERE `refID`='$au'");
if (mysql_num_rows($result) == 1 ){
echo '<meta http-equiv="refresh" content="5;URL='.$web.'"><div><center><font color="black" size="5px"><b>متاسفانه این شناسه حمایت از قبل ثبت شده میباشد.</b><font></div>';
}
else
{
if ($_GET['Status'] == "OK" ){


$client = new SoapClient('https://de.zarinpal.com/pg/services/WebGate/wsdl', array('encoding'=>'UTF-8'));
$res = $client->PaymentVerification(
			array(
				'MerchantID'	 => $merchant ,
				'Authority' 	 => $au ,
				'Amount'		 => $amount
				)
);

if($res->Status == 100){
mysql_query("INSERT INTO `hemayat` (`id`, `user`, `cost`, `refID`, `item`, `date`) VALUES ('', '$user', '$amount', '$au', '$item', NOW())");
echo '<meta http-equiv="refresh" content="5;URL='.$web.'/modules.php?name=Subscriptions"><div><center><font color="black" size="5px"><b>با تشکر از بابت حمایت سایت ما اکنون به صفحه حمایت از سایت هدایت خواهید شد<br />نام شما در لیست حامیان سایت قرار گرفت.</b><font></div>';
}
}else {
echo '<meta http-equiv="refresh" content="5;URL='.$web.'"><div><center><font color="black" size="5px"><b>پرداخت کنسل شده است </b><font></div>';
}
mysql_close();

?>
