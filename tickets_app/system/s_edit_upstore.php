<?php require_once('../Connections/easyshop.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}if($_SESSION['MM_Username']<>"admin"){
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

if(@$_FILES['myfile2']['name'] <> ""){
$uploaddir2 = '';
$uploadfile2 = $uploaddir2.basename($_FILES['myfile2']['name']);
(move_uploaded_file($_FILES['myfile2']['tmp_name'], "store_photo/".$uploadfile2));
}



if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {


if(( $_FILES['myfile2']['name'] =="")){ 
  $updateSQL = sprintf("UPDATE s_product SET lcd=%s, kg=%s,s_product=%s, s_ps=%s, s_money_old=%s, s_money=%s, s_text=%s WHERE pro_id=%s",
    GetSQLValueString($_POST['lcd'], "text"),
                       GetSQLValueString($_POST['kg'], "text"),
					   GetSQLValueString($_POST['s_product'], "text"),
                       GetSQLValueString($_POST['s_ps'], "text"),
                       GetSQLValueString($_POST['s_money_old'], "text"),
                       GetSQLValueString($_POST['s_money'], "text"),
                       GetSQLValueString(nl2br($_POST['s_text']), "text"),
                       GetSQLValueString($_POST['id'], "int"));
}else{
  $updateSQL = sprintf("UPDATE s_product SET lcd=%s,kg=%s,s_product=%s, s_file =%s,s_ps=%s, s_money_old=%s, s_money=%s, s_text=%s WHERE pro_id=%s",
                       GetSQLValueString($_POST['lcd'], "text"),
					  GetSQLValueString($_POST['kg'], "text"),
					   GetSQLValueString($_POST['s_product'], "text"),
					    GetSQLValueString($_FILES['myfile2']['name'], "text"),
                       GetSQLValueString($_POST['s_ps'], "text"),
                       GetSQLValueString($_POST['s_money_old'], "text"),
                       GetSQLValueString($_POST['s_money'], "text"),
                       GetSQLValueString(nl2br($_POST['s_text']), "text"),
                       GetSQLValueString($_POST['id'], "int"));

}



  mysqli_select_db($easyshop, $database_easyshop);
  $Result1 = mysqli_query($easyshop,$updateSQL) or die(mysql_error());

  $updateGoTo = "s_upstore_del.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rs = "-1";
if (isset($_GET['id'])) {
  $colname_rs = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysqli_select_db($easyshop, $database_easyshop);
$query_rs = sprintf("SELECT * FROM s_product WHERE pro_id = %s", $colname_rs);
$rs = mysqli_query($easyshop,$query_rs) or die(mysql_error());
$row_rs = mysqli_fetch_assoc($rs);
$totalRows_rs = mysqli_num_rows($rs);

mysqli_select_db($easyshop, $database_easyshop);
$query_rsps = "SELECT * FROM s_product_ps ORDER BY s_product_ps_id ASC";
$rsps = mysqli_query($easyshop,$query_rsps) or die(mysql_error());
$row_rsps = mysqli_fetch_assoc($rsps);
$totalRows_rsps = mysqli_num_rows($rsps);
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<style type="text/css">
<!--
body {
	background-image: url(../jpg/5.jpg);
}
.style3 {font-size: small; font-family: "標楷體"; }
.style4 {
	font-family: "標楷體";
	font-weight: bold;
	color: #FFFFFF;
}
.style5 {color: #FFFFFF; font-weight: bold; }
.style6 {color: #8A2A00}
.style7 {font-size: small; font-family: "標楷體"; color: #8A2A00; }
.style13 {color: #043D48}
.style14 {font-size: small; font-family: "標楷體"; color: #043D48; }
-->
</style></head>

<body>
<div align="center" class="style4">
  <table width="51%" border="0">
    <tr>
      <td bgcolor="#1D6772"><div align="center" class="style5">電影資訊管理</div></td>
    </tr>
  </table>
</div>
<div align="center"><br />
</div>
<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">
  <table width="908" border="1" align="center">
    <tr bgcolor="#F8F8FE">
      <td colspan="5" bgcolor="#FFFFFF"><div align="center" class="style6"><span class="style13"></span></div></td>
    </tr>
    <tr>
      <td width="256" rowspan="3" background="../images/jghjf.jpg" bgcolor="#FFFFFF"><div align="left" class="style13"><a href="photo.php?p=<?php echo $row_rs['s_file']; ?>" target="_blank"><img src="store_photo/<?php echo $row_rs['s_file']; ?>" width="203" height="182" border="0" /><br>
      
          <input name="myfile2" type="file" id="myfile2">
      </a></div></td>
      <td width="187" bgcolor="#FFFFFF"><div align="left" class="style13"><span class="style3">電影名稱</span></div>        <div align="left" class="style13"></div>        <div align="left" class="style13"></div></td>
      <td width="192" bgcolor="#FFFFFF"><div align="left" class="style13"><span class="style3">
        <input name="s_product" type="text" id="s_product" value="<?php echo $row_rs['s_product']; ?>" />
        <input name="id" type="hidden" id="id" value="<?php echo $row_rs['pro_id']; ?>" />
      </span></div>
      <div align="left" class="style13"></div>        <div align="left" class="style13"></div></td>
      <td width="123" bgcolor="#FFFFFF"><span class="style14">上映日期</span></td>
      <td width="116" bgcolor="#FFFFFF"><input name="lcd" type="text" id="lcd" value="<?php echo $row_rs['lcd']; ?>"></td>
    </tr>
    
    
    
    <tr>
      <td height="88" bgcolor="#FFFFFF" class="style7"><span class="style14">電影資訊</span></td>
      <td bgcolor="#FFFFFF" class="style7"><span class="style13">
        <label><br>
        <span class="style3">
        <input name="kg" type="radio" value="即將上映" <?php if($row_rs['kg']=="即將上映")echo "checked"; ?>>
         即將上映
        <input name="kg" type="radio" value="熱映中" <?php if($row_rs['kg']=="熱映中")echo "checked"; ?>>
        熱映中</span></label>
      </span></td>
      <td bgcolor="#FFFFFF"><span class="style6"><span class="style14">類別</span></span></td>
      <td bgcolor="#FFFFFF"><span class="style6"><span class="style14">
        <select name="s_ps" id="s_ps">
          <?php
		echo "<option value=". $row_rs['s_ps'] .">" . $row_rs['s_ps'] . "</option>";
		echo "<option value=></option>";
		
do {  
?>
          <option value="<?php echo $row_rsps['s_product_ps']?>"<?php if (!(strcmp($row_rsps['s_product_ps'], $row_rsps['s_product_ps'])))  ?>><?php echo $row_rsps['s_product_ps']?></option>
          <?php
} while ($row_rsps = mysqli_fetch_assoc($rsps));
  $rows = mysqli_num_rows($rsps);
  if($rows > 0) {
      mysqli_data_seek($rsps, 0);
	  $row_rsps = mysqli_fetch_assoc($rsps);
  }
?>
        </select>
      </span></span></td>
    </tr>
    <tr>
      <td height="88" bgcolor="#FFFFFF"><div align="left" class="style13"><span class="style3">電影簡介</span></div></td>
      <td colspan="3" bgcolor="#FFFFFF"><div align="left" class="style13"><span class="style3">
        <textarea name="s_text" cols="60" rows="3" wrap="virtual" id="s_text"><?php 
		
		//echo $row_rs['s_text'];
		echo  str_replace("<br />"," ",$row_rs['s_text'])
		 ?>
        </textarea>
      </span></div></td>
    </tr>
    <tr bgcolor="#F8F8FE">
      <td colspan="5" bgcolor="#FFFFFF"><div align="center" class="style13">
        <input type="submit" name="Submit" value="送出" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
</form>
<p align="center"><a href="Javascript:OnClick=history.back()">回上頁</a></p>
<p align="center">&nbsp;</p>
</body>
</html>
<?php
mysqli_free_result($rs);

mysqli_free_result($rsps);
?>