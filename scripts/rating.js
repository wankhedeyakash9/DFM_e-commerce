$('.star').click( function()
{
    var stars = document.getElementsByClassName('star');
    var i = 0;
    while(i< stars.length&& stars[i]!=this)
    {
        
       stars[i].classList.add('checked');
       
       i++;
    }
    if (this.classList.contains('checked'))
       this.classList.remove('checked');
    else   
       this.classList.add('checked');
    i = stars.length -1;
    while(i>=0 && stars[i]!= this)
    {
       stars[i].classList.remove('checked')
       i--;
    }
    var starcount = document.getElementsByClassName('checked').length;

    $.post("addcomment.php",{pid:$("#curr-pid").text().toLowerCase(), starcount:starcount},
    function(data){$("#comment-box").html(data)})
}
);