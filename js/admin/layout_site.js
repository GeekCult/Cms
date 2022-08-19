/*
    Document   : layout dos sites admin
    Created on : 05/01/2011, 09:31:00
    Author     : CarlosGarcia
    Description: Classe responsável por controlar o modelo do layout do site.

*/


$(document).ready(function(){
    
    $(".icon_save").click(function(){$('#bt_update').trigger('click');});    
    if($("#helper_action").attr('data-js-action') == 'layout_site') $('#bt_update').click(function(){updateForm();});
    if($("#helper_action").attr('data-js-action') == 'css_editor') $('#bt_update').click(function(){updateCSSEditor();});

});


/*
 * It sends the values from the textfield
 *
 */
function updateForm(){

    var layout_site = $("input[name='opcao']:checked").val();
    var design_site = $("input[name='opcao']:checked").attr("title");
    var topo_tipo = $("input[name='opcao']:checked").attr("data-topo");
    var rodape_tipo = $("input[name='opcao']:checked").attr("data-rodape");
    
    //Put a preloader on stage
    showAlertDimPreloader(true, 'Alterando...');

    $.post("alterar",{
        layout_site: layout_site,
        design_site: design_site,
        topo: topo_tipo,
        rodape: rodape_tipo
        
    },function(data){
        showAlertDim(data);
    });
}

/*
 * It sends the values from the textfield
 *
 */
function updateCSSEditor(){
    
    //Put a preloader on stage
    showAlertDimPreloader(true, 'Alterando...');
    
    $.post("/admin/csseditor/salvar",{
        css: $("#css").val(),
        css_define: $("input[name='css_define']").is(':checked')
        
    },function(data){
        var jsonObject = eval('(' + data + ')');
        showAlertDim(jsonObject['message']);
    });
}