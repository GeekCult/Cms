/*
Document   : CoolPicker admin
Created on : 02/01/2011, 16:31:00
Author     : CarlosGarcia
Description: Esta classe era usada dentro da classe paginas.js
             como algumas outros controller começaram a usa-la
             nada melhor que separa para ficar mais fácil de usar.
Purpose of the javascript follows.
*/

var path_banner_coolstuff = "/admin/banners/t350/exibir";
var path_gallery_coolstuff = "/admin/images/banner/0/9";
var path_images_coolstuff = "/admin/images/images/0/9";
var path_htmlbanners_coolstuff = "/admin/htmlbanners/exibir";
var path_category_coolstuff = "/admin/categorias/adicionar/";
var path_users_group_admin = "/admin/users_selection/exibir_group/";
var path_users_admin = "/admin/users_selection/exibir_admin/";
var path_users = "/admin/users_selection/exibir/";


$(document).ready(function(){        
    initCadastrarCoolPicker();
});

 /* TODO: REmover estes Fancys, Utilizar os trigger abaixo no botao select...
 *
 *
 * It inits the listaner and actions for the editar e novo
 * modulo
 *
 */
function initCadastrarCoolPicker(){
    //Old error with listener applieds
    var id_page_focused = $("#helper_id_controller").val();
    //Cadatrar novas fotos de produtos
    //It shows the gallery in the middle screen.
    $('#bt_upload').fancybox({
        'transitionIn':'elastic', 'transitionOut':'elastic','speedIn': 300,'speedOut': 200, 'autoDimensions': false,'width': 720,'height': 460,'overlayShow': false,
        'href'        : '/admin/images/adicionar'
    });

    $("#fancybox_banner_launcher").fancybox({
        'transitionIn'          :'elastic', 'transitionOut':'elastic','speedIn': 300,'speedOut': 200, 'autoDimensions': false,'width': 720,'height': 460,'overlayShow': false,
        'href'                  : path_banner_coolstuff,
        'titleShow'             : false
    });
    
    $("#fancybox_user_launcher").fancybox({
        'transitionIn'          :'elastic',
        'transitionOut'         :'elastic',
        'speedIn'               : 300,
        'speedOut'              : 200,
        'autoDimensions'        : false,
        'width'                 : 340,
        'height'                : 490,
        'overlayShow'           : false,
        'href'                  : path_users,
        'titleShow'             : false
    });
    
    $("#fancybox_user_launcher_admin").fancybox({'transitionIn':'elastic', 'transitionOut' :'elastic','speedIn' : 300, 'speedOut': 200, 'autoDimensions': true, 'width': 370,'height' : 490,'overlayShow' : false,'href': path_users_admin,'titleShow': false});
    $("#fancybox_user_group_launcher_admin").fancybox({'transitionIn':'elastic', 'transitionOut' :'elastic','speedIn' : 300, 'speedOut': 200, 'autoDimensions': true, 'width': 370,'height' : 490,'overlayShow' : false,'href': path_users_group_admin,'titleShow': false});

    $("#fancybox_gallery_launcher").fancybox({
        'transitionIn'          :'elastic',
        'transitionOut'         :'elastic',
        'speedIn'               : 300,
        'speedOut'              : 200,
        'autoDimensions'        : false,
        'width'                 : 720,
        'height'                : 460,
        'overlayShow'           : false,
        'href'                  : path_gallery_coolstuff,
        'titleShow'             : false
    });  

    $("#fancybox_images_launcher").fancybox({
        'transitionIn'          :'elastic',
        'transitionOut'         :'elastic',
        'speedIn'               : 300,
        'speedOut'              : 200,
        'autoDimensions'        : false,
        'width'                 : 720,
        'height'                : 460,
        'overlayShow'           : false,
        'href'                  : path_images_coolstuff,
        'titleShow'             : false
    });
    
    $("#fancybox_category_launcher").fancybox({
        'transitionIn'          :'elastic',
        'transitionOut'         :'elastic',
        'speedIn'               : 300,
        'speedOut'              : 200,
        'autoDimensions'        : false,
        'width'                 : 720,
        'height'                : 460,
        'overlayShow'           : false,
        'href'                  : path_category_coolstuff + id_page_focused,
        'titleShow'             : false
    });  

    $("#fancybox_htmlbanners_launcher").fancybox({
        'transitionIn'  :'elastic', 'transitionOut':'elastic','speedIn': 300,'speedOut': 200, 'autoDimensions': false,'width': 720,'height': 460,'overlayShow': false,
        'href'          : path_htmlbanners_coolstuff,
        'titleShow'     : false
    }); 
    
    $(".fancybox-publicar").fancybox({
        'transitionIn'  :'elastic', 'transitionOut':'elastic','centerOnScroll': true, 'autoScale': true, 'speedIn': 300,'speedOut': 200, 'autoDimensions': false, 'width': 310,'height': 440,'overlayShow': true, 'titleShow' : false,'type' : 'iframe'
    });
    
    $('#fancybox_textures_launcher').fancybox({
        'transitionIn':'elastic','transitionOut':'elastic','speedIn': 300,'speedOut': 200,'autoDimensions':false,'width':720,'height':450,'overlayShow': false,
        'href'        : "/admin/texturas/site/exibir"
    });
    
    $('#fancybox_efeitos_launcher').fancybox({
        'transitionIn':'elastic','transitionOut':'elastic','speedIn': 300,'speedOut': 200,'autoDimensions':false,'width':720,'height':450,'overlayShow': false,
        'href'        : "/admin/texturas/efeitos/exibir"
    });
    
    $('#fancybox_icones_launcher').fancybox({
        'transitionIn':'elastic','transitionOut':'elastic','speedIn': 300,'speedOut': 200,'autoDimensions':false,'width':720,'height':450,'overlayShow': false,
        'href'        : "/admin/texturas/icones/exibir"
    });
}

/**
 * It adds an image from banner gallery
 * into the page slot.
 *
 * PS: It' uses the same method addImageStuff from the exibir images e galeria
 * So, take care of it when it is used together with bannerMaker
 *
 * @param number id
 *
 */
function addImageStuff(img, id, title, type){

    var path = "url(/media/images/icons/icons_slot_full.png)";
    if(slotFoto == '0')  path = "url(/media/images/layout/container_banner_page_white.png)";

    $("#slot_page_" + slotFoto).css("background", path);
    $("#slot_page_" + slotFoto).css("background-repeat", "no-repeat");
    //$("#slot_helper_" + slotFoto).val(id);TODO remover isso 12/05
    $("#id_slot_" + slotFoto).text(type + "_" + id);
    $("#zoom_slot_"+ slotFoto).css("display", "block");

    if(type == "f"){
        applyPictureSize(img, slotFoto, "fotos");
    }else{            
        if(slotFoto == '0'){                
            applySwfSize(id, slotFoto, "banner");                
        }else{                
            applySwfSize(id, slotFoto, "container");                
        }
    }
}

/**
 * It adds an cool image from PurplePier database
 * into a specific slot.
 * It works just one size M. 
 *
 * @param number id
 *
 */
function addCoolImageSimple(image_name, id){  
 
    $("#id_slot_"+ slotFoto).text("c_" + id);
    $("#slot_page_" + slotFoto).css("background", "url(/media/images/icons/icons_slot_full.png)");
    $("#slot_page_" + slotFoto).css("background-repeat", "no-repeat");
    applyPictureSize(image_name, slotFoto, "cool");
    
}

/**
 * It adds an image from images into the page slot.
 *
 * PS: several content uses this statements. pages, materias...
 *
 * @param number id
 *
 */
function addImageSlots(img, id, title, type){

    var path = "url(/media/images/icons/icons_slot_full.png)";
    if(slotFoto == '0')  path = "url(/media/images/layout/container_banner_page_white_middle.png) repeat-y";
    if(slotFoto == '0') {$("#slot_page_0").css("height", "100%").css("position", "relative"); $(".slot_page_0_top , .slot_page_0_bottom").show();$(".bt_banner_slot").hide();}

    $("#slot_page_" + slotFoto).css("background", path);
    if(slotFoto != '0')$("#slot_page_" + slotFoto).css("background-repeat", "no-repeat");
    $("#id_slot_" + slotFoto).text(type + "_" + id);
    $("#zoom_slot_"+ slotFoto).css("display", "block");

    if(type == "f"){
        applyPictureSize(img, slotFoto);
        $("#input_pict_id_"+ slotFoto).val('f_' + id);
    }else{            
        if(slotFoto == '0'){                
            applySwfSize(id, slotFoto, "banner");                
        }else{                
            applySwfSize(id, slotFoto, "container");                
        }
    }
}

/**
 * It updates the slots
 *
 * It uses a statement from view listar and update
 * the slots with the images set previously
 *
 * @param json
 *
 */
function updateSlots(result){
    for(var i = 1; i <= 10; i++) {
        $("#slot_paginas_" + i).css("background", "url(/media/images/user/thumbs_120/" + result["slot" + i]["foto"] + ")");
        $("#slot_paginas_" + i).attr("title", result["slot" + i]["titulo"]);
        //$("#slot_helper_" + i).val(result["slot" + i]["id"]);
    }
}

/**
 * It updates the slots
 *
 * It uses a statement from view listar and update
 * the slots with the images set previously
 *
 * @param json
 *
 */
function setEditSlots(result){
 
    var splitAlt = "";
    var splitBanner = "";
    
    
    for(var i = 1; i <= 10; i++){
        
        if(result["container_" + i] != undefined && result["container_" + i] != ""){

            $("#slot_page_" + i).css("background", "url(/media/images/icons/icons_slot_full.png)");
            $("#slot_page_" + i).css("background-repeat", "no-repeat");
            $("#id_slot_" + i).text(result["container_" + i]);

            splitAlt = result["container_" + i].split("_");
            //PS: F de foto não de Flash, flahs é b - banner
            switch(splitAlt[0]){
                case "b":
                    applySwfSize(splitAlt[1], i, "container");
                    break;
                case "f":
                    applyPictureSizeEdit(splitAlt[1], i);
                    break;
                case "h":
                    applyCoolHtmlStuff(splitAlt[1], i);
                    break;
                 case "c":
                    applyCoolImageStuff(splitAlt[1], i);
                    break;
                 case "e":
                    applyImageEmbeded(splitAlt[1], i);
                    break;
            }               
        }
    }
    
    //Special action for banners
    if(result["banner"] != "" && result["banner"] != undefined){

        splitBanner = result["banner"].split("_");
        
        switch(splitBanner[0]){
            case "b":
                $("#slot_page_0").css("background", "url(/media/images/layout/container_banner_page_white_middle.png) repeat-y");
                $("#slot_page_0").css("height", "100%").css("position", "relative");
                $("#id_slot_0").text(result["banner"]);
                applySwfSize(splitBanner[1], 0, "banner");
                break;
            case "f":
                $("#slot_page_0").css("background", "url(/media/images/layout/container_banner_page_white_middle.png) repeat-y");
                $("#slot_page_0").css("height", "100%").css("position", "relative");
                $("#id_slot_0").text(result["banner"]);
                $(".bt_banner_slot").hide();
                $(".slot_page_0_top , .slot_page_0_bottom").show();
                applyPictureSizeEdit(splitBanner[1], 0);
                break; 
            case "e":
                $("#slot_page_0").css("background", "url(/media/images/layout/container_banner_page_white_middle.png) repeat-y");
                $("#slot_page_0").css("height", "100%").css("position", "relative");
                $("#id_slot_0").text(result["banner"]);
                $(".bt_banner_slot").hide();
                $(".slot_page_0_top , .slot_page_0_bottom").show();
                applyPictureSizeEdit(splitBanner[1], 0);
                break; 
        }
    }
    
    //Special actions for icons
    if(result["icon"] != "" && result["icon"] != undefined){
        splitAlt = result["icon"].split("_");
        $("#slot_page_11").css("background", "url(/media/images/icons/icons_slot_full.png)");
        $("#slot_page_11").css("background-repeat", "no-repeat");
        $("#id_slot_11").text(result["icon"]);

        applyCoolImageStuff(splitAlt[1], 11);
    }
}

/**
 * It calculate the images sizes
 * The galeria.js is using this method
 *
 * @param string
 * @param number
 *
 */
function applyPictureSize(imgSlot, slotP, tipo, setActive){
    
    var path = "/media/user/images/original/";
    
    if(tipo == "cool"){path = "http://www.purplepier.com.br/media/images/cool/cool_m/";}
    if(tipo == "componente_site") path = "/media/images/layout_aplicativo/";
    if(tipo == "bloco_pagina") path = "/media/images/layout_block/";
    if(tipo == "bloco_email") path = "/media/images/layout_email/";
    
    //Verify if is slot common or banner
    var slot_width_size = 660, slot_height_size = 400;
    if(slotP != 0 || tipo == "galeria") {slot_width_size = slot_height_size = 120}
    if(slotP != 0 || tipo == "galeria") path = "/media/user/images/thumbs_120/";
    
    //Se for minisite busca no ftp do cabra
    if($("#helper_miniSiteUser").val() != undefined && $("#helper_miniSiteUser").val() != '' && ($("#helper_miniSiteUser").attr('data-remote')) == 1) path = $("#helper_miniSiteUser").attr('data-url');
    if($("#helper_miniSiteUser").val() != undefined && $("#helper_miniSiteUser").val() != '' && ($("#helper_miniSiteUser").attr('data-remote')) == 0) path = "/media/user/images/clients/thumbs_120/";

    var img = new Image();

    img.onload = function(){
        
        var percet = 1;
        
        if(this.width > this.height){
            percet = slot_width_size / this.width;
        }else{
            percet = slot_height_size / this.height;        
        }

        var result = new Array();
        result[0] = this.width * percet;
        result[1] = this.height * percet; 
        
        if(this.width > slot_width_size || this.height > slot_height_size){
            $("#slot_pict_id_"+ slotP + " img").css('width', result[0]+ "px");
            $("#slot_pict_id_"+ slotP).css('height', result[1]+ "px");
        }
        $("#slot_pict_id_"+ slotP).attr("src",  path + imgSlot);
        $("#slot_pict_id_"+ slotP).attr("data-image-name",  imgSlot);//nome image sem path
        $("#submit_pict_id_"+ slotP).val(imgSlot);//Tem name para ser enviado via submit
        $("#slot_pict_id_"+ slotP).css("position",  "relative");
        $("#slot_banner_id_"+ slotP).empty();

        if(this.width > this.height && slotP != 0){
            $("#slot_pict_id_"+ slotP).css("margin-top",  ((result[1] / 2) * -1)+ "px");
            $("#slot_pict_id_"+ slotP).css("top",  "50%");
        }else{
            $("#slot_pict_id_"+ slotP).css("margin-left",  ((result[0] / 2) * -1)+ "px");
            $("#slot_pict_id_"+ slotP).css("left",  "50%");
        }
    }
    
    img.src = path + imgSlot;
    
    if(setActive){
        var path_slot = "url(/media/images/icons/icons_slot_full.png)";
        if(slotP == '0')  path_slot = "url(/media/images/layout/container_banner_page_white_middle.png) repeat-y";
        if(slotP == '0') {$("#slot_page_0").css("height", "100%").css("position", "relative"); $(".slot_page_0_top , .slot_page_0_bottom").show();$(".bt_banner_slot").hide();}

        $("#slot_page_" + slotP).css("background", path_slot);
        if(slotP != '0')$("#slot_page_" + slotP).css("background-repeat", "no-repeat");
        $("#zoom_slot_"+ slotP).css("display", "block");
    }
}

/**
 * 
 * It applys the swf with a new size;
 * It's used in both: novo and editar view 
 *
 * @param string
 * @param number
 * @param string
 *
 */
function applySwfSize(cool, slotC, type){

    var id_banner = cool;

    var path_ajax = "/admin/banners/t250/adicionarcool";        
    if(type == "container"){ path_ajax = "/admin/banners/t250/mostrar"; }

    $.post(path_ajax, {
        id_banner: id_banner

    },function(data){
        $("#slot_banner_id_" + slotC).empty().append(data);
        $("#slot_pict_id_" + slotC).attr("src", "");

        var topMarginBanner = ((120 - $("#slot_banner_id_" + slotC).height()) / 2) + 10;

        $("#slot_banner_id_" + slotC).css("margin-top", topMarginBanner + "px");
    });
}

/**
 * 
 * It applys the html cool banner
 * It's used in both: novo and editar view 
 *
 * @param number
 * @param number
 *
 */
function applyCoolHtmlStuff(cool, slotC){

    var id_coolbanner = cool;
    var height = 40; var width = 120; var percent = 1; 

    $.post("/admin/html_banners/obter",{
        id_coolbanner: id_coolbanner
    },function(data){

        var json_data_object = eval("(" + data + ")");
        
        if(slotC == 0) width = 660;
        
        if(json_data_object['largura'] > json_data_object['altura']){
            percent = width / json_data_object['largura'];
        }else{
            percent = height / json_data_object['altura'];
        }
        
        var result = new Array();
        result[0] = Math.round(json_data_object['largura'] * percent);
        result[1] = Math.round(json_data_object['altura'] * percent);
        
        addBannerHTML(JSON.stringify(json_data_object['cool2']), slotC);
        setSizeBannerFancyBox(result[1], result[0], slotC);

        var topMarginBanner = ((result[1] - height) / 2);
        
        $(".canvas_stage"+slotC).css("margin-left", "0px");
        $(".canvas_stage"+slotC).css("position", "relative");
        $(".canvas_stage"+slotC).css("overflow", "hidden");
        
        if(json_data_object['largura'] > json_data_object['altura'] && slotC != 0){
            $(".canvas_stage"+slotC).css("margin-top",  ((result[1] / 2) * -1)+ "px");
            $(".canvas_stage"+slotC).css("top",  "50%");
        }else{
            $(".canvas_stage"+slotC).css("margin-left",  ((result[0] / 2) * -1)+ "px");
            $(".canvas_stage"+slotC).css("left",  "50%");
        }
        
        
        if(slotC == 0){
            $(".canvas_stage"+slotC).css("height", json_data_object['altura']+"px");
            $("#slot_page_0").css("background", "url(/media/images/layout/container_banner_page_white_middle.png) repeat-y");
            $("#slot_page_0").css("height", json_data_object['altura']+"px").css("position", "relative");
            $(".bt_banner_slot").hide();
            $(".slot_page_0_top, .slot_page_0_bottom").show();
        }

        $("#id_slot_" + slotC).text("h_" + json_data_object['id']);
        $("#slot_page_" + slotC).css("background", "url(/media/images/icons/icons_slot_full.png) no-repeat");
    });
}

/**
 * 
 * It applys the cool image
 * Propably it' a payed resource  
 *
 * @param number
 * @param number
 *
 */
function applyCoolImageStuff(id_cool_image, slotC){

    $.post("/admin/cool/obter/",{
        id_cool_image: id_cool_image
    },
    function(data){

        var json_data_object = eval("(" + data + ")");

        if(json_data_object['content'] != 'false'){            
            applyPictureSize(json_data_object["content"]["cool_m"], slotC, "cool");
        
        }else{
            $("#slot_page_0").css("background", "url(/media/images/icons/icons_slot.png)");
        }
    });
}

/**
 * 
 * It applys the embeded image
 * Propably it' a payed resource  
 *
 * @param number
 * @param number
 *
 */
function applyImageEmbeded(id, slotC){

    $.post("/admin/images/obter/",{
        id_photo: id
    
    },function(data){
        var json_data_object = eval("(" + data + ")");
    
        $("#slot_banner_id_" + slotC).append(json_data_object['content']['embeded']);
        $("#slot_banner_id_" + slotC).css('overflow', 'hidden').css('width', '120px').css('height', '120px');
        
    });
}

/**
 * It applys the picture from edit view
 * It' just used when a view edit is opened
 *
 * @param string
 * @param number
 *
 */
function applyPictureSizeEdit(pict, slotC){

    var id_photo = pict;

    $.post("/admin/images/obter/",{
        id_photo: id_photo
    },
    function(data){

        var json_data_object = eval("(" + data + ")");

        if(json_data_object['content'] != 'false'){
            applyPictureSize(json_data_object["content"]["foto"], slotC, "fotos");
        }else{
            $("#slot_page_0").css("background", "url(/media/images/icons/icons_slot.png)");
        }
    });
}
    
/**
 * It inits the slots buttons and sets some another 
 * listeners such as: pcitures slots
 *
 *
 */
function initSlotEditButton(){
 
    //Seleciona uma nova foto para o slot em pauta
    //It shows image picker in the middle screen.
    $('#slot_support div.container_slot').click(function(){
        slotFoto = this.id;
        $("#helper_id_slot").val(slotFoto);
    });

    //bug fix for fancybox images
    $(".base_bt_remove").click(function(e){
        $("#slot_page_" + this.id).css("background", "url(/media/images/icons/icons_slot.png)");
        $("#slot_page_" + this.id).css("background-repeat", "no-repeat");
        $("#id_slot_" + this.id).text("");
        $("#slot_pict_id_"+ this.id).attr("src", "");
        $("#slot_banner_id_" + this.id).empty();
        $(".canvas_stage"+ this.id).empty();
        $("#input_pict_id_"+ this.id).val('');
        $("#slot_texture_id_"+ this.id).css('background', 'none');
        $("#submit_texture_id_"+ this.id + " , #submit_pict_id_" + this.id).val('');
        
    });

    //bug fix for fancybox images
    $(".base_banner_bt_remove").click(function(e){
        $("#slot_page_0").css("background", "url(/media/images/icons/icons_banner.png)");
        $("#slot_page_0").css("background-repeat", "no-repeat").css("position", "absolute");
        $("#id_slot_0").text("");
        $("#slot_pict_id_0").attr("src", "");
        $("#slot_banner_id_0").empty();
        $(".canvas_stage0").empty();
        $(".bt_banner_slot").show();
        $(".slot_page_0_top , .slot_page_0_bottom").hide();
    });

    //Gets the banner's name b_266 for instance and tranforms it to a simple id as 266
    $(".base_bt_edit").click(function(e){
        var id = this.id.split("_");
        if(id[0] == "b"){
            window.location = "/admin/banners/spark/editar/" + id[1];
        }else{
            window.location = "/admin/htmlbanners/editar/" + id[1];
        }
    });

    //Gets the banner's name b_266 for instance and tranforms it to a simple id as 266
    $(".base_banner_bt_edit").click(function(e){
        var id = this.id.split("_");
        window.location = "/admin/banners/spark/editar/" + id[1];
    });        

    //Selects a specific gallery type
    $(".base_bt_select").click(function(){
        var id_cool = this.id.split("_"); 
        switch(id_cool[0]){
            case "f":                
                 $("#fancybox_images_launcher").trigger('click');
                 break;

             case "b":                         
                 $("#fancybox_banner_launcher").trigger('click');
                 break;

             case "h":                
                 $("#fancybox_htmlbanners_launcher").trigger('click');
                 break;
        }
    });
    
    //Shows the fancybox images
    $(".bt_fotos_slot").click(function(){
        $("#fancybox_images_launcher").trigger('click');
    });
    
    //Shows the fancybox banners
    $(".bt_banner_slot").click(function(){
        slotFoto = this.id;
        $("#fancybox_images_launcher").trigger('click');
        $("#helper_id_slot").val(slotFoto);
    });
    
    //Shows the fancybox images
    $(".base_banner_bt_select").click(function(){ 
        slotFoto = this.id;
        $("#fancybox_gallery_launcher").trigger('click');
        $("#helper_id_slot").val(slotFoto);

    });

    //This stament shows or not the edits slots buttons
    $("div.container_slot").mouseenter(function(){
        if($("#id_slot_" + this.id).text() != ""){
           $("#base_" + this.id).fadeIn("faster");
        }         

    }).mouseleave(function(){           
        $("#base_" + this.id).fadeOut("faster");
    });    
    
    //This stament shows or not the edits banner buttons
    $("#slot_banner div.container_slot").mouseenter(function(){
        if($("#id_slot_0").text() != ""){
           $("#base_0").fadeIn("faster");
        }
    }).mouseleave(function() {           
        $("#base_0").fadeOut("faster");
    });
    
    //Shows the fancybox textures
    $(".bt_textures_slot").click(function(){
        $("#fancybox_textures_launcher").trigger('click');
    });
    
    //Shows the fancybox efeitos
    $(".bt_efeitos_slot").click(function(){
        $("#fancybox_efeitos_launcher").trigger('click');
    });
    
    //Shows the fancybox efeitos
    $(".bt_icones_slot").click(function(){
        $("#fancybox_icones_launcher").trigger('click');
    });
} 


/* Embeded */

/**
 * It adds an image from images into the page slot.
 *
 * PS: several content uses this statements. pages, materias...
 *
 * @param number id
 *
 */
function addImageEmbededSlots(src, id, title, type){
    
    var path = "url(/media/images/icons/icons_slot_full.png)";
    if(slotFoto == '0')  path = "url(/media/images/layout/container_banner_page_white_middle.png) repeat-y";
    if(slotFoto == '0') {$("#slot_page_0").css("height", "100%").css("position", "relative"); $(".slot_page_0_top , .slot_page_0_bottom").show();$(".bt_banner_slot").hide();}

    $("#slot_page_" + slotFoto).css("background", path);
    if(slotFoto != '0')$("#slot_page_" + slotFoto).css("background-repeat", "no-repeat");
    $("#id_slot_" + slotFoto).text(type + "_" + id);
    $("#zoom_slot_"+ slotFoto).css("display", "block");

    $("#slot_banner_id_" + slotFoto).append(src);
    $("#slot_banner_id_" + slotFoto).css('overflow', 'hidden').css('width', '120px').css('height', '120px');
}