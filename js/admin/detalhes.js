/*
    Document   : Detalhes admin
    Created on : 04/01/2011, 8:31:00
    Author     : CarlosGarcia
    Description:
    Purpose of the javascript follows.
*/
var nrDetalhesTextr = null;

$(document).ready(function(){
    
    if($('#helper_action').attr('data-js-action') == 'listar') setDetailsListListeners();
    if($('#helper_action').attr('data-js-action') == 'novo') setDetailsNewListeners();
});

/*
 * List Listeners
 * 
 */
function setDetailsListListeners(){
    
    $('#bt_define').click(function(){
        updateForm();
    });
    
    $('.icon_save').click(function(){$('#bt_define').trigger('click');});
    
     $('#buttons_support :button').click(function(e){

        switch(this.id){
            case "bt_delete":
                deleteForm(this.name);
                break;

            case "bt_edit":
                editForm(this.alt, this.name);
                break;
        }
    });
}

/*
 * List Listeners
 * 
 */
function setDetailsNewListeners(){
    
    $("#bt_submit").click(function(){
        submitForm(this.name);
    });

    $('#bt_clear').click(function(){
        clearForm();
    });
    
    $('.icon_save').click(function(){$('#bt_submit').trigger('click');});

    var path_folder = "media/images/detalhes/" + $("#helper_type").val() + "/";
    current_picture = $("#image_banner").attr("name");
   
    var isThumbnails = $("input[name='miniatura']:checked").val();
    //file_input = false;//Avoid start upload automatic   
    uploader = new qq.FileUploader({
        element: document.getElementById('file'),
        action: "/site/images/upload_admin",
        params: {path: path_folder, hasThumbs: isThumbnails, current_image: current_picture, replace: true},
        debug: false,
        onComplete: function(id, fileName, responseJSON){
            if(responseJSON['success']){                
                //$("#image_banner").attr("src", "/" + path_folder + "/original/" + fileName);
                $('#file_helper').val(responseJSON['file_name']);
              
            }
        }
    });
}

/*
 * It sends the values from the textfield
 *
 */
function submitForm(cat){

    var title = $('#title').val();
    var tipo  = "2"; //Atributo antigo png/jpg/swf
    var local = $('#local').val();
    var file  = $('#file_helper').val();
    var classe  = $('#classe').val();
    
    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');

    $.post("/admin/detalhes/" + cat + "/cadastrar", {
        title: title,
        tipo: tipo,
        file: file,
        local: local,
        classe: classe

    },function(data){
        showAlertDim(data);
        clearForm();

    });
}

/*
 * It deletess the record from the data base.
 *
 * @param number id
 *
 */
function deleteForm(id){

    $.post("deletar",{
        id: id
    },function(data){
        showAlertDim(data);            
        clearForm();
        $("#det_" + id).hide("slow");
    });
}

/*
 * It edits the record from the data base.
 *
 * @param number id
 *
 */
function editForm(local, id){
    window.location = "/admin/detalhes/" + local + "/editar/" + id;
}

/*
 * It clears the textfield from form.
 *
 */
function clearForm(){
    $('#title').val("");
    $('#arquivo').val("");
    $('#local').val("");
}

/*
 * It sends the values from the radio button
 * It defines a new details to the layout selected
 *
 */
function updateForm(){

    var selected = $("input[name='opcao']:checked").val();
    
    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');

    $.post("alterar",{
        selected: selected
    },function(data){
        showAlertDim(data);
        clearForm();

    });
}

/*
 * It sends the values from the radio button
 * It defines a new details to the layout selected
 *
 */
function initDividersListeners(){

    $("#bt_update_divider").click(function(){
        updateDivider();
    });
    
    $(".colors_support :button").click(function(){
       $(".divider_site").css("border-color", this.alt);
       $("#helper_color").val(this.alt);
    });
    
    $("#espessura").change(function(){
       $(".divider_site").css("border-bottom-width", $(this).val());
       $("#helper_espessura").val($(this).val());
    });
}

/*
 * It sends the values from the radio button
 * It defines a new details to the layout selected
 *
 */
function updateDivider(){
    
    var selected = $("input[name='opcao']:checked").val();
    var color = $("#helper_color").val();
    var espessura = $("#helper_espessura").val();
    if(selected == "empty.png") selected = "divider_empty";
    
    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');

    $.post("alterar",{
        selected: selected,
        color: color,
        espessura: espessura
    },function(data){
        showAlertDim(data);
        clearForm();

    });
}

/*
 * It sends the values from the radio button
 * It defines a new details to the layout selected
 *
 */
function initExtremosListeners(){

    $("#bt_update_topo").click(function(){
        updateTopo();
    });
    
    $("#bt_update_rodape").click(function(){
        updateRodape();
    });
    
    $('.icon_save').click(function(){$('#bt_update_topo, #bt_update_rodape').trigger('click')});
    
    //Texturas
    //This method works together a anchorAnimateBanner
    //It shows the gallery in the middle screen.
    $('.bt_textures, .bt_site').click(function(){
        nrDetalhesTextr = this.id;
    });
     
    $('.bt_textures').fancybox({
        'transitionIn':'elastic','transitionOut':'elastic','speedIn': 300,'speedOut': 200,'autoDimensions':false,'width':720,'height':450,'overlayShow': false,
        'href'        : "/admin/texturas/rodape/exibir"
    }); 
    
    $('.bt_site').fancybox({
        'transitionIn':'elastic','transitionOut':'elastic','speedIn': 300,'speedOut': 200,'autoDimensions':false,'width':720,'height':450,'overlayShow': false,
        'href'        : "/admin/texturas/site/exibir"
    });
    
}

/*
 * Updates header
 *
 */
function updateTopo(){
    
    var pos_x = $("#pos_x").val(); 
    var pos_y = $("#pos_y").val();
    var altura = $("#altura").val(); 
    var largura = $("#largura").val();
    var topo_altura = $("#topo_altura").val();
    var container_altura = $("#container_altura").val();
    var container_largura = $("#container_largura").val();
    
    //Put a preloader on stage
    showAlertDimPreloader(true, 'Aterando...');

    $.post("/admin/detalhes/topo/alterar_extremos",{
        type: 'topo',
        topo_altura: topo_altura,
        logo_altura: altura,
        logo_largura: largura,
        pos_x: pos_x,
        pos_y: pos_y,
        container_altura: container_altura,
        container_largura: container_largura,
        frase_searchbox: $("#frase_searchbox").val(),
        topo_fit: $("input[name='topo_fit']").is(':checked')
        
    },function(data){
        showAlertDim(data);

    });
}

/*
 * Updates footer
 *
 */
function updateRodape(){

    //Put a preloader on stage
    showAlertDimPreloader(true, 'Alterando...');

    $.post("/admin/detalhes/rodape/alterar_extremos",{
        type: 'rodape',
        rodape_copyright: $("#rodape_copyright").val(),
        ft_menu: $("#ft_menu").val(),
        ft_menu_type: $("#ft_menu").attr('data-type'),
        ft_line2: $("#ft_line2").val(),
        ft_txt_line2: $("#ft_txt_line2").val(),
        ft_titulo_menu: $("#ft_titulo_menu").val(),
        ft_subtitulo_menu: $("#ft_subtitulo_menu").val(),
        ft_txt_menu: $("#ft_txt_menu").val(),
        ft_txt_menu1: $("#ft_txt_menu1").val(),
        ft_txt_menu2: $("#ft_txt_menu2").val(),
        ft_menu2_espacamento: $("#ft_menu2_espacamento").val(),
        ft_fb_bg: $("#ft_fb_bg").val(),
        ft_ln_company_bg: $("#ft_ln_company_bg").val(),
        ft_txt_line_company: $("#ft_txt_line_company").val()
        
    },function(data){
        showAlertDim(data);

    });
}

/*
 * Add background
 *
 */
function addBackground(bg_type, texture, bg_type2, booleano){
    
    if(nrDetalhesTextr == 1){
        $("#texture_id_" + nrDetalhesTextr).css('background', 'url(/media/images/textures/rodape/'+ texture +')');
        $("#ft_menu").val(texture).attr('data-type', bg_type2);
    }
    
    if(nrDetalhesTextr == 2){
        $("#texture_id_" + nrDetalhesTextr).css('background', 'url(/media/images/textures/site/'+ texture +')');
        $("#ft_line" + nrDetalhesTextr).val(texture);
    }
    
    if(nrDetalhesTextr == 3){
        $("#texture_id_" + nrDetalhesTextr).css('background', 'url(/media/images/textures/site/'+ texture +')');
        $("#ft_fb_bg").val(texture);
    }
    
    if(nrDetalhesTextr == 4){
        $("#texture_id_" + nrDetalhesTextr).css('background', 'url(/media/images/textures/site/'+ texture +')');
        $("#ft_ln_company_bg").val(texture);
    }
    
}