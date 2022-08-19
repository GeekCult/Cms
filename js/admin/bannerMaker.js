/*
    Document   : topos/rodapes admin
    Created on : 31/12/2010, 16:31:00
    Author     : CarlosGarcia
    Description:
    Purpose of the javascript follows.
*/

var isPaleta = false;
var isBackground = true;
var isRule = false;
var nr_id = 0;
var div_open = "<div id='d_" + nr_id + "' class='s_cool'>";
var div_close = "</div>";
var cool_stuff = new Array();
var countNr =0;
var nr_items_added = 0;
var sizeBanner = 0;
var id_background_helper;
var isEditBoard = false;
var isCreateBoard = true;
var altura_banner_fancy;
var largura_banner_fancy;
var menu_onscreen = false;
var isFontSizeOn;
var isFontTypeOn;
var posIndex = 3;
var browserType;
var tipo_html_coolbanner;
var objItem = new Object();
var id_itemCool_added = 0;
var isPreventDefault = false;
var currentCool;


$(document).ready(function(){

    if($("#helper_id_html_action").val() == "exibir") initExibirList();
    if($("#helper_id_html_action").val() == "novo"){addBackgroundLoader();}
    if($("#helper_id_html_action").val() != undefined && $("#helper_id_html_action").val() != 'listar')setAttributeInput("t");
    
    if(($("#helper_id_html_action").val() != "novo" || $("#helper_id_html_action").val() != "editar" || $("#helper_id_html_action").val() != "template") && $("#helper_id_html_action").val() != undefined){isCreateBoard = false;initListenerProperties();}

    $('.canvas_stage').click(function(e){

        
        full_currentCool = e.target.id;
     
        //var childNodeArray = document.getElementById('stage').children;
        var currentItem = ($("#"+full_currentCool).parent().attr("id")).split("_");
        currentCool = currentItem[1];

        //This stament applies the text into cool_stuff
        $('#' + full_currentCool).blur(function() {setTextField();});

        pos_left_right = objItem[currentCool]['left'];
        pos_up_down = objItem[currentCool]['top'];
        
        setAttributeInput(objItem[currentCool]['type']);
        setProperties();
        //alert(full_currentCool + " " + currentCool);
        addDragableAttribute(currentCool);
    }); 
    
    
});

/**
 * It updates the create_stage with templates or existing
 * records from database, it might be HTML components, menu...
 * It uses a json supply
 *
 * item[0] - tipo = imagem,i - textfield,t
 * item[1] - content = file,flower.png - texto,PurplePier
 * item[2] - position = x,
 * item[3] - position = y,
 * item[4] - width,
 * item[5] - height,
 * item[6] - cor, 
 * item[7] - size, - font
 * item[8] - style, - font type
 *
 * @param number id
 *
 */
function addBannerHTML(result, id){
    
    browserType = getInternetExplorerVersion();
    if($("#helper_id_html_action").val() != "novo" || $("#helper_id_html_action").val() != "editar" || $("#helper_id_html_action").val() != "template"){isCreateBoard = false;}
    
    //Verify if is editing in an edit board.
    if(id == "") isEditBoard = true;

    id_background_helper = id;
    var size_thumbs = null;    
    
    var jsonObject = eval('(' + result + ')');  
    
    //Separa os itens acima em atributos individuais
    for(i=0; i < jsonObject.length; i++){        
        
        switch(jsonObject[i]['tipo']){          

            case "i"://user image
                
                size_thumbs = getSizeThumb(jsonObject[i]['s_thumb'], false); 
                //Adds a simple picture
                if((jsonObject[i]['link'] != "") && !isCreateBoard){                   
                    //If minisites
                    if($('#helper_mini_site').attr('data-url') != undefined && $('#helper_mini_site').attr('data-url') != '') {
                        
                        var path = $('#helper_mini_site').attr('data-url');
                        s_coolPicture = "<div id='d_" + nr_id +"' class='s_cool'><a rel='1' class='bt_link_banner_advertise' name='" + jsonObject[i]['link'] + "'><img id='itt_" + nr_id + "_" + jsonObject[i]['id'] + "' src='" + path +"/images/" + jsonObject[i]['src'] + "' /></a>" + div_close;
                        
                    }else{ 
                        s_coolPicture = "<div id='d_" + nr_id +"' class='s_cool'><a rel='1' class='bt_link_banner_advertise' name='" + jsonObject[i]['link'] + "'><img id='itt_" + nr_id + "_" + jsonObject[i]['id'] + "' src='/media/user/images/"+ size_thumbs + "/" + jsonObject[i]['src'] + "' /></a>" + div_close;
                    }
                }else{
                    //If minisites
                    if($('#helper_mini_site').attr('data-url') != undefined && $('#helper_mini_site').attr('data-url') != '') {
                        var path = $('#helper_mini_site').attr('data-url');
                        s_coolPicture = "<div id='d_" + nr_id +"' class='s_cool'><img id='itt_" + nr_id + "_" + jsonObject[i]['id'] + "' src='"+ path +"/images/" + jsonObject[i]['src'] + "' onmousedown='addDragableAttribute("+ nr_id + ")' class='dragIT'/>" + div_close;    
                    }else{
                        s_coolPicture = "<div id='d_" + nr_id +"' class='s_cool'><img id='itt_" + nr_id + "_" + jsonObject[i]['id'] + "' src='/media/user/images/"+ size_thumbs + "/" + jsonObject[i]['src'] + "' onmousedown='addDragableAttribute("+ nr_id + ")' class='dragIT'/>" + div_close;    
                    }
                    
                }
                break;
            case "c"://cool image
                size_thumbs = getSizeThumb(false, jsonObject[i]['s_thumb']);
                //Adds a cool picture
                if((jsonObject[i]['link'] != "") && !isCreateBoard){                    
                s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'><a class='bt_link_banner_advertise' name='" + jsonObject[i]['link'] + "'><img id='itt_" + + jsonObject[i]['id'] + "_" + nr_id + "' src='/media/images/cool/"+ size_thumbs + "/" + jsonObject[i]['src'] + "' /></a>" + div_close;
                }else{
                s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'><img id='itt_" + nr_id + "_" +  jsonObject[i]['id'] +"' src='/media/images/cool/"+ size_thumbs + "/" + jsonObject[i]['src'] + "' onmousedown='addDragableAttribute("+ nr_id + ")' class='dragIT'/>" + div_close;    
                }
                break;
                
            case "bn"://banner images
                //Adds a cool picture
                if((jsonObject[i]['link'] != "") && !isCreateBoard){                    
                s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'><a class='bt_link_banner_advertise' name='" + attr[i][10] + "'><img id='itt_" + jsonObject[i]['id'] + "_" + nr_id + "' src='/media/user/images/banners/" + jsonObject[i]['src'] + "' /></a>" + div_close;
                }else{
                s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'><img id='itt_" + jsonObject[i]['id'] + "_" + nr_id + "' src='/media/user/images/banners/" + jsonObject[i]['src'] + "' onmousedown='addDragableAttribute("+ jsonObject[i]['id'] + ")' class='dragIT'/>" + div_close;    
                }
                break;
                
            case "t"://text
                //Adds a textfield
                if(id != ""){                        
                    if(jsonObject[i]['link'] != ""){
                        s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'><a class='bt_link_banner_advertise' name='" + jsonObject[i]['link'] + "' id='ltt_" + nr_id + "_" + jsonObject[i]['id']  + "'><input class='text_cool_link' value='" + jsonObject[i]['texto'] + "' readonly id='itt_" +  nr_id + "_" + jsonObject[i]['id']  + "'/></a>" + div_close;
                    }else{
                        s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'><input id='itt_" +  nr_id + "_" + jsonObject[i]['id']  + "' class='text_cool' value='" + jsonObject[i]['texto'] + "' readonly/>" + div_close;
                    }
                }else{
                    s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'><input id='itt_" + nr_id +"_"+ jsonObject[i]['id'] + "' type='text' class='text_cool' value='" + jsonObject[i]['texto'] + "'/>" + div_close;   
                }

                break;

            case "p"://textarea
                //Adds a textarea
                if(id != ""){
                s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'><textarea id='itt_" + nr_id + "_" + jsonObject[i]['id'] + "' class='text_textarea_cool' readonly>" + jsonObject[i]['texto']  + "</textarea>" + div_close;
                }else{
                s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'><textarea id='itt_" + nr_id + "_" + jsonObject[i]['id'] + "' rows='3' class='text_textarea_cool'>" + jsonObject[i]['texto']  + "</textarea>" + div_close;
                }
                break;
                
            case "ss"://slideshow
            case "m"://template
            case "bt"://buttons
            case "l"://lines
            case "d"://dividers
            case "bx"://boxes e ballons
                if((jsonObject[i]['link'] != "") && !isCreateBoard){
                    s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'>" + div_close;
                }else{
                    s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool dragIT'>" + div_close;
                }
                
                getTemplate(jsonObject[i]['id'], jsonObject[i]['src'], jsonObject[i]['tipo'], nr_id, jsonObject[i]['width'], jsonObject[i]['height'], jsonObject[i]['variante'], jsonObject[i]['texto'], jsonObject[i]['link']);
                break;
                
            case "s"://shape template
                s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'>" + div_close;
                getTemplate(jsonObject[i]['id'], jsonObject[i]['src'], jsonObject[i]['tipo'], nr_id, jsonObject[i]['width'], jsonObject[i]['height'], jsonObject[i]['variante'], jsonObject[i]['texto'], jsonObject[i]['link']);
                break;

            case "mn2"://menu
            case "mn3"://menu
            case "mn1"://menu principal
            case "mn"://menu categorias
                s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'>" + div_close;
                //No record, avoid increment unncessary nr_id
                addMenuStuff(nr_id, jsonObject[i]['src'], jsonObject[i]['variante']);
                break;

            case "b"://background
                s_coolPicture = "<div id='d_" + nr_id + "' class='s_background'></div>";   
                break;

            case "o"://overlay background 
                s_coolPicture = "<div id='d_" + nr_id + "' class='s_overlay'>" + div_close;                
                break;

        }

        //It avoid some bugs with removed object.
        if(jsonObject[i]['src'] != "" && jsonObject[i]['src'] != undefined || (jsonObject[i]['tipo'] == "b" || jsonObject[i]['tipo'] == "o")){
            //console.info("NR: "+ nr_id + " "+ jsonObject[i]['tipo']);
            //Creates the element on stage
            //Due a bug in listar view an id each class is needed
            $(".canvas_stage" + id).append(s_coolPicture);

            //Initiates the array cool properties
            initiateCoolProperties(jsonObject[i]['id'], jsonObject[i]['tipo'], jsonObject[i]['src'], jsonObject[i]['p_x'], jsonObject[i]['p_y'], jsonObject[i]['width'], jsonObject[i]['height'], jsonObject[i]['color'], jsonObject[i]['f_type'], jsonObject[i]['s_text'], jsonObject[i]['s_thumb'], jsonObject[i]['link'], jsonObject[i]['variante'], jsonObject[i]['texto'], jsonObject[i]['z_index']);
            //Transforms the string to number
            var id_nr = (nr_id);
            var id_item   = (jsonObject[i]['id']);
            var type    = (jsonObject[i]['tipo']);
            var picture = (jsonObject[i]['src']);
            var left    = (jsonObject[i]['p_x'] * 1);
            var top     = (jsonObject[i]['p_y'] * 1);
            var width   = (jsonObject[i]['width'] * 1);
            var height  = (jsonObject[i]['height'] * 1); 
            var color   = (jsonObject[i]['color']);
            var font    = (jsonObject[i]['f_type']);
            var size_t  = (jsonObject[i]['s_text']);            
            var size_thumb = (jsonObject[i]['s_thumb']);
            var link = (jsonObject[i]['link']);
            var variante = (jsonObject[i]['variante']);
            var texto = (jsonObject[i]['texto']);

            setElementProperty(id_nr, id_item, type, picture, left, top, width, height, color, font, size_t, size_thumb, link, variante, texto);

            nr_id++;                 
        }
    }      
}

/**
 * It sets the main properties for the divs
 * each one of the elements inside the banner, header or
 * footer is handle with it.
 *
 * @param number
 * @param string
 *
 */
function setElementProperty(id_nr, id_item, type, picture, left, top, width, height, color, font, size_t, size_thumb, link, variante, texto){

    if($('#helper_resize').val() != undefined){
        width = Math.round(width / ($('#helper_resize').val() * 1));
        height = Math.round(height / ($('#helper_resize').val() * 1));
        top = Math.round(top / ($('#helper_resize').val() * 1));
        left = Math.round(left / ($('#helper_resize').val() * 1));
        var size_ft = size_t.split("em");
        size_t = size_ft[0] / ($('#helper_font').val() * 1) + "em";
    }
    
    //Switch of Doooooooooooooooommmmmmmm
    switch(type){

        case "t":
        case "p":
            if(!isEditBoard){
                $("#d_" + id_nr).css("left", left + "px");
                $("#d_" + id_nr).css("top", top + "px");
                $("#itt_" + id_nr + "_" + id_item).css("width", width + "px");
                
                if(height != "" && height != "20"){
                $("#itt_" + id_nr + "_" + id_item).css("height", height + "px");
                }else{
                $("#itt_" + id_nr + "_" + id_item).css("height", "auto");   
                }
                $("#itt_" + id_nr + "_" + id_item).css("color", color);
                $("#itt_" + id_nr + "_" + id_item).css("font-size", size_t);
                
                if(link != ""){                
                $("#ltt_" + id_nr + "_" + id_item).css("color", color);
                }
                
                if(browserType == -1 || browserType > 8){
                    $("#itt_" + id_nr + "_" + id_item).css("font-family", font);                    
                }
            }else{                

                $("#d_" + id_nr).css("left", left + "px");
                $("#d_" + id_nr).css("top", top + "px");
                $("#d_" + id_nr).css("width", width + "px");
                $("#d_" + id_nr).css("height", height + "px");  

                $("#itt_" + id_nr + "_" + id_item).css("width", width + "px");
                $("#itt_" + id_nr + "_" + id_item).css("color", color); 
                $("#itt_" + id_nr + "_" + id_item).css("font-size", size_t);
                

                if(browserType == -1 || browserType > 8){                  
                    $("#itt_" + id_nr + "_" + id_item).css("font-family", font);                    
                }
            }

            if($('#helper_font').val() != undefined){$("#" + id_nr + "_" + id_item).css("font-size", $('#helper_font').val());}
            
            break;
            
        case "b":
            if(picture != "" && picture != "Background") $("#d_" + id_nr).css("background", "url(/media/images/textures/site/"+ picture + ")");
            break;
        case "o":
            if(picture != "" && picture != "Overlay") $("#d_" + id_nr).css("background", "url(/media/images/textures/efeitos/"+ picture + ")");
            break;
            
        case "i":
        case "c":
            
            $("#d_" + id_nr).css("left", left + "px");
            $("#d_" + id_nr).css("top", top + "px");

            $("#itt_" + id_nr + "_" + id_item).css("width", width+"px");
            $("#itt_" + id_nr + "_" + id_item).css("height", height+"px");
            break;
            
        case "bt":
        case "s":
        case "m":
            
            $("#d_" + id_nr).css("left", left + "px");
            $("#d_" + id_nr).css("top", top + "px");
            
            //Somente se for thumbnails
            if($('#helper_resize').val() != undefined){
                $("#d_" + id_nr + " *").css("display", "hidden");
                setTimeout("setSizeComponent("+id_nr+", '"+ type +"', " + height + ", " + width + ", '" + size_t + "')", 500);
            }
            break;
            
        default:
            $("#d_" + id_nr).css("left", left + "px");
            $("#d_" + id_nr).css("top", top + "px");
            $("#d_" + id_nr).css("width", width + "px");
            $("#d_" + id_nr).css("height", height + "px");
            
            $("#itt_" + id_nr + "_" + id_item + " *").css("width", width+"px");
            $("#itt_" + id_nr + "_" + id_item + " *").css("height", height+"px");
            break;
    }

}

function setSizeComponent(id, type, height, width, size_t){
    
    switch(type){
        case "s":
            $("#d_"+id +" *").css("width", width+"px").css("height", height+"px");
            break;
        case "bt":
            $("#d_"+id +" *").css("width", width+"px").css("height", height+"px");
            $("#d_"+id +" *").css("background-size", width+"px, " + height+ "px");
            $("#d_"+id +" *").css("font-size", "0.3em");
            break;
    }
    
    $("#d_"+id+" *").css("display", "block");
}

/**
 * It adds an image from gallery
 * into stage.
 *
 * @param number id
 *
 */
function addImageStuff(image_name, size_thumb, title, type){
    
    var s_coolPicture = "";
    
    if(type == "f" || type == "" || type == "image" || type == undefined){
        var size_thumb_image = getSizeThumb(size_thumb, false);
        //Minisite specifications
        if($('#helper_mini_site').attr('data-url') != undefined && $('#helper_mini_site').attr('data-url') != ''){
            var path = $('#helper_mini_site').attr('data-url'); 
            var img_size = getImgSize(path + "/images/" +image_name, nr_id, image_name, size_thumb, "fotos");
            s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool' ><img id='itt_" + nr_id + "' src='"+ path + "/images/" + image_name + "' onmouseover='addDragableAttribute("+nr_id+ ")' class='dragIT'/>"  + div_close;
        
        }else{      
            var img_size = getImgSize("/media/user/images/" + size_thumb_image + "/" +image_name, nr_id, image_name, size_thumb, "fotos");
            s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool' ><img id='itt_" + nr_id + "' src='/media/user/images/" + size_thumb_image + "/" + image_name + "' onmouseover='addDragableAttribute("+nr_id+ ")' class='dragIT'/>"  + div_close;
        }
        
    }else{
        s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool' ><img id='itt_" + nr_id + "' src='/media/user/images/purplecanvas/" + image_name + "' onmouseover='addDragableAttribute("+nr_id+ ")' class='dragIT'/>"  + div_close;
    }
    
    $(".canvas_stage").append(s_coolPicture);
}

/**
 * It adds an cool image from PurplePier database
 * into stage. It works with sizes P,M,G,J
 *
 * @param number id
 *
 */
function addCoolImageStuff(image_name, size_thumb){ 
    
    var size_thumb_image = getSizeThumb(false, size_thumb); 
    var img_size = getImgSize("http://www.purplepier.com.br/media/images/cool/" + size_thumb_image + "/" +image_name, nr_id, image_name, size_thumb, "cool");

    var s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'><img id='itt_" + nr_id + "_" + nr_items_added+ "' src='http://www.purplepier.com.br/media/images/cool/" + size_thumb_image + "/" + image_name + "' onmouseover='addDragableAttribute("+nr_id+ ")' class='dragIT'/>"  + div_close;

    $(".canvas_stage").append(s_coolPicture);
}

/**
 * It adds an image from gallery
 * into stage as a background.
 *
 * @param number id
 *
 */
function addBackground(id, image_name, type, isChange){ 
    
    if(isChange){
        if(type == '0'){
            initiateCoolProperties(id, "b", image_name, 0, 0, "", "", "", "", "", "", "", "", "", 0);
            $("#d_" + id).css("background", "url(/media/images/textures/site/"+ image_name + ")"); 
            nr_items_added--;
        }else{
            initiateCoolProperties(id, "o", image_name, 0, 0, "", "", "", "", "", "", "", "", "", 1);
            $("#d_" + id).css("background", "url(/media/images/textures/efeitos/"+ image_name + ")"); 
            nr_items_added--;
        }
    }
}

/**
 * It adds a text field it can be edited
 * and adds any kind of text there
 *
 *
 */
function addTextStuff(){

    initiateCoolProperties(nr_id, "t", "Adicione seu texto aqui!", 0, 0, "200", "20", "#000000", "Verdana", "1em", "", "", "", "Adicione seu texto aqui!", 5);

    var s_coolText = "<div id='d_" + nr_id + "' class='s_cool'><input id='itt_" + nr_id + "_0' type='text' value='Adicione seu texto aqui!' class='text_cool' onmouseover='addDragableAttribute("+nr_id+ ")' class='dragIT'/>" + div_close;
    $(".canvas_stage").append(s_coolText);
    nr_id++;
}

/**
 * It adds a paagraph field it can be edited
 * and adds any kind of text there
 *
 *
 */
function addTextParagraphStuff(){
    //8 itens
    initiateCoolProperties(nr_id, "p", "Adicione seu texto aqui!", 0, 0, "200", "60", "#000000", "Verdana", "1em", "", "", "", "Adicione seu texto aqui!", 5);

    var s_coolText = "<div id='d_" + nr_id + "' class='s_cool'><textarea id='" + nr_id + "' rows='3' class='text_textarea_cool' onmouseover='addDragableAttribute("+nr_id+ ")' class='dragIT'>Adicione seu texto aqui!</textarea>" + div_close;
    $(".canvas_stage").append(s_coolText);
    nr_id++;
}

/**
 * It adds an template from the counteudo_template
 * the word m means it a model
 *
 * @param number id
 *
 */
function addComponentStuff(type, model){  
    if(type == "html_menu"){
        addMenuStuff("", model, "");
    }else{
        getViewTemplate(model, nr_id, type);
    }
}

/**
 * This method retrieve the image size
 * It uses a load to verify if the image has already been loaded.
 *
 */
 function getImgSize(imgSrc, id, image_name, size_thumb, type){
    
    var newImg = new Image();
    newImg.onload = function(){
        if(type == "cool"){
            initiateCoolProperties(id, "c", image_name, 0, 0, this.width, this.height, "", "", "", size_thumb, "", "", "", 5);
        }else{
            initiateCoolProperties(id, "i", image_name, 0, 0, this.width, this.height, "", "", "", size_thumb, "", "", "", 5);
        }
        nr_id++;
    }
    newImg.src = imgSrc;       
}

/*
 * It becomes the textfield as input
 * and editable
 *
 */
function setTextField(){
    objItem[currentCool]['texto'] = $('#' + full_currentCool).val();
}

/**
 * It defines de cool_stuff properties, it starts a new array
 * which all atrributes will be saved.
 *
 * See the numbers properties below.
 *
 * @param number
 * @param string
 *
 */
function initiateCoolProperties(id_cool, type, img_name, left, top, width, height, color, font_type, size_text, size_thumb, link, variante, texto, z_index){

    //propertie_array[12] = zindex;//local no exo z
    //propertie_array[13] = id_current;//size thumb thumbs_120, original etc
    //propertie_array[14] = tipo_current;//size thumb thumbs_120, original etc
    //propertie_array[15] = value_button;//titulo tipo botoes
    //propertie_array[16] = titulo_itemcool;//size thumb thumbs_120, original etc
    
    var objStock = new Object();
    objStock['id'] = id_cool;
    objStock['type'] = type; //tipo image, text
    objStock['src']= img_name;//img_name;//cool name
    objStock['left'] = left;//left;//position left
    objStock['top'] = top;//top;//position top
    objStock['width'] = width;//width;//width
    objStock['height'] = height;//height;//height
    objStock['color'] = color;//color;//color - #000000
    objStock['font_type'] = font_type;//font_type;//font - Verdana
    objStock['size_text'] = size_text;//size_text;//size - 12pt
    objStock['size_thumb'] = size_thumb;//size_thumb;//size thumb thumbs_120, original etc
    objStock['link'] = link;//link;//size thumb thumbs_120, original etc
    objStock['variante'] = variante;//variante;//classe que sera usada apra alterar as propriedades de uma objeto
    objStock['texto']= texto;//texto
    objStock['z-index']= z_index;//z_index do elemento
    
    if(type == "b"){objItem[0] = objStock;img_name = "background";}
    if(type == "o"){objItem[1] = objStock;img_name = "overlay";}
    
    if(type != "b" && type != "o")objItem[nr_id] = objStock;
    
    nr_items_added++;
    
    var item_menu_listener = "<input class='item_menu_listener truncate' value='"+ img_name +"' type='button' name='"+id_cool+ "_"+ nr_id +"' id='itC_"+nr_id+ "'/>";
    $("#menu_properties_items").append(item_menu_listener);
}

/*
 * It get the color from the Pallete component
 * and sets the object with it.
 *
 */
function setCoolColor(color){
 
    var new_color = color.replace("0x", "#");
    $('#' + full_currentCool).css("color", new_color);
    objItem[currentCool]['color'] = new_color;

    setProperties();
}

/*
 * It handles with the key up events
 * If the key is releases an action is
 * send.
 *
 */
function removeHTMLCool(id){
    $("#d_" + id + ', #itC_' + id).fadeOut("slow");
    var childRemove = document.getElementById('stage').children;
    $("#" + childRemove[id].firstChild.id).fadeOut("slow");

    objItem[id]['color'] = "empty";
}

/*
 * It sends the values needed
 * to be saved in database
 *
 */
function saveHTMLBanner(tipo_action){
    var tipo_local = $("#helper_local").val();
    
    objItem['nr'] = nr_items_added;
    objItem['id'] = $("#helper_id_html_cool").val();
    objItem['action'] = tipo_action;
    objItem['altura'] = sizeBanner;
    objItem['cor'] = "";
    objItem['largura'] = $("#helper_largura").val();
    objItem['tipo'] = tipo_local;
    objItem['modelo'] = "empty html";    
    
    //Lets convert our JSON object
    var postData = JSON.stringify(objItem);
    // Lets put our stringified json into a variable for posting
    var postArray = {json:postData};
    
    //snapShot();

    $.ajax({
        type: 'POST',
        url: "/admin/" + tipo_local +  "/salvar",
        data: postArray,
        success: function(data){
            //Morpha json array in an object
            var jsonObject = eval('(' + data + ')');
            $("#helper_id_html_cool").val(jsonObject['id']);
            showAlertDim(jsonObject['message']);
        }
    });
}

/*
 * Now it's getting the components from the user DB:
 * 
 * BEFORE: It gets the template specific from the counteudo_template
 * table in the manager_purplepier data base
 * 
 * Modelo is a class component with some diferente colors etc
 *
 */
function getTemplate(id_item, template, tipo, id, width, height, modelo, texto, link){

    $.post("/admin/coolhtml/apply_component",{
        template: template,
        tipo: tipo,
        height: height,
        width: width,
        texto: texto,
        link: link
    },function(result){ 
        result = result.replace(/###/i, "itt_"+ id + "_" + id_item);
        $("#d_" + id).append(result);
        if(modelo != "" && modelo != "undefined")$("#d_" + id + " ." + template).attr("id", modelo);
    });
}

/*
 * It gets the template specific from the counteudo_template
 * table in the manager_purplepier data base
 *
 */
function getViewTemplate(template, id, type){
       
    var type_prefix = getCompontentPrefix(type);

    $.post("/admin/coolhtml/template",{
        template: template
    },function(result){       

        var s_coolCont = "<div id='d_" + nr_id + "' class='s_cool'>";          
        result = result.replace(/###/i, "itt_"+ nr_id + "_" + id);    

        var blockHTML = s_coolCont + result + div_close;        
        $(".canvas_stage").append(blockHTML);        
        
        initiateCoolProperties(nr_id, type_prefix, template, 0, 0, $("#d_" + nr_id).width(), $("#d_" + nr_id).height(), "", "", "", "", "", "", "", 5);
        nr_id++;
    });
}

/*
 * Defines the secondary menu
 * 
 * PS: Pay Attention in the id, remember some problems with list action
 * The ids can't be equal one each other
 *
 */
function addMenuStuff(id, component, modelo){

    var type_menu = component.split("_",1);

    $.post("/admin/coolhtml/load",{
        type_menu: type_menu[0],
        component: component

    },function(data){            

        if(id == ""){  
            data = data.replace(/###/i, "itt_"+ nr_id + "_" + id);
            $(".canvas_stage").append("<div id='d_" + nr_id + "' class='s_cool'>" + data + div_close);
            if(modelo != "" && modelo != "undefined")$("#d_" + id + " ." + component).attr("id", modelo);
            initiateCoolProperties(nr_id, type_menu[0], component, 0, 0, 0, 0, "", "", "", "", "", "", "", 5);
            nr_id++;
        }else{
            data = data.replace(/###/i, "itt_"+ nr_id + "_" + id);
            $("#d_" + id).append(data);
            if(modelo != "undefined"){$("#d_" + id + " ." + component).attr("id", modelo);}
        }
    });      
}

/*
 * It shows and hide the paleta color
 * The toggle action was not working properly
 *
 */
function showPaletaCores(){

    if(!isPaleta){
        $("#dragger").show("slow");
        isPaleta = true;

    }else{
        $("#dragger").hide("slow");
        isPaleta = false;
    }
}

/**
 * This method retrieve the images's size
 *
 */
 function setImagePlace(largura){
    var marg_left = ((largura / 2 ) * -1 );

    $(".editar_swf_img_landscape").css("width", largura + "px");
    $(".editar_swf_img_landscape").css("margin-left", marg_left + "px");

    $("#bannerMakerBackground").css("width", largura + "px");
    $("#bannerMakerBackground").css("margin-left", marg_left + "px");
}

/*
 * It handles a specific action for each one
 * of the tab selected
 *
 */
function bannersHandler(local){
    switch(local){
        case "topos":
            window.location = "/admin/topos/novo";
            break;

         case "rodapes":
            window.location = "/admin/rodapes/novo";
            break;

         case "banner":
            window.location = "/admin/html_banners/novo";
            break;
    }
}

/*
 * It initiates all needed listeners
 * It might be called anytime.
 *
 */
function initListeners(){

    initFontsHandler();
    
    
    tipo_html_coolbanner = $("#helper_local").val();

    //Adds the picker component and sets it to ready! Just it's on editboard mode
    if($("#helper_id_html_action").val() != undefined && $("#helper_id_html_action").val() != 'listar') $('#picker').farbtastic('#color');

    $("#buttons_banner_support :button").click(function(){
        switch(this.id){
            //Save id 5
            case "bt_cool_5":
                var action_current = $("#helper_id_html_action").val();
                saveHTMLBanner(action_current);
                break;
            case "bt_cool_6":
                saveHTMLBanner("novo");
                break;
            case "bt_cool_7":
                saveHTMLBanner("modelo");
                break;
        }
    });
    
    //Menu items list - each element can be accessed from this list
    $("#menu_properties_items :button").click(function(){
        var id_item = this.name.split("_");
        currentCool = id_item[1];
        setProperties();        
    });

    $('#bt_edit_trash').click(function(){
       removeHTMLCool(currentCool);
    });

    $('#bt_edit_text').click(function(){
       addTextStuff();
    });

    $('#bt_edit_paragraph').click(function(){
       addTextParagraphStuff();
    });

    $('#bt_close_picker').click(function(){
       showPaletaCores();
    });
    
    //It is responsable for separates the events for each one of
    //the button pressed.
    //In banner.js it calls some Flash actions
    $(".buttons_banner_edit :button").click(function(){

        switch(this.id){
            case "bt_edit_move_up":
                    pos_up_down++;
                    $("#d_" + currentCool).css("top", pos_up_down + "px");
                    objItem[currentCool]['top'] = $('#d_' + currentCool).offset().top - $('.canvas_stage').offset().top;
                    break;

             case "bt_edit_move_right":
                    pos_left_right++;
                    $("#d_" + currentCool).css("left", pos_left_right + "px");                        
                    objItem[currentCool]['left'] = $('#d_' + currentCool).offset().left - $('.canvas_stage').offset().left;
                    break;
                    
            case "bt_edit_move_down":
                    pos_up_down--;
                    $("#d_" + currentCool).css("top", pos_up_down + "px");
                    objItem[currentCool]['top'] = $('#d_' + currentCool).offset().top - $('.canvas_stage').offset().top;
                    break;

             case "bt_edit_move_left":
                    pos_left_right--;
                    $("#d_" + currentCool).css("left", pos_left_right + "px");                        
                    objItem[currentCool]['left'] = $('#d_' + currentCool).offset().left - $('.canvas_stage').offset().left;
                    break;

            case "bt_edit_rotate_right":
                    //$("#" + currentCool).attr("width", "330");
                    //$("#d_" + currentCool).css("padding-left", "100px");
                    //$("#" + currentCool).attr("height", "100");
                    break;

            case "bt_edit_rotate_left":
                    //$("empty").hide();
                    break;

            case "bt_edit_depth_up":
                    posIndex = objItem[currentCool]['z-index'];
                    posIndex++;
                    $("#d_" + currentCool).css("z-index", posIndex);
                    objItem[currentCool]['z-index'] = posIndex;
                    $("#zindex_currentCool").val(posIndex);
                    break;
                    
            case "bt_edit_depth_down":
                    posIndex = objItem[currentCool]['z-index'];
                    posIndex--;
                    if(posIndex < 3) posIndex = 3;
                    $("#d_" + currentCool).css("z-index", posIndex);
                    objItem[currentCool]['z-index'] = posIndex;
                    $("#zindex_currentCool").val(posIndex);
                    break;

            case "bt_edit_width_up":
                    if(objItem[currentCool]['type'] == "t" || objItem[currentCool]['type'] == "p" || objItem[currentCool]['type'] == "d"){   
                       width_current = $("#" + full_currentCool).width() + 4;
                       $("#" + full_currentCool).css("width", width_current + "px");
                    }else{
                        width_current = $("#" + currentCool).width() + 4;
                       $("#" + currentCool).css("width", width_current + "px"); 
                    }                    
                    objItem[currentCool]['width'] = width_current;
                    break;
            
            case "bt_edit_width_down":
                    width_current = $("#" + currentCool).width() - 4;
                    $("#" + currentCool).css("width", width_current + "px");
                    objItem[currentCool]['width'] = width_current;
                    break;
            
            case "bt_edit_height_up":
                    height_current = $("#" + currentCool).height() + 4;
                    $("#" + currentCool).css("height", height_current + "px");
                    objItem[currentCool]['height'] = height_current;

                break;

            case "bt_edit_height_down":
                    height_current = $("#" + currentCool).height() - 4;
                    $("#" + currentCool).css("height", height_current + "px");
                    objItem[currentCool]['height'] = height_current;
                    break;
        }

    });

    $('#link_list_htmlcool').click(function() {
        window.location = "/admin/" + tipo_html_coolbanner + "/listar";
    });
     
    $("#bt_edit_color").click(function(){
        showPaletaCores();
    });
    
    //Menu de propriedades f'utuante
    $('#bt_menu_properties, #bt_menu_close').click(function(){
        if(!menu_onscreen){
            $(".container_menu_properties").fadeIn("fast");
            menu_onscreen = true;
        }else{
            $(".container_menu_properties").fadeOut("fast");
            menu_onscreen = false;
        }

    });
    
    $("#bt_locker_stage").click(function(){
        isPreventDefault ? isPreventDefault = false : isPreventDefault = true
    });
    
    //PAy Attention on the structure, all the component must be that way.
    $(".colors_support :button").click(function(){
        alert(objItem[currentCool]['src']);
        $("."+objItem[currentCool]['src']).attr("id", objItem[currentCool]['src'] + "-" + this.id);
        objItem[currentCool]['variante'] = objItem[currentCool]['src'] + "-" + this.id;
    });
    
    //Add or removes the background bannerMaker, works with #bt_rule
    $('#bt_no_background').click(function(){
        if(isBackground){
            $("#bannerMakerBackground").css("background", "none");
            $("#bannerMakerBackground").css("border", "none");
            isBackground = false;
        }else{
            $("#bannerMakerBackground").css("background", "url('/media/images/textures/site/bg_transp_10.png')");
            $("#bannerMakerBackground").css("border", "2px solid #ccc");
            isBackground = true;
        }
    });
    
    //Adds or removes rules
    $('#bt_rule').click(function(){

        if(isRule){
            $("#bannerMakerBackground").css("background", "url('/media/images/textures/site/bg_transp_10.png')");
            $("#bannerMakerBackground").css("border", "2px solid #ccc");
            isRule = false;
        }else{
            $("#bannerMakerBackground").css("background", "url('/media/images/textures/site/bg_transp_10_rule.png')");
            $("#bannerMakerBackground").css("border", "2px solid #ccc");
            isRule = true;
        }
    });

    $('#bt_increase_size_banner').click(function(){
        $("#bannerMakerBackground").css("height", sizeBanner + "px");
        $(".canvas_stage").css("height", sizeBanner + "px");
        sizeBanner = sizeBanner + 4;
        $(".footerPanAdmin").css("position", "relative");
    });

    $('#bt_decrease_size_banner').click(function() {
        $("#bannerMakerBackground").css("height", sizeBanner + "px");
        $(".canvas_stage").css("height", sizeBanner + "px");
         sizeBanner = sizeBanner - 4;
    });

    $('.tab_banners').click(function(){
        bannersHandler(this.id);
    });

    //Fotos
    //This method works together a anchorAnimateBanner
    //It shows the gallery in the middle screen.
    $('#bt_cool_0').fancybox({
        'transitionIn':'elastic','transitionOut':'elastic','speedIn': 300,'speedOut': 200,'autoDimensions':false,'width':720,'height':450,'overlayShow': false,
        'href'        : '/admin/images/banner/0/9'
    });

    //Links
    //This method works together a anchorAnimateBanner
    //It shows the gallery in the middle screen.
    $('#bt_cool_1').fancybox({
        'transitionIn':'elastic','transitionOut':'elastic','speedIn': 300,'speedOut': 200,'autoDimensions':false,'width':720,'height':450,'overlayShow': false,
        'href'        : "/admin/cool/exibir/0/4"
    });

    //Cool HTML
    //It shows the HTML cool stuff
    $('#bt_cool_3').fancybox({
        'transitionIn':'elastic','transitionOut':'elastic','speedIn': 300,'speedOut': 200,'autoDimensions':false,'width':720,'height':450,'overlayShow': false,
        'href'        : "/admin/coolhtml/exibir/components"
    });

    //Modelos
    //This method works together a anchorAnimateBanner
    //It shows the gallery in the middle screen.
    $('#bt_cool_2').fancybox({
        'transitionIn':'elastic','transitionOut':'elastic','speedIn': 300,'speedOut': 200,'autoDimensions':false,'width':720,'height':450,'overlayShow': false,
        'href'        : "/admin/coolhtml/mostrar/" + $("#helper_local").val()
    });

    //Texturas
    //This method works together a anchorAnimateBanner
    //It shows the gallery in the middle screen.
    $('#bt_cool_4').fancybox({
        'transitionIn':'elastic','transitionOut':'elastic','speedIn': 300,'speedOut': 200,'autoDimensions':false,'width':720,'height':450,'overlayShow': false,
        'href'        : "/admin/texturas/site/exibir"
    });  
    

    initWidthBannerListener(); 
}



/*
 * It handles with the key pressed, it's using
 * a helper class js/lib/keyboardlistener
 * If it's pressed for a long time a increment 3 is used to
 * accelerate the moviment
 *
 */
function keyPressed(direction){

    switch(direction){
        case "down":
            pos_up_down++;
            $("#d_" + currentCool).css("top", pos_up_down + "px");
            objItem[currentCool]['top'] = $('#d_' + currentCool).offset().top - $('.canvas_stage').offset().top;
            if(countNr > 10){pos_up_down = pos_up_down + 3}
            if(countNr > 20){pos_up_down = pos_up_down + 3}
            break;

        case "up":
            pos_up_down--;
            $("#d_" + currentCool).css("top", pos_up_down + "px");
            objItem[currentCool]['top'] = $('#d_' + currentCool).offset().top - $('.canvas_stage').offset().top;
            if(countNr > 10){pos_up_down = pos_up_down - 3}
            if(countNr > 20){pos_up_down = pos_up_down - 3}
            break;

         case "left":
            pos_left_right--;
            $("#d_" + currentCool).css("left", pos_left_right + "px");
            objItem[currentCool]['left'] = $('#d_' + currentCool).offset().left - $('.canvas_stage').offset().left;
            if(countNr > 10){pos_left_right = pos_left_right - 3}
            if(countNr > 20){pos_left_right = pos_left_right - 3}
            break;

         case "right":
            pos_left_right++;
            $("#d_" + currentCool).css("left", pos_left_right + "px");
            objItem[currentCool]['left'] = $('#d_' + currentCool).offset().left - $('.canvas_stage').offset().left;
            if(countNr > 10){pos_left_right = pos_left_right + 3}
            if(countNr > 20){pos_left_right = pos_left_right + 3}

            break;
    }
    countNr++;
    setProperties();
}

/*
 * It handles with the key up events
 * If the key is releases an action is
 * send.
 *
 */
function keyUp(){
    countNr = 0;        
}

/*
 * It sends the values from the radio button
 * It defines a new header to the layout selected
 *
 */
function defineTopo(){
    if($("#helper_local").val() == "banners"){
        var selected = $("input[name='opcao']:checked").val();  
    }else{
        var selected = $("input[name='opcao']:checked").val();
        //Put a preloader on stage
        showAlertDimPreloader(true, 'Salvando...');
        
        $.post("alterar",{
            selected: selected
        },function(data){
            showAlertDim(data);
        });
    }

    
}

/*
 * Sets the banner's height.
 * Just Height, nothing more, if needed a width different
 * use the 7 differents banner's size, like: Min, Block, Spark,
 * Corona, Banner
 *
 */
function setSizeBanner(alt, larg, id){

    sizeBanner = (alt * 1);

    $(".canvas_stage" + id).css("height", alt + "px");
    $("#bannerMakerBackground").css("height", alt + "px");  

    $(".canvas_stage" + id).css("width", larg + "px");
    $("#bannerMakerBackground").css("width", larg + "px");
    $(".footerPanAdmin").css("position", "relative");
}

/*
 * Defines the background special div.
 * and overlay special div, both are uniques and are det 
 * just one time!
 * 
 * PS: Pay Attention in the id, remember some problems with list action
 * The ids can't be equal each other
 *
 */
function addBackgroundLoader(){  

    initiateCoolProperties(0, "b", "Background", 0, 0, 0, "", "", "", "", "", "", "", "", "0");
    initiateCoolProperties(1, "o", "Overlay", 0, 0, 0, "", "", "", "", "", "", "", "", "1");

    var  s_coolBackground = "<div id='d_0' class='s_background'></div><div id='d_1' class='s_overlay'></div>";
    $(".canvas_stage").append(s_coolBackground);
    
    nr_id = 2;
}

/*
 * Sets the banner's height, into FancyBox uses.
 * Just Height, nothing more, if needed a width different
 * use the 7 differents banner's size, like: Min, Block, Spark,
 * Corona, Banner
 *
 */
function setSizeBannerFancyBox(alt, larg, id){
    //alert("hoje");
    sizeBanner = (alt * 1);
    $(".canvas_stage" + id).css("height", alt + "px");        
    $(".canvas_stage" + id).css("width", larg + "px");
}

/*
 * Init the listener for the size links at left on page.
 *
 */
function initWidthBannerListener(){

    $(".bt_link_size").click(function(){
        
        var sizeWidthBanner = this.id;
        
        switch(sizeWidthBanner){
            case "200":
                $("#helper_local").val("html_mini"); 
                tipo_html_coolbanner = "html_mini";
                break;

            case "250":
                $("#helper_local").val("html_blocks");
                tipo_html_coolbanner = "html_blocks";
                break;

            case "300":
            case "350":
                $("#helper_local").val("html_spark");
                tipo_html_coolbanner = "html_spark";
                break;

            case "450":
                $("#helper_local").val("html_corona");
                tipo_html_coolbanner = "html_corona";
                break;
                
            case "700":
            case "720":
                $("#helper_local").val("html_lonsdale");
                tipo_html_coolbanner = "html_lonsdale";
                break;

            case "980":
                $("#helper_local").val("html_banners"); 
                tipo_html_coolbanner = "html_banners";
                break;
            //Main banner  
            case "1000":
                $("#helper_local").val("html_mainbanners");
                tipo_html_coolbanner = "html_mainbanners";
                break;
        }
        
        if(this.id == "1000") sizeWidthBanner = 980;        

        $(".canvas_stage").css("width", sizeWidthBanner + "px");
        $("#bannerMakerBackground").css("width", sizeWidthBanner + "px");

        //$(".canvas_stage").css("margin-left", "-" + this.id/2 + "px");
        $("#bannerMakerBackground").css("margin-left", "-" +  sizeWidthBanner/2 + "px");
        $("#helper_largura").val(sizeWidthBanner);
        
        //BUG fix with change size htmlbanner
        $('#bt_cool_2').fancybox({
            'transitionIn' :'elastic','transitionOut':'elastic','speedIn': 300, 'speedOut': 200, 'autoDimensions' : false, 'width': 720,'height': 420,'overlayShow': false,
            'href'         : "/admin/coolhtml/mostrar/" + $("#helper_local").val()
        });
    });
}

/*
 * Init the listener for the exibir action.
 * It handles the banners that can be choosen.
 *
 */
function initExibirList(){
    largura_banner_fancy = $('#helper_width').val();
    altura_banner_fancy = $('#helper_height').val();        
}

function initFontsHandler(){

    $('#bt_font_size').click(function() {
        if(!isFontSizeOn){
        $('.font_size_support_over').fadeIn("slow");
        $('.font_size_support_base').fadeIn("slow");
        isFontSizeOn = true;
        }else{
        $('.font_size_support_base').fadeOut("slow");
        $('.font_size_support_over').fadeOut("slow");
        isFontSizeOn = false;
        }
    });

    $('#bt_font_color').click(function() {
        showPaletaCores();
    });

    $('#bt_font_type').click(function() {
        if(!isFontTypeOn){
        $('.font_type_support_over').fadeIn("slow");
        $('.font_type_support_base').fadeIn("slow");
        isFontTypeOn = true;
        }else{
        $('.font_type_support_base').fadeOut("slow");
        $('.font_type_support_over').fadeOut("slow");
        isFontTypeOn = false;
        }            
    });

    $('.font_type_support_base :button').click(function(){
        $("#" + full_currentCool).css("font-family", this.id);
        objItem[currentCool]['font_type'] = this.id;           
        setProperties();            
    });
    
    //Sets a new size font,  it gets a new size transforming pt to em.
    $('.font_size_support_base :button').click(function(){
        var size_font_arr = this.id.split("_");
        var new_size_fonts = getSizeFontFormated(size_font_arr[1]);
        $("#" + full_currentCool).css("font-size",  new_size_fonts+ "em");
        objItem[currentCool]['size_text'] = new_size_fonts + "em";            
        setProperties()
    });

}

/*
 * item[0]  - tipo = imagem,i - textfield,t
 * item[1]  - content = file,flower.png - texto,PurplePier
 * item[2]  - position = x,
 * item[3]  - position = y,
 * item[4]  - width,
 * item[5]  - height,
 * item[6]  - cor, 
 * item[7]  - size, - font
 * item[8]  - style, - font type
 * item[9]  - thumb size
 * item[10] - link
 * item[11] - texto
 * item[12] - z-index
 * 
 */    
function setProperties(){
   
    //Cool type
    $("#cool_type_currentCool").val(objItem[currentCool]['type']);
    //Cool resource
    $("#resource_currentCool").val(objItem[currentCool]['src']);
    //Cool text
    $("#text_currentCool").val(objItem[currentCool]['texto']);
    //Pos x
    $("#pos_x_currentCool").val(objItem[currentCool]['left']); 
    //Pos y
    $("#pos_y_currentCool").val(objItem[currentCool]['top']);
    //Cool width
    $("#width_currentCool").val(objItem[currentCool]['width']);
    //Cool height
    $("#height_currentCool").val(objItem[currentCool]['height']);
    //Font Size
    $("#font_size_currentCool").val(objItem[currentCool]['f_type']);
    //Font
    $("#font_type_currentCool").val(objItem[currentCool]['s_text']);
    //Cool cor
    $("#color_currentCool").val(objItem[currentCool]['color']);
    //thumb size
    $("#thumb_size_currentCool").val(objItem[currentCool]['s_thumb']);
    //link
    $("#link_currentCool").val(objItem[currentCool]['link']);
    //Cool texto
    $("#text_currentCool").val(objItem[currentCool]['texto']);
    //modelo itemcool - class
    //$("#class_currentCool").val(cool_stuff[currentCool][11]);    
    $("#text_status_banner_maker").val(objItem[currentCool]['src']);
    //z-index
    $("#zindex_currentCool").val(objItem[currentCool]['z-index']);
    
    if(objItem[currentCool]['type'] == "t" || objItem[currentCool]['type'] == "p"){
        $("#resource_currentCool").val(objItem[currentCool]['texto']);
        objItem[currentCool]['src'] = objItem[currentCool]['texto'];
    }

}

/*
 * item[0] - tipo = imagem,i - textfield,t
 * item[1] - content = file,flower.png - texto,PurplePier
 * item[2] - position = x,
 * item[3] - position = y,
 * item[4] - width,
 * item[5] - height,
 * item[6] - cor, 
 * item[7] - size, - font
 * item[8] - style, - font type
 * item[9] - sthumb size
 * item[10] - link
 * 
 */    
function initListenerProperties(){
    
    initListeners();
 
    $("#menu_property_settings").click(function(){
        $("#menu_properties_items").hide();
        $(".container_cool_properties").fadeIn("fast");
    });
    
    $("#menu_property_items").click(function(){
        $(".container_cool_properties").hide();
        $("#menu_properties_items").fadeIn("fast");
    });

    $("#bt_pos_x_currentCool").click(function(){
        objItem[currentCool]['left'] = $("#pos_x_currentCool").val();
        $("#d_" + currentCool).css("left",  $("#pos_x_currentCool").val()+"px");
    });

    $("#bt_pos_y_currentCool").click(function(){
        objItem[currentCool]['top'] = $("#pos_y_currentCool").val();
        $("#d_" + currentCool).css("top",  $("#pos_y_currentCool").val()+"px");
    });
    
    $("#bt_height_currentCool").click(function(){        
        objItem[currentCool]['height'] = $("#height_currentCool").val();
        switch(objItem[currentCool]['type']){
            case "i":
            case "c":
                $("#d_" + currentCool + " img").css("height",  $("#height_currentCool").val()+"px");
                break;
            case "t":
                $("#d_" + currentCool).css("height",  $("#height_currentCool").val()+"px");
                $("#d_" + currentCool + " input[type='text']").css("height",  $("#height_currentCool").val()+"px");
                break;
            case "d":
                $("#d_" + currentCool).css("height",  $("#height_currentCool").val()+"px");
                $("#d_" + currentCool + " div:first").css("height",  $("#height_currentCool").val()+"px");
                break;
            default:
                $("#d_" + currentCool).css("height",  $("#height_currentCool").val()+"px");
                $("#d_" + currentCool + " div").css("height",  $("#height_currentCool").val()+"px");
                break;
        }    
    });
    
    $("#bt_width_currentCool").click(function(){
        objItem[currentCool]['width'] = $("#width_currentCool").val();
        switch(objItem[currentCool]['type']){
            case "i":
            case "c":
                $("#d_" + currentCool + " img").css("width",  $("#width_currentCool").val()+"px");
                break;
            case "t":
                $("#d_" + currentCool).css("width",  $("#width_currentCool").val()+"px");
                $("#d_" + currentCool + " input[type='text']").css("width",  $("#width_currentCool").val()+"px");
                break;
            case "d":
                $("#d_" + currentCool).css("width",  $("#width_currentCool").val()+"px");
                $("#d_" + currentCool + " div:first").css("width",  $("#width_currentCool").val()+"px");
                break;
                
            default:
                $("#d_" + currentCool).css("width",  $("#width_currentCool").val()+"px");
                $("#d_" + currentCool + " div").css("width",  $("#width_currentCool").val()+"px");
                break;
        }
        
    });

    $("#bt_link_currentCool").click(function(){
        objItem[currentCool]['link'] = $("#link_currentCool").val();
    });
    
    $("#bt_text_currentCool").click(function(){
        objItem[currentCool]['texto'] = $("#text_currentCool").val();
        $("#" + full_currentCool).val(objItem[currentCool]['texto']);
    });
    
    $("#bt_zindex_currentCool").click(function(){
        objItem[currentCool]['z_index'] = $("#zindex_currentCool").val();
        $("#" + full_currentCool).val(objItem[currentCool]['z_index']);
    });
}

/*
 * Just to get the correct thumbnail
 * 
 * @param string
 * 
 */  
function getSizeThumb(sizethumb, sizeCool){

    var size_thumb = "original";

    switch(sizethumb){            
        case "m":
            size_thumb = "thumbs_120";
            break;
        case "g":
            size_thumb = "thumbs_350";
            break;
        case "j":
            size_thumb = "original";
            break;                
        case "p":
            size_thumb = "thumbs_120";
            break;
    }

    switch(sizeCool){            
        case "m":
            size_thumb = "cool_m";
            break;
        case "g":
            size_thumb = "cool_g";
            break;
        case "o":
            size_thumb = "cool_j";
            break;                
        case "p":
            size_thumb = "cool_p";
            break;
    }
    return size_thumb;
}  

/*
 * Just to get the correct prefix type
 * m, l, s and etc...
 * 
 * @param string
 * 
 */  
function getCompontentPrefix(component_model){

    var component_prefix = "";   

    switch(component_model){            
        case "html_lines":
            component_prefix = "l";
            break;
        case "html_shapes":
            component_prefix = "s";
            break;
        case "html_components":
            component_prefix = "m";
            break; 
        case "html_buttons":
            component_prefix = "bt";
            break;
        case "html_dividers":
            component_prefix = "d";
            break;
        case "html_boxes":
            component_prefix = "bx";
            break;
        case "html_slideshow":
            component_prefix = "ss";
            break;
    }

    return component_prefix;
}

/*
 * Get the browser version
 * 
 */
function getInternetExplorerVersion(){
   var rv = -1; // Return value assumes failure.
   if (navigator.appName == 'Microsoft Internet Explorer')
   {
      var ua = navigator.userAgent;
      var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
      if (re.exec(ua) != null)
         rv = parseFloat( RegExp.$1 );
   }
   return rv;
}

/*
 * Gets a formated font, transform pt to em
 * The values bellow are manually defined.
 *  
 * 
 * @param string
 * 
 */  
function getSizeFontFormated(size_font){

    var format_font = "1";   

    switch(size_font){
        case "6":
            format_font = "0.5";
            break;
        case "8":
            format_font = "0.7";
            break;
        case "9":
            format_font = "0.75";
            break;
        case "10":
            format_font = "0.8";
            break;
        case "11":
            format_font = "0.9";
            break;
        case "12":
            format_font = "1";
            break; 
        case "13":
            format_font = "1.3";
            break;
        case "16":
            format_font = "1.6";
            break;
        case "18":
            format_font = "1.9";
            break;
        case "20":
            format_font = "2";
            break;
        case "24":
            format_font = "2.5";
            break;
        case "28":
            format_font = "2.9";
            break;
    }   

    return format_font;
}
