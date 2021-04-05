<!DOCTYPE html>
<html>
    <head>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../styleSheets/footer.css">

    </head>
    <body>
    
    <footer class="footer1" >
        <div class="row1">
            <div class="foot-col clms-4  ">
                <div class="columnWrpr">
                    <a href="#" >  
                        <div class="w3-tag w3-xlarge w3-round w3-grey"  id="a-name" style="padding:3px;margin-bottom:10px; margin-top: 0px !important; font-size: 30px!important;">
                            <div data-toggle="tooltip" title="Divya Furniture Mart"  class="w3-tag  w3-round w3-skyb w3-border w3-border-black">
                                DFM
                            </div>
                        </div>
                    </a>
                    <ul  class="pf-padding-0 pf-margin-0">
                        <li><a class="footerLink" data-toggle="tooltip" title="About Us" href="aboutus.html">About Us</a></li>
                        <li><a class="footerLink" data-toggle="tooltip" title="Home" href="index.php">Home</a></li>
                        <li><a class="footerLink" data-toggle="tooltip" title="Brands" href="#">Brands</a></li>
                        <li><a class="footerLink" data-toggle="tooltip" title="Customer Reviews" href="#">Customer Reviews</a></li>
                        <li><a class="footerLink" data-toggle="modal" data-target="#myModal" title="Admin Login" href="#">Admin</a></li>
                    </ul>
                </div>
            </div>
            <div class="foot-col clms-4  ">
                
            </div>
            <div class="foot-col clms-4  ">
                <div class="columnWrpr">
                    <h4 class="footr-h4">Need Help?</h4>
                    <ul  class="pf-padding-0 pf-margin-0">
                        <li><a href="#" data-toggle="tooltip" class="footerLink" title="Contact Number">Call 1234567891, 9874563211</a></li>
                        <li><a href="#" data-toggle="tooltip" class="footerLink" title="Return">Return and Refund</a></li>
                        <li><a href="#" data-toggle="tooltip" class="footerLink" title="Contact Number">Track Your Order</a></li>
                    </ul>

                </div>
            </div>
        </div>
        <div class="row1">         
            <div class="foot-col clms-4  ">
                <div class="columnWrpr">
                    <h4 class="footr-h4" style="margin-left: 10px">Search Products</h4>
                    <form class="form-inline" id="lower_search" method="get" action="./show.php">
                        <input name="query" id="searchelement" type="text"  placeholder="Search"  aria-label="Search">
                        
                        <a href="javascript:{$('#lower_search').submit(); }"  data-toggle="tooltip" title="serch products">-<i  style="color: white" class="fa fa-search"></i></a>
                    </form>
                </div>
            </div>
            <div class="foot-col clms-4  ">
                    <h4 class="footr-h4" style="margin-left: 10px">Suscribe</h4>
                    <ul class="pf-padding-0 pf-margin-0">
                        <li>
                            <form method="post" action="./suscribe.php">
                                <input type="email" name="suscribe" id="SuscribeId" placeholder="abcd@gmail.com">
                                <input type="submit" >
                            </form>
                        </li>
                    </ul>
            </div>
            <div class="foot-col clms-4  ">
                <div class="columnWrpr">
                    <h4 style="margin-bottom: 15px;" class="footr-h4">Follow Us</h4>
                    <div>
                        <ul class="pf-padding-0 pf-margin-0">
                            <li class="pf-left"> 
                                <div class="social-buttons">
                                    <a class="a-icon test" data-toggle="tooltip" target="_blank"  title="email" href="#"><i class="fa fa-envelope"></i></a>
                                    <a class="a-icon test" data-toggle="tooltip" target="_blank"  title="twitter" href="#"><i class="fa fa-twitter"></i></a>
                                    <a class="a-icon test"data-toggle="tooltip" target="_blank"   title="instagram" href="https://www.instagram.com/divyafurnituremart/"><i class="fa fa-instagram"></i></a>
                                    <a class="a-icon test"data-toggle="tooltip" target="_blank"   title="facebook"href="https://www.facebook.com/divya2282/"><i class="fa fa-facebook"></i></a>
                                    <a class="a-icon test" data-toggle="tooltip" target="_blank"  title="google" href="#"><i class="fa fa-google"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="myModal">
            <div class="modal-dialog">
                 <div class="modal-content">
      
                        <div class="modal-header">
                             <h4 class="modal-title">ADMIN LOGIN</h4>
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
        
                        <div class="modal-body">
                            <div style="color: red; text-align: center;" id="msg"></div>
                            <form id="adminlogin" action="../adminlogin.php" method="POST">
                                <label for="pass">Password:</label>
                                <input  id="admin" type="password" placeholder="**********" name="pass" id="pass">
                                <input type="Submit" value="Login">
                            </form>
                        </div>
                                
                         <div class="modal-footer">
          
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                         </div>
        
                </div>
            </div>
        </div>
  
</div>
    </footer>
    <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});

$("#adminlogin").submit(function(e){

    e.preventDefault();
    $.ajax({  "method" : "post", "url": "./adminlogin.php" ,
                    "data" : $(this).serialize(),
                    "success" : function(msg){
                        $("#msg").html(msg);
                    } 
            });

});
</script>
    </body>
</html>

<script src="../scripts/cart.js"></script>
