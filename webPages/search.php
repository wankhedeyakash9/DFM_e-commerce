<?php
require_once("./dbConection.php");
if(!empty($_POST["keyword"])) 
{
    $query ="SELECT pname,dpimage FROM products WHERE pname like '%" . $_POST["keyword"] . "%' ORDER BY pname LIMIT 0,6";
    $result = mysqli_query($conn,$query);
    error_reporting(0);
    if(mysqli_num_rows($result)>0) 
    {
?>
        <ul id="product-list">
        <?php
        while($product = mysqli_fetch_array($result)) 
        {
        ?>
            <li onClick="selectProduct('<?php echo $product["pname"]; ?>');">
                <img src="data:image/jpeg;base64,<?php echo $product['dpimage'] ?>" alt="" height="20px" width="20px">
                <?php echo $product["pname"]; ?>
            </li>

        <?php 
        } ?>

        </ul>
<?php 
    }
} 
?>

<style>
    #product-list{float:left;text-shadow: none;text-align: left;color: black;list-style:none;margin-left:12px;padding:0;width:90%;position: absolute; z-index: 10}
    #product-list li{padding: 5px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
    #product-list li:hover{background:#ece3d2;cursor: pointer;}
    
</style>