﻿
<?php require_once('../Connections/easyshop.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rs = 100;
$pageNum_rs = 0;
if (isset($_GET['pageNum_rs'])) {
  $pageNum_rs = $_GET['pageNum_rs'];
}
$startRow_rs = $pageNum_rs * $maxRows_rs;

mysqli_select_db($easyshop, $database_easyshop);
$query_rs = "SELECT * FROM s_product ORDER BY kg asc,lcd desc";
$query_limit_rs = sprintf("%s LIMIT %d, %d", $query_rs, $startRow_rs, $maxRows_rs);
$rs = mysqli_query($easyshop,$query_limit_rs) or die(mysql_error());
$row_rs = mysqli_fetch_assoc($rs);

if (isset($_GET['totalRows_rs'])) {
  $totalRows_rs = $_GET['totalRows_rs'];
} else {
  $all_rs = mysqli_query($easyshop,$query_rs);
  $totalRows_rs = mysqli_num_rows($all_rs);
}
$totalPages_rs = ceil($totalRows_rs/$maxRows_rs)-1;

mysqli_select_db($easyshop, $database_easyshop);
$query_rs2 = "SELECT * FROM s_product_ps ORDER BY s_product_ps ASC";
$rs2 = mysqli_query($easyshop,$query_rs2) or die(mysql_error());
$row_rs2 = mysqli_fetch_assoc($rs2);
$totalRows_rs2 = mysqli_num_rows($rs2);

$queryString_rs = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rs") == false && 
        stristr($param, "totalRows_rs") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rs = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rs = sprintf("&totalRows_rs=%d%s", $totalRows_rs, $queryString_rs);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">
<!--
.style1 {font-size: small}
.style5 {color: #FFFFFF; font-weight: bold; }
body {
	background-image: url(../jpg/5.jpg);
}
.style8 {color: #8A6606}
.style17 {color: #FFFFFF}
.style19 {font-size: small; color: #993F00; }
.style20 {color: #000000}
.style21 {font-size: 12px}
.style22 {color: #993F00}
.style30 {font-size: small; color: #050505; }
.style34 {color: #0C0C0C}
.style35 {color: #0E0E0E}
.style36 {font-family: "新細明體"}
.style37 {font-size: small; font-family: "新細明體"; }
.style38 {color: #FFFFFF; font-size: small;}
-->
</style>
</head>

<body>
<div align="center" class="style8">
  <table width="51%" border="0">
    <tr>
      <td bgcolor="#000000"><div align="center" class="style5">

電影資訊管理</div></td>
    </tr>
  </table>
</div>
<div align="center">
  <?php do { ?>
   <a href="s_upstore_deld.php?p=<?php echo urlencode($row_rs2['s_product_ps']); ?>" class="style20"><?php echo ($row_rs2['s_product_ps']); ?></a>
  <?php } while ($row_rs2 = mysqli_fetch_assoc($rs2)); ?><br>
</div>
<table width="100%" border="1" align="center">
  <tr>
    <td width="41" bgcolor="#0A0A0A"><div align="center" class="style36"><span class="style1 style17">NO</span></div></td>
    <td width="144" bgcolor="#0A0A0A"><div align="center" class="style36"><span class="style1 style17">圖片</span></div></td>
    <td width="115" bgcolor="#0A0A0A"><div align="center" class="style37">
      <div align="center"><span class="style17">電影資訊</span></div>
    </div></td>
    <td width="174" bgcolor="#0A0A0A"><div align="center" class="style1 style36 style17">
      <div align="center">類別</div>
    </div></td>
    <td width="266" bgcolor="#0A0A0A"><div align="center" class="style36"><span class="style1 style17">電影名稱</span></div></td>
    <td width="198" bgcolor="#0A0A0A"><div align="center" class="style36"><span class="style38">上映日期</span></div></td>
    <td width="345" bgcolor="#0A0A0A"><div align="center" class="style1 style36 style17">
      <div align="center"><span class="style17">主演</span></div>
    </div></td>
    <td width="63" bgcolor="#0A0A0A"><span class="style17"></span></td>
  </tr>
  <?php
  $i=1;
   do { ?>
  <tr>
    <td bgcolor="#FFFFFF"><div align="center" class="style37">
      <div align="center"><span class="style22"><?php echo $i;?></span></div>
    </div></td>
    <td bgcolor="#FFFFFF"><div align="center" class="style37">
      <div align="center"><span class="style22"><a href="photo.php?p=<?php echo $row_rs['s_file']; ?>" target="_blank"><img src="store_photo/<?php echo $row_rs['s_file']; ?>" width="120" height="114" border="0" /></a></span></div>
    </div></td>
    <td bgcolor="#FFFFFF"><div align="center" class="style37">
      <div align="center"><span class="style34"><?php echo $row_rs['kg']; ?></span></div>
    </div></td>
    <td bgcolor="#FFFFFF"><div align="center" class="style37">
      <div align="center"><span class="style35"><?php echo $row_rs['s_ps']; ?></span></div>
    </div></td>
    <td bgcolor="#FFFFFF"><div align="center" class="style36"><span class="style30"><?php echo $row_rs['s_product']; ?></span></div></td>
    <td bgcolor="#FFFFFF"><div align="center"><span class="style1"><span class="style36"></span></span>
      <div align="center" class="style36"><span class="style30"><?php echo $row_rs['lcd']; ?></span></div>
    </div></td>
    <td bgcolor="#FFFFFF"><div align="center"><span class="style1"><span class="style36"></span></span>
      <div align="center" class="style36"><span class="style30"><?php echo $row_rs['cpu']; ?></span></div>
    </div></td>
    <td bgcolor="#FFFFFF"><span class="style19"><a href="s_edit_upstore.php?id=<?php echo $row_rs['pro_id']; ?>">編輯</a><br /> 
      <a href="s_upstore_del2.php?id=<?php echo $row_rs['pro_id']; ?>">刪除</a></span></td>
  </tr>
  <?php
  $i+=1;
   } while ($row_rs = mysqli_fetch_assoc($rs)); ?>
</table>
<div align="center"><br>
  <span class="style21">
  <?php // echo ($startRow_rs + 1) ?>
  <?php  //echo min($startRow_rs + $maxRows_rs, $totalRows_rs) ?> 
有 <?php echo $totalRows_rs ?>筆</span><br>
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_rs > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, 0, $queryString_rs); ?>">first</a>
        <?php } // Show if not first page ?>
      </td>
      <td width="31%" align="center"><?php if ($pageNum_rs > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, max(0, $pageNum_rs - 1), $queryString_rs); ?>">up</a>
        <?php } // Show if not first page ?>
      </td>
      <td width="23%" align="center"><?php if ($pageNum_rs < $totalPages_rs) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, min($totalPages_rs, $pageNum_rs + 1), $queryString_rs); ?>">down</a>
        <?php } // Show if not last page ?>
      </td>
      <td width="23%" align="center"><?php if ($pageNum_rs < $totalPages_rs) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, $totalPages_rs, $queryString_rs); ?>">old page</a>
        <?php } // Show if not last page ?>
      </td>
    </tr>
  </table>
  <p><a href="s_upstore.php"></a></p>
</div>
</body>
</html>
<?php
mysqli_free_result($rs);

mysqli_free_result($rs2);
?>

