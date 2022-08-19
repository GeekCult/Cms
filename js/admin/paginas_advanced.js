/*
 *
    Document   : paginas admin
    Created on : 02/01/2011, 16:31:00
    Author     : CarlosGarcia
    Description:
    Purpose of the javascript follows.
*
*/

var next_field_set = 2;
var menu_principal = 0;
var menu_2 = 0;
var menu_3 = 0;
var colorSelT = null;
var nrDetalhesTextr = null;
var slotFoto = 1, type_textureCh = 'site';
var sliders = [];

$(document).ready(function() { 
    
    if($("#action_helper").val() != "listar") initCadastrar();

    $(".buttons_right :button, .menu_shortcut :button").click(function(){

        var action = "";

        switch(this.id){
            case "bt_update":
                action = "alterar";
                submitForm(action);
                break;

            case "bt_submit":
                action = "cadastrar";
                submitForm(action);
                break;
                
            case "bt_add_field":
                addTextField(next_field_set);
                next_field_set++;
                break;
                
            case "bt_dublin_core":
                $('#dublin_core').toggle();
                break;
                
            case "bt_redes_sociais":
                $('#redesociais_fields').toggle();
                break;
                
            case "bt_show_settings":
                $("#page_settings").slideToggle("fast");
                break;
           
            case "bt_show_tips":
                $("#page_tips").slideToggle("fast");
                break;
                
            case "bt_show_templates":
                $(".rows_template").slideToggle("fast");          
                break;
        }

    });
    
    // Shows pages block
    $('#bt_add_block').click(function() {
        showPagesBlocks('open');
        window.scrollTo(0, 0);
    });
    
    $('.bt_close_black').click(function(){
        showPagesBlocks('close');
    });
    
    $('body').on('click', '.bt_delete', function(){
        verifyAction(this.id);
    });
    
    $('body').on('click', '.bt_edit', function(){
        $('#helper_id_row').val(this.id);
        $('#helper_id_componente').val($(this).attr('data-id_componente'));
        showPagesBlocks('edit', this.id);
    });
    
    $('#bt_save_advanced').click(function(e){
        saveContentBlock(e);
    });
    
    $('body').on('click', '.bt_exibe_row', function(){
        updateRow(this.id, $("input[name='exibe_row_" + this.id +"']").is(':checked'), 'status');
    });
    
    $('body').on('click', '.bt_ver', function(){
        visualizarItem(this.id);
    });
    
    $('#bt_choose_template').click(function(){
        $('#ctnChooseTemplate').fadeIn('200');
        $('#ctnEditTemplate, #ctnChooseHeader, #ctnChooseFooter').hide();
    });
    
    $('#bt_choose_header').click(function(){
        $('#ctnChooseHeader').fadeIn('200');
        $('#ctnEditTemplate, #ctnChooseTemplate, #ctnChooseFooter').hide();
    });
    
    $('#bt_edit_template').click(function(){
        editBlockTemplate($('#helper_id_row').val());
        $('#ctnChooseTemplate').hide();
    });
    
    $("body").on('click', '#bt_aplicar_component',  function(){
        var id_page = $('#id_page_helper').val();
        var id_component = $(this).attr('data-id_component');
        //Set value to be used later
        $('#helper_id_componente').val(id_component);
        
        if(id_page == '' || id_page == 0){
            submitForm();
        }else{
            applyAdvComponent(id_page, id_component, false);
        }
    });
    
    // Saves the page into a group to be displayed in menu for instance
    $('.groupItems').change(function() {
        saveCategory(this.id, this.value);
    });
    
    $('#type_layout').change(function(){
        if($('#id_page_helper').val() == ''){
            if($(this).val() == 0) window.location = '/admin/paginas';
            if($(this).val() == 1) window.location = '/admin/paginas_advanced';
            if($(this).val() == 2) window.location = '/admin/paginas_advanced/mix';
        }else{
            if($(this).val() == 0) window.location = '/admin/paginas/editar/' + $('#id_page_helper').val();
            if($(this).val() == 1) window.location = '/admin/paginas_advanced/editar/' + $('#id_page_helper').val();
            if($(this).val() == 2) window.location = '/admin/paginas_advanced/mix/' + $('#id_page_helper').val();
        }
    });
    
    $('#slot_support div.container_slot').click(function(){            
        slotFoto = this.id;
    });
    
    $('.color').live('focus, click', function(){
        colorSelT = this.id;        
        $('#dragger').fadeIn('200');
    });
    
    $('body').on('click', '#bt_close_picker', function(){
        $('#dragger').fadeOut('200');
    });
    
    $('body').on('click', '#bt_block_details', function(){
        $('#ctnDetailsBlock').show();
        $('#ctnPropertiesBlock').hide();
    });
    
    $('body').on('click', '#bt_block_properties', function(){
        $('#ctnDetailsBlock').hide();
        $('#ctnPropertiesBlock').show();
    });
    
    $('body').on('keyup', '.v_indice', function(){
        updateRow($(this).attr('data-id_item'), $(this).val(), 'indice');
    });
    
    $('body').on('click', '.ctnItemAdvThumbs', function(){
        $('#mainBlockItem').attr('src', 'https://www.purplepier.com.br/media/images/layout_block/' + $(this).attr('data-image'));
        $('#mainBlockTitulo').text($(this).attr('data-titulo'));
        $('#mainBlockTexto').text($(this).attr('data-descricao'));
        $('#bt_aplicar_component').attr('data-id_component', $(this).attr('data-id_item'));
    });
    
    //BlockUtils
    $("body").on('click', '.blc_tab', function(){
        $("#blContainer_0, #blContainer_1, #blContainer_2, #blContainer_3, #blContainer_4, #blContainer_5").hide();
        $("#blContainer_" + $(this).attr('data-tab')).show();
    });
    
    $("body").on('click', ".bt_render_bg", function(){
        $('.ctnSlotRenderTyp').hide();
        $("#" + $(this).attr('data-type')).show();
        $('.bt_render_bg').removeClass('active_p');
        $(this).addClass('active_p');
        $('#type_background').val($(this).attr('data-type-id'));
    });
    
    $("body").on('click', ".bt_image1_bg", function(){
        $('#ctnSlotImage1Picture, #ctnSlotImage1Icon, #ctnSlotImage1Color, #ctnSlotImage1Texture').hide();
        $("#" + $(this).attr('data-type')).show();
        $('.bt_image1_bg').removeClass('active_p');
        $(this).addClass('active_p');
        $('#type_image_1').val($(this).attr('data-type-id'));
    });
    
    $("body").on('click', ".bt_image2_bg", function(){
        $('#ctnSlotImage2Picture, #ctnSlotImage2Icon, #ctnSlotImage2Color, #ctnSlotImage2Texture').hide();
        $("#" + $(this).attr('data-type')).show();
        $('.bt_image2_bg').removeClass('active_p');
        $(this).addClass('active_p');
        $('#type_image_2').val($(this).attr('data-type-id'));
    });
    
    $("body").on('click', ".bt_image3_bg", function(){
        $('#ctnSlotImage3Picture, #ctnSlotImage3Icon, #ctnSlotImage3Color, #ctnSlotImage3Texture').hide();
        $("#" + $(this).attr('data-type')).show();
        $('.bt_image3_bg').removeClass('active_p');
        $(this).addClass('active_p');
        $('#type_image_3').val($(this).attr('data-type-id'));
    });
    
    $("body").on('click', ".bt_image4_bg", function(){
        $('#ctnSlotImage4Picture, #ctnSlotImage4Icon, #ctnSlotImage4Color, #ctnSlotImage4Texture').hide();
        $("#" + $(this).attr('data-type')).show();
        $('.bt_image4_bg').removeClass('active_p');
        $(this).addClass('active_p');
        $('#type_image_4').val($(this).attr('data-type-id'));
    });
    
    //Texturas
    //This method works together a anchorAnimateBanner
    //It shows the gallery in the middle screen.
    $('body').on('click', '.bt_textures_slot, .bt_efeitos_slot, .bt_icones_slot', function(){
        nrDetalhesTextr = this.id;
        type_textureCh = $(this).attr('data-type');
    });
    
});

/*
 * TODO: REmover estes Fancys, Utilizar os trigger abaixo no botao select...
 *
 *
 * It inits the listaner and actions for the editar e novo
 * modulo
 *
 */
function initCadastrar(){        
    //Seleciona uma nova foto para o slot em pauta
    //It shows image picker in the middle screen.
    $('#slot_support div.container_slot, #redesociais_fields div.container_slot').click(function(){            
        slotFoto = this.id;
    });
    
    var last_selected_tpl = null;
    $('#ctn_template_slider img').click(function(){ 
        $('.container_templates_boundingbox').removeClass('active');
       
        last_selected_tpl = this.id;
        var actions = this.alt.split(" ");
        var layout = actions[1].split(".");
        $("#helper_controller").val(actions[0]);
        $("#helper_layout").val(layout[0]);
        $("#tpl_"+last_selected_tpl).addClass("active");
        
    });
    
    if($("#action_helper").val() == 'editar') var intervaloPage = setInterval(function(){$('#bt_update').trigger('click');}, 600000);
}


/*
 * It shows blocks for page.
 *
 */
function showPagesBlocks(isAction, id){
    if(isAction == 'open'){
        $(".ctnBlockTemplates").animate({'height': '100%'}, 200, function(){
            $('.ctnAdvTotal').fadeIn('200');
        });
    }else if(isAction == 'edit'){
        editBlockTemplate(id);
    }else{
        $('.ctnAdvTotal').hide();
        $(".ctnBlockTemplates").animate({'height': '0px'}, 200, function(){ });
    }
}

function updateCoolColor(color){
    $('#' + colorSelT).val(color);
    $('#' + colorSelT).css('backgroundColor', color);
}

/*
 * Init the listener for the checkbox control.
 * It handles the banners that can be choosen.
 *
 */
function initMenuListener(){        
    //It verifys id is selected or unselect to launch the specific action
    $(":checkbox").click(function() {
        switch(this.className){

            case "check_select":
                if($(this).attr('checked')){
                    updateMenuSelection(this.id, 1);                        
                }else{
                    updateMenuSelection(this.id, 0);
                }
                break;
        }
    });        
}

/**
 * Update menu display, if it'll be or not showed into to
 * the related menu.
 * 
 * It sends the values from the checkbox to a jQuery request
 *
 */
function updateMenuSelection(menu_type, status)
{
    var id_page = $('#id_page_helper').val();

    $.post("/admin/paginas/update_menu_selection",{
        id_page: id_page,
        menu_type: menu_type,
        status: status
    },function(data){ });
}

/**
 * Save content
 *
 */
function saveContentBlock(e){
    var id_page = $('#id_page_helper').val();
    var id_componente = $('#helper_id_componente').val();
    var id_row = $('#helper_id_row').val();
    
    if(id_row == '' || id_row == 0){
        applyAdvComponent(id_page, id_componente, true);
    }else{
        //Put a preloader on stage
        showAlertDimPreloader(true, 'Salvando...');
        $.post("/admin/paginas_advanced/save_content",{
            id_componente: id_componente,
            id_page: id_page,
            id_row: id_row,
            data: $('form#form_content').serialize()
        },function(data){
            var jsonObject = eval('(' + data + ')');
            showAlertDim(jsonObject['message']);
        });
    }
    
    $("form#form_content").submit(function(){
       return false; 
    }); 
}


/**
 * Apply component
 *
 */
function applyAdvComponent(id_pagina, id_componente, isSaveContent){

    $.post("/admin/paginas_advanced/apply_component",{
        action: 'novo',
        layout: 'line',
        slots: 1,
        n_index: 1,
        id_pagina: id_pagina,
        id_componente: id_componente
        
    },function(data){ 
        var jsonObject = eval('(' + data + ')');
        $('#template_block').append(jsonObject['item']);
        $('#helper_id_row').val(jsonObject['id']);
        showAlertDim(jsonObject['message']);
        if(isSaveContent) $('#bt_save_advanced').trigger('click');
    });
}

/*
 * It shows an alertDim with a cancel or not action.
 * It works together the method bellow:  
 * 
 * PS: Functions callBacks:
 * 
 * cancelActionAlertDim();
 * completeActionAlertDim();
 *
 * @param number id
 * @param number item
 *
 */
function verifyAction(id){    
    id_item = id;   
    showAlertDimCancel();
}

/*
 * It deletes the record from the data base.
 *
 * @param number id
 *
 */
function completeActionAlertDim(){
    
    $("#item_" + id_item).fadeOut("fast");

    $.post("/admin/paginas_advanced/remove_block",{
        id: id_item
    },function(data){
        showAlertDim(data);
        setTimeout("tb_removeAlert('common')", 1500);
    });
}


/*
 * Change the exibe row status.
 *
 * @param number id
 *
 */
function updateRow(id, value, type){

    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');

    $.post("/admin/paginas_advanced/exibe_row",{id: id, value: value, type: type},
    function(data){showAlertDim(data);
        setTimeout("tb_removeAlert('common')", 1500);
    });
}

/**
 * Load templates blocks
 *
 */
function editBlockTemplate(id_row){
    
    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');
    
    $.post("/admin/paginas_advanced/load_block_templates",{
        id_row: id_row,
        id_pagina: $('#id_page_helper').val()
    }, function(data){
        var jsonObject = eval('(' + data + ')');
        if(jsonObject['ERROR']){
            showAlertDim(jsonObject['MESSAGE']);
        }else{
           //$('#ctnChooseTemplate').empty().append(jsonObject['view_template']);
            $('#ctnEditView').html(jsonObject['view_detalhes']);

            $(".ctnBlockTemplates").animate({'height': '100%'}, 200, function(){
                $('.ctnAdvTotal').fadeIn('200');
                $('#ctnChooseTemplate').hide();
                $('#ctnEditTemplate').fadeIn('200');

            });
            
            window.scrollTo(0, 0);
        }       
        
        hideAlertDimPreloader(false);
    });
}

/*
 * It sends the values by POST
 *
 */
function submitForm(){    
    
    if($('#titulo').val() == "" || $('#name').val() == ""){
        $(".message_errors").css("display", "block");
    }else{
        //Put a preloader on stage
        showAlertDimPreloader(true, 'Salvando...');
        $(".message_errors").css("display", "none");
    
        $.post("/admin/paginas_advanced/new_page",{
            id_page: $('#id_page_helper').val(),
            id_user: $('#helper_id_user').val(),
            special_page: $('#helper_special_page').val(),
            name: $('#name').val(),
            menu_principal: $("input[name='menu_principal']").is(':checked'),
            menu_2: $("input[name='menu_2']").is(':checked'),
            menu_3: $("input[name='menu_3']").is(':checked'),
            banner_exibe: $("input[name='banner_exibe']").is(':checked'),
            breadcrumb_exibe: $("input[name='breadcrumb_exibe']").is(':checked'),
            index: $('#index').val(),
            frase: $('#phrase').val(),
            titulo: $('#titulo').val(),
            keywords: $('#keywords').val(),
            
            titulo_01 : $('#titulo_01').val(),
            texto_01 : $('#texto_01').val(),
            titulo_02 : $('#titulo_02').val(),
            texto_02 : $('#texto_02').val(),
            titulo_03 : $('#titulo_03').val(),
            texto_03 : $('#texto_03').val(),
            titulo_04 : $('#titulo_04').val(),
            texto_04 : $('#texto_04').val(),
            titulo_05 : $('#titulo_05').val(),
            texto_05 : $('#texto_05').val(),
            titulo_06 : $('#titulo_06').val(),
            texto_06 : $('#texto_06').val(),
            subtitulo_01 : $('#subtitulo_01').val(),
            subtitulo_02 : $('#subtitulo_02').val(),
            subtitulo_03 : $('#subtitulo_03').val(),
            subtitulo_04 : $('#subtitulo_04').val(),
            subtitulo_05 : $('#subtitulo_05').val(),
            subtitulo_06 : $('#subtitulo_06').val(),
            label_link_01 : $('#label_link_01').val(),
            label_link_02 : $('#label_link_02').val(),
            label_link_03 : $('#label_link_03').val(),
            label_link_04 : $('#label_link_04').val(),
            label_link_05 : $('#label_link_05').val(),
            label_link_06 : $('#label_link_06').val(),
            link_01 : $('#link_01').val(),
            link_02 : $('#link_02').val(),
            link_03 : $('#link_03').val(),
            link_04 : $('#link_04').val(),
            link_05 : $('#link_05').val(),
            link_06 : $('#link_06').val(),   
            
            banner: $('#id_slot_0').text(),            
            slot_1: $('#id_slot_1').text(),
            slot_2: $('#id_slot_2').text(),
            slot_3: $('#id_slot_3').text(),
            slot_4: $('#id_slot_4').text(),
            slot_5: $('#id_slot_5').text(),
            slot_6: $('#id_slot_6').text(),
            slot_7: $('#id_slot_7').text(),
            slot_8: $('#id_slot_8').text(),
            slot_9: $('#id_slot_9').text(),
            slot_10: $('#id_slot_10').text(),
            
            //Facebook
            fb_titulo: $('#rds_titulo').val(),
            fb_texto: $('#rds_descricao').val(),
            fb_slot_1: $('#submit_pict_id_12').val(),
      
            controller: $('#helper_controller').val(),
            layout: $('#helper_layout').val(),
            tipo: $('#helper_type_page').val(),
            modelo: $('#type_layout').val(),
            
            id_hotsite: $('#helper_action').attr('data-hotsite'),
            
            network_exibe : $("input[name='network_exibe']").is(':checked'),
            dicas_exibe : $("input[name='dica_exibe']").is(':checked'),

            dica_titulo : $('#dica_titulo').val(),
            dica_subtitulo : $('#dica_subtitulo').val(),
            dica_texto : $('#dica_texto').val(),
            
            main_for_group: $("input[name='main_for_group']").is(':checked'),
            link_special: $("#link_special").val(),
            titulo_pagina: $("#titulo_pagina").val(),
            gel_fr_initial: $('#chamada_inicial').val(),
            
            //Dublin_core
            dc_identificator: $('#dc_identificator').val(),
            dc_format: $('#dc_format').val(),
            dc_language: $('#dc_language').val(),
            dc_creator: $('#dc_creator').val(),
            dc_subject: $('#dc_subject').val(),
            dc_publisher: $('#dc_publisher').val(),
            dc_email: $('#dc_email').val(),
            dc_contributor: $('#dc_contributor').val(),
            dc_date: $('#dc_date').val(),
            dc_relation: $('#dc_relation').val(),
            dc_coverage: $('#dc_coverage').val(),
            dc_copyright: $('#dc_copyright').val()

        },function(data){
            var jsonObject = eval('(' + data + ')');
            
            showAlertDim(jsonObject['message']);
            
            $('#id_page_helper').val(jsonObject['id_page']);
            if($('#helper_action').val() == 'novo')applyAdvComponent(jsonObject['id_page'], $('#helper_id_componente').val());
            $('#helper_action').val('editar');            
            
        });
    }
}

/**
 * Load templates blocks
 *
 */
function visualizarItem(id){
    window.open('/site/teste/visualizar_item/' + id, '_blank');
}

/*
 * Add background
 *
 */
function addBackground(bg_type, texture, bg_type2, booleano){
    $("#slot_texture_id_" + nrDetalhesTextr).css('background', 'url(/media/images/textures/' + type_textureCh +'/'+ texture +')');
    $("#submit_texture_id_" + nrDetalhesTextr).val(texture);
    $('#id_slot_' + nrDetalhesTextr).text(texture);
     
}

/*
 * It clears the textfield related
 *
 */
function addTextField(i){
    $(".visibility" + i).fadeIn("slow");
}

/*
 * Método chamado dentro da view
 * isso evita alguns listeners desnecessários
 * 
 */
var id_start_noticias_item = 0;
var slideSN = 0;
var size_new_slider = 183;
var slidPosNews = 0;
var qtdSlidTotal = 4;
function initListenerModuleNoticiasSlider(qtdTotalT){
    
    var qtdTotal = qtdTotalT - qtdSlidTotal;
    var qtd = $("#helper_qtd_news_slider").val();
    
    $(".bt_box_quarter_arrow_right").click(function(){
        
        if(slidPosNews < qtdTotal){
            slideSN = slideSN - size_new_slider;

            id_start_noticias_item = id_start_noticias_item + (qtd * 1);
            $("#ctn_template_slider").animate({"left" : slideSN + "px"});
            slidPosNews++;
        }
    });
    
    $(".bt_box_quarter_arrow_left").click(function(){
        if(slidPosNews > 0){
            slideSN = slideSN + size_new_slider;
            $("#ctn_template_slider").animate({"left" : slideSN+"px"});
            slidPosNews--;
        }          
    });
    
    if(qtdTotalT <= qtdSlidTotal){
        $(".bt_box_quarter_arrow_left").hide();
        $(".bt_box_quarter_arrow_right").hide();
    }
     
}

/*
 * Sets the number to show the next
 * field set visible or editable.
 * 
 */
function setLastFieldText(lastNum){
    next_field_set = lastNum;
}


var Slider = function() { this.initialize.apply(this, arguments) }
    Slider.prototype = {

    initialize: function(slider) {
        this.ul = slider.children[0];
        this.li = this.ul.children;
       
        // make <ul> as large as all <li>’s
        this.ul.style.width = (970 * this.li.length) + 'px';

        this.currentIndex = 0;
    },

    goTo: function(index) {
        // filter invalid indices
        if (index < 0 || index > this.li.length - 1)
        return

        // move <ul> left
        this.ul.style.left = '-' + (100 * index) + '%'

        this.currentIndex = index
    },

    goToPrev: function() {
        this.goTo(this.currentIndex - 1)
    },

    goToNext: function() {
        this.goTo(this.currentIndex + 1)
    }
}