/*
 * Javascript Document
 * 
 * Main JS, create user account 
 *
 */

/*
 * 
 * It adds the listener for the private area
 * It's separate to provide further flexibility in some 
 * eventual expense
 * 
 */

$(document).ready(function(){
    initListenerMenuContaUser();
});

function initListenerMenuContaUser(){

    //Helper type controller admin or account
    var tipo_controller = $("#helper_tipo_controller").val();
    
    //Type user - edits from each type of account
    $(".table_support :button").live('click', function(){        
        switch(this.id){
            case "bt_edit":
                var type_user = "editar_pf";
                if(this.className == 1) type_user = "editar_pj";
                window.location = "/" + tipo_controller + "/users/" + type_user + "/" + this.name;
                break;
                
            case "bt_delete":
                verifyAction(this.name, this.title);
                break;
            
            case "bt_key":
                verifyAction(this.name, this.title);
                break;
                
            case "bt_lock_open":
                $(".op_"+this.name).attr("id", "bt_lock_close");
                 changeLockedAccount(1, this.name);//1 = fechado
                break;
                
             case "bt_lock_close":
                $(".op_"+this.name).attr("id", "bt_lock_open");
                changeLockedAccount(0, this.name);//0 = aberto
                break;
            
             case "bt_lock_close_red":
                $(".op_"+this.name).attr("id", "bt_lock_open");
                changeLockedAccount(2, this.name);//0 = aberto
                break;
             
             case "bt_lock_close_red":
                $(".op_"+this.name).attr("id", "bt_lock_open");
                changeLockedAccount(2, this.name);//0 = aberto
                break;
             
             case "bt_status_account":
                
                switch(this.className){
                    
                    case 'icon_status_ativo':
                        $(this).removeClass().addClass('icon_status_aguardando');
                        var status = 3;
                        break;

                     case 'icon_status_inativo':
                        $(this).removeClass().addClass('icon_status_ativo');
                        var status = 1;
                        break;

                    case 'icon_status_alerta':
                        $(this).removeClass().addClass('icon_status_inativo');
                        var status = 0;
                        break;

                    case 'icon_status_aguardando':
                        $(this).removeClass().addClass('icon_status_alerta');
                        var status = 4;
                        break;
                
                }
                
                changeAccountStatus(status, this.name);
                break;
        }
        
    });

} 

/*
 * 
 * It adds the listener for the private area
 * It's separate to provide further flexibility in some 
 * eventual expense
 * 
 */
function initListenerSelectionUser(){

    //Type user - edits from each type of account
    $("#users_support :button").click(function(){ 
        if(parent.$('#helper_user_type').val() != undefined){
            setUserInfosGallery(this.alt, $(this).val(), this.title);   
        }else{
            setUserInfos(this.alt, $(this).val(), this.title);      
        }
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
 * @param string type
 *
 */
function verifyAction(id, type){    
    id_item = id;
    type_action = type
    showAlertDimCancel();
}

/*
 * It separates the user choice,
 * between removes or send reset password
 * 
 * Into changeLockedAccount(), the number 2 is just to
 * uses the old method update and reset user account.
 * Inside this method it is change to 0 again.
 *
 */
function completeActionAlertDim(){    
    if(type_action == "excluir"){
        removeUserItem();
    }else{
        changeLockedAccount(2, id_item);
    }
}

/*
 * It set the user data to a needed fields
 *
 * @param number id
 *
 */
function setUserInfos(id, name, email){

    if(parent.$("#type_user_insert").val() != undefined){
        parent.setUserInformation(id, name, email);
    }else{
        parent.$("#nome").val(name);
        parent.$("#email").val(email);
        parent.$("#id_usuario").val(id);
    }
}


/*
 * It set the user data to a needed fields for gallery
 *
 * @param number id
 *
 */
var nrUG_item = 0;
function setUserInfosGallery(id, name, email){
    
    parent.$("#message_empty").remove();
    parent.$("#nome").val(name);
    parent.$("#email").val(email);
    parent.$("#id_usuario").val(id);   
    
    var item = "<tr id='obj_container_"+id+"' class='rows_table_0' data-id='"+ id +"'>";
    item += "<td align='center'><img src='/media/images/icons/icon_mais.png' width='20' height='20'/></td>";
    item += "<td>" + name + "</td>";
    item += "<td align='center'><input id='bt_delete' type='button' name='"+ id +"' title='excluir' class='bt_rm_user'/></td>";
    item += "</tr>";
    
    parent.$('#user_loader_container').append(item);
    nrUG_item++;
}

/*
 * It set the status account lock
 *
 * @param number
 *
 */
function changeLockedAccount(status, id){
    
    $.post("/users/account_lock",{
        status: status,
        id: id
    },function(data){
        showAlertDim(data);
    });
}


/*
 * It set the status account
 *
 * @param number
 *
 */
function changeAccountStatus(status, id){
    
    $.post("/users/account_status",{
        status: status,
        id: id
    },function(data){
        showAlertDim(data);
    });
}



/*
 * It deletes the record from the data base.
 *
 * @param number id
 *
 */
function removeUserItem(){
    
    $("#obj_container_" + id_item).animate({opacity: 0});

    $.post("/admin/users/admin/deletar",{
        id: id_item
    },function(data){
        showAlertDim(data);
        $("#obj_container_" + id_item).hide("slow");
    });
}

/**
 * Init Live Search User
 * It's used for both: PF and PJ users
 * It's used into conta session
 *
 **/
function initLiveSearchUser(){

    //This action get the keyboard event 13 = ENTER
    //If the user press ENTER it's the same to click on the button buscar
    $('#liveSearch').keyup(function(event){
        
        var searchLive = $("#liveSearch").val();        

        if(searchLive.length >= 2){           
            $.post("/conta/users_selection/live_search",{
                search_live: searchLive
            
            },function(data){              
                //It transforms the returned json array in an object
                var jsonObject = eval('(' + data + ')'); 
                
                if(jsonObject['items'].length > 0){
                    var items_sc = "";
                    $("#items_live_search_user").empty();
                    for(i = 0; i < jsonObject['items'].length; i++){
                        items_sc  = "<div class='item_sl_c'>";
                        items_sc += "<div class='item_sl_c_string'>" + jsonObject['items'][i]['field1'] + "</div>";
                        items_sc += "</div>";
                        $("#items_live_search_user").append(items_sc);
                        $("#items_live_search_user").fadeIn("fast");
                        isUserSearchLive = true;
                    }
                    
                    
                }           
            });
         }      
    });
    
    $("#bt_live_search_user").click(function(){
        
        if(isUserSearchLive){
            $("#items_live_search_user").fadeOut("fast");
            isUserSearchLive = false;
        }else{
            $("#items_live_search_user").fadeIn("fast");
            isUserSearchLive = true;   
        }
    });
  
    $("#search_name_user, #email_user").keyup(function(event){
        loadUsers();        
    });
    
    $("#search_status_user, #search_type_user").change(function(){
        loadUsers();
    });
   
}

/**
 * Loads a new bunch of users
 * 
 */
function loadUsers(){

    var nameUser = $("#search_name_user").val();  
    var typeUser = $("#search_type_user").val();
    var statusUser = $("#search_status_user").val();
    var emailUser = $("#email_user").val();

    if(nameUser.length >= 3 || nameUser.length == 0){
        $.post("/conta/users_selection/filter_simple",{
            name_user: nameUser,
            type_user: typeUser,
            status_user: statusUser,
            email_user: emailUser

        },function(data) {
            $("#base_row").empty().append(data);
        });
    }
}


/* Clientes Purple*/

/*
 * 
 * It adds the listener for the private area
 * It's separate to provide further flexibility in some 
 * eventual expense
 * 
 */
function initListenerUsersPurple(){    

    $("#bt_salvar").click(function(){ 
        
        $.post("/admin/users/admin/salvar_by_tag",{
            data: $("form#form_client").serialize()

        },function(data) {
            showAlertDim(data);
        });        
    });
    
    $("#bt_salvar_detalhes").click(function(){ 
        
        $.post("/admin/users/admin/salvar_detalhes_by_tag",{
            data: $("form#form_detalhes").serialize()

        },function(data) {
            showAlertDim(data);
        });        
    });
    
    $(".users_tab").live('click', function(){
        $("#userContainer_0, #userContainer_1, #userContainer_2, #userContainer_3, #userContainer_4").hide();
        $("#userContainer_" + $(this).attr('data-tab')).show();
    });
    
    $("#bt_testar_conexao").click(function(){
       $("#msg_conexao").text('Conectando...');
       $.post("/admin/sql/testar_conexao_individual",{
            host: $("#host_db").val(),
            port: $("#host_port").val(),
            user: $("#id_name").val(),
            db: $("#db").val(),
            pass: $("#referencia").val()

        },function(data) {
            var jsonObject = eval('(' + data + ')');
            if(jsonObject['status']){
                $("#msg_conexao").text('Conexão realizada com sucesso');
            }else{
                $("#msg_conexao").text('ERROR: Não foi possível conectar');
            }
            
        });
    });
    
    $("#bt_testar_ftp").click(function(){
       $("#msg_conexao_ftp").text('Conectando...');
       $.post("/admin/sql/testar_conexao_ftp",{
            host: $("#host_site").val(),
            port: 21,
            user: $("#ftp_user").val(),
            pass: $("#ftp_senha").val()

        },function(data) {           
            $("#msg_conexao_ftp").text('Conexão: ' + data);
            
        });
    });
} 

/*
 * 
 * It adds the listener for the private area
 * It's separate to provide further flexibility in some 
 * eventual expense
 * 
 */
function initListenerUsersPartner(){
    

    $("#bt_salvar").click(function(){ 
        
        $.post("/admin/users/admin/salvar_by_tag",{
            data: $("form#form_client").serialize()

        },function(data) {
            showAlertDim(data);
        });
        
    });
} 

/*
 * 
 * It adds the listener for the private area
 * It's separate to provide further flexibility in some 
 * eventual expense
 * 
 */
function initListenerUsersProfessional(){    

    $("#bt_salvar").click(function(){ 
        $.post("/admin/users/admin/salvar_by_tag",{           
            data: $("form#form_client").serialize()

        },function(data) {
            showAlertDim(data);
        });
    });
} 

/*
 * 
 * It adds the listener for the private area
 * It's separate to provide further flexibility in some 
 * eventual expense
 * 
 */
function initListenerUsersTags(){    

    $("#filtro").change(function(){        
        var tag = $("#filtro").val();        
        window.location = '/admin/users/' + tag;
        
    });
    
    
}

/**
 * Init Live Search User
 * It's used for both: PF and PJ users
 * It's used into conta session
 *
 **/
function initLiveSearchUserKindOf(){

    //This action get the keyboard event 13 = ENTER
    //If the user press ENTER it's the same to click on the button buscar
    $('#search_name_user, #email_user').keyup(function(event){
        
        var searchLive = $("#search_name_user").val(); 
        var emailLive = $("#email_user").val();
        var type = $("#filtro").val();
        
        if(searchLive.length >= 3 || emailLive.length >= 3){           
            $.post("/conta/users_selection/live_search_kind_of",{
                search_live: searchLive,
                email_live: emailLive,
                type: type
            
            },function(data){               
                $('#base_row').empty().append(data);
            });
         }      
    });
    
    $('#search_name_user').focus(function(){
        $('#email_user').val('');
    });
    
    $('#email_user').focus(function(){
        $('#search_name_user').val('');
    });
}