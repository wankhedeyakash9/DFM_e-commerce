<?php 
    require_once "./dbConection.php";

    if (isset($_POST['keyword']))
    {
        
    }
?>
<div class="row">
    <?php include_once "./sorting.php"; ?>
    <div class="col-xl-9 col-lg-9 cl-md-8 col-sm-7 col-xs-6 col-12">        
        <div id= 'products' class="row" style="max-width: 900px">
            <?php
                $query = "select *  from products  where pname regexp '".$_GET['query']."'";
                $resultset = mysqli_query($conn,$query);
            if(mysqli_num_rows($resultset)>0)
                while ($result = mysqli_fetch_array($resultset))
                {
            ?>
            <div class='product col-xl-2 col-lg-2 col-md-4 col-sm-6 col-xs-6'  >
                <img src="data:image/jpeg;base64,<?php echo $result['dpimage'] ?>" alt="" height="150px" width="100%">
                    <div  id="pname">
                    <abbr title="<?php echo $result['pname']?>">
                    <a  href="./products.php?pname=<?php echo str_replace(' ','+',$result['pname'])?>"
                        >
                        <?php 
                            echo  (strlen($result['pname']) <40)? $result['pname']:substr($result['pname'],0,35)."..."; ?>
                    </a>
                    </abbr>
                </div> 

                <div style="color:gold;">
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
                    <div >Rs.<span id="pprice"><?php echo $result['price'] ?></span><s style="color: red;"> &#x20b9;<?php echo $result['mrp']; ?> </s></div>   
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

            <?php } 
            else 
            {
            ?>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <br>
                <div style="font-weight: bolder;font-size: 30px">Your search - <?php $_GET['query']?> did not match any products</div>
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

<script src="../scripts/sorting.js"></script>