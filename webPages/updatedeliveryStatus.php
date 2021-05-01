<?php
            include "./dbConection.php";
            if(isset($_POST['oid']))
            {
                    $oid = $_POST['oid'];
                    $delivery = $_POST['delivery'];
               
                $resultAdd = mysqli_query($conn, "update orders set status='" .$delivery. "' where oid= '".$oid."'");
            }
            else
                echo "error occur in the query";


 ?>

