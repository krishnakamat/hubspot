$(document).ready(function(){
//	alert(document.getElementsByName('challenge'));
//	$("#hideshow").css("display","none");
        $(".challenge").click(function(){
        if ($('input[name=challengetype]:checked').val() == "team" ) {
            $("#hideshow").slideDown("fast"); //Slide Down Effect
			document.getElementsByName('scoreboard')[0].selectedIndex=0;
        } else {
            $("#hideshow").slideUp("fast");  //Slide Up Effect
			document.getElementsByName('scoreboard')[0].selectedIndex=1;
        }
     });
});

