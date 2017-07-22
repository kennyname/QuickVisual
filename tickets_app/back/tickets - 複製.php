<?php require_once('Connections/connSQL.php'); ?>
<?php
$maxRows_rs = 100;
$pageNum_rs = 0;
if (isset($_GET['pageNum_rs'])) {
  $pageNum_rs = $_GET['pageNum_rs'];
}
$startRow_rs = $pageNum_rs * $maxRows_rs;

mysql_select_db($database_connSQL, $connSQL);
$query_rs = "SELECT * FROM s_product ORDER BY lcd ASC";
$query_limit_rs = sprintf("%s LIMIT %d, %d", $query_rs, $startRow_rs, $maxRows_rs);
$rs = mysql_query($query_limit_rs, $connSQL) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);

if (isset($_GET['totalRows_rs'])) {
  $totalRows_rs = $_GET['totalRows_rs'];
} else {
  $all_rs = mysql_query($query_rs);
  $totalRows_rs = mysql_num_rows($all_rs);
}
$totalPages_rs = ceil($totalRows_rs/$maxRows_rs)-1;
?><!DOCTYPE HTML>
<!--
	Ion by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>app</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<style type="text/css">
<!--
.style1 {color: #333333}
.style3 {color: #2B2B2B; font-weight: bold; }
.style4 {
	color: #FFFFFF;
	font-size: 16px;
}
.style7 {font-family: "標楷體"}
-->
        </style>
<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
</noscript>
	</head>
	<body id="top">

		<!-- Header -->
			<header id="header" class="skel-layers-fixed">
				<h1><a href="#">Ion</a></h1>
				<nav id="nav">
					<ul>
						<li><a href="index.php" >回首頁</a></li>
						<li><a href="account.php">會員專區</a></li>
						<li><a href="tickets.php" class="button special">線上訂票</a></li>
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
					<h2>電影訂票APP</h2>
		  <p>&nbsp;</p>
	  </header>
				<div class="container">
					
					  <section>
					    <h2>Online booking</h2>
					    <img src="jpg/jfj.jpg" width="100%" height="127"> 選擇電影
					  <?php do { ?>  <table width="100%" border="2" bordercolor="#000000">
					      <tr>
					        <td height="26" valign="top" bgcolor="#666633"><div align="center"> <a href="tickets2.php?id=<?php echo $row_rs['pro_id']; ?>"><img src="system/store_photo/<?php echo $row_rs['s_file']; ?>" width="194" height="113" border="0"></a> </div></td>
				          </tr>
					      <tr>
					        <td valign="top" bgcolor="#666633"><div align="center"><span class="style4"><span class="style7"><?php echo $row_rs['s_product']; ?><br>
					          上映日期:<?php echo $row_rs['lcd']; ?></span></span><span class="style4"><span class="style7"><br>
				              主演:<?php echo $row_rs['cpu']; ?></span></span><span class="style4"><br>
				              <span class="style7"><br>
                            </span></span></div></td>
				          </tr>
                                                  </table>
					    </section>
					  <?php } while ($row_rs = mysql_fetch_assoc($rs)); ?>
		</div>
	</section>

		<!-- Footer -->
			<footer id="footer">
				<div class="container">
				  <ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li>
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