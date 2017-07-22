
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>message</title>
  <script src="https://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

      <link rel="stylesheet" href="css/new/ticket.css">
      <link rel="stylesheet" href="css/new/base.css">

  
</head>

<body id='top'>
  <?php require_once('Connections/connSQL.php'); ?>
<?php
$maxRows_rs = 100;
$pageNum_rs = 0;
if (isset($_GET['pageNum_rs'])) {
  $pageNum_rs = $_GET['pageNum_rs'];
}
$startRow_rs = $pageNum_rs * $maxRows_rs;

mysqli_select_db($connSQL, $database_connSQL);
$query_rs = "SELECT * FROM s_product where kg='熱映中' ORDER BY lcd ASC";
$query_limit_rs = sprintf("%s LIMIT %d, %d", $query_rs, $startRow_rs, $maxRows_rs);
$rs = mysqli_query($connSQL, $query_limit_rs) or die(mysql_error());
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
  <section id="sidebar"> 
  <div class="white-label">
  </div> 
  <div id="sidebar-nav">   
    <ul>
      <li><a href="acc_index.php"><i class="fa fa-dashboard"></i>會員專區</a></li>
      <li><a href="transaction.php"><i class="fa fa-usd"></i>交易紀錄</a></li>
      <li><a href="inquire.php"><i class="fa fa-desktop"></i>餘額查詢</a></li>
      <li><a href="refund.php"><i class="fa fa-sitemap"></i>退票</a></li>
      <li><a href="message.php"><i class="fa fa-pencil-square-o"></i>意見回饋</a></li>
     
      <li><a href="index.php"/><a href="<?php echo $logoutAction ?>"><i class="fa fa-line-chart"></i>登出</a></li>
      
    </ul>
  </div>
</section>
<section id="content">
  <div id="header">
    <div class="header-nav">
      <div class="menu-button">
        <!--<i class="fa fa-navicon"></i>-->
      </div>
      <div class="nav"></div>
    </div>
  </div>
  <div class="content">
    <div class="content-header">
      <h1>線上訂票</h1>
      <p><?php echo $_SESSION['MM_Username']; ?>
        <span>,Welcome to Quick-Visual，Enjoy!</span>
      </p>
<?php do { ?> 
<div class="post">
  <div class="color_box"></div>
  <div class="img"><a href="tickets2.php?id=<?php echo $row_rs['pro_id']; ?>"><img src="system/store_photo/<?php echo $row_rs['s_file']; ?>" alt=""/></a></div>
  <div class="content">
    <h1 class="poster__title">片名:<?php echo $row_rs['s_product']; ?></h1>
    <h5 class="poster_man">領銜主演:<?php echo $row_rs['cpu']; ?></h5>
    <h5 class="poster__date">上映日期:<?php echo $row_rs['lcd']; ?></h5>
    <p class="poster__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam nam numquam rem repudiandae. Consequatur aliquid facere ut atque?</p>
   <a href="tickets2.php?id=<?php echo $row_rs['pro_id']; ?>">立即訂票</a>
  </div>
</div>
 <?php } while ($row_rs = mysqli_fetch_assoc($rs)); ?>
   </div>

  </div>

</section>

</body>
</html>
<?php
mysqli_free_result($rs);
?>