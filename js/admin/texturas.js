/*
    Document   : texturas admin
    Created on : 04/01/2011, 8:31:00
    Author     : CarlosGarcia
    Description:
    Purpose of the javascript follows.
*/

isPreventDefault  = false;

$(document).ready(function(){

    if($("#helper_action").attr('data-js-action') == 'listar') initListenersTexturesList();
    if($("#helper_action").attr('data-js-action') == 'criar') initTextureNewListeners();
    if($("#helper_action").attr('data-js-action') == 'escolher') initListenersEscolherBotao();

});


/*
 * It apply the listeners for the new and edit action
 * The setTimeout above is needed because some problems with
 * the fucking uploadify component
 *
 */
function initTextureNewListeners(){

    var path_folder = 'media/images/textures/'+ $('#local').val() +"/";
    if($("#helper_action").attr('data-type')) path_folder = 'media/user/images/original/';
    current_picture = $("#image_banner").attr("name");
   
    var isThumbnails = $("input[name='miniatura']:checked").val();
    if(isThumbnails == undefined) isThumbnails = false;
    //file_input = false;//Avoid start upload automatic   
    uploader = new qq.FileUploader({
        element: document.getElementById('file'),
        action: "/admin/images/upload_admin",
        params: {path: path_folder, hasThumbs: isThumbnails, current_image: current_picture, replace: true, isUser: false},
        debug: true,
        onComplete: function(id, fileName, responseJSON){
            if(responseJSON['success']){
                
                $("#image_banner").attr("name", fileName);
                $('#file_helper').val(responseJSON['file_name']);
            }
        }
    });
    
    $("#bt_submit").click(function(){
        submitForm(this.name, "cadastrar", this.alt);
    });
    
    $("#bt_update").click(function(){
        submitForm(this.name, "alterar", this.alt);
    });

    $('#bt_clear').click(function(){
        clearForm();
    });
    
    $('.icon_save').click(function(){$('#bt_submit, #bt_update').trigger('click');}); 
    
}

/*
 * It apply the listeners for the list action
 *
 */
function initListenersTexturesList(){
    
    $('#bt_define, .icon_save').unbind('click');
    $('#bt_define').click(function(){
        updateForm();
    });

    $('#buttons_support :button').click(function(e){
        switch(this.id){
            case "bt_delete":
                verifyAction(this.name, this.alt);
                break;

            case "bt_edit":
                editForm(this.alt, this.name);
                break;
            case "bt_edit_user":
                editUserForm(this.alt, this.name);
                break;
        }
    });
    
    
    $('.icon_save').click(function(){$('#bt_define').trigger('click');});
}

/*
 * It init listeners: Fancybox 
 *
 */
function initImagesFancy(){ 
   
    $("#categoria_fancy").change(function(){
        reloadItemsFancy($("#categoria_fancy").val());
    });
   
}

/*
 * It sends the values from the textfield
 *
 */
function submitForm(cat, type, id){
    
    var title = $('#title').val();
    var local = $('#local').val();
    var color = $('#color').val();
    var file  = $('#file_helper').val();
    var tipo  = $('#id_tipo').val();
    var is_user  = $("#helper_action").attr('data-type');
    var action  = type;
    
    if(file == "" || title == ""){        
        $(".message_errors").css("display", "block");
    }else{
        //Put a preloader on stage
        showAlertDimPreloader(true, 'Salvando...');
        $(".message_errors").css("display", "none");
        $.post("/admin/texturas/" + cat + "/" + type,{            
            title: title,
            file: file,
            color: color,
            local: local,
            tipo: tipo,
            action: action,
            id: id,
            is_user: is_user
            
        },function(data){
            var jsonObject = eval('(' + data + ')');
            showAlertDim(jsonObject['MESSAGE']);
            if(type == "cadastrar") clearForm();
        });
    }
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
function verifyAction(id, image_name){    
    id_item = id;  
    image_item = image_name;  
    showAlertDimCancel();
}

/*
 * It deletess the record from the data base.
 *
 * @param number id
 *
 */
function completeActionAlertDim(){
    
    var local = $('#local').val();
    
    $("#text_" + id_item).fadeOut("slow");

    $.post("deletar",{
        id: id_item,
        local: local,
        image_name: image_item
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
function editForm(local, id){
    window.location = "/admin/texturas/" + local + "/editar/" + id;
}

/*
 * It edits the record from the data base.
 *
 * @param number id
 *
 */
function editUserForm(local, id){
    window.location = "/admin/texturas/" + local + "/editar_user/" + id;
}

/*
 * It clears the textfield from form.
 *
 */
function clearForm(){
    $('#title').val("");
    $('#arquivo').val("");
    $('#color').val("");
}

/*
 * It defines he selected texture
 * 
 *
 */
function updateForm(){
    
    var selected = $("input[name='opcao']:checked").val();    
    var tipo = $("input[name='opcao']:checked").attr('alt');
    var color = $("input[name='opcao']:checked").attr('class');
    var path = $("input[name='opcao']:checked").attr('data-tipo');
    var local = $("#local").val();
    
    
    if(selected == "empty.png") selected = "";
    
    //Put a preloader on stage
    showAlertDimPreloader(true, 'Alterando...');

    $.post("/admin/texturas/" + local + "/definir", {
        selected: selected,
        tipo: tipo,
        color: color,
        path: path
        
    },function(data){
        var jsonObject = eval('(' + data + ')');
        showAlertDim(jsonObject['MESSAGE']);
        clearForm();
    });
}

/*
 * It reloads the ajax showing the new
 * category when user is inside FancyBox.
 *
 * It uses a combox request
 *
 * ID #categorias_fancy
 *
 */
function reloadItemsFancy(id_cat){
    var type_images = $("#helper_type_images").val();

    $.post("/admin/texturas/"+ id_cat +"/recarregar_fancy", {
        id_categoria: id_cat,
        type_images: type_images
    },function(data){
        $('#ItemManager').empty().append(data);
    });
}

/*
 * It apply the listeners for the list action
 *
 */
function initListenersEscolherBotao(){
    
    $('#botao_main').change(function(){
        $("#bt_main_escolhe").removeClass().addClass("btn " + $('#botao_main').val());
    });
    
    $('#botao_success').change(function(){
        $("#bt_success_escolhe").removeClass().addClass("btn " + $('#botao_success').val());
    });
    
    $('#botao_second').change(function(){
        $("#bt_second_escolhe").removeClass().addClass("btn " + $('#botao_second').val());
    });
    
    $("#bt_submit_escolhe").click(function(){
        $.post("/admin/texturas/botao_especial/salvar_escolher", {
            type: 'button',
            type_special: $("input[name='check_escolhe']").is(':checked'),
            main_button: $("#botao_main").val(),
            success_button: $("#botao_success").val(),
            second_button: $("#botao_second").val()
            
        },function(data){
            var jsonObject = eval('(' + data + ')');
            showAlertDim(jsonObject['MESSAGE']);
        });
    });
    
    $('.icon_save').click(function(){$('#bt_submit_escolhe').trigger('click');}); 
}