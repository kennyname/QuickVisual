<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>
<p>
  <?php
$_SESSION['o'][]=$_GET['p'].","
?>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><a href="tickets3.php">
<?php 
//$i=count($_SESSION['o']) - 1;
echo $_SESSION['o'][0];
echo $_SESSION['o'][1];
echo $_SESSION['o'][2];
echo $_SESSION['o'][3];
echo $_SESSION['o'][4];
echo $_SESSION['o'][5];
echo $_SESSION['o'][6];
echo $_SESSION['o'][7];

 
$_SESSION['chk']=$_SESSION['o'][0].$_SESSION['o'][1].$_SESSION['o'][2].$_SESSION['o'][3].$_SESSION['o'][4].$_SESSION['o'][5].$_SESSION['o'][6].$_SESSION['o'][7];
 
 
?>
 


    <script language=javascript>
alert("選擇完畢");
setTimeout("location.href='tickets3.php'",0);
    </script>
  
  
</a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
