<?php 
    session_start();
    if(isset($_SESSION['admin']) == 'admin')
    {
?>

<!DOCTYPE html>
<html>

<head>
    <title>
        Welcome DFM
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <script src="../scripts/jquery.js"></script>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>   
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../styleSheets/newadmin.css">
    
    <link rel="stylesheet" href="../styleSheets/newdrop.css">
   





</head>

<body>
    <?php
    include "./dbConection.php";
    ?>
    <div id="header" class="container-fluid" style="display: inline-box;">
        <div class="row">
            <div class="col-1">
                <a href="./"><img class="dfmlogo" src="../pics/DFMlogo1.png" alt="DFMlogo" width="100px" height="50px"></a>
            </div>



            <div class="col-4 comp-name" style="margin-top:0px;font-size: xx-large">
                Divya Furniture Mart
            </div>

            <div class="col-4 search-bar" style="text-align: center;">
                <div>

                    <form id="search-frm" method="post">
                        <input type="search" name="query" id="search-box" required="" placeholder="Search products here" title="empty search query">
                        <a href="javascript:{$('#lower_search').submit(); }" style="text-decoration: underline;" data-toggle="tooltip" title="serch products">
                            <i style=" position: relative; left: -35px; color: #8233C5;" class="fa fa-search"></i>
                        </a>
                        <div id="suggesstion-box" style="display: none;"></div>
                    </form>

                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-10 dropdown">
                <div class="dropdown-toggle btn btn-primary" data-toggle="dropdown">
                       <span> <?php echo "Admin"; ?>  </span> 
                </div>
                <div class="dropdown-menu" style="position: relative; top: 20%;">
                    <a class="dropdown-item" href="./newadmin.php">Admin Home</a>
                    <a class="dropdown-item" href="./shippingdept.php">Shipping Deaprtment</a>
                    <a class="dropdown-item" href="./logout.php">Log-out</a>
                </div>
            </div>
        </div>
    </div>
    <div id="main-content">
        <div class="container">
            <div class="row" id="row1" style="overflow: hidden; height: 400px;">

                <div class="col-7">
                    <?php
                    include "./graph.php";
                    ?>
                </div>
                <div class="col-2 r1card v-card l-padding">

                    <div id="subscription" class="card">
                        <div id="subs">
                            <div id="bell-icon">
                                <i class="fa fa-bell icon-css"></i>
                            </div>

                        </div>
                        <div id="subs-data">

                        </div>
                    </div>
                    <i class="fa fa-clock-o" style="font-size: 20px; color:rgba(0, 0, 0,0.6); margin-top: 9px;">
                        updated just now!
                    </i>

                </div>

            </div>

            <div class="row" id="row2">
                <div id="daily-sales" class="col-3 r2card r2lmargin v-card l-padding">
                    <div id="t-sale" class="card">
                        <div class="sales-card">
                            <div id="rupee-icon">
                                <i class="fa fa-rupee icon-css"></i>
                            </div>
                        </div>
                        <div id="tsale-data">
                            <?php
                            $result = mysqli_query($conn, "select sum(products.price*orderproducts.quantity) as totprice from products inner join 
                                                    orderproducts on products.pid = orderproducts.pid and orderproducts.oid in
                                                    (select oid from orders where date(orderstamp)='2020-05-22' and status='3')");
                            $row = mysqli_fetch_array($result);
                            ?>
                            <p><?php echo "today's sales: " . $row[0]; ?> </p>
                        </div>
                    </div>
                    <i class="fa fa-clock-o" style="font-size: 20px; color:rgba(0, 0, 0,0.6); margin-top: 9px;"></i>
                </div>
                <div class="col-1"></div>
                <div id="weekly-sales" class="col-3 r2card r2lmargin v-card l-padding">
                    <div id="w-sale" class="card">
                        <div class="sales-card">
                            <div id="rupee-icon" style="float: left;">
                                <i class="fa fa-rupee icon-css"></i>
                            </div>

                        </div>
                        <div id="wsale-data" style="float: left;">
                            <?php

                            $result = mysqli_query($conn, "select sum(products.price*orderproducts.quantity) as totprice from products inner join
                                                 orderproducts on products.pid = orderproducts.pid and orderproducts.oid in
                                                (select oid from orders where week(orderstamp)=week(current_date()) and status='3')  ");
                            $row = mysqli_fetch_array($result);
                            ?>
                            <p><?php echo "total sales this week are: " . $row[0]; ?> </p>
                        </div>
                    </div>
                    <i class="fa fa-clock-o" style="font-size: 20px; color:rgba(0, 0, 0,0.6); margin-top: 9px;"></i>
                </div>
                <div class="col-1"></div>
                <div id="monthly-sales" class="col-3 r2card  r2lmargin v-card l-padding">
                    <div id="m-sale" class="card">
                        <div class="sales-card">
                            <div id="rupee-icon">
                                <i class="fa fa-rupee icon-css"></i>
                            </div>
                        </div>
                        <div id="wsale-data">
                            <?php

                            $result = mysqli_query($conn, "select sum(products.price*orderproducts.quantity) as totprice from products inner join
                                                 orderproducts on products.pid = orderproducts.pid and orderproducts.oid in
                                                (select oid from orders where month(orderstamp)= month(current_date()) and status='3')  ");
                            $row = mysqli_fetch_array($result);
                            ?>
                            <p><?php echo "total sales this week are: " . $row[0]; ?> </p>
                        </div>
                    </div>
                    <i class="fa fa-clock-o" style="font-size: 20px; color:rgba(0, 0, 0,0.6); margin-top: 9px;"></i>

                </div>
            </div>
            <div class="row" id="row3">
                <!-- div for orders of current month -->
                <div id="orders-pending" class="v-card orderTable">
                    <div class="heading">
                        <div class="order-title">Order Request Table</div>
                    </div>
                    <div id="order-req">

                        <?php
                        $result = mysqli_query($conn, " select orders.oid,date(orders.orderstamp) as date, products.pname,orderproducts.quantity,users.Name,users.Contact,deliveryaddress.address,
                        deliveryaddress.state,deliveryaddress.city,deliveryaddress.pincode from users INNER JOIN deliveryaddress ON users.email=
                        deliveryaddress.uid INNER JOIN orders ON orders.oid = deliveryaddress.oid inner join orderproducts on orderproducts.oid= orders.oid 
                        inner join products on products.pid = orderproducts.pid and orders.status='0';");

                        if (mysqli_num_rows($result) > 0) {
                        ?>

                            <table class=" table-bordered table-hover order-req-table">
                                <thead>
                                    <tr>
                                        <th>
                                            Order Id
                                        </th>
                                        <th class="odate">Order Date</th>
                                        <th class="pname">product name</th>
                                        <th>User Name</th>
                                        <th>Contact Number</th>
                                        <th>Delivery Address</th>
                                        <th>Shipped Or Not</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- test query-->
                                    <?php
                                    $a = 0;
                                    $oidref = " ";
                                    while ($row = mysqli_fetch_array($result)) {

                                        if ($a == 0) {
                                            $oidref = $row["oid"];
                                    ?>
                                            <tr style="padding: 10px;">
                                                <td><?php echo  $row["oid"]; ?></td>
                                                <td class="odate"><?php echo  $row["date"]; ?></td>
                                                <td class="pname" id=<?php echo $row["oid"]; ?>><?php echo " " . $row["pname"] . "(" . $row["quantity"] . ") "; ?></td>
                                                <td><?php echo $row["Name"]; ?></td>
                                                <td><?php echo  $row["Contact"]; ?></td>
                                                <td><?php echo  $row["address"] . ", " . $row["city"] . ", " . $row["state"] . ", " . $row["pincode"]; ?></td>
                                                <td>
                                                    <button class="btn btn-info" onclick="openOrderReqForm(<?php echo $row['oid'] ?>)">Confirm Req</button>
                                                    <div class="form-popup" id="popupOrderReqForm">
                                                        <form method="post" id="OrderReqForm">
                                                            <label>The Order Shipped : </label>
                                                            <input type="number" id="oidReqIn" name="oidReqIn" style="display: none;">
                                                            <!-- <input type="number" id="oidToShip"name="oidToShip" style="display: none;">   -->
                                                            <input type="submit" name="Confirm" id="submitFormToDel">
                                                            <button type="button" class="btn cancel" onclick="closeOrderReqForm()">No</button>
                                                        </form>
                                                    </div>
                                                </td>

                                            </tr>
                                        <?php
                                            $a = 1;
                                        } elseif ($oidref == $row["oid"]) {
                                            $pname = $row["pname"];
                                            $oidr = $row["oid"];
                                            $quan = $row["quantity"];
                                            $str = ", " . $pname . "(" .  $quan . ") ";
                                            echo "<script>$('#$oidr').append('$str')</script>";
                                        } else {

                                            $oidref = $row["oid"];
                                        ?>
                                            <tr>
                                                <td><?php echo  $row["oid"]; ?></td>
                                                <td class="odate"><?php echo  $row["date"]; ?></td>
                                                <td id=<?php echo $row["oid"]; ?>><?php echo " " . $row["pname"] . "(" . $row["quantity"] . ")"; ?></td>
                                                <td><?php echo $row["Name"]; ?></td>
                                                <td><?php echo  $row["Contact"]; ?></td>
                                                <td><?php echo  $row["address"] . ", " . $row["city"] . ", " . $row["state"] . ", " . $row["pincode"]; ?></td>

                                                <td>
                                                    <button class="btn btn-info" onclick="openOrderReqForm(<?php echo $row['oid'] ?>)">Confirm Req</button>
                                                    <div class="form-popup" id="popupOrderReqForm">
                                                        <form method="post" id="OrderReqForm">
                                                            <label>The Order Shipped : </label>
                                                            <input type="number" id="oidReqIn" name="oidReqIn" style="display: none;">
                                                            <!-- <input type="number" id="oidToShip"name="oidToShip" style="display: none;">   -->
                                                            <input type="submit" name="Confirm" id="submitFormToDel">
                                                            <button type="button" class="btn cancel" onclick="closeOrderReqForm()">No</button>
                                                        </form>
                                                    </div>
                                                </td>

                                            </tr>
                                        <?php
                                        }

                                        ?>

                                    <?php
                                    }
                                    ?>
                                </tbody>

                            </table>
                        <?php
                        } else { ?>
                            <div class="no-result-found">
                                <div class="exclam-icon" style="display:inline;">
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
                <div id="delivered-products" class="v-card orderTable">
                    <div class="heading">
                        <div class="order-title">Order Delivered Table</div>
                    </div>
                    <div id="order-deliv">

                        <?php
                        $result = mysqli_query($conn, " select orders.oid,date(orders.orderstamp) as date, products.pname,orderproducts.quantity,users.Name,users.Contact,deliveryaddress.address,
                        deliveryaddress.state,deliveryaddress.city,deliveryaddress.pincode from users INNER JOIN deliveryaddress ON users.email=
                        deliveryaddress.uid INNER JOIN orders ON orders.oid = deliveryaddress.oid inner join orderproducts on orderproducts.oid= orders.oid 
                        inner join products on products.pid = orderproducts.pid and orders.status='3';");

                        if (mysqli_num_rows($result) > 0) {
                        ?>


                            <table class=" table-bordered table-hover order-req-table">
                                <thead>
                                    <tr>
                                        <th>
                                            Order Id
                                        </th>
                                        <th class="odate">Order Date</th>
                                        <th class="pname">product name</th>
                                        <th>User Name</th>
                                        <th>Contact Number</th>
                                        <th>Delivery Address</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $a = 0;
                                    $oidref = " ";
                                    while ($row = mysqli_fetch_array($result)) {

                                        if ($a == 0) {
                                            $oidref = $row["oid"];
                                    ?>
                                            <tr style="padding: 10px;">
                                                <td><?php echo  $row["oid"]; ?></td>
                                                <td class="odate"><?php echo  $row["date"]; ?></td>
                                                <td class="pname" id=<?php echo $row["oid"]; ?>><?php echo " " . $row["pname"] . "(" . $row["quantity"] . ") "; ?></td>
                                                <td><?php echo $row["Name"]; ?></td>
                                                <td><?php echo  $row["Contact"]; ?></td>
                                                <td><?php echo  $row["address"] . ", " . $row["city"] . ", " . $row["state"] . ", " . $row["pincode"]; ?></td>
                                            </tr>
                                        <?php
                                            $a = 1;
                                        } elseif ($oidref == $row["oid"]) {
                                            $pname = $row["pname"];
                                            $oidr = $row["oid"];
                                            $quan = $row["quantity"];
                                            $str = ", " . $pname . "(" .  $quan . ") ";
                                            echo "<script>$('#$oidr').append('$str')</script>";
                                        } else {

                                            $oidref = $row["oid"];
                                        ?>
                                            <tr>
                                                <td><?php echo  $row["oid"]; ?></td>
                                                <td class="odate"><?php echo  $row["date"]; ?></td>
                                                <td id=<?php echo $row["oid"]; ?>><?php echo " " . $row["pname"] . "(" . $row["quantity"] . ")"; ?></td>
                                                <td><?php echo $row["Name"]; ?></td>
                                                <td><?php echo  $row["Contact"]; ?></td>
                                                <td><?php echo  $row["address"] . ", " . $row["city"] . ", " . $row["state"] . ", " . $row["pincode"]; ?></td>
                                            </tr>
                                        <?php
                                        }

                                        ?>

                                    <?php
                                    }
                                    ?>
                                </tbody>

                            </table>
                        <?php
                        } else { ?>
                            <div class="no-result-found">
                                <div class="exclam-icon" style="display:inline;">
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
            <div class="row" id="row5" style="margin-top: 50px;">
                <!-- no. product sold of a particular category in a week -->
                <div class="r5card v-card col-4">
                    <div id="wsales-chart"></div>
                </div>
                <div class="col-1"></div>
                <!--  no. product sold of a particular category in a month -->
                <div class="r5card v-card col-4">
                    <div id="msales-chart"></div>

                </div>
            </div>
            <div class="row" id="row6" style="margin-top: 40px; ">
                <div class="col-3 shipping-Dept div-boxes">
                    <a class="btn btn-link" href="./shippingdept.php">Shipping Department </a>
                    <p style="color: white;">This Link is for checking the Shipping Department.</p>
                </div>
                <div class="col-1"></div>
                <div class="col-3 text-white div-boxes">
                    <a class="btn btn-link"  href="./upload.php" class="more-tag1"> Add New Products</a>
                    <p>This Link is for Adding the new Products.</p>
                </div>
                <div class="col-1"></div>
                <div class="col-3 text-white div-boxes">
                    <button class="btn btn-link" id="showStockBtn">Avaiable Products</button>
                    <p>This Link is for checking & updating the Stock.</p>
                </div>
            </div>
            <div id="showStock" class="showToggle">
                <div id='products' class="row">
                    <?php
                    $query = "select *  from products  order by pid";
                    $resultset = mysqli_query($conn, $query);
                    $resultPid = '';
                    while ($result = mysqli_fetch_array($resultset)) {
                        $resultPid = $result['pid'];
                    ?>
                        <div class='product col-lg-2 col-md-4 col-sm-6 col-xs-6 col-6'>
                            <img src="data:image/jpeg;base64,<?php echo $result['dpimage'] ?>" alt="" height="150px" width="100%">
                            <div style="height:50px" id="pname">
                                <abbr title="<?php echo $result['pname'] ?>">
                                    <a href="./products.php?pname=<?php echo str_replace(' ', '+', $result['pname']) ?>">
                                        <?php
                                        echo (strlen($result['pname']) < 40) ? $result['pname'] : substr($result['pname'], 0, 35) . "..."; ?>
                                        <div id="quantityShow">(<?php echo $result['quantity'] ?>)</div>
                                    </a>
                                </abbr>
                            </div>
                            <div>Rs.<?php echo $result['price'] ?></div>
                            <button class="btn addStock" onclick="openForm(<?php echo $result['pid'] ?>)">Add</button>
                            <button class="btn Remove Product" id="removeProduct" onclick="openFormDel('<?php echo $result['pid'] ?>')">Remove Product</button>

                        </div>
                    <?php

                    } ?>
                    <div class="form-popup" id="addStockForm">
                        <form id="formForStock" class="form-container">
                            <h1>Login</h1>
                            <input type="number" id="pidToAdd" name="pidToadd" style="display: none;">
                            <label for="addIntoStock"><b>Add in Current Stock </b></label>
                            <input type="number" placeholder="number" id="addIntoStock" name="addStock" required>

                            <input type="submit" onclick="closeForm()" name="submit" id="submitForm">
                            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                        </form>

                        <div id="demo"></div>
                    </div>
                    <div class="form-popup" id="delStockForm">
                        <form id="formForDelProduct" class="form-container">
                            <label>Confirm To Delete The Product</label>
                            <input type="number" id="pidToDel" name="pidToDel" style="display: none;">
                            <input type="submit" onclick="closeFormDel()" name="submit" id="submitFormToDel">
                            <button type="button" class="btn cancel" onclick="closeFormDel()">Close</button>
                        </form>
                    </div>
                </div>



            </div>
        </div>
        <div id="demo1"></div>
    </div>
</body>


</html>
<!-- order  req confirmation code -->
<script>
    function openOrderReqForm(_oid) {
        document.getElementById("popupOrderReqForm").style.display = "block";
        document.getElementById("oidReqIn").value = _oid;
    }

    function closeorderReqForm() {
        document.getElementById("popupShippingForm").style.display = "none";
    }
    $(document).ready(function() {
        $("#OrderReqForm").submit(function(e) {
            e.preventDefault();
            $a = 1; // $a is used to store the delivery  status
            document.getElementById("popupOrderReqForm").style.display = "none";
            $.ajax({
                url: "./updatedeliveryStatus.php",
                data: {
                    oid: $("input[name=oidReqIn]").val(),
                    delivery: $a
                },
                type: "post",
                success: function(data) {
                    location.reload(true);

                }
            });

        });
    });
</script>
<!-- order req form script end -->

<script src="../scripts/newdrop.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- weekly sales chart -->
<script>
    <?php
    $result = mysqli_query($conn, "select p.category,sum(op.quantity) as quantity from products as p,
                        orderproducts as op where p.pid= op.pid and op.oid 
                        in(select oid from orders where week(orderstamp)=week(current_date()) and status='3') group by p.category;");

    ?>
    // Load google charts
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            <?php
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "['" . $row['category'] . "', " . $row['quantity'] . "],";
                }
            }
            ?>
        ]);

        var options = {
            title: 'Product Sold This Week',
            titleTextStyle: {
                color: ('white'),
                fontName: 'Times New Roman',
                fontSize: 25,
                bold: true,
                italic: true
            },
            width: 450,
            height: 350,
            is3D: true,
            backgroundColor: 'transparent',
            legend: {
                position: 'bottom'
            },
            pieSliceText: 'value-and-percentage',
            isStacked: 'percent'
        };

        // Display the chart inside the <div> element with id="wsales-chart"
        var chart = new google.visualization.PieChart(document.getElementById('wsales-chart'));
        chart.draw(data, options);
    }
</script>
<!-- end of the weekly sales chart -->

<!-- monthly  sales chart -->
<script>
    <?php
    $result = mysqli_query($conn, "select p.category,sum(op.quantity) as quantity from products as p,
                        orderproducts as op where p.pid= op.pid and op.oid 
                        in(select oid from orders where month(orderstamp)=month(current_date()) and status='3') group by p.category;");

    ?>
    // Load google charts
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            <?php
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "['" . $row['category'] . "', " . $row['quantity'] . "],";
                }
            }
            ?>
        ]);

        var options = {
            title: 'Product Sold This Month',
            titleTextStyle: {
                color: ('white'),
                fontName: 'Times New Roman',
                fontSize: 25,
                bold: true,
                italic: true
            },
            width: 450,
            height: 350,
            is3D: true,
            backgroundColor: 'transparent',
            legend: {
                position: 'bottom'
            },
            pieSliceText: 'value-and-percentage',
            isStacked: 'percent'
        };
        // Display the chart inside the <div> element with id="msales-chart"
        var chart = new google.visualization.PieChart(document.getElementById('msales-chart'));
        chart.draw(data, options);
    }
</script>
<!-- end of the chart -->
<!-- row6 script -->
<script>
    function openForm(_pid) {
        document.getElementById("demo").innerHTML = _pid;
        document.getElementById("addStockForm").style.display = "block";
        alert("inside openform");
        document.getElementById("pidToAdd").value = _pid;
    }

    function closeForm() {
        document.getElementById("addStockForm").style.display = "none";
    }

    function closeFormDel() {
        alert("close Form");
        document.getElementById("formForDelProduct").style.display = "none";
    }

    function openFormDel(pid) {
        alert("Open The Form to del the Product");
        document.getElementById("delStockForm").style.display = "block";
        document.getElementById("pidToDel").value = pid;
        var h = document.getElementById("pidToDel").value;
        document.getElementById("demo1").innerHTML = "h= " + h;
    }

    $(document).ready(function() {
        $("#showStockBtn").click(function() {
            $("#showStock").slideToggle(1000);

        });
        $("#formForStock").submit(function(e) {
            alert("inside formfor adding Stock");
            e.preventDefault();
            $a = 5;
            $.ajax({
                url: "./addStock.php",
                data: {
                    pid: $("input[name=pidToadd]").val(),
                    quant: $('#addIntoStock').val()
                },
                type: "post",
                success: function(d) {
                    alert("hii inside ajax -" + d);
                    $("#demo1").html("(" + d + ")");
                    $.ajax({
                        url: "./adminRelod.php",
                        data: {
                            adminRelod: $a
                        },
                        type: "post",
                        success: function(d) {

                            $("#products").html(d);


                        }
                    });

                }
            });
        });
        $("#formForDelProduct").submit(function(e) {
            alert("due you really want to delete the Product");
            e.preventDefault();
            $a = 5;
            $.ajax({
                url: "./delProduct.php",
                data: {
                    pid: $("input[name=pidToDel]").val()
                },
                type: "post",
                success: function(data) {
                    alert("hii inside ajax -" + data);

                    $.ajax({
                        url: "./adminRelod.php",
                        data: {
                            adminRelod: $a
                        },
                        type: "post",
                        success: function(d) {
                            $("#products").html(d);
                        }
                    });
                }
            });
        });
    });
</script>

<!-- end of the row6 script-->

<?php

}else{

    echo "<b>Please Login..............</b>";
}

?>