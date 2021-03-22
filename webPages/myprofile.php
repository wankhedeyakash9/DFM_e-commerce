<?php 
  if(session_status() == PHP_SESSION_NONE)
    session_start();
  if(! isset($_SESSION['userid']))
    {
      echo "<script>location.href = './'</script>";
      die();
    }
?>
<html>
    <head>
        <title>MyProfile</title>
        <link rel="icon" href="../DFMlogo.png" type="image/x-icon">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../styleSheets/myprofile.css">
    </head>
    <?php include "header.php"; ?>
    <?php
                    include "dbConection.php";
                    $result=mysqli_query($conn,"Select name,contact,email,password from users where email='$_SESSION[userid]'");
                    $result=mysqli_fetch_row($result); 
                    if(isset($_POST['deladd']))
                    {
                        $add=$_POST['deladd'];
                        $query = "DELETE from address where address='$add' ";
                        $rslt  = mysqli_query($conn,$query);
                        echo mysqli_num_rows($rslt);
                        echo  mysqli_error($conn);
                        
                    }
                    elseif(isset($_POST['name']))
                    {
                        $name=$_POST['name'];
                        $query = "Update users SET name='$name' where email='$_SESSION[userid]' ";
                        $result=mysqli_query($conn,$query);
                    }
                    elseif(isset($_POST['contact']))
                    {
                        $contact=$_POST['contact'];
                        $query = "Update users SET contact='$contact' where email='$_SESSION[userid]' ";
                        $result=mysqli_query($conn,$query);
                    }  
                    elseif(isset($_POST['pass']))
                    {
                        
                        if($_POST['pass'] == $result[3])
                        {
                            
                            if( $_POST['npass'] == $_POST['cpass'] )
                            { 
                                
                                    $pass= $_POST['cpass'] ;
                                    $query = "Update users SET password='$pass' where email='$_SESSION[userid]' ";
                                    $result=mysqli_query($conn,$query);  
                                ?>
                                    <script>
                                        $('#editform3 > input[type=password]').val("").css('border', '1px solid #ccc');
                                        $("#editform3").hide("slow");
                                        setTimeout(function(){
                                            $("#editform3").parent().append("<div class='psw-chnged-msg' style='color: green;font-size: 1.5rem;font-weight:600px;'><video src='../pics/greentick.mp4' preload='auto' autoplay width='100px' height='100px'></video> <div style='position:relative; display:inline-block;top:-40px;'> You have successfully updated your password !</div></div>");
                                        },800);
                                         setTimeout(function(){$(".psw-chnged-msg").remove();},5000);
                                        $("#change").show();
                                    </script>
                                     
                                <?php
                            }
                            else
                            { 
                                echo "<script> $('#cpass').css('border', '1px solid red');  </script>";  
                            }
                        }    
                        else
                        {  
                            echo "<script> $('#pass').css('border','1px solid red');  </script>";  
                        }
                    }
                    else
                    {

                    
    ?>
    <div id="m" class="main-content">    
       <div id="data" > 
            <div id="name">   
                 <?php $row=mysqli_query($conn,"Select image from profile where name = substring('$result[0]',1,1)");
                    while ($rows = mysqli_fetch_array($row))
                    {
                 ?>   
                 <img id="alpha" src="data:image/jpeg;base64,<?php echo $rows['image'];?>" alt="alpha" height="80px" width="80px">
                  <?php  if(strlen($result[0])<14)
                    {
                  ?>
                        <b> <?php echo $result[0]; ?> </b>  
                 
                    <?php } elseif(strlen($result[0])>14){ ?>      
                    <b style="font-size: 15px;"> <?php  echo $result[0]; ?> </b>

                <?php }else{

                ?>
                     <b style="font-size: 12px;"> <?php  echo $result[0]; ?> </b>
               <?php
                }
            
            } ?>
            </div>
            <div id="prof">
                <div id="acc" style="height: 40px;"> <i class="fa fa-user" style="font-size:24px; color:blue;"></i> ACCOUNT SETTINGS  </div>
                <div id="profile" style="height: 40px;"> <a id="aprofile" href="#"> Profile </a> </div>
                <div id="address" style="height: 40px;"> <a id="aaddress" href="#"> Manage Address </a> </div>
                <div id="order" style="height: 40px;"> <a  href="myorder.php"> My Orders </a> </div>
            </div>
       </div>
       <div id="contain" >
            <div id="mypro"> 
                    <div>
                       <form id="editform1" method="post" action="myprofile.php" class="w3-container">
                            <br><label for="name">Name</label>   
                            <a id="edit1" href="#" style="color:blue";>Edit</a>
                            <br> 
                            <input id="fullname" name="name" type="text" value="<?php echo $result[0];  ?>" disabled/>     
                            <input type="submit" class="save" id="save1" value="save"/>
                            <br>
                        </form>
                    </div>
                    <div>
                        <form id="editform2" method="post" action="myprofile.php" class="w3-container">
                            <br><label for="contact">Contact-No.</label>   
                            <a id="edit2" href="#" style="color:blue";>Edit</a> 
                            <br>
                            <input id="contact" pattern="[0-9]{10}" title="Please input 10 digit number" name="contact" type="text" value=" <?php echo $result[1];?>" disabled/>     
                            <input type="submit" class="save" id="save2" value="save"/>
                            <br>

                        </form>
                    </div> 
                    <div>
                        <br><label for="email">Email</label>  
                        <br>
                        <input id="email" name="email" type="text" value="<?php echo $result[2]; ?>" disabled/> <br>    
                        <br> <a id="change" style="color:blue" href="#" >Change Password</a> <br>
                    </div>
                    <div id="passw"> 
                        <form id="editform3" method="post" action="myprofile.php" class="w3-container">
                            <br>
                            <label id="lpass" for="pass">Old Password</label>  <br>
                            <input required id="pass" name="pass" type="password"  /><br>
                            <label  id="lnpass"  for="npass">New Password</label>   <br>
                            <input pattern=".{8,}" title="Password Should Be More Than 8 Characters" required type="password" id="npass" name="npass"/><br>
                            <label id="lcpass" for="cpass">Confirm Password</label> <br> 
                            <input required type="password" id="cpass" name="cpass"/><br>
                            <input type="submit" class="btn" id="save4" value="save"/> 
                            <input type="button" class="btn btn-danger" id="cancelpass"  value="Cancel"/> <br>
                        </form>      
                    </div> 
                    
            </div>
            <div id="add"> 
                <div> <h3> Manage Addresses </h3> </div>
                <div id="newadd" style="border:0.1px solid lightgray;"><a href="#" id="anewadd" style="color:blue;"> <i class="fa fa-plus" style="color:blue";></i> ADD A NEW ADDRESS </a> </div>
                <br>
                <div id="addform">
                     <form id="adresform" action="./myprofile.php" method="post">
                       <br><label id="adr" for="address">Address</label>  <br> 
                        <input name="address" id="address" type="text"> <br> <br>
                        <label id="city" for="city">City</label>  <br>
                        <input name="city" id="city" type="text"><br> <br>
                        <label id="pin" for="pincode">Pincode</label>  <br>
                        <input name="pincode" id="pincode" type="text"><br>
                        <br><label id="state" for="state">State</label>  <label id="typ" for="typ">Type</label>   <br>
                         <select name="state" id="state">
                                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                            <option value="Assam">Assam</option>
                                            <option value="Bihar">Bihar</option>
                                            <option value="Chandigarh">Chandigarh</option>
                                            <option value="Chhattisgarh">Chhattisgarh</option>
                                            <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                            <option value="Daman and Diu">Daman and Diu</option>
                                            <option value="Delhi">Delhi</option>
                                            <option value="Lakshadweep">Lakshadweep</option>
                                            <option value="Puducherry">Puducherry</option>
                                            <option value="Goa">Goa</option>
                                            <option value="Gujarat">Gujarat</option>
                                            <option value="Haryana">Haryana</option>
                                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                                            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                            <option value="Jharkhand">Jharkhand</option>
                                            <option value="Karnataka">Karnataka</option>
                                            <option value="Kerala">Kerala</option>
                                            <option selected value="Madhya Pradesh">Madhya Pradesh</option>
                                            <option value="Maharashtra">Maharashtra</option>
                                            <option value="Manipur">Manipur</option>
                                            <option value="Meghalaya">Meghalaya</option>
                                            <option value="Mizoram">Mizoram</option>
                                            <option value="Nagaland">Nagaland</option>
                                            <option value="Odisha">Odisha</option>
                                            <option value="Punjab">Punjab</option>
                                            <option value="Rajasthan">Rajasthan</option>
                                            <option value="Sikkim">Sikkim</option>
                                            <option value="Tamil Nadu">Tamil Nadu</option>
                                            <option value="Telangana">Telangana</option>
                                            <option value="Tripura">Tripura</option>
                                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                                            <option value="Uttarakhand">Uttarakhand</option>
                                            <option value="West Bengal">West Bengal</option>
                        </select>                      
                        <select name="type" id="type">
                                            <option selected value="Home">Home</option>
                                            <option value="Work">Work</option>
                        </select><br>
                        <br> 
                        <input type="submit" id="addsav" value="save"/>
                        <input type="button" id="addc"  value="Cancel"/> <br>
                     </form> 
                </div>
                <div id="addr">
                     
                        
                    
                    <div id="a1">  
                        <?php 
                            if(isset($_POST['address']) && isset($_POST['pincode']))
                            {
                                $address=$_POST['address'];
                                $city=$_POST['city'];
                                $state=$_POST['state'];
                                $pincode=$_POST['pincode'];
                                $type=$_POST['type'];
                                include "dbConection.php";
                                $add=mysqli_query($conn,"insert into address(Address,city,state,pincode,types,uid) values('$address','$city','$state','$pincode','$type','$_SESSION[userid]')") or die("not done");
                                echo mysqli_error($conn);
                                echo "<script> $('#aaddress').click() </script>";
                            }?>
                            <table class="table table-striped table-hover table-responsive"><tbody>
                            <?php 
                                        $result=mysqli_query($conn,"Select types,address,city,state,pincode from address where uid='$_SESSION[userid]'");
                                        while($res=mysqli_fetch_assoc($result)){
                                        $rest=$res['types'];
                                        echo "<tr> <td> <input type='submit' disabled value=$rest>";
                                        echo "  <td>" .  $res['address'] ." </td><td> " . $res['city'] ."</td> <td>" . $res['state'] ."</td><td> ". $res['pincode'] . " </td> "  ; 
                            ?> 
                            <td>
                            <a style="float: right; margin-right: 10px;" onclick="return confirm('Do you want to delete address')" class="del-address" href="javascript:{}" id='delete' deladd='<?php echo $res['address']; ?>'> Delete </a>
                            </td>
                           </tr>
                            <?php } echo"</tbody></table>"; ?> 
                         <hr>
                    </div>

                </div>
            </div>
    </div> 
     <div style="margin-top: 70px;" id="faq" >
       <h2>FAQ's</h2>
        <div>
                <h5 id="what-happens-when-i-update-my-email-address-or-mobile-number-">What happens when I update my email address (or mobile number)?</h5>
                <p>Your login email id (or mobile number) changes, likewise. You'll receive all your account related communication on your updated email address (or mobile number).</p>
                <h5 id="when-will-my-DFM-account-be-updated-with-the-new-email-address-or-mobile-number-">When will my DFM account be updated with the new email address (or mobile number)?</h5>
                <p>It happens as soon as you confirm the verification code sent to your email (or mobile) and save the changes.</p>
                <h5 id="what-happens-to-my-existing-DFM-account-when-i-update-my-email-address-or-mobile-number-">What happens to my existing DFM account when I update my email address (or mobile number)?</h5>
                <p>Updating your email address (or mobile number) doesn't invalidate your account. Your account remains fully functional. You'll continue seeing your Order history, saved information and personal details.</p>
                <h5 id="does-my-seller-account-get-affected-when-i-update-my-email-address-">Does my Seller account get affected when I update my email address?</h5>
                <p>DFM has a 'single sign-on' policy. Any changes will reflect in your Seller account also.</p>
        </div>

        <h5><a href="myprofile.php?email=<?php echo "$_SESSION[userid]"; ?>" onclick="return confirm('Do you really want to Deactivate Account')"  style="color:blue";>Deactivated Account</a></h5>  
     </div> 
    <script src="../scripts/myprofile.js"></script>

    <?php }
            if(isset($_POST['deladd']))
            {    
            $a=$_POST['deladd'];
            $select="Delete from address where address='" . $a  . " ' Limit 1 ";
            $query=mysqli_query($conn,$select);
            }
            if(isset($_GET['email']))
            {
                $em=$_GET['email'];
                $deactive="Delete from users where email='".$em."'";
                $dq=mysqli_query($conn,$deactive);
                unset($_SESSION['userid']);
                unset($_SESSION['username']);
                echo "<script>setTimeout(function(){window.location='index.php';},1000)</script>";
                
            }
    ?>
    </body>

</html>

<script src="../scripts/cart.js"></script>