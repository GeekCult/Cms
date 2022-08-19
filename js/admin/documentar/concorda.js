/*
    Document   : concorda admin
    Created on : 11/04/2011, 19:31:00
    Author     : CarlosGarcia
    Description: Configurar class
    Purpose of the javascript follows.
*/

//Init
$(document).ready(function(){

    $("#bt_concorda").click(function() {
        if($("input[name='concorda']").is(':checked')){
            submitConcordo();
        }else{
            $("#output").empty().append("<div class='bg-danger mgB'>Você deve concordar com os termos de uso</div>");
        }
    });

});//Close Document Ready

/*
 * Agreed
 *
 */
function submitConcordo(){
    
    $.post("/admin/documentacao/concorda/salvar", { },function(data){
        parent.$.fancybox.close();
        //alert(data);
    });   
}