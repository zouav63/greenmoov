$(document).ready(function(){
    $("#register").hide();
    $("#reg").click(function(){
        $("#log").removeClass("active");
        $("#log").addClass("inactive");
        $("#reg").removeClass("inactive");
        $("#reg").addClass("active")        
        $("#login").hide();
        $("#register").show();
    });
    $("#log").click(function(){
        //Faire fonction
        $("#log").removeClass("inactive");
        $("#log").addClass("active");
        $("#reg").removeClass("active");
        $("#reg").addClass("inactive")
        // 
        $("#register").hide();
        $("#login").show();

    });
})
