<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php require_once('Connections/connSQL.php'); ?>
<?php
$colname_rs6 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_rs6 = (get_magic_quotes_gpc()) ? $_SESSION['MM_Username'] : addslashes($_SESSION['MM_Username']);
}
mysqli_select_db($connSQL, $database_connSQL);
$query_rs6 = sprintf("SELECT * FROM a_account WHERE a_account = '%s'", $colname_rs6);
$rs6 = mysqli_query($connSQL,$query_rs6) or die(mysql_error());
$row_rs6 = mysqli_fetch_assoc($rs6);
$totalRows_rs6 = mysqli_num_rows($rs6);
?>

<?php
//點數扣除
if($_SESSION['items']=="10~12"){
$m="220";
}else{
$m="240";
}


 
$mm=$_SESSION['num'] * $m;

if($mm>$row_rs6['atm']){
header("Location: buyX.php");
exit;
}
	
mysqli_select_db($connSQL, $database_connSQL);
$query_buy = "update a_account set atm = atm - '".$mm."'";
$buy = mysqli_query($connSQL,$query_buy) or die(mysql_error());
 
?>
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
.style3 {color: #2B2B2B; font-weight: bold; }
.style4 {color: #FFFFFF}
.style5 {font-size: x-large}
-->
        </style>

	</head>
	<body id="top">
<?php require_once('Connections/connSQL.php'); ?>
<?php
mysqli_select_db($connSQL, $database_connSQL);
$query_in = "insert into order_prod(o_studios,o_acc,o_pro,o_num,o_date,o_position,o_hall,o_items) values('".$_SESSION['studios']."','".$_SESSION['MM_Username']."','".$_SESSION['id']."','".$_SESSION['num']."','".date("Y-m-d")."','".$_SESSION['chk']."','".$_SESSION['hall']."','".$_SESSION['items']."')";
$in = mysqli_query($connSQL,$query_in) or die(mysql_error());


//$query_in = "insert into order_prod(o_studios,o_acc,o_pro,o_num,o_date,o_position,o_hall,o_items) values('".$_SESSION['studios']."','".$_SESSION['MM_Username']."','".$_SESSION['id']."','".$_SESSION['num']."','".date("Y-m-d")."','".$_SESSION['chk']."','".$_SESSION['hall']."','".$_SESSION['items']."')";
//$in = mysql_query($query_in, $connSQL) or die(mysql_error());



	$_SESSION['studios']="";
	$_SESSION['hall']="";
	$_SESSION['items']="";
	$_SESSION['num']="";
	$_SESSION['id']=""; 
	$_SESSION['chk']="";
 unset($_SESSION['o']);
?>
		<!-- Header -->
			<header id="header" class="skel-layers-fixed">
				<h1><a href="#">Ion</a></h1>
				<nav id="nav">
					<ul>
						<li><a href="index.php" >回首頁</a></li>
						<li><a href="account.php" >會員專區</a></li>
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
				<h2>Quick-Visual</h2>
		 
	  </header>
				<div class="container">
				  <section>
						
			            <div align="center"><img src="jpg/9.jpg" alt="" width="100%" height="212" /><span class="style5">訂票完畢</span></div>
			            <form name="form1" method="POST">
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
			            </form>
					    <table width="100%" border="2" bordercolor="#FFFFFF">
                          <tr>
                            <td bgcolor="#BFBFBF"><div align="center"><a href="account.php" class="style3"></a><a href="<?php echo $logoutAction ?>" class="style3 style4">登出</a></div></td>
                          </tr>
                      </table>
					    <div align="center"></div>
				  </section>
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
mysql_free_result($rs6);
?>
 