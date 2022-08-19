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
var sizeBanner = 0;
var id_background_helper;
var sizeWidthBanner;
var isEditBoard = false;
var isCreateBoard = false;
var altura_banner_fancy;
var largura_banner_fancy;
var menu_onscreen = false;
var isFontSizeOn;
var isFontTypeOn;
var posIndex = 0;
var browserType;
var tipo_html_coolbanner;

$(document).ready(function(){

    if($("#helper_id_html_action").val() == "listar") initCheckBoxList();//TODO: remove it from here
    if($("#helper_id_html_action").val() == "exibir") initExibirList();
    if($("#helper_id_html_action").val() == "novo") addBackgroundLoader();

    if($("#helper_id_html_action").val() == "novo" || $("#helper_id_html_action").val() == "editar" || $("#helper_id_html_action").val() == "template") initListenerProperties(); isCreateBoard = true;

    $('.canvas_stage').click(function(e){

        //var childNodeArray = document.getElementById('stage').children;
        currentCool = e.target.id;
        
        //This stament applies the text into cool_stuff
        $('#' + currentCool).blur(function() { setTextField();});

        pos_left_right = cool_stuff[currentCool][2];
        pos_up_down = cool_stuff[currentCool][3];

        setProperties();
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
    
    //Verify if is editing in an edit board.
    if(id == "") isEditBoard = true;
    //Pega a url e tranforma em array com cada item
    var items = result.split("&");
    //Cria-se um array para os arrays
    var attr = new Array();
    id_background_helper = id;
    var size_thumbs = null;
    //Separa os itens acima em atributos individuais
    for(i=0; i < items.length; i++){        
       
        attr[i] = items[i].split("/,/");
        
        switch(attr[i][0]){          

            case "i"://user image
                size_thumbs = getSizeThumb(attr[i][9], false);
                //Adds a simple picture
                if((attr[i][10] != "" && attr[i][10] != undefined && attr[i][10] != 'undefined') && !isCreateBoard){
  
                    //If minisites
                    if($('#helper_mini_site').attr('data-url') != undefined && $('#helper_mini_site').attr('data-url') != '') {
                        var path = $('#helper_mini_site').attr('data-url');
                        s_coolPicture = "<div id='d_" + nr_id +"' class='s_cool'><a rel='1' class='bt_link_banner_advertise' name='" + jsonObject[i]['link'] + "'><img id='itt_" + nr_id + "_" + jsonObject[i]['id'] + "' src='" + path +"/images/" + jsonObject[i]['src'] + "' /></a>" + div_close;
                        
                    }else{ 
                        s_coolPicture = "<div id='d_" + nr_id +"' class='s_cool'><a rel='1' class='bt_link_banner_advertise' name='" + jsonObject[i]['link'] + "'><img id='itt_" + nr_id + "_" + jsonObject[i]['id'] + "' src='/media/user/images/"+ size_thumbs + "/" + jsonObject[i]['src'] + "' /></a>" + div_close;
                    }
                
                }else{
                    if($('#helper_mini_site').attr('data-url') != undefined && $('#helper_mini_site').attr('data-url') != '') {
                        var path = $('#helper_mini_site').attr('data-url');
                        s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'><img id='" + nr_id + "' src='" + path + "/images/" + attr[i][1] + "' onmouseover='addDragableAttribute("+nr_id+ ")' class='dragIT'/>" + div_close;    
                    }else{
                        s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'><img id='" + nr_id + "' src='/media/user/images/"+ size_thumbs + "/" + attr[i][1] + "' onmouseover='addDragableAttribute("+nr_id+ ")' class='dragIT'/>" + div_close;    
                    }
                    
                }
                break;
            case "c"://cool image
                size_thumbs = getSizeThumb(false, attr[i][9]);
                //Adds a cool picture
                if((attr[i][10] != "" && attr[i][10] != undefined && attr[i][10] != 'undefined') && !isCreateBoard){                    
                s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'><a class='bt_link_banner_advertise' name='" + attr[i][10] + "'><img id='" + nr_id + "' src='/media/images/cool/"+ size_thumbs + "/" + attr[i][1] + "' /></a>" + div_close;
                }else{
                s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'><img id='" + nr_id + "' src='/media/images/cool/"+ size_thumbs + "/" + attr[i][1] + "' onmouseover='addDragableAttribute("+nr_id+ ")' class='dragIT'/>" + div_close;    
                }
                break;
                
            case "bn"://banner images
                //Adds a cool picture
                if((attr[i][10] != "" && attr[i][10] != undefined && attr[i][10] != 'undefined') && !isCreateBoard){                    
                s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'><a class='bt_link_banner_advertise' name='" + attr[i][10] + "'><img id='" + nr_id + "' src='/media/user/images/banners/" + attr[i][1] + "' /></a>" + div_close;
                }else{
                s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'><img id='" + nr_id + "' src='/media/user/images/banners/" + attr[i][1] + "' onmouseover='addDragableAttribute("+nr_id+ ")' class='dragIT'/>" + div_close;    
                }
                break;
                
            case "t"://text
                //Adds a textfield
                if(id != ""){                        
                    if(attr[i][10] != ""){
                        s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'><a class='bt_link_banner_advertise' name='" + attr[i][10] + "' id='0'><input id='" + nr_id + "' class='text_cool_link' value='" + attr[i][1] + "'/></a>" + div_close;
                    }else{
                        s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'><input id='" + nr_id + "' class='text_cool' value='" + attr[i][1] + "' readonly/>" + div_close;
                    }
                }else{
                    s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'><input id='" + nr_id + "' type='text' class='text_cool' value='" + attr[i][1] + "' onmouseover='addDragableAttribute("+nr_id+ ")' class='dragIT'/>" + div_close;   
                }

                break;

            case "p"://textarea
                //Adds a textarea
                if(id != ""){
                s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'><textarea id='" + nr_id + "' class='text_textarea_cool' readonly>" + attr[i][1] + "</textarea>" + div_close;
                }else{
                s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'><textarea id='" + nr_id + "' rows='3' class='text_textarea_cool'>" + attr[i][1] + "</textarea>" + div_close;
                }
                break;
                
            case "ss"://slideshow
            case "m"://template
            case "bt"://buttons
            case "l"://lines
            case "d"://dividers
            case "bx"://boxes e ballons
                s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'>" + div_close;
                getTemplate(attr[i][1], attr[i][0], nr_id, attr[i][4], attr[i][5], attr[i][11]);
                break;
                
            case "s"://shape template
                s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'>" + div_close;
                getTemplate(attr[i][1], attr[i][0], nr_id, attr[i][4], attr[i][5]);
                break;

            case "mn2"://menu
            case "mn3"://menu
                s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'>" + div_close;
                //No record, avoid increment unncessary nr_id
                addMenuStuff(nr_id, attr[i][1], attr[i][11]);
                break;

            case "b"://background
                s_coolPicture = "<div id='d_" + nr_id + "' class='s_background'></div>";
                addBackground(nr_id, attr[i][1], 0, false);
                break;

            case "o"://overlay background               
                s_coolPicture = "<div id='d_" + nr_id + "' class='s_overlay'>" + div_close;
                addBackground(nr_id, attr[i][1], 1, false);                
                break;

        }

        //It avoid some bugs with removed object.
        if(attr[i][1] != "" && attr[i][1] != undefined || (attr[i][0] == "b" || attr[i][0] == "o")){

            //Creates the element on stage
            //Due a bug in listar view an id each class is needed
            $(".canvas_stage" + id).append(s_coolPicture);

            //Initiates the array cool properties
            initiateCoolProperties(i, attr[i][0], attr[i][1], attr[i][2], attr[i][3], attr[i][4], attr[i][5], attr[i][6], attr[i][7], attr[i][8], attr[i][9], attr[i][10], attr[i][11]);

            //Transforms the string to number
            var type    = (attr[i][0]);
            var picture = (attr[i][1]);
            var left    = (attr[i][2] * 1);
            var top     = (attr[i][3] * 1);
            var width   = (attr[i][4] * 1);
            var height  = (attr[i][5] * 1); 
            var color   = (attr[i][6]);
            var font    = (attr[i][7]);
            var size_t  = (attr[i][8]);            
            var size_thumb = (attr[i][9]);
            var link = (attr[i][10]);
            var variante = (attr[i][11]);

            setElementProperty(nr_id, type, picture, left, top, width, height, color, font, size_t, size_thumb, link, variante);

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
function setElementProperty(id, type, picture, left, top, width, height, color, font, size_t, size_thumb, link, variante){

    if($('#helper_resize').val() != undefined){
        width = width / ($('#helper_resize').val() * 1);
        height = height / ($('#helper_resize').val() * 1);
        top = top / ($('#helper_resize').val() * 1);
        left = left / ($('#helper_resize').val() * 1);
    }

    switch(type){

        case "t":
        case "p":            
            if(!isEditBoard){
                $("#d_" + id).css("left", left + "px");
                $("#d_" + id).css("top", top + "px");
                $("#" + id).css("width", width + "px");
                if(height != ""){
                $("#" + id).css("height", height + "px");
                }
                $("#" + id).css("color", color);
                $("#" + id).css("font-size", size_t);
                
                if(browserType == -1 || browserType > 8){
                    $("#" + id).css("font-family", font);                    
                }
            }else{                

                $("#d_" + id).css("left", left + "px");
                $("#d_" + id).css("top", top + "px");
                $("#d_" + id).css("width", width + "px");
                $("#d_" + id).css("height", height + "px");  

                $("#" + id).css("width", width + "px");
                $("#" + id).css("color", color); 
                $("#" + id).css("font-size", size_t);

                if(browserType == -1 || browserType > 8){                  
                    $("#" + id).css("font-family", font);                    
                }
            }

            if($('#helper_font').val() != undefined){$("#" + id).css("font-size", $('#helper_font').val());}
            
            break;
            
        case "b":
        case "o":
            addBackground(id, picture);
            break;
            
        case "i":
        case "c":
        case "s":
            $("#d_" + id).css("left", left + "px");
            $("#d_" + id).css("top", top + "px");

            $("#" + id).css("width", width+"px");
            $("#" + id).css("height", height+"px");
            break;
            
        default:
            $("#d_" + id).css("left", left + "px");
            $("#d_" + id).css("top", top + "px");
            $("#d_" + id).css("width", width + "px");
            $("#d_" + id).css("height", height + "px");
            break;
    }

}

/**
 * It adds an image from gallery
 * into stage.
 *
 * @param number id
 *
 */
function addImageStuff(image_name, size_thumb){
    
    var size_thumb_image = getSizeThumb(size_thumb, false);        
    getImgSize("/media/user/images/" + size_thumb_image + "/" +image_name, nr_id, image_name, size_thumb, "fotos");
   
    var s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool' ><img id='" + nr_id + "' src='/media/user/images/" + size_thumb_image + "/" + image_name + "' onmouseover='addDragableAttribute("+nr_id+ ")' class='dragIT'/>"  + div_close;

    $(".canvas_stage").append(s_coolPicture);
    nr_id++;
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
    getImgSize("http://www.purplepier.com.br/media/images/cool/" + size_thumb_image + "/" +image_name, nr_id, image_name, size_thumb, "cool");

    var s_coolPicture = "<div id='d_" + nr_id + "' class='s_cool'><img id='" + nr_id + "' src='http://www.purplepier.com.br/media/images/cool/" + size_thumb_image + "/" + image_name + "' onmouseover='addDragableAttribute("+nr_id+ ")' class='dragIT'/>"  + div_close;

    $(".canvas_stage").append(s_coolPicture);
    nr_id++;
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
            initiateCoolProperties(0, "b", image_name, 0, 0, "", "", "", "", "", "", "", "");
        }else{
            initiateCoolProperties(1, "o", image_name, 0, 0, "", "", "", "", "", "", "", "");
        }
    }
    $("#d_" + id).css("background", "url(/media/images/textures/site/"+ image_name + ")"); 
}

/**
 * It adds a text field it can be edited
 * and adds any kind of text there
 *
 *
 */
function addTextStuff(){

    initiateCoolProperties(nr_id, "t", "Adicione seu texto aqui!", 0, 0, "200", "20", "#000000", "Verdana", "1em", "", "", "");

    var s_coolText = "<div id='d_" + nr_id + "' class='s_cool'><input id='" + nr_id + "' type='text' value='Adicione seu texto aqui!' class='text_cool' onmouseover='addDragableAttribute("+nr_id+ ")' class='dragIT'/>" + div_close;
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
    initiateCoolProperties(nr_id, "p", "Adicione seu texto aqui!", 0, 0, "200", "60", "#000000", "Verdana", "1em", "", "", "");

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
 *
 */
 function getImgSize(imgSrc, id, image_name, size_thumb, type){
    var newImg = new Image();
    newImg.onload = function() {
        if(type == "cool"){
            initiateCoolProperties(id, "c", image_name, 0, 0, this.width, this.height, "#fff", "Verdana", "1em", size_thumb, "", "");
        }else{
            initiateCoolProperties(id, "i", image_name, 0, 0, this.width, this.height, "#fff", "Verdana", "1em", size_thumb, "", "");
        }
    }
    newImg.src = imgSrc;       
}

/*
 * It becomes the textfield as input
 * and editable
 *
 */
function setTextField(){
    cool_stuff[currentCool][1] = $('#' + currentCool).val();
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
function initiateCoolProperties(id_cool, type, img_name, left, top, width, height, color, font_type, size_text, size_thumb, link, variante){
    var propertie_array = new Array();

    propertie_array[0] =  type;//tipo image, text
    propertie_array[1] =  img_name;//cool name
    propertie_array[2] =  left;//position left
    propertie_array[3] =  top;//position top
    propertie_array[4] =  width;//width
    propertie_array[5] =  height;//height
    propertie_array[6] =  color;//color - #000000
    propertie_array[7] =  font_type;//font - Verdana
    propertie_array[8] =  size_text;//size - 12pt
    propertie_array[9] =  size_thumb;//size thumb thumbs_120, original etc
    propertie_array[10] = link;//size thumb thumbs_120, original etc
    
    propertie_array[11] = variante;//classe que sera usada apra alterar as propriedades de uma objeto
    //propertie_array[12] = zindex;//local no exo z
    //propertie_array[13] = id_current;//size thumb thumbs_120, original etc
    //propertie_array[14] = tipo_current;//size thumb thumbs_120, original etc
    //propertie_array[15] = value_button;//titulo tipo botoes
    //propertie_array[16] = titulo_itemcool;//size thumb thumbs_120, original etc

    cool_stuff[id_cool] =  propertie_array;//item
    var item_menu_listener = "<input class='item_menu_listener' value='"+ id_cool + " - "+ img_name +"' type='button' name='"+ id_cool +"'/>";
    $("#menu_properties_items").append(item_menu_listener);
}

/*
 * It get the color from the Pallete component
 * and sets the object with it.
 *
 */
function setCoolColor(color){
    var new_color = color.replace("0x", "#");
    $('#' + currentCool).css("color", new_color);
    cool_stuff[currentCool][6] = new_color;

    setProperties();
}

/**
 * It prepares the string porpertie to be saved in database.
 * The main functionc of it's organize a string to be saved.
 *
 */
function prepareCoolProperties(){
    var string_properties = "";

    for(o = 0; o < cool_stuff.length; o++){
        //alert(cool_stuff[o][1]);
        if(cool_stuff[o][1] != "empty"){

            for(e = 0; e < cool_stuff[o].length; e++){

                string_properties += cool_stuff[o][e];
                //Avoid unnecessary attribute
                if(e < cool_stuff[o].length - 1){
                    string_properties += "/,/";
                }
            }

            if(cool_stuff[o][0] != "empty"){
                //Avoid unnecessary item
                if(o < cool_stuff.length - 1 && cool_stuff[o][0] != "empty"){
                    string_properties += "&";
                }
            }
        }
    }
   return string_properties;
}

/*
 * It handles with the key up events
 * If the key is releases an action is
 * send.
 *
 */
function removeHTMLCool(id){

    $("#d_" + id).fadeOut("slow");
    var childRemove = document.getElementById('stage').children;
    $("#" + childRemove[id].firstChild.id).fadeOut("slow");

    for(r = 0; r < cool_stuff[id].length; r++){
        cool_stuff[id][r] = "empty";
    }
}

/*
 * It sends the values needed
 * to be saved in database
 *
 */
function saveHTMLBanner(tipo_action){
    var tipo_local = $("#helper_local").val();
    var cool_string = prepareCoolProperties();
    var tipo = "html_" + tipo_local;

    //Helper with the right name used into database
    if(tipo_local == "htmlmini") tipo = "html_mini";
    if(tipo_local == "htmlblocks") tipo = "html_blocks";
    if(tipo_local == "htmlspark") tipo = "html_spark";
    if(tipo_local == "htmlcorona") tipo = "html_corona";
    if(tipo_local == "htmllonsdale") tipo = "html_lonsdale";
    if(tipo_local == "htmlbanners") tipo = "html_banners";
    if(tipo_local == "htmlmainbanners") tipo = "html_mainbanners";

    $.post("/admin/" + tipo_local +  "/salvar",{

        id: $("#helper_id_html_cool").val(),
        action: tipo_action,
        altura: sizeBanner,
        largura: $("#helper_largura").val(),
        colors: "&cor=empty",
        cool: cool_string,
        modelo: "empty html",
        tipo: tipo

    },function(data){
        //It transforms the returned json array in an object
        var jsonObject = eval('(' + data + ')');
        $("#helper_id_html_cool").val(jsonObject['id']);
        showAlertDim(jsonObject['message']);         
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
function getTemplate(template, tipo, id, width, height, modelo){

    $.post("/admin/coolhtml/apply_component",{
        template: template,
        tipo: tipo,
        height: height,
        width: width,
        texto: ""
    },function(result){ 
        result = result.replace(/###/i, id);
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
        result = result.replace(/###/i, nr_id);    

        var blockHTML = s_coolCont + result + div_close;        
        $(".canvas_stage").append(blockHTML);        
        
        initiateCoolProperties(nr_id, type_prefix, template, 0, 0, $("#d_" + nr_id).width(), $("#d_" + nr_id).height(), "#000000", "Verdana", "0.9em", "", "", "");
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
            data = data.replace(/###/i, nr_id);
            $(".canvas_stage").append("<div id='d_" + nr_id + "' class='s_cool'>" + data + div_close);
            if(modelo != "" && modelo != "undefined")$("#d_" + id + " ." + component).attr("id", modelo);
            initiateCoolProperties(nr_id, type_menu, component, 0, 0, 0, 0, "#ffffff", "Verdana", "1em", "", "", "");
            nr_id++;
        }else{
            data = data.replace(/###/i, id);
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
            window.location = "/admin/htmlbanners/novo";
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
    initDragDrop();
    
    tipo_html_coolbanner = $("#helper_local").val();

    //Adds the picker component and sets it to ready!
    $('#picker').farbtastic('#color');

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
        currentCool = this.name;
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
                    cool_stuff[currentCool][3] = $('#d_' + currentCool).offset().top - $('.canvas_stage').offset().top;
                    break;

             case "bt_edit_move_right":
                    pos_left_right++;
                    $("#d_" + currentCool).css("left", pos_left_right + "px");                        
                    cool_stuff[currentCool][2] = $('#d_' + currentCool).offset().left - $('.canvas_stage').offset().left;
                    break;
                    
            case "bt_edit_move_down":
                    pos_up_down--;
                    $("#d_" + currentCool).css("top", pos_up_down + "px");
                    cool_stuff[currentCool][3] = $('#d_' + currentCool).offset().top - $('.canvas_stage').offset().top;
                    break;

             case "bt_edit_move_left":
                    pos_left_right--;
                    $("#d_" + currentCool).css("left", pos_left_right + "px");                        
                    cool_stuff[currentCool][2] = $('#d_' + currentCool).offset().left - $('.canvas_stage').offset().left;
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
                    posIndex++;
                    $("#d_" + currentCool).css("z-index", posIndex);
                    break;
                    
            case "bt_edit_depth_down":
                    posIndex--;
                    $("#d_" + currentCool).css("z-index", posIndex);
                    break;

            case "bt_edit_width_up":
                    width_current = $("#" + currentCool).width() + 4;
                    $("#" + currentCool).css("width", width_current + "px");
                    cool_stuff[currentCool][4] = width_current;
                    break;
            
            case "bt_edit_width_down":
                    width_current = $("#" + currentCool).width() - 4;
                    $("#" + currentCool).css("width", width_current + "px");
                    cool_stuff[currentCool][4] = width_current;
                    break;
            
            case "bt_edit_height_up":
                    height_current = $("#" + currentCool).height() + 4;
                    $("#" + currentCool).css("height", height_current + "px");
                    cool_stuff[currentCool][5] = height_current;

                break;

            case "bt_edit_height_down":
                    height_current = $("#" + currentCool).height() - 4;
                    $("#" + currentCool).css("height", height_current + "px");
                    cool_stuff[currentCool][5] = height_current;
                    break;
        }

        setProperties();
    });


    $('#bt_clear').click(function() {
        clearForm();
    });

    $('#link_list_htmlcool').click(function() {
        window.location = "/admin/" + tipo_html_coolbanner + "/listar";
    });
     
    $("#bt_edit_color").click(function(){
        alert("o");
        showPaletaCores();
    });
    
    //Menu de propriedades f'utuante
    $('#bt_menu_properties').click(function(){
        if(!menu_onscreen){
            $(".container_menu_properties").fadeIn("fast");
            menu_onscreen = true;
        }else{
            $(".container_menu_properties").fadeOut("fast");
            menu_onscreen = false;
        }

    });
    
    //PAy Attention on the structure, all the component must be that way.
    $(".colors_support :button").click(function(){
        $("."+cool_stuff[currentCool][1]).attr("id", cool_stuff[currentCool][1] + "-" + this.id);
        cool_stuff[currentCool][11] = cool_stuff[currentCool][1] + "-" + this.id;
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
        'transitionIn'      :'elastic',
        'transitionOut'     :'elastic',
        'speedIn'	    : 300,
        'speedOut'	    : 200,
        'autoDimensions'    : false,
        'width'             : 720,
        'height'            : 420,
        'overlayShow'       : false,
        'href'              : '/admin/images/banner/0/9'
    });

    //Links
    //This method works together a anchorAnimateBanner
    //It shows the gallery in the middle screen.
    $('#bt_cool_1').fancybox({
        'transitionIn'      :'elastic',
        'transitionOut'     :'elastic',
        'speedIn'	    : 300,
        'speedOut'	    : 200,
        'autoDimensions'    : false,
        'width'             : 720,
        'height'            : 420,
        'overlayShow'       : false,
        'href'              : "/admin/cool/exibir/0/3"
    });

    //Cool HTML
    //It shows the HTML cool stuff
    $('#bt_cool_3').fancybox({
        'transitionIn'      :'elastic',
        'transitionOut'     :'elastic',
        'speedIn'	    : 300,
        'speedOut'	    : 200,
        'autoDimensions'    : false,
        'width'             : 720,
        'height'            : 420,
        'overlayShow'       : false,
        'href'              : "/admin/coolhtml/exibir/components"
        });

    //Modelos
    //This method works together a anchorAnimateBanner
    //It shows the gallery in the middle screen.
    $('#bt_cool_2').fancybox({
        'transitionIn'      :'elastic',
        'transitionOut'     :'elastic',
        'speedIn'	    : 300,
        'speedOut'	    : 200,
        'autoDimensions'    : false,
        'width'             : 720,
        'height'            : 420,
        'overlayShow'       : false,
        'href'              : "/admin/coolhtml/mostrar/" + $("#helper_local").val()
    });

    //Texturas
    //This method works together a anchorAnimateBanner
    //It shows the gallery in the middle screen.
    $('#bt_cool_4').fancybox({
        'transitionIn'      :'elastic',
        'transitionOut'     :'elastic',
        'speedIn'	    : 300,
        'speedOut'	    : 200,
        'autoDimensions'    : false,
        'width'             : 720,
        'height'            : 420,
        'overlayShow'       : false,
        'href'              : "/admin/texturas/site/exibir"
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
            cool_stuff[currentCool][3] = $('#d_' + currentCool).offset().top - $('.canvas_stage').offset().top;
            if(countNr > 10){pos_up_down = pos_up_down + 3}
            if(countNr > 20){pos_up_down = pos_up_down + 3}
            break;

        case "up":
            pos_up_down--;
            $("#d_" + currentCool).css("top", pos_up_down + "px");
            cool_stuff[currentCool][3] = $('#d_' + currentCool).offset().top - $('.canvas_stage').offset().top;
            if(countNr > 10){pos_up_down = pos_up_down - 3}
            if(countNr > 20){pos_up_down = pos_up_down - 3}
            break;

         case "left":
            pos_left_right--;
            $("#d_" + currentCool).css("left", pos_left_right + "px");
            cool_stuff[currentCool][2] = $('#d_' + currentCool).offset().left - $('.canvas_stage').offset().left;
            if(countNr > 10){pos_left_right = pos_left_right - 3}
            if(countNr > 20){pos_left_right = pos_left_right - 3}
            break;

         case "right":
            pos_left_right++;
            $("#d_" + currentCool).css("left", pos_left_right + "px");
            cool_stuff[currentCool][2] = $('#d_' + currentCool).offset().left - $('.canvas_stage').offset().left;
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

    initiateCoolProperties(0, "b", "", 0, 0, 0, "", "", "", "", "", "", "");
    initiateCoolProperties(1, "o", "", 0, 0, 0, "", "", "", "", "", "", "");

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
                $("#helper_local").val("htmlmini"); 
                tipo_html_coolbanner = "htmlmini";
                break;

            case "250":
                $("#helper_local").val("htmlblocks");
                tipo_html_coolbanner = "htmlblocks";
                break;

            case "300":
            case "350":
                $("#helper_local").val("htmlspark");
                tipo_html_coolbanner = "htmlspark";
                break;

            case "450":
                $("#helper_local").val("htmlcorona");
                tipo_html_coolbanner = "htmlcorona";
                break;
                
            case "700":
            case "720":
                $("#helper_local").val("htmllonsdale");
                tipo_html_coolbanner = "htmllonsdale";
                break;

            case "980":
                $("#helper_local").val("htmlbanners"); 
                tipo_html_coolbanner = "htmlbanners";
                break;
            //Main banner  
            case "1000":
                $("#helper_local").val("htmlmainbanners");
                tipo_html_coolbanner = "htmlmainbanners";
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
            'transitionIn'      :'elastic',
            'transitionOut'     :'elastic',
            'speedIn'           : 300,
            'speedOut'          : 200,
            'autoDimensions'    : false,
            'width'             : 720,
            'height'            : 420,
            'overlayShow'       : false,
            'href'              : "/admin/coolhtml/mostrar/" + $("#helper_local").val()
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
        $("#" + currentCool).css("font-family", this.id);
        cool_stuff[currentCool][7] = this.id;            
        setProperties();            
    });
    
    //Sets a new size font,  it gets a new size transforming pt to em.
    $('.font_size_support_base :button').click(function(){
        var size_font_arr = this.id.split("_");
        var new_size_fonts = getSizeFontFormated(size_font_arr[1]);
        $("#" + currentCool).css("font-size",  new_size_fonts+ "em");
        cool_stuff[currentCool][8] = new_size_fonts + "em";            
        setProperties()
    });

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
 * item[9] - thumb size
 * item[10] -link
 * 
 */    
function setProperties(){
    //Cool type
    $("#cool_type_currentCool").val(cool_stuff[currentCool][0]);
    //Cool cor
    $("#resource_currentCool").val(cool_stuff[currentCool][1]);
    //Pos x
    $("#pos_x_currentCool").val(cool_stuff[currentCool][2]); 
    //Pos y
    $("#pos_y_currentCool").val(cool_stuff[currentCool][3]);
    //Cool width
    $("#width_currentCool").val(cool_stuff[currentCool][4]);
    //Cool height
    $("#height_currentCool").val(cool_stuff[currentCool][5]);
    //Font Size
    $("#font_size_currentCool").val(cool_stuff[currentCool][8]);
    //Font
    $("#font_type_currentCool").val(cool_stuff[currentCool][7]);
    //Cool cor
    $("#color_currentCool").val(cool_stuff[currentCool][6]);
    //thumb size
    $("#thumb_size_currentCool").val(cool_stuff[currentCool][9]);
    //link
    $("#link_currentCool").val(cool_stuff[currentCool][10]);
    //modelo itemcool - class
    //$("#class_currentCool").val(cool_stuff[currentCool][11]);

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
        cool_stuff[currentCool][2] = $("#pos_x_currentCool").val();
        $("#d_" + currentCool).css("left",  $("#pos_x_currentCool").val()+"px");
    });

    $("#bt_pos_y_currentCool").click(function(){
        cool_stuff[currentCool][3] = $("#pos_y_currentCool").val();
        $("#d_" + currentCool).css("top",  $("#pos_y_currentCool").val()+"px");
    });
    
    $("#bt_height_currentCool").click(function(){        
        cool_stuff[currentCool][5] = $("#height_currentCool").val();        
        $("#" + currentCool).css("height",  $("#height_currentCool").val()+"px");       
    });
    
    $("#bt_width_currentCool").click(function(){
        cool_stuff[currentCool][4] = $("#width_currentCool").val();
        $("#" + currentCool).css("width",  $("#width_currentCool").val()+"px");
    });

    $("#bt_link_currentCool").click(function(){
        cool_stuff[currentCool][10] = $("#link_currentCool").val();
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
