<?php require_once('../Connections/easyshop.php'); ?>
<?php
if(!isset($_SESSION)){  
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
//---------------------------------------

$uploaddir = '';
$uploadfile = $uploaddir.basename($_FILES['myfile']['name']);
(move_uploaded_file($_FILES['myfile']['tmp_name'], "store_photo/".$uploadfile));
//---------------------------------------

  $insertSQL = sprintf("INSERT INTO s_product (lcd,cpu,kg,s_file,s_product, s_ps, s_money_old, s_money, s_text) VALUES (%s, %s,%s, %s, %s, %s, %s, %s, %s)",
    GetSQLValueString($_POST['lcd'], "text"),
  GetSQLValueString($_POST['cpu'], "text"),
   GetSQLValueString($_POST['kg'], "text"),
  GetSQLValueString($_FILES['myfile']['name'], "text"),
                       GetSQLValueString($_POST['s_product'], "text"),
                       GetSQLValueString($_POST['s_ps'], "text"),
                       GetSQLValueString($_POST['s_money_old'], "text"),
                       GetSQLValueString($_POST['s_money'], "text"),
                       GetSQLValueString(nl2br($_POST['s_text']), "text"));

  mysqli_select_db($easyshop, $database_easyshop);
  $Result1 = mysqli_query($easyshop,$insertSQL) or die(mysql_error());

  $insertGoTo = "s_upstore3.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO s_product_ps (s_product_ps) VALUES (%s)",
                       GetSQLValueString($_POST['ps'], "text"));

  mysqli_select_db($easyshop, $database_easyshop);

  $Result1 = mysqli_query($easyshop,$insertSQL) or die(mysql_error());

  $insertGoTo = "s_upstore.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysqli_select_db($easyshop, $database_easyshop);
$query_rsps = "SELECT * FROM s_product_ps ORDER BY s_product_ps ASC";

$rsps = mysqli_query($easyshop,$query_rsps) or die(mysql_error());



$row_rsps = mysqli_fetch_assoc($rsps);
$totalRows_rsps = mysqli_num_rows($rsps);
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>電影資訊</title>
<style type="text/css">
<!--
body {
	background-image: url(../jpg/5.jpg);
}
.style4 {color: #FFFFFF}
.style6 {font-size: small; font-family: "標楷體"; color: #000033; }
.style7 {color: #000000}
.style8 {font-size: small; font-family: "標楷體"; color: #FFFFFF; }
.style9 {color: #9F9EA3}
.style10 {color: #32353C}
.style11 {color: #2D2F3B}
-->
</style></head>

<body>
<div align="center" class="style4 style7">
  <table width="100%" border="0">
    <tr>
      <td bgcolor="#3E424D"><div align="center" class="style4">電影資訊新增</div></td>
    </tr>
  </table>
</div>
<form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <div align="center">
    <input name="ps" type="text" id="ps">
    <input type="submit" name="Submit" value="新增類別">
    <a href="s_upstore_ps.php">類別管理</a></div>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form2" onSubmit="return aaa();">
  <table width="709" border="0" align="center" bordercolor="#D9DCE1">
    <tr>
      <td bgcolor="#8C8C8C"><span class="style8">電影資訊</span></td>
      <td colspan="3" bgcolor="#E6E2E1"> <label class="style8">
        <input name="kg" type="radio" value="即將上映" checked>
        <span class="style9">
        <span class="style10">即將上映</span>
        <input name="kg" type="radio" value="熱映中">
        <span class="style11">熱映中</span> </span></label></td>
    </tr>
    <tr>
      <td width="99" bgcolor="#8C8C8C"><span class="style8">電影名稱</span></td>
      <td width="224" bgcolor="#E6E2E1"><input name="s_product" type="text" id="s_product"></td>
      <td width="102" bgcolor="#8C8C8C"><span class="style8">類別</span></td>
      <td width="256" bgcolor="#E5E4E2"><span class="style8">
        <select name="s_ps" id="s_ps">
          <?php
do {  
?>
          <option value="<?php echo $row_rsps['s_product_ps']?>"<?php if (!(strcmp($row_rsps['s_product_ps'], $row_rsps['s_product_ps']))) {echo "SELECTED";} ?>><?php echo $row_rsps['s_product_ps']?></option>
          <?php
} while ($row_rsps = mysqli_fetch_assoc($rsps));
  $rows = mysqli_num_rows($rsps);
  if($rows > 0) {
      mysqli_data_seek($rsps, 0);
	  $row_rsps = mysqli_fetch_assoc($rsps);
  }
?>
        </select>
      </span></td>
    </tr>
    <tr>
      <td bgcolor="#8C8C8C"><span class="style8">上映日期</span></td>
      <td bgcolor="#E6E2E1"><input name="lcd" type="text" id="lcd"></td>
      <td bgcolor="#8C8C8C"><span class="style8">主演</span></td>
      <td bgcolor="#E5E4E2"><input name="cpu" type="text" id="cpu"></td>
    </tr>
    <tr>
      <td bgcolor="#8C8C8C"><span class="style8">圖檔</span></td>
      <td colspan="3" bgcolor="#E6E2E1"><input name="myfile" type="file" id="myfile"></td>
    </tr>
    <tr>
      <td bgcolor="#8C8C8C"><span class="style8">電影簡介</span></td>
      <td colspan="3" bgcolor="#E6DEDB"><span class="style8">
        <textarea name="s_text" cols="60" rows="3" wrap="VIRTUAL" id="s_text"></textarea>
      </span></td>
    </tr>
    <tr>
      <td colspan="4" bgcolor="#EAE9E7"><div align="center" class="style6">
        <input type="submit" name="Submit" value="新增">
      </div></td>
    </tr>
  </table>
  <div align="center"></div>
  <input type="hidden" name="MM_insert" value="form2">
</form>
</body>
</html>
<?php
mysqli_free_result($rsps);
?>

<script language="javascript">
function aaa(){
if(document.form2.s_product.value==""){
alert ("商品名稱要填唷!")
return false
}else if (document.form2.s_money.value==""){
alert ("商品特價要填唷!")
return false
}else if (document.form2.s_text.value==""){
alert ("內容要填唷!")
return false
}
}
</script>