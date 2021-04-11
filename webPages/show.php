 <html>
 <head>
     <title>Show products Divya furniture Mart</title>
     <link rel="icon" href="../DFMlogo.png" type="image/x-icon">

     <style>
            .head-cat-div { top: 0px;}
            .main-content{margin-top: 65px;}
     </style>
 </head>  
 <body >     
    <?php
         include "header.php"; 
         include "categories.php";
         
    ?>
    <div class="main-content">
        <div class="row">
            <?php include_once "./sorting.php" ?>
            <div class="col-xl-9 col-lg-9 cl-md-8 col-sm-7 col-xs-6 col-12">
                <div id= 'products' class="row" style="max-width: 900px">
                    <?php
                        include "dbConection.php";
                        
                        $query="";    
                        $con=0;
                    
                        if(isset($_GET['query']))
                        {    
                            $query = "select *  from products  where pname regexp '".$_GET['query']."'";
                        }    
                        else if(isset($_GET['id']))
                        {
                            $id=$_GET['id'];
                            $query="Select * from products where category like '%$id%' ";
                            $r=mysqli_query($conn,$query);
                            $con=mysqli_num_rows($r);
                        }
                        $resultset = mysqli_query($conn,$query);
                       if(mysqli_num_rows($resultset)>0){
                        while ($result = mysqli_fetch_array($resultset))
                        {
                    ?>
                    <div class='product col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6 col-5' style="margin: auto">
                        <img src="data:image/jpeg;base64,<?php echo $result['dpimage'] ?>" alt="" height="150px" width="100%">
                        <div id="pname">
                            <abbr title="<?php echo $result['pname']?>">
                            <a  href="./products.php?pname=<?php echo str_replace(' ','+',str_replace('+','%2B',$result['pname']))?>"
                            >
                                <?php 
                                    echo  (strlen($result['pname']) <40)? $result['pname']:substr($result['pname'],0,35)."..."; ?>
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
                        <div>&#x20b9;<span id="pprice"><?php echo $result['price'] ?></span><s style="color: red;"> &#x20b9;<?php echo $result['mrp']; ?> </s></div>    
                        <button class="btn add-to-cart" onclick="addToCart('<?php echo $result['pid']?>')" >Add to cart</button>
                    </div>

                    <?php } }
                    elseif($con==0 && (!isset($_GET['query']))){
                    ?>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <br>
                            <div style="font-weight: bolder;font-size: 30px">Nothing to Preview.</div>
                            <br>
                            <div style="font-weight: bold"> Suggestions:-</div>
                            <ul >
                                <li>In future you will assurely get this types of products. </li>
                                <li>You can also email us to product requiremnts.</li>
                                <li>Try different categories.</li>
                            </ul>
                        </div>
                    <?php
                    }
                    else { ?>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <br>
                            <div style="font-weight: bolder;font-size: 30px">Your search - <?php if(isset($_GET['query'])){ echo $_GET['query']; }?> did not match any products</div>
                            <br>
                            <div style="font-weight: bold"> Suggestions:-</div>
                            <ul >
                                <li>Make sure that all words are spelled correctly</li>
                                <li>Try different keyword</li>
                                <li>Try more general keywords</li>
                            </ul>
                        </div>
                    <?php } ?>


                </div>    
            </div>
        </div>
    </div>
    <?php include_once "./newfooter1.php" ?>

</body>
 </html>
 <script src="../scripts/sorting.js"></script>