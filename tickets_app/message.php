<?php require_once('Connections/connSQL.php'); ?>
<?php
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
  $insertSQL = sprintf("INSERT INTO t_talk (t_name, t_text, t_re, t_sex) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['text'], "text"),
                       GetSQLValueString($_POST['re'], "text"),
                       GetSQLValueString($_POST['sex'], "text"));

 mysqli_select_db($connSQL, $database_connSQL);
  $Result1 = mysqli_query($connSQL,$insertSQL) or die(mysql_error());

  $insertGoTo = "message.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>message</title>
  <script src="https://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <link rel="stylesheet" href="css/new/message.css">

  
</head>

<body>
  <section id="sidebar"> 
  <div class="white-label">
  </div> 
  <div id="sidebar-nav">   
    <ul>
      <li><a href="acc_index.php"><i class="fa fa-dashboard"></i>會員專區</a></li>
      <li><a href="transaction.php"><i class="fa fa-usd"></i>交易紀錄</a></li>
      <li><a href="inquire.php"><i class="fa fa-desktop"></i>餘額查詢</a></li>
      <li><a href="refund.php"><i class="fa fa-sitemap"></i>退票</a></li>
      <li class="active"><a href="message.php"><i class="fa fa-pencil-square-o"></i>意見回饋</a></li>
     
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
      <h1>意見回饋</h1>
      <p><?php echo $_SESSION['MM_Username']; ?>
        <span>,Welcome to Quick-Visual，Enjoy!</span>
      </p>
    <div class="container">  
 <form id="contact" name="form1" method="POST" action="<?php echo $editFormAction; ?>" onSubmit="return aaa();" >
    <h3>Quick Contact</h3>
    <h4>Contact us today, and get reply with in 24 hours!</h4>
    <fieldset>
      <input placeholder="Your name" name="name" id="name" value="<?php echo $_SESSION['MM_Username']?>" type="text" required="required" autofocus="autofocus">
    </fieldset>
    <fieldset>
      <select name="sex" id="sex">
          <option value="男">男</option>
          <option value="女">女</option>
      </select>
    </fieldset>
    <fieldset>
      <select name="re" id="re">
          <option value="其他">其他</option>
          <option value="建議">建議</option>
          <option value="申訴">申訴</option>
          <option value=" 匯款確認"> 匯款確認</option>
      </select>
    </fieldset>
    <fieldset>
      <textarea placeholder="Type your Message Here...." name="text" id="text" required="required" autofocus="autofocus"></textarea>
    </fieldset>
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
    </fieldset>
     <input type="hidden" name="MM_insert" value="form1">
  </form>
 
  
</div>
    </div>
     
  </div>
</section>
  
</body>
</html>
