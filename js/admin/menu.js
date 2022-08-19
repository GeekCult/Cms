/*
    Document   : Menu admin
    Created on : 31/12/2010, 16:31:00
    Author     : CarlosGarcia
    Description:
    Purpose of the javascript follows.
*/

$(document).ready(function(){
  
    if($('#helper_action').attr('data-js-action') == 'editar') initMenuListeners();  
    if($('#helper_action').attr('data-js-action') == 'criar_menu') initCriarMenuListeners();
    if($('#helper_action').attr('data-js-action') == 'criar_categorias') initCriarCategoriasListeners();
    if($('#helper_action').attr('data-js-action') == 'listar_menu') initListarListeners();

});

//Init
function initMenuListeners(){

    $("#bt_define, .icon_save").click(function(){
        submitMenu();
    });
    
    $("#menu_total").click(function(){
        var total = $("#menu_total").is(':checked');
        
        if(total){
            $('#menu-wrap').css('width', '100%').css('margin-left', '0px').css('left', '0px');
        }else{
            $('#menu-wrap').css('width', '980px').css('margin-left', '-490px').css('left', '50%');
        }
        submitPreference('menu_total', total);
        
    });
    
    $("#align_buttons").change(function(){
        if($("#align_buttons").val() == 'center'){
            $('#menuGroup').css({'left': 'auto', 'right': 'auto', 'margin': '0 auto', 'display': 'table', 'position': 'relative', 'width': 'auto'});
        }
        if($("#align_buttons").val() == 'left'){
            $('#menuGroup').css({'left':'0%', 'margin-left': '0px', 'width': 'auto', "right": 'none'});
        }
        if($("#align_buttons").val() == 'right'){
            $('#menuGroup').css({'right':'0%', 'margin-left': '0px', 'width': 'auto', "left": 'none'});
        }
        
        if($("#align_buttons").val() == 'center_right'){
            $('#menu-content-wrap').css({'width':'980px', 'margin-left': '-490px', 'left': '50%', 'position': 'absolute'});
            $('#menuGroup').css({'right':'0%', 'margin-left': '0px', 'width': 'auto', "left": 'none'});
        }
        
        if($("#align_buttons").val() == 'center_left'){
            $('#menu-content-wrap').css({'width':'980px', 'margin-left': '-490px', 'left': '50%', 'position': 'absolute'});
            $('#menuGroup').css({'left':'0%', 'margin-left': '0px', 'width': 'auto', "right": 'none'});
        }
        
        submitPreference('menu_align', $("#align_buttons").val());
        
    });
    
    $("#menu_space").keyup(function(){
        $('#menuGroup a').css('padding', '10px ' + $("#menu_space").val() + 'px');
        submitPreference('menu_space', $("#menu_space").val());
    });
    
    $("#menu_altura").keyup(function(){
        $('#menuGroup, #menuWrap').css('height', $("#menu_altura").val() + 'px');
        submitPreference('menu_altura', $("#menu_altura").val());
    });
    
    $("#menu_cor_divider").keyup(function(){
        if($("#menu_cor_divider").val().length == 7){
            $('#menuGroup li').css('border-right-color', $("#menu_cor_divider").val());
            submitPreference('menu_cor_divider', $("#menu_cor_divider").val());
        }
        
    });
    
    $("#menu_sombra_texto").click(function(){
        var sombra = $("#menu_sombra_texto").is(':checked');
        if(sombra){
            $('#menuGroup a').css('text-shadow', '0 1px 0 #000000');
        }else{
            $('#menuGroup a').css('text-shadow', 'none');
        }
        
        submitPreference('menu_sombra_texto', sombra);
        
    });
    
    $("#menu_dividers").click(function(){
        var divider = $("#menu_dividers").is(':checked');
        if(divider){
            $('#menuGroup li').css('border-right', '1px solid #222222').css('box-shadow', '1px 0 0 #444444');
          
        }else{
            $('#menuGroup li').css('border-right', 'none').css('box-shadow', 'none');
        }
        
        submitPreference('menu_dividers', divider);
        
    });
    
}

/*
 * It sends the values from the textfield
 *
 */
function submitMenu(){

    var exibe = $("input[name='menu_exibe']").is(':checked');
    
    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');
    
    $.post("/admin/menu/salvar",{
        exibe: exibe, 
        background_color: $("#menu_cor_background").val(),
        background_active: $("#menu_cor_active").val(),
        margin_menu_pos_x: $("#margin_menu_pos_x").val(),
        menu_margin_baixo: $("#menu_margin_baixo").val(),
        background_color_exibe: $("input[name='menu_cor_background_none']").is(':checked'),
        background_active_exibe: $("input[name='menu_cor_active_none']").is(':checked'),
        textura_background_full: $("input[name='textura_background_full']").is(':checked'),
        menu_cor_divider: $("#menu_cor_divider").val(),
        menu_fonte: $("#menu_fonte").val()


    },function(data){
        showAlertDim(data);
    });
}

/*
 * It sends the values from the textfield
 *
 */
function submitPreference(label, valor){

    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');
    
    $.post("/admin/menu/salvar_preferences",{
        label: label,
        value: valor

    },function(data){
        showAlertDim(data);
    });
}

/* 
 * Listar Menu Special
 */
function initListarListeners(){

    //Put a preloader on stage
    showAlertDimPreloader(true, 'Excluindo...');

    $(".bt_delete").click(function(){
        $.post("/admin/menu/remover_menu",{id: this.id},function(data){
            showAlertDim(data);
        });
    });
}

/* 
 * Criar Menu Special
 */
function initCriarMenuListeners(){

    $("#bt_submit").click(function(){
        
        //Put a preloader on stage
        showAlertDimPreloader(true, 'Salvando...');
        
        $.post("/admin/menu/salvar_menu",{data: $("form#form_menu").serialize()},function(data){
            showAlertDim(data);
        });
    });
}

/* 
 * Criar Categoria
 */
function initCriarCategoriasListeners(){

    $("#bt_submit").click(function(){
        
        //Put a preloader on stage
        showAlertDimPreloader(true, 'Salvando...');
    
        $.post("/admin/menu/salvar_menu",{data: $("form#form_menu").serialize()},function(data){
            showAlertDim(data);
        });
    });
}