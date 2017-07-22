<?php require_once('Connections/connSQL.php'); ?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['acc'])) {
  $loginUsername=$_POST['acc'];
  $password=$_POST['pass'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "acc_index.php";
  $MM_redirectLoginFailed = "account.php";
  $MM_redirecttoReferrer = false;
  mysqli_select_db($connSQL, $database_connSQL);
  
  $LoginRS__query=sprintf("SELECT a_account, a_pass FROM a_account WHERE a_account='%s' AND a_pass='%s'",
    get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
  $LoginRS = mysqli_query($connSQL,$LoginRS__query) or die(mysql_error());
  $loginFoundUser = mysqli_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;
    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}

if(@$_SESSION['MM_Username']<>"")header("Location: acc_index.php");
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
		 
	  </header>
				<div class="container">
				  <section>
						<h2>會員專區</h2>
			            <div align="center"><a href="#" class="image fit"><img src="jpg/8.jpg" alt="" width="100%" height="186" /></a>
			
					    登入會員<br>
			            </div>
			            <form name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
			              <table width="100%" border="1" align="center">
                            <tr>
                              <td><label>
                                帳號
                                <input name="acc" type="text" id="acc" size="15">
                              </label></td>
                            </tr>
                            <tr>
                              <td>密碼
                                <input name="pass" type="password" id="pass" size="15"></td>
                            </tr>
                          </table>
                          <label>
                          <div align="center">
                            <input type="submit" name="Submit" value="登入">
                          </div>
                          </label>
                          <div align="center"></div>
			            </form>
					    <table width="100%" border="2" bordercolor="#FFFFFF">
                          <tr>
                            <td bgcolor="#BFBFBF"><div align="center"><a href="account.php" class="style3"></a><a href="account_add.php" class="style3 style4">加入會員</a></div></td>
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
						<li>&copy; Untitled. All rights reserved.</li>
						<li>Design: <a href="http://templated.co">TEMPLATED</a></li>
						<li>Images: <a href="http://unsplash.com">Unsplash</a></li>
				  </ul>
				</div>
			</footer>

	</body>
</html>