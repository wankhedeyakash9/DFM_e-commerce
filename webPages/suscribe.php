<?php
  include "dbConection.php";
  if(isset($_POST['suscribe']))
  {
        require '../phpMailer/PHPMailerAutoload.php';
        require '../phpMailer/class.smtp.php';
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        try
        {   
            
            $mail->Host='smtp.gmail.com';
            $mail->Port= 465;
            $mail->SMTPAuth=true;
            // $mail->SMTPDebug= 1;
            $mail->SMTPSecure='ssl';
            $mail->Username='martdivya@gmail.com';
            $mail->Password='himank123'; 
                            
            $mail->setFrom($_POST['suscribe'],'',0);
            $mail->addAddress($_POST['suscribe']);
            $mail->addReplyTo('martdivya@gmail.com');
            $mail->isHTML(true);
            $mail->Subject='Subscribtion';

            $s1="select * from users where email='$_POST[suscribe]'";
            $r1 = mysqli_query($conn,$s1);
            $s2="select * from suscribtion where Suscribe='$_POST[suscribe]'";
            $r2 = mysqli_query($conn,$s2);
            echo mysqli_num_rows($r2);
            echo mysqli_num_rows($r1);
            if(mysqli_num_rows($r2) == 0 && mysqli_num_rows($r1) == 0)
            {
        
                $mail->Body="<b>THANK YOU FOR SUSCRIBEING ON DFM WEB APP. STAY ON FOR THE LATEST DESIGN AND UPDATE.
                        THE DFM HAS THE LARGE QUANTITY AND BESTEST QUALITY OF THE FURNITURE. 
                        TO UNSUBSCRIBE US FOLLOW THIS LINK.</b> <a style='color:red;' href='http://divyafurnituremart.epizy.com/suscribe.php?unsuscribe=$_POST[suscribe]'> Unsuscribe </a>";
                
                $s="INSERT INTO `suscribtion`(`Suscribe`, `date`) VALUES ('$_POST[suscribe]',current_timestamp())";   
                $sus=mysqli_query($conn,$s);     
            }
            else
            {

                $mail->Body="<b>THANK YOU FOR SUSCRIBEING ON DFM WEB APP. YOU ARE ALREADY REGISTERED</b>
                            <a style='color:red;' href='http://divyafurnituremart.epizy.com/suscribe.php?unsuscribe=$_POST[suscribe]'> Unsuscribe </a>";
                    
            }

            if(!$mail->send()){ $res="Not done"; }

            else { $res="done"; }  
            echo $res;
            
            echo "sent mail ";
        }

        catch (phpmailerException $e) 
        {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage(); //Boring error messages from anything else!
        }

        
        echo "<script>window.location='index.php'; </script>";
    }

    if(isset($_GET['unsuscribe']))
    {

        $d="delete from suscribtion where suscribe='$_GET[unsuscribe]'";
        $rd=mysqli_query($conn,$d);
        ?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <div class="container">
            <div style="display: table; margin:30px auto; padding:30px; border:3px solid #008eff;border-radius:10px">
                <div style="text-align: center;"><img src="../DFMlogo.png" alt="" height="100" width="100"></div>
                <h2>You have been unsubscribed with us.</h2>
                <br>
                In future again susbscribe us for latest furniture products.DFM is one of the best furniture seller.
                <br>
                Click this link to visit our site
                <a style='color:red;' href='http://divyafurnituremart.epizy.com/webpages'>Divya FurnitureMart</a>";

            </div>
        </div>
        <?php
    }
            
?>
  