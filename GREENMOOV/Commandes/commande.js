
 $(document).ready(e=>{
    $('.change').hide(); //hide onload

    $('.edit').click(e=>{ //switch entre form et liste (Admin)
        $('li').toggle();
        $('.change').toggle();     
    });

    $('.i').click(e=>{
        $('.add').clone().removeClass('add').appendTo('#liste'); // D'abord clone/copy (pour garder la class 'add') Puis on eneleve la class template
    });  
 })   
    