/*
    Document   : main
    Created on : 20/10/2010, 09:31:00
    Author     : CarlosGarcia
    Description: All alerts Admin, it uses a thickbox lib
    Purpose of the javascript follows.
*/

var isTrace = false;
var isPreloader = false;
var countPreloader = 0;
var isCloseable = true;
$(document).ready(function(){
    $('#bt_close_message').click(function(){tb_removeAlert();});
    $('#container_result_message').hide();
    $('#forgotten_password').click(function(){showForgottenPassword()});
});//Close Document Ready

/*
 * Alert for all common result messages
 * It has just 2 lines of text
 *
 */
function showAlertDimCancel(data){    
    $('.bg_result_message').show("fast");
    $('#resultAlertMessageCancel').text(data);
    $('#container_result_message_cancel').show("fast");
    
    $('#bt_alertdim_cancel').click(function(){tb_removeAlert("options"); cancelActionAlertDim();});
    $('#bt_alertdim_yes').click(function(){tb_removeMessage("options");completeActionAlertDim()});

    //If overlay clicked it closes the dim message
    isCloseable = false;

    tb_showAlert();
}

/*
 * Alert for all common result messages
 * It has just 2 lines of text
 *
 */
function showAlertDimCancelAdvanced(id, callback, message){    
    $('.bg_result_message').show("fast");
    $('#resultAlertMessageCancel').text(message);
    $('#container_result_message_cancel').show("fast");
    
    $('#bt_alertdim_cancel').click(function(){tb_removeAlert("options"); cancelActionAlertDim();});
    $('#bt_alertdim_yes').click(function(){tb_removeMessage("options"); callback(id)});

    //If overlay clicked it closes the dim message
    isCloseable = false;

    tb_showAlert();
}

/*
 * Shows Alert preloader
 *
 */
function showAlertDimPreloader(isOverlay, label){ 
    
    if(label != '') $(".text_result_preloader").text(label);
    $('.bg_result_preloader').show();
    $('#container_result_preloader').show();
    //If overlay clicked it closes the dim message
    isCloseable = false;
    id_interval = setInterval("loadingPreloader()", 200);
    isPreloader = true;
    tb_showAlert(isOverlay);
}

/*
 * Removes Alert preloader
 *
 */
function removeAlertDimPreloader(isFull){
    //Preloader class general preloader without widget
    $('.bg_result_preloader, .preloader').css("display", "none");
    $('#container_result_preloader').css("display", "none");
    isPreloader = false;
    clearInterval(id_interval);
    if(isFull){
        tb_removeAlert("preloader");
    }
}


/*
 * Alert for all common result messages
 * It has just 2 lines of text
 *
 */
function showAlertDim(data){
    
    if(isPreloader){
       removeAlertDimPreloader(false);
    }    
    
    $('.bg_result_message').show("fast");
    $('.bt_close_message').show("fast");
    $('#resultAlertMessage').text(data);
    $('#container_result_message').show("fast");
    $('#bt_close_message').click(function(){tb_removeAlert("common")});

    //If overlay clicked it closes the dim message
    isCloseable = true;
    tb_showAlert();
}

/*
 * Alert login for the admin login
 *  
 */
function showAlertLogin(data){
    $('.bg_result_login').show("fast");
    $('#container_login').show("fast");
    $('.bt_close_message').show("fast");
    $('#bt_close_login').click(function(){tb_removeAlert("login")});

    //If overlay clicked it closes the dim message
    isCloseable = false;

    tb_showAlert();
}

function showTrace(data){

    if(!isTrace){        
        $('.bg_result_message2').show("fast");
        $('.bt_close_message').show("fast");
        $('#resultAlertMessage2').append(data);
        $('#container_result_message2').show("fast");
        $('#bt_close_message2').click(function(){tb_removeAlert2()});
        isTrace = true;
        tb_showAlert();

    }else{

        $('#resultAlertMessage2').append(data);

    }

    //If overlay clicked it closes the dim message
    isCloseable = true;
}

/*
 * It removes all the alert dim on stage
 * Bellow there is a function that only removes the message not the dim!
 * 
 */
function tb_showAlert(isOverlay){

	try { 
            if (typeof document.body.style.maxHeight === "undefined") {//if IE 6
                $("body","html").css({height: "100%", width: "100%"});
                $("html").css("overflow","hidden");
                if (document.getElementById("TB_HideSelect") === null) {//iframe to hide select elements in ie6
                    $("body").append("<iframe id='TB_HideSelect'></iframe><div id='TB_overlay'></div><div id='TB_window'></div>");
                    if(isCloseable){
                        $("#TB_overlay").click(tb_removeAlert);
                    }
                }
            }else{//all others
                if(document.getElementById("TB_overlay") === null){
                    $("body").append("<div id='TB_overlay'></div><div id='TB_window'></div>");
                    if(isCloseable){
                        $("#TB_overlay").click(tb_removeAlert);
                    }
                }
            }
            
            if(isOverlay != false){
                if(tb_detectMacXFF()){
                    $("#TB_overlay").addClass("TB_overlayMacFFBGHack");//use png overlay so hide flash
                }else{
                    $("#TB_overlay").addClass("TB_overlayBG");//use background and opacity
                }
            }

           var baseURL;
	   if(url.indexOf("?")!==-1){ //ff there is a query string involved
                baseURL = url.substr(0, url.indexOf("?"));
	   }else{
	   	baseURL = url;
	   }

            if(!params['modal']){
                document.onkeyup = function(e){
                    if (e == null) { // ie
                            keycode = event.keyCode;
                    } else { // mozilla
                            keycode = e.which;
                    }
                    if(keycode == 27){ // close
                            tb_remove();
                    }
                };
            }

	} catch(e) {
		//nothing here
	}
}
/*
 * It jsut removes the message no t the dim!
 * 
 */
function tb_removeMessage(){
    $('#container_result_message_cancel').hide("fast");    
}

function tb_removeAlert(type){
   
    $("#TB_imageOff").unbind("click");
    $("#TB_closeWindowButton").unbind("click");
    $("#TB_window").fadeOut("fast",function(){$('#TB_window,#TB_overlay,#TB_HideSelect').trigger("unload").unbind().remove();});
    $("#TB_load").remove();

    if (typeof document.body.style.maxHeight == "undefined") {//if IE 6
            $("body","html").css({height: "auto", width: "auto"});
            $("html").css("overflow","");
    }

    switch(type){
        case "common":
            $('.bg_result_message').hide("fast");
            $('.bt_close_message').hide("fast");
            $('#container_result_message').hide("slow");
            
            $('.bg_result_preloader').hide();
            $('#container_result_preloader').hide();
            
            break;

        case "options":
            $('.bg_result_message').hide("fast");
            $('#container_result_message_cancel').hide("slow");
            break;

        case "login":
            $('.bg_result_login').hide("fast");
            $('#container_result_login').hide("slow");
            break;
            
        case "preloader":
            $('.bg_result_preloader').hide("fast");
            $('#container_result_preloader').hide("slow");
            isPreloader = false;
            break;
    }

    document.onkeydown = "";
    document.onkeyup = "";
    return false;
}

/*
 * Animation the preloader bar
 * Just moving
 *
 */
function loadingPreloader(){
    if(countPreloader > 5) countPreloader = 0;
    $("#preloader_loaderbar").css("background-position", countPreloader + "px 0px");
    countPreloader++;    
}

/*
 * Forgot password
 *
 */
function showForgottenPassword(){
    $("#container_password_common").hide();
    $("#container_password_forgot_password").fadeIn("fast"); 
    
    //It handles with forgot password
    $('#bt_forgotten').click(function(){       
        
        var email = $("#email_senha_new").val();
        
        $.post("/site/email/esqueci_senha",{                 
            email: email
        },function(data){
            
            var jsonObject = eval('(' + data + ')');

            if(jsonObject['ERROR'] > '0'){
                $("#container_esqueci_senha_error").fadeIn("slow"); 
            }

            if(jsonObject['SUCCESS'] > '0'){
                $(".login_user").hide();
                $(".container_button_login").hide();
                $("#container_esqueci_senha_success").fadeIn("slow");
                $("#container_esqueci_senha_error").hide();
            }
            
        });
    });
    
}


function hideAlertDimPreloader(isImage){
   
    if(!isImage){
        $("#TB_imageOff").unbind("click");
        $("#TB_closeWindowButton").unbind("click");
        $("#TB_window").hide();    
        $('#TB_window,#TB_overlay,#TB_HideSelect').trigger("unload").unbind().remove();
    }

    $("#TB_load").remove();

    if (typeof document.body.style.maxHeight == "undefined") {//if IE 6
        $("body","html").css({
            height: "auto", 
            width: "auto"
        });
        $("html").css("overflow","");
    }
   
    $('#container_result_preloader').hide();

    document.onkeydown = "";
    document.onkeyup = "";

    return false;
}