<?php
            include "./dbConection.php";
            if(isset($_POST['quant'])) 
            {
                // echo "inside the if condition to add the product";
                    $quant = $_POST['quant'];
                    $pid = $_POST['pid'];
                    // echo "pid= ".$pid;
                    // echo "quant= ".$quant;
                $resultAdd = mysqli_query($conn,"update products set quantity=quantity+'" .$quant. "' where pid= '".$pid."'");
               
                    $resultAdd = mysqli_query($conn,"select quantity from products where pid='".$pid."'");
                    // 
                    $resultUpdate= mysqli_fetch_array($resultAdd);                
                    echo $resultUpdate[0];
                // echo "inside if on add stock page";
            }
            else
                echo "error occur in the query";


 ?>