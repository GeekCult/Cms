

currentContent = "#step-1";
nr_currentContent = 1;
isPressed = false;

$(document).ready(function(){

    $('.container-step-menu div').click(function(e){

        switch(this.id){
            case "how-to-arrow-right":
                if(!isPressed){
                    nr_currentContent++;
                    if(nr_currentContent > 5) nr_currentContent = 1;
                    loadContent(nr_currentContent);
                }
                isPressed = true;
            break;

            case "how-to-arrow-left":
                if(!isPressed){
                    nr_currentContent--;
                    if(nr_currentContent < 1) nr_currentContent = 5;
                    loadContent(nr_currentContent);
                }
                isPressed = true;
            break;
        }
    });

    $(".fancy-how-to").fancybox({
        'speedIn'	        : 300,
        'speedOut'	        : 200,
        'autoDimensions'	: false,
        'width'                 : 840,
        'height'                : 500,
        'autoScale'             : false,
        'showCloseButton'       : true,
        'transitionIn'          : 'elastic',
        'transitionOut'         : 'elastic',
        'type'                  : 'iframe',
        'scrolling'             : 'no',
        'hideOnOverlayClick'    : false,
        'overlayShow'	        : false,
        'href'                  : '/admin/howto/show/1'
    });

    $(".fancy-how-to-show").fancybox({
        'speedIn'	        : 300,
        'speedOut'	        : 200,
        'autoDimensions'	: false,
        'width'                 : 840,
        'height'                : 500,
        'autoScale'             : false,
        'showCloseButton'       : true,
        'transitionIn'          : 'elastic',
        'transitionOut'         : 'elastic',
        'type'                  : 'iframe',
        'scrolling'             : 'no',
        'hideOnOverlayClick'    : false,
        'overlayShow'	        : false
    });
    
    $(".fancy-how-to-tags").fancybox({
        'speedIn'	        : 300,
        'speedOut'	        : 200,
        'autoDimensions'	: false,
        'width'                 : 980,
        'height'                : 500,
        'autoScale'             : false,
        'showCloseButton'       : true,
        'transitionIn'          : 'elastic',
        'transitionOut'         : 'elastic',
        'type'                  : 'iframe',
        'scrolling'             : 'no',
        'hideOnOverlayClick'    : false,
        'overlayShow'	        : false
    });
});

/*
 * Recarrega uma nova dica usando uma ajax request
 * 
 * @param number
 * 
 */
function loadContent(id){

    $.post("/admin/howto/recarregar/" + id,{           
        id: id
    },function(data){
        $("#container-steps").empty().append(data);
        isPressed = false;
    });
}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
//
//    function swapContent(n_id){
//    
//    switch(n_id){
//
//        case "how-to-bubble-1":
//        case 1:
//
//                if(currentContent != '#step-1'){
//                    $(currentContent).fadeOut('slow', function(){
//                        $('#step-1').fadeIn('slow',function(){
//                            isPressed = false;
//                        });
//                    });
//                    
//                }
//
//                currentContent = "#step-1";
//                nr_currentContent = "1";
//
//                break;
//
//        case "how-to-bubble-2":
//        case 2:
//                if(currentContent != '#step-2'){
//                    $(currentContent).fadeOut('slow', function(){
//                        $('#step-2').fadeIn('slow',function(){
//                            isPressed = false;
//                        });
//                    });
//                    
//                }
//
//                currentContent = "#step-2";
//                nr_currentContent = "2";
//                break;
//
//        case "how-to-bubble-3":
//        case 3:
//                if(currentContent != '#step-3'){
//                    $(currentContent).fadeOut('slow',function(){
//                        $('#step-3').fadeIn('slow',function(){
//                            isPressed = false;
//                        });
//                    });
//                    
//                }
//                currentContent = "#step-3";
//                nr_currentContent = "3";
//                break;
//
//        case "how-to-bubble-4":
//        case 4:
//                if(currentContent != '#step-4'){
//                    $(currentContent).fadeOut('slow',function(){
//                        $('#step-4').fadeIn('slow',function(){
//                            isPressed = false;
//                        });
//                    });
//
//                }
//                currentContent = "#step-4";
//                nr_currentContent = "4";
//                break;
//
//        case "how-to-bubble-5":
//        case 5:
//                if(currentContent != '#step-5'){
//                    $(currentContent).fadeOut('slow',function(){
//                        $('#step-5').fadeIn('slow',function(){
//                            isPressed = false;
//                        });
//                    });
//
//                }
//
//                currentContent = "#step-5";
//                nr_currentContent = "5";
//                break;
//        
//
//        }
//
//        setNormalButton(currentContent);
//
//    }
//
//
//    function setNormalButton(id_step){
//
//        switch(id_step){
//
//             case "#step-1":
//                 $('#how-to-bubble-1').css("background", "url(/media/images/howto/images/bubble1_hover.png)");
//                 $('#how-to-bubble-2').css("background", "url(/media/images/howto/images/bubble2.png)");
//                 $('#how-to-bubble-3').css("background", "url(/media/images/howto/images/bubble3.png)");
//                 $('#how-to-bubble-4').css("background", "url(/media/images/howto/images/bubble4.png)");
//                 $('#how-to-bubble-5').css("background", "url(/media/images/howto/images/bubble5.png)");
//                 break;
//
//             case "#step-2":
//                 $('#how-to-bubble-1').css("background", "url(/media/images/howto/images/bubble1.png)");
//                 $('#how-to-bubble-2').css("background", "url(/media/images/howto/images/bubble2_hover.png)");
//                 $('#how-to-bubble-3').css("background", "url(/media/images/howto/images/bubble3.png)");
//                 $('#how-to-bubble-4').css("background", "url(/media/images/howto/images/bubble4.png)");
//                 $('#how-to-bubble-5').css("background", "url(/media/images/howto/images/bubble5.png)");
//                 break;
//
//             case "#step-3":
//                 $('#how-to-bubble-1').css("background", "url(/media/images/howto/images/bubble1.png)");
//                 $('#how-to-bubble-2').css("background", "url(/media/images/howto/images/bubble2.png)");
//                 $('#how-to-bubble-3').css("background", "url(/media/images/howto/images/bubble3_hover.png)");
//                 $('#how-to-bubble-4').css("background", "url(/media/images/howto/images/bubble4.png)");
//                 $('#how-to-bubble-5').css("background", "url(/media/images/howto/images/bubble5.png)");
//                 break;
//
//            case "#step-4":
//                 $('#how-to-bubble-1').css("background", "url(/media/images/howto/images/bubble1.png)");
//                 $('#how-to-bubble-2').css("background", "url(/media/images/howto/images/bubble2.png)");
//                 $('#how-to-bubble-3').css("background", "url(/media/images/howto/images/bubble3.png)");
//                 $('#how-to-bubble-4').css("background", "url(/media/images/howto/images/bubble4_hover.png)");
//                 $('#how-to-bubble-5').css("background", "url(/media/images/howto/images/bubble5.png)");
//                 break;
//
//            case "#step-5":
//                 $('#how-to-bubble-1').css("background", "url(/media/images/howto/images/bubble1.png)");
//                 $('#how-to-bubble-2').css("background", "url(/media/images/howto/images/bubble2.png)");
//                 $('#how-to-bubble-3').css("background", "url(/media/images/howto/images/bubble3.png)");
//                 $('#how-to-bubble-4').css("background", "url(/media/images/howto/images/bubble4.png)");
//                 $('#how-to-bubble-5').css("background", "url(/media/images/howto/images/bubble5_hover.png)");
//                 break;
//        }
//    }