<!DOCTYPE html>
<html>
    <head>
        <title>Divya Funiture Mart</title> 
        <title>Bootstrap Example</title>
        <link rel="icon" href="../DFMlogo.png" type="image/x-icon">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body link="black" vlink="black" alink="black">
        <?php 
            include "./header.php";
            
            include_once "./dbConection.php";

        ?>
         <?php include_once "./categories.php" ?>
        <div class="main-content">            

            <div id="demo" class="carousel slide" data-ride="carousel">

                <!-- Indicators -->
                <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
                </ul>

                <!-- The slideshow -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../pics/pic1.jpg" alt="Los Angeles">
                    </div>
                    <div class="carousel-item">
                            <img src="../pics/pic2.jpg" alt="Chicago" >
                    </div>
                    <div class="carousel-item">
                                <img src="../pics/pic3.jpg" alt="New York" >
                    </div>
                    <div class="carousel-item">
                         <img src="../pics/pic4.jpg" alt="Chicago" >
                    </div>
                    <div class="carousel-item">
                             <img src="../pics/pic5.jpg" alt="Chicago" >
                    </div>
                </div>

                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
                </a>
            </div>

            <div>
                <div class="container bedsofa">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xm-6" >
                            <?php
                                $query = "select dpimage, count(*) from products where pname like '%queen size bed%' order by rand() limit 1";
                                $result = mysqli_query($conn,$query);
                                $result = mysqli_fetch_array($result);    
                            ?>

                            <img  alt="" src="data:image/jpeg;base64,<?php echo $result[0]?>">
                            <div>
                                Queen size beds
                                <div><?php echo $result[1]?>+ products</div>    
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xm-6">
                            <?php
                                $query = "SELECT dpimage, count(*) from products where pname like '%3 seater%' order by rand() limit 1";
                                $result = mysqli_query($conn,$query);
                                $result = mysqli_fetch_array($result);
                            
                            ?>
                    
                            <img  alt="" src="data:image/jpeg;base64,<?php echo $result[0]?>">
                            <div>3 seater sofa
                                <div ><?php echo $result[1]?>+ products</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        
            <div>
                <div class="container category-display">
                    <div class="row">
                        <?php
                            $query = "SELECT dpimage,category,count(category)  FROM dfm.products  group by category order by rand() limit 8";
                            $result = mysqli_query($conn,$query);
                            while($x = mysqli_fetch_array($result) )
                            {  
                        ?>      
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xm-3 col-3" >
                                <a style="text-transform: uppercase;"  href="show.php?id=<?php echo $x[1]; ?>">
                                    <img  alt="" src="data:image/jpeg;base64,<?php echo $x[0]?>">
                                    <div>
                                        <?php echo $x[1]?>
                                        <div><?php echo $x[2]?>+ products</div>    
                                    </div>
                                </a>
                            </div>
                        <?php  }?>
                    </div>
                </div>
            </div>
            <div>
                <div class="container"  style=" align-content:center;">

                    <div id= 'products' class="row" style="margin-left: 1px;">
                        <?php
                        
                            $query = "SELECT * from products  order by rand() limit 20";
                            $resultset = mysqli_query($conn,$query);
                            while ($result = mysqli_fetch_array($resultset))
                            { 
                        ?>
                        <div class='product col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6'>
                            <img src="data:image/jpeg;base64,<?php echo $result['dpimage'] ?>" alt="" height="150px" width="100%">
                            <div  id="pname">
                                <abbr title="<?php echo $result['pname']?>">
                                <a  href="./products.php?pname=<?php echo str_replace(' ','+',str_replace('+','%2B',$result['pname']))?>"
                                >
                                    <?php 
                                        echo  (strlen($result['pname']) <40)? $result['pname']:substr($result['pname'],0,35); ?>
                                </a>
                                </abbr>
                            </div> 

                            <div style="color:darkgoldenrod;">
                                <?php  
                                    $rating = 0;
                                    error_reporting(0);
                                    $query = "SELECT  truncate(avg (rating),2) from comments where pid =". $result['pid']." group by pid ";
                                    $ratingresult = mysqli_query($conn,$query);
                                    // echo mysqli_error($conn);
                                    if(mysqli_num_rows($ratingresult)!= 0)
                                        $rating = ( float ) mysqli_fetch_array($ratingresult)[0]; 
                                    $count = 0 ; 
                                    $c =( int ) $rating ;
                                    while ( $c != 0 )
                                    { ?>
                                        <i class = "fa fa-star" ></i >
                                        <?php
                                        $count++ ;
                                        $c -- ;
                                    }

                                    if ( ($rating - (int)$rating)*10 != 0 )
                                    {  ?>
                                        <i class = "fa fa-star-half-full" ></i >
                                        <?php
                                        $count ++ ;
                                    
                                    }

                                    if ( $count != 5 )
                                    { 
                                        while ( $count != 5 && $count <6 )
                                        { ?>
                                            <i class = "fa fa-star-o" ></i >
                                        <?php 
                                            $count++ ; 
                                        }
                                    }
                                ?>
                            </div>  
                            <div>&#x20b9;<span id="pprice"><?php echo $result['price'] ?></span> <s style="color: red;"> &#x20b9;<?php echo $result['mrp']; ?> </s> </div>   
                            <?php 
                            if((int)$result['quantity']>=2)
                            {
                        ?>
                                <button class="btn add-to-cart" id="atc" onclick="addToCart('<?php echo $result['pid']?>')" >Add to cart</button>
                        <?php
                            
                            }
                            else {
                        ?>        
                                <button class="btn add-to-cart" id="atc" disabled>Add To Cart</button>
                        <?php 
                               }

                        ?>
                        </div>

                        <?php  } ?>

                    </div>    
            
                </div>
            </div>

            <div>
                <div class="container"  style="overflow-x: hidden ; text-align: center">
                    <h2>Products trending now </h2>
                    <div  id="ll-slider" style="width: max-content;height: 160px; transition: 800ms ease" >
                        <?php
                            $query = "select *  from products  order by rand() limit 10";
                            $resultset = mysqli_query($conn,$query);
                            while ($result = mysqli_fetch_array($resultset))
                            {
                        ?>
                        <div class="ll-slider-inner">
                            
                                <abbr title="<?php echo $result['pname']?>">
                                    <a  href="./products.php?pname=<?php echo str_replace(' ','+',str_replace('+','%2B',$result['pname']))?>">
                                        <img src="data:image/jpeg;base64,<?php echo $result['dpimage'] ?>" alt="" height="150px" width="100%">
                                    </a>
                                </abbr>
                            
                        </div>

                        <?php } ?>

                    </div>    
            
                </div>
            </div>

            <div class="container" style="padding: 50px 20px">
                <h2>
                Home Furniture does More than fill your Room.
                </h2>
                Home furniture does more than fill your rooms. 
                It’s there for you, day and night. 
                Whether it’s a sofa that invites you to relax, 
                a dining table that hears the day’s stories or a shelf that holds your memories, 
                we think furniture can help create a better everyday life at home. That’s why we’re here!

            </div>
            <div class="container" style="padding: 50px 20px">
                <h2>Buy Wooden Furniture Online</h2>
                Buy furniture online @ Divya Furniture - Jhabua's largest home shopping destination offering a wide range
                of home and office furniture online. Choosing the right furniture for your home online will add 
                elegance and functionality to 
                your interior decor, while it will also be cost effective and long lasting at the same time. 
                Enjoy fast shipping as well as cash on delivery at our online store.

            </div>

    </div>
    <?php include_once "./newfooter1.php" ?>

            
    </body>
        
                        
</html>
