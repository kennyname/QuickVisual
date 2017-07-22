<?php
        include 'phpqrcode/qrlib.php';
        
        echo QRcode::png('http://163.13.201.117/tickets_app/checkout.php?id='.$_SESSION['pro_id'], false, 'L', 7);
?>
