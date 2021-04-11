<link rel="stylesheet" href="../styleSheets/products.css">
<script src="../scripts/spotlight.bundle.js"></script>


<?php
    include_once "./dbConection.php";
    include_once "./header.php";
    
    $pname = $_GET["pname"];
    
    
    $query = "select * from products where pname = '$pname'";
    $result =  mysqli_fetch_array(mysqli_query($conn,$query));
?>

<body >
    <div class="main-content">
        <div class="product-detail row">
            <div id="dp-name-div" class="col-xl-6 col-lg-6 col-md-6" >
                <div id="disimg">
                    <?php echo '<img src = "data:image/jpeg;base64,'.$result['dpimage'].'"id="dpImage"/>'; ?>
                </div>
                <div id="otherImages">
                    More images &RightAngleBracket;&RightAngleBracket;
                    <br>
                    <br>
                    <a class="spotlight" href="<?php echo 'data:image/jpeg;base64,'.$result['dpimage']?>">
                        <img src="<?php echo 'data:image/jpeg;base64,'.$result['dpimage']?>">
                    </a>
                    <a class="spotlight" href="<?php echo 'data:image/jpeg;base64,'.$result['img1']?>">
                        <img src="<?php echo 'data:image/jpeg;base64,'.$result['img1']?>">
                    </a>
                    <a class="spotlight" href="<?php echo 'data:image/jpeg;base64,'.$result['img2']?>">
                        <img src="<?php echo 'data:image/jpeg;base64,'.$result['img2']?>">
                    </a>
            
                </div>

            </div>
            <div  class="col-xl-6 col-lg-6 col-md-6" style="padding:0px 40px">
                <div id="prdname">
                        <span><?php echo ucfirst($result['pname']) ?></span><br>
                        <?php echo "Product Code : PRD_<a id='curr-pid'>".$result['pid'] ?></a> 
                        <br>
                        Category : <?php echo $result['category']?>
                        <br>
                        
                        Price :         &#x20b9;<?php echo $result['price'] ?>  <s style="color: red;"> &#x20b9;<?php echo $result['mrp']; ?> </s>  
                        <br>
                        <div style="color:darkgoldenrod;font-size: 30px;">
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
                    </div>
                <button class="btn add-to-cart btn-primary" id="atc" onclick="addToCart('<?php echo $result['pid']?>')" >Add to cart</button>
                <?php 
                    if((int)$result['quantity']>10)
                    {
                        echo "<b style='color:green;'>In Stock</b>";
                    }
                    elseif((int)$result['quantity']>=2 && (int)$result['quantity']<10)
                    {
                        echo "<b style='color:Orange;'>Few Left</b>";
                    }
                    elseif((int)$result['quantity']<2)
                    {
                        echo "<b style='color:Red;'>Out of Stock</b>";
                        echo "<script>document.getElementById('atc').disabled = true; </script>";
                    }
                ?>
                <div id="prodDesc">
                    <span>Product description:</span>
                    <br>
                    
                    <div style="text-align: justify">
                        <?php
                            $disarray=explode("|",$result['description']);
                            foreach($disarray as $d)
                            {
                                $d =  explode(":",$d);
                                echo "<b>" . $d[0] . "</b>" . $d[1];
                                echo "<br>";
                            }
                             echo "<br><b> Dimension:" .$result['dimension'] . "</b>";
                             echo "<br><b> Color:" .$result['color'] . "</b>";
                        ?> 
                        
                    </div>
                </div>
                <div id="comment-area">
                    <span>Comments:</span>
                    <div id="comment-box">
                        <?php
                            $query = "select comment,rating,u.name 'username' from comments, users as u where uid = email and pid = (select pid from products where pname ='$pname')";
                            $result = mysqli_query($conn,$query);
                            error_reporting(0);
                            while($row =  mysqli_fetch_array($result))
                            {
                        ?>
                            <div style="border-bottom: 1px solid #dae0e5">
                                <div>
                                    <div style="display: inline-block; text-align: center;border:2px solid dodgerblue;font-family: initial;border-radius: 25px;width:25px;height:25px ;background: #2a2a2a;color: white"><?php echo substr($row['username'],0,1);?></div>

                                    <b><?php echo $row['username']?></b>
                                    <?php 
                                        for($i=1; $i<=5;$i++)
                                        {
                                            if($i <= (int) $row['rating'])
                                                echo "<span style='color: gold;'>&starf;</span>" ;
                                            else 
                                                echo "<span style='color: grey;'>&starf;</span>" ;

                                        }
                                        
                                    ?>
                                </div>
                                <div><?php echo $row['comment']?></div>  
                            </div>      
                        <?php    
                            }
                        ?>
                    </div>
                    <?php 
                    if(isset($_SESSION['username'])) 
                    {
                        ?>
                        <div>

                            <form action="#" method="get" id="cmntfrm">
                                <textarea id="cmntbx"   form="cmntfrm" placeholder="Your comment here" maxlength="100"  style=" width: 100%;" required ></textarea>
                                <br>
                                <button type="submit"  class="btn btn-primary">Add a comment</button>
                            </form> 
                              

                        </div>
                        <span>Rate our product:</span>
                            <div>
                                <span class="star">&starf;</span>
                                <span class="star">&starf;</span>
                                <span class="star">&starf;</span>
                                <span class="star">&starf;</span>
                                <span class="star">&starf;</span>
                            </div>
                        <?php 
                    }
                    else 
                    echo   '<div>Login to add comments and reviews</div>'

                    ?>

                </div>
            </div>
        </div>
    </div>
     <?php include_once "./newfooter1.php" ?>
    <script>
        $("#category-bar").click(function()
                            {
                                 $("#categories-in-bar").slideToggle();
                            });

        $("#cmntfrm").submit( function(e)
        {
            e.preventDefault();
            $.post("addcomment.php",{pid:$("#curr-pid").text().toLowerCase(), comment: $("#cmntbx").val()},
                    function(data){$("#comment-box").html(data)})
        });
    </script>
    <script src="../scripts/rating.js"></script>
</body> 



