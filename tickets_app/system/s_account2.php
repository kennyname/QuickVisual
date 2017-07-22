<?php require_once('../Connections/easyshop.php'); ?>
<?php
if(!isset($_SESSION)){  
   session_start();  
}  
if($_SESSION['MM_Username']<>"admin"){
exit;
};
$maxRows_rs = 50;
$pageNum_rs = 0;
if (isset($_GET['pageNum_rs'])) {
  $pageNum_rs = $_GET['pageNum_rs'];
}
$startRow_rs = $pageNum_rs * $maxRows_rs;

mysqli_select_db($easyshop, $database_easyshop);
$query_rs = "SELECT * FROM a_account ORDER BY a_account ASC";
$query_limit_rs = sprintf("%s LIMIT %d, %d", $query_rs, $startRow_rs, $maxRows_rs);
$rs = mysqli_query($easyshop,$query_limit_rs) or die(mysqli_error());
$row_rs = mysqli_fetch_assoc($rs);

if (isset($_GET['totalRows_rs'])) {
  $totalRows_rs = $_GET['totalRows_rs'];
} else {
  $all_rs = mysqli_query($easyshop,$query_rs);
  $totalRows_rs = mysqli_num_rows($all_rs);
}
$totalPages_rs = ceil($totalRows_rs/$maxRows_rs)-1;

mysqli_select_db($easyshop, $database_easyshop);
$query_rs = "SELECT * FROM a_account ORDER BY a_account ASC";
mysqli_query($easyshop,"SET NAMES 'utf-8'");
mysqli_query($easyshop,"SET CHARACTER SET 'UTF-8'");
mysqli_query($easyshop,"SET CHARACTER_SET_RESULTS='UTF-8'");
$rs = mysqli_query($easyshop,$query_rs) or die(mysql_error());
$row_rs = mysqli_fetch_assoc($rs);
$totalRows_rs = mysqli_num_rows($rs);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>會員管理</title>
<style type="text/css">
<!--
.style1 {font-size: small}
body {
	background-image: url(../jpg/5.jpg);
}
.style9 {color: #FFFFFF}
.style10 {font-size: small; color: #224948; }
.style11 {color: #F8E7ED}
.style12 {color: #812545; }
.style13 {color: #133235}
.style14 {color: #224948; }
.style16 {color: #FFFFFF; font-size: large; }
-->
</style>
</head>

<body>
<div align="center" class="style1">
  <table width="200" border="1">
    <tr>
      <td bgcolor="#0C1A1A"><div align="center"><span class="style16">會員管理 </span></div></td>
    </tr>
  </table>
  <span class="style13">
  <?php require_once('system_top.php'); ?>
  </span></span>
  <table width="100%" border="1" align="center">
    <tr bgcolor="#CCCCFF">
    <td width="119" height="20" bgcolor="#FFFFFF"><div align="left" class="style14"><span class="style7">帳號</span></div></td>
      <td width="138" bgcolor="#FFFFFF"><div align="left" class="style14"><span class="style7">密碼</span></div></td>
      <td width="217" bgcolor="#FFFFFF">點數</td>
      <td width="217" bgcolor="#FFFFFF"><div align="left" class="style10"><span class="style1">姓名</span></div></td>
      <td width="183" bgcolor="#FFFFFF"><div align="left" class="style14">電話</div></td>
      <td width="162" bgcolor="#FFFFFF">&nbsp;</td>
      <td width="78" bgcolor="#FFFFFF"><div align="left"><span class="style9"><span class="style11"><span class="style12"><span class="style14"></span></span></span></span></div></td>
    </tr>
    <?php do { ?>
      <tr>
        <td bgcolor="#FFFFFF"><div align="left" class="style14"><?php echo $row_rs['a_account']; ?></div></td>
        <td bgcolor="#FFFFFF"><div align="left" class="style14"><?php echo $row_rs['a_pass']; ?></div></td>
        <td bgcolor="#FFFFFF"><span class="style14"><?php echo $row_rs['atm']; ?></span></td>
        <td bgcolor="#FFFFFF"><div align="left" class="style14"><?php echo $row_rs['a_name']; ?></div></td>
        <td bgcolor="#FFFFFF"><div align="left" class="style14"><?php echo $row_rs['a_phone']; ?></div></td>
        <td bgcolor="#FFFFFF"><span class="style14"><a href="s_edit_account.php?id=<?php echo $row_rs['a_id']; ?>">修改與加值</a></span></td>
        <td bgcolor="#FFFFFF"><div align="left" class="style14"><a href="s_account_del.php?id=<?php echo $row_rs['a_id']; ?>" onClick="return accessSina()">刪除</a> </div></td>
      </tr>
      <?php } while ($row_rs = mysqli_fetch_assoc($rs)); ?>
  </table>
</div>
<p align="center" class="style1">
</body>
</html>
<?php
mysqli_free_result($rs);
?>
<script language="javascript">
function accessSina()
{
 if (confirm('確定要刪除?')) {
  return true;
 } else {
  return false;

  }
}
</script>
