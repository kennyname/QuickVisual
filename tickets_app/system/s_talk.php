<?php require_once('../Connections/easyshop.php'); ?>
<?php
if(!isset($_SESSION)){  
   session_start();  
}  
if($_SESSION['MM_Username']<>"admin"){
exit;
}
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rs = 55;
$pageNum_rs = 0;
if (isset($_GET['pageNum_rs'])) {
  $pageNum_rs = $_GET['pageNum_rs'];
}
$startRow_rs = $pageNum_rs * $maxRows_rs;

mysqli_select_db($easyshop, $database_easyshop);

if(@$_GET['so']==""){
$query_rs = "SELECT * FROM t_talk ORDER BY t_id DESC";
}else{
$query_rs = "SELECT * FROM t_talk where t_re ='".$_GET['so']."'ORDER BY t_id DESC";
}

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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>意見回饋查詢</title>
<style type="text/css">
<!--
.style1 {font-size: small}
body {
	background-image: url(../jpg/5.jpg);
}
.style8 {color: #000000}
.style9 {color: #FFFFFF; }
.style10 {font-size: small; color: #FFFFFF; }
.style12 {color: #0D0D0D; font-weight: bold; }
.style13 {color: #0C0C0C}
.style14 {font-size: small; color: #0C0C0C; }
-->
</style>
</head>

<body>
<div align="center"><br>
  <span class="style12">[意見回饋查詢
  ]  </span>
  <hr>
  <form name="form1" method="get" action="s_talk.php">
    分類查詢
    <label>
    <select name="so" id="so">
      <option value="其他">其他</option>
      <option value="建議">建議</option>
      <option value="申訴">申訴</option>
      <option value=" 匯款確認"> 匯款確認</option>
    </select>
    </label>
    <label>
    <input type="submit" name="Submit" value="送出">
    </label>
    <a href="s_talk.php">[全部]
    </a>
  </form>
  <table width="100%" border="1">
    <tr>
      <td width="32" bgcolor="#080808" class="style9">&nbsp;</td>
      <td width="111" bgcolor="#080808" class="style8"><div align="left" class="style9"><span class="style1">留言者</span></div></td>
      <td width="88" bgcolor="#080808" class="style8"><div align="left" class="style9"><span class="style1">性別</span></div></td>
      <td width="224" bgcolor="#080808" class="style9">服務項目</td>
      <td width="224" bgcolor="#080808" class="style8"><div align="left" class="style9"><span class="style1">意見欄位</span></div></td>
    </tr>
    <?php
	if($row_rs['t_id']=="")exit;
	 do { ?>
    <tr>
      <td bgcolor="#FFFFFF" class="style8"><div align="center" class="style10 style13"><a href="s_talkdel.php?id=<?php echo $row_rs['t_id']; ?>">刪除</a></div></td>
      <td bgcolor="#FFFFFF" class="style8"><div align="left" class="style13"><span class="style1"><?php echo $row_rs['t_name']; ?></span></div></td>
      <td bgcolor="#FFFFFF" class="style8"><div align="left" class="style13"><?php echo $row_rs['t_sex']; ?></div></td>
      <td bgcolor="#FFFFFF" class="style8"><span class="style13"><?php echo $row_rs['t_re']; ?></span></td>
      <td bgcolor="#FFFFFF" class="style8"><span class="style14"><?php echo $row_rs['t_text']; ?></span></td>
      </tr>
    <?php } while ($row_rs = mysqli_fetch_assoc($rs)); ?>
  </table>
  <p class="style1"> 記錄 <?php echo ($startRow_rs + 1) ?> 到 <?php echo min($startRow_rs + $maxRows_rs, $totalRows_rs) ?> 共 <?php echo $totalRows_rs ?>
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center">
        <?php if ($pageNum_rs > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, 0, $queryString_rs); ?>">第一頁</a>
      <?php } // Show if not first page ?>      </td>
      <td width="31%" align="center">
        <?php if ($pageNum_rs > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, max(0, $pageNum_rs - 1), $queryString_rs); ?>">上一頁</a>
      <?php } // Show if not first page ?>      </td>
      <td width="23%" align="center">
        <?php if ($pageNum_rs < $totalPages_rs) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, min($totalPages_rs, $pageNum_rs + 1), $queryString_rs); ?>">下一頁</a>
      <?php } // Show if not last page ?>      </td>
      <td width="23%" align="center">
        <?php if ($pageNum_rs < $totalPages_rs) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, $totalPages_rs, $queryString_rs); ?>">最後一頁</a>
      <?php } // Show if not last page ?>      </td>
    </tr>
  </table>
  </p>
</div>
</body>
</html>
<?php
mysqli_free_result($rs);
?>
