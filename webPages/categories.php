<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="styleSheet" href="../styleSheets/newdrop.css">
</head>

<body>
  

  <div id="cate" class="row">

      <div class="dropdown show col-xl-1 col-lg-1 col-md-1 col-sm-2 col-xs-2 col-2" >
        <a  href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="True">
          <i class="fa fa-align-justify" aria-hidden="true"></i>
          
        </a>

        <div class="dropdown-menu row">
          
            <div id="" class="column">
               <div> <a  href="show.php?id=bed">Beds</a></div>
               <div> <a  href="show.php?id=almirah">Almirahs</a></div>
               <div> <a href="show.php?id=Planter">Planters</a></div>
               <div> <a  href="show.php?id=bench">Benches</a></div>
               <div> <a  href="show.php?id=rack">Racks</a></div>
               <div> <a href="show.php?id=couch">Couches</a></div>
               <div> <a href="show.php?id=mattress">Matterss</a></div>
               <div> <a href="show.php?id=chair">Chairs</a></div>
               <div><a href="show.php?id=table">Tables</a></div>
            </div>
            <div id="" class="column">
                <div><a href="show.php?id=office table">Office-Tables</a></div>
                <div><a href="show.php?id=book shelf">Book-Shelf</a></div>
                <div><a href="show.php?id=tv unit">TV-Unit</a></div>
                <div> <a href="show.php?id=stool">Stools</a></div>
                <div> <a href="show.php?id=sofa cum bed">Sofa-Cum-Bed</a></div>
                <div> <a href="show.php?id=pillow">Pillows</a></div>
                <div> <a href="show.php?id=tank">Water-Tank</a></div>
                <div> <a href="show.php?id=tea cart">Tea-Cart</a></div>
                <div> <a href="show.php?id=dressing">Dressing-Table</a></div>
            </div>
            <div id="" class="column">
                <div><a href="show.php?id=sofa">Sofa-Sets</a></div>
                <div><a href="show.php?id=Dinning">Dinning-Tables</a></div>
                <div><a href="show.php?id=center table">Center-Tables</a></div>
                <div><a href="show.php?id=computer table">Computer-Tables</a></div>
                <div><a href="show.php?id=revolving">Revolving-Chairs</a></div>
                <div><a href="show.php?id=home">Home-Furnishing</a></div>
                <div><a href="show.php?id=office">Office-Goods</a></div>
                <div><a href="show.php?id=fiber">Fiber-Goods</a></div>
                <div><a href="show.php?id=metal">Metal-Goods</a></div>
            </div>
          
        </div>
      </div>
      <div class="col-xl-1 col-lg-1 col-md-1 col-sm-2 col-xs-2 col-2"><a href="show.php?id=bed">Beds</a>  </div>
      <div class="col-xl-1 col-lg-1 col-md-1 col-sm-2 col-xs-2 col-2"><a href="show.php?id=almirah">Almirahs</a></div>
      <div class="col-xl-1 col-lg-1 col-md-1 col-sm-2 col-xs-2 col-2"><a href="show.php?id=mattress">Matterss</a></div>
      <div class="col-xl-1 col-lg-1 col-md-1 col-sm-2 col-xs-2 col-2"><a href="show.php?id=chair">Chairs</a></div>
      <div class="col-xl-1 col-lg-1 col-md-1 col-sm-2 col-xs-2 col-2"><a href="show.php?id=table">Tables</a></div>
      
      <div class="col-xl-1 col-lg-1 col-md-1 col-sm-2 col-xs-2 col-2 to-hide"><a href="show.php?id=sofa">Sofa-Sets</a></div>
      <div class="col-xl-1 col-lg-1 col-md-1 col-sm-2 col-xs-2 col-2 to-hide"><a href="show.php?id=Planter">Planters</a></div>
      <div class="col-xl-1 col-lg-1 col-md-1 col-sm-2 col-xs-2 col-2 to-hide"><a href="show.php?id=stool">Stools</a></div>
      <div class="col-xl-1 col-lg-1 col-md-1 col-sm-2 col-xs-2 col-2 to-hide"><a href="show.php?id=couch">Couches</a></div>
      <div class="col-xl-1 col-lg-1 col-md-1 col-sm-2 col-xs-2 col-2 to-hide"><a href="show.php?id=pillow">Pillows</a></div>
      <div class="col-xl-1 col-lg-1 col-md-1 col-sm-2 col-xs-2 col-2 to-hide"><a href="show.php?id=tv unit">TV Unit</a></div>

  </div>

</body>
</html>

<script>


$(".column >div, #cate>div").click(function(){
  $(this).children()[0].click()
})

</script>