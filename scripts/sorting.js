function sortAsc (property)
{   var v = document.getElementsByClassName('product');


for(var i=0;i<v.length;i+=1)
{
    // console.log($(v[i]).find(property));
    for(var j=0;j<v.length-i;j+=1)
    {
        if(property ==="#pprice")
        {
            // alert("price asc");
            if( parseInt($(v[j]).find(property).text()) > parseInt($(v[j+1]).find(property).text() ) )
            {
                // alert("num")
                var temp = $(v[j]).html();
                $(v[j]).html( $(v[j+1]).html() );
                $(v[j+1]).html(temp);  
            }
        }
        else if (property === "#pname") 
        { 
            // alert("pname asc");
            if( $(v[j]).find(property).text().toLowerCase() > $(v[j+1]).find(property).text().toLowerCase()  )
            {
            // alert('name');
                var temp = $(v[j]).html();
                $(v[j]).html( $(v[j+1]).html() );
                $(v[j+1]).html(temp);  
            }
        }    
    }
}

}


function sortDesc(property)
{
var v = document.getElementsByClassName('product');

for(var i=0;i<v.length;i+=1)
{
    
    for(var j=0;j<v.length-i;j+=1)
    {
        if(property ==="#pprice")
        {
            // alert("price desc");

            if( parseInt( $(v[j]).find(property).text() ) < parseInt( $(v[j+1]).find(property).text() ) )
            {
                var temp = $(v[j]).html();
                $(v[j]).html( $(v[j+1]).html() );
                $(v[j+1]).html(temp);  
            }
        }
        else if (property === "#pname") 
        {
            // alert("pname desc");

            if( $(v[j]).find(property).text().toLowerCase() < $(v[j+1]).find(property).text().toLowerCase()  )
            {
                var temp = $(v[j]).html();
                $(v[j]).html( $(v[j+1]).html() );
                $(v[j+1]).html(temp);  
            }
        }
    }
}
}

$(".sort").change(function()
{
    $(document).scrollTop(0);
    
    $("html").css("overflow","hidden");   
    $("body").append("<div class='abcd' style='position:absolute;width:100%;height:200%;top: 0;left:0;background:white;opacity:0.8;z-index:1024;background-image: url(../pics/loading-hourglass.gif);background-repeat: no-repeat;background-position-x: center;background-position-y: 150px;'></div>");    
    if($(this).val() === 'sortbyprice-asc')
        sortAsc('#pprice');

    else if($(this).val() === 'sortbyname-asc')
        sortAsc('#pname');

    else if($(this).val() === 'sortbyprice-desc')
        sortDesc("#pprice");
    else if($(this).val() === 'sortbyname-desc')
        sortDesc('#pname')
        
    setTimeout(function()
        {
            $("html").css("overflow-y","visible");   
            $(".abcd").fadeOut("slow",function(){$(".abcd").remove()});
        },
        3000);
});
