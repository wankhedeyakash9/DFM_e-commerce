<?php
    if(session_status() ==PHP_SESSION_NONE)
        session_start();
    
    $pid = $_GET['pid'];
    unset($_SESSION['cart'][$pid]);
    if(count($_SESSION['cart']) ==0)
        echo "<div class='empty-cart-msg'> Your cart is empty! </div>"

?>