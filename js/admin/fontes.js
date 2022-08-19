/*
    Document   : fontes admin
    Created on : 05/01/2011, 09:31:00
    Author     : CarlosGarcia
    Description:
    Purpose of the javascript follows.
*/


$(document).ready(function() {
    
    initSetColorFont();
    
    $('#bt_update').click(function() {
        updateForm();
    });
    
    $('#bt_update_css').click(function() {
        updateFormCSS();
    });
    
    $('#bt_update_size').click(function() {
        updateFormSize();
    });

    $('.icon_save').click(function(){$('#bt_update_css, #bt_update, #bt_update_size').trigger('click');});
 
    $('#font_title_color').change(function() {
        setColorFont(this.name, $('#font_title_color').val());
    });

    $('#font_subtitulo_color').change(function() {
        setColorFont(this.name, $('#font_subtitulo_color').val());
    });

    $('#font_text_color').change(function() {
        setColorFont(this.name, $('#font_text_color').val());
    });

    $('#font_link_color').change(function() {
        setColorFont(this.name, $('#font_link_color').val());
    });

    $('#font_link_over_color').change(function() {
        setColorFont(this.name, $('#font_link_over_color').val());
    });

    $('#font_menu_color').change(function() {
        setColorFont(this.name, $('#font_menu_color').val());
    });

    $('#font_menu_over_color').change(function() {
        setColorFont(this.name, $('#font_menu_over_color').val());
    });

    $('#font_button_color').change(function() {
        setColorFont(this.name, $('#font_button_color').val());
    });

    $('#font_button_over_color').change(function() {
        setColorFont(this.name, $('#font_button_over_color').val());
    });
    
    $('#font_input_text_color').change(function() {
        setColorFont(this.name, $('#font_input_text_color').val());
    });
    
    $('#font_input_title_popup_color').change(function() {
        setColorFont(this.name, $('#font_input_title_popup_color').val());
    });
    
    $('#font_input_text_popup_color').change(function() {
        setColorFont(this.name, $('#font_input_text_popup_color').val());
    });
   

});//Close Document Ready


/*
 * It sets the main text example fonts
 *
 */
function setColorFont(textSelected, valColor){
    $("#" + textSelected).css("color",'#' + valColor);
}

/*
 * It is used to set the main text example fonts when the page is launched
 * The follow method init is called into editar.php view
 *
 */
function initSetColorFont(){

    $("#font_title_example").css("color", "#"+$('#font_title_color').val());
    $("#font_subtitulo_example").css("color", "#"+$('#font_subtitulo_color').val());
    $("#font_text_example").css("color", "#"+$('#font_text_color').val());
    $("#font_link_example").css("color", "#"+$('#font_link_color').val());
    $("#font_link_over_example").css("color", $('#font_link_over_color').val());
    $("#font_menu_example").css("color", "#"+$('#font_menu_color').val());
    $("#font_menu_over_example").css("color", "#"+$('#font_menu_over_color').val());
    $("#font_button_example").css("color", "#"+$('#font_button_color').val());
    $("#font_button_over_example").css("color", "#"+$('#font_button_over_color').val());
    $("#font_input_text_example").css("color", "#"+$('#font_input_text_color').val());
    $("#font_input_chamada_example").css("color", "#"+$('#font_input_chamada_color').val());
    $("#font_title_popup_example").css("color", "#"+$('#font_input_title_popup_color').val());
    $("#font_text_popup_example").css("color", "#"+$('#font_input_text_popup_color').val());    

}

/*
 * It sends the values from the textfield
 *
 */
function updateForm(){

    var title_color = $('#font_title_color').val();
    var subtitulo_color = $('#font_subtitulo_color').val();
    var text_color = $('#font_text_color').val();
    var link_color = $('#font_link_color').val();
    var link_color_hover = $('#font_link_over_color').val();
    var menu_color = $('#font_menu_color').val();
    var menu_color_hover = $('#font_menu_over_color').val();
    var button_color = $('#font_button_color').val();
    var button_color_hover = $('#font_button_over_color').val();
    var input_text_color = $('#font_input_text_color').val();
    var input_chamada_color = $('#font_input_chamada_color').val();
    var input_title_popup_color = $('#font_input_title_popup_color').val();
    var input_text_popup_color = $('#font_input_text_popup_color').val();
    
    //Put a preloader on stage
    showAlertDimPreloader();

    $.post("/admin/fontes/alterar",{
        title_color: title_color,
        subtitulo_color: subtitulo_color,
        text_color: text_color,
        link_color: link_color,
        link_color_hover: link_color_hover,
        menu_color: menu_color,
        menu_color_hover: menu_color_hover,
        button_color: button_color,
        button_color_hover: button_color_hover,
        input_text_color: input_text_color,
        input_chamada_color: input_chamada_color,
        title_popup_color: input_title_popup_color,
        text_popup_color: input_text_popup_color
        
    },function(data){
        showAlertDim(data);
    });
}

/*
 * It sends the values from the textfield
 *
 */
function updateFormCSS(){

    //Put a preloader on stage
    showAlertDimPreloader();

    $.post("/admin/fontes/css",{        
        empty: "empty"
        
    },function(data){
        showAlertDim(data);
    });
}

/*
 * It sends the values from the textfield
 *
 */
function updateFormSize(){

    var title_size = $('#font_title_size').val();
    var text_size = $('#font_text_size').val();
    var text_line_height = $('#font_text_line').val();
    var text_alignment = $('#font_text_alignment').val();
    
    //Put a preloader on stage
    showAlertDimPreloader();

    $.post("/admin/fontes/alterar_size",{
        title_size: title_size,
        text_size: text_size,
        text_line_height: text_line_height,
        text_alignment: text_alignment,
        subtitulo_alinhamento: $('#subtitle_alinhamento').val(),
        subtitulo_fonte: $('#subtitle_fonte').val(),
        subtitulo_size: $('#subtitle_size').val(),
        subtitulo_line: $('#subtitle_line').val(),
        chamada_alinhamento: $('#chamada_alinhamento').val(),
        chamada_fonte: $('#chamada_fonte').val(),
        chamada_size: $('#chamada_size').val(),
        chamada_line: $('#chamada_line').val()
        
    },function(data){
        showAlertDim(data);
    });
}