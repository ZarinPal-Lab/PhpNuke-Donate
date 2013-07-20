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

	$merchantID = $_POST['merchant'];
	$amount = $_POST['amount'];
	$callBackUrl = $_POST['callback_url'];
	$users = $_POST['user'];
	$item = $_POST['item_name'];
	$mail = $_POST['mail'];
	$tel = $_POST['tel'];
	
	$client = new SoapClient('https://de.zarinpal.com/pg/services/WebGate/wsdl', array('encoding'=>'UTF-8'));
	$res = $client->PaymentRequest(
	array(
					'MerchantID' 	=> $merchantID ,
					'Amount' 		=> $amount ,
					'Description' 	=> $item ,
					'Email' 		=> $mail ,
					'Mobile' 		=> $tel ,
					'CallbackURL' 	=> $callBackUrl
					)
	);
	if($res->Status == 100)
	{
	mysql_connect($server,$username,$password);
	@mysql_select_db($dbname) or die("Unable to select database");
	$query = "INSERT INTO `hemayatverify` (`id`, `user`, `res`, `amount`, `merchant`, `item`, `date`) VALUES ('', '$users', '$res', '$amount', '$merchantID', '$item', NOW())";
	mysql_query($query);
	mysql_close();
	//Redirect to URL You can do it also by creating a form
	Header('Location: https://www.zarinpal.com/pg/StartPay/' . $res->Authority);
	}else{
	echo $res->Status;
	return false;
	}
?>
