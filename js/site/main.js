 /*
    Document   : main
    Created on : 20/10/2010, 09:31:00
    Author     : CarlosGarcia
    Description: New features added, no DB Manager access
    Purpose of the javascript follows.
*/
var textura_botao;
var cor_botao;
var cor_titulo;
var cor_subtitulo;
var icon_titulo;
var icon_topic;
var last_input_focused;
var tt_fancy = 1;
var initOncePurpleBusiness = false;
var nr_slot = 1;

var empty = "";
var fontSize = 12;
var isLoggedIn = false;
var profileLevel = 0;
var isCartItemsShowed = false;
var id_interval = null;
var fbLikBoxVis = false;
var pressNewsLetterSend = false;

$(document).ready(function(){
    initButtonsListeners();
    initListenersComponent();
    verifyIfIsLogged();
});//Close Document Ready


function updateIntro(result){

    $('body').css("background-image", 'url(' + result["textura_intro"] + ')');
    //$('.overlay').css("background-image", 'url(/media/images/textures/' + result["textura_overlay"] + ')');
    //$('.shadow').css("background-image", 'url(/media/images/textures/' + result["textura_sombras"] + ')');
    $('body').css("background-repeat", result["tipo_textura_intro"]);
    $('body').css("background-color", result["cor_textura_intro"]);
    $('body').css("background-position", 'top').css('background-repeat', 'repeat').css('background-size', 'initial').css('background-attachment', 'initial');    
    $('.container_pan_status').css("background-image", 'url(/media/images/textures/mensagem/statusd7.png)');
    //getStageSize();
  
}

 /*
  * Método responsável por setar o tamanho do rodape e o menu componente
  * quando esse é adicionado em topos e rodapes
  * 
  * @param number
  * @param number
  * 
  */
 function setContainerHTMLProperties(rodape_id, height){ 
     $('.footermainPan').css("height", height + "px");                 
 }

/*
 * Sets the banner's height.
 * Just Height, nothing more, if needed a width different
 * use the 7 differents banner's size, like: Min, Block, Spark,
 * Corona, Banner
 *
 */
function setSizeHeader(alt, larg, id){
    $(".canvas_stage" + id).css("height", alt + "px");
    $(".headermainPan").css("height", alt + "px");
}

 /*
  * Método responsável por carregar os modulos.
  * Esse modulos são features pre-prontas que podem ser 
  * utilizadas no meio de textos com tags como <galeria></galeria> e etc
  * 
  * @loader - id da div que ira carregar o moduloe
  * @modulo - nome do modulo como tipo galeria
  * @layout - laoyt que o modulo terá, pode ser por diferença de tamanho, features etc.
  * @id - id da galeria, produto, serviço, banner ou outra coisa que será carregada.
  * @animation - boolean se tera'ou não animação.
  * @action
  * @qtd - numero de blocks, 1,2 3, 4 full é 1
  * @id_general - numero do id de alguma coisa abaixo é dito o tipo da coisa
  * @type_general - o tipo de alguma coisa, pode ser home, materia, eventos, banners e etc.
  * 
  */
 function loadModule(loader, modulo, layout, id, divider, animation, action, qtd, id_general, type_general){ 
     //if(modulo == "images"){alert(layout + " loader: " + loader + " " + id);}
     $("#" + loader).hide();
     $.post("/site/modulos/",{                
        id: id,
        modulo: modulo,
        layout: layout,
        divider: divider,
        action: action,
        begin: "0",
        qtd: qtd,
        id_general: id_general,
        type_general: type_general
     },function(data){              
        $("#" + loader).append(data);
        if(animation){$("#" + loader).fadeIn("fast");}else{$("#" + loader).css('display', 'block').show();};                  
     });         
 }

 /*
  * Método responsável por recarregar os modulos.
  * Esse modulos são features pre-prontas que podem ser 
  * utilizadas no meio de textos com tags como <galeria></galeria> e etc
  * 
  * @loader - id da div que ira carregar o moduloe
  * @modulo - nome do modulo como tipo galeria
  * @layout - laoyt que o modulo terá, pode ser por diferença de tamanho, features etc.
  * @id - id da galeria, produto, serviço, banner ou outra coisa que será carregada.
  * @animation - boolean se tera'ou não animação.
  * @action - if it's loads or reloads
  * @begin  - inicio da nova pesquisa, LIMIT 0, 10
  * @qtd - numero de blocks, 1,2 3, 4 full é 1
  * @id_general - numero do id de alguma coisa abaixo é dito o tipo da coisa
  * @type_general - o tipo de alguma coisa, pode ser home, materia, eventos, banners e etc.
  * 
  */
 function reloadModule(loader, modulo, layout, id, divider, animation, action, begin, qtd, id_general, type_general){ 

    if(animation && begin < 2)$("#" + loader).hide();

    $.post("/site/modulos/",{                 
        id: id,
        modulo: modulo,
        layout: layout,
        divider: divider,
        action: action,
        begin: begin,
        qtd: qtd,
        id_general: id_general,
        type_general: type_general
    },function(data){
        $("#" + loader).append(data);
        if(animation && begin < 2)$("#" + loader).fadeIn("fast");
        return true;
    });
 }

function initButtonsListeners(){

     $('.bt_back_conta').click(function(){
         window.location = "/conta/home";
     });

     $('body').on('click', '.flash_notice_button_close', function(){
         $('.flash_notice').fadeOut("slow");
     }); 
     
     $(".container_inputs_middle").click(function(){          
        handleInputFocus(this.id);
     });
     
     $(".container_inputs_middle").blur(function(){          
        handleInputLostFocus(this.id);
     }); 
     
     //MenuGroup, MenuTexture, menu-dropdown
    $('.dropdown').mouseenter(function(event){
        $(this).children("ul").fadeIn(300);
    }).mouseleave(function(){
        $(this).children("ul").fadeOut(300);
    });
    
    $('#menu-mobile').change(function(){
        window.location = '/' + $(this).val().replace(/\s+/g, ' ');;
    });
    
    initOrcamentusListeners();
 }
 
 /*
  * Adds a listners for the banners clickeds
  * Its works together extremos site
  * 
  * PS: All links must use this statement
  * 
  */
function initAdvertisingListeners(){
    
    $('body').on('click', '.bt_link_banner_advertise', function(){
        
        var id = this.id;
        var link_advertise = this.name;
        var type_launch = "external_link";
         
        var link_type = link_advertise.charAt(0);
        
        switch(link_type){
            case "/":
                type_launch = "internal_link";
                launchLinkPurplePier(id, type_launch, link_advertise);
                break;
            case "!":
                type_launch = "popup_link";
                launchLinkPurplePier(id, type_launch, link_advertise);
                break;
                
            case "#":
                type_launch = "launch_link";
                launchLinkPurplePier(id, type_launch, link_advertise.substring(1));
                break;
                
                
            default:
                type_launch = "external_link";
                launchLinkPurplePier(id, type_launch, link_advertise);                
                break;
        }        
     }); 
 }
 
 /*
  * It works together the statement above;
  * They are brother and sister, the method above split the
  * link and this one makes the launch!
  * 
  */
function launchLinkPurplePier(id, type, link_advertise){
    
    $.post("/site/relatar/click",{            
            id: id
    },function(data){         
       switch(type){
           case "internal_link":
               window.open("http://" + window.location.hostname + link_advertise, '_self');
               break;

           case "popup_link":
               openPopUp(link_advertise);
               break;
               
           case "external_link":
               window.open("http://" + window.location.hostname + link_advertise, '_blank');
               break;
               
           case "launch_link":
               window.open(link_advertise, '_blank');
               break;
        }        
    });
 }

/*
* Adds a fav link into favorites
* 
* 
*/
function addFavorite(){
   if(document.all){
      window.external.AddFavorite(location.href, document.title);
   }else if(window.sidebar){
       window.sidebar.addPanel(document.title, location.href, '');
   }
} 


//Produtos
//***********************************************************************************
//***********************************************************************************
//***********************************************************************************
//Produtos

/*
 * Put an item into shopping cart
 * Makes shopping cart part
 * 
 * @param tipo: produto, credito, modulo, cool, image
 * @param id_item: item a ser comprado tipo id do produto
 * @param id_variante: Caso hava mais de uma cor ou mais de um tamanho
 * @param escolha: verifica se é para adicionar no carrinho ou pagar direto 
 * 
 */
function buyItem(id_variante, tipo, id_item, escolha){
    var qtd_item_pp = $("#item_pp_"+ id_item).val();
    var valor = $("#item_pp_"+ id_item).attr('alt');
    
    $.post("/loja/add_item",{                
        id_item: id_item,
        id_variante: id_variante,
        tipo: tipo, 
        qtd: qtd_item_pp,
        valor: valor, 
        escolha: escolha
        
    },function(data){
        
        var jsonObject = eval('(' + data + ')');
        
        
        if(escolha == "pagamento"){
            if(jsonObject['pagamento']){
                showPopUp("toast", jsonObject['message'],  'message_simple', 400, 30, false);
                $(".amount_user_credits").empty().text(jsonObject['creditos_atual']);
            }else{ 
                window.location = "http://" + window.location.hostname + "/pagamento";
                
                if(typeof _gaq !== 'undefined') _gaq.push(['_trackPageview', '/loja/item_adicionado_carrinho/' + id_item]);
                if(typeof dataLayer !== 'undefined') dataLayer.push({'event':'sendVirtualPageview','vpv':'/loja/item_adicionado_carrinho/' + id_item});
                    
                return false;
            }
            
        }else{
            if(jsonObject['amount'][0]['SUM(amount)'] > 0){
                var items_sc = "";
                $("#items_shopping_cart").empty();
                for(i = 0; i < jsonObject['items'].length; i++){
                    items_sc  = "<div class='item_sh_c'>";
                    items_sc += "<div class='item_sh_c_qtd'>" + jsonObject['items'][i]['amount'] + "</div>";
                    items_sc += "<div class='item_sh_c_name truncate'>" + jsonObject['items'][i]['nome'] + "</div>";
                    items_sc += "<div class='item_sh_c_value'>" + jsonObject['items'][i]['valor_format'] + "</div>";
                    items_sc += "</div>";
                    $("#items_shopping_cart").append(items_sc);
                }
                showPopUp("toast", "Item adicionado com sucesso!",  'message_simple', 400, 30, false);
            }
            $("#amount_shopping_cart").empty().text(jsonObject['amount'][0]['SUM(amount)']); 
            $("#amount_shopping_cart_complete").empty().text(jsonObject['amount'][0]['SUM(amount)']+" items(s) - "+ jsonObject['amount']['valor_format']);
           
            if(typeof _gaq !== 'undefined') _gaq.push(['_trackPageview', '/loja/item_adicionado_carrinho/' + id_item]);
            if(typeof dataLayer !== 'undefined') dataLayer.push({'event':'sendVirtualPageview','vpv':'/loja/item_adicionado_carrinho/' + id_item});
                
            return true;
        }
        
        
    });   
}

/*
 * Put an item into shopping cart
 * Makes shopping cart part
 * 
 */
function buyCredits(id_item, tipo, valor){
    
    var qtd_item_pp = 1;
    
    $.post("/loja/add_item",{                
        id_item: id_item,
        tipo: tipo, 
        qtd: qtd_item_pp,
        valor: valor
        
    },function(data){
        
        var jsonObject = eval('(' + data + ')');
        
        if(jsonObject['amount'][0]['SUM(amount)']  > 0){

            var items_sc = "";
            $("#items_credits_container").empty();
            for(i = 0; i < jsonObject['items'].length; i++){
                items_sc  = "<div class='item_cred_c' id='obj_item_" + jsonObject['items'][i]['id'] + "'>";
                items_sc += "<div class='item_cred_c_name'>" + jsonObject['items'][i]['nome'] + "</div>";
                items_sc += "<div class='item_cred_c_value'>" + jsonObject['items'][i]['valor_format'] + "</div>";
                items_sc += "<input class='item_cred_c_bt_close' id='item_"+jsonObject['items'][i]['id']+"' type='button'/>";
                items_sc += "</div>";
                $("#items_credits_container").append(items_sc);
            }
            $(".bt_line_transparent").show();  
        }
        $("#amount_cart_credits").empty().text(jsonObject['amount']['valor_format']);
        $(".amount_subtotal_credits").empty().text("Subtotal - " + jsonObject['amount']['valor_format']);
        $("#helper_amount_total").val(jsonObject['amount']['valor']);   
    });   
}

/*
 * Put an item into shopping cart
 * Makes shopping cart part
 * 
 * @param tipo: produto, credito, modulo, cool, image
 * @param id_item: item a ser comprado tipo id do produto
 * @param id_variante: Caso hava mais de uma cor ou mais de um tamanho
 * @param escolha: verifica se é para adicionar no carrinho ou pagar direto 
 * 
 */
function addItemToCart(id_variante, tipo, id_item, escolha, valor){
    
    $("#output_sob_consulta").empty().append("<div class='bg-info mgB'>Adicionando...</div>");
    
    $.post("/produtos/add_item",{                
        id_item: id_item,
        tipo: tipo, 
        qtd: $("#sob_consulta_nr").val(),
        valor: valor, 
        escolha: escolha
        
    },function(data){
        
        var jsonObject = eval('(' + data + ')');
       
        //if(jsonObject['amount'][0]['SUM(amount)'] > 0){
            //var items_sc = "";
            //$(".items_cotacoes_cart").empty();
            //for(i = 0; i < jsonObject['items'].length; i++){
                //items_sc  = "<div class='item_sh_c'>";
                //items_sc += "<div class='item_sh_c_qtd'>" + jsonObject['items'][i]['amount'] + "</div>";
                //items_sc += "<div class='item_sh_c_name truncate'>" + jsonObject['items'][i]['nome'] + "</div>";
                //items_sc += "<div class='item_sh_c_value'>" + jsonObject['items'][i]['valor_format'] + "</div>";
                //items_sc += "</div>";
               // $(".items_cotacoes_cart").append(items_sc);
            //}
            //showPopUp("toast", "Item adicionado com sucesso!",  'message_simple', 400, 30, false);
        //}

        $("#output_sob_consulta").empty().append("<div class='bg-success mgB'>Item adicionado a cotação</div>");

        $("#amount_shopping_cart, .amount_shopping_cart").empty().append("<i class='fa fa-shopping-cart mgR'></i>" + jsonObject['amount'][0]['SUM(amount)']+" item(s)"); 
        $("#amount_shopping_cart_complete, .amount_shopping_cart_complete").empty().append("<i class='fa fa-shopping-cart mgR'></i>" + jsonObject['amount'][0]['SUM(amount)']+" item(s) - "+ jsonObject['amount']['valor_format']);

        if(typeof _gaq !== 'undefined') _gaq.push(['_trackPageview', '/produto/item_adicionado_carrinho/' + id_item]);
        if(typeof dataLayer !== 'undefined') dataLayer.push({'event':'sendVirtualPageview','vpv':'/produto/item_adicionado_carrinho/' + id_item});

        return true;
            
    });   
}

/*
 * Uploads and apply Produto picture
 *
 * This method is called when the upload is completed
 * See the upLoadfy above.
 * 
 */
function applyPictureProduto(){
    //var path_image_produto = "/media/user/images/thumbs_120/" + $("#file_helper").val();        
    //alert(path_image_produto);
    //applyPictureSize(path_image_produto, nr_slot, '120');        
}

/**
 *
 * It firts calculates the images sizes before apply it.
 * 
 * There are severals methods that uses this system.
 * The most of them use a request updateSlotProdutoPicture(), bellow
 * It's just to follow a pattern.
 * 
 * path_cool_stuff = image path
 * id_slot = id recebido pela foto
 * sizeT = tamanho max que a imagem deve ter em px
 * container_loader = container da imagem no caso de slideshow etc
 * place = onde será exibida, main ou thumbs
 *
 * @param string
 * @param number
 * @param number
 * @param number
 * @param string
 * @param string
 *
 */
function applyPictureSize(path_cool_stuff, id_slot, sizeHeight, sizeWidth, container_loader, place){

    var img = new Image();

    img.onload = function(){

        if((this.width > this.height && this.height <= sizeHeight) && place != "full") {
            percet = sizeWidth / this.width;
        
        }else if(this.width > sizeWidth && this.height > sizeHeight){
            var wIm = this.width / sizeWidth;
            var hIm = this.height / sizeHeight;
            if(wIm > hIm) percet = sizeWidth / this.width;
            if(hIm > wIm) percet = sizeHeight / this.height;
        
        }else{
            if(sizeHeight < this.height) percet = sizeHeight / this.height;
            if(sizeWidth  < this.width)  percet = sizeWidth / this.width;
            if(this.width  ==  this.height)  percet = 0.5;
        }

        $("#slot_picture" + id_slot).hide();
        $("#" + container_loader).css('text-align', 'left');

        if((sizeWidth >= this.width) && (sizeHeight >= this.height)){

            if(container_loader != "")$("#" + container_loader).css("height",  sizeHeight+"px");

            $("#slot_picture" + id_slot).attr('width', this.width);
            
            if(place != "full"){
                $("#slot_picture" + id_slot).attr('height', this.height);
                $("#slot_picture" + id_slot).css("margin-top", ((this.height / 2) * -1)+ "px");
                $("#slot_picture" + id_slot).css("top",  "50%");
            }
            
            $("#slot_picture" + id_slot).attr("src",  path_cool_stuff);
            $("#slot_picture" + id_slot).css("position", "relative");          

            $("#slot_picture" + id_slot).css("margin-left", ((this.width / 2) * -1)+ "px");
            $("#slot_picture" + id_slot).css("left",  "50%"); 

         }else{
      
            var result = new Array();
            result[0] = Math.round(this.width * percet);
            result[1] = Math.round(this.height * percet);
            
            //Make sure bothe valeus are fitting
            if(result[0] > sizeWidth || result[1] > sizeHeight && place != 'full'){
                if(result[1] > sizeHeight) {percent = sizeHeight / result[1];}//Altura
                if(result[0] > sizeWidth)  {percent = sizeWidth / result[0];}//Largura
                
                result[0] = Math.round(result[0] * percet);
                result[1] = Math.round(result[1] * percet);
            }
            
            //alert(result[0] +  '  ' +result[1]);
            if(container_loader != "" && place == 'full') $("#" + container_loader).css("height",  result[1]+"px");

            //Attributes
            $("#slot_picture" + id_slot).attr('width', result[0]);
            
            if(place != "full") $("#slot_picture" + id_slot).attr('height', result[1]);
            
            $("#slot_picture" + id_slot).attr("src",  path_cool_stuff);
            $("#slot_picture" + id_slot).css("position", "relative");            

            if(this.width <= this.height){
                //Height smaller
                if(place != "full"){
                    $("#slot_picture" + id_slot).css("margin-top", ((result[1] / 2) * -1)+ "px");
                    $("#slot_picture" + id_slot).css("top",  "50%");
                    
                }

                if(result[0] <= (sizeWidth - 10) || place == "thumbs" ){
                    $("#slot_picture" + id_slot).css("left",  "50%");
                    $("#slot_picture" + id_slot).css("margin-left",  ((result[0] / 2) * -1)+ "px"); 
                }else{
                    $("#" + container_loader).css('text-align', 'center');
                }

            }else{

                //Width smaller
                $("#slot_picture" + id_slot).css("left",  "50%");
                $("#slot_picture" + id_slot).css("margin-left",  ((result[0] / 2) * -1)+ "px"); 

                if((result[1] <= (sizeHeight - 10) || place == "thumbs" || place == "main") && place != "full"){
                    
                    $("#slot_picture" + id_slot).css("margin-top", ((result[1] / 2) * -1)+ "px");
                    $("#slot_picture" + id_slot).css("top",  "50%");
                    $("#slot_picture" + id_slot).css("position",  "absolute");
                    
                }
            }             
        }
        
        //Avoid unecessary error
        if(place == "main"){
            $("#full_picture0").attr("href", path_cool_stuff);
            $("#full_picture0").attr("title", path_cool_stuff);
        }
        
        $("#formSlotPicture" + id_slot).val(path_cool_stuff);            
        $("#slot_picture" + id_slot).fadeIn("slow");            
        nr_slot++;

    }        
    img.src = path_cool_stuff;
}

//Paginacao
$(".item_paginador").on('click', function(){
   if(this.id != 'proximo' && this.id != 'anterior') window.location = this.id; 
});

/*
 * This method is called from a javascript request
 * in view produtos, slots pictures
 * 
 * PS: Pay attention into num variable, depends on the id its can be a problem, so sometimes it's
 * better using a letter as id the slot it's default, so try something like PP or anything else. 
 * 
 */
function updateSlotProdutoPicture(path_image, num, sizeH, sizeW, container_loader, place){
    applyPictureSize(path_image, num, sizeH, sizeW, container_loader, place);
} 

/*
 * This method prints a content inside a div
 * See example how use it in redebeneficios.js
 * 
 */
function PrintContent(prt) {
    var DocumentContainer = document.getElementById(prt.div);
    var WindowObject = window.open('', 'PrintWindow', prt.settings);
    WindowObject.document.writeln(DocumentContainer.innerHTML);
    WindowObject.document.close();
    WindowObject.focus();
    WindowObject.print();
    WindowObject.close();
}


/*
 * Relata click do usuário, pega id se logado
 *
 */
function relatarClick(report, url){
    $.post("/site/relatar/click_user", {report: report, url: url});
}

/*
 * Relata click do usuário, pega id se logado
 *
 */
function setPreferencesSession(field, value){
    $.post("/site/relatar/set_session_data", {label: field, value: value});
}

/*
 * Create drill account, esse metodo fura tudo e cria uma conta somente com email e nome
 * utilize a callback para chamar uma outra funcão ao retornar... sempre vai retornar um id, mesmo se existir
 *
 */
function createDrillAccount(name, email, avatar, ignore_email, callback){
    $.post("/users/drill_account", {name: name, email: email, avatar: avatar, ignore_email: ignore_email},function(data){callback(data);});
}
/*
 * Set next action
 */
$('.trigger_nextAction').click(function(){
   setPreferencesSession('next_action_global', $(this).attr('rel'));
});

var pSl = 0;
function initSlideShow(id_slideshow, qtd){
    //$('#slidSh_' + pSl).animate({top: "-=263"}, function(){$('#slidSh_' + pSl).css('top', '-263px')});
    $('#slidSh_' + pSl).hide();
    if(pSl < qtd -1){
        pSl++;} else{pSl = 0;}
    $('#slidSh_' + pSl).fadeIn(300);
    
    setTimeout(function(){initSlideShow('', qtd);}, 3000);
}

function initGaleriaModuloListener(component, isHtml5){
    var posImages = 0;
    $("#" + component + ' .thb_galeria').click(function(){
        var image = $(this).attr('data-image');var id_image = $(this).attr('data-idimage');
        if(!isHtml5) updateSlotProdutoPicture("/media/user/images/original/" + image, "M"+id_image, 400, 640, "ctnGlB" + id_image, "thumbs");
        if( isHtml5) $("#slot_pictureM"+id_image).attr("src", "/media/user/images/original/" + image);
    });
    
    $('#' + component + ' .ctnMainThumbs').mouseenter(function(){
        $('.ctn_base_button').fadeIn('300');
        if(posImages < 0) $('.ctn_top_button').fadeIn('300');
    }).mouseleave(function(){
        $('.ctn_base_button, .ctn_top_button').fadeOut('300');
    });
    
    $('#' + component + ' .ctn_base_button').click(function(){
        posImages = posImages - 140;
        $('#' + component +" .ctnMainThumbsImgs").animate({'top': posImages+'px'});
        $('.ctn_top_button').fadeIn('300');
    }); 
    
    $('#' + component + ' .ctn_top_button').click(function(){
        posImages = posImages + 140;if(posImages >= 0) {posImages = 0;$('.ctn_top_button').fadeOut('300');} 
        $('#' + component +" .ctnMainThumbsImgs").animate({'top': posImages+'px'});
    });
}

/*
 * Handles error messages
 * 
 */
function handleErrorMessage(value){
    
    //var size  = (Object.keys(value).length);
    var items = "<li class='it_error_main'>Os seguintes campos deve ser preenchidos</li>";
    
    for (var key in value) {
        if (value.hasOwnProperty(key)) {
            if(value[key] == '') items += "<li><span>O campo &nbsp;</span><span class='bold'>"+ key +"</span><span> deve ser preenchido</span></li>";
        }
    }
   
    $('#error_mandatory').empty().append(items);
    $('.message_errors').show();
}

/*
 * Metodo usado para trigar initial pluggin
 * 
 */
function loadMethodsAfterLoaded(){
    
    $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) { event.preventDefault(); $(this).ekkoLightbox(); });
    $('.carousel').carousel({interval: 4000});
    
    $('.seven_container').each(function(){
        var gal = $(this);
        var height = gal.attr('data-height');
        var height_full_screen = gal.attr('data-height-fullscreen') * 1;
        if(height_full_screen){ height = $(window.top).height()-150;};
        $("#" + gal.attr('id')).superseven({
                width: gal.attr('data-width'),
                height: height,
                autoplay: gal.attr('data-autoplay'),
                interval: (gal.attr('data-interval') * 1),
                fullwidth:(gal.attr('data-fullscreen') * 1),
                shadow:(gal.attr('data-shadow') * 1),
                caption:(gal.attr('data-caption') * 1),
                responsive:true,
                progressbar:true,
                swipe:false,
                keyboard:false,
                scrollmode:false,
                animation: (gal.attr('data-animation') * 1),
                navtype:0,
                repeat_mode:true,
                l_box: gal.attr('data-light-icon') * 1,
                play_icon: gal.attr('data-play-icon') * 1,
                skin: gal.attr('data-theme'),
                lightbox: (gal.attr('data-lightbox') * 1),
                pause_on_hover:false			
        });
    });
    
    if (typeof initListenerAfterLoaded == 'function') { initListenerAfterLoaded(); }
    
    
    $(".bt_link_banner_advertise").click(function(){$.post("/site/relatar/click",{id: $(this).attr('data-id')},function(data){ });});
    
    if($('#h_FullScreen').val() != undefined){
        var respAll = false;
        if($('#h_FullScreen').attr('data-resp-full') == '1' || (!$('#h_FullScreen').attr('data-resp-full') == '0' && $(window).width() > 1200)) respAll = true;       
        //if(respAll){$('#' + $('#h_FullScreen').attr('data-element')).css('height', ($(window.top).height() - $('#h_FullScreen').attr('data-diff')) + 'px');}
        
    } 
}

/*
 * Metodo usado para trigar initial pluggin
 * 
 */
function loadMethodsAfterLoadedTecnologia_0(){

    initAdvertisingListeners();    
    
    $("a[href$='.jpg'],a[href$='.png'],a[href$='.gif']").fancybox({
        'transitionIn'  :'elastic', 'transitionOut':'elastic','centerOnScroll': true, 'autoScale': true, 'speedIn': 300,'speedOut': 200, 'autoDimensions': false, 'overlayShow': true, 'titleShow' : false,'type' : 'image',
        'onStart':function(){
            $.fancybox.removeBackground();
	}
    });   
}

//Paralax
$(document).ready(function(){
   // cache the window object
   $window = $(window);
 
   $('section[data-type="background"]').each(function(){
     // declare the variable to affect the defined data-type
     var $scroll = $(this);
                     
      $(window).scroll(function() {
        // HTML5 proves useful for helping with creating JS functions!
        // also, negative value because we're scrolling upwards                            
        var yPos = -($window.scrollTop() / $scroll.data('speed'));
         
        // background position
        var coords = '50% '+ yPos + 'px';
 
        // move the background
        $scroll.css({ backgroundPosition: coords });   
      }); // end window scroll
   });  // end section function
}); // close out script

/* Create HTML5 element for IE */
document.createElement("section");










/***
****
**** HTML_COMPONENTS
***/




function initListenersComponent(){       

    var urlShare = "";//Declarado abaixo
    var contentV = "";//Declarado abaixo
    var urlImg   = "";//Declarado abaixo
    var vlink = document.location.href;

    $('.share_facebook_icon, .share_facebook').click(function(){
        contentV = "Compartilhe com seus amigos";
        if($(this).attr('rel') == 'simple') vlink = window.location.host;
        urlShare = "http://www.facebook.com/sharer.php?u=" + vlink + "&t=" + contentV;
        shareHeight = 340;
        shareWidth = 570;
        
        NewWindow(urlShare, "Sharing", shareWidth, shareHeight, 'no', "center");
    });
    
    $('.share_googleplus_icon, .share_googleplus').click(function(){
        contentV = "Compartilhe com seus amigos";
        if($(this).attr('rel') == 'simple') vlink = window.location.host;
        urlShare = "https://plus.google.com/share?url=" + vlink + "&t=" + contentV;
        shareHeight = 380;
        shareWidth = 500;
        
        NewWindow(urlShare, "Sharing", shareWidth, shareHeight, 'no', "center");
    });
    

    $('.share_twitter_icon, .share_twitter').click(function(){
        if($(this).attr('rel') == 'simple') vlink = window.location.host;
         contentV2 = $("#social_network_title").val();         
         urlShare = "http://twitter.com/share?url=" + vlink + "&text=" + contentV2;
         shareHeight2 = 400;
         shareWidth2 = 550;

         NewWindow(urlShare, "Sharing Twitter", shareWidth2, shareHeight2, 'no', "center");
    });

    $('.share_orkut_icon, .share_orkut').click(function(){
         contentT3 = $("#social_network_title").val();
         contentV3 = $("#social_network_description").val();
         urlLink3 =  vlink;
         urlImg = $("#social_network_image").val();
         urlShare = "http://promote.orkut.com/preview?nt=orkut.com&tt=" + contentT3 + "&cn=" + contentV3 + "&du=" + urlLink3+ "&tn=" + urlImg;
         shareHeight3 = 400;
         shareWidth3 = 650;

         NewWindow( urlShare,  "Sharing Orkut", shareWidth3, shareHeight3, 'no', "center");
    });
    
    $('.share_linkedin_icon, .share_linkedin').click(function(){
         contentT3 = $("#social_network_title").val();
         contentV3 = $("#social_network_description").val();
         if($(this).attr('rel') == 'simple') vlink = window.location.host;
         urlShare = "http://www.linkedin.com/shareArticle?mini=true&url=" + vlink + '&title=' +  contentT3 + "&summary=" + contentV3;
         shareHeight3 = 510;
         shareWidth3 = 840;

         NewWindow( urlShare,  "Sharing LinkedIn", shareWidth3, shareHeight3, 'no', "center");
    });
   

    $('.share_mail_icon, .share_mail').click(function() {
         showPopUp("modulo", "indique_amigo", "indique_amigo_common", 485,  280, false);
    });

    $('.share_error_icon, .share_error').click(function() {            
        showPopUp("modulo", "relatar_erro", "error_simple",  495, 310, false);
    });
    
    $('.post_status').click(function() {            
        showPopUp("modulo", "form", "inhamer_post", 445, 260, false);
    });

    $('.google_maps_icon').click(function(){
         urlMap = "site/app/googlemaps";
         mapHeight = 450;
         mapWidth = 600;
         NewWindow( urlMap,  "GoogleMaps", mapWidth, mapHeight, 'no', "center");
    });


    $('.icon_shortUrl_copy').click(function(){             
         showPopUp("message", "copy_done", "message_simple", 350, 30, false);
     });

    //General button for all kind of newsletter's submit
    $('.submit_newsletter').click(function() {            
        submitNewsletter();             
    });
    
    //General button for a special kind of searchbar
    $('.searchbox_button').click(function(){
        
        $("form").submit(function(e){e.preventDefault();});       
        var searchVal = $(".search_field_input").val();
        var type = $(this).attr('data-type');
       
        if(searchVal != ''){            
            searchVal = searchVal.replace(/ /g, '+');          
            window.location = "/buscar/" + type + "/" + searchVal;
        }    
    });
    
    //This action get the keyboard event 13 = ENTER
    //If the user press ENTER it's the same to click on the button buscar
    $('body').keyup(function(event){
        if(event.keyCode == '13'){
            if($(".search_field_input").focus()) $('.searchbox_button, .searchbar_button').trigger('click');
        }
    });
    
    //General button for a special kind of searchbar
    $('.searchbar_button').click(function(){            
        submitSearch();             
    });
    //Calcula frete
    $('.calcula_frete').keyup(function(){
        if($(this).val().length > 8) calculateFrete($(this).val(), $(this).attr('rel'));             
    }); 
    //
    //PS: Follow the parameters bellow: 
    //@tipo - componente, inscricao, modulo
    //@folder - categoria do objeto selecionado acima
    //@layout - qual layout do componente ou modulo será carregado
    //@width - largura do popUp
    //@height - altura do popUp
    //@action - se deve carregar ou redirecionar depois de logado por exemplo.
    //It's used for business submit
    $(".submit_user_business, .login_component_nao_cadastrado").on('click',function(){            
        showPopUp("componente", "form_submit", "cadastrar_business", 850, 360, false);
    });
    
    $(".submit_action_if_logged").on('click',function(){ 
        if(!isLoggedIn){
            showPopUp("componente", "form_submit", "cadastrar_business", 850, 360, false);
        }else{
            window.location = $(this).attr('data-action');
        }
    });
    
    $(".submit_user_company_full").click(function(){            
        showPopUp("componente", "form_submit", "cadastro_full_company", 850, 420, false);
    });
    
    $(".submit_user_business_4_passos").click(function(){            
        showPopUp("cadastro_user", "form_submit", "cadastro_4_passos_company", 850, 360, false);
    });
    
    $(".login_component_esqueci_senha").click(function(){            
        showPopUp("modulo","form", "esqueci_senha_popup", 480, 200, false);
    });

    //It's used for signup business submit
    $(".submit_event_signup").click(function(e){
        var link_externo = $("#hiperlink_event_" + this.name).val();
        if(link_externo == "" || link_externo == 'undefined' || link_externo == undefined){
            $.post("/site/relatar/set_session_data",{label: 'eventoId', value: $(this).attr('name')},function(data){});
            setTimeout(function(){
                $("#helper_next_action_purple").val($(e.target).attr('alt')).attr('name', "inscricao").attr('alt', "inscricao");
                showPopUp("inscricao", "inscricao", $(e.target).attr('alt'), 850, 360, true);
            }, 1000);
            
        }else{
            //window.location = link_externo;
            window.open(link_externo, '_blank'); 
        }    
        
        parent.$("#helper_title_event").attr('name',this.alt);
        parent.$("#helper_title_event").attr('title',this.name);
    });

    //It's used for signup business submit
    $(".submit_associar").click(function(){
        showPopUp("modulo","form", "associate_half_popup", 500, 250, false);
    });
    
    //It's used to show a popup description
    $(".popup_description").click(function(){
        var heightPopUP = $(this).attr('name') * 1;
        var widthPopUP = $(this).attr('alt') * 1;
        
        showPopUp("description", this.id, "exibir_content_common_popup",  widthPopUP, heightPopUP, false);
        
    });

    //PS: Dentro do login area existe uma requisão deste método também
    $(".bt_home").click(function(){            
        window.location = "/home";
    });

    //PS: Dentro do login area existe uma requisão deste método também
    $(".bt_facebook_profile").click(function(){ 
        var facebookProfile = $("#helper_socialNetWorkProfile").val();
        window.open("http://www.facebook.com/" + facebookProfile, "_blank");
    });
    
    //PS: Dentro do login area existe uma requisão deste método também
    $(".bt_youtube_profile").click(function(){ 
        var youtubeProfile = $("#helper_socialNetWorkProfile").attr("data-youtube");
        window.open("http://www.youtube.com/channel/" + youtubeProfile, "_blank");
    });
    

    //PS: Dentro do login area existe uma requisão deste método também
    $(".bt_twitter_profile").click(function(){ 
        var twitterProfile = $("#helper_socialNetWorkProfile").attr("name");
        window.open("http://twitter.com/#!/" + twitterProfile, "_blank");
    });

    //PS: Dentro do login area existe uma requisão deste método também
    $(".bt_linkedin_profile").click(function(){
        var linkedinProfile = $("#helper_socialNetWorkProfile").attr("alt");
        window.open("http://www.linkedin.com/company/" + linkedinProfile, "_blank");
    });
    
    //PS: Dentro do login area existe uma requisão deste método também
    $(".bt_orkut_profile").click(function(){
        var orkutProfile = $("#helper_socialNetWorkProfile").attr("class");
        window.open("http://www.linkedin.com/company/" + orkutProfile, "_blank");
    });

    $('#font_increase').click(function() {
        fontSize++;
        $(".textMateria, .textMateriaItem").css("font-size", fontSize + "pt");            
    });

    $('#font_decrease').click(function() {
        fontSize--;
        $(".textMateria, .textMateriaItem").css("font-size", fontSize + "pt");            
    });

    $('#font_regular').click(function() {
        fontSize = 12;
        $(".textMateria, .textMateriaItem").css("font-size", fontSize + "pt");            
    });
    
    //Carrinho de compras
    $('.cart_container_shopping, .bt_ShoppingCart').click(function(){
        if(!isCartItemsShowed){
            
            //Verifica se tem itens no carrinho
            if($("#amount_shopping_cart").text() != "0" && $("#amount_shopping_cart").text() != "0 item(s) - R$0,00"){
                $(".item_sh_c").show();
                $(".container_items_shopping_cart").fadeIn("fast");
                $("#bt_payment_shopping_cart").show();
                $(".bt_loja_limpar_lista").show();
            }
            
            isCartItemsShowed = true;
        }else{
            $(".item_sh_c").hide();
            $(".container_items_shopping_cart").fadeOut("fast");
            //Verifica se tem itens no carrinho
            if($("#amount_shopping_cart").text() > 0){
                $("#bt_payment_shopping_cart").hide();
                $(".bt_loja_limpar_lista").hide();
            }
            isCartItemsShowed = false;
        }
    });
    
    //Botão de pagamento do carrinho de compras
    $('#bt_payment_shopping_cart, .bt_payment_shopping_cart').on('click', function(){
        
        if($(this).attr('rel') == 'one_click'){
            buyItem($(this).attr('data-variante'), "produto", this.alt, "pagamento");            
        }else{
            window.location = "http://" + window.location.hostname + "/pagamento";            
        }
    });
    
    $('#bt_clear_cart, .bt_clear_cart').click(function(){
        $.post("/loja/limpar",{
            empty: empty
        },function(data){
            $("#items_shopping_cart").empty();       
            $("#amount_shopping_cart").empty().text(0);   
            $("#bt_payment_shopping_cart").hide();
            $(".bt_loja_limpar_lista").hide();
            $("#items_shopping_cart").append("<div class='item_sh_c_empty'>Nenhum item adicionado</div>");
            $(".container_items_shopping_cart").hide();
            $(".amount_items_shopping_cart").empty().text('0 item(s) - R$0,00');
        });          
    });
    
    $('#bt_facebooklikebox').click(function(){
        if(!fbLikBoxVis){$('#facebookLikeBox').animate({'right': '0px'}, function(){fbLikBoxVis = true;});}
        if( fbLikBoxVis){$('#facebookLikeBox').animate({'right': '-301px'}, function(){fbLikBoxVis = false;});}
    });
    
    $(".bt_cat_retratil").click(function(){
       $('#cat_items_c' + $(this).attr('data-id')).toggle();
    });
    
    $(".bt_subcat_retratil").click(function(){
       $('#subcat_items_s' + $(this).attr('data-id')).toggle();
    }); 
    

    
    //It handles the Pessoa Jurídica form
    $('.bt_continue_newsletter').click(function(){
  
        var isValidNewsletter = true;
        
        if($("#email_newsletter").val() == ""){
           $("#email_newsletter").attr('placeholder', "E-mail deve ser preenchido");
           isValidNewsletter = false;
        }
        
        if($("#name_newsletter").val() == "" && $("#name_newsletter").val() != " "){
           $("#name_newsletter").attr('placeholder', "Nome deve ser preenchido");
           isValidNewsletter = false;
        }
        
        if(isValidNewsletter && !pressNewsLetterSend){
            
            pressNewsLetterSend = true;
            var email_newsletter = $("#email_newsletter").val();
            var name_newsletter  = $("#name_newsletter").val();
            
            $(".message_newsletter_input").empty().append("<div class='bg-info mgB'>Enviando...</div>"); 

            $.post("/email/newsletter",{
                email: email_newsletter,            
                nome: name_newsletter

            },function(data){
                var jsonObject = eval('(' + data + ')');                
                $(".subtitle_newsletter").hide();
                $("#container_newsletter_fields_1").hide();
                $(".container_newsletter_success").fadeIn("slow");
                $(".message_newsletter_input").empty().append("<div class='bg-success mgB'>"+ jsonObject['message'] + "</div>"); 
                pressNewsLetterSend = false;
            }); 
        }      
    });
    
    $('#bt_check_domain').click(function(){             
         window.location = "/registros?dominio=" + $("#dominio_input").val() + "." + $("#dominio_input_sufixo").val();
    });
     
    $('#bt_check_domain_whois').click(function(){             
         window.location = "/registros/whois?dominio=" + $("#dominio_input").val() + "." + $("#dominio_input_sufixo").val() + "&extensao=" + $("#dominio_input_sufixo").val();
    });
    
    $("#bt_menu_resp_retratil").click(function(){$("#menu_resp_retratil").toggle();});
    $(".bt_searchCtnSolid").click(function(){$(".searchCtnSolid").toggle();});
    
    $("body").on('click', '.bt_login_logar', function(){
        
        var id_form = $(this).attr('data-id-form');
        $("#" + id_form + " .login_component_message").empty();
        var user_log_in = $("#" + id_form + " .login_conta_user").val();
        var pass_log_in = $("#" + id_form +" .login_conta_senha").val();
        
        if(user_log_in != '' && pass_log_in != ''){
            $.post("/admin/login",{
               loginAcessoUser: user_log_in,
               loginAcessoSenha: MD5(pass_log_in),
               loginNextAction: "",
               loginPermitir: $("#" + id_form + " .login_permacer").is(':checked')

            },function(data){

                var jsonObject = eval('(' + data + ')');
                if(jsonObject['logado'] == '1'){        

                   $(".user_avatar_picture").attr("src", jsonObject['avatar']);
                   $(".login_signed_name").empty().append(jsonObject['user']);
                   $(".login_container_signed").fadeIn("fast");
                   window.location = "http://" + window.location.hostname + "/conta/home";
                   //$("#topo_osiris").submit();

                }else{
                    $("#" + id_form + " .login_conta_user").val("").attr("placeholder", 'Usuário ou senha inválida');
                    $("#" + id_form + " .login_component_message").empty().append("<div class='bg-danger mgB'>Senha ou usuário inválido!</div>");                   
                }

            });
        }else{
            if(user_log_in == '') $("#" + id_form + " .login_conta_user").attr('placeholder', 'Digite user');
            if(pass_log_in == '') $("#" + id_form + " .login_conta_senha").attr('placeholder', 'Digite senha');
        }
    });
    
    //Sob Consulta
    $(".bt_consultar").click(function(){
       $('#title_consultar').text($(this).attr('data-item')).attr('data-title', $(this).attr('data-item')).attr('data-id', $(this).attr('data-item'));
       $("#formSobConsulta #id_sob_consulta").val($(this).attr('data-id')); $("#formSobConsulta #titulo_sob_consulta").val($(this).attr('data-item'));
       $(".bt_consultar_prod_id").attr('id', "cart_" + $(this).attr('data-id')).attr('data-id-produto', $(this).attr('data-id')).attr('data-valor', $(this).attr('data-valor'));
    });
    
    $(".bt_enviar_consulta").click(function(){
        var email = $("#email_sob_consulta").val(); 
        $("#output_sob_consulta").empty().append("<div class='bg-info mgB'>Enviando...</div>");
        if(email != ''){
           $.post("/site/submit/sob_consulta",{
                email: email,
                data: $("#formSobConsulta").serialize()
            },function(data){$("#output_sob_consulta").empty().append("<div class='bg-success mgB'>Interesse enviado com sucesso!</div>");}); 
        }else{
            $("#output_sob_consulta").empty().append("<div class='bg-danger mgB'>Todos os campos devem ser preenchidos</div>");
        }
    });
    
    $(".bt_shopping_cart_global").click(function(){
        addItemToCart($(this).attr('data-id-variante'), $(this).attr('data-tipo'), $(this).attr('data-id-produto'), 'sob_consulta', $(this).attr('data-valor'));
    });
    
    //PierAutos
    $('#bt_autos_search').click(function(){$('form#form-search_autos').submit();});
    $(".fabricantes_pier_autos").change(function(){
        $.post("/autos/load_modelos", {id: $(this).val()},function(data){var jsonObject = eval('(' + data + ')');$("#modelo_loader").empty().append(jsonObject['view']);});
    });
   
}


/*
 * It calls the google maps from the falsh buttons
 * It's the same the method above;
 * 
 */
function callGoogleMapsFromFlash(){

    urlMap = "site/app/googlemaps";
    mapHeight = 480;
    mapWidth = 640;

    NewWindow( urlMap,  "GoogleMaps", mapWidth, mapHeight, 'no', "center");
}

/*
 * It submits the newsletter form.
 * Just a e-mail is needed. 
 * 
 */
function submitNewsletter(){

    var e_mail = $(".email_newsletter").val();
    $(".message_newsletter_input").empty().append("<div class='bg-info mgB'>Enviando...</div>"); 

    $.post("/admin/newsletter/cadastrar",{
        email: e_mail
    },function(data){
        $(".email_newsletter").val("");
        $(".message_newsletter_input").empty().append("<div class='bg-success mgB'>"+ data+ "</div>");           
    });
}

/*
 * It submits a search into website
 * or Purplepier System 
 * 
 */
function submitSearch(){

    var search = $(".search_input").val();
    
    if(search != ""){
        window.location = "/buscar/interesse/" + search;
    }
}

//Updates the main pan height
function updateSearchCanvas(){        
    var height_pan = ($(".container_pan_buscar").height() + 80) + "px";        
    $(".pan").css("height", height_pan);        
}

/*
 * This method verifies if the user is logged in.
 * It shows the correct animation.
 * 
 */
function verifyIfIsLogged(){ 
    
    /*
    //Initate the loggin off;
    $(".login_container_login").css("display", "none");

    $.post("/site/login/verificar",{
        empty: empty
    },function(data){           
        var jsonObject = eval('(' + data + ')');
  
        if(jsonObject['logado'] == '1'){
            $(".login_signed_name").empty().append(jsonObject['user']);
            $(".user_avatar_picture").attr("src", jsonObject['avatar']);
            $(".login_container_login, .ctn_login_hide_show, .login_container_Simple").css("display", "none");//Bug fix Chrome
            $(".login_container_signed, .login_signed_Simple").fadeIn("fast");
            $(".bt_menu_conta_site").fadeIn("slow");
            setTimeout("initLoginListenersButtons()", 1000);
            isLoggedIn = true;
            profileLevel = jsonObject['profile_level'];

        }else if(jsonObject['logado'] == 2){                
            window.location = "/home";            
        }else{                
            $(".login_container_login").css("display", "block");
            //Its a rich HTML component
            //See the methods bellow
            //launchLoginArea();
        }
    });
    */
}

/*
 * This method verifies if there are items
 * into shopping cart
 * 
 */
function verifyShoppingCartItems(){
    /*
    $.post("/loja/verificar",{
        tipo: "produto"
    },function(data){
   
        var jsonObject = eval('(' + data + ')');
        
        if(jsonObject['amount'][0]['SUM(amount)'] > 0){
         
            var items_sc = "";            
            //Avoid some problems with blank
            $(".shopping_cart_compontent_html").hide();
            
            $("#items_shopping_cart").empty();
            for(i = 0; i < jsonObject['items'].length; i++){
                items_sc  = "<div class='item_sh_c'>";
                items_sc += "<div class='item_sh_c_qtd'>" + jsonObject['items'][i]['amount'] + "</div>";
                items_sc += "<div class='item_sh_c_name truncate'>" + jsonObject['items'][i]['nome'] + "</div>";
                items_sc += "<div class='item_sh_c_value'>" + jsonObject['items'][i]['valor_format'] + "</div>";
                items_sc += "</div>";
                $("#items_shopping_cart").append(items_sc);
            }
            // Add subtotal
            items_sc = "<div class='item_sh_c_total'>" + jsonObject['total_format'] + "</div>";
            $("#items_shopping_cart").append(items_sc);
            
            $(".bt_shopping_cart_pay_it").css("display", "block");
            $(".shopping_cart_compontent_html").fadeIn("fast");
            $("#amount_shopping_cart").empty().text(jsonObject['amount'][0]['SUM(amount)']);
            $("#amount_shopping_cart_complete").empty().text(jsonObject['amount'][0]['SUM(amount)']+" items(s) - "+ jsonObject['total_format']);
        }      
    });
    */
}

/*
 * This method verifies if there are credits
 * into shopping cart
 * 
 */
function verifyShoppingCartCredits(tipo){

    /*
    $.post("/loja/verificar",{
        tipo: tipo
    },function(data){
        
        var jsonObject = eval('(' + data + ')');
        
        if(jsonObject['amount'][0]['SUM(amount)'] > 0){
            var items_sc = "";
            $("#items_credits_container").empty();
            for(i = 0; i < jsonObject['items'].length; i++){
                items_sc  = "<div class='item_cred_c' id='obj_item_" + jsonObject['items'][i]['id'] + "'>";
                items_sc += "<div class='item_cred_c_name'>" + jsonObject['items'][i]['nome'] + "</div>";
                items_sc += "<div class='item_cred_c_value'>" + jsonObject['items'][i]['valor_format'] + "</div>";
                items_sc += "<input class='item_cred_c_bt_close' id='item_"+jsonObject['items'][i]['id']+"' type='button'/>";
                items_sc += "</div>";
                $("#items_credits_container").append(items_sc);
            }    
            
            $(".bt_line_transparent").show();  
            $("#amount_cart_credits").empty().text(jsonObject['amount']['valor_format']);            
            $(".amount_subtotal_credits").empty().text("Subtotal - " + jsonObject['amount']['valor_format']); 
        }

        $(".amount_user_credits").empty().text(jsonObject['user']['credit_User_format']); 
        $(".amount_value_credits, #amount_cart_credits").empty().text(jsonObject['amount']['valor_format']);             
        $("#helper_amount_total").val(jsonObject['total_no_prefix']);
    });
    */
    
    
}


/*
 * This method log out the user
 * 
 */
function logOut(){

    var local_logout = $("#helper_local_logout").val();        
    $.post("/admin/logout", {
        action: local_logout
    },function(data){

        $(".login_container_signed, .login_signed_Simple").animate({width: "hide"},{duration: "500"});
        $(".login_container_login, .login_container_Simple").animate({width: "show"},{duration: "1000"});
        $(".bt_menu_conta_site").fadeOut("slow");
        isLoggedIn = false;

        if(data == "Logout redirect"){
            window.location = "http://" + window.location.hostname + "/home";
        }           
    });
}

/*
 * Set item to whish list
 * Type: pode ser um produto, evento, banner, imagem,  etc
 */
$('.bt_whish_list').click(function(){
   $.post("/site/relatar/add_wish_list", {id: this.id, type: $(this).attr('rel')},
        function(data){var jObj = eval('(' + data + ')');
            showPopUp("toast", jObj['message'],  'message_simple', 400, 30, false);});
});

/*
 * Set item to comparsion list
 */
$('.bt_compare_item').click(function(){
   $.post("/site/relatar/add_comparison_list", {id: this.id, type: $(this).attr('rel')},
        function(data){var jObj = eval('(' + data + ')');
            if(jObj['qtd'] > 1 && !jObj['is_added']){
               window.location = "/loja/comparar"; 
            }else{
                showPopUp("toast", jObj['message'],  'message_simple', 400, 30, false);
            }
     });   
});

/*
 * Main listeners for login components
 * 
 */
function initLoginListenersButtons(){

    $('.login_sair_conta').on('click', function(){            
        logOut();
    }); 

    $('.login_minha_conta').on('click', function(){            
        window.location =  "/conta/home";
    });
}

/*
 * Triggers a click for the listeners listed above:
 * 
 * 
 * PS: It works together the method launchLinkPurplePier(); from 
 * the main.js 
 * 
 */
function openPopUp(link){
   
    switch(link){
    
        case "!popup_associese":
            $(".submit_associar").trigger('click');
            break;        
        
        case "!popup_publicidade":
            showPopUp("modulo","form", "advertise_interest_half_popup", 500, 280, false);
            break;
        
        case "!popup_payment_needed":
            showPopUp("modulo","form", "payment_needed", 530, 180, false);
            break;
            
        case "!popup_action_complete":
            showPopUp("modulo","form", "action_complete", 530, 180, false);
            break;
        case "!popup_action_incomplete":
            showPopUp("modulo","form", "action_incomplete", 530, 180, false);
            break;
            
        case "!popup_esqueci_senha":
            showPopUp("modulo","form", "esqueci_senha_popup", 480, 200, false);
            break;
            
        case "!popup_reputation":
            showPopUp("modulo","reputation", "reputation_user", 430, 150, false);           
            break;
            
        case "!popup_cadastrar-se":
            showPopUp("componente", "form_submit", "cadastrar_business", 850, 360, false);           
            break;
        case "!popup_logar":
            showPopUp("componente", "form_submit", "logar_popup", 340, 300, false);           
            break;
    }
    
}

/*
* Add masks and focus components 
*
*/
function calculateFrete(cep, id_produto){
    
    $.post("/loja/calcula_frete",{        
        cep_to: cep,
        id_produto: id_produto
        
    },function(data){
        //It transforms the returned json array in an object
        var jsonObject = eval('(' + data + ')');
        
        if(jsonObject['sedex']['prazo'][0] == '' || jsonObject['sedex']['prazo'][0] == undefined) jsonObject['sedex']['prazo'][0] = "1";
        if(jsonObject['pac']['prazo'][0] == '' || jsonObject['pac']['prazo'][0] == undefined) jsonObject['pac']['prazo'][0] = "3";
        
        $("#sedex_value").text(setCurrency(jsonObject['sedex']['valor'], true));
        $("#pac_value").text(setCurrency(jsonObject['pac']['valor'], true));
        
        $("#sedex_prazo").text("Cerca de  " + jsonObject['sedex']['prazo'][0] + " dias úteis.");
        $("#pac_prazo").empty().append("Cerca de  <b>" + jsonObject['pac']['prazo'][0] + "</b> dias úteis.");
        
        $("#transport_sedex").attr('alt', jsonObject['sedex']['valor']);
        $("#transport_pac").attr('alt', jsonObject['pac']['valor']);
        $('#ctn_shipping').fadeIn();
        
    });
}

/*
 * Animation the preloader bar
 * Just moving
 *
 */
var countPreloader = 0;
function loadingPreloader(){
    if(countPreloader > 5) countPreloader = 0;
    $("#preloader_loaderbar").css("background-position", countPreloader + "px 0px");
    countPreloader++;    
}

function startPreloaderAnimation(){
    id_interval = setInterval("loadingPreloader()", 300);
}

function removePreloaderAnimation(){
    clearInterval(id_interval);
}

function initOrcamentusListeners(){
    
    $("#bt_orcamentus_step_1").click(function(){
        if($("#orcamentus_cp_titulo").val() != ""){
            $('#orcamentus_step_1').hide(); $('#orcamentus_step_2').show(); 
            $("#orcamentus_cp_output").empty();
        }else{
            $("#orcamentus_cp_output").empty().append("<div class='bg-danger mgB2'>Preencha o campo título</div>");
        }
        
    });
    $("#bt_orcamentus_step_2").click(function(){
        
        if($("#orcamentus_cp_nome").val() != "" && $("#orcamentus_cp_email").val() != ""){
            $("#orcamentus_cp_output2").empty();
            $.post("/email/orcamentus",{
                email: $("#orcamentus_cp_email").val(),
                data: $("form#form_cp_orcamentus").serialize()

            },function(data){
                //It transforms the returned json array in an object
                var jsonObject = eval('(' + data + ')');
                $('#orcamentus_cp_output2').empty().append("<div class='bg-success mgB'>" + jsonObject['message'] + "</div>");

                if(typeof _gaq !== 'undefined') _gaq.push(['_trackPageview', '/site/submit/orcamentus_pedido']);
                if(typeof dataLayer !== 'undefined') dataLayer.push({'event':'sendVirtualPageview','vpv':'/site/submit/orcamentus_pedido'});
                $("#orcamentus_cp_nome, #orcamentus_cp_email, #orcamentus_cp_celular, #orcamentus_cp_titulo, #orcamentus_cp_descricao").val("");
            });
            
        }else{
            $("#orcamentus_cp_output2").empty().append("<div class='bg-danger mgB2'>Preencha os campos: nome e e-mail</div>");
        }
        
    });
    $("#bt_orcamentus_back_step_1").click(function(){
        $('#orcamentus_step_2').hide(); $('#orcamentus_step_1').show(); 
        $("#orcamentus_cp_output").empty();
    });
}


/**
*
*  MD5 (Message-Digest Algorithm)
*  http://www.webtoolkit.info/
*
**/
 
var MD5 = function (string) {
 
	function RotateLeft(lValue, iShiftBits) {
		return (lValue<<iShiftBits) | (lValue>>>(32-iShiftBits));
	}
 
	function AddUnsigned(lX,lY) {
		var lX4,lY4,lX8,lY8,lResult;
		lX8 = (lX & 0x80000000);
		lY8 = (lY & 0x80000000);
		lX4 = (lX & 0x40000000);
		lY4 = (lY & 0x40000000);
		lResult = (lX & 0x3FFFFFFF)+(lY & 0x3FFFFFFF);
		if (lX4 & lY4) {
			return (lResult ^ 0x80000000 ^ lX8 ^ lY8);
		}
		if (lX4 | lY4) {
			if (lResult & 0x40000000) {
				return (lResult ^ 0xC0000000 ^ lX8 ^ lY8);
			} else {
				return (lResult ^ 0x40000000 ^ lX8 ^ lY8);
			}
		} else {
			return (lResult ^ lX8 ^ lY8);
		}
 	}
 
 	function F(x,y,z) { return (x & y) | ((~x) & z); }
 	function G(x,y,z) { return (x & z) | (y & (~z)); }
 	function H(x,y,z) { return (x ^ y ^ z); }
	function I(x,y,z) { return (y ^ (x | (~z))); }
 
	function FF(a,b,c,d,x,s,ac) {
		a = AddUnsigned(a, AddUnsigned(AddUnsigned(F(b, c, d), x), ac));
		return AddUnsigned(RotateLeft(a, s), b);
	};
 
	function GG(a,b,c,d,x,s,ac) {
		a = AddUnsigned(a, AddUnsigned(AddUnsigned(G(b, c, d), x), ac));
		return AddUnsigned(RotateLeft(a, s), b);
	};
 
	function HH(a,b,c,d,x,s,ac) {
		a = AddUnsigned(a, AddUnsigned(AddUnsigned(H(b, c, d), x), ac));
		return AddUnsigned(RotateLeft(a, s), b);
	};
 
	function II(a,b,c,d,x,s,ac) {
		a = AddUnsigned(a, AddUnsigned(AddUnsigned(I(b, c, d), x), ac));
		return AddUnsigned(RotateLeft(a, s), b);
	};
 
	function ConvertToWordArray(string) {
		var lWordCount;
		var lMessageLength = string.length;
		var lNumberOfWords_temp1=lMessageLength + 8;
		var lNumberOfWords_temp2=(lNumberOfWords_temp1-(lNumberOfWords_temp1 % 64))/64;
		var lNumberOfWords = (lNumberOfWords_temp2+1)*16;
		var lWordArray=Array(lNumberOfWords-1);
		var lBytePosition = 0;
		var lByteCount = 0;
		while ( lByteCount < lMessageLength ) {
			lWordCount = (lByteCount-(lByteCount % 4))/4;
			lBytePosition = (lByteCount % 4)*8;
			lWordArray[lWordCount] = (lWordArray[lWordCount] | (string.charCodeAt(lByteCount)<<lBytePosition));
			lByteCount++;
		}
		lWordCount = (lByteCount-(lByteCount % 4))/4;
		lBytePosition = (lByteCount % 4)*8;
		lWordArray[lWordCount] = lWordArray[lWordCount] | (0x80<<lBytePosition);
		lWordArray[lNumberOfWords-2] = lMessageLength<<3;
		lWordArray[lNumberOfWords-1] = lMessageLength>>>29;
		return lWordArray;
	};
 
	function WordToHex(lValue) {
		var WordToHexValue="",WordToHexValue_temp="",lByte,lCount;
		for (lCount = 0;lCount<=3;lCount++) {
			lByte = (lValue>>>(lCount*8)) & 255;
			WordToHexValue_temp = "0" + lByte.toString(16);
			WordToHexValue = WordToHexValue + WordToHexValue_temp.substr(WordToHexValue_temp.length-2,2);
		}
		return WordToHexValue;
	};
 
	function Utf8Encode(string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";
 
		for (var n = 0; n < string.length; n++) {
 
			var c = string.charCodeAt(n);
 
			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}
 
		}
 
		return utftext;
	};
 
	var x=Array();
	var k,AA,BB,CC,DD,a,b,c,d;
	var S11=7, S12=12, S13=17, S14=22;
	var S21=5, S22=9 , S23=14, S24=20;
	var S31=4, S32=11, S33=16, S34=23;
	var S41=6, S42=10, S43=15, S44=21;
 
	string = Utf8Encode(string);
 
	x = ConvertToWordArray(string);
 
	a = 0x67452301; b = 0xEFCDAB89; c = 0x98BADCFE; d = 0x10325476;
 
	for (k=0;k<x.length;k+=16) {
		AA=a; BB=b; CC=c; DD=d;
		a=FF(a,b,c,d,x[k+0], S11,0xD76AA478);
		d=FF(d,a,b,c,x[k+1], S12,0xE8C7B756);
		c=FF(c,d,a,b,x[k+2], S13,0x242070DB);
		b=FF(b,c,d,a,x[k+3], S14,0xC1BDCEEE);
		a=FF(a,b,c,d,x[k+4], S11,0xF57C0FAF);
		d=FF(d,a,b,c,x[k+5], S12,0x4787C62A);
		c=FF(c,d,a,b,x[k+6], S13,0xA8304613);
		b=FF(b,c,d,a,x[k+7], S14,0xFD469501);
		a=FF(a,b,c,d,x[k+8], S11,0x698098D8);
		d=FF(d,a,b,c,x[k+9], S12,0x8B44F7AF);
		c=FF(c,d,a,b,x[k+10],S13,0xFFFF5BB1);
		b=FF(b,c,d,a,x[k+11],S14,0x895CD7BE);
		a=FF(a,b,c,d,x[k+12],S11,0x6B901122);
		d=FF(d,a,b,c,x[k+13],S12,0xFD987193);
		c=FF(c,d,a,b,x[k+14],S13,0xA679438E);
		b=FF(b,c,d,a,x[k+15],S14,0x49B40821);
		a=GG(a,b,c,d,x[k+1], S21,0xF61E2562);
		d=GG(d,a,b,c,x[k+6], S22,0xC040B340);
		c=GG(c,d,a,b,x[k+11],S23,0x265E5A51);
		b=GG(b,c,d,a,x[k+0], S24,0xE9B6C7AA);
		a=GG(a,b,c,d,x[k+5], S21,0xD62F105D);
		d=GG(d,a,b,c,x[k+10],S22,0x2441453);
		c=GG(c,d,a,b,x[k+15],S23,0xD8A1E681);
		b=GG(b,c,d,a,x[k+4], S24,0xE7D3FBC8);
		a=GG(a,b,c,d,x[k+9], S21,0x21E1CDE6);
		d=GG(d,a,b,c,x[k+14],S22,0xC33707D6);
		c=GG(c,d,a,b,x[k+3], S23,0xF4D50D87);
		b=GG(b,c,d,a,x[k+8], S24,0x455A14ED);
		a=GG(a,b,c,d,x[k+13],S21,0xA9E3E905);
		d=GG(d,a,b,c,x[k+2], S22,0xFCEFA3F8);
		c=GG(c,d,a,b,x[k+7], S23,0x676F02D9);
		b=GG(b,c,d,a,x[k+12],S24,0x8D2A4C8A);
		a=HH(a,b,c,d,x[k+5], S31,0xFFFA3942);
		d=HH(d,a,b,c,x[k+8], S32,0x8771F681);
		c=HH(c,d,a,b,x[k+11],S33,0x6D9D6122);
		b=HH(b,c,d,a,x[k+14],S34,0xFDE5380C);
		a=HH(a,b,c,d,x[k+1], S31,0xA4BEEA44);
		d=HH(d,a,b,c,x[k+4], S32,0x4BDECFA9);
		c=HH(c,d,a,b,x[k+7], S33,0xF6BB4B60);
		b=HH(b,c,d,a,x[k+10],S34,0xBEBFBC70);
		a=HH(a,b,c,d,x[k+13],S31,0x289B7EC6);
		d=HH(d,a,b,c,x[k+0], S32,0xEAA127FA);
		c=HH(c,d,a,b,x[k+3], S33,0xD4EF3085);
		b=HH(b,c,d,a,x[k+6], S34,0x4881D05);
		a=HH(a,b,c,d,x[k+9], S31,0xD9D4D039);
		d=HH(d,a,b,c,x[k+12],S32,0xE6DB99E5);
		c=HH(c,d,a,b,x[k+15],S33,0x1FA27CF8);
		b=HH(b,c,d,a,x[k+2], S34,0xC4AC5665);
		a=II(a,b,c,d,x[k+0], S41,0xF4292244);
		d=II(d,a,b,c,x[k+7], S42,0x432AFF97);
		c=II(c,d,a,b,x[k+14],S43,0xAB9423A7);
		b=II(b,c,d,a,x[k+5], S44,0xFC93A039);
		a=II(a,b,c,d,x[k+12],S41,0x655B59C3);
		d=II(d,a,b,c,x[k+3], S42,0x8F0CCC92);
		c=II(c,d,a,b,x[k+10],S43,0xFFEFF47D);
		b=II(b,c,d,a,x[k+1], S44,0x85845DD1);
		a=II(a,b,c,d,x[k+8], S41,0x6FA87E4F);
		d=II(d,a,b,c,x[k+15],S42,0xFE2CE6E0);
		c=II(c,d,a,b,x[k+6], S43,0xA3014314);
		b=II(b,c,d,a,x[k+13],S44,0x4E0811A1);
		a=II(a,b,c,d,x[k+4], S41,0xF7537E82);
		d=II(d,a,b,c,x[k+11],S42,0xBD3AF235);
		c=II(c,d,a,b,x[k+2], S43,0x2AD7D2BB);
		b=II(b,c,d,a,x[k+9], S44,0xEB86D391);
		a=AddUnsigned(a,AA);
		b=AddUnsigned(b,BB);
		c=AddUnsigned(c,CC);
		d=AddUnsigned(d,DD);
	}
 
	var temp = WordToHex(a)+WordToHex(b)+WordToHex(c)+WordToHex(d);
 
	return temp.toLowerCase();
}

//New window
//It's a pop up window
var win=null;
function NewWindow(mypage,myname,w,h,scroll,pos){
if(pos=="random"){LeftPosition=(screen.width)?Math.floor(Math.random()*(screen.width-w)):100;TopPosition=(screen.height)?Math.floor(Math.random()*((screen.height-h)-75)):100;}
if(pos=="center"){LeftPosition=(screen.width)?(screen.width-w)/2:100;TopPosition=(screen.height)?(screen.height-h)/2:100;}
else if((pos!="center" && pos!="random") || pos==null){LeftPosition=0;TopPosition=20}
settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',location=no,directories=no,status=0,menubar=no,toolbar=no,resizable=no';
win=window.open(mypage,myname,settings);}
// -->
