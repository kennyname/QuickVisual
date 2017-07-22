<?php require_once('Connections/connSQL.php'); ?>
<?php
$colname_rs = "-1";
if (isset($_GET['id'])) {
  $colname_rs = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysqli_select_db($connSQL, $database_connSQL);
$query_rs = sprintf("SELECT * FROM order_prod WHERE o_id = %s", $colname_rs);
$rs = mysqli_query($connSQL,$query_rs) or die(mysql_error());
$row_rs = mysqli_fetch_assoc($rs);
$totalRows_rs = mysqli_num_rows($rs);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">
<!--
.style1 {color: #666666}
.style2 {font-size: xx-large}
-->
</style>
</head>

<body>
<?php 
$_SESSION['pro_id']=$_GET['id'];
?>
<div align="center"><a href="Javascript:OnClick=history.back()" class="style1 style2">[回上頁]</a>
  <hr />
  <span class="style2">座位:<?php echo $row_rs['o_position']; ?><br />
  QRCODE</span></div>
<?php if($_GET['c']=="0"){?>
<iframe width=100% height=280 frameborder=0 scrolling=auto src=qrcode.php></iframe>
<?php }else{
echo " <span class=style2>此筆訂單巳交易</span>";
}?> <hr />









 <?php  
 $arr= explode(",",$row_rs['o_position']);
 
 //echo substr_count("ABC","A");
 
 ?>
						 <table width="100%" border="1" align="center" bordercolor="#000000">
                           
						   <tr>						   
						   <?php for($i=1;$i<=8;$i++){?>
                             <td <?PHP if(substr_count($row_rs['o_position'],"A".$i)=="1")echo "bgcolor=#FFFF66"?>>
						 <?php echo "A".$i?>							 </td>                      
                          <?php }?>							 
                           </tr>
						   
                           <tr>
                            <?php for($i=1;$i<=8;$i++){?>
                             <td <?PHP if(substr_count($row_rs['o_position'],"B".$i)=="1")echo "bgcolor=#FFFF66"?>>
							 <?php echo "B".$i?>						 </td>                      
                          <?php }?>	
                           </tr>
                           <tr>
                           <?php for($i=1;$i<=8;$i++){?>
                             <td <?PHP if(substr_count($row_rs['o_position'],"C".$i)=="1")echo "bgcolor=#FFFF66"?>>
							 <?php echo "C".$i?>							 </td>                      
                          <?php }?>	
                           </tr>
                           <tr>
                              <?php for($i=1;$i<=8;$i++){?>
                             <td <?PHP if(substr_count($row_rs['o_position'],"D".$i)=="1")echo "bgcolor=#FFFF66"?>>
							 <?php echo "D".$i?>							 </td>                      
                          <?php }?>	
                           </tr>
                           <tr>
                           <?php for($i=1;$i<=8;$i++){?>
                             <td <?PHP if(substr_count($row_rs['o_position'],"E".$i)=="1")echo "bgcolor=#FFFF66"?>>
							 <?php echo "E".$i?>							 </td>                      
                          <?php }?>	
                           </tr>
                           <tr>
                            <?php for($i=1;$i<=8;$i++){?>
                             <td <?PHP if(substr_count($row_rs['o_position'],"F".$i)=="1")echo "bgcolor=#FFFF66"?>>
							 <?php echo "F".$i?>							 </td>                      
                          <?php }?>	
                           </tr>
                           <tr>
                           <?php for($i=1;$i<=8;$i++){?>
                             <td <?PHP if(substr_count($row_rs['o_position'],"G".$i)=="1")echo "bgcolor=#FFFF66"?>>
							 <?php echo "G".$i?>						 </td>                      
                          <?php }?>	
                           </tr>
                           <tr>
                           <?php for($i=1;$i<=8;$i++){?>
                             <td <?PHP if(substr_count($row_rs['o_position'],"H".$i)=="1")echo "bgcolor=#FFFF66"?>>
							<?php echo "H".$i?>							 </td>                      
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
                     
















</body>
</html>
<?php
mysqli_free_result($rs);
?>
