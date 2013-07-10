<?php
/************************************************************************/
/* PHP-NUKE: ماژول پرداخت حق اشتراک زرین پال                            */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2005 by Hamed.Ramzi                        	        */
/* http://www.aryan-translators.ir                                      */
/*                                                                      */
/************************************************************************/

if (!preg_match("/modules.php/", "$_SERVER[PHP_SELF]")) { die ("Access Denied"); }

$module_name = basename(dirname(__FILE__));
require_once("mainfile.php");

$index = 0;
$web = 'http://'.$_SERVER['SERVER_NAME'];

function s_success() {
	global $user, $cookie, $user_prefix, $module_name, $gfx_chk, $prefix, $db, $sitename;

    include("header.php");
    OpenTable();

	if(paid())
	{
			cookiedecode($user);
			$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_subscriptions WHERE userid='$cookie[0]'"));

			$expire = (60*60*24*365) + $row[subscription_expire];
			$db->sql_query("UPDATE ".$prefix."_subscriptions SET subscription_expire='$expire' WHERE userid='$cookie[0]'");
	}
	else
	{
			cookiedecode($user);
			$expire = 31536000;
			$expire = $expire+time();
			$db->sql_query("INSERT INTO ".$prefix."_subscriptions VALUES (NULL, '$cookie[0]', '$expire')");
	}
	

	/* نمایش پیام تایید به کاربر */

	echo "<h2>$sitename اطلاعات اشتراک:</h2><p>تایید اطلاعات پرداخت صورت گرفت</p>"
		 ."\n<p>در حال حاضر شما به تمام قسمتهای سایت دسترسی خواهید داشت</p>";
	
    CloseTable();
    include("footer.php");
}



function s_failure() {
    global $module_name, $prefix, $db, $sitename;
    include("header.php");
    OpenTable();

	/* نمایش پیام عدم تایید پرداخت به کاربر */

	echo "<h2>$sitename اطلاعات اشتراک:</h2><blockquote>متاسفانه: اطلاعات پرداخت صحیح نمیباشد"
		 ."<br><br><a href=\"/\">بازگشت به صفحه اصلی</a></blockquote>";

    CloseTable();
    include("footer.php");
}

function Subscriptions() {
global  $admin, $user, $banners, $sitename, $slogan, $cookie, $prefix, $db, $nukeurl, $anonymous;
cookiedecode($user);
$username = $cookie[1];
if ($username == "") {
	$username = "Anonymous";
}
$USERNAME = $username;

    include("header.php");
    OpenTable();
	$web = 'http://'.$_SERVER['SERVER_NAME'];

if(paid())
{
	echo("<p><strong><font color=\"red\">توجه: شما در حال حاضر مشترک $sitename میباشید! اگر شما مجدد انجام دهید 1 سال به اشتراک شما اضافه خواهد شد!</font></strong></p>");
}

	/* نمایش مطالب در حال پردازش برای ثبت نام */
echo("");
	
	/* فرم ارسال اطلاعات زرین پال */
	/* هر گونه تغییر در این کدها با مسئولیت خود شماست و شما فقط نیازمند تغییر مرچنت کد و قیمت هستید */
echo("<table border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"0\">"
	."\n  <tr> "
	."\n    <td><div align=\"center\">حمایت از سایت $sitename</div></td>"
	."\n  </tr>"
	."\n  <tr> "
	."\n    <td><form action=\"zarinpal.php\" method=\"post\">"
	."\n        <div align=\"center\"> "
	."\n          <input type=\"hidden\" name=\"merchant\" value=\"XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX\">"
	."\n          <input type=\"hidden\" name=\"item_name\" value=\"حمایت از سایت $sitename\">"
	."\n          <div class=\"fname\"><label for=\"lname\"><span style=\"color: rgb(0, 0, 205);\">مبلغ حمايت</span> : </label>"
	."\n          <input type=\"text\" name=\"amount\" value=\"\"> مبلع به تومان</div>"
    ."\n          <input type=\"text\" name=\"mail\" value=\"\"> ایمیل </div>"
	."\n          <input type=\"text\" name=\"tel\" value=\"\"> تلفن همراه</div>"
	."\n          <input type=\"hidden\" name=\"user\" value=\"" . $USERNAME . "\">"
	."\n          <input type=\"hidden\" name=\"callback_url\" value=\"" . $web . "/verify.php\">"
	."\n		  <input type=\"submit\" name=\"submit\" value=\"پرداخت\" target=\"blank\">"
	."\n        </div>"
	."\n      </form></td>"
	."\n  </tr>"
	."\n</table><link rel=\"stylesheet\" type=\"text/css\" href=\"" . $web . "/themes/css/hemayat.css\" />"
	."\n<table border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"0\" width=\"100%\">"
	."\n  <tr> "
	."\n    <td><div align=\"center\"><h2>حامیان سایت " . $sitename . "</h2></div></td></tr><br />"
	."\n    <tr><td width=\"100%\"><iframe src=\"hamiyan.php\" width=\"100%\" height=\"500px\" border=\"0\"></iframe></td>"
	."\n  </tr>"
	."\n </table>");
	
    CloseTable();
    include("footer.php");
}



switch($func) {
    case "pplvv":
    s_success();
    break;

    case "pplnv":
    s_failure();
    break;     
	
	default:
    Subscriptions();
    break;
}
?>