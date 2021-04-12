<div id="OrderRequestConfirm">
    
    <?php
                include "./dbConection.php";

        $result = mysqli_query($conn," select orders.oid,date(orders.orderstamp) as date,users.Name,users.Contact,deliveryaddress.address,
        deliveryaddress.state,deliveryaddress.city,deliveryaddress.pincode from users INNER JOIN deliveryaddress ON users.email=
        deliveryaddress.uid INNER JOIN orders ON orders.oid = deliveryaddress.oid and orders.status='0';");

    if(mysqli_num_rows($result)>0) {
    ?>
            <h4>List of Products confirm ready for shipping</h4>

        <table class=" table-bordered table-hover table">
            <thead>
                <tr>
                    <th>
                        Order Id
                    </th>
                    <th>Order Date</th>
                    <th>User Name</th>
                    <th>Contact Number</th>
                    <th>Delivery Address</th>
                    <th>Pincode</th>
                    <th>Shipped Or Not</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row = mysqli_fetch_array($result)){
                
                echo"<tr>";?>
                    <td><?php echo  $row["oid"]; ?></td>
                    <td><?php echo  $row["date"]; ?></td>
                    <td><?php echo $row["Name"]; ?></td>
                    <td><?php echo  $row["Contact"]; ?></td>
                    <td><?php echo  $row["address"] . $row["city"]. $row["state"]; ?></td>
                    <td><?php echo $row["pincode"]; ?></td>
                    <td>
                        <button class="btn btn-info" onclick="openFormShipping(<?php echo $row['oid']?>)">Confirm The Request</button>
                        <div class="form-popup" id="popupShippingForm">
                        <form method="post" id="confirmRequestOfOrder"> 
                                <label>The Order Shipped : </label>
                                <input type="number" id="comfirmOrderRequest"name="comfirmOrderRequest" style="display: none;">
                                <!-- <input type="number" id="oidToShip"name="oidToShip" style="display: none;">   -->
                                <input type="submit" onclick="closeFormShipping()" name="Confirm" id="submitFormToDel">
                                <button type="button" class="btn cancel" onclick="closeFormShipping()">No</button> 
                            </form>
                        </div>
                    </td>

                <?php echo "</tr>";?>
            </tbody>
            <?php
            }
            ?>
        </table>
    <?php
    }
    else{
        echo "No result found";
    }
    ?>              
</div>