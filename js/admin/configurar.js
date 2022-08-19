/*
    Document   : configurar admin
    Created on : 11/04/2011, 19:31:00
    Author     : CarlosGarcia
    Description: Configurar class
    Purpose of the javascript follows.
*/

isPreventDefault = true;
//Init
$(document).ready(function(){

    $("#bt_submit_network").click(function(){
        submitFormNetWork();
    });

    $("#bt_submit_google_maps").click(function(){
        submitFormGoogleMaps();
    });
    
    $("#bt_submit_google_tags_manager").click(function(){
        submitFormGoogleTagsManager();
    });
    
    $("#bt_save_comboshare").click(function(){
        submitFormComboShare();
    });
    
    $("#bt_save_rss").click(function(){
        submitFormRss();
    });
    
    $("#bt_save_selos").click(function(){
        submitFormSelos();
    });

    $("#bt_submit_metatag").click(function(){
        submitFormMetaTag();
    });
    
    $("#bt_submit_faq").click(function(){
        submitFormFaq();
    });

    $("#bt_submit_google_analytics").click(function(){
        submitFormGoogleAnalytics();
    });
    
    $("#bt_submit_email_contato").click(function(){
        submitFormEmailContato();
    });
    
    $("#bt_define_view").click(function(){
        submitDefineView();
    });
    
    $("#bt_submit_app_info").click(function(){
        submitAppInfo();
    });
    
    $("#bt_submit_twitter_app_info").click(function(){
        submitTwitterAppInfo();
    });
    
    $('#bt_update').click(function(){       
        submitBannersAviso();
    });
    
    $('#bt_submit_devices').click(function(){       
        submitDevices();
    });
    
    $('#bt_update_social').click(function(){       
        updateSocial();
    });
    
    $('.bt_edit_faq').click(function(){       
        window.location = "/admin/configurar/faq_edit/"+ this.name;
    });
    
    $('.bt_remove_faq').click(function(){       
        removeFaq(this.name);
    });
    
    $('.comment_ok, .comment_no').click(function(){       
        statusFaq(this.name, $(this).attr('data-status'));
    });

});//Close Document Ready

/*
 * It sends the values from the redes sociais 
 * views
 *
 */
function submitFormNetWork(){
    
    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');

    var facebook = $('#facebook').val();
    var twitter = $('#twitter').val();
    var orkut = $('#orkut').val();
    var linkedin = $('#linkedin').val();
    var google_mais_um = $('#google_mais_um').val();
    var canal_youtube = $('#canal_youtube').val();
    var flickr = $('#flickr').val();
    var instagram = $('#instagram').val();
    var pinterest = $('#pinterest').val();

    $.post("/admin/configurar/cadastrar_redes_sociais",{
        facebook: facebook,
        twitter: twitter,
        orkut: orkut,
        linkedin: linkedin,
        google_mais_um: google_mais_um,
        canal_youtube: canal_youtube,
        flickr: flickr,
        instagram: instagram,
        pinterest: pinterest,
        rss: $('#rss').val(),
        email: $('#email').val(),
        telefone: $('#telefone').val(),
        skype: $('#skype').val(),
        home: $('#home').val(),
        site_map: $('#site_map').val()

    },function(data){
        showAlertDim(data);
    });
}

/*
 * It removes one FAQ record 
 *
 */
function removeFaq(id){

    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');

    $.post("/admin/configurar/faq_remove",{
        id: id

    },function(data){
        showAlertDim(data);
        $("#obj_container_" + id).fadeOut("slow");
    });
}

/*
 * It removes one FAQ record 
 * 
 * @param string
 * @param number
 *
 */
function statusFaq(id, status){

    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');

    $.post("/admin/configurar/faq_status",{
        id: id, status: status
    },function(data){
        var jsonObject = eval('(' + data + ')');
        showAlertDim(jsonObject['MESSAGE']);
        $("#obj_container_" + id).fadeOut('slow');
    });
}

/*
 * It sends the values from the meta tags 
 * views
 *
 */
function submitFormMetaTag(){

    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');
    
    var titulo = $('#titulo').val();
    var descricao = $('#descricao').val();
    var metatag = $('#metatag').val();

    $.post("/admin/configurar/cadastrar_meta_tags",{
        titulo: titulo,
        descricao: descricao,
        metatag: metatag,
        online: $("input[name='online']").is(':checked'),
        date_release: $('#date_release').val()
    },function(data){
        showAlertDim(data);
    });
}

/*
 * It sends the values from the meta tags 
 * views
 *
 */
function submitFormFaq(){

    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');
    
    var titulo = $('#titulo').val();
    var descricao = $('#descricao').val();
    var id = $('#helper_id_faq').val();
    var action = $('#helper_action').val();

    $.post("/admin/configurar/cadastrar_faq",{
        titulo: titulo,
        descricao: descricao,
        id: id,
        action: action
    },function(data){
        
        var jsonObject = eval('(' + data + ')');
        showAlertDim(jsonObject['message']);
    });
}

/*
 * It sends the values from the meta tags 
 * views
 *
 */
function submitFormGoogleAnalytics(){
    
    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');

    var google_analytics = $('#google_analytics').val();
    var google_analytics_view = $('#google_analytics_view').val();
    
    $.post("/admin/configurar/cadastrar_google_analytics",{
        google_analytics: google_analytics,
        google_analytics_view: google_analytics_view
    },function(data){
        showAlertDim(data);
    });
}

/*
 * It sends the values from the meta tags 
 * views
 *
 */
function submitFormGoogleMaps(){
    
    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');

    var google_maps = $('#google_maps').val();
    $.post("/admin/configurar/cadastrar_google_maps",{
        google_maps: google_maps
    },function(data){
        showAlertDim(data);
    });
}

/*
 * It sends the values from the tags manager 
 * views
 *
 */
function submitFormGoogleTagsManager(){
    
    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');

    var google_tags = $('#google_tags').val();
    $.post("/admin/configurar/cadastrar_google_tags_manager",{
        google_tags: google_tags
    },function(data){
        showAlertDim(data);
    });
}

/*
 * It sends the values from the E-mail conato 
 * views
 *
 */
function submitFormEmailContato(){
    
    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');
    
    var title = $('#titulo').val();
    var email = $('#email').val();
    var email_ceos = $('#email_ceos').val();
    var email_sender = $('#email_sender').val();
    
    $.post("/admin/configurar/cadastrar_email",{
        titulo: title,
        email: email,
        email_ceos: email_ceos,
        email_sender: email_sender,
        email_emkt: $('#email_emkt').val(),
        email_emkt_teste: $('#email_emkt_teste').val()
    },function(data){
        showAlertDim(data);
    });
}

/*
 * It sends the values from the redes sociais 
 * views
 *
 */
function submitDefineView(){
    
    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');

    var type_view = $('#helper_type_view').val();
    var view = $("input[name='opcao']:checked").val();

    $.post("/admin/configurarview/definir_view",{
        view: view,
        type_view: type_view    

    },function(data){
        showAlertDim(data);
    });
}

/*
 * It sends the values from the Facebook app info
 * saves secret and app id
 *
 */
function submitAppInfo(){
    
    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');

    var app_id = $('#id_app').val();
    var secret = $('#secret').val();
    var id_page = $('#id_page').val();

    $.post("/admin/facebook/salvar_app_info",{
        id_app: app_id,
        secret: secret,
        id_page: id_page

    },function(data){
        showAlertDim(data);
    });
}

/*
 * It sends the values from the Twitter app info
 * saves secret and app id
 *
 */
function submitTwitterAppInfo(){
    
    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');

    $.post("/admin/twitter/salvar_app_info",{
        consumer_key: $('#consumer_key').val(),
        consumer_secret: $('#consumer_secret').val(),
        access_token: $('#access_token').val(),
        access_secret:  $('#access_secret').val() 

    },function(data){
        showAlertDim(data);
    });
}



/*
 * It sends the values by POST
 * All field must be declared bellow
 * 
 * @param string
 *
 */
function submitBannersAviso(){

    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');
    
    var banner_pf  = $('#id_slot_1').text();
    var banner_pj = $('#id_slot_2').text();
    var banner_admin = $('#id_slot_3').text();
    var banner_funcionarios = $('#id_slot_4').text();
    
    var link_pf = $("#link_banner_pf").val();
    var link_pj = $("#link_banner_pj").val();
    var link_admin = $("#link_banner_admin").val();
    var link_funcionarios = $("#link_banner_funcionarios").val();
    
    $.post("/admin/configurarview/definir_banners",{            
        banner_pf: banner_pf,            
        banner_pj: banner_pj,
        banner_admin: banner_admin,
        banner_funcionarios: banner_funcionarios,
        link_pf: link_pf,
        link_pj: link_pj,
        link_admin: link_admin,
        link_funcionarios: link_funcionarios

    },function(data){
        showAlertDim(data);
    });   
}

/*
 * It sends the values by POST
 * All field must be declared bellow
 * 
 * @param string
 *
 */
function submitDevices(){

    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');
    
    var smartphone  = $("input[name='smartphone']:checked").val();
    var tablet = $("input[name='tablet']:checked").val();
    
    $.post("/admin/configurarview/definir_devices",{            
        smartphone: smartphone,            
        tablet: tablet

    },function(data){
        showAlertDim(data);
    });   
}

/*
 * It sends the values by POST
 * All field must be declared bellow
 * 
 * @param string
 *
 */
function submitFormComboShare(){
    
    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');
    
    //Combo share
    var exibe  = $("input[name='exibe']").is(':checked');
    var position = $('#position_combo_share').val();
    var color = $('#color_combo_share').val();
    var position_py = $('#position_py').val();
    
    // FAcebook likebox
    var exibe_likebox  = $("input[name='exibe_likebox']").is(':checked');
    var position_likebox = $('#position_likebox').val();
    var color_likebox = $('#color_likebox').val();
    var position_py_likebox = $('#position_py_likebox').val();
    
    $.post("/admin/configurar/definir_combo_share",{            
        exibe: exibe,
        position: position,
        position_py: position_py,
        color: color,
        exibe_likebox: exibe_likebox,
        position_likebox: position_likebox,
        position_py_likebox: position_py_likebox,
        color_likebox: color_likebox

    },function(data){
        showAlertDim(data);
    });   
}

/*
 * It sends the values by POST
 * All field must be declared bellow
 * 
 * @param string
 *
 */
function submitFormRss(){

    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');
    
    var exibe_materia  = $("input[name='exibe_materia']").is(':checked');
    var titulo_materia  = $("#titulo_materia").val();
    var texto_materia  = $("#texto_materia").val();
    
    var exibe_eventos  = $("input[name='exibe_eventos']").is(':checked');
    var titulo_eventos  = $("#titulo_eventos").val();
    var texto_eventos  = $("#texto_eventos").val();
    
    var exibe_produtos  = $("input[name='exibe_produtos']").is(':checked');
    var titulo_produtos  = $("#titulo_produtos").val();
    var texto_produtos  = $("#texto_produtos").val();
    
    $.post("/admin/configurarview/rss_salvar",{            
        exibe_materia: exibe_materia,
        titulo_materia: titulo_materia,
        texto_materia: texto_materia,
        exibe_eventos: exibe_eventos,
        titulo_eventos: titulo_eventos,
        texto_eventos: texto_eventos,
        exibe_produtos: exibe_produtos,
        titulo_produtos: titulo_produtos,
        texto_produtos: texto_produtos

    },function(data){
        showAlertDim(data);
    });   
}

/*
 * It sends the values by POST
 * All field must be declared bellow
 * 
 * @param string
 *
 */
function submitFormSelos(){

    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');
    
    var exibe_ebit_selo  = $("input[name='exibe_ebit_selo']").is(':checked');
    var exibe_ebit_banner  = $("input[name='exibe_ebit_banner']").is(':checked');
    var ebit_selo_cod  = $("#ebit_selo_cod").val();
    var ebit_banner_cod  = $("#ebit_banner_cod").val();
    
    $.post("/admin/configurarview/selos_salvar",{            
        exibe_ebit_selo: exibe_ebit_selo,
        exibe_ebit_banner: exibe_ebit_banner,
        ebit_selo_cod: ebit_selo_cod,
        ebit_banner_cod: ebit_banner_cod

    },function(data){
        showAlertDim(data);
    });   
}

/*
 * Update social posts
 * 
 *
 */
function updateSocial(){
    
    //Put a preloader on stage
    showAlertDimPreloader(true, 'Atualizando...');
    
    $.post("/admin/configurar/update_social",{},function(data){
        showAlertDim(data);
    });   
}