<?php  
    if(session_status() == PHP_SESSION_NONE)
        session_start();
?>

<html>
<head>
        <title>Divya Funiture Mart</title> 
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet"  href="../styleSheets/index.css">        
        <link rel="stylesheet" href="../styleSheets/cart.css">
    
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        


</head>

<body link="black" vlink="black" alink="black" >
    <div class="head-cat-div">
        <div class="row header">
            <div  class="col-xl-1 col-lg-1 col-md-1 col-sm-2  col-2">
                <a href="./"><img class ="dfmlogo"src="../pics/DFMlogo1.png" alt="DFMlogo"width="100px" height="50px"></a>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-10 col-10 comp-name" style="margin-top:0px;font-size: xx-large">
                Divya Furniture Mart 
            </div>

            <div class="col-xl-5 col-lg-5 col-md-8 col-sm-8 col-12 search-bar" style="text-align: center">
                <div>
                    
                    <form id="search-frm" method="get" action="./show.php">
                        <input type="search" name="query" id="search-box" required placeholder="Search products here" title="empty search query">
                        <button type="submit"  class=" fa fa-search"></button>
                        <div id="suggesstion-box"></div>
                    </form>
                    
                </div>
            </div>
            <?php
            
            if(isset( $_SESSION['username'] ) == false)
            { 
                
                ?>
                
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-10  " style="text-align: end;"  >
                    <div onclick ="toggleForm()">Login or Register</div>
                </div>
            <?php 
            } 
            elseif(isset($_SESSION['username']) == true && !isset($_SESSION['admin']))
            { 
                ?>
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-10 dropdown" style="text-align: end;">
                    <div class="dropdown-toggle btn btn-primary" data-toggle = "dropdown"><?php echo $_SESSION['username'];?></div>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="myprofile.php">My profile</a>
                        <a class="dropdown-item" href="myorder.php">My orders</a>
                        <a class="dropdown-item" href="./logout.php">Log-out</a>
                    </div>
                </div>
            <?php 
            }
            else
            { 
                ?>
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-10 dropdown" style="text-align: end;">
                    <div class="dropdown-toggle btn btn-primary" data-toggle = "dropdown"><?php echo $_SESSION['username'];?></div>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="newadmin.php">Admin</a>
                        <a class="dropdown-item" href="shippingdept.php">Shipping Department</a>
                        <a class="dropdown-item" href="./logout.php">Log-out</a>
                    </div>
                </div>
            <?php 
            } ?>
            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-2 col-2 ">
                <div class="fa fa-shopping-cart cart-icon cart-slide" style="font-size: 30px">
                    <div>
                        <?php 
                            if(isset($_SESSION['cart']))
                                echo count($_SESSION['cart']);
                            else echo 0;    
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include "./cartslider.php"?>
        <div id="lsform">
            <div onclick="toggleForm()"style="cursor: pointer;display: inline-block;font-size: 30px; color: red; position: absolute;left: 95%;"> &Cross;</div>
            <?php include "loginsignup.php"?>
        </div>


    </div>
    <div id="faltu"></div>

</body>
</html>
       
        
<script src="../scripts/index.js"></script>
<script src="../scripts/autoComplete.js"></script>

