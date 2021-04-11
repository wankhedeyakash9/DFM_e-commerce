<?php
    include "dbConection.php";
      if(isset($_POST['pass']))
      {
         $pass= $_POST['pass'];
         $query="select * from users where Email='admin'";
         $result= mysqli_query($conn,$query);
         $resultArray = mysqli_fetch_array($result);

         if($pass!= $resultArray['password'])
         {    
             echo 'Incorrect password! Please try again.';
            die();
         }
         if(session_status() == PHP_SESSION_NONE)
            session_start();
            $_SESSION['admin'] = $resultArray['Name'];
            $_SESSION['username']=$resultArray['Name'];
            echo "<script> location.reload(); </script>";
            echo "<script> window.location='newadmin.php'; </script>";
      }
?>