$(document).ready(function()
    {
        $("#signup-btn").click(function()
        {
            $("#container1").css("display","none");
            $("#container2").slideDown(1000);
        });
        $("#login-btn").click(function() {
            $("#container2").css("display","none");
            $("#container1").slideDown("slow");
        });
});

$(document).ready(function(){
    $('#already').click(function(){
        $("#container2").css("display","none");
        $("#container1").slideDown("slow");
    });
});
    $("#signup-form").submit(   function(e)
                                {
                                    var x = document.getElementById("fname").value;
                                    if (x.trim() == ""){
                                        alert("Name must be filled out");
                                        document.getElementById("fname").focus();
                                    return false;
                                    }
                                    var y = document.getElementById("cnum").value;
                                    if (y.length!=10){
                                        alert("Number sholud be of 10 digit's");
                                        document.getElementById("cnum").focus();    
                                    return false;
                                    }
                                    var z=document.getElementById("spid").value;
                                    var a=document.getElementById("respid").value;
                                    if(a!=z){
                                        alert("Password Not Matched");
                                        document.getElementById("respid").focus();
                                    return false;
                                    }
                                    if (!confirm('Please make sure all details are correct!'))
                                        return false;
                                        
                                    e.preventDefault();
                                    $.ajax({  "method" : "post", "url": "./signup.php" ,
                                                "data" : $("#signup-form").serialize(),
                                                "success" : function(msg)
                                                            {
                                                                    $("#s-mesg").html(msg);
                                                                    setTimeout(()=> {$("#s-mesg").html("")} , 4000);
                                                            }

                                                } );
                                }
     );

     $(".login-form").submit(   function(e)
     {
        var x = document.getElementById("uid").value;
                                    if (x.trim() == ""){
                                        alert("Name must be filled out");
                                        document.getElementById("uid").focus();
                                    return false;
                                    }
             
         e.preventDefault();
         $.ajax({  "method" : "post", "url": "./login.php" ,
                    "data" : $(this).serialize(),
                    "success" : function(msg)
                                 {
                                         $("#l-mesg").html(msg);
                                         setTimeout(()=>  { $("#l-mesg").html("")} , 4000);

                                 },
                    beforeSend: function(){
                                    $(this).css("background","#FFF url('../pics/LoaderIcon.gif') no-repeat -100px");
                                    // .css("background-position-x","96%");
                                    
                                },

                     } );
     }
);

$(".checkout-form").submit(   function(e)
{
   var x = document.getElementById("username").value;
                               if (x.trim() == ""){
                                   alert("Name must be filled out");
                                   document.getElementById("username").focus();
                               return false;
                               }
        
    e.preventDefault();
    $.ajax({  "method" : "post", "url": "./login.php" ,
               "data" : $(this).serialize(),
               "success" : function(msg)
               {
                   $("#msg").html(msg);
                   setTimeout(()=>  { $("#msg").html("")} , 4000);
               }
 
                } );
}
);
