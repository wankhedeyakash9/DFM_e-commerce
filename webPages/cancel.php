<?php
    include "dbConection.php";
    if(isset($_GET['oid']))
    {
            $oid=$_GET['oid'];
            $q1="select * from orderproducts where oid=$oid";
            $r1=mysqli_query($conn,$q1);
            while($row=mysqli_fetch_row($r1)){
                $qo="select * from orders where oid=$row[0]";
                $ro=mysqli_query($conn,$qo);
                $row1=mysqli_fetch_row($ro);

                $q2="update products set quantity=quantity+$row[2] where pid=$row[1]";
                $r2=mysqli_query($conn,$q2);

                $q3="insert into ordercancel(oid,uid,pid,order_time,time,reason) values ('$row[0]','$row1[2]','$row[1]','$row1[1]',current_timestamp(),'Cancel')";
                $r3=mysqli_query($conn,$q3);
        }   
                $query="delete from orders where oid=$oid";
                $result=mysqli_query($conn,$query);

            echo "<script>window.location='myorder.php'</script>";
    }

    if(isset($_GET['roid']))
    {
            $oid=$_GET['roid'];
            $q1="select * from orderproducts where oid=$oid";
            $r1=mysqli_query($conn,$q1);
            $row=mysqli_fetch_row($r1);
             
            $qo="select * from orders where oid=$oid";
            $ro=mysqli_query($conn,$qo);
            $row1=mysqli_fetch_row($ro);

            $q2="update products set quantity=quantity+$row[2] where pid=$row[1]";
            $r2=mysqli_query($conn,$q2);

            $q3="insert into ordercancel(oid,uid,pid,order_time,time,reason) values ('$oid','$row1[2]','$row[1]','$row1[1]',current_timestamp(),'Return')";
            $r3=mysqli_query($conn,$q3);

            echo "<script>window.location='myorder.php'</script>";
    }
?>