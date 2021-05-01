<?php
            include "./dbConection.php";
            if(isset($_POST['pid'])) 
            {
                    $pid = $_POST['pid'];
               
                    $resultAdd = mysqli_query($conn,"delete from products where pid='".$pid."'");
                    echo "product deleted successfully";
            }
            else
                echo "error occur in the query";


 ?>