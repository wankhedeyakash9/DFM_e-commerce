
<?php
    
    if (session_status() == PHP_SESSION_NONE )
        session_start();

    if(!isset($_SESSION['cart']))
        $_SESSION['cart'] = array();

    include_once "./dbConection.php";
    
    if(isset($_GET['decreaseQuant']))
    {
        $pid = $_GET['decreaseQuant'];
        $productIndex = array_search($pid,$_SESSION['cart']);
        if(array_key_exists($pid,$_SESSION['cart']))    
        {
            if($_SESSION['cart'][$pid]>1)
                $_SESSION['cart'][$pid]-- ;
            die();  
        }    
    }
    else
    {

        $pid = $_GET['pid'];
        
        $productIndex = array_search($pid,$_SESSION['cart']);
        if(array_key_exists($pid,$_SESSION['cart']))    
        {
            if($_SESSION['cart'][$pid]<5)
                $_SESSION['cart'][$pid]++ ;
            die();  
        }    

        
        
        $_SESSION['cart'][$pid] = 1;
        
        $query = "select * from products where pid =$pid";
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
                <span class="quant"><?php echo 1 ?></span>
                <div class="pmbtn"><b>+</b></div>
            </div>
            <div><span>Our Price </span> <span>Rs. <?php echo $result['price'] ?></span></div>
            <div class="cart-remove"><a><button class="btn" onclick= "removeFromCart('<?php echo $result['pid'] ?>')">Remove</button></a></div>
        </div>
    </div>
    <script>location.reload();</script>
    <?php } ?>