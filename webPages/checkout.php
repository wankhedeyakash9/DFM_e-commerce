<?php  
    if(session_status() == PHP_SESSION_NONE)
        session_start();
    require_once "./dbConection.php"
?>

<html>
    <head>
        <link rel="icon" href="../DFMlogo.png" type="image/x-icon">
        <link rel="stylesheet"  href="../styleSheets/checkout.css">
    </head>
    <body >
        <?php include_once "./header.php"?>
        <div class="main-content" style="top: 96px">
                <div style="margin:  20px ">
                    <?php if(!isset($_SESSION['username']))
                    { ?>
                    <div class="row">
                        <div class="checkout-loginform col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <form action="login.php" method="post" class="checkout-form">
                                <h1>Login to place your order </h1> 
                                <div id="msg" style="text-align: center; color:red;"></div>
                                <label for="username">Your username:</label>
                                <input type="email" name="uname" id="username" placeholder="username@example.com" required>
                                <br><br>
                                <label for="pswrd">Your password:</label>
                                <input type="password" name="pwd" id="pswrd" placeholder="mypassword@123" required>
                                <br>
                                <br>
                                <button type="submit" class="btn btn-primary checkout-login-btn">Login</button>
                            </form>
                        </div>
                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1"></div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 advdiv ">
                            <h4>Advantages of our login</h4>
                                <ul>
                                    <li>Get relevent Alerts anf Recommendation </li>
                                    <li>Reviews, Ratings, Comments & more</li>
                                </ul>
                        </div>
                    </div>
                    <?php }
                    else { ?>
                    <!-- <div class="col-xl-1"></div> -->
                    
                    <div class="row">
                        <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 col-10" style="padding-top: 45px; "><h2>Your cart</h2></div>
                        <img src="../pics/empty-cart.svg" class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2 col-2" alt="" width="100px" height="100px">
                    </div>
                    <div class="row" style="background: #007bff;">
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-xs-1 col-5"><h4>Product</h4></div>
                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-xs-1 col-1"></div>
                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-xs-1 col-1"><h4>Quantity</h4></div>
                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-xs-1 col-1"></div>
                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-xs-1 col-1"><h4>Rate</h4></div>
                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-xs-1 col-1"></div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2 col-2"><h4>Total Price</h4></div>
                    </div>
                    <?php if(isset($_SESSION['cart']))
                        {
                            if(count($_SESSION['cart'])==0)
                            {
                ?>
                                <div class="empty-cart-msg"> Your cart is empty! </div>
                                
                <?php        
                            }        
                            else
                            {   $totalPrice =0; $totalItems = 0;
                                foreach($_SESSION['cart'] as $product => $quant)
                                {
                                        $query = "select * from products where pid =".$product;
                                        $result= mysqli_query($conn,$query);
                                        $result = mysqli_fetch_array($result);
                ?> 
                                        <div class="prd<?php echo $result['pid'] ?> cart-product row" style="box-shadow: 0px 0px 5px black;border-bottom: 1px solid #007bff;">
                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-xs-1 col-1"style="width: 100px;height: 100px;background-image: url('data:image/jpeg;base64,<?php   echo $result['dpimage']?>'); background-size: cover"  ></div>
                                        
                                            <div class="cart-product-details col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4">
                                                <div><?php echo $result['pname'] ?></div>
                                                <div class="cart-product-quant">
                                                    <span>Quantity</span> 
                                                    <div class="pmbtn"><b>-</b></div>
                                                    <span class="quant"><?php echo  $quant?></span>
                                                    <div class="pmbtn"><b>+</b></div>
                                                </div>
                                                <div><span>Our Price </span> <span>Rs. <?php echo $result['price'] ?></span></div>
                                                <div class="cart-remove "><button class="btn" onclick="removeFromCart('<?php echo $result['pid'] ?>');location.reload();">Remove</button></div>
                                            </div>
                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-xs-1 col-1"></div>
                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-xs-1 col-1" style="text-align: center">
                                              <h5>  <?php echo $quant?> </h5>
                                            </div>
                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-xs-1 col-1"></div>
                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-xs-1 col-1" style="text-align: center">
                                                <h5><?php echo "Rs.".$result['price'] ?></h5>
                                            </div>                      
                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-xs-1 col-1"></div>
                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-xs-1 col-1" style="text-align: center">
                                                <h5><?php echo "Rs.".$quant * $result['price'] ?> </h5>
                                            </div>
                                        </div>

                <?php            
                                 $totalItems  += $quant;
                                 $totalPrice  += $quant * $result['price'];
                                 $_SESSION['totalamt']=$totalPrice;
                                }
                ?>
                <br> 
                <br>
                <div class="row" >
                    <div class="col-xl-6"></div>
                    <div class="col-xl-6">
                        <table class="table table-dark">
                            <tr>
                                <td>Total items</td>
                                <td><?php echo $totalItems?> items</td>
                            </tr>
                            <tr>
                                <td>Total amount</td>
                                <td><?php echo "Rs.".$totalPrice?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php                    
                                
                            }    

                        }
                    }
                 ?>
                </div>
                <form action="./orderplaced.php" id="addform">
                
                <div class="del-add col-xl-12">
                    <h6>Delivery Address:</h6>
                </div>
                <?php if(isset($_SESSION['userid'])){ ?>
                <div style="text-align: right; padding-right:10px" class="dropdown adddrop">
                    <a  class="dropdown-toggle btn btn-primary" data-toggle="dropdown" href="javascript:{}">Saved Addresses</a>
                    <br>
                    <div id="saveadd" class="dropdown-menu dropdown-menu-right">
                        <?php
                            $uid = $_SESSION['userid'];
                            $query = "select * from address where uid='$uid'";
                            $result = mysqli_query($conn,$query);
                            if(mysqli_num_rows($result)!= 0)
                                while($x = mysqli_fetch_array($result))
                                {
                                    $add= $x["Address"];
                                    $city = $x['city'];
                                    $state = $x['state'];
                                    $pin = $x['pincode'];
                                    echo "<div class='abc'><span>$add</span>, <span>$city</span>, <span>$state</span>,<span>$pin</span></div>";
                                    echo "<hr>";
                                }

                        ?>
                    </div>
                            <?php } ?>
                </div>
                      <br>          
                <?php if( isset($_SESSION['username']) && count($_SESSION['cart']) ){?>
                    <div class="row" style="margin: auto">
                        <div class="col-xl-1"></div>

                        <table class="table table-dark col-xl-10">
                            <tr>
                                <td>
                                    Address:
                                </td>
                                <td colspan="3">
                                    <textarea name="fulladd" required form="addform" maxlength="200" style="width: 100%;height:50px;border-radius:5px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Lanndmark</td>
                                <td><input type="text" name="landmark" placeholder="optional"></td>
                                <td>City</td>
                                <td><input type="text" name="city" id="" value="Jhabua" required></td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td><input type="text" name="state" id="" value="Madhya Pradesh" required ></td>
                                <td>Pin-code</td>
                                <td><input type="text" name="pincode" id="" value="457661" required></td>

                            </tr>
                        </table>
                        <div class="col-xl-1"></div>
                    </div>
                <?php } ?>
                <div class="del-add col-xl-12">
                    <h6>Payement methods :</h6>
                </div>
                <?php if( isset($_SESSION['username']) && count($_SESSION['cart']) ){?>
                    <div class="row">
                        <div class="col-xl-1"></div>
                        <button type="submit" class="col-xl-5 btn btn-primary">Proceed to Payment</button>
                        <button type="submit" class="col-xl-5 btn btn-danger">Cash on delivery</button>
                        <div class="col-xl-1"></div>
                    </div>
                <?php } ?>
                </form>
        </div> 
    </body>
    <script type="text/javascript" src="../scripts/loginsignup.js"> </script>
    <script type="text/javascript" src="../scripts/cart.js"></script>
    <script>
        $(".adddrop > div > div").click(function()
        {
            $("textarea[name='fulladd']").val( $( $(this).children()[0] ).text() );
            $("input[name='city']").val( $( $(this).children()[1] ).text() );
            $("input[name='state']").val( $( $(this).children()[2] ).text() );
            $("input[name='pincode']").val( $( $(this).children()[3] ).text() );
        }
        );
        $(".pmbtn, cart-remove > .btn").click(()=> location.reload());
    </script>                
    </html>