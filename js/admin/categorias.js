/*
    Document   : categorias admin
    Created on : 25/01/2010, 19:00:00
    Author     : CarlosGarcia
    Description:
    Purpose of the javascript follows.
*/

$(document).ready(function() {

    $("#bt_submit").click(function(){
        submitForm();
    });
    
    //FancyBox
    $("#bt_submit_categoria_ecommerce").click(function(){
        submitFormCategoriaEcommerce();
    });
    
    //FancyBox
    $("#bt_submit_subcategory_ecommerce").click(function(){
        submitFormSubCategoriaEcommerce();
    }); 
    
    //FancyBox
    $("#bt_submit_subcategoria_galeria").click(function(){
        submitFormSubCategoriaGaleria();
    });
    
    $("#bt_submit_galeria").click(function(){
        submitFormGaleria();
    });

    $('#bt_clear').click(function(){
        clearForm();
    });

    $('#bt_back').click(function(){
        javascript:history.back();
    });

    $('.table_support :button').click(function(e){

        switch(this.id){
            case "bt_delete":
                removeCategory(this.name);
                break;

            case "bt_edit":
                editCategory(this.name);
                break;
        }
    });
    
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
    
    $("#bt_save_settings_ecommerce").click(function(){
         submitCategoriaSettingsEcommerce();
    });
       

});


/*
 * It sends the values from the textfield
 *
 */
function submitForm(){

    var id_page = $('#categoria').val();
    var id_categoria = $('#helper_id_categoria').val();
    var nome_categoria = $('#nome_categoria').val();
    var action = $('#helper_action').val();

    $.post("/admin/categorias/cadastrar",{
        id_page: id_page,
        title: nome_categoria,
        action: action,
        id_categoria: id_categoria

    },function(data){
        showAlertDim(data);
    });
}

/*
 * It sends the values from the textfield to save
 * a category ecommerce
 *
 */
function submitFormCategoriaEcommerce(){

    var id_categoria = $('#helper_id_categoria').val();
    var nome_categoria = $('#nome_categoria').val();
    var tipo = $('#helper_action').attr('data-tipo');
    var action = $('#helper_action').val();
    

    $.post("/admin/categorias/cadastrar_categoria_ecommerce",{
        title: nome_categoria,
        action: action,
        id_categoria: id_categoria,
        tipo: tipo

    },function(data){
        showAlertDim(data);
    });
}

/*
 * It sends the values from the textfield to save 
 * a subcategory ecommerce
 *
 */
function submitFormSubCategoriaEcommerce(){

    var id_categoria = $('#categoria').val();
    var nome_subcategoria = $('#nome_subcategoria').val();
    var tipo = $('#helper_action').attr('data-tipo');
    var action = $('#helper_action').val();

    $.post("/admin/categorias/cadastrar_subcategoria_ecommerce",{
        title: nome_subcategoria,
        action: action,
        id_categoria: id_categoria,
        tipo: tipo

    },function(data){
        showAlertDim(data);
    });
}

/*
 * It sends the values from the textfield
 *
 */
function submitFormStore(){

    var nome_categoria = $('#nome_categoria').val();
    var action = $('#helper_action').val();

    $.post("/admin/loja/cadastrar_categoria",{
        title: nome_categoria,
        action: action

    },function(data){
        showAlertDim(data);
    });
}

/*
 * It sends the values from the textfield to save 
 * a subcategory galeria
 *
 */
function submitFormSubCategoriaGaleria(){

    var id_categoria = $('#categoria').val();
    var nome_subcategoria = $('#nome_subcategoria').val();
    var action = $('#helper_action').val();

    $.post("/admin/categorias/cadastrar_subcategoria_galeria",{
        title: nome_subcategoria,
        action: action,
        id_categoria: id_categoria

    },function(data){
        showAlertDim(data);
    });
}

/*
 * It sends the values from the textfield to save a galeria, with category
 * and subcategory
 *
 */
function submitFormGaleria(){

    var id_page = parent.$('#categoria').val();
    var id_subcategoria = $('#subcategoria').val();
    var nome_categoria = $('#nome_categoria').val();
    var action = $('#helper_action').val();

    $.post("/admin/categorias/cadastrar_galeria",{
        id_page: id_page,
        title: nome_categoria,
        action: action,
        id_subcategoria: id_subcategoria

    },function(data){
        showAlertDim(data);
        parent.galeriaCreated();
    });
}

/*
 * It deletess the record from the data base.
 *
 * @param number id
 *
 */
function removeCategory(id){

    $.post("deletar",{
        id: id
    },function(data){
        showAlertDim(data);
        $("#item_" + id).fadeOut("slow");
    });
}

/*
 * It edits the record from the data base.
 *
 * @param number id
 *
 */
function editCategory(id){
    window.location = "/admin/categorias/editar/" + id;
}

/*
 * It deletess an ecommerce record from the data base.
 *
 * @param number id
 *
 */
function removeCategoryEcommerce(id, type){
   
    $.post("/admin/loja/remover_categoria",{
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
    window.location = "/admin/loja/categorias/editar/" + id;
}

/*
 * It edits the ecommerce categroy from the data base.
 *
 * @param number id
 *
 */
function editCategoryEcommerceMain(id){
    window.location = "/admin/loja/categoria_settings/editar/" + id;
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

    $.post("/admin/loja/categoria_settings_salvar",{
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
