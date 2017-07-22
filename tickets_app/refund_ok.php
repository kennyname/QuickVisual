<?php require_once('Connections/connSQL.php'); ?>
<?php
$colname_rs1 = "-1";
if (isset($_GET['id'])) {
  $colname_rs1 = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysqli_select_db($connSQL, $database_connSQL);
$query_rs1 = sprintf("SELECT * FROM order_prod WHERE o_id = %s", $colname_rs1);
$rs1 = mysqli_query($connSQL,$query_rs1) or die(mysql_error());
$row_rs1 = mysqli_fetch_assoc($rs1);
$totalRows_rs1 = mysqli_num_rows($rs1);


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
.style2 {
	font-size: x-large;
	font-weight: bold;
}
.style3 {color: #2B2B2B; font-weight: bold; }
.style4 {color: #FFFFFF}
-->
        </style>

	</head>
	<body id="top">
	
	<?php 
	
	echo $row_rs1['o_items']; 
	
	
	
	if($row_rs1['o_items']=="10~12"){
$m="220";
}else{
$m="240";
}


$mm=$row_rs1['o_num'] * $m;


mysql_select_db($database_connSQL, $connSQL);
$query_rs2 = "update a_account set atm = atm + '".$mm."'";
$rs2 = mysql_query($query_rs2, $connSQL) or die(mysql_error());
 

mysql_select_db($database_connSQL, $connSQL);
$query_rs3 = "delete  FROM order_prod where o_id='".$_GET['id']."'";
$rs3 = mysql_query($query_rs3, $connSQL) or die(mysql_error());
 
 
 


	
	?>

		<!-- Header -->
			<header id="header" class="skel-layers-fixed">
				<h1><a href="#">Ion</a></h1>
				<nav id="nav">
					<ul>
						<li><a href="index.php" >回首頁</a></li>
						<li><a href="account.php" class="button special">會員專區</a></li>
						<li><a href="tickets.php">線上訂票</a></li>
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
						<h2 align="center">Movie Ticket APP</h2>
						<div align="center"><img src="jpg/gfdh.jpg" width="100%" height="167">
			
					      <span class="style2">退票完畢</span>
					      <table width="100%" border="2" bordercolor="#000000">
                            <tr>
                              <td bgcolor="#EEEEEE"><a href="tickets.php" class="style3">線上訂票</a></td>
                              <td bgcolor="#EEEEEE"><a href="transaction.php" class="style3">交易紀錄</a></td>
                            </tr>
                            <tr>
                              <td bgcolor="#EEEEEE"><a href="inquire.php" class="style3">餘額查詢</a></td>
                              <td bgcolor="#EEEEEE"><a href="refund.php" class="style3">退票</a></td>
                            </tr>
                          </table>
						  <div align="center"><a href="account.php" class="style3"></a><a class="style3 style4"> </a></div>
						</div>
					</section>
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
 