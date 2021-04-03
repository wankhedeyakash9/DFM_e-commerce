
let prdincart = $('.cart-icon > div');

$(document).ready(function(){
                    $('.cart-slide').click(function(){
                                        var hidden = $('.hidden');
                                        if (hidden.hasClass('visible'))
                                        {
                                                    hidden.animate({"right":"-1000px"}, "fast").removeClass('visible');
                                        }
                                        else 
                                        {
                                                    hidden.animate({"right":"0px"}, "fast").addClass('visible');
                                        }
                                        }); 
                    });

function addToCart(_pid) 
{
    
    console.log(_pid)
    if( !$('.prd'+_pid).length )
        prdincart.text(parseInt(prdincart.text())+1);
    $('.place-order-btn').prop('disabled',false);
    
    let prdquant = $('.prd'+_pid +'> .cart-product-details > .cart-product-quant > .quant');
    console.log(prdquant.text())
    if(parseInt( $( prdquant.get(0) ).text())<5)
        prdquant.text( parseInt($( prdquant.get(0) ).text())+1);
    $('.empty-cart-msg').remove();
    $.get( './addtocart.php',{pid : _pid},function(data){$(".cart-product-table").prepend(data);});

}

function removeFromCart(_pid) 
{
    

    $('.prd'+_pid).slideUp('very slow');
    
    setTimeout(()=>{$('.prd'+_pid).remove();},1000);
    prdincart.text(parseInt(prdincart.text())-1);
    if(parseInt(prdincart.text())==0)
        $('.place-order-btn').prop('disabled',true);
    
    $.get( './removefromcart.php',{pid : _pid},function(data){$(".cart-product-table").append(data)});


}

$(".pmbtn").click(
    function() 
    {   
        
        let quantdiv = "." + $(this).parent().parent().parent().attr('class').split(' ')[0] + " .cart-product-quant > .quant";
        quantdiv = $(quantdiv).get(0);
        if($(this).text()==="+" && parseInt($(quantdiv).text()) < 5)
        { 
            addToCart($(this).parent().parent().parent().attr('class').split(' ')[0].substr(3));
        }
        else if($(this).text()==="-" && parseInt($(quantdiv).text()) >1)
        {
            quantdiv = "." + $(this).parent().parent().parent().attr('class').split(' ')[0] + " .cart-product-quant > .quant";
            $(quantdiv).text(parseInt( $(  $(quantdiv).get(0) ).text())-1);
            $.get( './addtocart.php',{ decreaseQuant : $(this).parent().parent().parent().attr('class').split(' ')[0].substr(3)});
        }

    })



if(parseInt(prdincart.text())!=0)
    $('.place-order-btn').prop('disabled',false);
