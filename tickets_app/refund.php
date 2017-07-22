<?php require_once('Connections/connSQL.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rs = 10;
$pageNum_rs = 0;
if (isset($_GET['pageNum_rs'])) {
  $pageNum_rs = $_GET['pageNum_rs'];
}
$startRow_rs = $pageNum_rs * $maxRows_rs;

$colname_rs = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_rs = (get_magic_quotes_gpc()) ? $_SESSION['MM_Username'] : addslashes($_SESSION['MM_Username']);
}
mysqli_select_db($connSQL, $database_connSQL);
$query_rs = sprintf("SELECT * FROM order_prod a left join s_product b on a.o_pro=b.pro_id WHERE a.o_acc = '%s' and o_checkout='0' order by o_id desc", $colname_rs);
$query_limit_rs = sprintf("%s LIMIT %d, %d", $query_rs, $startRow_rs, $maxRows_rs);
$rs = mysqli_query($connSQL,$query_limit_rs) or die(mysql_error());
$row_rs = mysqli_fetch_assoc($rs);

if (isset($_GET['totalRows_rs'])) {
  $totalRows_rs = $_GET['totalRows_rs'];
} else {
  $all_rs = mysqli_query($connSQL,$query_rs);
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
?><!DOCTYPE HTML>
<!--
	Ion by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Quick-Visual</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="最新好看的電影都在這裡喔" />
		<meta name="keywords" content="最新 上映" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<style type="text/css">
<!--
.style1 {color: #333333}
.style3 {color: #2B2B2B; font-weight: bold; }
-->
        </style>

	</head>
	<body id="top">
                          
		<!-- Header -->
			<header id="header" class="skel-layers-fixed">
				<h1><a href="#">Ion</a></h1>
				<nav id="nav">
					<ul>
						<li><a href="index.php" >回首頁</a></li>
						<li><a href="account.php" class="button special">會員專區</a></li>
						<li><a href="tickets.php" >線上訂票</a></li>
						<li><a href="information.php">電影資訊</a></li>
						<li><a href="sys.php" >店家中心</a></li>
						<li><a href="about.php">關於我們</a></li>
						<li><a href="message.php" >意見回饋</a></li>
					</ul>
				</nav>
			</header>

		<!-- Main -->
	<section id="main" class="wrapper style1">
	  <header class="major">
					<h2>Quick-Visual</h2>
		  <p>&nbsp;</p>
	  </header>
				<div class="container">
					<section>
					
						<a href="#" class="image fit"> <img src="jpg/8.jpg" width="100%" height="167"></a></section>
		</div>
	</section>
	
	
	
	
	
				<section id="one" class="wrapper style1">
				<header class="major">
					<h2>交易紀錄</h2>
					<p>點選圖片即可退票<br>
					  <a href="refund_about.php">退票請先看退票規範</a></p>
				</header>
				<div class="container">
				  <div class="row">
						
						
						<?php do { ?>
						  <div class="4u">
						    <section class="special box">
							
							<a href="refund_ok.php?c=<?php echo $row_rs['o_checkout'];?>&id=<?php echo $row_rs['o_id']; ?>">
<img src="system/store_photo/<?php echo $row_rs['s_file']; ?>" width="100%" height="163" border="0">		
							</a>
			
						      <h3><?php echo $row_rs['s_product']; ?></h3>
							    <p><?php echo $row_rs['o_studios']; ?>(<?php echo $row_rs['o_hall']; ?>)<br>
							      時段:<?php echo $row_rs['o_items']; ?> 票數:<?php echo $row_rs['o_num']; ?>張<br>
						        訂票時間:<?php echo $row_rs['o_date']; ?> <?php
								
								 if($row_rs['o_checkout']=="1"){
								 echo "交易完成";
								 }else{
								  echo "未交易";
								 }
								 
								  ?></p>
							  </section>
						        </div>
						  <?php } while ($row_rs = mysqli_fetch_assoc($rs)); ?><div align="center">
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
						</div>
					</div>
				</div>
			</section>
			
			

		<!-- Footer -->
			<footer id="footer">
				<div class="container">
				  <ul class="copyright">
						<li>&copy; Quick-Visual.</li>
						<li>Design: <a href="http://templated.co">TEMPLATED</a></li>
						<li>Images: <a href="http://unsplash.com">Unsplash</a></li>
				  </ul>
				</div>
			</footer>

	</body>
</html>
<?php
mysql_free_result($rs);
?>