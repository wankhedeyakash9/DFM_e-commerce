<!DOCTYPE html>
<html>

<head>
    <title>
        shipping department
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="../scripts/jquery.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../styleSheets/shippingDept.css">

</head>

<body>
    <?php
    include "./dbConection.php";
    include "./header.php";
    ?>
    <div id="OrderStatus" class="container">

        <!-- test -->
        <div class="row" id="row1">
            <!-- div for orders of current month -->
            <div id="orders-pending" class="v-card orderTable">
                <div class="heading">
                    <div class="order-title">Orders Ready for Shipping</div>
                </div>
                <div id="readyforship">

                    <?php
                    $result = mysqli_query($conn, " select orders.oid,date(orders.orderstamp) as date,users.Name,users.Contact,deliveryaddress.address,
                    deliveryaddress.state,deliveryaddress.city,deliveryaddress.pincode from users INNER JOIN deliveryaddress ON users.email=
                    deliveryaddress.uid INNER JOIN orders ON orders.oid = deliveryaddress.oid and orders.status='1';");

                    if (mysqli_num_rows($result) > 0) {
                    ?>

                        <input type="text" id="myInput0" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name"> <br> <br>
                        <table id="mytable" class=" table-bordered table-hover table order-req-table">
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
                                while ($row = mysqli_fetch_array($result)) {

                                    echo "<tr>"; ?>
                                    <td><?php echo  $row["oid"]; ?></td>
                                    <td><?php echo  $row["date"]; ?></td>
                                    <td><?php echo $row["Name"]; ?></td>
                                    <td><?php echo  $row["Contact"]; ?></td>
                                    <td><?php echo  $row["address"] . $row["city"] . $row["state"]; ?></td>
                                    <td><?php echo $row["pincode"]; ?></td>
                                    <td>
                                        <button class="btn btn-info" onclick="openFormShipping(<?php echo $row['oid'] ?>)">Shipped</button>
                                        <div class="form-popup" id="popupShippingForm">
                                            <form method="post" id="readyToShip">
                                                <label>The Order Shipped : </label>
                                                <input type="number" id="oidToShip" name="oidToShip" style="display: none;">
                                                <!-- <input type="number" id="oidToShip"name="oidToShip" style="display: none;">   -->
                                                <input type="submit" name="Confirm" id="submitFormToDel">
                                                <button type="button" class="btn cancel" onclick="closeFormShipping()">No</button>
                                            </form>
                                        </div>
                                    </td>

                                    <?php echo "</tr>"; ?>
                            </tbody>
                        <?php
                                }
                        ?>
                        </table>
                    <?php
                    } else { ?>
                        <div class="no-result-found">
                            <div class="exclam-icon" style="display:inline; float:left;">
                                <i class="fa fa-exclamation-circle" style="font-size: 70px; color:red; margin-top: 9px; margin-right: 10px;"></i>
                            </div>
                            <div style="display:inline;">
                                <p style="font-size: 25px; color:rgba(0, 0, 0,0.6); margin-top: 20px; margin-left:10px;"> no product order today</p>
                            </div>
                        </div>

                    <?php
                    }
                    ?>


                </div>
            </div>

        </div>
        <div class="row" id="row2">
            <!-- div for orders of current month -->
            <div id="orders-pending" class="v-card orderTable">
                <div class="heading">
                    <div class="order-title">List Of Shipped Orders</div>
                </div>
                <div id="shipped">

                    <?php
                    $result = mysqli_query($conn, " select orders.oid,date(orders.orderstamp) as date,users.Name,users.Contact,deliveryaddress.address,
                    deliveryaddress.state,deliveryaddress.city,deliveryaddress.pincode from users INNER JOIN deliveryaddress ON users.email=
                    deliveryaddress.uid INNER JOIN orders ON orders.oid = deliveryaddress.oid and orders.status='2';");

                    if (mysqli_num_rows($result) > 0) {
                    ?>
                        <input type="text" id="myInput1" onkeyup="myFunction1()" placeholder="Search for names.." title="Type in a name"><br> <br>
                        <table id="mytable1" class=" table-bordered table-hover table order-req-table">
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
                                    <th>Delivered Or Not</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($result)) {

                                    echo "<tr>"; ?>
                                    <td><?php echo  $row["oid"]; ?></td>
                                    <td><?php echo  $row["date"]; ?></td>
                                    <td><?php echo $row["Name"]; ?></td>
                                    <td><?php echo  $row["Contact"]; ?></td>
                                    <td><?php echo  $row["address"] . $row["city"] . $row["state"]; ?></td>
                                    <td><?php echo $row["pincode"]; ?></td>
                                    <td>
                                        <button class="btn btn-info" onclick="openFormDeliver(<?php echo $row['oid'] ?>)">Delivered </button></td>
                                    <div class="form-popup" id="popupDeliverForm">
                                        <form method="post" id="readyToDeliver">
                                            <label style="margin-top: 10%">The Order Delivered? : </label><br>
                                            <input type="number" id="oidToDeliver" name="oidToDeliver" style="display: none;"> <br>
                                            <br><input type="submit" name="Confirm" id="submitFormToDel">
                                            <button type="button" class="btn cancel" onclick="closeFormDeliver()">No</button>
                                        </form>
                                    </div>
                                    <!-- </td> -->

                                    <?php echo "</tr>"; ?>
                            </tbody>
                        <?php
                                }
                        ?>
                        </table>
                    <?php
                    } else { ?>
                        <div class="no-result-found">
                            <div class="exclam-icon" style="display:inline; float:left;">
                                <i class="fa fa-exclamation-circle" style="font-size: 70px; color:red; margin-top: 9px; margin-right: 10px;"></i>
                            </div>
                            <div style="display:inline;">
                                <p style="font-size: 25px; color:rgba(0, 0, 0,0.6); margin-top: 20px; margin-left:10px;"> no product order today</p>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                </div>
            </div>

        </div>
        <div class="row" id="row3">
            <!-- div for orders of current month -->
            <div id="orders-pending" class="v-card orderTable">
                <div class="heading">
                    <div class="order-title">List Of Delivered Orders</div>
                </div>
                <div id="delivered">

                    <?php
                    $result = mysqli_query($conn, " select orders.oid,date(orders.orderstamp) as date,users.Name,users.Contact,deliveryaddress.address,
                    deliveryaddress.state,deliveryaddress.city,deliveryaddress.pincode from users INNER JOIN deliveryaddress ON users.email=
                    deliveryaddress.uid INNER JOIN orders ON orders.oid = deliveryaddress.oid and orders.status='3';");

                    if (mysqli_num_rows($result) > 0) {
                    ?>
                        <input type="text" id="myInput" onkeyup="myFunction2()" placeholder="Search for names.." title="Type in a name"><br> <br>
                        <table id="mytable2" class=" table-bordered table-hover order-req-table table">
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($result)) {

                                    echo "<tr>"; ?>
                                    <td><?php echo  $row["oid"]; ?></td>
                                    <td><?php echo  $row["date"]; ?></td>
                                    <td><?php echo $row["Name"]; ?></td>
                                    <td><?php echo  $row["Contact"]; ?></td>
                                    <td><?php echo  $row["address"] . $row["city"] . $row["state"]; ?></td>
                                    <td><?php echo $row["pincode"]; ?></td>


                                    <?php echo "</tr>"; ?>
                            </tbody>
                        <?php
                                }
                        ?>
                        </table>
                    <?php
                    } else { ?>
                        <div class="no-result-found">
                            <div class="exclam-icon" style="display:inline; float:left;">
                                <i class="fa fa-exclamation-circle" style="font-size: 70px; color:red; margin-top: 9px; margin-right: 10px;"></i>
                            </div>
                            <div style="display:inline;">
                                <p style="font-size: 25px; color:rgba(0, 0, 0,0.6); margin-top: 20px; margin-left:10px;"> no product order today</p>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                </div>
            </div>

        </div>
        <div class="row" id="row4">
            <!-- div for orders of current month -->
            <div class="v-card orderTable">
                <div class="heading">
                    <div class="order-title">List of Return Order request</div>
                </div>
                <div id="returnOrder">

                    <?php
                    $result = mysqli_query($conn, " select orders.oid,date(orders.orderstamp) as date,users.Name,users.Contact,deliveryaddress.address,
                        deliveryaddress.state,deliveryaddress.city,deliveryaddress.pincode from users INNER JOIN deliveryaddress ON users.email=
                        deliveryaddress.uid INNER JOIN orders ON orders.oid = deliveryaddress.oid inner join ordercancel on ordercancel.oid = orders.oid and ordercancel.reason = 'Order_Return'");
                    if (mysqli_num_rows($result) > 0) {
                    ?>
                        <input type="text" id="myInput1" onkeyup="myFunction1()" placeholder="Search for names.." title="Type in a name"><br> <br>
                        <table id="mytable1" class=" table-bordered table-hover order-req-table table">
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
                                    <th>Delivered Or Not</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($result)) {

                                    echo "<tr>"; ?>
                                    <td><?php echo  $row["oid"]; ?></td>
                                    <td><?php echo  $row["date"]; ?></td>
                                    <td><?php echo $row["Name"]; ?></td>
                                    <td><?php echo  $row["Contact"]; ?></td>
                                    <td><?php echo  $row["address"] . $row["city"] . $row["state"]; ?></td>
                                    <td><?php echo $row["pincode"]; ?></td>
                                    <td>
                                        <button class="btn btn-info" onclick="openFormReturn(<?php echo $row['oid'] ?>)">Delivered </button></td>
                                    <div class="form-popup" id="popupReturnForm">
                                        <form method="post" id="readyToReturn">
                                            <label style="margin-top: 10%">The Order Delivered? : </label><br>
                                            <input type="number" id="oidToReturn" name="oidToReturn" style="display: none;"> <br>
                                            <br><input type="submit" value="Confirm" name="Confirm" id="submitFormToReturn">
                                            <button type="button" class="btn cancel" onclick="closeFormReturn()">No</button>
                                        </form>
                                    </div>
                                    <!-- </td> -->

                                    <?php echo "</tr>"; ?>
                            </tbody>
                        <?php
                                }
                        ?>
                        </table>
                    <?php
                    } else { ?>
                        <div class="no-result-found">
                            <div class="exclam-icon" style="display:inline; float:left;">
                                <i class="fa fa-exclamation-circle" style="font-size: 70px; color:red; margin-top: 9px; margin-right: 10px;"></i>
                            </div>
                            <div style="display:inline;">
                                <p style="font-size: 25px; color:rgba(0, 0, 0,0.6); margin-top: 20px; margin-left:10px;"> no product order today</p>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                </div>
            </div>

        </div>
        <div class="row" id="row5">
            <!-- div for orders of current month -->
            <div id="orders-pending" class="v-card orderTable">
                <div class="heading">
                    <div class="order-title">List od Returned Orders</div>
                </div>
                <div id="Returned">

                    <?php
                    $result = mysqli_query($conn, " select orders.oid,date(orders.orderstamp) as date,users.Name,users.Contact,deliveryaddress.address,
                    deliveryaddress.state,deliveryaddress.city,deliveryaddress.pincode from users INNER JOIN deliveryaddress ON users.email=
                    deliveryaddress.uid INNER JOIN orders ON orders.oid = deliveryaddress.oid and orders.status='4';");

                    if (mysqli_num_rows($result) > 0) {
                    ?>
                        <input type="text" id="myInput" onkeyup="myFunction2()" placeholder="Search for names.." title="Type in a name"><br> <br>
                        <table id="mytable2" class=" table-bordered table-hover table order-req-table">
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($result)) {

                                    echo "<tr>"; ?>
                                    <td><?php echo  $row["oid"]; ?></td>
                                    <td><?php echo  $row["date"]; ?></td>
                                    <td><?php echo $row["Name"]; ?></td>
                                    <td><?php echo  $row["Contact"]; ?></td>
                                    <td><?php echo  $row["address"] . $row["city"] . $row["state"]; ?></td>
                                    <td><?php echo $row["pincode"]; ?></td>


                                    <?php echo "</tr>"; ?>
                            </tbody>
                        <?php
                                }
                        ?>
                        </table>
                    <?php
                    } else { ?>
                        <div class="no-result-found">
                            <div class="exclam-icon" style="display:inline; float:left;">
                                <i class="fa fa-exclamation-circle" style="font-size: 70px; color:red; margin-top: 9px; margin-right: 10px;"></i>
                            </div>
                            <div style="display:inline;">
                                <p style="font-size: 25px; color:rgba(0, 0, 0,0.6); margin-top: 20px; margin-left:10px;"> no product order today</p>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                </div>
            </div>

        </div>
        <!-- test end -->

        <div class="row" id="row4">
            <!-- div for orders of current month -->
            <div class="v-card orderTable">
                <div class="heading">
                    <div class="order-title">List of Return Order request</div>
                </div>
                <div id="returnOrder">

                    <?php
                    $result = mysqli_query($conn, " select orders.oid,date(orders.orderstamp) as date,users.Name,users.Contact,deliveryaddress.address,
                        deliveryaddress.state,deliveryaddress.city,deliveryaddress.pincode from users INNER JOIN deliveryaddress ON users.email=
                        deliveryaddress.uid INNER JOIN orders ON orders.oid = deliveryaddress.oid inner join ordercancel on ordercancel.oid = orders.oid and ordercancel.reason = 'cancel'");
                    if (mysqli_num_rows($result) > 0) {
                    ?>
                        <input type="text" id="myInput1" onkeyup="myFunction1()" placeholder="Search for names.." title="Type in a name"><br> <br>
                        <table id="mytable1" class=" table-bordered table-hover order-req-table table">
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($result)) {

                                    echo "<tr>"; ?>
                                    <td><?php echo  $row["oid"]; ?></td>
                                    <td><?php echo  $row["date"]; ?></td>
                                    <td><?php echo $row["Name"]; ?></td>
                                    <td><?php echo  $row["Contact"]; ?></td>
                                    <td><?php echo  $row["address"] . $row["city"] . $row["state"]; ?></td>
                                    <td><?php echo $row["pincode"]; ?></td>
                                    <?php echo "</tr>"; ?>
                            </tbody>
                        <?php
                                }
                        ?>
                        </table>
                    <?php
                    } else { ?>
                        <div class="no-result-found">
                            <div class="exclam-icon" style="display:inline; float:left;">
                                <i class="fa fa-exclamation-circle" style="font-size: 70px; color:red; margin-top: 9px; margin-right: 10px;"></i>
                            </div>
                            <div style="display:inline;">
                                <p style="font-size: 25px; color:rgba(0, 0, 0,0.6); margin-top: 20px; margin-left:10px;"> no product order today</p>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                </div>
            </div>

        </div>




    </div>
    <div id="demo"></div>
    <script>
        function openFormShipping(_oid) {
            document.getElementById("popupShippingForm").style.display = "block";
            document.getElementById("oidToShip").value = _oid;
        }

        function closeFormShipping() {
            document.getElementById("popupShippingForm").style.display = "none";
        }

        function openFormDeliver(_oid) {
            document.getElementById("popupDeliverForm").style.display = "block";
            document.getElementById("oidToDeliver").value = _oid;

        }

        function closeFormDeliver() {
            document.getElementById("popupDeliverForm").style.display = "none";

        }

        function openFormReturn(_oid) {
            document.getElementById("popupReturnForm").style.display = "block";
            document.getElementById("oidToReturn").value = _oid;

        }

        function closeFormReturn() {
            document.getElementById("popupDeliverForm").style.display = "none";

        }
    </script>
    <script>
        $(document).ready(function() {
            $("#readyToShip").submit(function(e) {
                e.preventDefault();
                $a = 2;
                document.getElementById("popupShippingForm").style.display = "none";
                $.ajax({
                    url: "./updatedeliveryStatus.php",
                    data: {
                        oid: $("input[name=oidToShip]").val(),
                        delivery: $a
                    },
                    type: "post",
                    success: function(data) {
                        location.reload(true);

                    }
                });

            });
            $("#readyToDeliver").submit(function(e) {

                e.preventDefault();
                $a = 3;
                document.getElementById("popupDeliverForm").style.display = "none";

                $.ajax({
                    url: "./updatedeliveryStatus.php",
                    data: {
                        oid: $("input[name=oidToDeliver]").val(),
                        delivery: $a
                    },
                    type: "post",
                    success: function(data) {
                        location.reload(true);

                    }
                });

            });
            $("#readyToReturn").submit(function(e) {

                e.preventDefault();
                $a = 4;
                document.getElementById("popupReturnForm").style.display = "none";

                $.ajax({
                    url: "./updatedeliveryStatus.php",
                    data: {
                        oid: $("input[name=oidToReturn]").val(),
                        delivery: $a
                    },
                    type: "post",
                    success: function(data) {
                        $.ajax({
                            url: "./updateCancelOrderStatus.php",
                            data: {
                                oid: $("input[name=oidToReturn]").val()
                            },
                            type: "post",
                            success: function(data) {
                                location.reload(true);

                            }
                        });

                    }
                });

            });

        });
    </script>
    <script>
        function myFunction2() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("mytable2");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function myFunction1() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput1");
            filter = input.value.toUpperCase();
            table = document.getElementById("mytable1");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput0");
            filter = input.value.toUpperCase();
            table = document.getElementById("mytable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>

</html>