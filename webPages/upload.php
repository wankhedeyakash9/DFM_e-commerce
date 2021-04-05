<html>
<title>Add Products</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <style>
      * {
  box-sizing: border-box;
}
body{
    background-image: linear-gradient(#3253bc,#43232f); 
}
input[type=text], select,input[type=number] {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
  font-size: 16px;
  color: white;
}



input[type=submit]:hover {
  background-color: #0459b1;
}

.container {
  border-radius: 5px;
  background-color: #0459b4;
  padding: 20px;
  width: 70%;
}

.col-25 {
  float: left;
  width: 20%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 70%;
  margin-top: 6px;
}
  </style>
</head>
<body>
    <div class="container">
        <div  style="text-align: center; color:white;"> <h2>Add Products</h2> </div>
            <form id ='form'action="./test.php"  onsubmit="this.submit(); this.reset(); return false;"  method="post" enctype="multipart/form-data">
            
              <div class="row">
                  <div class="col-25"> <label for="pname">Name </label> </div> 
                  <div class="col-75">  <input placeholder="Enter the Name" type="text" name="pname" required><br> </div>
              </div>

              <div class="row">
                   <div class="col-25"><label for="pcat">Category</label> </div>
                    <div class="col-75"><input type="text" placeholder="Enter the Category" name="pcat" required><br></div>
              </div>

              <div class="row">
                   <div class="col-25"><label for="quant">Quantity</label> </div>
                    <div class="col-75"><input placeholder="Enter the Quantity" type="number" name="quant" required><br></div>
              </div>

              <div class="row">
                   <div class="col-25"><label for="desc">Description</label> </div>
                   <div class="col-75"><textarea placeholder="Enter the Detailed Description" name="desc" form="form" rows="2" cols="100" required></textarea> <br></div>
              </div>

              <div class="row">
                   <div class="col-25"><label for="dp">DP_Image</label> </div>
                    <div class="col-75"><input type="file" name="dp" required ><br> </div>
              </div>

              <div class="row">
                   <div class="col-25"><label for="img1">Image_1</label> </div>
                    <div class="col-75"><input type="file" name="img1"  required><br> </div>
              </div>

              <div class="row">
                   <div class="col-25"><label for="img2">Image_2</label> </div>
                    <div class="col-75"><input type="file" name="img2"  required><br> </div>
              </div>

              <div class="row">
                   <div class="col-25"><label for="price">Price</label> </div>
                    <div class="col-75"><input placeholder="Enter the Price" type="text" name="price"><br> </div>
              </div>

              <div class="row">
                   <div class="col-25"><label for="mrp">MRP</label> </div>
                    <div class="col-75"><input placeholder="Enter the MRP" type="text" name="mrp"><br> </div>
              </div>
              <div class="row">
                   <div class="col-25"><label for="color">Color</label> </div>
                    <div class="col-75"><input placeholder="Enter the Color" type="text" name="color"><br></div>
               </div>
               <div class="row">
                   <div class="col-25"><label for="size">Size</label> </div>
                    <div class="col-75"><input placeholder="Enter the Size" type="text" name="size"> </div>
               </div>

               <div class="row"> <div class="col-100"> <input type="submit" class="btn btn-success" value="Add New Product"> </div></div>

            </form>
    </div>
    
    <div id='msg'></div>
</body>


</html>