/*
 *
    Document   : materias admin
    Created on : 02/01/2011, 16:31:00
    Author     : CarlosGarcia
    Description:
    Purpose of the javascript follows.
*
*/
//var i = 2;

isPreventDefault = false;
var sliders = [];

$(document).ready(function(){
    
    if($("#helper_action").attr('data-js-action') == 'listar')setListenerListArticles();
    if($("#helper_action").attr('data-js-action') == 'editar') setHandleListeners();
    
});

function setHandleListeners(){
    
    addTemplateMakerListeners();

    $("#bt_submit, .bt_submit_shortcut").click(function(){
        submitFormArticle("cadastrar");
    });
    
    if($("#helper_local").val() == "admin"){ 
        $(".container_slot").click(function(){
            slotFoto = this.id;
        });
        
    }else{
        $(".container_slot").click(function(){
            showPopUp("pages", "images",  'message_simple', 745, 440, false);
        });
    }

    $('#bt_clear').click(function(){
        clearForm();
    });

    $('#bt_update, .bt_update_shortcut').click(function(){            
        //action2 = "alterar";
        submitFormArticle("alterar");
    });
    
    $('#bt_redes_sociais').click(function(){            
        $('#redesociais_fields').toggle();
    }); 
    
    $('#bt_detalhes').click(function(){            
        $('#detalhes_fields').toggle();
    });
    
    if($("#helper_action").val() == 'editar') var intervaloNew = setInterval(function(){$('#bt_update').trigger('click');}, 600000);
    
}

/*
 * This method is used to set a session date value.
 * @param string
 *
 */
function setDate(label, value) {
    var content = {
        'label': label,
        'value': value
    }

    $.post("/site/relatar/set_session_data", content, function(data) {
        var data = JSON.parse(data);
        if (data.result) {
            location.reload(true);
        }
    });
}

function setListenerListArticles(){
     $('.table_support :button').click(function(e){
        switch(this.id){
            case "bt_delete":
                verifyActionArticles(this.name);
                break;
            case "bt_edit":
                editForm(this.name);
                break;
            case "bt_speaker":
                setContentFocused(this.name);
                break;
        }
    });
    
    $('#filtro_ano').change(function() {
        setDate('materias_year', $(this).val());
    });

    $('#filtro_mes').change(function() {
        setDate('materias_month', $(this).val());
    });

    $('#filtro_dia').change(function() {
        setDate('materias_day', $(this).val());
    }); 
}

/*
 * It sends the values by POST
 * All field must be declared bellow
 * 
 * @param string
 *
 */
function submitFormArticle(action){
    
    if($("#helper_action").val() == 'editar') action = 'alterar';

    var title = $('#title').val();
    var subtitulo  = $('#subtitulo').val();
    var materia = $('#materia').val();
    var keywords = $('#keywords').val();
    var id_article = $('#id_article_helper').val();  
    var id_categoria = $('#categoria').val();
    var tipo = $('#helper_type_controller').val();
    var slot_1  = $('#id_slot_101').text();
    var file  = $('#file_helper').val();
    var local  = $('#helper_local').val();
    var id_colunista = $('#colunista').val();
    var data = $('#data_article').val();
    var link_special = $('#link_special').val();

    if(title == "" && subtitulo == "" && materia == ""){
        $('.message_errors').fadeIn("fast");
    }else{       
        //Put a preloader on stage
        showAlertDimPreloader(true, "Salvando...");
        $(".message_errors").css("display", "none");
        $.post("/admin/materias/" + action,{            
            tipo: tipo,
            title: title,
            id_colunista: id_colunista,
            id_categoria: id_categoria,
            materia: materia,
            id_article: id_article,
            slot_1: slot_1,
            file: file,
            subtitulo: subtitulo,
            keywords: keywords,
            local: local,
            data_article: data,
            link_special: link_special,
            destaque: $('#destaque').val(),
            chamada: $('#chamada').val(),
            modelo: $('#modelo').val(),
            cor: $('#cor').val(),
            exibe: $("input[name='exibe']").is(':checked'),
            //Facebook
            fb_titulo: $('#rds_titulo').val(),
            fb_texto: $('#rds_descricao').val(),
            fb_slot_1: $('#submit_pict_id_12').val(),

        },function(data){
            var jsonObject = eval('(' + data + ')');
            if(jsonObject['ERROR'] == 0){
                if(jsonObject['local'] == "conta"){                
                    showPopUp("toast", "Cadastro realizado com sucesso!",  'message_simple', 400, 30, false);
                }else{
                    showAlertDim(jsonObject['message']);
                }
            }else{
                showAlertDim(jsonObject['message']); 
            }            
            if(action == "novo" || action == "cadastrar"){
               $("#helper_action").val('editar');
               $('#id_article_helper').val(jsonObject['id']);
            }
        });       
    }
}

/*
 * It edits the records from the data base.
 *
 * @param number id
 *
 */
function editForm(id){   
    var tipo = $("#helper_tipo").val();        
    window.location = "/admin/"+ tipo + "/editar/" + id;
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
function verifyActionArticles(id){
    id_item = id;   
    showAlertDimCancel();
}

/*
 * It deletess the record from the data base.
 *
 * @param number id
 *
 */
function completeActionAlertDim(){
    
    $("#obj_container_" + id_item).fadeOut("slow");
     
    $.post("/admin/materias/deletar",{
        id: id_item
    },function(data){
        showAlertDim(data);
        setTimeout("tb_removeAlert('common')", 1500);
    });
}

/*
 * It deletes the template.
 *
 * @param number id
 *
 */
function completeRemoveBlock(id){

    $.post("/admin/materias/delete_block",{id: id},function(data){
        showAlertDim(data);
        $("#item_" + id).fadeOut("fast");
        setTimeout("tb_removeAlert('common')", 1500);
    });
}

/*
 * It clears the textfield related
 *
 */
function clearForm(){
    $('#title').val("");
    $('#materia').val("");
}


function initImagesUpload(){
    setTimeout("initImagesUploadTimer()", 1000);
}

function setDateArticleFormat(){
   $('#data').mask('99/99/9999');
}

function initImagesUploadTimer(){ 
    
    //Bug fix for pagination, in the listar view
    //If this pluggin js/lib/upload is loaded the pagination stop working 
    $('#fileTT').uploadify({
      'uploader'    : '/js/lib/upload/uploadify.swf',
      'script'      : '/js/lib/upload/uploadify.php',
      'cancelImg'   : '/js/lib/upload/cancel.png',
      'folder'      : '/media/user/images',
      'fileExt'     : '*.jpg;*.jpeg;*.gif;*.png',              
      'fileDesc'    : 'Image Files',
      'auto'        : true,
      'onComplete'  : function(event, queueID, fileObj, response, data) {  
          $("#slot_pict_id_1").attr("src", "/media/user/images/thumbs_120/" + response);
          $('#file_helper').val(response);
          $('#id_slot_1').text(response);              
       }
    });
    setDateArticleFomat();
}

/**
* Just to set some info needed
**/
function setContentFocused(id){
   $("#helper_type_id").val(id);
}


/* Templates */

/*
 * It shows blocks for page.
 *
 */
function showPagesBlocks(isAction, id){
    if(isAction == 'open'){
        
        $(".ctnBlockTemplates").animate({'height': '100%'}, 200, function(){
            $("#ctnTempltTable").hide(); $("#ctnTempltItem").show();
            $('.ctnAdvTotal').fadeIn('200');            
        });
    }else if(isAction == 'edit'){
        editBlockTemplate(id);
    }else{
        $('.ctnAdvTotal').hide();        
        $(".ctnBlockTemplates").animate({'height': '0px'}, 200, function(){ 
            $("#ctnTempltTable").show(); $("#ctnTempltItem").hide();
        });
    }
}

/*
 * Change the exibe row status.
 *
 * @param number id
 *
 */
function updateRow(id, value, type){

    $.post("/admin/materias/exibe_row",{id: id, value: value, type: type},
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
    showAlertDimPreloader(true, 'Carregando...');
    
    $("#ctnTempltTable").hide();
    
    $.post("/admin/materias/load_block_templates",{
        id_row: id_row,
        id_template: $('#id_helper').val(),
        type_template: $(this).attr('data-type')
    }, function(data){
        var jsonObject = eval('(' + data + ')');
        
        $('#ctnChooseTemplate').empty().append(jsonObject['view_template']);
        $('#ctnEditView').html(jsonObject['view_detalhes']);
        
        $(".ctnBlockTemplates").animate({'height': '100%'}, 200, function(){
            $('.ctnAdvTotal').fadeIn('200');
            $('#ctnChooseTemplate').hide();
            $('#ctnEditTemplate').fadeIn('200');
         
        });
        
        hideAlertDimPreloader(false);
    });
}


/**
 * Apply component
 *
 */
function applyEmktComponent(id_template, id_componente, isSaveContent){
    
    //Put a preloader on stage
    showAlertDimPreloader();
    $.post("/admin/materias/apply_component",{
        action: 'novo',
        layout: 'line',
        slots: 1,
        n_index: 1,
        id_template: id_template,
        id_componente: id_componente
        
    },function(data){ 
        var jsonObject = eval('(' + data + ')');
        $('#template_block').append(jsonObject['item']);
        $('#helper_id_row').val(jsonObject['id']);
        showAlertDim(jsonObject['message']);
        if(isSaveContent) $('#bt_save_advanced').trigger('click');
    });
}

/**
 * Save content
 *
 */
function saveContentBlock(e){
    var id_template = $('#id_helper').val();
    var id_componente = $('#helper_id_componente').val();
    var id_row = $('#helper_id_row').val();
    
    //Put a preloader on stage
    showAlertDimPreloader();
    
    if(id_row == '' || id_row == 0){
        applyAdvComponent(id_template, id_componente, true);
    }else{
        
        $("#output_componentes").empty().append("<div class='bg-info wrapper m-b-10'>Salvando...</div>");
        
        $.post("/admin/materias/save_content",{
            id_componente: id_componente,
            id_template: id_template,
            id_row: id_row,
            data: $('form#form_content').serialize()
        },function(data){
            
            var jsonObject = eval('(' + data + ')');
            $("#output_componentes").empty().append("<div class='bg-success wrapper m-b-10'>" + jsonObject['message'] + "</div>");
            //showAlertDim(jsonObject['message']);
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
function addTemplateMakerListeners(){
    
    $('#bt_edit_component, #bt_check_component_exist').click(function(){
       
        if($("#id_helper").val() == ''){
           $.post("/admin/materias/create_template",{
                id_article: $('#id_article_helper').val() 
            },function(data){
                var jsonObject = eval('(' + data + ')');
                $('#id_helper').val(jsonObject['id']);
            }); 
        }
        $('#ctnComponents').show(); $('#slots_support').hide();
    });
    
    $('#bt_edit_content').click(function(){$('#ctnComponents').hide(); $('#slots_support').show();});

   // Shows pages block
    $('#bt_add_block').click(function() {
        showPagesBlocks('open');
    });
    
    $('.bt_close_black').click(function(){
        showPagesBlocks('close');
    });
    
    $('.bt_delete').live('click', function(){
        showAlertDimCancelAdvanced(this.id, completeRemoveBlock);
    });
    
    $('body').on('click', '.bt_edit', function(){
        $('#helper_id_row').val(this.id);
        $('#helper_id_componente').val($(this).attr('data-id_componente'));
        showPagesBlocks('edit', this.id);
    });
    
    $('#bt_save_advanced').click(function(e){
        saveContentBlock(e);
    });
    
    $('.bt_exibe_row').live('click', function(){
        updateRow(this.id, $("input[name='exibe_row_" + this.id +"']").is(':checked'), 'status');
    });
    
    $('.bt_ver').live('click', function(){
        visualizarItem(this.id);
    });
    
    $('.v_indice').keyup(function(){
        updateRow($(this).attr('data-id_item'), $(this).val(), 'indice');
    });
    
    /* ColorPicker */
    $('.color').live('focus, click', function(){
        colorSelT = this.id;        
        $('#dragger').fadeIn('200');
    });
    
    $('#bt_close_picker').live('click', function(){
        $('#dragger').fadeOut('200');
    });
    
    $('#bt_choose_template').click(function(){
        $('#ctnChooseTemplate').fadeIn('200');
        $('#ctnEditTemplate, #ctnChooseHeader, #ctnChooseFooter').hide();
    });
    
    $('#bt_choose_header').click(function(){
        $('#ctnChooseHeader').fadeIn('200');
        $('#ctnEditTemplate, #ctnChooseTemplate, #ctnChooseFooter').hide();
    });
    
    $('#bt_choose_footer').click(function(){
        $('#ctnChooseFooter').fadeIn('200');
        $('#ctnEditTemplate, #ctnChooseTemplate, #ctnChooseHeader').hide();
    });
    
    $('#bt_edit_template').click(function(){
        editBlockTemplate($('#helper_id_row').val());
        $('#ctnChooseTemplate').hide();
    });
    
    $(".bt_apply_block").live('click', function(){
        var id_template = $('#id_helper').val();
        var id_component = $(this).attr('data-id_component');
        //Set value to be used later
        $('#helper_id_componente').val(id_component);
        applyEmktComponent(id_template, id_component, false);
        
    });
    
    $('body').on('click', '.ctnItemAdvThumbs', function(){        
        var type = $(this).attr('data-type');
        $('#main'+ type +'Item').attr('src', '/media/images/layout_block/' + $(this).attr('data-image'));
        $('#main'+ type +'Titulo').text($(this).attr('data-titulo'));
        $('#main'+ type +'Texto').text($(this).attr('data-descricao'));
        $('#bt_aplicar_component').attr('data-id_component', $(this).attr('data-id_item'));
    });
    
    //BlockUtils
    $(".blc_tab").live('click', function(){
        $("#blContainer_0, #blContainer_1, #blContainer_2, #blContainer_3, #blContainer_4").hide();
        $("#blContainer_" + $(this).attr('data-tab')).show();
    });
    
    //Content
    $(".blc_tab_content").live('click', function(){
        $("#ctnContentTab_0, #ctnContentTab_1").hide();
        $("#ctnContentTab_" + $(this).attr('data-tab')).show();
    });
    
    
    $(".bt_render_bg").live('click', function(){
        $('.ctnSlotRenderTyp').hide();
        $("#" + $(this).attr('data-type')).show();
        $('.bt_render_bg').removeClass('active_p');
        $(this).addClass('active_p');
        $('#type_background').val($(this).attr('data-type-id'));
    });
    
    $(".bt_image1_bg").live('click', function(){
        $('#ctnSlotImage1Picture, #ctnSlotImage1Icon, #ctnSlotImage1Color, #ctnSlotImage1Texture').hide();
        $("#" + $(this).attr('data-type')).show();
        $('.bt_image1_bg').removeClass('active_p');
        $(this).addClass('active_p');
        $('#type_image_1').val($(this).attr('data-type-id'));
    });
    
    $(".bt_image2_bg").live('click', function(){
        $('#ctnSlotImage2Picture, #ctnSlotImage2Icon, #ctnSlotImage2Color, #ctnSlotImage2Texture').hide();
        $("#" + $(this).attr('data-type')).show();
        $('.bt_image2_bg').removeClass('active_p');
        $(this).addClass('active_p');
        $('#type_image_2').val($(this).attr('data-type-id'));
    });
    
    $(".bt_image3_bg").live('click', function(){
        $('#ctnSlotImage3Picture, #ctnSlotImage3Icon, #ctnSlotImage3Color, #ctnSlotImage3Texture').hide();
        $("#" + $(this).attr('data-type')).show();
        $('.bt_image3_bg').removeClass('active_p');
        $(this).addClass('active_p');
        $('#type_image_3').val($(this).attr('data-type-id'));
    });
    
    $(".bt_image4_bg").live('click', function(){
        $('#ctnSlotImage4Picture, #ctnSlotImage4Icon, #ctnSlotImage4Color, #ctnSlotImage4Texture').hide();
        $("#" + $(this).attr('data-type')).show();
        $('.bt_image4_bg').removeClass('active_p');
        $(this).addClass('active_p');
        $('#type_image_4').val($(this).attr('data-type-id'));
    });
    
    //Texturas
    //This method works together a anchorAnimateBanner
    //It shows the gallery in the middle screen.
    $('.bt_textures_slot, .bt_efeitos_slot, .bt_icones_slot').live('click', function(){
        nrDetalhesTextr = this.id;
    });
}

/*
 * Add background
 *
 */
function addBackground(bg_type, texture, bg_type2, booleano){    
    
    var type_texture = "site";
    if(nrDetalhesTextr == 3 || nrDetalhesTextr == 4 || nrDetalhesTextr == 6) type_texture = "efeitos"; 
    //if(nrDetalhesTextr == 5 || nrDetalhesTextr == 7 || nrDetalhesTextr == 102 || nrDetalhesTextr == 103 || nrDetalhesTextr == 104) type_texture = "icones";
   
    $("#slot_texture_id_" + nrDetalhesTextr).css('background', 'url(/media/images/textures/' + type_texture +'/'+ texture +')');
    $("#submit_texture_id_" + nrDetalhesTextr).val(texture);
    $('#id_slot_' + nrDetalhesTextr).text(texture);
     
}

function updateCoolColor(color){
    $('#' + colorSelT).val(color);
    $('#' + colorSelT).css('backgroundColor', color);
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