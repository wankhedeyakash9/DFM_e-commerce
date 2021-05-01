<?php

    include_once "./dbConection.php";

    $user=$_POST["uname"];
    $pass=$_POST["pwd"];

    $query="select * from users where Email='$user'";
    $result= mysqli_query($conn,$query);
    $resultArray = mysqli_fetch_array($result);
    // error_reporting(0);
    if (mysqli_num_rows($result)==0)
    {
        echo '<span class="fas fa-info-circle"></span> User not found ! Please enter valid username or Sign up ';
        die();
    }
    else if($pass!= $resultArray['password'])
    {    echo 'Incorrect password! Please try again.';
        die();
    }
    
    session_start();
    $_SESSION['username'] = $resultArray['Name']; 
    $_SESSION['userid']      = $_POST['uname'];
    echo "<script> location.reload(); </script>";
    
    die();
?>