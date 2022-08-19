/* Xml js
------------------------------------------------ */

var Xml = function () {
    
    "use strict";

    return {
            //main function
            init: function(){
                setXmlListeners();
            },

            request: function(data){
                $("#output").empty().append("<div class='bg-info'>Executando...</div>");
                $.post("/admin/xml" + data.url, data, function(data){
                    var jsonObject = eval('(' + data + ')');
                    $("#output").empty().append(jsonObject['view']);
                });
            }
                
                
  };
}();


var setXmlListeners = function() {
    
    "use strict";
    
    $("body").on("click", ".bt_request", function(){
        Xml.request({url: $(this).attr('data-url')});
    });
    
    $("body").on("click", ".bt_clear_result", function(){
        $("#output").empty();
    });
    
    
   
};