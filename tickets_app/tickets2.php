<?php require_once('Connections/connSQL.php'); ?>
<?php
$colname_rs = "-1";
if (isset($_GET['id'])) {
  $colname_rs = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysqli_select_db($connSQL, $database_connSQL);
$query_rs = sprintf("SELECT * FROM s_product WHERE pro_id = %s", $colname_rs);
$rs = mysqli_query($connSQL,$query_rs) or die(mysql_error());
$row_rs = mysqli_fetch_assoc($rs);
$totalRows_rs = mysqli_num_rows($rs);
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
.style12 {color: #FEFEFE}
.style24 {font-family: "標楷體"; color: #666666; font-size: small; }
.style27 {font-family: "標楷體"; font-size: small; }
.style28 {font-size: medium}
-->
        </style>

	</head>
	<?php
	$_SESSION['studios']="";
	$_SESSION['hall']="";
	$_SESSION['items']="";
	$_SESSION['num']="";
	$_SESSION['id']=""; 
	$_SESSION['chk']="";
 unset($_SESSION['o']);
	
	?>
	
	
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
					<h2>Quick-Visual</h2>
		  <p>&nbsp;</p>
	  </header>
				<div class="container">
					<section>
						<h2><a href="tickets.php"><span class="style28">[回上頁]</span></a></h2>
						 
						 <form name="form1" method="post" action="tickets3.php" onSubmit="return aaa();" >
                          <tr>
                            <td bgcolor="#FFFFFF"><span class="style24"><?php echo $row_rs['s_product']; ?>(<?php echo $row_rs['s_ps']; ?>)</span></td>
                          </tr>
                          <tr>
                            <td bgcolor="#FFFFFF"><a href="information.php" class="style12"><span class="style24">上映日期:<?php echo $row_rs['lcd']; ?></span></a></td>
                          </tr>
                          <tr>
                            <td bgcolor="#FFFFFF"><span class="style24">主演:<?php echo $row_rs['cpu']; ?></span></td>
                          </tr>
                          <tr>
                            <td bgcolor="#FFFFFF"><span class="style27">簡介:<?php echo $row_rs['s_text']; ?></span></td>
                          </tr>
                          <tr>
                            <td bgcolor="#FFFFFF"><span class="style27">選擇影城
                                <label>
                                <select name="studios" id="studios">
                                  <option value="0">選擇影城..</option>
                                  <option value="影城1">華納威秀</option>
                                  <option value="影城2">欣欣秀泰</option>
                                  <option value="影城3">美麗華影城</option>
                                  <option value="影城4">陽明戲院</option>
                                  <option value="影城5">威尼斯影城</option>
                                  </select>
                                </label>
                            </span></td>
                          </tr>
                          <tr>
                            <td bgcolor="#FFFFFF"><span class="style27">選擇廳
                                <select name="hall" id="hall">
                                  <option value="0">選擇廳...</option>
                                  <option value="A廳">A廳</option>
                                  <option value="B廳">B廳</option>
                                  <option value="C廳">C廳</option>
                                  <option value="D廳">D廳</option>
                                </select>
                            </span></td>
                          </tr>
                          <tr>
                            <td bgcolor="#FFFFFF"><span class="style27">選擇場次
                                <select name="items" id="items">
                                  <option value="0">請選擇場次..</option>
                                  <option value="10~12">10~12 票價:220</option>
                                  <option value="12~14">12~14 票價:240</option>
                                  <option value="14~16">14~16 票價:240</option>
                                  <option value="16~18">16~18 票價:240</option>
                                  <option value="18~20">18~20 票價:240</option>
                                  <option value="20~22">20~22 票價:240</option>
                                  <option value="22~24">22~24 票價:240</option>
                                  <option value="00~02">00~02 票價:240</option>
                                </select>
                            </span></td>
                          </tr>
                          <tr>
                            <td bgcolor="#FFFFFF"><span class="style27">選擇張數
                              <label>
                              <select name="num" id="num">
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                              </select>
                              </label>
                              <input name="id" type="hidden" id="id" value="<?php echo $row_rs['pro_id']; ?>">
                            </span></td>
                          </tr>
                          <tr>
                            <td bgcolor="#FFFFFF"><label>
                              <div align="center">
                                <input type="submit" name="Submit" value="送     出">
                                </div>
                            </label></td>
                          </tr>
                      </table>  
						 </form>
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
<?php
mysql_free_result($rs);
?>
<script language="javascript"> 
function aaa(){ 
if(document.form1.studios.value=="0"){ 
alert ("影城要填唷!") 
return false 
}else if (document.form1.hall.value=="0"){ 
alert ("影廳要填唷!") 
return false 
}else if (document.form1.items.value=="0"){ 
alert ("場次要填唷!") 
return false 
} } 
</script>