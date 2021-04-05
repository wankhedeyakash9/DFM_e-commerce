<?php 
    include_once "./dbConection.php";
    if(session_status() == PHP_SESSION_NONE)
        session_start();
?>
        <div id="d1" class="hidden">
           <div style="background: black; color: wheat;">
                <div class="cart-heading">My Cart</div>
                <div class='cart-slide' id="inside-slider">&Cross;</div>    
           </div>
           <div class="cart-data">
            <div class="image-cover">
                <img src="../pics/empty-cart.svg" alt="" width="100px" height="100px">
            </div>
            <div class="cart-product-table">
                <?php if(isset($_SESSION['cart']))
                        {
                            if(count($_SESSION['cart'])==0)
                            {
                ?>
                                <div class="empty-cart-msg"> Your cart is empty! </div>
                                
                <?php        
                            }        
                            else
                            {
                                foreach($_SESSION['cart'] as $product => $quant)
                                {
                                        $query = "select * from products where pid =".$product;
                                        $result= mysqli_query($conn,$query);
                                        $result = mysqli_fetch_array($result);
                ?> 
                                        <div class="prd<?php echo $result['pid'] ?> cart-product">
                                            <div style="width: 100px;height: 100px;background-image: url('data:image/jpeg;base64,<?php   echo $result['dpimage']?>'); background-size: cover"  ></div>
                                            <!-- <div><?php // echo $result['pid']?></div> -->
                                            <div class="cart-product-details">
                                                <div><?php echo $result['pname'] ?></div>
                                                <div class="cart-product-quant">
                                                    <span>Quantity</span> 
                                                    <div class="pmbtn"><b>-</b></div>
                                                    <span class="quant"><?php echo  $quant?></span>
                                                    <div class="pmbtn"><b>+</b></div>
                                                </div>
                                                <div><span>Our Price </span> <span>Rs. <?php echo $result['price'] ?></span></div>
                                                <div class="cart-remove "><button class="btn" onclick="removeFromCart('<?php echo $result['pid'] ?>')">Remove</button></div>
                                            </div>
                                        </div>
                <?php           }
                            }    

                        }
                        else echo "<div class='empty-cart-msg'> Your cart is empty! </div>";
                 ?>
            </div> 
                <a href="./checkout.php"><button class="btn place-order-btn" disabled>Place my Order</button></a>
               
        </div>
        </div>
    </body>
    
    