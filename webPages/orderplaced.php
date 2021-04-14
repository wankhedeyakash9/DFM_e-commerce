
<html>
<head>
    <title> Placed _Order </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    
    <style>
        body{background-color: lightcyan;}
        #call{height: 350px; width: 35%; border: 3px solid blue; margin-top: 10%;  background-color: lightcyan;}
        h2,h5{text-align: center; text-transform: uppercase;}
        img{height: 100px; width: 100px; display: block; margin-left: auto; margin-right: auto;}
        p{margin-top:35px; }

        @media(max-width:600px){

            #call{height: 350px; width: 85%; border: 3px solid blue; margin: auto;}
            h2,h5{text-align: center; text-transform: uppercase;}
            img{height: 100px; width: 100px; display: block; margin-left: auto; margin-right: auto;}
            p{margin-top:5px; }
        }
        
        @media(min-width:601px) and (max-width:960px){

            #call{height: 350px; width: 55%; border: 3px solid blue;}
            h2,h5{text-align: center; text-transform: uppercase;}
            img{height: 100px; width: 100px; display: block; margin-left: auto; margin-right: auto;}
            p{margin-top:5px; }
        }
        
        @media(min-width:961px) and (max-width:1260px){

            #call{height: 350px; width: 50%; border: 3px solid blue;}
            h2,h5{text-align: center; text-transform: uppercase;}
            img{height: 100px; width: 100px; display: block; margin-left: auto; margin-right: auto;}
            p{margin-top:15px; }
        }
    </style>
</head>
<body onload="fun()">
<?php
    if(session_status()==PHP_SESSION_NONE)
        session_start();
    
    include_once "./dbConection.php";
    
    function checkexists($num)
    {   
        global $conn;    
        $exist = [];
        $query = "select oid from orders";
        $result = ( mysqli_query($conn,$query));
        
        while($x = mysqli_fetch_array($result)) array_push($exist,$x[0]);
        
        return in_array($num,$exist);
    }
    $oid = rand(0,999999999);
    while(checkexists($oid))
    {
        $oid = rand(0,999999999);
    }
    $x=1;
    if(isset($_SESSION['cart']))
    {
                    foreach($_SESSION['cart'] as $pid => $quant)
                    {   
                        $qr="select quantity from products where pid=$pid";
                        $res=mysqli_query($conn,$qr);
                        $row=mysqli_fetch_array($res);
                        if((int)$row['quantity']-$quant>=1)
                        { 
                            $d="update products set quantity=quantity-$quant where pid= $pid ";
                            $r=mysqli_query($conn,$d);
                            
                                if(isset($_GET['landmark'])){$z=$_GET['landmark'];}else {$z="NULL";}
                                $query  = "insert into orders (oid,uid,orderstamp,totalprice) values ($oid,'".$_SESSION['userid']."',current_timestamp(),'". $_SESSION['totalamt'] ."') ";
                                $result = mysqli_query($conn,$query);
                                $query = "insert into orderproducts (oid,pid,quantity) values ($oid,$pid,$quant)"; 
                                $result = mysqli_query($conn,$query);
                                $query  = "insert into deliveryaddress(address,landmark,state,city,pincode,oid,uid) values ('". $_GET['fulladd'] ."','$z','".$_GET['state']."','".$_GET['city']."','".
                                        $_GET['pincode']."',$oid,'".$_SESSION['userid']."')" ;
                                $result = mysqli_query($conn,$query);
                                
                            
                      if($x==1) { ?>
                            <div class="container" id="call" style="margin: auto">
                                <h2 style="color: green; text-transform: uppercase;">congratulations</h2>
                                <h5>THE ORDER HAS BEEN PLACED SUCCESSFULLY</h5>
                                <hr>
                                <img  src="../DFMlogo.png" alt="DFMLogo">
                                <br> <br> Your order_id for this order is  <b>  Order_ID: <?php echo $oid;  ?></b>
                                <p>To Confirm order you will recieve a call.</p>
                            </div>   
                            
                      <?php } $x++; }
                        else {
                      ?>     
                            <div class="container" id="call">
                                <h2 style="color: red; text-transform: uppercase;">Order cannot PLACED</h2>
                                <h5>THE ORDER HAS BEEN CANCELED </h5>
                                <hr>
                                <img  src="../DFMlogo.png" alt="DFMLogo">
                                <br> <br> <b> Item has been out of stock.Try it again after some time.
                                Maxmimun 5 quantity can be ordered at a time.  </b>
                            </div>   
                       <?php }
                    }
                    

                    
                }
            ?>
            
</body>
</html>

<script>
    
   function fun(){
       setTimeout(function(){window.location="./";},7000)
   }
    
</script>

<?php
        unset($_SESSION['cart'])
?>