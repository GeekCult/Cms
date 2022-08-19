/*
 * Javascript Document 
 * Atributos JS, used into create user account 
 * 
 * Attributos Handler
 *
 */  

/*
 * Sets some listeners to be used in the avatar selection  
 * If an avatar free is selected
 *
 */
function initListenersAtributes(){
    
    id_item_added = 0;
    array_items = new Array();
    
    $("#bt_add_atribute").click(function(){

        //If there are not values or it is the original phrase, thus empty
        if(array_items[0] == "" || array_items[0] == undefined) $(".container_items_client").empty();
        
        var item_selected = $("#type_account").val();
        $(".container_items_client").append("<div class='item_attr_client' id='id_Attr_"+id_item_added+"'>  Adicionado -> "+ item_selected + "<div class='bt_close_client'><input type='button' class='bt_delete_transparent' id='it_"+id_item_added+"'/></div></div>");
        
        addAttributoToField(item_selected);
        $("#helper_check_update").val(1);
    });
    
    $("body").on('click', ".bt_delete_transparent", function(){
        removeItemAttribute(this.id);
    });
    
    setUserAttributes();
}

/*
 * Sets some listeners to be used in the avatar selection  
 * If an avatar free is selected
 *
 */
function addAttributoToField(atributo_item){
    
    array_items[id_item_added] = atributo_item;
   // alert(array_items[id_item_added]);
    id_item_added++;    
    //Prepares the string
    prepareStringAttributes();
    
}

/*
 * Removes items from list
 *
 */
function removeItemAttribute(id_item){
    
    var idSelected = id_item.split("_");
    $("#id_Attr_"+ idSelected[1]).fadeOut("fast");
    array_items[idSelected[1]] = "empty";
    //Prepares and set the string
    prepareStringAttributes();
    $("#helper_check_update").val(1);

}

/*
 * Prepares a string that will be used to pass
 * all items for new attributes.
 *
 */
function prepareStringAttributes(){
    
    var attr_string = "";
    for(p = 0; p < array_items.length; p++){
       
        if(p < (array_items.length  - 1)){
            if(array_items[p] != "empty"){
                attr_string += array_items[p] + ", ";
            }
        }else{
            if(array_items[p] != "empty"){
                attr_string += array_items[p]; 
            }
        }
        
    }
 
    $("#helper_atributos_clientes").val(attr_string);
}

/*
 * Show the attributes set previously
 *
 */
function setUserAttributes(){
    
    var data = $('#helper_json_atributos_clientes').val();
    
    if(data != '' && data != undefined){
        
        var jsonObject = eval('(' + data + ')');
        var names_string = "";

        for(i = 0; i < jsonObject.length; i++){
            if(jsonObject[i]['name'] != undefined){
                if(i < (jsonObject.length  - 1)){
                    names_string += jsonObject[i]['name'] + ", ";
                }else{
                    names_string += jsonObject[i]['name'];   
                }
                //Fill out the attributes
                if(i == 0) $(".container_items_client").empty();
                $(".container_items_client").append("<div class='item_attr_client' id='id_Attr_"+i+"'> Adicionado -> "+ jsonObject[i]['name'] + "<div class='bt_close_client'><input type='button' class='bt_delete_transparent' id='it_"+i+"'/></div></div>");
                addAttributoToField(jsonObject[i]['name']);
            }
        }

        $("#helper_atributos_clientes").val(names_string);
    }
    
}

initListenersAtributes();