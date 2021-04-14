<?php
            include "./dbConection.php";
            if(isset($_POST['oid']))
            {
                    $oid = $_POST['oid'];
                    // $delivery = $_POST['delivery'];
                    $status = 'returned';
               
                $resultAdd = mysqli_query($conn, "update ordercancel set reason ='" . $status . "' where oid= '".$oid."'");
            }
            else
                echo "error occur in the query";
