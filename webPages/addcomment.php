<?php 
    if(session_status() == PHP_SESSION_NONE)
        session_start();
    include_once "./dbConection.php";
    $result = null;
    if(isset($_POST['comment']))
    {
        $comment = $_POST['comment'];
        $pid     = $_POST['pid'];
        $usrid   = $_SESSION['userid'];
        $query = "INSERT into comments (comment,pid,comments.uid) values('$comment','$pid','$usrid') ON DUPLICATE key UPDATE comment = '$comment'";
        $result = mysqli_query($conn,$query);
    }    
    elseif(isset($_POST['starcount']))
    {
        $starcount = $_POST['starcount'];
        $pid     = $_POST['pid'];
        $usrid   = $_SESSION['userid'];
        $query = "INSERT into comments (rating,pid,comments.uid) values($starcount,'$pid','$usrid') ON DUPLICATE key UPDATE rating = $starcount";
        $result = mysqli_query($conn,$query);
    }
    
    if($result)
        {
            $query = "select comment,rating,u.name 'username' from comments,    users as u where uid = email and pid = (select pid from products where pid =$pid)";
            $result = mysqli_query($conn,$query);
            error_reporting(0);
            while($row =  mysqli_fetch_array($result))
            {
            ?>
                <div style="border-bottom: 1px solid #dae0e5">
                    <div>
                    <div style="display: inline-block; text-align: center;border:2px solid dodgerblue;font-family: initial;border-radius: 25px;width:25px;height:25px ;background: #2a2a2a;color: white"><?php echo substr($row['username'],0,1);?></div>

                        <b><?php echo $row['username'];?></b>
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
                        
        }
        
        else echo mysqli_error($conn);
    
?>