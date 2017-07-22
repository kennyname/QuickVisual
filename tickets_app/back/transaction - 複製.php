<?php require_once('Connections/connSQL.php'); ?>
<?php
$colname_rs = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_rs = (get_magic_quotes_gpc()) ? $_SESSION['MM_Username'] : addslashes($_SESSION['MM_Username']);
}
mysql_select_db($database_connSQL, $connSQL);
$query_rs = sprintf("SELECT * FROM order_prod a left join s_product b on a.o_pro=b.pro_id WHERE a.o_acc = '%s'", $colname_rs);
$rs = mysql_query($query_rs, $connSQL) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);
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
					
						<a href="#" class="image fit"> <img src="jpg/hjkh.jpg" width="100%" height="216"></a></section>
		</div>
	</section>
	
	
	
	
	
				<section id="one" class="wrapper style1">
				<header class="major">
					<h2>交易紀錄</h2>
					<p>Transaction.</p>
				</header>
				<div class="container">
				  <div class="row">
						
						
						<div class="4u">
							<section class="special box"><img src="system/store_photo/<?php echo $row_rs['s_file']; ?>" width="100%" height="189">
							  <h3><?php echo $row_rs['s_product']; ?></h3>
								<p><?php echo $row_rs['o_studios']; ?>(<?php echo $row_rs['o_hall']; ?>)<br>
								  時段:<?php echo $row_rs['o_items']; ?> 票數:<?php echo $row_rs['o_num']; ?>張<br>
								未付款</p>
							</section>
						</div>
						
						
						<div align="center">1111
						
					    </div>
					</div>
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