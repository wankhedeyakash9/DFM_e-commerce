<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<?php
    session_start();
    include_once "./dbConection.php";
    $error_message = "";
    mysqli_query($conn, "delete from otp_expiry where NOW() > DATE_ADD(create_at, INTERVAL 10 MINUTE)");
    date_default_timezone_set("Asia/Kolkata");

    if(isset($_POST['resend']) && isset($_SESSION['email']))
    {
        $result = mysqli_query($conn, "SELECT otp from otp_expiry where NOW() <= DATE_ADD(create_at, INTERVAL 10 MINUTE) and 
                        for_user = '$_SESSION[email]' ");
        $otp = mysqli_fetch_array($result)[0];

        require '../phpMailer/PHPMailerAutoload.php';
        require '../phpMailer/class.smtp.php';
        $mail = new PHPMailer(true);
        $mail->isSMTP();
                
        $mail->Host='smtp.gmail.com';
        $mail->Port= 465;
        $mail->SMTPAuth=true;
        // $mail->SMTPDebug= 1;
        $mail->SMTPSecure='ssl';
        $mail->Username='martdivya@gmail.com';
        $mail->Password='himank123'; 
                        
        $mail->setFrom('martdivya@gmail.com','Divya Furniture Mart',0);
        $mail->addAddress($_SESSION['email']);
        $mail->addReplyTo('martdivya@gmail.com');
        $mail->isHTML(true);
        $mail->Subject='Forget Password';
        $mail->Body = "One Time Password to generate your new password is <b>$otp</b><br><br> 
        <b>Remember this one time password is valid for only 10 minutes</b>"; 
        
        $mail->send();
        die();
    }

    if(isset($_POST['email']) && trim($_POST['email']) != "")
    {
        $email = $_SESSION['email'] = $_POST['email'];

	    $result = mysqli_query($conn,"SELECT * FROM users WHERE email='" . $_POST["email"] . "'");
        $count  = mysqli_num_rows($result);
        
        if($count>0) 
        {
            $otp = rand(100000,999999);        
            
            require '../phpMailer/PHPMailerAutoload.php';
            require '../phpMailer/class.smtp.php';
            $mail = new PHPMailer(true);
            $mail->isSMTP();
                 
            $mail->Host='smtp.gmail.com';
            $mail->Port= 465;
            $mail->SMTPAuth=true;
            // $mail->SMTPDebug= 1;
            $mail->SMTPSecure='ssl';
            $mail->Username='martdivya@gmail.com';
            $mail->Password='himank123'; 
                            
            $mail->setFrom('martdivya@gmail.com','Divya Furniture Mart',0);
            $mail->addAddress($_SESSION['email']);
            $mail->addReplyTo('martdivya@gmail.com');
            $mail->isHTML(true);
            $mail->Subject='Forget Password';
            $mail->Body = "One Time Password to reset your new password is <b>$otp</b><br><br>
            <b>Remember this one time password is valid for only 10 minutes</b>"; 

             $_SESSION["mail_status"] = $mail->send();
        
            if($_SESSION['mail_status']) 
            {
                $result = mysqli_query($conn,"INSERT INTO otp_expiry(otp,is_expired,create_at,for_user) VALUES 
                            ($otp, 0, '". date("Y-m-d H:i:s")."','$_SESSION[email]')");
                echo mysqli_error($conn);
                $_SESSION['otpCount'] = 3;
                ?>
                <div class="container">

                <div style="display: table; margin:30px auto; padding:30px; border:3px solid #008eff;border-radius:10px">
                    <div style="text-align: center;"><img src="../DFMlogo.png" alt="" height="100" width="100"></div>
                    <h2>OTP has been sent to your mail <?php $_SESSION['email']?></h2>
                    <div>Enter OTP:</div>
                    <form action="#" method="post" onsubmit= "return submitOTP()">
                        <input class="OTP" type="text" name="OTP"  required ><br>
                        <input class="" type="submit">
                    </form>
                    <br>
                    <div id="msg"></div>
                    <div id="resend-container">
                        <a href="#" id="resend">Resend OTP</a>
                    </div>
                </div>
                </div>
                <?php
            }
            else $error_message = "Unable to send OTP! Please try again later<br>
                                   Return to <a href='./'>HOME</a> ";
        } 
        else 
        {    
            $error_message = "This email has not been registerd with us yet.<br>
                              Please go to <a href='./'>HOME</a> and registed with us.";
            unset($_SESSION['email']);

        }
        if($error_message!="")
        {
            ?>
            <div class="container">
                <div style="display: table; margin:30px auto; padding:30px; border:3px solid #008eff;border-radius:10px">
                <div style="text-align: center;"><img src="../DFMlogo.png" alt="" height="100" width="100"></div>
                <?php echo $error_message ?>
                </div>
            </div>
            <?php
        }
    }
    

    elseif(isset($_POST['OTP']) && trim($_POST['OTP'])!="")
    {
	    $result = mysqli_query($conn,"SELECT * FROM otp_expiry WHERE otp='$_POST[OTP]' 
                                AND is_expired!=1 AND NOW() <= DATE_ADD(create_at, INTERVAL 10 MINUTE)
                                AND for_user = '$_SESSION[email]'");
        $isValid = mysqli_num_rows($result);
        
        if($isValid)
        {
            ?>
            <div class="container">
                <div style="display: table; margin:30px auto; padding:30px; border:3px solid #008eff;border-radius:10px">
                    <div style="text-align: center;"><img src="../DFMlogo.png" alt="" height="100" width="100"></div>
                    <h1>Create new password</h1>
                    <p>
                        We'll ask for this password whenever you sign in.
                    </p>
                    <form action="#" method="post" onsubmit="return checkPsw()">
                        <label for="password"class="label1">Password </label><br>
                        <input class="form-control style1"type="password" name="passwd" id="pwd" placeholder="********"required><br>
                        
                        <label class="label1">Re-enter Password</label><br>
                        <input class="form-control style1"type="password" name="rpasswd" id="rpwd" placeholder="reenter the password" required><br>
                        <input type="submit">
                    </form>
                    <br>
                    <div id="msg"></div>
                    
                </div>
            </div>
            <?php
        }
        else
        {
            $_SESSION['otpCount'] --;
            echo "<script>location.href= './forget.php'</script>";            
        }
    }

    elseif(isset($_POST['passwd'])&& isset($_POST['rpasswd']))
    {
        mysqli_query($conn, "DELETE from otp_expiry where for_user='$_SESSION[email]'");
        if($_POST['passwd'] == $_POST['rpasswd'])
        {
            $result = mysqli_query($conn,"update users set password='$_POST[passwd]' where email= '$_SESSION[email]'");
            

            
            if($result)
            {
                ?>
                <div class="container">
                    <div style="display: table; margin:30px auto; padding:30px; border:3px solid #008eff;border-radius:10px">
                        <div style="text-align: center;"><img src="../DFMlogo.png" alt="" height="100" width="100"></div>
                        <h2>Your password has been changed succesfully!</h2>
                        <div>
                            Please go <a href="./">HOME</a> and Login to continue..
                        </div>
                    </div>
                </div>
                <?php
                require '../phpMailer/PHPMailerAutoload.php';
                require '../phpMailer/class.smtp.php';
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                    
                $mail->Host='smtp.gmail.com';
                $mail->Port= 465;
                $mail->SMTPAuth=true;
                // $mail->SMTPDebug= 1;
                $mail->SMTPSecure='ssl';
                $mail->Username='martdivya@gmail.com';
                $mail->Password='himank123'; 
                                
                $mail->setFrom('martdivya@gmail.com','Divya Furniture Mart',0);
                $mail->addAddress($_SESSION['email']);
                $mail->addReplyTo('martdivya@gmail.com');
                $mail->isHTML(true);
                $mail->Subject='Divya Furniture Mart Password Reset';
                $mail->Body ="Hi, your password was reset on ".date("Y-m-d H:i:s").
                "<br><br><b>If you did this</b>,you can safely ignore this email.<br>
                <b>If you didn't do this</b> write us at<b>martdivya@gmail.com</b>"; 
                
                $mail->send();

                session_destroy();
            }
            else
            echo '<div> Error in changing password! Please try again after sometime</div>';

        }
        else echo "<div>The password is not same</div>";
    }

    else if(isset($_SESSION['mail_status']))
    {
        if($_SESSION['otpCount']<=0)
        {
        ?>
            <div class="container">
            <div style="display: table; margin:30px auto; padding:30px; border:3px solid #008eff;border-radius:10px">
                <div style="text-align: center;"><img src="../DFMlogo.png" alt="" height="100" width="100"></div>
                Your failed to enter the correct OTP three times!<br>
                You can't change the password<br>
                Please try again after sometime
                <br><br>
                Return to <a href="./">HOME</a>
            </div>
            </div>
        <?php
            mysqli_query($conn, "DELETE from otp_expiry where for_user='$_SESSION[email]'");
            session_destroy();
            die();

        }
        ?>
        <div class="container">
            <div style="display: table; margin:30px auto; padding:30px; border:3px solid #008eff;border-radius:10px">
                <div style="text-align: center;"><img src="../DFMlogo.png" alt="" height="100" width="100"></div>
                <h2>OTP has been sent to your mail <?php $_SESSION['email']?></h2>
                <div>Enter OTP:</div>
                <form action="#" method="post" onsubmit="return submitOTP()">
                    <input class="OTP" type="text" name="OTP" required><br>
                    <input class="" type="submit">
                </form>
                <br>
                <div id="msg"></div>

                <div style="color:red">
                    The OTP is incorrect or expired,<?php echo $_SESSION['otpCount']?>  attemps left.  
                    <br>Try again!
                </div>
                <div id="resend-container">
                    <a href="#" id="resend">Resend OTP</a>
                </div>
            </div>
        </div>
        <?php
    }


    else
    {
             
        ?>
        <div  class="container">
            <div style="display: table; margin:30px auto; padding:30px; border:3px solid #008eff;border-radius:10px">
            <div style="text-align: center;"><img src="../DFMlogo.png" alt="" height="100" width="100"></div>
            <form action="#" method="post">
                <h1>Forgot Password: </h1>
                <div style="margin-left: 2px">Enter the email address associated with your Account <br> </div><br>
                <label for="email"> Enter Your Email </label> 
                <input type="email" name="email" placeholder="Email" class=" form-control login-input" required> <br><br>
                <input type="submit"  value="Continue" class="sbtn">   
            </form>     
            </div>
        </div>
        <?php
    }

?>
<script>
    $("#resend").click(function(){
        $.post("./forget.php",{resend:true},function(data){
                console.log(data)
                $('#resend-container').html("The OTP has been sent again!")} )
    })

    function submitOTP()
    {
        if ($(".OTP").val().trim() =="")
        {    
            $("#msg").text("Please enter the OTP before submit.")
            return false
        }
        else if ($(".OTP").val().length !=6)
        {
            $("#msg").text("OTP is a six digit code")
            return false
        }
        return true
    }
    function checkPsw()
    {
        if ( $("#rpwd").val()!=$("#pwd").val())
        {
            $("#msg").text("The passwords are not same")
            return false;
        }
        else if($("#pwd").val().trim()=="")
        {
            $("#msg").text("Enter valid password")
            return false
        }
        return true

    }
    $("#pwd").keyup(function(){
        if($("#pwd").val().length < 8)
        {
            $("#pwd").css("border","2px solid red")
            $("#msg").text("Password should be atleast 8 characters long")

        }
        else
            $("#pwd").css("border","2px solid green")
            $("#msg").text("")


    })


    $("#rpwd").keyup(function(){
        console.log($("#rpwd").val() != $("#pwd").val())
        if($("#rpwd").val() != $("#pwd").val())
        {
            $("#rpwd").css("border","2px solid red")
        }
        else
            $("#rpwd").css("border","2px solid green")

    })

</script>

<style>
    #msg{
        color: red;
    }
</style>