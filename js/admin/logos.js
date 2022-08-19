/*
 *
    Document   : eventos admin
    Created on : 02/01/2011, 16:31:00
    Author     : CarlosGarcia
    Description:
    Purpose of the javascript follows.
*
*/
var i = 2;

$(document).ready(function(){

    $('#bt_update, .icon_save').click(function(){       
        submitForm();
    });

});

/*
 * It sends the values by POST
 * All field must be declared bellow
 * 
 * @param string
 *
 */
function submitForm(){
    
    //Put a preloader on stage
    showAlertDimPreloader(true, 'Salvando...');
    
    var logo_redes_sociais  = $('#id_slot_1').text();
    var logo_email = $('#id_slot_2').text();
    var logo_email_image = $('#slot_pict_id_2').attr('data-image-name');
    var logo_site_image = $('#slot_pict_id_7').attr('data-image-name');
    var logo_tablet_intro = $('#id_slot_3').text();
    var logo_tablet = $('#id_slot_4').text();
    var logo_app = $('#id_slot_5').text();
    var logo_mobile = $('#id_slot_6').text();
    var logo_site = $('#id_slot_7').text();
    var logo_impressao = $('#id_slot_8').text();
    
    $.post("/admin/logos/atualizar",{            
        logo_email: logo_email, 
        logo_email_image: logo_email_image,
        logo_redes_sociais: logo_redes_sociais,
        logo_tablet_intro: logo_tablet_intro,
        logo_tablet: logo_tablet,
        logo_app: logo_app,
        logo_mobile: logo_mobile,
        logo_site: logo_site,
        logo_site_image: logo_site_image,
        logo_impressao: logo_impressao

    },function(data){
        var jsonObject = eval('(' + data + ')');
        showAlertDim(jsonObject['message']);
    });   
}