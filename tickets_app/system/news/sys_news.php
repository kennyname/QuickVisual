<?php require_once('../../Connections/lyudao.php'); ?>
<?php
session_start();
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../sys_login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

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
  $insertSQL = sprintf("INSERT INTO news4 (n_title, n_text, n_news) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['aa'], "text"),
                       GetSQLValueString($_POST['bb'], "text"),
                       GetSQLValueString(nl2br($_POST['tt']), "date"));

  mysql_select_db($database_lyudao, $lyudao);
  $Result1 = mysql_query($insertSQL, $lyudao) or die(mysql_error());

  $insertGoTo = "sys_news.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$maxRows_rs = 20;
$pageNum_rs = 0;
if (isset($_GET['pageNum_rs'])) {
  $pageNum_rs = $_GET['pageNum_rs'];
}
$startRow_rs = $pageNum_rs * $maxRows_rs;

mysql_select_db($database_lyudao, $lyudao);
$query_rs = "SELECT * FROM news4 ORDER BY n_id DESC";
$query_limit_rs = sprintf("%s LIMIT %d, %d", $query_rs, $startRow_rs, $maxRows_rs);
$rs = mysql_query($query_limit_rs, $lyudao) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);

if (isset($_GET['totalRows_rs'])) {
  $totalRows_rs = $_GET['totalRows_rs'];
} else {
  $all_rs = mysql_query($query_rs);
  $totalRows_rs = mysql_num_rows($all_rs);
}
$totalPages_rs = ceil($totalRows_rs/$maxRows_rs)-1;

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
body {
	background-color: #F1F0ED;
	background-image: url(../../images/1.jpg);
}
.style10 {color: #669933; font-weight: bold; }
.style17 {color: #000000; font-weight: bold; font-size: 13px; }
.style20 {color: #000000}
.style22 {color: #F1F0ED}
.style27 {
	color: #FFFFFF;
	font-size: 13px;
}
.style28 {font-size: 13px}
.style29 {color: #FFFFFF; font-weight: bold; font-size: 13px; }
.style30 {font-size: 13px; color: #000000; }
-->
</style></head>

<body>
<div align="center" class="style20"><strong><br />
  [電子報管理
</strong>
  ]
  <br />
  <br />
  <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
    <table width="782" border="0">
      <tr>
        <td width="59" bgcolor="#554434"><div align="left" class="style22">標題</div></td>
        <td width="382" bgcolor="#F1F0ED"><div align="left">
          <input name="aa" type="text" id="aa" size="50" />
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#554434"><div align="left" class="style22">內容</div></td>
        <td bgcolor="#F1F0ED"><div align="left">
          <textarea name="bb" cols="80" rows="12" wrap="virtual" id="bb"></textarea>
        </div></td>
      </tr>
    </table>
    <input type="submit" name="Submit" value="新增" />
    <input name="tt" type="hidden" id="tt" value="<?php echo date("Y-m-d")?>" />
    <input type="hidden" name="MM_insert" value="form1">
  </form>
</div>
<table width="100%" border="1" align="center">
      <tr>
        <td width="116" bgcolor="#A66A45"><div align="center" class="style27">電子報</div></td>
        <td width="163" bgcolor="#A66A45"><span class="style28"></span></td>
        <td width="233" bgcolor="#A66A45"><span class="style29">標題</span></td>
        <td width="374" bgcolor="#A66A45" class="style10"><span class="style29">內容</span></td>
        <td width="167" bgcolor="#A66A45" class="style29">時間</td>
      </tr>
      <?php do { ?><tr>
        <td bgcolor="#FFFFFF"><div align="center"><span class="style28"><a href="send.php?id=<?php echo $row_rs['n_id']; ?>">(發送)</a></span></div></td>
        <td bgcolor="#FFFFFF"><span class="style17"><a href="sys_news_edit.php?id=<?php echo $row_rs['n_id']; ?>">修改  </a><a href="sys_news_del.php?id=<?php echo $row_rs['n_id']; ?>">刪除</a></span></td>
        <td bgcolor="#FFFFFF"><span class="style30"><?php echo $row_rs['n_title']; ?></span></td>
        <td bgcolor="#FFFFFF"><span class="style30"><?php echo $row_rs['n_text']; 
		//echo  str_replace("<br />"," ",$row_rs['n_text'])
		?>
		
		</span></td>
        <td bgcolor="#FFFFFF"><span class="style30"><?php echo $row_rs['n_news']; ?></span></td>
      </tr>
      <?php } while ($row_rs = mysql_fetch_assoc($rs)); ?>
</table>

<table border="0" width="50%" align="center">
  <tr>
    <td width="23%" align="center"><?php if ($pageNum_rs > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, 0, $queryString_rs); ?>">First</a>
        <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center"><?php if ($pageNum_rs > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, max(0, $pageNum_rs - 1), $queryString_rs); ?>">Previous</a>
        <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_rs < $totalPages_rs) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, min($totalPages_rs, $pageNum_rs + 1), $queryString_rs); ?>">Next</a>
        <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_rs < $totalPages_rs) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, $totalPages_rs, $queryString_rs); ?>">Last</a>
        <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
<div align="center">
</div>
</body>
</html>
<?php
mysql_free_result($rs);
?>
