<?php require_once('../Connections/easyshop.php'); ?>
<?php
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE system_account SET sys_pass=%s WHERE sys_account=%s",
                       GetSQLValueString($_POST['pass'], "text"),
                       GetSQLValueString($_POST['account'], "text"));

  mysqli_select_db($easyshop, $database_easyshop);
  $Result1 = mysqli_query($easyshop,$updateSQL) or die(mysql_error());

  $updateGoTo = "ch_syspass2.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rs = "1";
if (isset($_SESSION['MM_Username'])) {
  $colname_rs = (get_magic_quotes_gpc()) ? $_SESSION['MM_Username'] : addslashes($_SESSION['MM_Username']);
}
mysqli_select_db($easyshop, $database_easyshop);
$query_rs = sprintf("SELECT * FROM system_account WHERE sys_account = '%s'", $colname_rs);
$rs = mysqli_query($easyshop,$query_rs) or die(mysql_error());
$row_rs = mysqli_fetch_assoc($rs);
$totalRows_rs = mysqli_num_rows($rs);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>修改密碼</title>
<style type="text/css">
<!--
body {
	background-image: url(../jpg/5.jpg);
}
.style4 {font-size: 12px}
.style5 {font-size: 12px; font-family: "¼Ð·¢Åé"; }
.style7 {
	font-family: "·s²Ó©úÅé";
	font-size: 14px;
}
.style8 {font-size: 12px; font-family: "·s²Ó©úÅé"; }
.style11 {color: #555F08; font-weight: bold; font-family: "¼Ð·¢Åé"; font-size: large; }
.style12 {font-size: 14px}
-->
</style>
</head>

<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div align="center"><span class="style11">
  修改密碼
</span><span class="style11"></span></div>
<form name="form1" method="POST" action="<?php echo $editFormAction; ?>" onSubmit="return aaa();">
  <div align="center">
    <table width="415" border="1">
      <tr>
        <td width="110" bgcolor="#EEF7F4"><div align="left" class="style5 style4 style7 style4">
          <div align="left">帳號名稱</div>
        </div></td>
        <td width="289"><div align="left" class="style8 style4">
          
            <div align="left">
              <input name="account" type="text" id="account" value="<?php echo $row_rs['sys_account']; ?>">
            </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#EEF7F4"><div align="left" class="style8 style12">
          <div align="left">輸入舊密碼</div>
        </div></td>
        <td><div align="left" class="style8 style4">
          <div align="left">
            <input name="oldpass" type="password" id="oldpass">
            <input name="oldpass1" type="hidden" id="oldpass1" value="<?php echo $row_rs['sys_pass']; ?>">
            </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#EEF7F4"><div align="left" class="style8 style12">
          <div align="left">輸入新密碼</div>
        </div></td>
        <td><div align="left" class="style8 style4">
          <div align="left">
            <input name="pass" type="password" id="pass">
            </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#EEF7F4"><div align="left" class="style12">確認密碼</div></td>
        <td><div align="left" class="style4">
          <input name="pass2" type="password" id="pass2">
        </div></td>
      </tr>
    </table>  
    <input type="submit" name="Submit" value="確定">
  </div>
  <input type="hidden" name="MM_update" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysqli_free_result($rs);
?>
<script language="javascript">
function aaa(){
if(document.form1.account.value==""){
alert ("±b¸¹­n¶ñ­ò!")
return false
}else if (document.form1.oldpass.value==""){
alert ("ÂÂ±K½X­n¶ñ­ò!")
return false
}else if (document.form1.oldpass.value != document.form1.oldpass1.value ){
alert ("ÂÂ±K½X¿é¤J¿ù»~")
return false

}else if (document.form1.pass.value==""){
alert ("·s±K½X­n¶ñ­ò!")
return false
}else if (document.form1.pass.value != document.form1.pass2.value){
alert ("·s±K½X½T»{¿ù»~!")
return false

}
}
</script>