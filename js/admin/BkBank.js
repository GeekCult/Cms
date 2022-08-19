/* BK Bank js
------------------------------------------------ */

var BkBank = function () {
    
	"use strict";
	
	return {
		//main function
		init: function(){
                    setBkBankListeners();
		},
                
                showImages: function(data){
                    $("#loader_images").empty();
                    
                    $("#modal-images h4").text('Images');
                    $("#modal-images").modal('show');
                    $.post("/admin/images/load_images",{ },function(data){
                        var jsonObject = eval('(' + data + ')');
                        $("#loader_images").empty().append(jsonObject['view']);                       
                    });                    
                },
                
                request: function(data){
                    $("#output").empty().append("<div class='bg-info'>Executando...</div>");
                    $.post("/admin/bkbank" + data.url, data, function(data){
                        var jsonObject = eval('(' + data + ')');
                        $("#output").empty().append(jsonObject['view']);
                    });
                },
                
                addField: function(data){
                    $.post("/admin/sistema/" + data.action,{
                        tipo: data.tipo,
                        id: data.id,
                        data: data.form
                    },function(data){
                        var jsonObject = eval('(' + data + ')');
                        $("#fields_loader").empty().append(jsonObject['view']);
                    });
                },
                
                removeField: function(data){
                    $.post("/admin/sistema/deletar_field",{  
                        id: data.id,
                        id_item: data.id_item,
                        tipo: data.tipo
                    },function(data){
                        var jsonObject = eval('(' + data + ')');
                        $("#fields_loader").empty().append(jsonObject['view']);
                    });
                }
                
                
  };
}();


var setBkBankListeners = function() {
    
    "use strict";
    
    $("body").on("click", ".bt_request", function(){
        BkBank.request({url: $(this).attr('data-url')});
    });
    
    $("body").on("click", ".bt_clear_result", function(){
        $("#output").empty();
    });
    
    
   
};