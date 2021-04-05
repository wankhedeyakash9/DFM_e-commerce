<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();
    unset($_SESSION['username']);
    unset($_SESSION['userid']);
    unset($_SESSION['admin']);
    echo "<script>location.href = './'</script>";
?>
