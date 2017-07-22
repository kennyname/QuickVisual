<?php require_once('Connections/connSQL.php'); ?>
<?php
$colname_rs2 = "-1";
if (isset($_GET['id'])) {
  $colname_rs2 = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_connSQL, $connSQL);
$query_rs2 = sprintf("SELECT * FROM order_prod a left join s_product b on a.o_id=b.pro_id WHERE a.o_id = %s", $colname_rs2);
$rs2 = mysql_query($query_rs2, $connSQL) or die(mysql_error());
$row_rs2 = mysql_fetch_assoc($rs2);
$totalRows_rs2 = mysql_num_rows($rs2);

 

 
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
   
  <table width="368" border="3" bordercolor="#000000">
    <tr>
	<?php if($row_rs2['o_checkout']=="0"){?>
      <td width="354"><p align="center" class="style2">交易完畢</p>
	  <?php }else{?>
	    <td width="354"><p align="center" class="style2">此號碼重複入場</p>
		<p align="center" class="style2">請按手機的回上頁按鈕繼續掃描</p>
	    <?php 
		
		exit;
		} ?>
      <p align="center" class="style2">請按手機的回上頁按鈕繼續掃描</p></td>
    </tr>
  </table>
  <hr />
  <table width="425" border="3" bordercolor="#000000">
    <tr>
      <td width="411"><p align="center" class="style2">交易資訊</p>
          <p align="center" class="style2"><?php echo $row_rs2['o_studios']; ?>-<?php echo $row_rs2['s_product']; ?>(<?php echo $row_rs2['o_hall']; ?>)<br />
          時段:<?php echo $row_rs2['o_items']; ?><br />
          票數:<?php echo $row_rs2['o_num']; ?>張<br />
          座位:<?php echo $row_rs2['o_position']; ?></p></td>
    </tr>
  </table>
  <p class="style1">&nbsp;</p>
</div>
<?php
mysql_select_db($database_connSQL, $connSQL);
$query_rs = sprintf("update order_prod set o_checkout='1' where o_id = '".$_GET['id']."'");
$rs = mysql_query($query_rs, $connSQL) or die(mysql_error());
?>

</body>
</html>
<?php
mysql_free_result($rs2);
?>
