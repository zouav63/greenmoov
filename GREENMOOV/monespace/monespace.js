$(document).ready(function(){
    const admin = document.getElementById("admin");
    if(admin.getAttribute("value")<3){
        $('#admin').hide();
    }else{
        $('#admin').show();
    }
    $('.unactive').hide();
    $('.edit').click(function(){
        $(this.parentNode.querySelector('.unactive')).toggle();
    });
    var info = document.querySelectorAll(".info");
    for(var i=0; i<info.length; i++){
            if(info[i].innerText=="?"){
                info[i].style.color = "red";
        }
    }
    if(document.getElementById('changestat').getAttribute('value')!=='3'){
        $('#changestat').hide();
    }
});

