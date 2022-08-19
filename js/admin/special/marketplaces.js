/*
    Document   : marketplaces admin
    Created on : 31/12/2010, 16:31:00
    Author     : CarlosGarcia
    Description:
    Purpose of the javascript follows.
*/

//Init
$(document).ready(function(){

    if($('#helper_action').val() == 'gerenciar') initMarketPlace();
    

});//Close Document Ready

/*
 * It inits the listener and actions for the listar produtos
 *
 */
function initMarketPlace(){

    $('body').on('click', '.table_support :button', function(e) {
        switch($(this).attr('data-action')){

            case "publicar":
                publicar($(this).attr('data-place'), $(this).attr('data-id'));
                break;

            
        }
    });
}

/*
 * Submit to MarketPlace
 *
 */
function publicar(marketplace, id_produto){
    
   
    $.post("/admin/marketplace/publicar",{
        id_produto: id_produto,
        marketplace: marketplace,
      
        
    },function(data){
        var jsonObject = eval('(' + data + ')');
        showAlertDim(jsonObject['message']);
    });
}