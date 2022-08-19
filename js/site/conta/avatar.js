/*
 * Javascript Document 
 * Avatar main JS, used into create user account 
 * 
 * AVATAR handler
 *
 */
$(document).ready(function(){            
        setTimeout("initListenersAvatar()", 200);            
    }        
);   

/*
 * Sets some listeners to be used in the avatar selection  
 * If an avatar free is selected
 *
 */
function initListenersAvatar(){

    initListenerAvatarPicture();
    
    //Upload listener
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
                $('#file_helper').val(responseJSON['file_name']);
                saveAvatarPicture();
              
            }
        }
    });
           
    
    $("#bt_avatar_user").click(function(){
        $.post("/admin/images/change",{
            tipo: "user"
        },
        function(data){                
            $("#container_avatars_purplepier").empty().append(data);
        });
    });
    
    $("#bt_avatar_free").click(function(){
        $.post("/admin/images/change",{
            tipo: "common"
        },
        function(data){                
            $("#container_avatars_purplepier").empty().append(data);
        });
    });
    
    $("#bt_avatar_special").click(function(){
        $.post("/admin/images/change",{
            tipo: "special"
        },
        function(data){                
            $("#container_avatars_purplepier").empty().append(data);
        });
    });
    
    $("#bt_avatar_geral").click(function(){
        $.post("/admin/images/change",{
            tipo: "geral"
        },
        function(data){                
            $("#container_avatars_purplepier").empty().append(data);
        });
    });

}

/*
 * Sets the listeners to the avatar pictures
 * 
 *
 */
function initListenerAvatarPicture(){    
    
    $(".avatar_slot_picture img").unbind("click");
    $(".avatar_slot_picture img").click(function(){
        
        var avatar_id = this.id.split("_");

        //Se for avatar do sistema PurplePier
        if(this.alt == "purplepier"){            
            $.post("/admin/images/obter",{
                id_image: avatar_id[1],
                tipo: "avatar"
            },function(data){                
                var jsonObject = eval('(' + data + ')');
                var path_cool =  "/media/images/avatar/" + jsonObject['cool_m'];                
                applyPictureSize(path_cool);
            }); 
            
        //Se for imagem cadastrada pelo usuário
        }else{
            $.post("/admin/images/obter",{
                id_image: avatar_id[1],
                tipo: "user"
            },function(data){                
                var jsonObject = eval('(' + data + ')');
                var path_cool =  "/media/user/images/thumbs_120/" + jsonObject['foto'];               
                applyPictureSize(path_cool);
            });
        }
    });
}

/**
 * It calculate the images sizes
 *
 * @param string
 *
 */
function applyPictureSize(path_cool_stuff){

    var img = new Image();
    img.onload = function(){

        if(this.width > this.height){
            percet = 120 / this.width;
        }else{
            percet = 120 / this.height;
        }

        var result = new Array();
        result[0] = this.width * percet;            
        result[1] = this.height * percet;          

        $("#avatar_picture").attr("src",  path_cool_stuff);
        $("#avatar_picture").css("position", "relative");

        if(this.width > this.height){ 
            //$("#avatar_picture").css("top",  "50%");
            //$("#avatar_picture").css("margin-top", ((result[1] / 2) * -1)+ "px");
                            
        }else{       
            //$("#avatar_picture").css("left",  "50%");
            //$("#avatar_picture").css("margin-left",  ((result[0] / 2) * -1)+ "px");
                            
        } 
        
        $("#formAvatar").val(path_cool_stuff);
    }
    img.src = path_cool_stuff;
}

/*
 * Uploads and apply Avatar picture = 
 *
 * This method is called when the upload is completed
 * See the upLoadfy above.
 * 
 */
function applyPictureAvatar(){        
    var path_image_avatar = "/media/images/avatar/" + $("#file_helper").val();
    applyPictureSize(path_image_avatar);        
}

/*
 * Saves a picture
 *
 * This method is called when the upload is completed
 * 
 */
function saveAvatarPicture(){
    var image_sel = $('#file_helper').val();
    $.post("/admin/images/salvar",{
        image: image_sel,
        tipo: "avatar"
    },function(data){                
        var jsonObject = eval('(' + data + ')');
        var path_cool =  "/media/user/images/thumbs_120/" + image_sel;               
        applyPictureSize(path_cool);
        addNewAvatar(image_sel);
    });
}

/*
 * Adds a picture on stage
 *
 * This method adds a new picture on stage.
 * @param string
 * 
 */
function addNewAvatar(image_sel){
    var new_pict = "<div class='avatar_slot_picture' id='"+ image_sel +"' class='user'><img src='/media/user/images/thumbs_120/"+ image_sel +"' width='40' height='40'/></div>";
    $(".avatar_container_free_icons").append(new_pict);
}