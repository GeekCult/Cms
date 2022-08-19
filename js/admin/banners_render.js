/*
    Document   : Detalhes admin
    Created on : 04/01/2011, 8:31:00
    Author     : CarlosGarcia
    Description:
    Purpose of the javascript follows.
*/
var nrDetalhesTextr = null;
var slotFoto = 1;

/*
 * It sends the values from the radio button
 * It defines a new details to the layout selected
 *
 */
function initRenderListeners(){
    
    $("#bt_update_render, .icon_save").click(function(){
        saveContentRender();
    });
    
    $(".r_tab").click(function(){
        handleTabs($(this).attr('data-tab'));
    });
    
    $('.bt_fotos').click(function(){
        slotFoto = this.id;
    });
    
    $(".bt_render_bg").click(function(){
        $('.ctnSlotRenderTyp').hide();
        $("#" + $(this).attr('data-type')).show();
        $('.bt_render_bg').removeClass('active_p');
        $(this).addClass('active_p');
        $('#type_background').val($(this).attr('data-type-id'));
    });
    
    
    //Texturas
    //This method works together a anchorAnimateBanner
    //It shows the gallery in the middle screen.
    $('.bt_textures, .bt_site').click(function(){
        nrDetalhesTextr = this.id;
    });
    
    $('.bt_site').fancybox({
        'transitionIn':'elastic','transitionOut':'elastic','speedIn': 300,'speedOut': 200,'autoDimensions':false,'width':720,'height':450,'overlayShow': false,
        'href'        : "/admin/texturas/site/exibir"
    });
    
    $('.bt_fotos').fancybox({
        'transitionIn':'elastic','transitionOut':'elastic','speedIn': 300,'speedOut': 200,'autoDimensions':false,'width':720,'height':450,'overlayShow': false,
        'href'        : "/admin/images/images/0/9"
    });
   
}

/*
 * Add background
 *
 */
function addBackground(bg_type, texture, bg_type2, booleano){
    
    $("#slot_texture_id_" + nrDetalhesTextr).css('background', 'url(/media/images/textures/site/'+ texture +')');
    $("#submit_texture_id_" + nrDetalhesTextr).val(texture);
    $('#id_slot_' + nrDetalhesTextr).text(texture);
     
}

/**
 * Save content render
 *
 */
function saveContentRender(){
    
    var id_banner = $('#helper_id_banner').val();
    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');
  
    $.post("/admin/html_renderpartial/salvar",{
        id_banner: id_banner,
        data: $('form#form_banner_render').serialize()
        
    },function(data){
        var jsonObject = eval('(' + data + ')');
        showAlertDim(jsonObject['message']);
    }); 
}

/*
 * Handle tabs
 * 
 * @param number
 * 
 */
function handleTabs(tab){
    $('.ctnTbsRender').hide();
    $('#holdTab_' + tab).show();
}