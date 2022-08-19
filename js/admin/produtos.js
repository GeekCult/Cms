/*
    Document   : produtos admin
    Created on : 31/12/2010, 16:31:00
    Author     : CarlosGarcia
    Description:
    Purpose of the javascript follows.
*/
var slotFoto = 0;

//Init
$(document).ready(function(){

    if($('#action_helper').val() == 'listar') initListar();  
    if($('#action_helper').val() == 'novo' || $('#action_helper').val() == 'editar') setTimeout("initListenersFotosProdutos()", 200);
    if($('#action_helper').val() == 'categorias_listar') initCategoriasListListeners();
    if($('#action_helper').val() == 'categorias_settings') initCategoriasSettingsListeners();
    

});//Close Document Ready

/*
 * It inits the listener and actions for the listar produtos
 *
 */
function initListar(){

    $('body').on('click', '.table_support :button', function(e) {
        switch(this.id){

            case "bt_delete":
                verifyAction(this.name);
                break;

            case "bt_edit":
                editForm(this.name);
                break;
                
            case "bt_marketplace":
                window.location = "/admin/produtos/marketplace/id/" + this.name;
                break;
        }
    });
    
    //Listar - produtos com programas ou com outros produtos linkados
    $(".bt_programas").live('click', function(){
       handleProgramas(this.id); 
    });
    
    
    /**
    * Just to set some info needed
    **/
    $('.bt_speaker').click(function(){
       $("#helper_type_id").val($(this).attr('name'));
    });
    
    $("#categoria").change(function() {
        $.post("/site/relatar/set_session_data",{id_user: 0,label: 'produtos_filtro_categoria', value: $(this).val()},function(data){
            window.location = "/admin/produtos/listar/";        
        });
    }); 
    
    $("#mais_filtros").change(function() {
        $.post("/site/relatar/set_session_data",{id_user: 0,label: 'produtos_mais_filtro', value: $(this).val()},function(data){
            window.location = "/admin/produtos/listar/";        
        });
    });
    
    $("#bt_search").click(function() {
        
        if($('#referencia').val() != '' || $('#titulo').val() != ''){
            $.post("/admin/produtos/buscar",{
                referencia: $('#referencia').val(),
                titulo: $('#titulo').val()

            },function(data){
                var jsonObject = eval('(' + data + ')');            
                $('#ItemManager').empty().append(jsonObject['view']);  
                //$(".ctn_paginador_items").hide();
            });
        }
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
    
    $("#container_" + id_item).fadeOut("fast");

    $.post("/admin/produtos/remover",{
        id: id_item
    },function(data){
        showAlertDim(data);
        setTimeout("tb_removeAlert('common')", 1500);
    });
}

/*
 * It edits the record from the data base.
 *
 * @param number id
 *
 */
function editForm(id){
    window.location = "/admin/produtos/editar/id/" + id;
}

/*
 * It inits the listener and actions for the edit details
 *
 */
function initEditDetails(){

    $('#bt_update, .bt_update_shortcut').click(function(e) {
        submitDetailsProdutos();
    });
}

/*
 * Submit detaisl for e-commerce
 *
 */
function submitDetailsProdutos(){
    
    var bt_shopcart = $("#shopcart input[name='shopcart']:checked").val();
    var frame_vitrine = $("#frames input[name='frame_vitrine']:checked").val();
    var menu_loja = $("#menu_store input[name='menu_loja']:checked").val();
    
    var valor_free = $("input[name='price_produto']:checked").val();
    var showcase = $("input[name='exibe_showcase']").is(':checked');
    var categorias_home = $("input[name='exibe_categorias_home']").is(':checked');
    var embalagem = $("input[name='exibe_embalagem']").is(':checked');
    var transporte = $("input[name='exibe_transporte']").is(':checked');
    var frete_gratis = $("#frete_gratis").val();
    
    var quantidade = $("input[name='exibe_quantidade']").is(':checked');
    var parcelamento = $("input[name='exibe_parcelamento']").is(':checked');
    var vitrine_layout = $("#vitrine_layout").val();
    var categoria_home_layout = $("#categoria_home_layout").val();
    var cep_origem = $("#cep_origem").val();
    
    var menu_produtos_type = $("input[name='menu_produtos_type']:checked").val();
    var outras_informacoes = $("#outras_informacoes").val();
    var prazo_entrega = $("#prazo_entrega").val();
    var mensagem = $("#mensagem").val();
    
    //Put a preloader on stage
    showAlertDimPreloader();
   
    $.post("/admin/produtos/salvar_detalhes",{
        bt_shopcart: bt_shopcart,
        frame_vitrine: frame_vitrine,
        menu_loja: menu_loja,
        valor_free: valor_free,
        showcase: showcase,
        categorias_home: categorias_home,
        embalagem: embalagem,
        transporte: transporte,
        quantidade: quantidade,
        parcelamento: parcelamento,
        cep: cep_origem,
        vitrine_layout: vitrine_layout,
        categoria_home_layout: categoria_home_layout,
        outras_informacoes: outras_informacoes,
        prazo_entrega: prazo_entrega,
        menu_produtos_type: menu_produtos_type,
        mensagem: mensagem,
        frete_gratis: frete_gratis,
        limite_pagina: $('#limite_pagina').val(),
        layout_exibicao: $("input[name='layout_exibicao']:checked").val(),
        ordenar_exibicao: $("input[name='ordem_exibicao']:checked").val(),
        exibe_preco: $("input[name='exibe_preco']:checked").val(),
        exibe_foto: $("input[name='exibe_foto']:checked").val(),
        exibe_descricao: $("input[name='exibe_descricao']:checked").val(),
        isAdmin: true
        
    },function(data){
        var jsonObject = eval('(' + data + ')');
        showAlertDim(jsonObject['message']);
        setTimeout("tb_removeAlert('common')", 2500);
    });
}

/*
 * It show and hides programas
 *
 * @param number id
 *
 */
function handleProgramas(id){
    
    if ($(".ctnPro_" + id).hasClass('hide')){
        $(".ctnPro_" + id).removeClass('hide');
        $("#"+ id).attr("src", "/media/images/icons/icon_mais3.png");
    }else{
        $(".ctnPro_" + id).addClass('hide');
        $("#"+ id).attr("src", "/media/images/icons/icon_mais2.png");
    }
}






    
//Helper with slot pictures
//It's incremented each image upload into the
//slot
slotFoto = 1;


/*
 * Sets some listeners to be used in the avatar selection  
 * If an avatar free is selected
 *
 */
function initListenersFotosProdutos(){
    
    $('#slot_support div.container_slot').click(function(){            
        slotFoto = this.id;
    });
    
    $("#categoria").change(function(){
        reloadSubCategoriasEcommerce($("#categoria").val(), $('#id_produto').val());
    });
    
    $("#subcategoria").live('change', (function(){
        reloadSubItemEcommerce($("#subcategoria").val(), $('#id_produto').val());
    }));
    
    $("#tipo").change(function(){
        reloadTypeProduct($(this).val());
    });
    
    $('.container_icons_payment :input').click(function(){
       //alert('ooo' + $(this).attr('alt')); 
       $('.container_icons_payment :input').removeClass('active');
       $(this).addClass('active');
       $('#parcelas').val($(this).attr('alt'));
    });
    
    //
    $('.base_bt_remove').click(function(){
        var id_produto = $('#id_produto').val();
        removeImageFromProduct(this.id, id_produto, $('#picture'+this.id).val());
    });
    
    $("#form-botao-continuar").click(function(){
        submitFormProducts();
    })
    
    $('#form-botao-atualizar').click(function(){
       window.location = '/admin/produtos/editar/' + $(this).attr('rel'); 
    });
    
    setListenersTabs();
    initEditPicturesListener();
    initProductVariables();
    
}

/*
 * This method is called from a javascript request
 * Some bugs with data were happening, so this avoid
 * some troubles.
 * 
 */
function setListenersTabs(){
    //Tab description
    $("#bt_description_main").click(function(){
        $("#support_description").fadeIn("fast");
        $("#support_images").hide();
        $("#support_transportation").hide();
        $("#support_extras").hide();
        $("#support_videos").hide();
    });
    
    //Tab transportation
    $("#bt_transportation").click(function(){
        $("#support_description").hide();
        $("#support_images").hide();
        $("#support_transportation").fadeIn("fast");
        $("#support_extras").hide();
        $("#support_videos").hide();
        $("#support_embalagem").hide();
    });
    
    //Tab transportation
    $("#bt_images_product").click(function(){
        $("#support_description").hide();
        $("#support_images").fadeIn("fast");
        $("#support_transportation").hide();
        $("#support_extras").hide();
        $("#support_videos").hide();
        $("#support_embalagem").hide();
    });
    
    //Tab extras
    $("#bt_extras").click(function(){
        $("#support_description").hide();
        $("#support_images").hide();
        $("#support_transportation").hide();
        $("#support_extras").fadeIn("fast");
        $("#support_videos").hide();
        $("#support_embalagem").hide();
    });
    
    //Tab video
    $("#bt_videos_product").click(function(){
        $("#support_description").hide();
        $("#support_images").hide();
        $("#support_transportation").hide();
        $("#support_extras").hide();
        $("#support_videos").fadeIn("fast");
        $("#support_embalagem").hide();
    });
    
    //Tab embalagem
    $("#bt_embalagem_product").click(function(){
        $("#support_description").hide();
        $("#support_images").hide();
        $("#support_transportation").hide();
        $("#support_extras").hide();
        $("#support_videos").hide();
        $("#support_embalagem").fadeIn("fast");
    });
    
    $('.icon_save').click(function(){
        $('#form-botao-continuar').trigger('click');
    });
}

/*
 * This method is called from a javascript request
 * Some bugs with data were happening, so this avoid
 * some troubles.
 * 
 */
function updateDates(dataInicio, dataTermino){
    $("#formPoolDataInicio").val(dataInicio);
    $("#formPoolDataTermino").val(dataTermino);
}

//Produtos
//***********************************************************************************
//***********************************************************************************
//***********************************************************************************
//Produtos


/*
 *  This stament shows or not the edits slots buttons
 *
 *
 */    
function initEditPicturesListener(){

    $("#slot_support_pict div.container_slot").mouseenter(function(){

        if($("#id_slot_" + this.id).text() != ""){
           $("#base_" + this.id).fadeIn("faster");
        }         

    }).mouseleave(function(){
        $("#base_" + this.id).fadeOut("faster");
    });

    //bug fix for fancybox images
    $(".base_bt_remove").click(function(e){
        $("#slot_picture" + this.id).attr("src", "empty.png");
        $("#formPoolFake_img_" + this.id).css("background", "url(/media/images/layout/missing/missing_120x120.jpg)");
        $("#id_slot_"     + this.id).text("");
        $("#formSlotPicture"+ this.id).val("empty");
        slotFoto = this.id;
    });
}

/*
 * This is essencials for the upload images
 * to work property
 * 
 * @param string
 *
 */
function replaceCharacteres(file_name){

    $.post("/site/validar/file_name",{
        file_name: file_name
    },function(data){
        $("#file_helper").val(data);

    });
}

/*
 * It reloads the combobox subcategoria.
 *
 * @param number id
 *
 */
function reloadSubCategoriasEcommerce(id, id_produto){
   
    $.post("/admin/categorias/reload_subcategoria_ecommerce", {
        id: id,
        id_produto: id_produto,
        tipo: $("#helper_action").attr('data-tipo')
        
    },function(data){
        $("#loader_combo_subcategorias").empty().append(data); 
        reloadSubItemEcommerce($('#subcategoria').val(), id_produto);
    });
}

/*
 * It reloads the combobox subitem.
 *
 * @param number id
 *
 */
function reloadSubItemEcommerce(id, id_produto){

    $.post("/admin/categorias/reload_subitems_ecommerce", {
        id: id,
        id_produto: id_produto
    },function(data){
        $("#loader_combo_subitem").empty().append(data);        
    });
}

/*
 * It loads the combobox Modular products.
 *
 * @param number id
 *
 */
function reloadTypeProduct(type){
    
    //Gets the product especials
    if(type == "programa"){
        $.post("/admin/produtos/obter_produtos", {
            id: type
        },function(data){
            
            var jsonObject = eval('(' + data + ')');
            
            var itemOpt = "";
            
            for(var i = 0; i < jsonObject.length; i++){
                var sel = ($("#helper_id_master").val() == jsonObject[i]['id']) ? "selected" : "";
                var opt = "<option value='"+ jsonObject[i]['id'] +"' "+ sel +">"+ jsonObject[i]['nome'] +"</option>";
                itemOpt += opt;
            } 
            
            $("#linked").empty().append(itemOpt);
        });
    }
    
    //Hides and shows options
    if(type == "programa"){
        $(".optionsProducts").hide();
        $(".optionsExtra").show();
    }else{
        $(".optionsProducts").show();
        $(".optionsExtra").hide();
    }
}

/*
 * New method to submit product values
 * 
 * @param string
 *
 */
function submitFormProducts(){

    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');
    
    var content ={'marca': $('#marca').val(), 
                  'referencia': $('#referencia').val(),
                  'nome': $('#nome').val(),
                  'tipo': $('#tipo').val(),
                  'categoria': $('#categoria').val(),
                  'subcategoria': $('#subcategoria').val(),
                  'subitem': $('#subitem').val(),
                  'descricao': $('#descricao').val(),
                  'descricao_resumo': $('#descricao_resumo').val(),
                  'data_inicio': $('#data_inicio').val(),
                  'data_termino': $('#data_termino').val(),
                  'palavra_chave': $('#palavra_chave').val(),
                  'valor': $('#valor').val(),
                  'valor_real': $('#valor_real').val(),
                  'min': $('#min').val(),
                  'max': $('#max').val(),                  
                  'max_person': $('#max_person').val(),
                  'parcelas': $('#parcelas').val(),
                  'percentage': $('#percentage').val(),
                  'frete': $("input[name='check_transporte']").is(':checked'),
                  'retirar_local': $("input[name='retirar_local']").is(':checked'),
                  'transporte': $('#transporte').val(),
                  'peso': $('#peso').val(),
                  'altura': $('#altura').val(),
                  'largura': $('#largura').val(),
                  'comprimento': $('#comprimento').val(),
                  'diametro': $('#diametro').val(),
                  'embrulho': $('#embrulho').val(),
                  'estado': $('#estado').val(),
                  'regiao': $('#regiao').val(),
                  'promocao': $('#promocao').val(),
                  'reputacao': $('#reputacao').val(),
                  'vitrine': $("input[name='vitrine']").is(':checked'),
                  'lancamento': $("input[name='lancamento']").is(':checked'),
                  'produtos_exibe': $("input[name='produtos_exibe']").is(':checked'),
                  'ecommerce_exibe': $("input[name='ecommerce_exibe']").is(':checked'),
                  'prazo_entrega': $('#prazo_entrega').val(),
                  'id_categoria_menu': $('#id_categoria_menu').val(),
                  'sob_consulta': $("input[name='sob_consulta']").is(':checked'),
                  'ordem_servico': $("input[name='ordem_servico']").is(':checked'),
                  'id_user': $('#id_user').val(),
                  'id_produto': $('#id_produto').val(),
                  'n_index': $('#n_index').val(),
                  'action': $('#action').val(),
                  'extra1': $('#extra1').val(),
                  'extra2': $('#extra2').val(),
                  'video1': $('#video1').val(),
                  'frete_gratis': $("input[name='frete_gratis']").is(':checked'),
                  'picture1': $('#submit_pict_id_1').val(),
                  'picture2': $('#submit_pict_id_2').val(),
                  'picture3': $('#submit_pict_id_3').val(),
                  'picture4': $('#submit_pict_id_4').val(),
                  'picture5': $('#submit_pict_id_5').val(),
                  'picture6': $('#submit_pict_id_6').val()
                };
    
    $.post("/admin/produtos/salvar", content,function(data){
        var jsonObject = eval('(' + data + ')');
        showAlertDim(jsonObject['message']);
        setTimeout("tb_removeAlert('common')", 1500);
        $('#action').val('editar');
        $('#id_produto').val(jsonObject['id_produto']);
        $('#form-botao-atualizar').attr('rel', jsonObject['id_produto']).show();
    });
}

function removeImageFromProduct(id_image, id_produto, name_image){
    
    if(id_produto != ''){
        $.post("/admin/produtos/remover_image", {
            id_image: id_image,
            id_produto: id_produto,
            name_image: name_image

        },function(data){
            $("#slot_picture"+id_image).attr('src', '/media/images/textures/paginas/transparent_100.png');
            $("#picture"+id_image).val('');

        });
    }
}

/*
 * Set some essencial values
 * 
 */
function initProductVariables(){
    
    updateDates($('#helper_dates').val(), $('#helper_dates').attr('rel'));
    reloadTypeProduct($('#helper_type_produto').val());
    
    if($('#reloadSubCategoria').val() != '') reloadSubCategoriasEcommerce($('#reloadSubCategoria').val(), $('#id_produto').val());

    //Handles with images                                           
    for(var i = 1; i <= 6; i++){
        //parent.updateSlotProdutoPicture($('#picture'+i).val(), i, 120);
    }
}


/*
 * It sends the values from the textfield
 *
 */

function submitSubItems(){

    var id_categoria = $('#categoria').val();
    var id_subcategoria = $('#subcategoria').val();
    var label_item_subcategoria = $('#label_item_subcategoria').val();
    var tipo = $('#helper_action').attr('data-tipo');
    var action = $('#helper_action').val();

    $.post("/admin/produtos/cadastrar_categoria",{
        label_item_subcategoria: label_item_subcategoria,
        action: action,
        id_subcategoria: id_subcategoria,
        id_categoria: id_categoria,
        tipo: tipo

    },function(data){
        showAlertDim(data);
    });
}

/*
 * It deletess an ecommerce record from the data base.
 *
 * @param number id
 *
 */
function removeCategoryEcommerce(id, type){
   
    $.post("/admin/produtos/remover_categoria",{
        id: id,
        type: type
    },function(data){
        showAlertDim(data);
        $("#item_" + id).fadeOut("slow");
    });
}

/*
 * It edits the ecommerce categroy from the data base.
 *
 * @param number id
 *
 */
function editCategoryEcommerce(id){
    window.location = "/admin/produtos/categorias/editar/" + id;
}

/*
 * It edits the ecommerce categroy from the data base.
 *
 * @param number id
 *
 */
function editCategoryEcommerceMain(id){
    window.location = "/admin/produtos/categoria_settings/editar/" + id;
}


/*
 * It sends the values from the textfield to save 
 * a subcategory ecommerce
 *
 */
function submitCategoriaSettingsEcommerce(){

    var nome = $('#name').val();
    var index = $('#index').val();
    var descricao = $('#description').val();
    var id_categoria = $('#id_categoria').val();
    var graphic = $("#id_slot_1").text();
    var exibe = $("input[name='exibe']").is(':checked');
    
    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');

    $.post("/admin/produtos/categoria_settings_salvar",{
        nome: nome,
        index: index,
        descricao: descricao,
        id_categoria: id_categoria,
        graphic: graphic,
        exibe: exibe

    },function(data){
        var jsonObject = eval('(' + data + ')');
        showAlertDim(jsonObject['message']);
    });
}

//Init
function initLojaCategoriasListeners(){
    
    if($("#helper_admin_versao").val() == 1){
        
        $("#fancybox_loja_launcher").fancybox({
            'transitionIn'          :'elastic',
            'transitionOut'         :'elastic',
            'speedIn'               : 300,
            'speedOut'              : 200,
            'autoDimensions'        : false,
            'width'                 : 720,
            'height'                : 420,
            'overlayShow'           : false,
            'href'                  : "/admin/produtos/adicionar",
            'titleShow'             : false
        });

        $("#fancybox_subloja_launcher").fancybox({
            'transitionIn'          :'elastic',
            'transitionOut'         :'elastic',
            'speedIn'               : 300,
            'speedOut'              : 200,
            'autoDimensions'        : false,
            'width'                 : 720,
            'height'                : 420,
            'overlayShow'           : false,
            'href'                  : "/admin/produtos/sub_adicionar",
            'titleShow'             : false
        });
        
        $("#add_category_store").click(function(){        
            $("#fancybox_loja_launcher").trigger("click");
        });

        $("#add_subcategory_store").click(function(){        
            $("#fancybox_subloja_launcher").trigger("click");
        });
        
    }else{
    
        $("#add_category_store").click(function(){        
            PurplePier.showModalSmall({url: "/admin/produtos/adicionar", height: '70%'});
        });

        $("#add_subcategory_store").click(function(){        
            PurplePier.showModalSmall({url: "/admin/produtos/sub_adicionar", height: '70%'});
        });
    }
    
    //View loja, não é dentro do FancyBox
    $("#bt_submit_categoria_store").click(function(){
        submitSubItems();
    });  
    
    $("#categoria").change(function() {
        reloadSubCategoriasInsert($("#categoria").val());
    });
}

/*
 * It reloads the combobox galeria.
 *
 * @param number id
 *
 */
function reloadSubCategoriasInsert(id){

    $.post("/admin/categorias/reload_subcategoria_ecommerce", {
        id: id,
        id_produto: 0,
        tipo: 2
        
    },function(data){
        $("#loader_combo_subcategorias").empty().append(data);        
    });
}

//Init
function initCategoriasSettingsListeners(){
    $("#bt_save_settings_ecommerce").click(function(){
         submitCategoriaSettingsEcommerce();
    });
}
//Init
function initCategoriasListListeners(){
    
    $('.table_support_ecommerce :button').click(function(e){

        switch(this.id){
            case "bt_delete":
                removeCategoryEcommerce(this.name, this.alt);
                break;

            case "bt_edit":
                editCategoryEcommerce(this.name);
                break;
                
            case "bt_edit_main":
                editCategoryEcommerceMain(this.name);
                break;
        }
    });
}