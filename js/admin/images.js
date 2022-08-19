/*
    Document   : galeria admin
    Created on : 06/01/2011, 16:31:00
    Author     : CarlosGarcia
    Description:
    Purpose of the javascript follows.
*/
var slotUsed = 1;

function initImages2(){setTimeout("initImages()", 200);}
function initImagesFancy(){setTimeout("initFancyListener()", 40);}

function initImages(){ 
    
    var path_folder = "media/user/images";
    current_picture = $("#image_banner").attr("name");
   
    var isThumbnails = $("input[name='miniatura']:checked").val();
    //file_input = false;//Avoid start upload automatic   
    uploader = new qq.FileUploader({
        element: document.getElementById('file'),
        action: "/admin/images/upload_admin",
        params: {path: path_folder, hasThumbs: isThumbnails, current_image: current_picture, replace: false},
        debug: false,
        onComplete: function(id, fileName, responseJSON){
            if(responseJSON['success']){
                
                //$("#image_banner").attr("src", "/" + path_folder + "/original/" + fileName);
                $("#image_banner").attr("name", responseJSON['file_name']);
                $('#file_helper').val(responseJSON['file_name']);
                $('#stage').hide();
                $('#image_banner').show();
                
                //Special dor minisites
                if(responseJSON['uploadThumbNeed']) {setTimeout(function(){uploadThumbMiniSite(responseJSON['file_name']);},2000);}
            }
        }
    });

    $("#bt_submit").click(function() {
        submitForm("cadastrar");
    });
    
    $("#bt_update").click(function() {
        submitForm("update");
    });

    $("#categoria").change(function() {
        reloadItems($("#categoria").val());
    });   

    $('#bt_clear').click(function(){
        clearForm();
    });

    $('#bt_define').click(function(){
        clearForm();
    });

    //It verifys id is selected or unselect to launch the specific action
    $(':checkbox').click(function(){
        switch(this.id){
            case "check_select":                    
                if($(this).attr('checked')){
                    selectForm(this.value, this.name);                        
                }else{
                    unSelectForm(this.alt, this.name);
                }
                break;
        }
    });
    
    initImagesListeners();
};

/*
 * It init listeners: Fancybox 
 *
 */
function initImagesFancy(){  
    $("#categoria_fancy").change(function() {
        reloadItemsFancy($("#categoria_fancy").val());
    });
    
    $("#support_people a").click(function(e){
        
        $('#support_people a').removeClass('active');
        $(this).addClass('active');
        
        $.post("/admin/images/set_image_type",{            
            type: this.name

        },function(data){
            var jsonObject = eval('(' + data + ')');
            //showAlertDim(jsonObject['message']);
            parent.$("#fancybox_images_launcher").trigger('click');
        });
        
        e.preventDefault();
    });
}

/*
 * It init Grid listeners
 * Pay Attention: They are differents 
 *
 */
function initImagesListeners(){

    $('.bt_remover').click(function(){
        excluirImage(this.id, this.name, "images");
    });

    $('.bt_remover_cool_image').click(function(){
        excluirImage(this.id, "banners/images");
    });  
}

/*
 * It init List listeners
 * Pay Attention: They are differents
 *
 */
function initImagesListListeners(){ 
    
    $('.bt_edit').live('click', function(){
        window.location = "/admin/images/editar/" + this.id;
    });
    
    $('.bt_delete').live('click',function(){        
        verifyAction(this.id, this.name, "images");
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
function verifyAction(id, type, local){    
    id_item = id;
    type_item = local;
    name_item = type;
    
    showAlertDimCancel();
}

/*
 * It sends the values from the textfield
 *
 */
function submitForm(action){
    var id_image = $('#helper_id_image').val();
    var title = $('#title').val();
    var arquivo = $('#file_helper').val();
    var descricao = $('#description').val();
    var id_categoria = $('#categoria').val();
    var tipo = "";
    
    if(arquivo == ""){        
        $(".message_errors").css("display", "block");
    }else{        
        //Put a preloader on stage
        showAlertDimPreloader();
        $(".message_errors").css("display", "none");
        $.post("/admin/images/" + action,{            
            title: title,
            file: arquivo,
            description: descricao,
            id_category: id_categoria,
            tipo: tipo,
            id_image: id_image
        },function(data){
            showAlertDim(data);
            if(action == "novo") clearForm();
        });
    
    }
}

/**
 * Select Form
 * It sends the values from the textfield
 *
 */
function selectForm(img, id_p){

    slotUsed = $('#helper').attr('title');

    if(slotUsed == "false"){
        showAlertDim("Todos os slots estão cheios!");
    }else{
        var image = img;
        var slot = "foto_" + slotUsed;
        var id_page = id_p;

        $.post("/admin/galeria/anexar",{
            slot: slot,
            image: image,
            id_page: id_page
        },
        function(data){
            updateSlotNumber(id_page);
        });
    }
}

/**
 * Unselect Form
 * It removes the image from the correct slot
 *
 */
function unSelectForm(slotimg, id_p){

    var slot = "foto_" + slotimg;
    var id_page = id_p;

    $.post("/admin/galeria/desanexar",{  
        slot: slot,
        id_page: id_page
    },
    function(data){
        updateSlotNumber(id_page);
    });
}

/*
 * It removes the selected image and unlink this one
 * into the directory
 *
 */
function excluirImage(id, image_name, type){

    
}

/*
 * It deletess the record from the data base.
 *
 * @param number id
 *
 */
function completeActionAlertDim(){

    $.post("/admin/" + type_item + "/deletar", {
        id: id_item,
        image_name: name_item
    },function(data){
        $("#img_container_" + id_item).fadeOut("slow");
        showAlertDim(data);
        setTimeout("tb_removeAlert('common')", 1500);
    });
}

/**
 * It clears the textfield from form.
 *
 */
function clearForm(){
    $('#title').val("");
    $('#file').val("");
    $('#description').val("");
}

/**
 * load Item
 * It loads the item file that was separeted to impreve some
 * works!
 *
 *
 */
function loadItems(){
    $("#Searchresult").load("/admin/images/paginar/0");
}

/**
 * Update Slot Number
 * It does a double check retrieving the empty slot
 * 
 * It's useful if a check and uncheck checkbox was done.
 *
 */
function updateSlotNumber(id_page){
    $.post("/admin/images/recontar",{  
        id_page: id_page
    },function(data){
        person_list = eval(data);
        showAlertDim(person_list[1]);
        $('#helper').attr('title', person_list[0]);
        $('#helper2').val(person_list[0]);
    });            
}

/**
 * Define a image that will be edit
 *
 * This method is called from the editar.php view
 *
 */
 function setSwfEditable(swf, local){
     var path = "/media/swf/"+ local +"/";
     imageSelectedEdit = img;
     imageSelectedSize = getImgSize(path + swf);

     posicao_x = 0;
     setTimeout('waitLoad(imageSelectedSize)', 1000);
 }

 /**
 * Define an image that will be edited
 *
 * This method is called from the editar.php view
 *
 */
 function setImageEditable(img){
     var path = "/media/images/user/";
     imageSelectedEdit = img;
     imageSelectedSize = getImgSize(path + img);

     posicao_x = 0;
     setTimeout('waitLoad(imageSelectedSize)', 1000);
 }

/**
 * This method avoid some time bugs
 *
 * The swf banner_maker get about 200ms to load,
 * so a delay sometimes is needed.
 *
 */
 function waitLoad(imageSelectedSize){
     var flashMovie = getFlashMovieObject("banner_maker");
     flashMovie.controlFlashStuff(imageSelectedEdit, posicao_x, "image");

     var marg_left = ((imageSelectedSize[0] / 2 ) * -1 );

     $(".editar_swf_img_landscape").css("width", imageSelectedSize[0]);
     $(".editar_swf_img_landscape").css("margin-left", marg_left);
 }


/**
 * This method retrieve the images's size
 *
 */
 function getImgSize(imgSrc){
    var newImg = new Image();
    var arrSize = new Array();

    newImg.src = imgSrc;

    arrSize[0] = newImg.width;
    arrSize[1] = newImg.height;

    return arrSize;
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
    $.post("/admin/images/recarregar/",{
        id_categoria: id_cat
    },function(data){
        $('#ItemManager').empty().append(data);
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

    $.post("/admin/images/recarregar_fancy", {
        id_categoria: id_cat,
        type_images: type_images
    },function(data){
        $('#ItemManager').empty().append(data);
    });
}



/* Embeded Images */
function initImagesEmbeded(){

    $('#bt_submit_embeded').click(function(){
        var title = $('#title').val();    
        var description =  $('#description').val();
        var code =  $('#code').val();
    
        $.post("/admin/cool/save_embeded_image",{  
            title: title,
            description: description,
            code: code
            
        },function(data){  
            showAlertDim(data);
   
        });
    });
    
};

function initImagesEmbededList(){

    $('#images_support :button').click(function(){
       parent.addImageEmbededSlots($(this).attr('name'), $(this).attr('id'), $(this).attr('title'), 'e', false);
    });
}