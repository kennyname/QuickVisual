<?php require_once('Connections/connSQL.php'); ?>
<?php
 
mysql_select_db($database_connSQL, $connSQL);
$query_rs = sprintf("update order_prod set o_checkout='1' where o_id = '".$_GET['id']."'");
$rs = mysql_query($query_rs, $connSQL) or die(mysql_error());
 
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<style type="text/css">
<!--
.style1 {font-size: x-large}
.style2 {font-size: xx-large; }
-->
</style>
</head>

<body>
<div align="center">
  <p>&nbsp;</p>
  <p>&nbsp; </p>
  <table width="368" border="3" bordercolor="#000000">
    <tr>
      <td width="354"><p align="center" class="style2">交易完畢</p>
      <p align="center" class="style2">請按手機的回上頁按鈕繼續掃描</p></td>
    </tr>
  </table>
  <p class="style1">&nbsp;</p>
</div>
</body>
</html>
