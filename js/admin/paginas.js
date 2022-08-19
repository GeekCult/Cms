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
isPreventDefault = false;

$(document).ready(function() {

    if($("#action_helper").val() != "listar"){
        initCadastrar();   
        initMenuListener();
        setComboBoxLinkListeners();
    }        

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
            
            case "bt_list":
                $("#bt_list_page").trigger('click');                
                break;

            case "bt_clear":
                clearForm();
                break;
                
            case "bt_show_templates":
                $(".rows_template").slideToggle("fast");          
                break;
                
            case "bt_show_settings":
                $("#page_settings").slideToggle("fast");
                break;
           
            case "bt_show_tips":
                $("#page_tips").slideToggle("fast");
                break;
            
            case "bt_show_videos":
                $("#page_video").slideToggle("fast");
                break;
        }

    });

    $(".table_support :image").click(function() {

        switch(this.name){
            case "bt_excluir":
                verifyAction(this.id);
                break;

            case "bt_editar":
                editForm(this.id, 'comum');
                break;
                
            case "bt_editar_advanced":
                editForm(this.id, 'advanced');
                break;
                
            case "bt_editar_mix":
                editForm(this.id, 'mix');
                break;
            
            case "bt_hide":
                hidePage(this.id, 0);
                break;
            
            case "bt_hide_purple":
                hidePage(this.id, 2);
                break;
                
            case "bt_show":
                hidePage(this.id, 1);
                break;
        }
    });

    $('#bt_define').click(function() {
        defineLayout();
    });
    
    // Saves the page into a group to be displayed in menu for instance
    $('.groupItems').change(function() {
        saveCategory(this.id, this.value);
    });
    
    $('#type_layout').change(function(){
        var id_page = $('#id_page_helper').val();
        if(id_page == '' || id_page == undefined){
            if($(this).val() == 0) window.location = '/admin/paginas';
            if($(this).val() == 1) window.location = '/admin/paginas_advanced';
            if($(this).val() == 2) window.location = '/admin/paginas_advanced/mix';
        }else{
            if($(this).val() == 0) window.location = '/admin/paginas/editar/' + $('#id_page_helper').val();
            if($(this).val() == 1) window.location = '/admin/paginas_advanced/editar/' + $('#id_page_helper').val();
            if($(this).val() == 2) window.location = '/admin/paginas_advanced/mix/' + $('#id_page_helper').val();
        }
    });

});

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
    },
    function(data){ });
}

/**
 * Update paginas category.
 * 
 * Example: Services, Minha Conta, Institucional, etc
 * It sends the values from the selector to a jQuery request
 *
 */
function saveCategory(id_page, id_category){

    $.post("/admin/paginas/update_category",{
        id_page: id_page,
        id_category: id_category
    },
    function(data){ 
        showAlertDim(data);
    });
}

/*
 * It sends the values by POST
 *
 */
function submitForm(action){        
    var name = $('#name').val();
    var index = $('#index').val();
    var menu_principal = $("input[name='menu_principal']").is(':checked');
    var menu_2 = $("input[name='menu_2']").is(':checked');
    var menu_3 = $("input[name='menu_3']").is(':checked');
    var banner_exibe = $("input[name='banner_exibe']").is(':checked');
    var breadcrumb_exibe = $("input[name='breadcrumb_exibe']").is(':checked');
    var frase = $('#phrase').val();
    var titulo = $('#titulo').val();
    var keywords = $('#keywords').val();
    var titulo_01 = $('#titulo_01').val();
    var texto_01 = $('#texto_01').val();
    var titulo_02 = $('#titulo_02').val();
    var texto_02 = $('#texto_02').val();
    var titulo_03 = $('#titulo_03').val();
    var texto_03 = $('#texto_03').val();
    var titulo_04 = $('#titulo_04').val();
    var texto_04 = $('#texto_04').val();
    var titulo_05 = $('#titulo_05').val();
    var texto_05 = $('#texto_05').val();
    var titulo_06 = $('#titulo_06').val();
    var texto_06 = $('#texto_06').val();
    var subtitulo_01 = $('#subtitulo_01').val();
    var subtitulo_02 = $('#subtitulo_02').val();
    var subtitulo_03 = $('#subtitulo_03').val();
    var subtitulo_04 = $('#subtitulo_04').val();
    var subtitulo_05 = $('#subtitulo_05').val();
    var subtitulo_06 = $('#subtitulo_06').val();
    var label_link_01 = $('#label_link_01').val();
    var label_link_02 = $('#label_link_02').val();
    var label_link_03 = $('#label_link_03').val();
    var label_link_04 = $('#label_link_04').val();
    var label_link_05 = $('#label_link_05').val();
    var label_link_06 = $('#label_link_06').val();
    var link_01 = $('#link_01').val();
    var link_02 = $('#link_02').val();
    var link_03 = $('#link_03').val();
    var link_04 = $('#link_04').val();
    var link_05 = $('#link_05').val();
    var link_06 = $('#link_06').val();


    var id_page = $('#id_page_helper').val();
    var id_user = $('#id_user_helper').val();
    var special_page = $('#helper_special_page').val();
    var controller = $('#helper_controller').val();
    var layout = $('#helper_layout').val();
    var tipo = $('#helper_type_page').val();
    var modelo = $('#type_layout').val();

    //Slots
    var banner  = $('#id_slot_0').text();
    var slot_1  = $('#id_slot_1').text();
    var slot_2  = $('#id_slot_2').text();
    var slot_3  = $('#id_slot_3').text();
    var slot_4  = $('#id_slot_4').text();
    var slot_5  = $('#id_slot_5').text();
    var slot_6  = $('#id_slot_6').text();
    var slot_7  = $('#id_slot_7').text();
    var slot_8  = $('#id_slot_8').text();
    var slot_9  = $('#id_slot_9').text();
    var slot_10 = $('#id_slot_10').text();
    var slot_11 = $('#id_slot_11').text();
    
    var video_1 = $('#video_1').val();
    var video_2 = $('#video_2').val();
    var video_3 = $('#video_3').val();
    
    var dica_titulo = $('#dica_titulo').val();
    var dica_subtitulo = $('#dica_subtitulo').val();
    var dica_texto = $('#dica_texto').val();
    
    var exibe_dica = $("input[name='dica_exibe']").is(':checked');
    var exibe_network = $("input[name='network_exibe']").is(':checked');
    var main_for_group = $("input[name='main_for_group']").is(':checked');
    var link_special = $("#link_special").val();
    var titulo_pagina = $("#titulo_pagina").val();
    var galeria_usuarios = $("#galeria_usuarios").val();
    
    /* Materias */
    var mat_lk_rcn_qtd = $('#materia_link_recomentados_qtd').val();
    var mat_lk_rcn_afi = $('#materia_link_recomentados_afinidade').val();
    var mat_lk_rcn_adv = $('#materia_link_recomentados_publicidade').val();
    var mat_lk_rcn_blc = $('#materia_link_recomentados_blocos').val();
    
    /* Galerias */
    var gal_date = $("input[name='gal_date_exibe']").is(':checked');
    var gal_fr_dt = $('#gal_frase_details').val();
    var gal_subfr_dt = $('#gal_subfrase_details').val();
    
    /* Geral */
    var gel_fr_initial = $('#gel_fr_initial').val();
    
    
    if(titulo == "" || name == ""){
        $(".message_errors").css("display", "block");
    }else{
        //Put a preloader on stage
        showAlertDimPreloader(true, 'Salvando...');
        $(".message_errors").css("display", "none");
    
        $.post("/admin/paginas/" + action,{
            id_page: id_page,
            id_user: id_user,
            special_page: special_page,
            name: name,
            menu_principal: menu_principal,
            menu_2: menu_2,
            menu_3: menu_3,
            banner_exibe: banner_exibe,
            breadcrumb_exibe: breadcrumb_exibe,
            index: index,
            frase: frase,
            titulo: titulo,
            keywords: keywords,
            titulo_01: titulo_01,
            texto_01: texto_01,
            titulo_02: titulo_02,
            texto_02: texto_02,
            titulo_03: titulo_03,
            texto_03: texto_03,
            titulo_04: titulo_04,
            texto_04: texto_04,
            titulo_05: titulo_05,
            texto_05: texto_05,
            titulo_06: titulo_06,
            texto_06: texto_06,
            subtitulo_01: subtitulo_01,
            subtitulo_02: subtitulo_02,
            subtitulo_03: subtitulo_03,
            subtitulo_04: subtitulo_04,
            subtitulo_05: subtitulo_05,
            subtitulo_06: subtitulo_06,
            label_link_01: label_link_01,
            label_link_02: label_link_02,
            label_link_03: label_link_03,
            label_link_04: label_link_04,
            label_link_05: label_link_05,
            label_link_06: label_link_06,
            link_01: link_01,
            link_02: link_02,
            link_03: link_03,
            link_04: link_04,
            link_05: link_05,
            link_06: link_06,
            banner: banner,            
            slot_1: slot_1,
            slot_2: slot_2,
            slot_3: slot_3,
            slot_4: slot_4,
            slot_5: slot_5,
            slot_6: slot_6,
            slot_7: slot_7,
            slot_8: slot_8,
            slot_9: slot_9,
            slot_10: slot_10,
            controller: controller,
            layout: layout,
            tipo: tipo,
            modelo: modelo,
            icon: slot_11,
            network_exibe : exibe_network,
            dicas_exibe : exibe_dica,
            video_1 : video_1,
            video_2 : video_2,
            video_3 : video_3,
            dica_titulo : dica_titulo,
            dica_subtitulo : dica_subtitulo,
            dica_texto : dica_texto,
            main_for_group: main_for_group,
            link_special: link_special,
            titulo_pagina: titulo_pagina,
            galeria_usuarios: galeria_usuarios,
            
            mat_lk_rcn_qtd: mat_lk_rcn_qtd,
            mat_lk_rcn_afi: mat_lk_rcn_afi,
            mat_lk_rcn_adv: mat_lk_rcn_adv,
            mat_lk_rcn_blc: mat_lk_rcn_blc,
            mat_lk_rcn_img: $('#mat_lk_rcn_img').val(),
            
            gal_date: gal_date,
            gal_fr_dt: gal_fr_dt,
            gal_subfr_dt: gal_subfr_dt,
            
            evt_date: $("input[name='evt_date_exibe']").is(':checked'),
            evt_fr_prof: $('#evt_frase_profissionais').val(),
            evt_fr_dt: $('#evt_frase_details').val(),
            evt_form_type: $("input[name='evt_form_type']:checked").val(),
            evt_calendario_exibe: $("input[name='evt_calendario_exibe']").is(':checked'),
            evt_formulario_open: $("input[name='evt_formulario_open']").is(':checked'),
            evt_img_size: $("#evt_img_size").val(),           
            
            prod_qtd_vitrine: $('#prod_qtd_vitrine').val(),
            
            forn_phrase: $('#forn_phrase').val(),
            
            ctt_company_name: $('#ctt_company_name').val(),
            ctt_address: $('#ctt_address').val(),
            ctt_tel_1: $('#ctt_tel_1').val(),
            ctt_tel_2: $('#ctt_tel_2').val(),
            ctt_fax: $('#ctt_fax').val(),
            ctt_celular: $('#ctt_celular').val(),
            ctt_email: $('#ctt_email').val(),
            ctt_cidade: $('#ctt_cidade').val(),
            ctt_estado: $('#ctt_estado').val(),
            ctt_site: $('#ctt_site').val(),
            
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
            dc_copyright: $('#dc_copyright').val(),           
            
            //Facebook
            fb_titulo: $('#rds_titulo').val(),
            fb_texto: $('#rds_descricao').val(),
            fb_slot_1: $('#submit_pict_id_12').val(),
            
            //Depoimentos
            titulo_depoimento: $('#titulo_depoimento').val(),
            subtitulo_depoimento: $('#subtitulo_depoimento').val(),
            descricao_depoimento: $('#descricao_depoimento').val(),
            
            gel_fr_initial: $('#chamada_inicial').val()


        },function(data){
            showAlertDim(data);
            if(action == "cadastrar"){
                clearForm();
            }
        });
    }
}

/*
 * Transform the boolean value to a int value
 * just to fit into DataBase
 * 
 */
function getRealValue(check_type){
    switch(check_type){
        case true:
            return 1;
        case false:
            return 0;
        default:
            return 0;
    }
}

/*
 * It clears the textfield related
 *
 */
function addTextField(i){
    $(".visibility" + i).fadeIn("slow");
}

/*
 * It clears the textfield related
 *
 */
function clearForm(){

    $('#name').val("");
    $('#menu').val("");
    $('#index').val("");
    $('#phrase').val("");
    $('#titulo').val("");
    $('#titulo_01').val("");
    $('#texto_01').val("");
    $('#titulo_02').val("");
    $('#texto_02').val("");
    $('#titulo_03').val("");
    $('#texto_03').val("");
    $('#titulo_04').val("");
    $('#texto_04').val("");
    $('#titulo_05').val("");
    $('#texto_05').val("");
    $('#titulo_06').val("");
    $('#texto_06').val("");

}

/*
 * TODO: Acho que nao esta sendo usado!
 * 
 * It sends the values from the radio button
 * It defines a new header to the layout selected
 *
 */
function defineLayout(id){

    var id_page = $("#helper_id").val();
    var selected = $("input[name='opcao']:checked").val();
    var controller = $("input[name='opcao']:checked").attr('title');
    var special_page = $("input[name='opcao']:checked").attr('id');

    $.post("/admin/paginas/definir", {
        id_page: id_page,
        selected: selected,
        controller: controller,
        special_page: special_page
    },
    function(data){
        showAlertDim(data);
    });
}

/*
 * It edits or removes the selected id
 *
 *
 */
function editForm(id, isAdvanced){
    var content = $("#helper_content").val();
    var type = "editar";
    
    if(content == "elearn") {
        window.location = "/admin/paginas/editar_curso/" + id + "-" + $("#helper_id_course").val();
    }else{
        if(isAdvanced == 'comum'){
            window.location = "/admin/paginas/editar/" + id;
        }else if(isAdvanced == 'mix'){
           window.location = "/admin/paginas_advanced/mix/" + id;       
        }else{
           window.location = "/admin/paginas_advanced/editar/" + id;
           
        }
    }
}


/*
 * It hide the selected id
 *
 */
function hidePage(id, status){
    
    $("#page_" + id).fadeOut("fast");
    
    $.post("/admin/paginas/hide/",{
        id: id,
        status: status
    },function(data){
        showAlertDim(data);
        setTimeout("tb_removeAlert('common')", 1500);
    });
}

/*
 * It deletes the record from the data base.
 *
 * @param number id
 *
 */
function completeActionAlertDim(){
    
    $("#page_" + id_item).fadeOut("fast");

    $.post("/admin/paginas/remover/",{
        id: id_item
    },function(data){
        showAlertDim(data);
        setTimeout("tb_removeAlert('common')", 1500);
    });
}



/*
 * Sets the number to show the next
 * field set visible or editable.
 * 
 */
function setLastFieldText(lastNum){
    next_field_set = lastNum;
}


/*
 * Sets combobox links helper
 * It applys the listeners for the combobox link
 * 
 */
function setComboBoxLinkListeners(){

    $("#select_link_01").change(function(){
        $("#link_01").val($("#select_link_01").val());
    });

    $("#select_link_02").change(function(){
        $("#link_02").val($("#select_link_03").val());
    });

    $("#select_link_03").change(function(){
        $("#link_03").val($("#select_link_03").val());
    });

    $("#select_link_04").change(function(){
        $("#link_04").val($("#select_link_04").val());
    });

    $("#select_link_05").change(function(){
        $("#link_05").val($("#select_link_05").val());
    });

    $("#select_link_06").change(function(){
        $("#link_06").val($("#select_link_06").val());
    });
}

var id_start_noticias_item = 0;
var slideSN = 0;
var size_new_slider = 183;
var slidPosNews = 0;
var qtdSlidTotal = 4;

/*
 * Método chamado dentro da view
 * isso evita alguns listeners desnecessários
 * 
 */
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