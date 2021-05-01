
        <div id= 'products' class="row">
            <?php
                include "./dbConection.php";
                $query = "select *  from products  order by pid";
                $resultset = mysqli_query($conn,$query);
                $resultPid = '';
                while ($result = mysqli_fetch_array($resultset))
                {
                    $resultPid = $result['pid'];
            ?>
            <div class='product col-lg-2 col-md-4 col-sm-6 col-xs-6 col-6'>
                <img src="data:image/jpeg;base64,<?php echo $result['dpimage'] ?>" alt="" height="150px" width="100%">
                <div style="height:50px" id="pname">
                    <abbr title="<?php echo $result['pname']?>">
                    <a  href="./products.php?pname=<?php echo str_replace(' ','+',$result['pname'])?>">
                        <?php 
                            echo  (strlen($result['pname']) <40)? $result['pname']:substr($result['pname'],0,35)."...";?>
                            <div id="quantityShow">(<?php echo $result['quantity']?>)</div>
                    </a>
                    </abbr>
                </div> 
                <div>Rs.<?php echo $result['price'] ?></div>   
                <button class="btn addStock" onclick="openForm(<?php echo $result['pid']?>)">Add</button>
                <button class="btn Remove Product" id="removeProduct" onclick="removeProduct('<?php echo $result['pid']?>')" >Remove Product</button>
            
                
            </div>
            <?php
                
                } ?>
            <div class="form-popup" id="addStockForm">
                    <form  id="formForStock"  class="form-container">
                        <h1>Login</h1>
                        <input type="number" id="pidToAdd"name="pidToadd" style="display: none;">
                        <label for="addIntoStock"><b>Add in Current Stock </b></label>
                        <input type="number" placeholder="number" id="addIntoStock" name="addStock" required>

                        <input type="submit" onclick="closeForm()" name="submit" id="submitForm">
                        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                    </form>
                    <form id="formForDelProduct" style="display: none">
                        <input type="number" id="pidToDel"name="pidToDel" style="display: none;">                                    
                    </form>
            </div>
                
        </div> 


