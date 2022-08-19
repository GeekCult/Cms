/*
    Document   : download admin
    Created on : 31/12/2010, 16:31:00
    Author     : CarlosGarcia
    Description:
    Purpose of the javascript follows.
*/
$(document).ready(function() {
    setTimeout("initDownloadsListeners()", 200);
});

//Init
function initDownloadsListeners(){
    
    var path_folder = "media/user/downloads/";
    current_file = $("#image_banner").attr("name");
    
    $('.table_support :button').click(function(e){
        
        switch(this.id){
            case "bt_delete":
                verifyActionBanner(this.name);
                break;

            case "bt_edit":
                editForm(this.name);
                break;
        }
    });
   
    $("#categoria").change(function(){
        reloadItems($("#categoria").val());
    });

    $("#bt_submit").click(function(){
        submitForm();
    });

    $('#bt_clear').click(function(){
        clearForm();
    });
    
    //file_input = false;//Avoid start upload automatic   
    uploader = new qq.FileUploader({
        element: document.getElementById('file'),
        action: "/admin/downloads/upload",
        params: {path: path_folder, current_file: current_file, replace: false},
        debug: false,
        onComplete: function(id, fileName, responseJSON){
            if(responseJSON['success']){
                
                //$("#image_banner").attr("src", "/" + path_folder + "/original/" + fileName);
                $("#image_banner").attr("name", responseJSON['file_name']);
                $('#file_helper').val(responseJSON['file_name']);
                $('#stage').hide();
                $('#image_banner').show();
            }
        }
    });
}

/*
 * It sends the values from the textfield
 *
 */
function submitForm(){

    var title = $('#title').val();
    var descricao = $('#descricao').val();
    var arquivo = $('#file_helper').val();
    var id_categoria = $('#categoria').val();
    var action = $('#helper_action').val();
    var tipo = $('#id_tipo').val();
    var id = $('#helper_id').val();

    $.post("/admin/downloads/cadastrar",{
        title: title,
        descricao: descricao,
        arquivo: arquivo,
        categoria: id_categoria,
        action: action,
        tipo: tipo,
        id:id    

    },function(data){
        showAlertDim(data);
        if(action != 'editar')clearForm();
    });
}

/*
 * It edits the record from the data base.
 *
 * @param number id
 *
 */
function editForm(id){
    window.location = "/admin/downloads/editar/" + id;
}

/*
 * It clears the textfield from form.
 *
 */
function clearForm(){
    $('#title').val("");
    $('#arquivo').val("");
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
    
    $("#obj_container_" + id_item).animate({opacity: "toggle"});

    $.post("deletar",{
        id: id_item
    },function(data){
        showAlertDim(data);
        $("#obj_container_" + id).hide("slow");
        clearForm();

    });
}


/*
 * It reloads the ajax showing the new
 * category.
 *
 * It uses a combox request
 *
 * ID #categorias
 *
 */
function reloadItems(id_cat){

    $.post("/admin/downloads/recarregar/",{
        id_cat: id_cat
    },function(data){
        $('#ItemManager').empty().append(data);
    });
}