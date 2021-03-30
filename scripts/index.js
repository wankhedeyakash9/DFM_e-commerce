
$(document).ready(function(){
    $("#faltu").height($(".head-cat-div").height());
});

function toggleForm()
{                    
    $("#lsform").fadeToggle('slow');
    if($('html').css('overflow-y') === 'visible' )
        $('html').css('overflow-y','hidden');
    else $('html').css('overflow-y','visible');
}
 
/*document.onreadystatechange = function() { 
    if (document.readyState !== "complete") { 
        document.querySelector("body").style.visibility = "hidden"; 
        document.querySelector("#loader").style.visibility = "visible"; 
    } else { 
        document.querySelector("#loader").style.display = "none"; 
        document.querySelector("body").style.visibility = "visible"; 
    } 
}; 
        
/*$("#search-frm").submit(function(e)
{
    $("#suggesstion-box").hide();
    e.preventDefault();
    $.get("./searchquery.php",{'query': $("#search-box").val()},
            function(data)
            {
                $("#suggesstion-box").hide();
                $(".main-content").html(data);
                $("#search-box").blur();

            }
    );
});

$(document).ready(function()
    {
        $("#lower_search").submit(function(e)
        {
            e.preventDefault();
            $.get("./searchquery.php",{'query': $("#searchelement").val()},function(data){$(".main-content").html(data);});
            $(document).scrollTop(0);
            
        });
    }
)
*/


$(window).resize(function()
{
    $("#faltu").height($(".head-cat-div").css('height'));
});



$(document).mouseup(function(e){
    var clicked = $("#search-box > #product-list > li");
    if(!clicked.is(e.target))
        $("#suggesstion-box").hide();


});

function llslide()
{
    var d = document.getElementsByClassName("ll-slider-inner")[0];
    $(d).css('width',0);
    $(d).css('margin-left',0);
    setTimeout(  () => {$("#ll-slider").append($(d).remove().css("width",200).css('margin-left',10)); }, 800);
}
$(document).ready(function()
    {
        setInterval(llslide,3000);    
    });

// $(".main-content").css('top',$(".head-cat-div").css('height'));
$(document).ready(function(){
    $("#faltu").height($(".head-cat-div").height());
});


