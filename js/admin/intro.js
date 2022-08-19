/*
    Document   : login admin
    Created on : 15/03/2011, 20:31:00
    Author     : CarlosGarcia
    Description: Login behaviour
    Purpose of the javascript follows.
*/  
var id_rc = 0;

//Init
$(document).ready(function(){
    
    $(".bt_close_fancy").click(function(){        
        $.post("/admin/intro/close_aviso",{id: this.id },function(data){
            //var jsonObject = eval('(' + data + ')');
            $("#Av_" + id).fadeOut("slow");
        });
    });
    
    //setTimeout("initTimerRecentActivity()", "5000");
    //loadApointments();
    
    //Fotos
    //This method works together a anchorAnimateBanner
    //It shows the gallery in the middle screen.
    $('#banner_1').fancybox({
        'transitionIn'	:'elastic',
        'transitionOut'	:'elastic',
        'speedIn'	        : 300,
        'speedOut'	        : 200,
        'autoDimensions'	: false,
        'width'         	: 720,
        'height'        	: 420,
        'overlayShow'           : true,
        'titleShow'             : false,
        'href'                  : '/admin/intro/exibir'
    });
    
    $("#bt_analytics").click(function(){        
        $.post("/admin/intro/update_statistics",{id: 0 },function(data){
            var jsonObject = eval('(' + data + ')');
            if(jsonObject['result']){
                $("#analytics_user").empty().append(jsonObject['ga_users']);
                $("#analytics_pageviews").empty().append(jsonObject['ga_pageviews']);
                $("#analytics_sessions").empty().append(jsonObject['ga_sessions']);
            }
        });
    });
    
    //Fotos   
    $('#concorda2').fancybox({
        'transitionIn'	:'elastic',
        'transitionOut'	:'elastic',
        'speedIn'	        : 300,
        'speedOut'	        : 200,
        'autoDimensions'	: false,
        'width'         	: 720,
        'height'        	: 420,
        'overlayShow'           : true,
        'titleShow'             : false,
        'href'                  : '/admin/intro/concorda',
        'hideOnOverlayClick'    : false,
        'showCloseButton'       : false
    });
    
    if($("#apply_terms").val() == '0') setTimeout(function(){$('#concorda2').trigger('click');}, 800);
    
});//Close Document Ready   

/*
 * Just to test
 * 
 */
function initTimerRecentActivity(){

    $.post("/site/buscar/recent_activity",{},
    
    function(data){
       
        if(data != 'false'){
            var jsonObject = eval('(' + data + ')');
            $("#it_"+id_rc).css("display", "none");
            var item =  "<div class='item_recent_activity' id='it_"+id_rc+"'>"+
                            "<div class='container_picture_activity'><img class='picture_activity' src='"+jsonObject['picture']+"'/></div>"+
                            "<div class='label_activity_name'>"+jsonObject['nome']+"</div>"+
                            "<div class='label_activity_titulo'>"+jsonObject['titulo']+"</div>"+
                        "</div>";

            $("#recent_activity").prepend(item);
            $("#it_"+id_rc).fadeIn("slow");
            id_rc++;
        }
    });
    
    //setTimeout("initTimerRecentActivity()", "5000");
    
}

/*
 * Just to test
 * 
 */
function checkIntroLogin(loggedin){
    if(loggedin == '1'){
        $(".intro_logged_off").hide();
        $(".intro_logged_in").fadeIn("fast");
    }
}

/*
 * Just to test
 * 
 */
function loadApointments(){
    $.post("/admin/calendario/carregar_compromissos",{
        day: $('#helper_action').attr('data-day'),
        month: $('#helper_action').attr('data-month'),
        layout: 'calendar_intro'
        
    },function(data){
        $("#items_calendar_day").empty().append(data);
    });
}