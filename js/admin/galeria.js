/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var index = 0;

function initGaleriaL(){
    setTimeout("initGaleriaListener()", 200);
}
/*
 * Main gallery listener
 * 
 */
function initGaleriaListener(){
    
    $("#categoria").change(function() {
        $("#helper_id_controller").val($("#categoria").val());
        reloadSubCategoriasGaleria($("#categoria").val());
        initCadastrarCoolPicker();
    });
    
    $("#subcategoria").live('change', function() {
        $("#helper_id_subcategoria").val($("#subcategoria").val());
        reloadCategoriasGaleria($("#subcategoria").val());
    });
   
    $("#galeria").change(function() {
        reloadGraphics($("#categoria").val(), $("#galeria").val());        
    });
    
    $(".bt_galeria_escolher").click(function(){
        $("#fancybox_images_launcher").trigger('click');
    });
    
    $("#bt_clear").click(function(){
       $("#gallery_loader_container").empty();
    });
    
    $("#bt_submit").click(function(){
      submitFormGallery();
    }); 
    
    $("#bt_update, .icon_save").click(function(){
      updateFormGallery();
    });
    
    var path_folder = "media/user/images";
    current_picture = $("#image_banner").attr("name");
   
    var isThumbnails = $("input[name='miniatura']:checked").val();
    //file_input = false;//Avoid start upload automatic   
    uploader = new qq.FileUploader({
        element: document.getElementById('file'),
        action: "/site/images/upload_admin",
        params: {path: path_folder, hasThumbs: isThumbnails, current_image: current_picture, replace: false},
        debug: false,
        onComplete: function(id, fileName, responseJSON){
            if(responseJSON['success']){
                
                //$("#image_banner").attr("src", "/" + path_folder + "/original/" + fileName);
                $('#file_helper').val(responseJSON['file_name']);
                saveGaleriaPicture();
              
            }
        }
    });
            
    $("#nome_client").click(function(){
        $("#fancybox_user_launcher_admin").trigger("click");
    });
    
    $("#fancybox_subcategory_launcher").fancybox({
        'transitionIn'          :'elastic',
        'transitionOut'         :'elastic',
        'speedIn'               : 300,
        'speedOut'              : 200,
        'autoDimensions'        : false,
        'width'                 : 720,
        'height'                : 460,
        'overlayShow'           : false,
        'href'                  : "/admin/galeria/subcategoria/" + $("#helper_id_controller").val(),
        'titleShow'             : false
    });
    
    $("#fancybox_galerias_launcher").fancybox({
        'transitionIn'          :'elastic',
        'transitionOut'         :'elastic',
        'speedIn'               : 300,
        'speedOut'              : 200,
        'autoDimensions'        : false,
        'width'                 : 720,
        'height'                : 330,
        'overlayShow'           : false,
        'href'                  : "/admin/galeria/adicionar_galeria/" + $("#subcategoria").val(),
        'titleShow'             : false
    });
}

/*
 * Main gallery listener
 * 
 */
function initGaleriaUsers(){
    $("#nome_client").click(function(){
        $("#fancybox_user_launcher_admin").trigger("click");
    });
    
    $("#bt_submit_user").click(function(){
        submitFormUsersGallery();
    });
    
    $(".bt_rm_user").live('click', function(){
        $.post("/admin/galeria/remover", {
            id: $(this).attr('name'),
            id_categoria: $("#categoria").val(),
            id_galeria: $("#galeria").val()
            
        },function(data){showAlertDim(data);}); 
        $('#obj_container_' + $(this).attr('name')).remove();
    });
    
}

/*
 * Este método cria a galeria em pauta
 * Simples método de criação, ele usa uma string para enviar as
 * imagens, se a galeria for muito grande uma nova forma de 
 * fazer isso será necessário.
 *
 */
function submitFormUsersGallery(){
    var string_users = "";
    var string_id = "";
    
    for(var i = 0; i< $("#user_loader_container").children().length; i++){
        string_users += $("#user_loader_container").children().eq(i).attr('data-id');
        if(i < ($("#user_loader_container").children().length - 1)) string_users += ",";
    }
    
    var action = 'salvar';
    if($('#helper_action').val() == 'editar') action = 'update';
    if(string_users != ""){
        $.post("/admin/galeria/" + action, {
            ids: string_id,
            id_categoria: $("#categoria").val(),
            id_galeria: $("#galeria").val(),
            nome_galeria: $('#galeria option:selected').text(),        
            string_images: string_users,
            type: 'users',
            id_subcategoria: 0
            
        },function(data){showAlertDim(data);});         
    }else{
        showAlertDim("É necessário adicionar um usuário!");
    }
    
    
}

 /*
 * It inits the listaner and actions for the listar
 * modulo
 *
 */
function initGaleriaListenerListar(){

    $('.table_support :button').click(function(e) {
        switch(this.id){

            case "bt_delete":
                verifyActionBanner(this.name, this.className, this.alt);
                break;

            case "bt_edit":
                editGaleria(this.name, this.className, $(this).attr('alt'), $(this).attr('rel'));
                break;
                
            case "bt_edit_plus":
                editGaleriaDetalhes(this.name, this.className, $(this).attr('alt'), $(this).attr('rel'));
                break;  
            
            case "bt_edit_plus2":
                editGaleriaInfo(this.name, this.className, $(this).attr('alt'), $(this).attr('rel'));
                break;
            
            case "bt_lock_open":                
                $(".op_"+this.name+"-"+this.alt).attr("id", "bt_lock_close");
                changeLockedAccount(0, this.name, this.alt);//1 = fechado
                break;
                
             case "bt_lock_close":                
                $(".op_"+this.name+"-"+this.alt).attr("id", "bt_lock_open");
                changeLockedAccount(1, this.name, this.alt);//0 = aberto
                break;
            
             case "bt_lock_close_red":                
                $(".op_"+this.name+"-"+this.alt).attr("id", "bt_lock_open");
                changeLockedAccount(2, this.name, this.alt);//0 = aberto
                break;
        }
    });
}

/*
 * It set the status account lock
 *
 * @param number
 *
 */
function changeLockedAccount(status, id_categoria, id_galeria){
    
    $.post("/admin/galeria/galery_lock",{
        status: status,
        id_categoria: id_categoria,
        id_galeria: id_galeria
        
    },function(data){
        showAlertDim(data);
    });
}

/*
 * Este método cria a galeria em pauta
 * Simples método de criação, ele usa uma string para enviar as
 * imagens, se a galeria for muito grande uma nova forma de 
 * fazer isso será necessário.
 *
 */
function submitFormGallery(){
    var string_images = "";
    var string_id = "";
    //$("#gallery_loader_container").children('img');
    for(var i = 0; i< $("#gallery_loader_container").children().length; i++){
        //alert($("#slot_pict_id_"+i).attr('name'));
        string_images += $("#slot_pict_id_"+i).attr('name');
        if(i < ($("#gallery_loader_container").children().length - 1)) string_images += ",";
    }

    if($("#galeria").val() != ""){
        $.post("/admin/galeria/salvar", {
            ids: string_id,
            id_categoria: $("#categoria").val(),
            id_galeria: $("#galeria").val(),
            nome_galeria: $('#galeria option:selected').text(),
            id_subcategoria: $("#subcategoria").val(),
            string_images: string_images
        },function(data){showAlertDim(data);});         
    }else{
        showAlertDim("É necessário escolher uma galeria!");
    }
}

/*
 * 
 * Este método atualiza as mudanças feitas nas galerias
 * Possivelmente pode haver alguns problemas
 * 
 */
function updateFormGallery(){
    var string_images = "";
    //$("#gallery_loader_container").children('img');
    for(var i = 0; i< $("#gallery_loader_container").children().length; i++){
        if($("#slot_pict_id_"+i).attr('name') != "undefined"){
            string_images += $("#slot_pict_id_"+i).attr('name');
            //$("#teste").append($("#slot_pict_id_"+i).attr('name') + "<br/>" );
            if(i < ($("#gallery_loader_container").children().length - 1)) {                
               string_images += ",";
            }           
        }
    }
    
    if($("#galeria").val() != ""){
        $.post("/admin/galeria/update", {        
            id_categoria: $("#categoria").val(),
            id_galeria: $("#galeria").val(),
            id_subcategoria: $("#subcategoria").val(),
            nome_galeria: $('#galeria option:selected').text(),       
            string_images: string_images
        },function(data){showAlertDim(data);}); 
    }else{
        showAlertDim("É necessário escolher uma galeria!");
    }
}

/*
 * Este método subscreve o método que existe dentro de extremos.
 * Se as duas classes forem utilizadas juntas irá dar o maior pau do
 * mundo.
 * 
 * PS: Pay Attention!!!
 * VER: this.id, this.name, this.title, "f"
 */
function addImageSlots(url_foto, id_foto, title_foto, type){
    //alert(url_foto + " - "+ id_foto + " - "+  title_foto+ " - "+  type);
    var image_gallery_init = "<div class='gallery_picture' id='gn_"+index+"'>";
    var image_gallery_picture = "<div id='slot_container_pict'><img id='slot_pict_id_"+ index +"' src='' width='' height='' alt='" + id_foto + "' name='"+id_foto+"' class='img_gallery_helper'/></div>";
    var image_gallery_buttons = "<div id='slot_support'><div class='container_gallery' id='"+ index +"'><div id='slot_edit_id_"+ index +"'><div class='base_gallery_container' id='base_"+ index +"'><div class='base_bt_edit' title='editar' id=''></div><div class='base_bt_select' title='index' id=''></div><div class='base_bt_remove' title='remover' id='"+ index +"'></div></div></div></div></div>";
    var image_gallery_end = "</div>";
    var image_total = image_gallery_init + image_gallery_buttons + image_gallery_picture + image_gallery_end;
    
    $("#gallery_loader_container").append(image_total);
    $(".footerPanAdmin").css("position", "relative");
    
    //This method is in CoolPicker.js
    //TODO: Put all together
    applyPictureSize(url_foto, index, "galeria");
    applyListeners();
    index++;
    
    //teste();
}


/*
 * It reloads the combobox subcategroia.
 *
 * @param number id
 *
 */
function reloadSubCategoriasGaleria(id){

    $.post("/admin/galeria/reload_subcategorias", {
        id: id
    },function(data){
        $("#loader_combo_subcategoria").empty().append(data); 
    });
}

/*
 * It reloads the combobox galeria.
 *
 * @param number id
 *
 */
function reloadCategoriasGaleria(id_sub){
    
    var id = $('#categoria').val();
    $.post("/admin/galeria/reload", {
        id: id,
        id_subcategoria: id_sub
        
    },function(data){
        $("#loader_combo_galerias").empty().append(data);
        $("#gallery_loader_container").empty(); 
        index=0;
        
        $("#galeria").unbind("change");
        $("#galeria").change(function() {
            reloadGraphics($("#categoria").val(), $("#galeria").val());        
        });
    });
}

/*
 * It reloads the graphics
 *
 * @param number id
 *
 */
function reloadGraphics(id_categoria, id_galeria){
    
    if($("#galeria").val() != ""){
        $("#gallery_loader_container").empty(); 
        index=0;
        $.post("/admin/galeria/replace", {
            id_categoria: id_categoria,
            id_galeria: id_galeria
        },function(data){
            $("#gallery_loader_message").empty().append(data);
        });
    }else{
        $("#gallery_loader_message").empty();
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
function verifyActionBanner(id_categoria, id_galeria, id){ 
    id_item_categoria = id_categoria;
    id_item_galeria = id_galeria;
    id_item = id; 
    showAlertDimCancel();
}

//------ List Methods
/*
 * It deletes the record from the data base.
 *
 * @param number id
 *
 */
function completeActionAlertDim(){

    $.post("/admin/galeria/remover_galeria", {        
        id_categoria: id_item_categoria,
        id_galeria: id_item_galeria
    },function(data){
        var jsonObject = eval('(' + data + ')');
        showAlertDim(jsonObject['message']);
        $("#container_" + id_item).fadeOut("fast");
    });
}

/*
 * It edits the record from the data base.
 *
 * @param number id
 *
 */
function editGaleria(id_categoria, id_galeria, type, id_subcategoria){
    if(type =='galeria') window.location = "/admin/galeria/editar?id_categoria="+id_categoria + "&id_galeria="+id_galeria+ "&id_subcategoria="+id_subcategoria; 
    if(type =='users') window.location = "/admin/galeria/editar_users?id_categoria="+id_categoria + "&id_galeria="+id_galeria+ "&id_subcategoria="+id_subcategoria;
}

/*
 * It edits the record from the data base.
 *
 * @param number id
 *
 */
function editGaleriaDetalhes(id_categoria, id_galeria, type, id_subcategoria){
    window.location = "/admin/galeria/detalhes?id_categoria="+id_categoria + "&id_galeria="+id_galeria+ "&id_subcategoria="+id_subcategoria;
}

/*
 * It edits the record from the data base.
 *
 * @param number id
 *
 */
function editGaleriaInfo(id_categoria, id_galeria, type, id_subcategoria){
    window.location = "/admin/galeria/informacao?id_categoria="+id_categoria + "&id_galeria="+id_galeria+ "&id_subcategoria="+id_subcategoria;
}

/*
 * Avoid some motherfucker problems with work or not!
 * 
 */
function applyListeners(){
    //See the listener for buttons edit into coolPicker.js
    $("#gallery_loader_container div.container_gallery").mouseenter(function() {       
        $("#base_" + this.id).fadeIn("faster");
    }).mouseleave(function() {           
        $("#base_" + this.id).fadeOut("faster");
    });
    
    //bug fix, of course!
    $('.base_bt_remove').unbind("click");    
    $(".base_bt_remove").click(function(e) { 
        
        var id_old = $("#slot_pict_id_"+this.id).attr("name");
        
        $("#slot_pict_id_"+this.id).attr("name", "undefined");    
        $("#gn_" + this.id).fadeOut("slow");
        
        $.post("/admin/galeria/remover", {        
        id_categoria: $("#categoria").val(),
        id_galeria: $("#galeria").val(),
        id: id_old
        },function(data){            
           
        });        
        //teste();
    });
}

/*
 * Saves a picture
 *
 * This method is called when the upload is completed
 * 
 */
function saveGaleriaPicture(){
    var image_sel = $('#file_helper').val();
    $.post("/site/images/salvar",{
            image: image_sel,
            tipo: "galeria"
        },function(data){                
            var jsonObject = eval('(' + data + ')');
            $("#gallery_loader_message").empty();              
            addImageSlots(image_sel, jsonObject['id_image'], "Title", "f");
        });
}

//De - FUCKING - Bugger
function teste(){
     var string_images = "";
    //alert($("#slot_pict_id_"+this.id).attr("name"));
    //$("#gallery_loader_container").children('img');
    for(var i = 0; i< $("#gallery_loader_container").children().length; i++){
        if($("#slot_pict_id_"+i).attr('name') != "undefined"){
            string_images += $("#slot_pict_id_"+i).attr('name');
            //$("#teste").append($("#slot_pict_id_"+i).attr('name') + "<br/>" );
            if(i < ($("#gallery_loader_container").children().length - 1)) {                
                string_images += ",";
            }                 
            $("#teste").empty().append(string_images+ "<br/>" );            
        }
    }
    
}

//De - FUCKING - Bugger
function galeriaCreated(){
    //alert('galeriaCreated!');
    
}