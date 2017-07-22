<!DOCTYPE HTML>
<!--
	Ion by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>app</title>
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
.style4 {
	color: #FFFFFF;
	font-size: 16px;
}
.style7 {font-family: "標楷體"}
.style15 {color: #333333; font-size: 16px; }
-->
        </style>

	</head>
	<body id="top">
	<?php require_once('Connections/connSQL.php'); ?>
<?php
$maxRows_rs = 100;
$pageNum_rs = 0;
if (isset($_GET['pageNum_rs'])) {
  $pageNum_rs = $_GET['pageNum_rs'];
}
$startRow_rs = $pageNum_rs * $maxRows_rs;

mysqli_select_db($connSQL, $database_connSQL);
$query_rs = 'SELECT * FROM s_product where kg="即將上映" ORDER BY lcd ASC';
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
?>
<?php 
if($_SESSION['MM_Username']=="")header("Location: account.php");;
?>
		<!-- Header -->
			<header id="header" class="skel-layers-fixed">
				<h1><a href="#">Ion</a></h1>
				<nav id="nav">
					<ul>
						<li><a href="index.php" >回首頁</a></li>
						<li><a href="account.php">會員專區</a></li>
						<li><a href="tickets.php"">線上訂票</a></li>
						<li><a href="information.php" class="button special">電影資訊</a></li>
						<li><a href="sys.php" >店家中心</a></li>
						<li><a href="about.php">關於我們</a></li>
						<li><a href="message.php" >意見回饋</a></li>
					</ul>
				</nav>
			</header>

		<!-- Main -->
	<section id="main" class="wrapper style1">
	  <header class="major">
				<h2>近期電影</h2>
		  <p>&nbsp;</p>
	  </header>
				<div class="container">
					
					  <section>
					    
				        
					  <?php do { ?>  <table width="100%" border="2" bordercolor="#000000">
					      <tr>
					        <td height="26" valign="top" bgcolor="#FFFFFF"><div align="center"> <img src="system/store_photo/<?php echo $row_rs['s_file']; ?>" width="100%" height="180" border="0"> </div></td>
				          </tr>
					      <tr>
					        <td valign="top" bgcolor="#F3F3F3"><div align="center"><span class="style15"><span class="style7"><?php echo $row_rs['s_product']; ?>[<?php echo $row_rs['s_ps']; ?>]<br>
					          上映日期:<?php echo $row_rs['lcd']; ?></span><span class="style7"><br>
				              主演:<?php echo $row_rs['cpu']; ?></span></span><span class="style15"><br>
				              <span class="style7">簡介:<?php echo $row_rs['s_text']; ?></span></span><span class="style4"><br>
				              <span class="style7"><br>
                            </span></span></div></td>
				          </tr>
                                                  </table>
					    </section>
					  <?php } while ($row_rs = mysqli_fetch_assoc($rs)); ?>
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
mysqli_free_result($rs);
?>