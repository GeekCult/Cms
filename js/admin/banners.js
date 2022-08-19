/*
 *
    Document   : banner admin
    Created on : 04/04/2011, 21:31:00
    Author     : CarlosGarcia
    Description:
    Purpose of the javascript follows.
*
*/

var objAdvertise = new Object();

$(document).ready(function() {
   if($("#helper_action").attr('data-js-action') == 'settings_flutuante') initFlutuanteSettingsListeners(); 
});

/*
 * Initial listeners for settings attributes
 * 
 */
function initBannersStatistic(){
    
    $(".table_support :button").click(function(){
        switch(this.id){
            
            case "bt_settings":
                editBanner(this.name);
                break;
        }

    });
}

/*
 * Edits the banners
 * It separates the kind of banner and launch its.
 * 
 */
function editBanner(id){    
    window.location = "/admin/html_banners/settings/"+id;
}

/*
 * Listar
 * It's just used in listar action
 *
 */
function initListenerListar(){    

    $('#bt_define').click(function(){
        defineTopo();
    });

    $("#buttons_banner_list_support :button").click(function() {
   
       switch(this.id) {
            //Edit html
            case "bt_edit":
                var local = $("#helper_local").val();
                window.location = "/admin/" + local + "/editar/" + this.name;
                break;
            //Edit render_partial
            case "bt_edit_render":
                var local = $("#helper_local").val();
                window.location = "/admin/html_renderpartial/editar/" + this.name;
                break;
            //Edit topo
            case "bt_tools":
            case "bt_publicidade_online":
                var local =$("#helper_local").val();
                window.location = "/admin/" + local + "/settings/" + this.name;
                break;
            //Delete topo
            case "bt_delete":
                verifyActionBanner(this.name);
                break;
       }
    });
    
    $('#bt_buy_item').live('click', function(){  
        window.location = '/admin/' + $(this).attr('name') + '/comprar';        
    });
    
    $('#bt_my_item').live('click', function(){  
        window.location = '/admin/' + $(this).attr('name') + '/listar';        
    });
    
    $(".bt_buy_item_pp").live('click', function(){
        buyPPItem(this.name, $(this).attr('rel'));
    });
    
    var link_loja = "/site/purplestore/exibe";
    $("#fancybox_buy_items").fancybox({
        'transitionIn'          :'elastic',
        'transitionOut'         :'elastic',
        'speedIn'               : 300,
        'speedOut'              : 200,
        'autoDimensions'        : false,
        'width'                 : 720,
        'height'                : 420,
        'overlayShow'           : true,
        'href'                  : link_loja,
        'titleShow'             : false
    });

    $(".bt_advertise, .bt_publicidade_dirigida").click(function() {
        loadAdvertiseDirigida($(this).attr('id'));
    });
    
    $(".bt_publicidade_flutuante").click(function() {
        loadAdvertiseFlutuante($(this).attr('id'));
    });
    
    $(".bt_publicidade_global").click(function() {
        loadAdvertiseGlobal($(this).attr('id'));
    });

    $(".bt_close_black").click(function() {
       $("#ctnAll").toggle();
    });
    
    $("#bt_close_publicidade_flutuante").click(function() {
       $("#ctnFlutuante").toggle();
    });
    
    $("#bt_close_publicidade_global").click(function() {
       $("#ctnGlobal").toggle();
    });
    
    $(".bt_delete").click(function() {
       $("#ctnAll").hide();
    });
    
    
    $(".html_banner_checkbox").click(function() {
        //Put a preloader on stage
        showAlertDimPreloader(true, 'Definindo...');
       $.post("/admin/html_banners/define_main_banner",{
            id: $(this).val(),
            status: $(this).is(':checked')
        },function(data){
            showAlertDim(data);
            setTimeout("tb_removeAlert('common')", 1500);
        });
    }); 

    $("#ctnAll :checkbox").click(function() {
        
        var banner_id = $(this).parents('#ctnAll').attr('data-id');
        var index = $('#idx_' + $(this).attr('name')).val();
        var size = $('#helper_local').val();
        
        if($(this).attr('checked')) {
            updateStatusSelection(banner_id, this.name, 1, index, size, "advertise", '00/00/0000');
        } else {
            updateStatusSelection(banner_id, this.name, 0, index, size, "advertise", '00/00/0000');
        }
    });
    
    $("#bt_save_flututante").click(function() {
        
        var banner_id = $('#helper_id_html_action').attr('data-id-flutuante');
        var index = 0;
        var size = $('#helper_local').val();
        var status = $('#exibe_publicidade_flutuante').is(':checked');
        var expira = $('#expira_flutuante').val();
        
        updateStatusSelection(banner_id, 0, status, index, size, "flutuante", expira);        
    });
    
    $("#bt_save_global").click(function() {
        
        var banner_id = $('#helper_id_html_action').attr('data-id-flutuante');
        var index = 0;
        var size = $('#helper_local').val();
        var status = $('#exibe_publicidade_global').is(':checked');
        var expira = $('#expira_global').val();
        
        updateStatusSelection(banner_id, 0, status, index, size, "global", expira);        
    });
    
    $('.icon_save').click(function(){$('#bt_define').trigger('click');});
}

function updateAdversiteOptions(id){
    
    var allVals = [];
    var nr = 0;
    $('#ctnAll :checkbox:checked').each(function() {
        allVals.push($(this).attr('name'));
    });
    return allVals.toString();
}

/*
function sendAdvertiseBanners(banners, id) {
    // console.log(banners);
    // console.log(id);
    objAdvertise['nr'] = $("#helper_qtd_pages").val();
    objAdvertise['banners'] = banners;
    //Lets convert our JSON object
    var postData = JSON.stringify(objAdvertise); 
    var nr_perguntas = $("#helper_qtd_pages").val();

    
}
*/


/**
 * Select Form
 * It sends the values from the textfield
 *
 */
function updateStatusSelection(id_banner, id_page, status, index, size, tipo, expira) {
    
    if(index == '') index = 0;
    //Put a preloader on stage
    showAlertDimPreloader(true, 'Definindo...');
    $.post("/admin/html_banners/advertise",{
        id_banner: id_banner,
        id_page: id_page,
        status: status,
        index: index, 
        size: size,
        tipo: tipo,
        expira: expira

    }, function(data) {
        var jsonObject = eval('(' + data + ')');
        showAlertDim(jsonObject['message']);
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
function verifyActionBanner(id){
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
    
    var local_tipo = $("#helper_local_logout").val();
    var place = "admin";
    
    if(local_tipo == "conta" || local_tipo == "site") place = "conta";
    
    $.post("/" + place + "/banners/html_banners/deletar",{
        id: id_item
    },function(data){
        $("#obj_container_" + id_item).fadeOut("slow");
        showAlertDim(data);
        setTimeout("tb_removeAlert('common')", 1500);
    });
}

function initListenersDefinicoes(){
    
    $("#buttons_laterais").change(function(){
        //Put a preloader on stage
        showAlertDimPreloader(true, 'Definindo...');
        $.post("/admin/detalhes/side_button/alterar",{
            selected: $(this).val()
        },function(data){
            window.location.reload();
            
        });
    });
    
    $("#shadow_banner").change(function(){
        //Put a preloader on stage
        showAlertDimPreloader(true, 'Definindo...');
        $.post("/admin/detalhes/banner_shadow/definir",{
            selected: $(this).val(),
            type: 'texto'
        },function(data){
            showAlertDim('Altereção realizada com sucesso!');
            setTimeout("tb_removeAlert('common')", 1500);
        });
    });
    
    $("#bt_submit").click(function(){
        //Put a preloader on stage
        showAlertDimPreloader(true, 'Definindo...');
        $.post("/admin/detalhes/banner_attributes/definir_banners_propriedades",{
            altura: $('#banner_altura').val(),
            distancia: $('#banner_distancia').val(),
            data: $("form#form_content").serialize(),
            type: 'texto'
        },function(data){
            showAlertDim(data);
            setTimeout("tb_removeAlert('common')", 1500);
        });
    });
    
    
    $('#animation').val($('#helper_action').attr('data-animation'));
    
}


/**
 ** PUBLICIDADEs FLUTUANTE e DIRIGIDA
/**


/*
 * It loads the banners pages where it is displayed
 * 
 * @param number
 * 
*/
function loadAdvertiseDirigida(id){

    $("#ctnAll input[type=checkbox]").each(function () {
        $(this).attr("checked", false);
    });
    
    $("#ctnAll .miniT").each(function () {
        $(this).val("");
    });

    $.post("/admin/html_banners/advertise_load_exibitions",{
        id_banner: id
        
    },function(data){
        var jsonObject = eval('(' + data + ')');
        if(jsonObject.length > 0){
            for(i = 0; i < jsonObject.length; i++){
                $('#pg_' + jsonObject[i]['page_id']).attr('checked', true);
                $('#idx_' + jsonObject[i]['page_id']).val(jsonObject[i]['n_index']);
            }
        }
        $("#ctnAll").toggle().attr('data-id', id);
    }); 
}

/*
 * It loads the banners pages where it is displayed
 * 
 * @param number
 * 
*/
function loadAdvertiseFlutuante(id){

    $('#exibe_publicidade_flutuante').attr('checked', false);
    $("#expira_flutuante").val("");

    $.post("/admin/html_banners/flutuante_load_exibition",{id_banner: id},function(data){
        var jsonObject = eval('(' + data + ')');
        if(jsonObject){
            $("#expira_flutuante").val(jsonObject['data']),
            $('#exibe_publicidade_flutuante').attr('checked', true);
        }
    });
    
    $('#helper_id_html_action').attr('data-id-flutuante', id);
    $("#ctnFlutuante").toggle().attr('data-id', id);
    
}

/*
 * It loads the banners pages where it is displayed
 * 
 * @param number
 * 
*/
function loadAdvertiseGlobal(id){

    $('#exibe_publicidade_global').attr('checked', false);
    $("#expira_global").val("");

    $.post("/admin/html_banners/global_load_exibition",{id_banner: id},function(data){
        var jsonObject = eval('(' + data + ')');
        if(jsonObject){
            $("#expira_global").val(jsonObject['data']),
            $('#exibe_publicidade_global').attr('checked', true);
        }
    });
    
    $('#helper_id_html_action').attr('data-id-flutuante', id);
    $("#ctnGlobal").toggle().attr('data-id', id);
    
}

/*
 * It apply the listeners for Flutuantes
 * 
 * 
*/
function initFlutuanteSettingsListeners(){

    $("#bt_submit").click(function(){
        
        $.post("/admin/html_banners/flutuante_salvar_settings",{
            page: $("input[name='f_page']:checked").val(),
            frequency: $("input[name='f_view']:checked").val(),
            timer: $("#timer").val()
        },function(data){
            var jsonObject = eval('(' + data + ')');
            showAlertDim(jsonObject['message']);
        });
    });

    
}


/* 
 * Updates the values 
 * 
 * Settings keyowrds, names and others values
 * 
 */
function setBannersAddsSettings(){
     
    var current_view = "support_keywords_banners";
    
    //Buttons adds keywords, link, name
    $("#bt_add_keywords").click(function(){
       $("#support_settings_banners, #support_background_banners").hide(); 
       $("#support_keywords_banners").fadeIn("fast");
       $("#bt_continue_banners_2").hide();
       $("#bt_continue_banners").show();
       $("#support_payments_banners").hide();
       $("#support_date_banners").hide();
       current_view = "support_keywords_banners";       
    });
    
    //Button adds credits
    $("#bt_add_credit").click(function(){
       $("#support_keywords_banners, #support_background_banners").hide();
       $("#support_settings_banners").fadeIn("fast");
       $("#bt_continue_banners").hide();
       $("#bt_continue_banners_2").show();
       $("#support_payments_banners").hide();
       $("#support_date_banners").hide();
       current_view = "support_settings_banners";
    });
    
    //Button adds credits
    $("#bt_add_date").click(function(){
       $("#support_keywords_banners, #support_background_banners").hide();
       $("#support_date_banners").fadeIn("fast");
       $("#bt_continue_banners").hide();
       $("#bt_continue_banners_2").show();
       $("#support_payments_banners").hide();
       current_view = "support_settings_banners";
    });
    
    //Button handle background
    $("#bt_handle_background").click(function(){
       $("#support_keywords_banners, #support_settings_banners").hide();
       $("#support_background_banners").fadeIn("fast");
       $("#bt_continue_banners").hide();
       $("#bt_continue_banners_3").show();
       $("#support_payments_banners").hide();
       $("#support_date_banners").hide();
       current_view = "support_background_banners";
    });
    
    //Button keep on
    $("#bt_continue_banners").click(function(){       
        $("#support_keywords_banners").hide();
        $("#support_date_banners").hide();
        $("#support_settings_banners").fadeIn("fast");        
    }); 
    
    //Button remove crédits
    $(".bt_remove_credits_banners").click(function(){ 
        var place = $("#helper_place").val();
        $.post("/site/relatar/clear_credits",{
            id: $('#helper_id_banner').val()      
        },function(data){
            if(place == 'admin'){
                showAlertDim("Créditos removidos com sucesso!");
            }else{            
                showPopUp("toast", "Créditos removidos com sucesso!",  'message_simple', 400, 30, false);
            }           
        });      
    });
    
    //Button save settings
    $("#bt_continue_banners_2, #bt_continue_banners_3").click(function(){
        
        var id = $("#helper_id_banner").val();
        var nome = $("#name_banner").val();
        var titulo = $("#titulo").val();
        var descricao = $("#descricao").val();
        var keywords = $("#keywords_banner").val();
        var expira = $("#date_banner").val();
        var lance = $("#lance").val();
        var max_value = $("#valor_max").val();
        var link = $("#link_banner").val();
        var place = $("#helper_place").val();
        credito = $("#payment_banner").val(); 
        var cred_business_page = $("#creditos_business_page").val();
        var background = $("#id_slot_1").text();
        
        //Put a preloader on stage
        showAlertDimPreloader(true, 'Salvando...');
        
        $.post("/conta/banners/salvar",{
            id: id,
            nome: nome,
            keywords: keywords,
            lance: lance,  
            max_value: max_value, 
            expira: expira,
            titulo: titulo,
            descricao: descricao,
            link: link,
            valor: credito,
            place: place,
            creditos_user: cred_business_page,
            background: background
            
        },function(data){  
            $(".message_result_banners").fadeIn("slow");
            if(place == 'admin'){
                showAlertDim("Alteração realizada com sucesso!");
            }else{
                showPopUp("toast", "Alteração realizada com sucesso!",  'message_simple', 400, 30, false);            
            }
        });
    });
    
    
    //Button save settings
    $("#bt_cart_credits").click(function(){
        var valor_credito = formatValueToFloat($("#payment_banner").val());
        buyCredits(this.alt, "banner", valor_credito);
    });
    
    setFieldsBehaviour();
}

/* 
 * Set behaviours 
 * 
 * Sets the main fields, it makes some calcules.
 * 
 */
function setFieldsBehaviour(){ 
    
   $("#lance").focus(function(){
        if($('#lance').val() != ""){
           $('#lance').val('');
        }
    });

    $('#lance').blur(function(){
        if($('#lance').val() == ''){
           $('#lance').val($("#lance_current_formated").val());
        }
    });
    
    $("#valor_max").focus(function(){
        if($('#valor_max').val() != ""){
           $('#valor_max').val('');
        }
    });

    $('#valor_max').blur(function(){
        if($('#valor_max').val() == ''){
           $('#valor_max').val($("#valor_max_formated").val());
        }
    });
   
} 