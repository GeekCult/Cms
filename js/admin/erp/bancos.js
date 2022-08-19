/*
    Document   : Bancos admin
    Created on : 05/01/2011, 09:31:00
    Author     : CarlosGarcia
    Description:
    Purpose of the javascript follows.
*/


$(document).ready(function() {
    
    if($("#helper_action").attr('data-js-action') == "new") setMainListeners();
    if($("#helper_action").attr('data-js-action') == "list") setListListeners();
    if($("#helper_action").attr('data-js-action') == "settings") setSettingsListeners();

});

/*
 * It set main listeners
 *
 */
function setMainListeners(){
   
   $('#bt_save').click(function() {
        updateFinanceiroForm();
   });
}

/*
 * It set settings listeners
 *
 */
function setSettingsListeners(){
   
   $('#bt_save').click(function(){
        //Put a preloader on stage
        showAlertDimPreloader(true, 'Salvando...');
        $.post("/admin/bancos/salvar_settings",{
            data: $("form#form_settings").serialize()

        },function(data){
            var jsonObject = eval('(' + data + ')');
            showAlertDim(jsonObject['message']);
        });
   });
}

/*
 * It set main listeners
 *
 */
function setListListeners(){
  
    $('.bt_edit').click(function(){
        window.location = "/admin/boletos/editar/"+ $(this).attr('name');
    }); 
   
    $('.bt_ver').click(function(){
        window.open('/admin/boletos/ver/' + $(this).attr('name'), '_blank');
    });
   
    $('.bt_delete').click(function() {
       verifyActionBanner($(this).attr('name'));
    });
   
    $('#bt_update_status').click(function(){       
       //Put a preloader on stage
       showAlertDimPreloader(true, 'Atualizando...');
       $.post("/admin/bancos/atualizar",{       
            action: 'ajax'            
        },function(data){            
            var jsonObject = eval('(' + data + ')');
            showAlertDim(jsonObject['message']);
        });
    });
   
    $('.bt_protestar').click(function(){       
       //Put a preloader on stage
       showAlertDimPreloader(true, 'Protestando...');
       $.post("/admin/bancos/protestar",{       
            id: $(this).attr('data-id')           
        },function(data){            
            var jsonObject = eval('(' + data + ')');
            showAlertDim(jsonObject['message']);
        });
    });
    
    $('.bt_registrar').click(function(){       
       //Put a preloader on stage
       showAlertDimPreloader(true, 'Registrando...');
       $.post("/admin/bancos/registrar",{       
            id: $(this).attr('data-id')           
        },function(data){            
            var jsonObject = eval('(' + data + ')');
            showAlertDim(jsonObject['message']);
        });
    });

    //List listene 
    $("#list_year, #list_month").change(function(){
        
        var value = $(this).val();
        var type = $(this).attr('rel');
        
        $.post("/site/relatar/set_session_data",{
            id_user: 0,
            label: type + '_financeiro',
            value: value
            
        },function(data){
            window.location.reload();
        });
    });

    $('#bt_register_many').click(function() {
        var seletedKeys = [];
        var checkboxes = document.getElementsByTagName('input');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].type == 'checkbox' && checkboxes[i].checked && checkboxes[i].name == 'autoId[]') {
                seletedKeys[seletedKeys.length] = checkboxes[i].value;
            }
        }

        if (seletedKeys.length > 0) {
            //Put a preloader on stage
            showAlertDimPreloader(true, 'Registrando...');
            $.post("/admin/bancos/registrar",{
                id: 0, ids : seletedKeys
            },function(data){
                var jsonObject = eval('(' + data + ')');
                showAlertDim(jsonObject['message']);
            });
        } else {
            alert('Selecione pelo menos um boleto para fazer o registro!');
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
    
    $.post("/admin/bancos/excluir",{id: id_item},function(data){
        var jsonObject = eval('(' + data + ')');
        $("#obj_container_" + id_item).fadeOut("slow");
        showAlertDim(jsonObject['message']);
        setTimeout("tb_removeAlert('common')", 1500);
    });
}

/*
 * It sends the values from the textfield
 *
 */
function updateFinanceiroForm(){
    
    var allowSubmit = true;
    
    $("#message_error").hide();    
    var vencimento = $("#vencimento").val();
    
    if(vencimento == "") allowSubmit = false;
    
    if(allowSubmit){
        //Put a preloader on stage
        showAlertDimPreloader(true, 'Salvando...');
        $.post("/admin/bancos/salvar",{     
            data: $("form#form_bancos").serialize()

        },function(data){
            var jsonObject = eval('(' + data + ')');
            if(jsonObject['ERROR']){
                showAlertDim(jsonObject['MESSAGE']);
            }else{
                showAlertDim(jsonObject['message']);
            }
            
        });
    }else{
        $("#message_ctn").empty().append("A data de vencimento deve estar preenchida!");
        $("#message_error").show();
    }
}

/*
 * Set information into entity
 */
function setUserInformation(id, name, email){
    $("#cliente").val(name);
    $("#id_entidade").val(id);
}

function checkAll(ele) {
    var checkboxes = document.getElementsByTagName('input');
    if (ele.checked) {
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].type == 'checkbox') {
                checkboxes[i].checked = true;
            }
        }
    } else {
        for (var i = 0; i < checkboxes.length; i++) {
            console.log(i)
            if (checkboxes[i].type == 'checkbox') {
                checkboxes[i].checked = false;
            }
        }
    }
}
