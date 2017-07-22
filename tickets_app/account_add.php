<?php require_once('Connections/connSQL.php'); ?>
<?php
mysqli_select_db($connSQL, $database_connSQL);
$query_rs = "SELECT * FROM news ORDER BY n_id ASC";
$rs = mysqli_query($connSQL,$query_rs) or die(mysql_error());
$row_rs = mysqli_fetch_assoc($rs);
$totalRows_rs = mysqli_num_rows($rs);
?>
<?php require_once('Connections/easyshop.php'); ?>
<? //include "u_include.php" ?>
<?php
// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="add_user2.php?id=2";
  $loginUsername = $_POST['a1'];
  $LoginRS__query = "SELECT a_account FROM a_account WHERE a_account='" . $loginUsername . "'";
  mysqli_select_db($easyshop,$database_easyshop);
  $LoginRS=mysqli_query($easyshop,$LoginRS__query) or die(mysql_error());
  $loginFoundUser = mysqli_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

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
  $insertSQL = sprintf("INSERT INTO a_account (a_joinname,a_area,a_account, a_pass, a_name, a_address, a_phone, a_sogi, atm) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
   GetSQLValueString($_POST['a_joinname'], "text"),
    GetSQLValueString($_POST['a_area'], "text"),
                       GetSQLValueString($_POST['a1'], "text"),
                       GetSQLValueString($_POST['a2'], "text"),
                       GetSQLValueString($_POST['a3'], "text"),
                       GetSQLValueString($_POST['a4'], "text"),
                       GetSQLValueString($_POST['a5'], "text"),
                       GetSQLValueString($_POST['a6'], "text"),
                       GetSQLValueString($_POST['atm'], "text"));

  mysql_select_db($easyshop, $database_easyshop);
  $Result1 = mysqli_query($easyshop,$insertSQL) or die(mysql_error());

  $insertGoTo = "account.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
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
		            <div align="center"><a href="#" class="image fit"><img src="jpg/8.jpg" alt="" width="100%" height="154" /></a>
			
					    加入會員<br>
		                <a href="account_about.php">加入會員前請先看會員規章</a></div>
			            <form action="<?php echo $editFormAction; ?>" method="POST" name="form2" onSubmit="return aaa( );">
  <div align="center"></div>
  <input name="atm" type="hidden" id="atm" value="0">
  <table width="100%" border="0" align="center">
    <tr>
      <td bgcolor="#FFFFFF"><span class="style2 style7 style1">帳號</span>
	    <input name="a1" type="text" class="subscribe-email" id="a1" size="15" placeholder="帳號...">	  </td>
      </tr>
    <tr>
      <td background="../image/dfsgdfg.jpg" bgcolor="#FFFFFF"><span class="style8 style1">密碼</span>
	    <input name="a2" type="password" class="subscribe-email" id="a2" size="15" placeholder="密碼...">	  </td>
      </tr>
    <tr>
      <td background="../image/dfsgdfg.jpg" bgcolor="#FFFFFF"><span class="style8 style1">姓名</span>
        <input name="a3" type="text" class="subscribe-email" id="a3" size="15" placeholder="姓名..."></td>
      </tr>
    <tr>
      <td background="../image/dfsgdfg.jpg" bgcolor="#FFFFFF"><span class="style1"><span class="style8">地址</span></span>
        <input name="a4" placeholder="地址..." class="subscribe-email" type="text" id="a4" size="20"></td>
      </tr>
    <tr>
      <td background="../image/dfsgdfg.jpg" bgcolor="#FFFFFF"><span class="style8 style1">電話</span>
        <input name="a5" type="text" class="subscribe-email" id="a5" onKeyPress="if   (event.keyCode   <   46||event.keyCode   >   57)   event.returnValue   =   false;" size="15" placeholder="電話..."></td>
      </tr>
    <tr>
      <td background="../image/dfsgdfg.jpg" bgcolor="#FFFFFF"><span class="style8 style1">郵件</span>
        <input name="a6" placeholder="郵件..." class="subscribe-email" type="text" id="a6" size="20"></td>
      </tr>
    <tr>
      <td background="../image/dfgg.jpg" bgcolor="#FFFFFF"><div align="center" class="style2">
        <input type="submit" name="Submit" value="送出">
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
					    <table width="100%" border="2" bordercolor="#FFFFFF">
                          <tr>
                            <td bgcolor="#BFBFBF"><div align="center"><a href="account.php" class="style3"></a><a href="account.php" class="style3 style4">回登入頁</a></div></td>
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

<script language="javascript">
function aaa(){
if(document.form2.a1.value==""){
alert ("帳號要填唷!")
return false
}else if (document.form2.a2.value==""){
alert ("密碼要填唷!")
return false
}else if (document.form2.a3.value==""){
alert ("姓名要填唷!")
return false

}else if (document.form2.a5.value==""){
alert ("電話要填唷!")
return false

 

}
alert ("加入完畢!")
}
</script>


