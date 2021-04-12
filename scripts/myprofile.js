
$(document).ready(function(){
        $(".save").hide();
        $("#editform3").hide();
        $("#add").hide(); 
        $("#addform").hide();
});
$("#change").click(function()
{
    $("#passw").show();
});

$("#aprofile").click(function()
{ 
    $("#add").hide();
    $("#mypro").show();
});


$("#aaddress").click(function()
{
    $("#mypro").hide();
    $("#add").show();
}); 
$(document).ready(function()
{
    $("#edit1").click(function()
    {
        $("#edit1").hide();
        $("#save1").show();
        $("#fullname").prop('disabled', false);
    });
});
$(document).ready(function()
{
    $("#edit2").click(function()
    {
        $("#edit2").hide();
        $("#save2").show();
        $("#contact").prop('disabled', false);
    });
});

$(document).ready(function()
{
    $("#change").click(function()
    {
        $("#change").hide();
        $("#output").hide();
        $("#editform3").show("slow");
        $("#pass").prop('disabled', false);
    }); 
    
});

$("#cancelpass").click(function()
{
    $("#change").show();    
    $("#editform3").hide( "slow");
});
$(document).ready(function()
{
    $("#anewadd").click(function()
    {
        $("#addform").fadeIn(3000);
    });
});

$("#editform2").submit(function(e)
{
    e.preventDefault();
    $.post("./myprofile.php", {contact:$("#contact").val()},
            function(data) 
            {
                $("#edit2").show();
                $("#save2").hide();
                $("#contact").prop('disabled', true); 
                console.log(data)   ;
            }
        );
});

$("#editform1").submit(function(e)
{
    e.preventDefault();
    $.post("./myprofile.php", {name:$("#fullname").val()},
            function(data) 
            {
                var y = document.getElementById("contact").value;
                if (y.length!=10){
                    alert("Number sholud be of 10 digit's");
                    document.getElementById("contact").focus();    
                    return false;
                }
                $("#edit1").show();
                $("#save1").hide();
                $("#fullname").prop('disabled', true);    
            }
        );
});

$(document).ready(function()
{
    $("#editform3").submit(function(e)
    {
            e.preventDefault();
            $.post('./myprofile.php', { pass:$('#pass').val(), npass:$('#npass').val(), cpass:$('#cpass').val()},
            function(data)
            {
                $("body").append(data);

        }) ;
    });
});

$(document).ready(
    function()
    {
        $(".del-address").click(
            function()
            {
                $.post("myprofile.php",{ deladd:$(this).attr('deladd') },function(data){console.log(data)} );
                $(this).parent().parent().slideUp();
                $(this).parent().remove();
                $("body").append("<div id= 'deladdmsgbx'style='display:none;text-align: center; position: fixed; bottom: 2%; background: rgb(64, 64, 64);"+
                                    " color: wheat; right: 1%; height: 100px; width: 400px; font-size: 20px; padding-top: 40px; "+
                                    "box-shadow: black 0px 0px 10px;'> "+
                                        "The address has been removed "+
                                "</div>")
                setTimeout(() => 
                {
                    $("#deladdmsgbx").fadeIn("very very slow")
                    setTimeout( ()=> $("#deladdmsgbx").fadeOut("very very slow", ()=> $("#deladdmsgbx").remove()  )  ,2000);
                }
            
                ,1000);



            }
        
        
        );
    }
);

$(document).ready(function(){
    $("#addc").click(function(){
        $("#addform").fadeOut(2000); 
    });
});


