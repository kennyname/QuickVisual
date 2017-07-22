<?php require_once('../Connections/easyshop.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
if($_SESSION['MM_Username']<>"admin"){
exit;
}
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO s_product_ps (s_product_ps) VALUES (%s)",
                       GetSQLValueString($_POST['ps'], "text"));

  mysqli_select_db($easyshop, $database_easyshop);
  $Result1 = mysqli_query($easyshop,$insertSQL) or die(mysql_error());

  $insertGoTo = "s_upstore_ps.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysqli_select_db($easyshop, $database_easyshop);
$query_rs = "SELECT * FROM s_product_ps ORDER BY s_product_ps ASC";
$rs = mysqli_query($easyshop,$query_rs) or die(mysql_error());
$row_rs = mysqli_fetch_assoc($rs);
$totalRows_rs = mysqli_num_rows($rs);
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>類別管理</title>
<style type="text/css">
<!--
body {
	background-image: url(../images/5.jpg);
}
.style2 {color: #FFFFFF}
.style7 {color: #000000}
.style8 {
	color: #858D82;
	font-size: 14px;
}
.style10 {font-size: 14px}
-->
</style>
</head>

<body>
<div align="center">

  <div align="center" class="style4 style7">
    <table width="100%" border="0">
      <tr>
        <td bgcolor="#9F9EA3"><div align="center" class="style2">電影類別新增</div></td>
      </tr>
    </table>
  </div>
 
  <form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
    <input name="ps" type="text" id="ps" size="10">
    <input type="submit" name="Submit" value="新增電影類別">
    <input type="hidden" name="MM_insert" value="form1">
  </form>
 
</div>
<table width="391" border="1" align="center">
  <tr>
    <td colspan="2" bgcolor="#A0A0A2"><div align="center" class="style2 style10">電影類別名稱</div>      
    <div align="center" class="style10"></div></td>
  </tr>
  <?php 
  $i=1;
  do { ?>
  <tr>
    <td width="98" bgcolor="#FFFFFF"><div align="center" class="style8"><?php echo $i;?></div></td>
    <td width="277" bgcolor="#FFFFFF"><div align="center" class="style8"><?php echo $row_rs['s_product_ps']; ?><a href="s_upstore_ps_del.php?id=<?php echo $row_rs['s_product_ps_id']; ?>">刪除類別</a></div>      <div align="center" class="style8"></div></td>
    </tr>
  <?php
  $i+=1;
   } while ($row_rs = mysqli_fetch_assoc($rs)); ?>
</table>
<div align="center"></div>
<hr>
<p align="center"><a href="s_upstore.php"><上一頁></a></p>
</body>
</html>
<?php
mysqli_free_result($rs);
?>
