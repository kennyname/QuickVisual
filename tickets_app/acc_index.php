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
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>User Dashboard</title>
  <script src="https://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <link rel="stylesheet" href="css/new/acc_index_style.css">

  
</head>

<body>
  <section id="sidebar"> 
  <div class="white-label">
  </div> 
  <div id="sidebar-nav">   
    <ul>
      <li class="active"><a href="#"><i class="fa fa-dashboard"></i>會員專區</a></li>
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
      <div class="nav">
        
      </div>
    </div>
  </div>
  <div class="content">
    <div class="content-header">
      <h1>會員專區</h1>
      <p><?php echo $_SESSION['MM_Username']; ?>
        <span>,Welcome to Quick-Visual，Enjoy!</span>
      </p>
    </div>
    <div class="widget-box sample-widget">
      <div class="widget-header">
        <h2>線上訂票</h2>
        
      </div>
      <div class="widget-content">
        <a href="tickets.php"><img src="https://www.southwesttrains.co.uk/globalassets/images/heros/buying-tickets.jpg"></a>
      </div>
    </div>
    <div class="widget-box sample-widget">
      <div class="widget-header">
        <h2>交易紀錄</h2>
        
      </div>
      <div class="widget-content">
        <a href="transaction.php"><img src="https://www.westbankstrong.com/filesystem/west-bank/Pages/Personal/CreditCards/header_CardServices.jpg"></a>
      </div>
    </div>
    <div class="widget-box sample-widget">
      <div class="widget-header">
        <h2>電影資訊</h2>
        
      </div>
      <div class="widget-content">
        <a href="information.php"><img src="http://thecomicscode.weebly.com/uploads/2/6/1/5/2615983/8760421_orig.jpg"></a>
      </div>
    </div>
    <div class="widget-box sample-widget">
      <div class="widget-header">
        <h2>意見回饋</h2>
        
      </div>
      <div class="widget-content">
        <a href="message.php"><img src="https://byswav.files.wordpress.com/2014/06/feather-and-ink-exchange-letters-initiative-by-swav-slawomir-krawczyk.jpg?w=900&h=300&crop=1"></a>
      </div>
    </div>
      
    </div>  
  </div>
</section>
  
</body>
</html>
