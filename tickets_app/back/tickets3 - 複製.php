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
-->
        </style>
<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
	</head>
	<body id="top">
	<?php
	$_SESSION['studios']=$_POST['studios'];
	$_SESSION['hall']=$_POST['hall'];
	$_SESSION['items']=$_POST['items'];
	$_SESSION['num']=$_POST['num'];
	$_SESSION['id']=$_POST['id'];
	
	
	?>

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
						<h2>Movie Ticket APP</h2>
						 <div align="center"><img src="jpg/jhgkjghk.jpg" width="100%" height="153">
						   <a href="tickets2.php">回上頁</a>
						   <form name="form1" method="post" action="">
                         
					     </div>
						 <div align="center">
						 
						 <?PHP 
						 
						 echo $_POST['studios']." [".$_POST['hall']."] 場次:".$_POST['items']." 張數:".$_POST['num']."張";
						 

						 ?>
						 
						 </div>
						 <table width="100%" border="1" align="center" bordercolor="#000000">
                           
						   <tr>						   
						   <?php for($i=1;$i<=8;$i++){?>
                             <td>
							 <a href="tickets4.php?p=<?php echo  "A".$i?>"><?php echo "A".$i?></a>							 </td>                      
                          <?php }?>							 
                           </tr>
						   
                           <tr>
                            <?php for($i=1;$i<=8;$i++){?>
                             <td>
							 <a href="tickets4.php?p=<?php echo  "B".$i?>"><?php echo "B".$i?></a>							 </td>                      
                          <?php }?>	
                           </tr>
                           <tr>
                           <?php for($i=1;$i<=8;$i++){?>
                             <td>
							 <a href="tickets4.php?p=<?php echo  "C".$i?>"><?php echo "C".$i?></a>							 </td>                      
                          <?php }?>	
                           </tr>
                           <tr>
                              <?php for($i=1;$i<=8;$i++){?>
                             <td>
							 <a href="tickets4.php?p=<?php echo  "D".$i?>"><?php echo "D".$i?></a>							 </td>                      
                          <?php }?>	
                           </tr>
                           <tr>
                           <?php for($i=1;$i<=8;$i++){?>
                             <td>
							 <a href="tickets4.php?p=<?php echo  "E".$i?>"><?php echo "E".$i?></a>							 </td>                      
                          <?php }?>	
                           </tr>
                           <tr>
                            <?php for($i=1;$i<=8;$i++){?>
                             <td>
							 <a href="tickets4.php?p=<?php echo  "F".$i?>"><?php echo "F".$i?></a>							 </td>                      
                          <?php }?>	
                           </tr>
                           <tr>
                           <?php for($i=1;$i<=8;$i++){?>
                             <td>
							 <a href="tickets4.php?p=<?php echo  "G".$i?>"><?php echo "G".$i?></a>							 </td>                      
                          <?php }?>	
                           </tr>
                           <tr>
                           <?php for($i=1;$i<=8;$i++){?>
                             <td>
							 <a href="tickets4.php?p=<?php echo  "H".$i?>"><?php echo "H".$i?></a>							 </td>                      
                          <?php }?>	
                           </tr>
                           <tr>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td colspan="2" bgcolor="#CCCCCC"><div align="center"><strong>門口</strong></div></td>
                           </tr>
                         </table>   
                         <label> 
                           <div align="center">
                             <input type="submit" name="Submit" value="下 一 步">
                           </div>
                         </label>
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