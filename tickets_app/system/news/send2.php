<?php require_once('../../Connections/easyshop.php'); ?>
<?php
$colname_news = "-1";
if (isset($_GET['id'])) {
  $colname_news = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_easyshop, $easyshop);
$query_news = sprintf("SELECT * FROM news4 WHERE n_id = %s", $colname_news);
$news = mysql_query($query_news, $easyshop) or die(mysql_error());
$row_news = mysql_fetch_assoc($news);
$totalRows_news = mysql_num_rows($news);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>
<div align="center">
  <p>&nbsp;</p>
  <p><?php
  for ($i=0;$i<=1000;$i++){
  if($_GET['chk'][$i]){ 
  
 //echo  $_GET['chk'][$i];
 $arr= split(",",$_GET['chk'][$i]);
//echo $arr[0].$arr[1];
 //-----------------------------------------
 
 	$my_mail=$arr[1];
$subject="電子報";
$extra = "From: jarrys2@gmail.com\r\nReply-To: jarrys2@gmail.com\r\n";
$message=$row_news['n_news']."\r\n"."\r\n".$row_news['n_title']."\r\n"."\r\n".str_replace("<br />"," ",$row_news['n_text'])."\r\n";
 //echo  str_replace("<br />"," ",$row_news['n_text'])  <br />
mail($my_mail,$subject,$message,$extra); 
 
 //-----------------------------------------

 
  }
 }
  ?></p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>發送完畢</p>
  <p><a href="sys_news.php">回電子報</a></p>
</div>
</body>
</html>
<?php
mysql_free_result($news);
?>
